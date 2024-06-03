<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Services\Statistics\PaymentsService;
use App\Services\Statistics\CostsService;
use App\Events\PaymentReferrerBonus;
use App\Models\Subscriber;
use App\Models\Payment;
use App\Models\User;
use App\Models\SubscriptionPlan;
use DataTables;
use Carbon\Carbon;

class FinanceController extends Controller
{
    /**
     * Display finance dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $payment = new PaymentsService($year, $month);
        $cost = new CostsService($year, $month);

        $total_data_monthly = [
            'income_current_month' => $payment->getTotalPaymentsCurrentMonth(),
            'income_past_month' => $payment->getTotalPaymentsPastMonth(),
            'spending_current_month' => $cost->getTotalAdaCostCurrentMonth() + $cost->getTotalBabbageCostCurrentMonth() + $cost->getTotalCurieCostCurrentMonth() + $cost->getTotalDavinciCostCurrentMonth(),
            'spending_past_month' => $cost->getTotalAdaPastMonth() + $cost->getTotalBabbagePastMonth() + $cost->getTotalCuriePastMonth() + $cost->getTotalDavinciPastMonth(),
        ];

        $total_data_yearly = [
            'total_income' => $payment->getTotalPaymentsCurrentYear(),
            'total_spending' => $cost->getTotalBabbageCostCurrentYear() + $cost->getTotalAdaCostCurrentYear() + $cost->getTotalCurieCostCurrentYear() + $cost->getTotalDavinciCostCurrentYear(),
        ];

        $chart_data['total_income'] = json_encode($payment->getPayments());
        $chart_data['total_income_year'] = json_encode($payment->getTotalPaymentsCurrentYear());

        $percentage['income_current'] = json_encode($payment->getTotalPaymentsCurrentMonth());
        $percentage['income_past'] = json_encode($payment->getTotalPaymentsPastMonth());
        $percentage['spending_current'] = json_encode($cost->getTotalAdaCostCurrentMonth() + $cost->getTotalBabbageCostCurrentMonth() + $cost->getTotalCurieCostCurrentMonth() + $cost->getTotalDavinciCostCurrentMonth());
        $percentage['spending_past'] = json_encode($cost->getTotalAdaPastMonth() + $cost->getTotalBabbagePastMonth() + $cost->getTotalCuriePastMonth() + $cost->getTotalDavinciPastMonth());

        return view('admin.finance.dashboard.index', compact('percentage', 'chart_data', 'total_data_yearly', 'total_data_monthly'));
    }

    
    /**
     * List all user transactions
     */
    public function listTransactions(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('users.id', 'users.email', 'users.name', 'users.profile_photo_path', 'users.country', 'payments.*')->join('payments', 'payments.user_id', '=', 'users.id')->orderBy('payments.created_at', 'DESC')->get();       
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        if ($row["gateway"] == 'BankTransfer') {
                            $actionBtn = '<div>                                            
                                            <a href="'. route("admin.finance.transaction.show", $row["id"] ). '"><i class="fa-solid fa-file-invoice-dollar table-action-buttons edit-action-button" title="View Transaction"></i></a>
                                            <a href="'. route("admin.finance.transaction.edit", $row["id"] ). '"><i class="fa-solid fa-file-pen table-action-buttons view-action-button" title="Update Transaction"></i></a>
                                            <a class="deleteTransactionButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Transaction"></i></a>
                                        </div>';
                        } else {
                            $actionBtn = '<div>                                            
                                            <a href="'. route("admin.finance.transaction.show", $row["id"] ). '"><i class="fa-solid fa-file-invoice-dollar table-action-buttons view-action-button" title="View Transaction"></i></a>
                                            <a class="deleteTransactionButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Transaction"></i></a>
                                        </div>';
                        }

                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('user', function($row){
                        if ($row['profile_photo_path']) {
                            $path = asset($row['profile_photo_path']);
                            $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span><br><span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                        } else {
                            $path = URL::asset('img/users/avatar.png');
                            $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" class="rounded-circle" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span><br><span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                        }
                        return $user;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_status = '<span class="cell-box payment-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-amount', function($row){
                        $custom_amount = '<span class="font-weight-bold">'.$row["price"]. $row['currency'].'</span>';
                        return $custom_amount;
                    })
                    ->addColumn('custom-frequency', function($row){
                        $custom_status = '<span class="cell-box payment-'.strtolower($row["frequency"]).'">'.ucfirst($row["frequency"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-order', function($row){
                        $custom_order = '<span class="font-weight-bold">'.$row["order_id"].'</span>';
                        return $custom_order;
                    })
                    ->addColumn('custom-country', function($row){
                        $custom_country = '<span class="font-weight-bold">'.$row["country"].'</span>';
                        return $custom_country;
                    })
                    ->addColumn('custom-gateway', function($row){
                        switch ($row['gateway']) {
                            case 'PayPal':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="PayPal Gateway" class="w-50" src="' . URL::asset('img/payments/paypal.svg') . '"></div>';                             
                                break;
                            case 'Stripe':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Stripe Gateway" class="w-30" src="' . URL::asset('img/payments/stripe.svg') . '"></div>';
                                break;
                            case 'Paystack':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Paystack Gateway" class="transaction-gateway-logo" src="' . URL::asset('img/payments/paystack.svg') . '"></div>';
                                break;
                            case 'Razorpay':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Razorpay Gateway" class="transaction-gateway-logo" src="' . URL::asset('img/payments/razorpay.svg') . '"></div>';
                                break;
                            case 'BankTransfer':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="BankTransfer Gateway" class="transaction-gateway-logo" src="' . URL::asset('img/payments/bank-transfer.png') . '"></div>';
                                break;
                            case 'Coinbase':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Coinbase Gateway" class="w-40" src="' . URL::asset('img/payments/coinbase.svg') . '"></div>';
                                break;
                            case 'Mollie':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Mollie Gateway" class="w-40" src="' . URL::asset('img/payments/mollie.svg') . '"></div>';
                                break;
                            case 'Braintree':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Braintree Gateway" class="w-40" src="' . URL::asset('img/payments/braintree.svg') . '"></div>';
                                break;
                            case 'Midtrans':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Midtrans Gateway" class="w-40" src="' . URL::asset('img/payments/midtrans.png') . '"></div>';
                                break;
                            case 'Flutterwave':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Flutterwave Gateway" class="w-40" src="' . URL::asset('img/payments/flutterwave.svg') . '"></div>';
                                break;
                            case 'Yookassa':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Yookassa Gateway" class="w-40" src="' . URL::asset('img/payments/yookassa.svg') . '"></div>';
                                break;
                            case 'Paddle':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Paddle Gateway" class="w-40" src="' . URL::asset('img/payments/paddle.svg') . '"></div>';
                                break;
                            default:
                                $custom_gateway = '<div class="overflow-hidden">Unknown</div>';
                                break;
                        }
                        
                        return $custom_gateway;
                    })
                    ->addColumn('custom-plan-name', function($row){
                        $custom_status = '<span class="font-weight-bold">'.ucfirst($row["plan_name"]).'</span><br><span class="text-muted">'.number_format($row["words"]).' words</span>';
                        return $custom_status;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on', 'custom-amount', 'custom-plan-name', 'user', 'custom-order', 'custom-country', 'custom-gateway', 'custom-frequency'])
                    ->make(true);
                    
        }

        return view('admin.finance.transactions.index');
    }


    /**
     * List all user subscriptions
     */
    public function listSubscriptions(Request $request)
    {        
        if ($request->ajax()) {
            $data = Subscriber::select('subscribers.*', 'subscription_plans.plan_name', 'subscription_plans.price', 'subscription_plans.currency', 'users.name', 'users.email', 'users.profile_photo_path')->join('subscription_plans', 'subscription_plans.id', '=', 'subscribers.plan_id')->join('users', 'subscribers.user_id', '=', 'users.id')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                            <a class="cancelSubscriptionButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-file-slash table-action-buttons delete-action-button" title="Cancel Transaction"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-until', function($row){
                        $custom_until = '<span class="font-weight-bold">'.date_format(Carbon::parse($row["active_until"]), 'd M Y').'</span><br><span>'.date_format(Carbon::parse($row["active_until"]), 'H:i A').'</span>';
                        return $custom_until;
                    })
                    ->addColumn('custom-frequency', function($row){
                        $custom_status = '<span class="cell-box payment-'.strtolower($row["frequency"]).'">'.ucfirst($row["frequency"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('user', function($row){
                        if ($row['profile_photo_path']) {
                            $path = asset($row['profile_photo_path']);
                            $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span><br><span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                        } else {
                            $path = URL::asset('img/users/avatar.png');
                            $user = '<div class="d-flex">
                                        <div class="widget-user-image-sm overflow-hidden mr-4"><img alt="Avatar" class="rounded-circle" src="' . $path . '"></div>
                                        <div class="widget-user-name"><span class="font-weight-bold">'. $row['name'] .'</span><br><span class="text-muted">'.$row["email"].'</span></div>
                                    </div>';
                        }
                        return $user;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_status = '<span class="cell-box subscription-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-plan-name', function($row){
                        $custom_status = '<span class="font-weight-bold">'.ucfirst($row["plan_name"]).'</span><br><span class="text-muted">'.$row["price"] . ' ' .$row['currency'].'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-words', function($row){
                        $custom_storage = '<span class="font-weight-bold">'.number_format($row["words"]).'</span>';
                        return $custom_storage;
                    })
                    ->addColumn('custom-gateway', function($row){
                        switch ($row['gateway']) {
                            case 'PayPal':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="PayPal Gateway" class="w-40" src="' . URL::asset('img/payments/paypal.svg') . '"></div>';                             
                                break;
                            case 'Stripe':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Stripe Gateway" class="w-30" src="' . URL::asset('img/payments/stripe.svg') . '"></div>';
                                break;
                            case 'Paystack':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Paystack Gateway" class="transaction-gateway-logo" src="' . URL::asset('img/payments/paystack.svg') . '"></div>';
                                break;
                            case 'Razorpay':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Razorpay Gateway" class="transaction-gateway-logo" src="' . URL::asset('img/payments/razorpay.svg') . '"></div>';
                                break;
                            case 'BankTransfer':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="BankTransfer Gateway" class="w-40" src="' . URL::asset('img/payments/bank-transfer.png') . '"></div>';
                                break;
                            case 'Coinbase':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Coinbase Gateway" class="w-40" src="' . URL::asset('img/payments/coinbase.svg') . '"></div>';
                                break;
                            case 'Mollie':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Mollie Gateway" class="w-40" src="' . URL::asset('img/payments/mollie.svg') . '"></div>';
                                break;
                            case 'Braintree':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Braintree Gateway" class="w-40" src="' . URL::asset('img/payments/braintree.svg') . '"></div>';
                                break;
                            case 'Midtrans':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Midtrans Gateway" class="w-40" src="' . URL::asset('img/payments/midtrans.png') . '"></div>';
                                break;
                            case 'Flutterwave':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Flutterwave Gateway" class="w-40" src="' . URL::asset('img/payments/flutterwave.svg') . '"></div>';
                                break;
                            case 'Yookassa':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Yookassa Gateway" class="w-40" src="' . URL::asset('img/payments/yookassa.svg') . '"></div>';
                                break;
                            case 'Paddle':
                                $custom_gateway = '<div class="overflow-hidden"><img alt="Paddle Gateway" class="w-40" src="' . URL::asset('img/payments/paddle.svg') . '"></div>';
                                break;
                            case 'FREE':
                                $custom_gateway = '<div class="font-weight-bold">Free Plan</div>';
                                break;
                            default:
                                $custom_gateway = '<div class="overflow-hidden">Unknown</div>';
                                break;
                        }
                        
                        return $custom_gateway;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on', 'custom-words', 'custom-until', 'user', 'custom-plan-name', 'custom-gateway', 'custom-frequency'])
                    ->make(true);
                    
        }

        return view('admin.finance.transactions.subscriptions');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $id)
    {
        $user = User::where('id', $id->user_id)->first();

        return view('admin.finance.transactions.show', compact('id', 'user'));     
    }


    /**
     * Edit the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $id)
    {
        $user = User::where('id', $id->user_id)->first();

        return view('admin.finance.transactions.edit', compact('id', 'user'));     
    }


    /**
     * Update the specified resource - bank transfer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Payment $id)
    {
        request()->validate([
            'payment-status' => 'required',
        ]);

        $id->status = request('payment-status');
        $id->save();


        if ($id->status == 'completed') {

            if (config('payment.referral.enabled') == 'on') {
                if (config('payment.referral.payment.policy') == 'first') {
                    $transactions = Payment::where('user_id', $id->user_id)->where('status', 'completed')->get();
                    $payments = $transactions->count();
                    if ($payments > 1) {
                        /** User already has at least 1 payment and referrer already received credit for it */
                    } else {
                        $user = User::where('id', $id->user_id)->first();
                        event(new PaymentReferrerBonus($user, $id->order_id, $id->price, 'BankTransfer'));
                    }
                } else {
                    $user = User::where('id', $id->user_id)->first();
                    event(new PaymentReferrerBonus($user, $id->order_id, $id->price, 'BankTransfer'));
                }
            }
            
            $user = User::where('id', $id->user_id)->first();
            $group = ($user->hasRole('admin'))? 'admin' : 'subscriber';

            if ($id->frequency != 'prepaid') {
                $user->syncRoles($group);    
                $user->group = $group;
                $user->plan_id = $id->plan_id;
                $user->total_words = $id->words;
                $user->available_words = $id->words;
                $user->total_images = $id->images;
                $user->available_images = $id->images;
                $user->total_chars = $id->characters;
                $user->available_chars = $id->characters;
                $user->total_minutes = $id->minutes;
                $user->available_minutes = $id->minutes;
                $user->member_limit = $id->team_members;
                $user->save();   
                    
                $subscription = Subscriber::where('subscription_id', $id->order_id)->firstOrFail();
                $subscription->status = 'Active';
                $subscription->save();
            } else {
                $user->available_words_prepaid = ($user->available_words_prepaid + $id->words);
                $user->available_images_prepaid = ($user->available_images_prepaid + $id->images);
                $user->available_chars_prepaid = ($user->available_chars_prepaid + $id->characters);
                $user->available_minutes_prepaid = ($user->available_minutes_prepaid + $id->minutes);
                $user->save();  
            }
            
            
        }

        toastr()->success(__('Bank Transfer transaction has been updated successfully'));
        return redirect()->route('admin.finance.transactions');     
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {  
        if ($request->ajax()) {

            $payment = Payment::find(request('id'));

            if($payment) {

                $payment->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        }         
    }
}
