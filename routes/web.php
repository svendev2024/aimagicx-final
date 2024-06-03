<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDavinciController;
use App\Http\Controllers\Admin\DavinciConfigController;
use App\Http\Controllers\Admin\CustomTemplateController;
use App\Http\Controllers\Admin\VoiceCustomizationController;
use App\Http\Controllers\Admin\ChatCustomizationController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\FinanceSubscriptionPlanController;
use App\Http\Controllers\Admin\FinancePrepaidPlanController;
use App\Http\Controllers\Admin\FinancePromocodeController;
use App\Http\Controllers\Admin\ReferralSystemController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\FinanceSettingController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\InstallController;
use App\Http\Controllers\Admin\UpdateController;
use App\Http\Controllers\Admin\Frontend\AppearanceController;
use App\Http\Controllers\Admin\Frontend\FrontendController;
use App\Http\Controllers\Admin\Frontend\BlogController;
use App\Http\Controllers\Admin\Frontend\PageController;
use App\Http\Controllers\Admin\Frontend\FAQController;
use App\Http\Controllers\Admin\Frontend\ReviewController;
use App\Http\Controllers\Admin\Frontend\AdsenseController;
use App\Http\Controllers\Admin\Settings\GlobalController;
use App\Http\Controllers\Admin\Settings\BackupController;
use App\Http\Controllers\Admin\Settings\OAuthController;
use App\Http\Controllers\Admin\Settings\ActivationController;
use App\Http\Controllers\Admin\Settings\SMTPController;
use App\Http\Controllers\Admin\Settings\RegistrationController;
use App\Http\Controllers\Admin\Settings\UpgradeController;
use App\Http\Controllers\Admin\Settings\ClearCacheController;
use App\Http\Controllers\Admin\Webhooks\PaypalWebhookController;
use App\Http\Controllers\Admin\Webhooks\StripeWebhookController;
use App\Http\Controllers\Admin\Webhooks\PaystackWebhookController;
use App\Http\Controllers\Admin\Webhooks\RazorpayWebhookController;
use App\Http\Controllers\Admin\Webhooks\MollieWebhookController;
use App\Http\Controllers\Admin\Webhooks\CoinbaseWebhookController;
use App\Http\Controllers\Admin\Webhooks\FlutterwaveWebhookController;
use App\Http\Controllers\Admin\Webhooks\YookassaWebhookController;
use App\Http\Controllers\Admin\Webhooks\PaddleWebhookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\TeamController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserPasswordController;
use App\Http\Controllers\User\TemplateController;
use App\Http\Controllers\User\ImageController;
use App\Http\Controllers\User\CodeController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\TranscribeController;
use App\Http\Controllers\User\VoiceoverController;
use App\Http\Controllers\User\PurchaseHistoryController;
use App\Http\Controllers\User\WorkbookController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\PlanController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ReferralController;
use App\Http\Controllers\User\PromocodeController;
use App\Http\Controllers\User\UserSupportController;
use App\Http\Controllers\User\UserNotificationController;
use App\Http\Controllers\User\SearchController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now reate something great!
|
*/

// AUTH ROUTES
Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    require __DIR__.'/auth.php';
});

// FRONTEND ROUTES
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/blog/{slug}', 'blogShow')->name('blogs.show');
    Route::post('/contact', 'contact')->name('contact');
    Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy');
});

// PAYMENT GATEWAY WEBHOOKS ROUTES
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handleStripe'])->name('stripe.webhook');
Route::post('/webhooks/paypal', [PaypalWebhookController::class, 'handlePaypal']);
Route::post('/webhooks/paystack', [PaystackWebhookController::class, 'handlePaystack']);
Route::post('/webhooks/razorpay', [RazorpayWebhookController::class, 'handleRazorpay']);
Route::post('/webhooks/mollie', [MollieWebhookController::class, 'handleMollie'])->name('mollie.webhook');
Route::post('/webhooks/coinbase', [CoinbaseWebhookController::class, 'handleCoinbase']);
Route::post('/webhooks/flutterwave', [FlutterwaveWebhookController::class, 'handleFlutterwave']);
Route::post('/webhooks/yookassa', [YookassaWebhookController::class, 'handleYookassa']);
Route::post('/webhooks/paddle', [PaddleWebhookController::class, 'handlePaddle']);

// INSTALL ROUTES
Route::group(['prefix' => 'install', 'middleware' => 'install'], function() {
    Route::controller(InstallController::class)->group(function () {
        Route::get('/', 'index')->name('install');
        Route::get('/requirements', 'requirements')->name('install.requirements');
        Route::get('/permissions', 'permissions')->name('install.permissions');
        Route::get('/database', 'database')->name('install.database');    
        Route::post('/database', 'storeDatabaseCredentials')->name('install.database.store');
        Route::get('/activation', 'activation')->name('install.activation');    
        Route::post('/activation', 'activateApplication')->name('install.activation.activate');
    });
});

// LOCALE ROUTES
Route::get('/locale/{lang}', [LocaleController::class, 'language'])->name('locale');

// ADMIN ROUTES
Route::group(['prefix' => 'admin', 'middleware' => ['verified', '2fa.verify', 'role:admin', 'PreventBackHistory']], function() {

    // UPDATE ROUTE
    Route::get('/update/now', [UpdateController::class, 'updateDatabase']);

    // ADMIN DASHBOARD ROUTES
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // ADMIN DAVINCI MANAGEMENT ROUTES
    Route::controller(AdminDavinciController::class)->group(function() {
        Route::get('/davinci/dashboard', 'index')->name('admin.davinci.dashboard'); 
        Route::get('/davinci/templates', 'templates')->name('admin.davinci.templates');
        Route::post('/davinci/templates/template/update', 'descriptionUpdate');  
        Route::post('/davinci/templates/template/activate', 'templateActivate');   
        Route::post('/davinci/templates/template/deactivate', 'templateDeactivate');  
        Route::post('/davinci/templates/template/changepackage', 'assignPackage');  
        Route::post('/davinci/templates/template/setnew', 'setNew');  
        Route::post('/davinci/templates/template/delete', 'deleteTemplate');  
        Route::get('/davinci/templates/activate/all', 'templateActivateAll'); 
        Route::get('/davinci/templates/deactivate/all', 'templateDeactivateAll'); 
    }); 
    
    // ADMIN DAVINCI CONFIGURATION ROUTES
    Route::controller(DavinciConfigController::class)->group(function() {
        Route::get('/davinci/configs', 'index')->name('admin.davinci.configs');
        Route::post('/davinci/configs', 'store')->name('admin.davinci.configs.store');
        Route::get('/davinci/configs/keys', 'showKeys')->name('admin.davinci.configs.keys');
        Route::get('/davinci/configs/keys/create', 'createKeys')->name('admin.davinci.configs.keys.create');
        Route::post('/davinci/configs/keys/store', 'storeKeys')->name('admin.davinci.configs.keys.store');
        Route::post('/davinci/configs/keys/update', 'update');
        Route::post('/davinci/configs/keys/activate', 'activate');
        Route::post('/davinci/configs/keys/delete', 'delete');
    }); 

    // ADMIN DAVINCI CUSTOM TEMPLATES ROUTES
    Route::controller(CustomTemplateController::class)->group(function() {
        Route::get('/davinci/custom', 'index')->name('admin.davinci.custom');
        Route::post('/davinci/custom', 'store')->name('admin.davinci.custom.store');
        Route::get('/davinci/custom/{id}/show', 'show')->name('admin.davinci.custom.show');
        Route::put('/davinci/custom/{id}/update', 'update')->name('admin.davinci.custom.update');
        Route::get('/davinci/custom/category', 'category')->name('admin.davinci.custom.category');
        Route::post('/davinci/custom/category/change', 'change');
        Route::post('/davinci/custom/category/description', 'description');
        Route::post('/davinci/custom/category/create', 'create');
        Route::post('/davinci/custom/category/delete', 'delete');
    }); 

    // ADMIN VOICEOVER VOICE CUSTOMIZATION ROUTES
    Route::controller(VoiceCustomizationController::class)->group(function() {
        Route::get('/text-to-speech/voices', 'voices')->name('admin.davinci.voices');  
        Route::post('/text-to-speech/voices/avatar/upload', 'changeAvatar'); 
        Route::post('/text-to-speech/voice/update', 'voiceUpdate');  
        Route::post('/text-to-speech/voices/voice/activate', 'voiceActivate');  
        Route::post('/text-to-speech/voices/voice/deactivate', 'voiceDeactivate');    
        Route::get('/text-to-speech/voices/activate/all', 'voicesActivateAll');  
        Route::get('/text-to-speech/voices/deactivate/all', 'voicesDeactivateAll'); 
    });

    // ADMIN AI CHAT CUSTOMIZATION ROUTES
    Route::controller(ChatCustomizationController::class)->group(function() {
        Route::get('/chats', 'chats')->name('admin.davinci.chats');  
        Route::post('/chats/avatar/upload', 'changeAvatar'); 
        Route::post('/chats/update', 'chatUpdate');  
        Route::post('/chats/chat/activate', 'chatActivate');  
        Route::post('/chats/chat/deactivate', 'chatDeactivate');  
        Route::get('/chats/chat/create', 'create')->name('admin.davinci.chat.create');  
        Route::post('/chats/chat/store', 'store')->name('admin.davinci.chat.store');  
        Route::get('/chats/chat/{id}/edit', 'edit')->name('admin.davinci.chat.edit');  
        Route::put('/chats/chat/{id}/update', 'update')->name('admin.davinci.chat.update');  
    });

    // ADMIN USER MANAGEMENT ROUTES
    Route::controller(AdminUserController::class)->group(function() {
        Route::get('/users/dashboard', 'index')->name('admin.user.dashboard');
        Route::get('/users/activity', 'activity')->name('admin.user.activity');
        Route::get('/users/list', 'listUsers')->name('admin.user.list');        
        Route::post('/users', 'store')->name('admin.user.store');
        Route::get('/users/create', 'create')->name('admin.user.create');        
        Route::get('/users/{user}/show', 'show')->name('admin.user.show');
        Route::get('/users/{user}/edit', 'edit')->name('admin.user.edit');
        Route::get('/users/{user}/credit', 'credit')->name('admin.user.credit');
        Route::post('/users/{user}/increase', 'increase')->name('admin.user.increase');
        Route::put('/users/{user}/update', 'update')->name('admin.user.update');
        Route::put('/users/{user}', 'change')->name('admin.user.change');       
        Route::post('/users/delete', 'delete');
    }); 

    // ADMIN FINANCE - DASHBOARD & TRANSACTIONS & SUBSCRIPTION LIST ROUTES
    Route::controller(FinanceController::class)->group(function() {
        Route::get('/finance/dashboard', 'index')->name('admin.finance.dashboard');
        Route::get('/finance/transactions', 'listTransactions')->name('admin.finance.transactions');
        Route::put('/finance/transaction/{id}/update', 'update')->name('admin.finance.transaction.update');
        Route::get('/finance/transaction/{id}/show', 'show')->name('admin.finance.transaction.show');
        Route::get('/finance/transaction/{id}/edit', 'edit')->name('admin.finance.transaction.edit');
        Route::post('/finance/transaction/delete', 'delete');
        Route::get('/finance/subscriptions', 'listSubscriptions')->name('admin.finance.subscriptions');
    });

    // ADMIN FINANCE - CANCEL USER SUBSCRIPTION
    Route::post('/finance/subscriptions/cancel', [PaymentController::class, 'stopSubscription']);

    // ADMIN FINANCE - SUBSCRIPTION PLAN ROUTES
    Route::controller(FinanceSubscriptionPlanController::class)->group(function() {
        Route::get('/finance/plans', 'index')->name('admin.finance.plans');
        Route::post('/finance/plans', 'store')->name('admin.finance.plan.store');
        Route::get('/finance/plan/create', 'create')->name('admin.finance.plan.create');
        Route::get('/finance/plan/{id}/show', 'show')->name('admin.finance.plan.show');        
        Route::get('/finance/plan/{id}/edit', 'edit')->name('admin.finance.plan.edit');
        Route::put('/finance/plan/{id}', 'update')->name('admin.finance.plan.update');
        Route::post('/finance/plan/delete', 'delete');
    });

    // ADMIN FINANCE - PREPAID PLAN ROUTES
    Route::controller(FinancePrepaidPlanController::class)->group(function() {
        Route::get('/finance/prepaid', 'index')->name('admin.finance.prepaid');
        Route::post('/finance/prepaid', 'store')->name('admin.finance.prepaid.store');
        Route::get('/finance/prepaid/create', 'create')->name('admin.finance.prepaid.create');
        Route::get('/finance/prepaid/{id}/show', 'show')->name('admin.finance.prepaid.show');        
        Route::get('/finance/prepaid/{id}/edit', 'edit')->name('admin.finance.prepaid.edit');
        Route::put('/finance/prepaid/{id}', 'update')->name('admin.finance.prepaid.update');
        Route::post('/finance/prepaid/delete', 'delete');
    });

    // ADMIN FINANCE - PROMOCODES ROUTES
    Route::controller(FinancePromocodeController::class)->group(function() {
        Route::get('/finance/promocodes', 'index')->name('admin.finance.promocodes');
        Route::post('/finance/promocodes', 'store')->name('admin.finance.promocodes.store');
        Route::get('/finance/promocodes/create', 'create')->name('admin.finance.promocodes.create');
        Route::get('/finance/promocodes/{id}/show', 'show')->name('admin.finance.promocodes.show');
        Route::get('/finance/promocodes/{id}/edit', 'edit')->name('admin.finance.promocodes.edit');
        Route::put('/finance/promocodes/{id}', 'update')->name('admin.finance.promocodes.update');
        Route::delete('/finance/promocodes/{id}', 'destroy')->name('admin.finance.promocodes.destroy');
        Route::get('/finance/promocodes/{id}', 'delete')->name('admin.finance.promocodes.delete');
    });

    // ADMIN FINANCE - REFERRAL ROUTES
    Route::controller(ReferralSystemController::class)->group(function() {
        Route::get('/referral/settings', 'index')->name('admin.referral.settings');
        Route::post('/referral/settings', 'store')->name('admin.referral.settings.store');
        Route::get('/referral/{order_id}/show', 'paymentShow')->name('admin.referral.show');
        Route::get('/referral/payouts', 'payouts')->name('admin.referral.payouts');
        Route::get('/referral/payouts/{id}/show', 'payoutsShow')->name('admin.referral.payouts.show');
        Route::put('/referral/payouts/{id}/store', 'payoutsUpdate')->name('admin.referral.payouts.update');
        Route::get('/referral/payouts/{id}/cancel', 'payoutsCancel')->name('admin.referral.payouts.cancel');
        Route::delete('/referral/payouts/{id}/decline', 'payoutsDecline')->name('admin.referral.payouts.decline');
        Route::get('/referral/top', 'topReferrers')->name('admin.referral.top');
    });

    // ADMIN FINANCE - INVOICE SETTINGS
    Route::controller(InvoiceController::class)->group(function() {
        Route::get('/settings/invoice', 'index')->name('admin.settings.invoice');
        Route::post('/settings/invoice', 'store')->name('admin.settings.invoice.store');
    });

    // ADMIN FINANCE SETTINGS ROUTES
    Route::controller(FinanceSettingController::class)->group(function() {
        Route::get('/finance/settings', 'index')->name('admin.finance.settings');
        Route::post('/finance/settings', 'store')->name('admin.finance.settings.store');
    });

    // ADMIN SUPPORT ROUTES
    Route::controller(SupportController::class)->group(function() {
        Route::get('/support', 'index')->name('admin.support');
        Route::get('/support/{ticket_id}/show', 'show')->name('admin.support.show');        
        Route::post('/support/response', 'response')->name('admin.support.response');
        Route::post('/support/delete', 'delete');
    });

    // ADMIN NOTIFICATION ROUTES
    Route::controller(NotificationController::class)->group(function() {
        Route::get('/notifications', 'index')->name('admin.notifications');
        Route::get('/notifications/sytem', 'system')->name('admin.notifications.system');
        Route::get('/notifications/create', 'create')->name('admin.notifications.create');
        Route::post('/notifications', 'store')->name('admin.notifications.store');
        Route::get('/notifications/{id}/show', 'show')->name('admin.notifications.show');
        Route::get('/notifications/system/{id}/show', 'systemShow')->name('admin.notifications.systemShow');
        Route::get('/notifications/mark-all', 'markAllRead')->name('admin.notifications.markAllRead');
        Route::get('/notifications/delete-all', 'deleteAll')->name('admin.notifications.deleteAll');
        Route::post('/notifications/delete', 'delete'); 
    });
    
    // ADMIN GENERAL SETTINGS - GLOBAL SETTINGS
    Route::controller(GlobalController::class)->group(function() {
        Route::get('/settings/global', 'index')->name('admin.settings.global');
        Route::post('/settings/global', 'store')->name('admin.settings.global.store');
    });

    // ADMIN GENERAL SETTINGS - DATABASE BACKUP
    Route::controller(BackupController::class)->group(function() {
        Route::get('/settings/backup', 'index')->name('admin.settings.backup');
        Route::get('/settings/backup/create', 'create')->name('admin.settings.backup.create');
        Route::get('/settings/backup/{file_name}', 'download')->name('admin.settings.backup.download');
        Route::get('/settings/backup/{file_name}/delete', 'destroy')->name('admin.settings.backup.delete');
    });

    // ADMIN GENERAL SETTINGS - SMTP SETTINGS
    Route::controller(SMTPController::class)->group(function() {
        Route::post('/settings/smtp/test', 'test')->name('admin.settings.smtp.test');
        Route::get('/settings/smtp', 'index')->name('admin.settings.smtp');
        Route::post('/settings/smtp', 'store')->name('admin.settings.smtp.store');  
    });      

    // ADMIN GENERAL SETTINGS - REGISTRATION SETTINGS
    Route::controller(RegistrationController::class)->group(function() {
        Route::get('/settings/registration', 'index')->name('admin.settings.registration');
        Route::post('/settings/registration', 'store')->name('admin.settings.registration.store');
    });

    // ADMIN GENERAL SETTINGS - OAUTH SETTINGS
    Route::controller(OAuthController::class)->group(function() {
        Route::get('/settings/oauth', 'index')->name('admin.settings.oauth');
        Route::post('/settings/oauth', 'store')->name('admin.settings.oauth.store');
    });

    // ADMIN GENERAL SETTINGS - ACTIVATION SETTINGS
    Route::controller(ActivationController::class)->group(function() {
        Route::get('/settings/activation', 'index')->name('admin.settings.activation');
        Route::post('/settings/activation', 'store')->name('admin.settings.activation.store');
        Route::get('/settings/activation/remove', 'remove')->name('admin.settings.activation.remove');
        Route::delete('/settings/activation/destroy', 'destroy')->name('admin.settings.activation.destroy');
        Route::get('/settings/activation/manual', 'showManualActivation')->name('admin.settings.activation.manual');
        Route::post('/settings/activation/manual', 'storeManualActivation')->name('admin.settings.activation.manual.store');
    });

    // ADMIN FRONTEND SETTINGS - APPEARANCE SETTINGS
    Route::controller(AppearanceController::class)->group(function() {
        Route::get('/settings/appearance', 'index')->name('admin.settings.appearance');
        Route::post('/settings/appearance', 'store')->name('admin.settings.appearance.store');
    });

    // ADMIN FRONTEND SETTINGS - FRONTEND SETTINGS
    Route::controller(FrontendController::class)->group(function() {
        Route::get('/settings/frontend', 'index')->name('admin.settings.frontend');
        Route::post('/settings/frontend', 'store')->name('admin.settings.frontend.store');
    });

    // ADMIN FRONTEND SETTINGS - BLOG MANAGER
    Route::controller(BlogController::class)->group(function() {
        Route::get('/settings/blog', 'index')->name('admin.settings.blog');
        Route::get('/settings/blog/create', 'create')->name('admin.settings.blog.create');
        Route::post('/settings/blog', 'store')->name('admin.settings.blog.store');   
        Route::put('/settings/blogs/{id}', 'update')->name('admin.settings.blog.update');		
        Route::get('/settings/blogs/{id}/edit', 'edit')->name('admin.settings.blog.edit');        
        Route::post('/settings/blog/delete', 'delete');
    });

    // ADMIN FRONTEND SETTINGS - FAQ MANAGER
    Route::controller(FAQController::class)->group(function() {
        Route::get('/settings/faq', 'index')->name('admin.settings.faq');
        Route::get('/settings/faq/create', 'create')->name('admin.settings.faq.create');        
        Route::post('/settings/faq', 'store')->name('admin.settings.faq.store');   
        Route::put('/settings/faqs/{id}', 'update')->name('admin.settings.faq.update');		
        Route::get('/settings/faqs/{id}/edit', 'edit')->name('admin.settings.faq.edit');        
        Route::post('/settings/faq/delete', 'delete');
    });

    // ADMIN FRONTEND SETTINGS - REVIEW MANAGER
    Route::controller(ReviewController::class)->group(function() {
        Route::get('/settings/review', 'index')->name('admin.settings.review');
        Route::get('/settings/review/create', 'create')->name('admin.settings.review.create');
        Route::post('/settings/review', 'store')->name('admin.settings.review.store');   
        Route::put('/settings/reviews/{id}', 'update')->name('admin.settings.review.update');		
        Route::get('/settings/reviews/{id}/edit', 'edit')->name('admin.settings.review.edit');        
        Route::post('/settings/review/delete', 'delete');
    });

    // ADMIN FRONTEND SETTINGS - GOOGLE ADSENSE
    Route::controller(AdsenseController::class)->group(function() {
        Route::get('/settings/adsense', 'index')->name('admin.settings.adsense');  
        Route::put('/settings/adsense/{id}', 'update')->name('admin.settings.adsense.update');		
        Route::get('/settings/adsense/{id}/edit', 'edit')->name('admin.settings.adsense.edit');        
    });
    
    // ADMIN FRONTEND SETTINGS - PAGE MANAGER (PRIVACY & TERMS) 
    Route::controller(PageController::class)->group(function() {
        Route::get('/settings/terms', 'index')->name('admin.settings.terms');
        Route::post('/settings/terms', 'store')->name('admin.settings.terms.store');
    });

    // ADMIN GENERAL SETTINGS - UPGRADE SOFTWARE
    Route::controller(UpgradeController::class)->group(function() {
        Route::get('/settings/upgrade', 'index')->name('admin.settings.upgrade');
        Route::post('/settings/upgrade', 'upgrade')->name('admin.settings.upgrade.start');
    });

    // ADMIN GENERAL SETTINGS - CLEAR CACHE
    Route::controller(ClearCacheController::class)->group(function() {
        Route::get('/settings/clear', 'index')->name('admin.settings.clear');
        Route::post('/settings/clear/clear', 'cache')->name('admin.settings.clear.cache');
        Route::post('/settings/clear/symlink', 'symlink')->name('admin.settings.clear.symlink');
    });


});
  
    
// REGISTERED USER ROUTES
Route::group(['prefix' => 'user', 'middleware' => ['verified', '2fa.verify', 'role:user|admin|subscriber', 'PreventBackHistory']], function() {

    // USER DASHBOARD ROUTES
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');  
    Route::post('/dashboard/favorite', [UserDashboardController::class, 'favorite']);    
    Route::post('/dashboard/favoritecustom', [UserDashboardController::class, 'favoriteCustom']);    
    
    // USER TEMPLATE ROUTES
    Route::controller(TemplateController::class)->group(function () {
        Route::get('/templates', 'index')->name('user.templates');       
        Route::post('/templates/original-template/generate', 'generate');     
        Route::get('/templates/original-template/process', 'process');   
        Route::post('/templates/custom-template/customGenerate', 'customGenerate');   
        Route::get('/templates/custom-template/process', 'process');                 
        Route::post('/templates/save', 'save');     
        Route::post('/templates/original-template/favorite', 'favorite');     
        Route::post('/templates/original-template/favoritecustom', 'favoriteCustom');     
        Route::post('/templates/custom-template/favorite', 'favoriteCustom');     
        Route::get('/templates/custom-template/{code}', 'viewCustomTemplate');
        Route::get('/templates/original-template/{slug}', 'viewOriginalTemplate');
    });

    // USER AI IMAGE ROUTES
    Route::controller(ImageController::class)->group(function () {
        Route::get('/images', 'index')->name('user.images');      
        Route::post('/images/process', 'process');         
        Route::post('/images/view', 'view');         
        Route::post('/images/delete', 'delete');
    });

    // USER AI CODE ROUTES
    Route::controller(CodeController::class)->group(function () {
        Route::get('/code', 'index')->name('user.codex');      
        Route::post('/code/process', 'process');         
        Route::post('/code/save', 'save');         
        Route::post('/code/view', 'view');         
        Route::post('/code/delete', 'delete');
    });

    // USER AI CHAT ROUTES
    Route::controller(ChatController::class)->group(function () {        
        Route::get('/chat', 'index')->name('user.chat');      
        Route::post('/chat/process', 'process');   
        Route::post('/chat/clear', 'clear');   
        Route::post('/chat/favorite', 'favorite');
        Route::get('/chat/generate', 'generateChat');   
        Route::post('/chat/messages', 'messages');                
        Route::post('/chat/rename', 'rename');
        Route::post('/chat/delete', 'delete');
        Route::get('/chats/{code}', 'view');
    });

    // USER SPEECH TO TEXT ROUTES
    Route::controller(TranscribeController::class)->group(function () {
        Route::get('/speech-to-text', 'index')->name('user.transcribe');      
        Route::post('/speech-to-text/process', 'process');         
        Route::post('/speech-to-text/save', 'save');         
        Route::post('/speech-to-text/view', 'view');         
        Route::post('/speech-to-text/delete', 'delete');
    });

    // USER AI VOICEOVER ROUTES
    Route::controller(VoiceoverController::class)->group(function() {
        Route::get('/text-to-speech','index')->name('user.voiceover');    
        Route::post('/text-to-speech/synthesize','synthesize')->name('user.voiceover.synthesize');    
        Route::post('/text-to-speech/listen','listen')->name('user.voiceover.listen');    
        Route::post('/text-to-speech/listen-row','listenRow');    
        Route::get('/text-to-speech/{id}/show','show')->name('user.voiceover.show');    
        Route::post('/text-to-speech/audio','audio');           
        Route::post('/text-to-speech/delete','delete');           
        Route::post('/text-to-speech/config','config'); 
    });

    // USER DOCUMENT ROUTES
    Route::controller(DocumentController::class)->group(function() { 
        Route::get('/document', 'index')->name('user.documents');
        Route::post('/document', 'store');
        Route::get('/document/images', 'images')->name('user.documents.images');
        Route::get('/document/codes', 'codes')->name('user.documents.codes');
        Route::get('/document/voiceovers', 'voiceovers')->name('user.documents.voiceovers');
        Route::get('/document/transcripts', 'transcripts')->name('user.documents.transcripts');
        Route::post('/document/result/delete', 'delete');   
        Route::post('/document/result/code/delete', 'deleteCode');   
        Route::post('/document/result/voiceover/delete', 'deleteVoiceover');   
        Route::post('/document/result/transcript/delete', 'deleteTranscript');   
        Route::get('/document/result/{id}/show', 'show')->name('user.documents.show');
        Route::get('/document/result/code/{id}/show', 'showCode')->name('user.documents.code.show');
        Route::get('/document/result/voiceover/{id}/show', 'showVoiceover')->name('user.documents.voiceover.show');
        Route::get('/document/result/transcript/{id}/show', 'showTranscript')->name('user.documents.transcript.show');
    });

    // USER WORKBOOK ROUTES
    Route::controller(WorkbookController::class)->group(function() { 
        Route::get('/workbook', 'index')->name('user.workbooks');
        Route::post('/workbook', 'store');
        Route::post('/workbook/result/delete', 'delete');
        Route::get('/workbook/change', 'change')->name('user.workbooks.change');        
        Route::get('/workbook/result/{id}/show', 'show')->name('user.workbooks.show');
        Route::put('/workbook', 'update')->name('user.workbooks.update');
        Route::delete('/workbook', 'destroy')->name('user.workbooks.delete');
    });

    // USER CHANGE PASSWORD ROUTES
    Route::controller(UserPasswordController::class)->group(function() {
        Route::get('/profile/security', 'index')->name('user.security');
        Route::post('/profile/security/password/{id}', 'update')->name('user.security.password');
        Route::get('/profile/security/2fa', 'google')->name('user.security.2fa');
        Route::post('/profile/security/2fa/activate', 'activate2FA')->name('user.security.2fa.activate');
        Route::post('/profile/security/2fa/deactivate', 'deactivate2FA')->name('user.security.2fa.deactivate');
    });

    // USER PROFILE ROUTES
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'index')->name('user.profile');
        Route::put('/profile/{user}', 'update')->name('user.profile.update');
        Route::post('/profile/project', 'updateProject')->name('user.profile.project');
        Route::get('/profile/edit', 'edit')->name('user.profile.edit');     
        Route::get('/profile/edit/defaults', 'editDefaults')->name('user.profile.defaults');     
        Route::get('/profile/edit/delete', 'showDelete')->name('user.profile.delete');     
        Route::post('/profile/edit/delete/{user}', 'accountDelete')->name('user.profile.delete.account');     
        Route::put('/profile/update/defaults/{user}', 'updateDefaults')->name('user.profile.update.defaults');     
    });      

    // USER TEAM MANAGEMENT ROUTES
    Route::controller(TeamController::class)->group(function() {
        Route::get('/team', 'index')->name('user.team');
        Route::get('/team/list', 'listUsers')->name('user.team.list');        
        Route::post('/team', 'store')->name('user.team.store');
        Route::get('/team/create', 'create')->name('user.team.create');        
        Route::get('/team/{user}/show', 'show')->name('user.team.show');
        Route::get('/team/{user}/edit', 'edit')->name('user.team.edit');
        Route::put('/team/{user}/update', 'update')->name('user.team.update');     
        Route::post('/team/leave', 'leave');
        Route::post('/team/delete', 'delete');
    }); 
    
    Route::controller(PaymentController::class)->group(function() {
        Route::post('/purchases/subscriptions/cancel', 'stopSubscription');
    });

    // USER PURCHASE HISTORY ROUTES
    Route::controller(PurchaseHistoryController::class)->group(function () {     
        Route::get('/purchases', 'index')->name('user.purchases');        
        Route::get('/purchases/show/{id}', 'show')->name('user.purchases.show');
        Route::get('/purchases/subscriptions', 'subscriptions')->name('user.purchases.subscriptions');   
    });

    // USER PRICING PLAN ROUTES
    Route::controller(PlanController::class)->group(function () {
        Route::get('/pricing/plans', 'index')->name('user.plans');
        Route::get('/pricing/plan/subscription/{id}', 'subscribe')->name('user.plan.subscribe')->middleware('unsubscribed'); 
        Route::get('/pricing/plan/one-time/', 'checkout')->name('user.prepaid.checkout'); 
    });      

    // USER PAYMENT ROUTES
    Route::controller(PaymentController::class)->group(function() {
        Route::post('/payments/pay/{id}', 'pay')->name('user.payments.pay')->middleware('unsubscribed');
        Route::post('/payments/pay/one-time/{type}/{id}', 'payPrePaid')->name('user.payments.pay.prepaid');
        Route::post('/payments/approved/razorpay', 'approvedRazorpayPrepaid')->name('user.payments.approved.razorpay');
        Route::get('/payments/approved/braintree', 'braintreeSuccess')->name('user.payments.approved.braintree');
        Route::get('/payments/approved/paddle', 'paddleSuccess'); 
        Route::get('/payments/approved', 'approved')->name('user.payments.approved');               
        Route::get('/payments/cancelled', 'cancelled')->name('user.payments.cancelled');
        Route::post('/payments/subscription/razorpay', 'approvedRazorpaySubscription')->name('user.payments.subscription.razorpay');
        Route::get('/payments/subscription/flutterwave', 'approvedFlutterwaveSubscription')->name('user.payments.subscription.flutterwave');
        Route::get('/payments/subscription/approved', 'approvedSubscription')->name('user.payments.subscription.approved');        
        Route::get('/payments/subscription/cancelled', 'cancelledSubscription')->name('user.payments.subscription.cancelled')->middleware('unsubscribed');
    });

    // USER PAYMENT ROUTES
    Route::controller(PromocodeController::class)->group(function() {
        Route::post('/payments/pay/promocode/prepaid/{id}', 'applyPromocodesPrepaid')->name('user.payments.promocodes.prepaid');
        Route::post('/payments/pay/promocode/subscription/{id}', 'applyPromocodesSubscription')->name('user.payments.promocodes.subscription');
    });

    // USER REFERRAL ROUTES
    Route::controller(ReferralController::class)->group(function() {
        Route::get('/referral', 'index')->name('user.referral');
        Route::post('/referral/settings', 'store')->name('user.referral.store');
        Route::get('/referral/gateway', 'gateway')->name('user.referral.gateway');
        Route::post('/referral/gateway', 'gatewayStore')->name('user.referral.gateway.store');
        Route::get('/referral/payouts', 'payouts')->name('user.referral.payout');
        Route::post('/referral/email', 'email')->name('user.referral.email');
        Route::get('/referral/payouts/create', 'payoutsCreate')->name('user.referral.payout.create');
        Route::post('/referral/payouts/store', 'payoutsStore')->name('user.referral.payout.store');
        Route::get('/referral/all', 'referrals')->name('user.referral.referrals');        
        Route::get('/referral/payouts/{id}/show', 'payoutsShow')->name('user.referral.payout.show');
        Route::get('/referral/payouts/{id}/cancel', 'payoutsCancel')->name('user.referral.payout.cancel');
        Route::delete('/referral/payouts/{id}/decline', 'payoutsDecline')->name('user.referral.payout.decline');
    });

    // USER INVOICE ROUTES
    Route::controller(PaymentController::class)->group(function() {
        Route::get('/payments/invoice/{order_id}/generate', 'generatePaymentInvoice')->name('user.payments.invoice');
        Route::get('/payments/invoice/{id}/show', 'showPaymentInvoice')->name('user.payments.invoice.show');
        Route::get('/payments/invoice/{order_id}/transfer', 'bankTransferPaymentInvoice')->name('user.payments.invoice.transfer');
    });

    // USER SUPPORT REQUEST ROUTES  
    Route::controller(UserSupportController::class)->group(function() { 
        Route::get('/support', 'index')->name('user.support');
        Route::post('/support', 'store')->name('user.support.store');
        Route::post('/support/delete', 'delete');
        Route::post('/support/response', 'response')->name('user.support.response');
        Route::get('/support/create', 'create')->name('user.support.create'); 
        Route::get('/support/{ticket_id}/show', 'show')->name('user.support.show');
         
    });      

    // USER NOTIFICATION ROUTES
    Route::controller(UserNotificationController::class)->group(function() {
        Route::get('/notification', 'index')->name('user.notifications');
        Route::get('/notification/{id}/show', 'show')->name('user.notifications.show');        
        Route::post('/notification/delete', 'delete');
        Route::get('/notifications/mark-all', 'markAllRead')->name('user.notifications.markAllRead');
        Route::get('/notifications/delete-all', 'deleteAll')->name('user.notifications.deleteAll');
        Route::post('/notifications/mark-as-read', 'markNotification')->name('user.notifications.mark');
    });    

    // USER SEARCH ROUTES
    Route::any('/search', [SearchController::class, 'index'])->name('search');
});