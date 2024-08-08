<?php

use App\Http\Controllers\Admin\{
    AppointmentsController,
    BranchesController,
    CategoriesController,
    DepartmentsController,
    GeneralSettingsController,
    HandRegistersController,
    InvoicesController,
    LocalNumbersController,
    PositionsController,
    ProductsController,
    ReportsController,
    RoomsController,
    StructureController,
    TicketsController,
    VendorsController,
    WarehousesController,
    UsersController,
    AdminAssetsRequestsController,
    MessageController
};

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\ITD\{
    ITDLeaderController,
    ITDAppointmentsController,
    ITDBranchesController,
    ITDDepartmentsController,
    ITDLocalNumbersController,
    ITDPositionsController,
    ITDReportsController,
    ITDRoomsController,
    ITDStructureController,
    ITDTicketsController,
    ITDUsersController,
    ITDAssetsRequestsController,
    ITDMessageController
};

use App\Http\Controllers\LogController;

use App\Http\Controllers\Support\{
    SupportController,
    SupportTicketsController,
    SupportMessageController,
    SupportUsersController
};

use App\Http\Controllers\User\{
    EmployeeAssetsRequestsController,
    EmployeeController,
    EmployeeReportsController,
    EmployeeReportsSubjectsController,
    EmployeeTicketController,
    EmployeInventoriesController,
    EmployeeMessageController,
    EmployeeBronsController
};

use App\Http\Controllers\User\TicketController;

use App\Http\Controllers\Warehouseman\{
    WarehousemanController,
    WHMAppointmentsController,
    WHMAssetsController,
    WHMCategoriesController,
    WHMHandRegistersController,
    WHMInvoicesController,
    WHMProductsController,
    WHMVendorsController,
    WHMWarehousesController,
    WHMMessageController
};

use App\Http\Controllers\Accountant\{
    AccountantController,
    ACCAppointmentsController,
    ACCAssetsController,
    ACCCategoriesController,
    ACCHandRegistersController,
    ACCInvoicesController,
    ACCProductsController,
    ACCVendorsController,
    ACCWarehousesController,
    ACCMessageController

};

use App\Http\Controllers\HR\{
    HrController,
    HrMessagesController,
    MeetingsController,
    AnnouncementsController,
    SurveysController
};

use Illuminate\Support\Facades\Route;

 if (env('APP_ENV') === 'production') {
     URL::forceScheme('https');
  }

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

/**
 * @return void
 */
Route::middleware(['logLastUserActivity'])->group(function () {

// ADMIN ROUTES
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'check_role:administrator'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::get('profile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
        Route::put('update-profile/{id}', [\App\Http\Controllers\HomeController::class, 'update_profile'])->name('update-profile');
        Route::resource('departments', DepartmentsController::class);
        Route::resource('branches', BranchesController::class);
        Route::resource('positions', PositionsController::class);
        Route::resource('rooms', RoomsController::class);
        Route::resource('vendors', VendorsController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('products', ProductsController::class);
        Route::resource('invoices', InvoicesController::class);
        Route::resource('hand-registers', HandRegistersController::class);
        Route::resource('appointments', AppointmentsController::class);
        Route::resource('tickets', TicketsController::class);

        Route::post('assign-ticket', [TicketsController::class, 'assign_ticket'])->name('assign-ticket');
        Route::post('get-ticket-details', [TicketsController::class, 'get_ticket_details'])->name('get-ticket-details');

        Route::resource('reports', ReportsController::class);

        Route::get('report-details/{date}', [ReportsController::class, 'report_details'])->name('report-details');

        Route::get('appointments/{id}/refund', [AppointmentsController::class, 'refund'])->name('appointments.refund');
        Route::get('structure', [StructureController::class, 'index'])->name('structures.index');
        Route::resource('users', UsersController::class);
        Route::resource('local-numbers', LocalNumbersController::class);
        Route::resource('warehouses', WarehousesController::class);
        Route::post('assets-requests/submit', [AdminAssetsRequestsController::class, 'submit'])->name('assets-requests.submit');
        Route::resource('assets-requests', AdminAssetsRequestsController::class);

        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/user-messages', [MessageController::class, 'fetchMessages'])->name('messages.fetch');

        /* -------------------- GENERAL SETTINGS ---------------------- */
        Route::get('general-settings', [GeneralSettingsController::class, 'index'])->name('general-settings.index');
        Route::post('update-general-settings', [GeneralSettingsController::class, 'update_general_settings'])->name('update-general-settings');
        Route::post('store-ticket-reasons', [GeneralSettingsController::class, 'store_ticket_reasons'])->name('store-ticket-reasons');
        Route::post('update-ticket', [TicketsController::class, 'update_ticket'])->name('update-ticket');

        Route::post('store-technical-users', [GeneralSettingsController::class, 'store_technical_users'])->name('store-technical-users');
        Route::post('store-roles', [GeneralSettingsController::class, 'store_roles'])->name('store-roles');
        Route::post('store-permissions', [GeneralSettingsController::class, 'store_permissions'])->name('store-permissions');
        Route::post('add-permission-to-role', [GeneralSettingsController::class, 'add_permission_to_role'])->name('add-permission-to-role');
        Route::post('update-user-report-receiver-data', [UsersController::class, 'update_user_report_receiver_data'])->name('update-user-report-receiver-data');

        Route::get('logs', [LogController::class, 'logs'])->name('logs');

        Route::post('get-branches-by-department', [BranchesController::class, 'get_branches_by_department'])->name('get-branches-by-department');
        Route::post('get-positions-by-branch', [PositionsController::class, 'get_positions_by_branch'])->name('get-positions-by-branch');
        Route::post('get-positions-by-management-board', [PositionsController::class, 'get_positions_by_management_board'])->name('get-positions-by-management-board');
        Route::post('get-positions-by-null-department', [PositionsController::class, 'get_positions_by_null_department'])->name('get-positions-by-null-department');
        Route::post('get-appointments-by-user', [TicketsController::class, 'get_inventories_by_user'])->name('get-appointments-by-user');
        Route::post('get-subcategories-by-main-category', [CategoriesController::class, 'get_subcategories_by_main_category'])->name('get-subcategories-by-main-category');
        Route::post('product-details', [ProductsController::class, 'details'])->name('product-details');
    });


// ITDLEADER ROUTES
    Route::prefix('itd-leader')->name('itd-leader.')->middleware(['auth', 'check_role:itd-leader'])->group(function () {
        Route::get('/dashboard', [ITDLeaderController::class, 'index'])->name('home');
        Route::get('profile', [ITDLeaderController::class, 'profile'])->name('profile');
        Route::put('update-profile/{id}', [ITDLeaderController::class, 'update_profile'])->name('update-profile');
        Route::post('assets-requests/submit', [ITDAssetsRequestsController::class, 'submit'])->name('assets-requests.submit');
        Route::resource('assets-requests', ITDAssetsRequestsController::class);
        Route::resource('departments', ITDDepartmentsController::class);
        Route::resource('branches', ITDBranchesController::class);
        Route::resource('positions', ITDPositionsController::class);
        Route::resource('rooms', ITDRoomsController::class);
        Route::resource('appointments', ITDAppointmentsController::class);
        Route::resource('tickets', ITDTicketsController::class);
        Route::resource('reports', ITDReportsController::class);
        Route::get('structure', [ITDStructureController::class, 'index'])->name('structures.index');
        Route::resource('users', ITDUsersController::class);
        Route::resource('local-numbers', ITDLocalNumbersController::class);

        Route::get('report-details/{date}', [ITDReportsController::class, 'report_details'])->name('itd-report-details');


        Route::get('/messages', [ITDMessageController::class, 'index'])->name('messages.index');
        Route::post('/send-message', [ITDMessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/user-messages', [MessageController::class, 'fetchMessages'])->name('messages.fetch');

    });


// WAREHOUSEMAN ROUTES
    Route::prefix('warehouseman')->name('warehouseman.')->middleware(['auth', 'check_role:warehouseman'])->group(function () {
        Route::get('/warehouseman', [WarehousemanController::class, 'index'])->name('warehouseman');
        Route::get('profile', [WarehousemanController::class, 'profile'])->name('profile');
        Route::put('update-profile/{id}', [WarehousemanController::class, 'update_profile'])->name('update-profile');
        Route::resource('vendors', WHMVendorsController::class);
        Route::resource('categories', WHMCategoriesController::class);
        Route::resource('products', WHMProductsController::class);
        Route::resource('invoices', WHMInvoicesController::class);
        Route::resource('hand-registers', WHMHandRegistersController::class);
        Route::resource('appointments', WHMAppointmentsController::class);
        Route::resource('warehouses', WHMWarehousesController::class);
        Route::get('appointments/{id}/refund', [WHMAppointmentsController::class, 'refund'])->name('appointments.refund');
        Route::post('get-subcategories-by-main-category', [CategoriesController::class, 'get_subcategories_by_main_category'])->name('get-subcategories-by-main-category');
        Route::post('product-details', [ProductsController::class, 'details'])->name('product-details');
        Route::resource('assets-requests', WHMAssetsController::class);
        Route::post('assets-requests/submit', [WHMAssetsController::class, 'submit'])->name('assets-requests.submit');

        Route::get('/messages', [WHMMessageController::class, 'index'])->name('messages.index');
        Route::post('/send-message', [WHMMessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/user-messages', [MessageController::class, 'fetchMessages'])->name('messages.fetch');


    });


// EMPLOYEE ROUTES
    Route::prefix('employee')->name('employee.')->middleware(['auth', 'check_role:employee'])->group(function () {
        Route::get('/home', [EmployeeController::class, 'index'])->name('home');
        Route::get('profile', [EmployeeController::class, 'profile'])->name('profile');
        Route::put('update-profile/{id}', [EmployeeController::class, 'update_profile'])->name('update-profile');
        Route::get('employee-appointments', [EmployeInventoriesController::class, 'index'])->name('employee-appointments');
        Route::resource('tickets', EmployeeTicketController::class);
        Route::resource('reports', EmployeeReportsController::class);
        Route::resource('assets-requests', EmployeeAssetsRequestsController::class);
        Route::post('update-ticket', [EmployeeTicketController::class, 'update_ticket'])->name('update-ticket');

        Route::post('update-reports-subjects', [EmployeeReportsSubjectsController::class, 'update_reports_subjects'])->name('update-reports-subjects');
        Route::post('create-reports-subjects', [EmployeeReportsSubjectsController::class, 'create_reports_subjects'])->name('create-reports-subjects');
        Route::post('delete-reports-subjects', [EmployeeReportsSubjectsController::class, 'delete_reports_subjects'])->name('delete-reports-subjects');
        Route::post('confirm-reports', [EmployeeReportsController::class, 'confirm_reports'])->name('confirm-reports');
        Route::get('report-list', [EmployeeReportsController::class, 'report_list'])->name('report-list');
        Route::post('update-report-status', [EmployeeReportsController::class, 'update_report_status'])->name('update-report-status');

        Route::get('/messages', [EmployeeMessageController::class, 'index'])->name('messages.index');
        Route::post('/send-message', [EmployeeMessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/user-messages', [EmployeeMessageController::class, 'fetchMessages'])->name('messages.fetch');
        Route::resource('/brons', EmployeeBronsController::class);
        Route::post('surveys/store', [EmployeeController::class,'submitSurvey'])->name('');

    });


// SUPPORT ROUTES
    Route::prefix('support')->name('support.')->middleware(['auth', 'check_role:support'])->group(function () {
        Route::get('/home', [SupportController::class, 'index'])->name('home');
        Route::get('profile', [SupportController::class, 'profile'])->name('profile');
        Route::put('update-profile/{id}', [SupportController::class, 'update_profile'])->name('update-profile');
        Route::resource('tickets', SupportTicketsController::class);
        Route::resource('support-users', SupportUsersController::class);
        Route::get('my-tickets', [SupportTicketsController::class, 'my_tickets'])->name('my-tickets');
        Route::post('accept-ticket', [SupportTicketsController::class, 'accept_ticket'])->name('accept-ticket');
        Route::post('update-ticket', [SupportTicketsController::class, 'update_ticket'])->name('update-ticket');
        Route::post('assign-ticket', [SupportTicketsController::class, 'assign_ticket'])->name('assign-ticket');
        Route::post('get-ticket-details', [SupportTicketsController::class, 'get_ticket_details'])->name('get-ticket-details');

        Route::get('/messages', [SupportMessageController::class, 'index'])->name('messages.index');
        Route::post('/send-message', [SupportMessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/user-messages', [SupportMessageController::class, 'fetchMessages'])->name('messages.fetch');
    });

// ACCOUNTANT ROUTES
    Route::prefix('accountant')->name('accountant.')->middleware(['auth', 'check_role:accountant'])->group(function () {
        Route::get('/home', [AccountantController::class, 'index'])->name('home');
        Route::get('profile', [AccountantController::class, 'profile'])->name('profile');
        Route::put('update-profile/{id}', [AccountantController::class, 'update_profile'])->name('update-profile');
        Route::resource('vendors', ACCVendorsController::class);
        Route::resource('categories', ACCCategoriesController::class);
        Route::resource('products', ACCProductsController::class);
        Route::resource('invoices', ACCInvoicesController::class);
        Route::resource('hand-registers', ACCHandRegistersController::class);
        Route::resource('appointments', ACCAppointmentsController::class);
        Route::resource('warehouses', ACCWarehousesController::class);
        Route::get('appointments/{id}/refund', [ACCAppointmentsController::class, 'refund'])->name('appointments.refund');
        Route::post('get-subcategories-by-main-category', [CategoriesController::class, 'get_subcategories_by_main_category'])->name('get-subcategories-by-main-category');
        Route::post('product-details', [ProductsController::class, 'details'])->name('product-details');
        Route::resource('assets-requests', ACCAssetsController::class);
        Route::post('assets-requests/submit', [ACCAssetsController::class, 'submit'])->name('assets-requests.submit');

        Route::get('/messages', [ACCMessageController::class, 'index'])->name('messages.index');
        Route::post('/send-message', [ACCMessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/user-messages', [MessageController::class, 'fetchMessages'])->name('messages.fetch');

    });
});

// HR ROUTES
Route::prefix('hr')->name('hr.')->middleware(['auth', 'check_role:hr'])->group(function () {
    Route::get('/home', [HrController::class, 'index'])->name('home');

    Route::get('profile', [HrController::class, 'profile'])->name('profile');
    Route::put('update-profile/{id}', [HrController::class, 'update_profile'])->name('update-profile');


    Route::get('/messages', [HrMessagesController::class, 'index'])->name('messages.index');
    Route::post('/send-message', [HrMessagesController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/{user}', [HrMessagesController::class, 'fetchMessages'])->name('messages.fetch');
    Route::resource('/meetings', MeetingsController::class);
    Route::resource('/announcements', AnnouncementsController::class);
    Route::resource('/surveys', SurveysController::class);
});

Route::post('/check-user-status', [LoginController::class, 'checkUserStatus'])->name('check.user.status');
Route::post('/search-user', [\App\Http\Controllers\SearchController::class, 'search_user'])->name('search-user');
Route::post('/update-user-notf-status', [\App\Http\Controllers\GeneralController::class, 'update_user_notf_status'])->name('update-user-notf-status');



