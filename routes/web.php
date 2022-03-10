<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home-welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('/', 'HomeController@index')->name('admin.home');
        Route::namespace('Auth')->group(function(){
            Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
            Route::post('/login', 'LoginController@login');
            Route::post('logout', 'LoginController@logout')->name('admin.logout');
        });
    // admin language
    Route::get('/language','Languages\LanguageController@index')->name('admin.language');
    Route::post('/language-add','Languages\LanguageController@add_lang_fx')->name('admin.add-language');
    Route::get('/language-edit','Languages\LanguageController@edit_lang_fx')->name('admin.edit-language');
    Route::post('/language-update','Languages\LanguageController@update_lang_fx')->name('admin.update-language');
    Route::get('/language-del','Languages\LanguageController@del_lang_fx')->name('admin.del-language');
    Route::get('/language-change-status','Languages\LanguageController@change_status_lang_fx')->name('admin.change-status-language');
    // admin country
    Route::get('/country','Countries\CountryController@index')->name('admin.country');
    Route::post('/country-add','Countries\CountryController@add_country_fx')->name('admin.add-country');
    Route::get('/country-edit','Countries\CountryController@edit_country_fx')->name('admin.edit-country');
    Route::post('/country-update','Countries\CountryController@update_country_fx')->name('admin.update-country');
    Route::get('/country-del','Countries\CountryController@del_country_fx')->name('admin.del-country');
    Route::get('/country-change-status','Countries\CountryController@change_status_country_fx')->name('admin.change-status-country');
    // admin dashboard
    Route::get('/dashboard-country','HomeController@count_country_fx')->name('admin.count-country');
    Route::get('/dashboard-language','HomeController@count_language_fx')->name('admin.count-language');
    // admin tutor
    Route::get('/tutor','Tutors\TutorController@index')->name('admin.tutor');
    Route::post('/tutor-add','Tutors\TutorController@add_tutor_fx')->name('admin.add-tutor');
    Route::get('/tutor-edit','Tutors\TutorController@edit_tutor_fx')->name('admin.edit-tutor');
    Route::post('/tutor-update','Tutors\TutorController@update_tutor_fx')->name('admin.update-tutor');
    Route::get('/tutor-del','Tutors\TutorController@del_tutor_fx')->name('admin.del-tutor');
    Route::get('/tutor-change-status','Tutors\TutorController@change_status_tutor_fx')->name('admin.change-status-tutor');
    Route::get('/assign-tutor','Tutors\TutorController@assign_teacher_show_fx')->name('admin.assign-tutor-show');
    Route::get('/assign-tutor-calendarr','Tutors\AssignTutorCalendar@index')->name('admin.assign-tutor-calendar');
    # student of assigned courses
    Route::get('/course-assign-tutor-fx','Tutors\TutorController@course_assign_tutor_fx')->name('admin.course-assign-tutor-fx');
    Route::get('/onchange-assign-courses-fx','Tutors\TutorController@onchange_assign_courses_fx')->name('admin.onchange-assign-courses-fx');
    Route::get('/load-assign-tutor-on-course-fx','Tutors\TutorController@load_assign_tutor_on_course_fx')->name('admin.load-assign-tutor-on-course-fx');
    Route::post('/assign-tutor-final-submit','Tutors\TutorController@assign_tutor_final_submit_fx')->name('admin.assign-tutor-final-submit');

    // admin profile
    Route::get('/profile','Profile\ProfileController@index')->name('admin.profile');
    Route::post('/profile-submit','Profile\ProfileController@submitProfile')->name('admin.profile.submit');
    // admin student
    Route::get('/student','Student\StudentController@index')->name('admin.student');
    Route::get('/student-booking','Student\BookingController@index')->name('admin.student-booking');
    Route::get('/student-booking-getting-data','Student\BookingController@getting_fx')->name('admin.student-booking-getting-data');
    Route::get('/student-available-slot','Student\AvailableSlotController@index')->name('admin.student-available-slot');
    Route::get('/student-available-slot-time-interval','Student\BookingController@student_available_slot_time_interval_fx')->name('admin.student-available-slot-time-interval');
    Route::get('/student-booking-slot-delete','Student\BookingController@student_booking_slot_delete_fx')->name('admin.student-booking-slot-delete');
    Route::get('/student-booking-slot-change-status','Student\BookingController@student_booking_slot_change_status_fx')->name('admin.student-booking-slot-change-status');
        // available slot crud system
        Route::get('/student-available-slot-change-status','Student\AvailableSlotController@change_status_fx')->name('admin.student-available-slot-change-status');
        Route::post('/student-available-slot-add','Student\AvailableSlotController@add_fx')->name('admin.student-available-slot-add');
        Route::get('/student-available-slot-edit','Student\AvailableSlotController@edit_fx')->name('admin.student-available-slot-edit');
        Route::post('/student-available-slot-update','Student\AvailableSlotController@update_fx')->name('admin.student-available-slot-update');
        Route::get('/student-available-slot-delete','Student\AvailableSlotController@delete_fx')->name('admin.student-available-slot-delete');
        // end of available slot crud system
        // available slot interval crud system
        Route::get('/student-available-interval-slot','Student\AvailableSlotIntervalController@index')->name('admin.student-available-interval-slot');
        Route::post('/student-available-interval-slot-add-update','Student\AvailableSlotIntervalController@add_config_fx')->name('admin.student-available-interval-slot-add-update');
        // available slot interval crud system
    // admin course
    Route::get('/course','Course\CourseController@index')->name('admin.course');
    // admin sub course
    Route::post('/sub-course-add','Course\CourseController@add_course_fx')->name('admin.add-course');
    Route::get('/course-status-change','Course\CourseController@change_course_status_fx')->name('admin.course-status-change');
    Route::get('/course-del','Course\CourseController@course_del_fx')->name('admin.course-delete');
    Route::post('/course-update','Course\CourseController@course_update_fx')->name('admin.update-course');
    Route::get('/course-edit','Course\CourseController@course_edit_fx')->name('admin.edit-course');
    // admin age course
    Route::post('/course-age-add','Course\CourseController@add_age_of_course')->name('admin.course-age-add');
    Route::get('/course-age-edit','Course\CourseController@edit_age_of_course')->name('admin.course-age-edit');
    Route::post('/course-age-update','Course\CourseController@update_age_of_course')->name('admin.course-age-update');
    Route::get('/course-age-delete','Course\CourseController@delete_age_of_course')->name('admin.course-age-delete');
    // admin main course
    Route::post('/course-main-submit','Course\CourseController@add_main_of_course')->name('admin.course-main-add');
    Route::get('/course-main-edit','Course\CourseController@edit_main_of_course')->name('admin.course-main-edit');
    Route::post('/course-main-update','Course\CourseController@update_main_of_course')->name('admin.course-main-update');
    Route::get('/course-main-delete','Course\CourseController@delete_main_of_course')->name('admin.course-main-delete');
    // free trail
    Route::get('/free-trail','Freetrail\AdminFreeTrailController@index')->name('admin.show-free-trail');
    Route::post('/add-free-trail','Freetrail\AdminFreeTrailController@add_fx')->name('admin.add-admin-free-trail');
    Route::get('/delete-free-trail','Freetrail\AdminFreeTrailController@delete_fx')->name('admin.del-admin-free-trail');
    Route::get('/change-free-trail','Freetrail\AdminFreeTrailController@change_fx')->name('admin.change-admin-free-trail');
    Route::post('/update-free-trail','Freetrail\AdminFreeTrailController@update_fx')->name('admin.update-admin-free-trail');
    Route::get('/edit-free-trail','Freetrail\AdminFreeTrailController@edit_fx')->name('admin.edit-admin-free-trail');
        // config
        Route::get('/free-trail-config','Freetrail\ConfigController@index')->name('admin.show-config-free-trail');
        Route::post('/free-trail-config-add','Freetrail\ConfigController@add_config_fx')->name('admin.add-config-free-trail');
        Route::get('/free-trail-config-edit','Freetrail\ConfigController@edit_config_fx')->name('admin.edit-config-free-trail');
        Route::post('/free-trail-config-update','Freetrail\ConfigController@update_config_fx')->name('admin.update-config-free-trail');
    // Course Package
    Route::get('/course-package','Course\CoursePackageController@index')->name('admin.course-package');
    Route::post('/course-package-add','Course\CoursePackageController@add_course_package')->name('admin.add-course-package');
    Route::get('/course-package-course-status','Course\CoursePackageController@change_course_status_fx')->name('admin.change-course-package');
    Route::post('/course-package-delete','Course\CoursePackageController@delete_course_package')->name('admin.delete-course-package');
    Route::get('/course-package-edit','Course\CoursePackageController@edit_course_package')->name('admin.edit-course-package');
    Route::post('/course-package-update','Course\CoursePackageController@update_course_package')->name('admin.update-course-package');
    // Student Booking Details
    Route::get('/booking-details/{any_id}','Student\BookingDetailsController@index')->name('admin.booking-single-details');
    // contact
    Route::get('/contact','Others\Contact\ContactController@index')->name('admin.contact');
    Route::post('/contact-add-or-update','Others\Contact\ContactController@add_or_update_fx')->name('admin.add-or-update-contact');
    Route::get('/contact-edit','Others\Contact\ContactController@edit_fx')->name('admin.edit-contact');
    Route::get('/contact-del','Others\Contact\ContactController@del_fx')->name('admin.del-contact');
    // Message
    Route::get('/student-message','Message\StudentController@index')->name('admin.student-message');
    Route::get('/student-admin-message/{any}','Message\StudentController@show_student_admin_fx')->name('admin.student-admin-msg');
    Route::post('/student-admin-message-submit','Message\StudentController@show_student_admin_submit_fx')->name('admin.submit-admin-student-msg');
    //student message seen unseen
    Route::get('/student-message-unseen-seen','Message\StudentController@student_message_unseen_seen_fx')->name('admin.student-message-unseen-seen');
    // choose us
    Route::get('/choose-us','Others\ChooseUs\ChooseUsController@index')->name('admin.choose-us');
    Route::post('/choose-us-submit','Others\ChooseUs\ChooseUsController@submit_fx')->name('admin.cms.choose-us.submit');
    // subscribe
    Route::get('subscribe','Subscribe\SubscribeController@index')->name('admin.subscribe');
    // content management system
    Route::get('/contact-details','CMS\ContactDetailsController@index')->name('admin.contact-details');
    Route::post('/contact-details-submit','CMS\ContactDetailsController@contact_details_submit_fx')->name('admin.cms.contact-details.submit');
    Route::get('/courses','Others\Courses\CourseController@index')->name('admin.cms-courses');
    Route::post('/cms-main-courses','Others\Courses\CourseController@submit_fx')->name('admin.cms.main-course.submit');
    Route::get('/adult-child-teen-courses','Others\Courses\CourseController@adult_child_teen_courses_fx')->name('admin.cms-adult-child-teen-course');
    Route::get('/edit-adult-child-teen-courses/{id}','Others\Courses\CourseController@edit_adult_child_teen_courses_fx')->name('admin.cms-edit-adult-child-teen-course');
    Route::get('/edit-adult-child-teen-courses/{id}','Others\Courses\CourseController@edit_adult_child_teen_courses_fx')->name('admin.cms-edit-adult-child-teen-course');
    Route::get('/course-structure/{id}','Others\Courses\CourseController@course_structure_fx')->name('admin.cms-course-structure');
    Route::get('/edit-course-structure/{id}','Others\Courses\CourseController@edit_course_structure_fx')->name('admin.edit-cms-course-structure');
    Route::post('/course-structure-submit','Others\Courses\CourseController@course_structure_submit_fx')->name('admin.cms-course-structure-submit');
    Route::post('/edit-course-structure-submit','Others\Courses\CourseController@edit_course_structure_submit_fx')->name('admin.edit-cms-course-structure-submit');
    Route::post('/adult-child-teen-courses-submit','Others\Courses\CourseController@adult_child_teen_courses_submit_fx')->name('admin.cms-adult-child-teen-course-submit');
    Route::get('/blog','Others\Blog\BlogController@index')->name('admin.cms-blog');
    Route::get('/blog-details','Others\Blog\BlogController@blog_details_fx')->name('admin.cms-blog-details');
    Route::post('/cms-blog-submit','Others\Blog\BlogController@submit_fx')->name('admin.cms.blog.submit');
    Route::get('/home-cms','Others\HomeCms\CmsHomeController@index')->name('admin.home-cms');
    Route::post('/home-cms-submit','Others\HomeCms\CmsHomeController@submit_fx')->name('admin.cms.home.submit');
    // blogs delete
    Route::get('/blog-delete','Others\Blog\BlogController@delete_fx')->name('admin.blogs-del');
    // Testimonials
    Route::get('/testimonials','CMS\testimonials\CustomersController@index')->name('admin.testimonials');
    Route::post('/testimonials-submit','CMS\testimonials\CustomersController@submit_testimonials_fx')->name('admin.cms.student.comments.submit');
    Route::get('/testimonials-update/{id}','CMS\testimonials\CustomersController@update_testimonials_show')->name('admin.update-testimonials');
    Route::get('/testimonials-delete','CMS\testimonials\CustomersController@delete_testimonials_show')->name('admin.cms.student.comments.delete');
    // Order
    Route::get('/orders','Orders\OrderController@index')->name('admin.order.show');
    Route::get('/orders-details-single','Orders\OrderController@single_order_details')->name('admin.order.single.show');
});

Route::prefix('/')->group(function(){
    Route::get('/','Front\Home\HomeController@index')->name('satirtha.home');
    Route::get('/account','Front\Register\RegisterController@pre_reg_page_fx')->name('satirtha.preReg');
    Route::get('/registration/{reg_type}','Front\Register\RegisterController@child_reg_page_fx')->name('satirtha.childRegPage');
    Route::post('/child-registration-submit','Front\Register\RegisterController@child_reg_submit_fx')->name('satirtha.childRegSubmit');
    Route::get('/child-activation-link/{activeLinkChild}','Front\Register\RegisterController@child_activation_fx')->name('satirtha.child-active-link');

    Route::get('/course','Front\Dashboard\Student\CourseController@course_page_fx')->name('satirtha.show-course-page');
    Route::get('/booking','Front\Dashboard\Student\BookingController@booking_page_fx')->name('satirtha.show-booking-page');
    Route::get('/message','Front\Dashboard\Student\MessageController@message_page_fx')->name('satirtha.show-message-page');

    // course page
    Route::get('/all-course-show','Front\Dashboard\Student\CourseController@show_all_courses_fx')->name('satirtha.show-all-courses');
    Route::get('/rest-pay-course-view-modal','Front\Dashboard\Student\CourseController@rest_pay_course_modal_view_fx')->name('satirtha.rest-pay-course-view-modal');
    Route::get('/course-rest-pay-submit','Front\Dashboard\Student\CourseController@course_rest_pay_submit_fx')->name('satirtha.course-rest-pay-submit');
    Route::get('/course-paypal-rest-pay-show-page','Front\Dashboard\Student\CourseController@course_rest_pay_paypal_show_page_fx')->name('satirtha.course-paypal-rest-pay-show-page');
    Route::get('/rest-paypal-payment-processing/{any}/{anything}','Front\Dashboard\Student\CourseController@payment_process_fx')->name('satirtha.rest-paypal-payment-processing');
    Route::get('/rest-paypal-success/{any}','Front\Dashboard\Student\CourseController@payment_success_process_fx')->name('satirtha.rest-paypal-payment-success-processing');
    Route::get('/rest-paypal-error','Front\Dashboard\Student\CourseController@payment_error_process_fx')->name('satirtha.rest-paypal-payment-error-processing');

    // my account page
    Route::get('/my-account','Front\Dashboard\Student\MyAccountController@myaccount_page_fx')->name('satirtha.show-my-account-page');
    Route::post('/update-my-account','Front\Dashboard\Student\MyAccountController@update_myaccount_submit_fx')->name('satirtha.update-my-account');
    Route::post('/update-my-account-password','Front\Dashboard\Student\MyAccountController@update_myaccount_password_submit_fx')->name('satirtha.update-my-account-password');
    Route::post('/update-my-account-email','Front\Dashboard\Student\MyAccountController@update_myaccount_email_submit_fx')->name('satirtha.update-my-account-email');
    Route::post('/delete-my-account','Front\Dashboard\Student\MyAccountController@delete_myaccount_submit_fx')->name('satirtha.delete-my-account');

    // message
    Route::get('/message-contact-student-teacher-course','Front\Dashboard\Student\MessageController@student_to_teacher_contact_course_fx')->name('satirtha.message-contact-student-teacher-course');
    Route::post('/student-to-teacher-message-submit','Front\Dashboard\Student\MessageController@student_to_teacher_message_submit_fx')->name('satirtha.student-to-teacher-message-submit');
    Route::get('/load-teacher-message-fx','Front\Dashboard\Student\MessageController@laod_teacher_all_message_fx')->name('satirtha.load-teacher-message-fx');
    Route::get('/send-message-teacher-submit','Front\Dashboard\Student\MessageController@send_message_teacher_submit_fx')->name('satirtha.send-message-teacher-submit');
    Route::get('/get-teacher-message-fx','Front\Dashboard\Student\MessageController@get_all_teacher_student_sub_msg_panel_data_fx')->name('satirtha.get-teacher-message-fx');

    Route::get('/message-calender','Front\Dashboard\Student\MessageController@message_calender_page_fx')->name('satirtha.show-message-calender');
    Route::get('/message-time-on-calender','Front\Dashboard\Student\MessageController@message_calender_time_page_fx')->name('satirtha.show-time-using-date');
    Route::post('/message-free-trail-class-booking','Front\Dashboard\Student\MessageController@message_free_trail_class_booking_submit_fx')->name('satirtha.free-trail-class-booking');
    Route::get('/message-trail-student-subject-choose','Front\Dashboard\Student\MessageController@message_trail_student_subject_choose_fx')->name('satirtha.message-trail-student-subject-choose');
    Route::get('/message-trail-student-subject-choose','Front\Dashboard\Student\MessageController@message_trail_student_subject_choose_fx')->name('satirtha.message-trail-student-subject-choose');
    Route::get('/checking-total-messages','Front\Dashboard\Student\MessageController@checking_total_messages_fx')->name('satirtha.checking-total-message-fx');
    Route::post('/message-submit','Front\Dashboard\Student\MessageController@message_submit_fx')->name('satirtha.message-submit');
    Route::get('/student-admin-msg','Front\Dashboard\Student\MessageController@studentAdminSection_fx')->name('satirtha.student-admin-msg-fx');
    Route::get('/student-admin-msg-submitting','Front\Dashboard\Student\MessageController@student_admin_msg_submitting_fx')->name('satirtha.student-admin-msg-submitting-fx');

    // booking
    Route::get('/booking-price-list','Front\Dashboard\Student\BookingController@booking_price_list_fx')->name('satirtha.price-list-for-booking');
    Route::get('/change-package-for-booking-slot','Front\Dashboard\Student\BookingController@change_booking_price_list_fx')->name('satirtha.change-package-for-booking-slot');
    Route::get('/get-end-client-choose-time','Front\Dashboard\Student\BookingController@get_end_client_choose_time_fx')->name('satirtha.get-end-client-choose-time');
    Route::post('/submit-booking-from-student','Front\Dashboard\Student\BookingController@booking_from_student_submit_fx')->name('satirtha.submit-booking-from-student');
    Route::get('/package-checking-for-days','Front\Dashboard\Student\BookingController@package_checking_for_days_fx')->name('satirtha.package-checking-for-days');
    Route::get('/show-student-available-calender','Front\Dashboard\Student\BookingController@student_booking_calenders_fx')->name('satirtha.show-student-available-calender');
    Route::get('/show-student-available-calender-time-checked-date','Front\Dashboard\Student\BookingController@student_booking_calender_time_page_fx')->name('satirtha.show-student-available-calender-time-checked-date');
    Route::get('/booking-class-previous-time-found','Front\Dashboard\Student\BookingController@booking_class_previous_time_found_fx')->name('satirtha.booking-class-previous-time-found');
    Route::get('/booking-available-tenure-fx','Front\Dashboard\Student\BookingController@available_tenure_fx')->name('satirtha.booking-available-tenure');
    Route::get('/full-pay-tenure-checking','Front\Dashboard\Student\BookingController@full_pay_tenure_checking_fx')->name('satirtha.full-pay-tenure-checking');

    // contact
    Route::get('/contact','Front\Others\Contact\ContactController@index')->name('satirtha.contact');
    Route::post('/contact-mail-send','Front\Others\Contact\ContactController@send_mail_fx')->name('satirtha.contact-mail-send');

    // why choose us
    Route::get('/choose-us','Front\Others\ChooseUs\ChooseUsController@index')->name('satirtha.choose-us');

    // payment with paypal
    Route::get('/paypal-payment-processing/{any}/{anything}','Front\Dashboard\Student\PaypalPaymentController@payment_process_fx')->name('satirtha.paypal-payment-processing');
    Route::get('/paypal-success/{any}','Front\Dashboard\Student\PaypalPaymentController@payment_success_process_fx')->name('satirtha.paypal-payment-success-processing');
    Route::get('/paypal-error','Front\Dashboard\Student\PaypalPaymentController@payment_error_process_fx')->name('satirtha.paypal-payment-error-processing');

    // content management system
    Route::get('/load-footer-and-contact-details-fx','Front\CMS\ContactDetailsController@index')->name('satirtha.load-footer-and-contact-details-fx');
    Route::get('/courses','Front\Others\Courses\CourseController@index')->name('satirtha.cms-courses');
    Route::get('/adult-courses','Front\Others\Courses\CourseController@adult_courses_fx')->name('satirtha.cms-adult-courses');
    Route::get('/teen-courses','Front\Others\Courses\CourseController@teen_courses_fx')->name('satirtha.cms-teen-courses');
    Route::get('/child-courses','Front\Others\Courses\CourseController@child_courses_fx')->name('satirtha.cms-child-courses');
    Route::get('/blog','Front\Others\Blog\BlogController@index')->name('satirtha.cms-blog');
    Route::get('/blog-details/{id}','Front\Others\Blog\BlogController@blog_details_fx')->name('satirtha.cms-blog-details');
    // content management system

    // others page
    Route::get('/terms-and-condition','Front\Others\TermsConditionController@index')->name('satirtha.terms');
    Route::get('/privacy-policy','Front\Others\PrivacyPolicyController@index')->name('satirtha.policy');
    Route::get('/legal-info','Front\Others\LegalNoticeController@index')->name('satirtha.legal');
    // end of others page

    // forgot password
    Route::get('/forgot-password','Front\Others\ForgotPasswordController@index')->name('satirtha.forgot-password');
});

Route::prefix('/teacher')->group(function(){
    Route::get('/calender','Front\Teacher\TeacherController@calender_fx')->name('satirtha.teacher-calender');
    Route::get('/message','Front\Teacher\TeacherController@teacher_message_fx')->name('satirtha.teacher-message');
    Route::get('/share-zoom-link','Front\Teacher\TeacherController@teacher_class_schedule_fx')->name('satirtha.teacher-class-schedule');
    Route::get('/schedule','Front\Teacher\TeacherController@teacher_schedule_fx')->name('satirtha.teacher-schedule');
    Route::get('/my-account','Front\Teacher\TeacherController@teacher_my_account_fx')->name('satirtha.teacher-my-account');
    Route::post('/my-account-details-submit','Front\Teacher\TeacherController@teacher_my_account_details_submit_fx')->name('satirtha.teacher-my-account-details-submit');
    Route::post('/teacher-calender-day-date-submit','Front\Teacher\TeacherController@teacher_calender_day_date_submit_fx')->name('satirtha.teacher-calender-day-date-submit');
    # Calender
    Route::post('/calender','Front\Teacher\TeacherController@addEvent')->name('satirtha.teacher-calender-add');
    # Calender
    # Route::get('/teacher-calender-day-date','Front\Teacher\CalenderAllFunctionController@calender_day_to_date_fx')->name('satirtha.teacher-calender-day-date');
    # Route::get('/teacher-calender-day-date-submit','Front\Teacher\CalenderAllFunctionController@calender_day_to_date_submit_fx')->name('satirtha.teacher-calender-day-date-submit');
    Route::get('/load-schedule-data-fx','Front\Teacher\TeacherController@load_schedule_data_fx')->name('satirtha.load-schedule-data-fx');
    Route::get('/load-course-share-zoom-link','Front\Teacher\TeacherController@load_course_share_zoom_link_fx')->name('satirtha.load-course-share-zoom-fx');
    Route::get('/course-zoom-share-fx','Front\Teacher\TeacherController@checking_load_course_for_zoom_link_fx')->name('satirtha.course-zoom-share-fx');
    Route::post('/send-zoom-link-fx','Front\Teacher\TeacherController@send_zoom_link_fx')->name('satirtha.send-zoom-link-fx');
    # assign tutor / course
    Route::get('/assign-tutor-message-assign-course-tutor','Front\Teacher\TutorMessageController@show_assign_course')->name('satirtha.tutor-message-assign-course-tutor');
    Route::post('/tutor-course-submit-fx','Front\Teacher\TutorMessageController@tutor_course_submit_fx')->name('satirtha.tutor-course-submit-fx');
    Route::get('/load-sent-message-fx','Front\Teacher\TutorMessageController@load_sent_message_fx')->name('satirtha.load-sent-message-fx');
    Route::get('/load-inbox-message-fx','Front\Teacher\TutorMessageController@load_inbox_message_fx')->name('satirtha.load-inbox-message-fx');
    Route::get('/load-all-message-fx','Front\Teacher\TutorMessageController@load_all_message_fx')->name('satirtha.load-all-message-fx');
    Route::get('/get-teacher-student-message-fx','Front\Teacher\TutorMessageController@get_all_teacher_student_sub_msg_panel_data_fx')->name('satirtha.get-teacher-student-message-fx');
    Route::get('/send-message-teacher-student-submit','Front\Teacher\TutorMessageController@send_message_teacher_student_submit_fx')->name('satirtha.send-message-teacher-student-submit');
});

# subscribe
Route::prefix('/subscribe')->group(function(){
    Route::POST('/subscribe-submit','Front\Subscribe\SubscribeController@index')->name('satirtha.subscribe');
});

# teachers log & reg
    Route::get('/teacher/login', 'Front\Teacher\Auth\LoginController@showLoginForm')->name('teacher.login');
    Route::post('/teacher/login', 'Front\Teacher\Auth\LoginController@login');
    Route::post('/teacher/logout', 'Front\Teacher\Auth\LoginController@logout')->name('teacher.logout');
    # event
    Route::get('events', 'EventController@index')->name('events.index');
    Route::post('events', 'EventController@addEvent')->name('events.add');
# end of teachers log & reg
