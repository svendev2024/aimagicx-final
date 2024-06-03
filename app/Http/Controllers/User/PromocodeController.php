<?php

namespace App\Http\Controllers\User;

use Zorb\Promocodes\Facades\Promocodes;
use Zorb\Promocodes\Exceptions\PromocodeAlreadyUsedByUserException;
use Zorb\Promocodes\Exceptions\PromocodeDoesNotExistException;
use Zorb\Promocodes\Exceptions\PromocodeExpiredException;
use Zorb\Promocodes\Exceptions\PromocodeNoUsagesLeftException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\PrepaidPlan;
use App\Models\Promocode;
use App\Models\User;

class PromocodeController extends Controller
{   
    
    /**
     * Apply promocode for prepaid plans
     */
    public function applyPromocodesPrepaid(Request $request, $id)
    {   
        if ($request->ajax()) {

            if ($request->type == 'lifetime') {
                $id = SubscriptionPlan::where('id', $id)->first();
                $type = 'lifetime';
            } else {
                $id = PrepaidPlan::where('id', $id)->first();
                $type = 'prepaid';
            }

            if (request('promo_code')) {

                $tax_value = (config('payment.payment_tax') > 0) ? $tax = $id->price * config('payment.payment_tax') / 100 : 0;
                $total_value = $tax_value + $id->price;
                $code = request('promo_code');

                $check = Promocode::where('code', $code)->whereNot('usages_left', 0)->where(function ($query) {
                    $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
                })->exists();

                if ($check) {

                    $promocode = Promocode::where('code', $code)->first();
                    $details = json_decode($promocode->details, true);

                    if ($details['status'] == 'invalid') {
                        return [ 'error' => 'This promocode is not valid anymore'];
                    }

                    if ($details['type'] == 'percentage') {

                        $discount_value = ($details['discount'] * $total_value) / 100;
                        $new_value = $total_value - $discount_value;
                        $discount = '-' . $details['discount'] . '%';

                        try {
                            Promocodes::code($code)
                                    ->user(User::find(auth()->user()->id))
                                    ->apply();
                        } catch (PromocodeAlreadyUsedByUserException $ex) {
                            return [ 'error' => 'The given promocode ' . $code . ' has already been used by you'];
                        } catch (PromocodeDoesNotExistException $ex) {
                            return [ 'error' => 'Provided promocode does not exists'];
                        } catch (PromocodeExpiredException $ex) {
                            return [ 'error' => 'Provided promocode has already expired'];
                        } catch (PromocodeNoUsagesLeftException $ex) {
                            return [ 'error' => 'Provided promocode has been depleted'];
                        }                        

                        return ['total' => number_format((float)$new_value, 2, '.', ''), 'discount' => $discount];

                    } else {

                        try {
                            Promocodes::code($code)
                                    ->user(User::find(auth()->user()->id)) 
                                    ->apply();
                        } catch (PromocodeAlreadyUsedByUserException $ex) {
                            return [ 'error' => 'The given promocode ' . $code . ' has already been used by you'];
                        } catch (PromocodeDoesNotExistException $ex) {
                            return [ 'error' => 'Provided promocode does not exists'];
                        } catch (PromocodeExpiredException $ex) {
                            return [ 'error' => 'Provided promocode has already expired'];
                        } catch (PromocodeNoUsagesLeftException $ex) {
                            return [ 'error' => 'Provided promocode has been depleted'];
                        } 

                        $new_value = $total_value - $details['discount'];
                        $discount = config('payment.default_system_currency_symbol') . $details['discount'] . ' ' . $id->currency;

                        return ['total' => number_format((float)$new_value, 2, '.', ''), 'discount' => $discount];
                    }
                    
                } 
                
                return [ 'error' => 'Invalid promocode'];
                
            } 

            return [ 'error' => 'Enter a valid promocode'];
        }
    }


    /**
     * Calculate promocode discount value
     */
    public function calculatePromocode($code, $total_value)
    {
        if (Promocodes::check($code)) {

            $promocode = Promocodes::check($code);

            if ($promocode->data['status'] == 'invalid') {
                return false;
            }

            if ($promocode->data['type'] == 'percentage') {
                
                $discount_value = ($promocode->reward * $total_value) / 100;
                $new_value = $total_value - $discount_value;

                Promocodes::redeem($code);

                return number_format((float)$new_value, 2, '.', '');

            } else {

                $new_value = $total_value - $promocode->reward;
                
                Promocodes::redeem($code);

                return number_format((float)$new_value, 2, '.', '');
            }
        }

        return false;
    }
}
