<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Statistics\PaymentsService;
use App\Services\Statistics\CostsService;
use App\Services\Statistics\RegistrationService;
use App\Services\Statistics\UserRegistrationMonthlyService;
use App\Services\Statistics\DavinciUsageService;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $payment = new PaymentsService($year, $month);
        $cost = new CostsService($year, $month);
        $davinci = new DavinciUsageService($month, $year);
        $registration = new RegistrationService($year, $month);
        $user_registration = new UserRegistrationMonthlyService($month);
       
        $total_data_monthly = [
            'new_users_current_month' => $registration->getNewUsersCurrentMonth(),
            'new_users_past_month' => $registration->getNewUsersPastMonth(),
            'new_subscribers_current_month' => $registration->getNewSubscribersCurrentMonth(),
            'new_subscribers_past_month' => $registration->getNewSubscribersPastMonth(),
            'income_current_month' => $payment->getTotalPaymentsCurrentMonth(),
            'income_past_month' => $payment->getTotalPaymentsPastMonth(),
            'spending_current_month' => $cost->getTotalAdaCostCurrentMonth() + $cost->getTotalBabbageCostCurrentMonth() + $cost->getTotalCurieCostCurrentMonth() + $cost->getTotalDavinciCostCurrentMonth(),
            'spending_past_month' => $cost->getTotalAdaPastMonth() + $cost->getTotalBabbagePastMonth() + $cost->getTotalCuriePastMonth() + $cost->getTotalDavinciPastMonth(),
            'words_current_month' => $davinci->getTotalWordsCurrentMonth(),
            'words_past_month' => $davinci->getTotalWordsPastMonth(),
            'images_current_month' => $davinci->getTotalImagesCurrentMonth(),
            'images_past_month' => $davinci->getTotalImagesCurrentMonth(),
            'contents_current_month' => $davinci->getTotalContentsCurrentMonth(),
            'contents_past_month' => $davinci->getTotalContentsPastMonth(),
            'transactions_current_month' => $payment->getTotalTransactionsCurrentMonth(),
            'transactions_past_month' => $payment->getTotalTransactionsPastMonth(),
        ];

        $total_data_yearly = [
            'total_new_users' => $registration->getNewUsersCurrentYear(),
            'total_new_subscribers' => $registration->getNewSubscribersCurrentYear(),
            'total_income' => $payment->getTotalPaymentsCurrentYear(),
            'total_spending' => $cost->getTotalBabbageCostCurrentYear() + $cost->getTotalAdaCostCurrentYear() + $cost->getTotalCurieCostCurrentYear() + $cost->getTotalDavinciCostCurrentYear(),
            'words_generated' => $davinci->getTotalWordsCurrentYear(),
            'images_generated' => $davinci->getTotalImagesCurrentYear(),
            'contents_generated' => $davinci->getTotalContentsCurrentYear(),
            'transactions_generated' => $payment->getTotalTransactionsCurrentYear(),
        ];
        
        $chart_data['total_new_users'] = json_encode($registration->getAllUsers());
        $chart_data['monthly_new_users'] = json_encode($user_registration->getRegisteredUsers());
        $chart_data['total_income'] = json_encode($payment->getPayments());

        $percentage['users_current'] = json_encode($registration->getNewUsersCurrentMonth());
        $percentage['users_past'] = json_encode($registration->getNewUsersPastMonth());
        $percentage['subscribers_current'] = json_encode($registration->getNewSubscribersCurrentMonth());
        $percentage['subscribers_past'] = json_encode($registration->getNewSubscribersPastMonth());
        $percentage['income_current'] = json_encode($payment->getTotalPaymentsCurrentMonth());
        $percentage['income_past'] = json_encode($payment->getTotalPaymentsPastMonth());
        $percentage['spending_current'] = json_encode($cost->getTotalAdaCostCurrentMonth() + $cost->getTotalBabbageCostCurrentMonth() + $cost->getTotalCurieCostCurrentMonth() + $cost->getTotalDavinciCostCurrentMonth());
        $percentage['spending_past'] = json_encode($cost->getTotalAdaPastMonth() + $cost->getTotalBabbagePastMonth() + $cost->getTotalCuriePastMonth() + $cost->getTotalDavinciPastMonth());
        $percentage['words_current'] = json_encode($davinci->getTotalWordsCurrentMonth());
        $percentage['words_past'] = json_encode($davinci->getTotalWordsPastMonth());
        $percentage['images_current'] = json_encode($davinci->getTotalImagesCurrentMonth());
        $percentage['images_past'] = json_encode($davinci->getTotalImagesCurrentMonth());
        $percentage['contents_current'] = json_encode($davinci->getTotalContentsCurrentMonth());
        $percentage['contents_past'] = json_encode($davinci->getTotalContentsPastMonth());
        $percentage['transactions_current'] = json_encode($payment->getTotalTransactionsCurrentMonth());
        $percentage['transactions_past'] = json_encode($payment->getTotalTransactionsPastMonth());

        $result = User::latest()->take(5)->get();
        $transaction = User::select('users.id', 'users.email', 'users.name', 'users.profile_photo_path', 'payments.*')->join('payments', 'payments.user_id', '=', 'users.id')->orderBy('payments.created_at', 'DESC')->take(5)->get();       
 
        return view('admin.dashboard.index', compact('total_data_monthly', 'total_data_yearly', 'chart_data', 'percentage', 'result', 'transaction'));
    }

}
