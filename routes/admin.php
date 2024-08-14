<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseCurriculamController;
use App\Http\Controllers\Admin\CourseManagentController;
use App\Http\Controllers\Admin\CourseOutlineController;
use App\Http\Controllers\Admin\CourseProjectController;
use App\Http\Controllers\Admin\CourseQueryController;
use App\Http\Controllers\Admin\CourseScheduleController;
use App\Http\Controllers\Admin\DynamicCssController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\LearnMoreController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\NewsTrendController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TermsConditionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseResourceController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('admin.dashboard');
// });

// Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {

//     Route::get('login', [AuthenticatedSessionController::class, 'create'])
//         ->name('login');

//     Route::post('login', [AuthenticatedSessionController::class, 'store']);

//     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//         ->name('password.request');

//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//         ->name('password.email');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//         ->name('password.reset');

//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//         ->name('password.store');
// });

Route::middleware('guest:admin')->group(function () {

    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('admin.password.request');

    Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('admin.password.email');

    Route::get('admin/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('admin.password.reset');

    Route::post('admin/reset-password', [NewPasswordController::class, 'store'])
        ->name('admin.password.store');
});

// Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin'])->prefix(LaravelLocalization::setLocale() . '/admin')->name('admin.')->group(function () {

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('check-password', [PasswordController::class, 'checkPassword'])->name('checkPassword');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['verified'])->name('dashboard');

    Route::resources(
        [
            'role' => RoleController::class,
            'permission' => PermissionController::class,
            'email-settings' => EmailSettingController::class,
            'faq' => FaqController::class,

            // Created By Ashiquzzaman
            'terms-and-condition' => TermsConditionController::class,
            'privacy-policy' => PrivacyPolicyController::class,
        ],

        ['except' => ['show']]
    );

    //Registration
    Route::get('/registration', [RegistrationController::class, 'registration'])->name('all.registration');

    Route::get('/pending-registration', [RegistrationController::class, 'registrationPending'])->name('registration.pending');
    Route::get('/paid-registration', [RegistrationController::class, 'registrationPaid'])->name('registration.paid');

    Route::get('/registration-delete/{id}', [RegistrationController::class, 'DeleteRegistration'])->name('delete.registration');

    Route::resources(
        [
            'user' => UserController::class, //done
            'user-management' => UserManagementController::class,
            'admin-management' => AdminController::class,
            'newsletters' => NewsletterController::class,
            'contacts' => ContactController::class,
            'news-trend' => NewsTrendController::class,
            'learnmore' => LearnMoreController::class,

            //Created By Ashiquzzaman
            'course' => CourseController::class,
            'course_content' => CourseContentController::class,
            'course_curriculam' => CourseCurriculamController::class,
            // 'course_curriculum_content' => CourseCurriculumContentController::class,
            'coupon' => CouponController::class,
            'course_query' => CourseQueryController::class,

            'course_resource' => CourseResourceController::class,

            'course_management' => CourseManagentController::class,
            'course_project' => CourseProjectController::class,
            'course_outline' => CourseOutlineController::class,
            'course_schedule' => CourseScheduleController::class,
            'about' => AboutUsController::class,

            'course_category' => CourseCategoryController::class,
            'service' => ServiceController::class,
            'industry' => IndustryController::class,
            'homepage' => HomepageController::class,
            'course_section' => CourseSectionController::class,
            'faq_category' => FaqCategoryController::class,

            'common_banner' => BannerController::class,

        ],
    );

    Route::get('active-mail-configuration', [EmailSettingController::class, 'activeMailConfiguration'])->name('active.mail.configuration');
    Route::put('email-settings', [EmailSettingController::class, 'emailUpdateOrCreate'])->name('email.settings.updateOrCreate');
    Route::post('send-test-mail', [EmailSettingController::class, 'sendTestMail'])->name('send.test.mail');

    Route::post('email-settings/toggle-status/{id}', [EmailSettingController::class, 'toggleStatus'])->name('email-settings.toggle-status');

    Route::get('/backup', [Controller::class, 'downloadBackup']);

    Route::get('role/{roleId}/give-permission', [RoleController::class, 'givePermission'])->name('role.give-permission');
    Route::patch('role/{roleId}/give-permission', [RoleController::class, 'storePermission'])->name('role.store-permission');

    Route::get('log', [LogController::class, 'index'])->name('log.index');
    Route::get('log/{id}', [LogController::class, 'show'])->name('log.show');
    Route::delete('log/{id}', [LogController::class, 'destroy'])->name('log.destroy');
    Route::get('log/download/{id}', [LogController::class, 'download'])->name('log.download');

    Route::get('activity_logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    Route::get('activity_logs/{activity_log}', [ActivityLogController::class, 'show'])->name('activity_logs.show');
    Route::delete('activity_logs/{activity_log}', [ActivityLogController::class, 'destroy'])->name('activity_logs.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'updateOrcreateSetting'])->name('settings.updateOrCreate');

    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::put('/about-us', [AboutUsController::class, 'updateOrcreateAboutUs'])->name('about-us.updateOrCreate');

    Route::controller(DynamicCssController::class)->group(function () {
        Route::get('/dynamic-css', 'index')->name('css.index');
        Route::put('/dynamic-css/{id}/update', 'update')->name('css.update');
    });
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/category/ajax/{course_section_id}', 'GetCategory');
});

Route::controller(CourseResourceController::class)->group(function () {
    Route::get('/course/ajax/{course_id}', 'GetCourseData');
});

// Terms & Condition Status
Route::get('/terms-and-condition/{id}/inactive', [TermsConditionController::class, 'inactive'])->name('terms-and-condition.inactive');
Route::get('/terms-and-condition/{id}/active', [TermsConditionController::class, 'active'])->name('terms-and-condition.active');

// Privacy & Policy
Route::get('/privacy/{id}/inactive', [PrivacyPolicyController::class, 'inactive'])->name('privacy-policy.inactive');
Route::get('/privacy/{id}/active', [PrivacyPolicyController::class, 'active'])->name('privacy-policy.active');

// Course Curriculum Video Delete
// Route::post('/update/video', [CourseCurriculumContentController::class, 'UpdateVideo'])->name('update.video');
// Route::get('/delete/video/{id}', [CourseCurriculumContentController::class, 'DeleteVideo'])->name('delete.video');

// Curricum Video Section
Route::post('/update/video/curriculum', [CourseCurriculamController::class, 'UpdateVideoCurriculum'])->name('update.video.curriculum');
Route::get('/delete/multi-video/{id}', [CourseCurriculamController::class, 'DeleteVideoCurriculum'])->name('delete.multi-video');
Route::post('/store/video/curriculum', [CourseCurriculamController::class, 'StoreVideoCurriculum'])->name('store.new.video');

// Route::post('/store/file/curriculum', [CourseCurriculamController::class, 'StoreFileCurriculum'])->name('store.new.file');

// Curricum Video Section
Route::post('/update/file/curriculum', [CourseCurriculamController::class, 'UpdateFileCurriculum'])->name('update.file.curriculum');
Route::get('/delete/multi-file/{id}', [CourseCurriculamController::class, 'DeleteFileCurriculum'])->name('delete.multi-file');
Route::post('/store/file/curriculum', [CourseCurriculamController::class, 'StoreFileCurriculum'])->name('store.new.file');

//Payment Type
Route::post('/course-registration/update/{id}', [RegistrationController::class, 'registrationUpdate'])->name('course-registration.update');

Route::post('/paid-course-registration/update/{id}', [RegistrationController::class, 'registrationCoursePaid'])->name('paid-course-registration.update');
