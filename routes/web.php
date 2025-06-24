<?php


use App\Http\Controllers\Action\DivingApplicationController as ActionDivingApplicationController;
use App\Http\Controllers\Action\RentalActionController;
use App\Http\Controllers\Action\StudentController;
use App\Http\Controllers\Action\VesselScheduleController as ActionVesselScheduleController;
use App\Http\Controllers\DiversLogController;
use App\Http\Controllers\DivingApplicationController;
use App\Http\Controllers\DivingLessonController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentRentalItemController;
use App\Http\Controllers\Navigation\AdminController;
use App\Http\Controllers\Navigation\EmployeeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\Report\DivingReportController;
use App\Http\Controllers\Report\Equipment\ReportController;
use App\Http\Controllers\Report\EquipmentReportController;
use App\Http\Controllers\Report\RentalReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\VesselInspectionController;
use App\Http\Controllers\VesselInspectionDetailController;
use App\Http\Controllers\VesselScheduleController;
use App\Http\Controllers\VesselServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\LandingController;
use App\Http\Controllers\Navigation\RentalClientController;
use App\Http\Controllers\Navigation\StudentController as NavigationStudentController;
use App\Http\Controllers\Navigation\SurveyClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);

Route::get('/home', function () {
    return view('landing.home');
})->name('home');

Route::get('/about', function () {
    return view('landing.about');
})->name('about');

Route::get('/service', function () {
    return view('landing.services');
})->name('service');


Route::get('/operation_survey', function () {
    return view('landing.operation.survey');
})->name('survey');


Route::get('/operation_rental', function () {
    return view('landing.operation.rental');
})->name('rental');

Route::get('/operation_lesson', function () {
    return view('landing.operation.lesson');
})->name('diving_lesson');

Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');

// Route::get('/vessel_rep', function () {
//     return view('reports\equipments.inspection_report');
// })->name('vessel_report');




Route::get('/sign-in', function () {
    return view('auth.sign-in');
})->middleware('guest')->name('signin');

Route::get('/sign-up', function () {
    return view('auth.sign-up');
})->middleware('guest')->name('signup');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/employees', [AdminController::class, 'employees'])->name('admin.employees');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/surveys', [AdminController::class, 'surveys'])->name('admin.surveys');
    Route::get('/rentals', [AdminController::class, 'rentals'])->name('admin.rentals');

    // Route::get('/equipments_item', [AdminController::class, 'items'])->name('admin.items');
    // Route::get('/equipments_rentals', [AdminController::class, 'rentals'])->name('admin.rentals');


    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::post('/messages/send', [AdminController::class, 'sendSms'])->name('admin.send.sms');
;

    Route::prefix('equipments')->group(function () {
        Route::get('/list', [AdminController::class, 'equipments'])->name('admin.items');
        Route::get('/rentals', [AdminController::class, 'rentals'])->name('admin.rent');
    });

    Route::prefix('diving')->group(function () {
        Route::get('/lesson', [AdminController::class, 'lesson'])->name('admin.lesson');

        Route::prefix('students')->group(function () {
            Route::get('/list', [AdminController::class, 'students'])->name('admin.students_list');
            Route::get('/{student}/applications', [StudentController::class, 'getApplications']);
        });

        Route::prefix('applications')->group(function () {
            Route::get('/list', [AdminController::class, 'applications'])->name('admin.applications');
            Route::post('/{applicationID}/{action}', [ActionDivingApplicationController::class, 'handleAction'])->name('admin.handleActionApplication');
            Route::get('/{application}/divers-logs', [StudentController::class, 'getDiversLogs']);
            Route::get('/{application}/divers-log', [DivingApplicationController::class, 'viewDiversLog']);
        });
    });

    Route::prefix('vessels')->group(function () {
        Route::get('/list', [AdminController::class, 'vessels'])->name('admin.vessels');
        Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
        Route::prefix('schedules')->group(function () {
            Route::get('/list', [AdminController::class, 'schedules'])->name('admin.schedules');
            Route::get('/{scheduleID}/{action}', [ActionVesselScheduleController::class, 'handleAction'])->name('admin.handleActionSchedule');
        });
        Route::prefix('inspection')->group(function () {
            Route::get('/list', [AdminController::class, 'inspection'])->name('admin.inspection');
            Route::get('/{scheduleID}', [AdminController::class, 'vesselSchedule'])->name('admin.vesselSchedule');
            Route::get('/{scheduleID}/reports', [AdminController::class, 'vesselInspectionReport'])->name('admin.vesselInspectionReport');
            Route::get('/{scheduleID}/sendVesselInspectionReport', [AdminController::class, 'sendVesselInspectionReport'])->name('admin.sendVesselInspectionReport');
        });
    });

    Route::prefix('rentals')->group(function () {
        Route::get('{rental}/items', [RentalActionController::class, 'rentalItems']);
        Route::post('{rental}/return', [RentalActionController::class, 'submitReturn']);
        Route::post('/confirm', [RentalActionController::class, 'confirmRental'])->name('admin.rentals.confirm');
        Route::post('{rental}/action', [RentalActionController::class, 'handle'])->name('admin.rentals.action');
    });

    Route::prefix('reports')->group(function () {
        Route::get('diving', [DivingReportController::class, 'index'])->name('admin.reports.diving');
        Route::get('diving/pdf', [DivingReportController::class, 'exportPdf'])->name('admin.reports.diving.pdf');

        Route::get('equipment', [EquipmentReportController::class, 'index'])->name('admin.reports.equipment');
        Route::get('equipment/pdf', [EquipmentReportController::class, 'exportPdf'])->name('admin.reports.equipment.pdf');

        Route::get('rental', [RentalReportController::class, 'index'])->name('admin.reports.rental');
        Route::get('rental/pdf', [RentalReportController::class, 'exportPdf'])->name('admin.reports.rental.pdf');
    });
});


Route::prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');

    Route::prefix('equipments')->group(function () {
        Route::get('/list', [EmployeeController::class, 'equipments'])->name('employee.equipments');
        Route::get('/rentals', [EmployeeController::class, 'rentals'])->name('employee.rentals');
    });

    Route::prefix('diving')->group(function () {
        Route::get('/lesson', [EmployeeController::class, 'lesson'])->name('employee.lesson');

        Route::prefix('students')->group(function () {
            Route::get('/list', [EmployeeController::class, 'students'])->name('employee.students');
            Route::get('/{student}/applications', [StudentController::class, 'getApplications']);
        });

        Route::prefix('applications')->group(function () {
            Route::get('/list', [EmployeeController::class, 'applications'])->name('employee.applications');
            Route::post('/{applicationID}/{action}', [ActionDivingApplicationController::class, 'handleAction'])->name('employee.handleActionApplication');
            Route::get('/{application}/divers-logs', [StudentController::class, 'getDiversLogs']);
            Route::get('/{application}/divers-log', [DivingApplicationController::class, 'viewDiversLog']);
        });
    });

    Route::prefix('vessels')->group(function () {
        Route::get('/list', [EmployeeController::class, 'vessels'])->name('employee.vessels');
        Route::get('/services', [EmployeeController::class, 'services'])->name('employee.services');
        Route::prefix('schedules')->group(function () {
            Route::get('/list', [EmployeeController::class, 'schedules'])->name('employee.schedules');
            Route::get('/{scheduleID}/{action}', [ActionVesselScheduleController::class, 'handleAction'])->name('employee.handleActionSchedule');
        });
        Route::prefix('inspection')->group(function () {
            Route::get('/list', [EmployeeController::class, 'inspection'])->name('employee.inspection');
            Route::get('/{scheduleID}', [EmployeeController::class, 'vesselSchedule'])->name('employee.vesselSchedule');
            Route::get('/{scheduleID}/reports', [EmployeeController::class, 'vesselInspectionReport'])->name('employee.vesselInspectionReport');
            Route::get('/{scheduleID}/sendVesselInspectionReport', [EmployeeController::class, 'sendVesselInspectionReport'])->name('employee.sendVesselInspectionReport');
            // Route::get('/{scheduleID}/{action}', [ActionVesselScheduleController::class, 'handleAction'])->name('employee.handleActionSchedule');
        });
    });

    Route::prefix('rentals')->group(function () {
        Route::get('{rental}/items', [RentalActionController::class, 'rentalItems']);
        Route::post('{rental}/return', [RentalActionController::class, 'submitReturn']);
        Route::post('/confirm', [RentalActionController::class, 'confirmRental'])->name('rentals.confirm');
        Route::post('{rental}/action', [RentalActionController::class, 'handle'])->name('employee.rentals.action');
    });

    Route::prefix('reports')->group(function () {
        Route::get('diving', [DivingReportController::class, 'index'])->name('reports.diving');
        Route::get('diving/pdf', [DivingReportController::class, 'exportPdf'])->name('reports.diving.pdf');

        Route::get('equipment', [EquipmentReportController::class, 'index'])->name('reports.equipment');
        Route::get('equipment/pdf', [EquipmentReportController::class, 'exportPdf'])->name('reports.equipment.pdf');

        Route::get('rental', [RentalReportController::class, 'index'])->name('reports.rental');
        Route::get('rental/pdf', [RentalReportController::class, 'exportPdf'])->name('reports.rental.pdf');
    });
});

Route::prefix('survey_client')->group(function () {
    Route::get('/dashboard', [SurveyClientController::class, 'dashboard'])->name('survey_client.dashboard');
    Route::get('/services', [SurveyClientController::class, 'services'])->name('survey_client.services');
    Route::get('/vessels', [SurveyClientController::class, 'vessels'])->name('survey_client.vessels');
    Route::get('/vessel-schedules', [SurveyClientController::class, 'vesselSchedules'])->name('survey_client.vesselSchedules');
    Route::get('/vessel-inspections', [SurveyClientController::class, 'vesselInspections'])->name('survey_client.vesselInspections');
});

Route::prefix('student')->group(function () {
    Route::get('/dashboard', [NavigationStudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/divingLesson', [NavigationStudentController::class, 'divingLesson'])->name('student.divingLesson');

    Route::prefix('divingApplications')->group(function () {
        Route::get('/', [NavigationStudentController::class, 'divingApplications'])->name('student.divingApplications');
        Route::post('/{applicationID}/{action}', [ActionDivingApplicationController::class, 'handleAction'])->name('student.handleActionApplication');
        Route::get('/employeeDiversLogs', [NavigationStudentController::class, 'employeeDiversLogs'])->name('student.employeeDiversLogs');
        Route::get('/{application}/divers-log', [DivingApplicationController::class, 'viewDiversLog']);
    });
});

Route::prefix('rental_client')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('rental_client.dashboard');

    Route::prefix('/equipments')->group(function () {
        Route::get('/divingGear', [RentalClientController::class, 'divingGear'])->name('rental_client.divingGear');
        Route::get('/breathingApparatus', [RentalClientController::class, 'breathingApparatus'])->name('rental_client.breathingApparatus');
        Route::get('/diveInstruments', [RentalClientController::class, 'diveInstruments'])->name('rental_client.diveInstruments');
        Route::get('/communicationSafetyTools', [RentalClientController::class, 'communicationSafetyTools'])->name('rental_client.communicationSafetyTools');
        Route::get('/specializedSurveyEquipment', [RentalClientController::class, 'specializedSurveyEquipment'])->name('rental_client.specializedSurveyEquipment');
    });

    Route::prefix('rentals')->group(function () {
        Route::get('', [RentalClientController::class, 'rentals'])->name('rental_client.rentals');
        Route::get('{rental}/items', [RentalActionController::class, 'rentalItems']);
        Route::post('{rental}/return', [RentalActionController::class, 'submitReturn']);
        Route::post('/confirm', [RentalActionController::class, 'confirmRental'])->name('rental_client.confirm');
        Route::post('{rental}/action', [RentalActionController::class, 'handle'])->name('employee.rentals_client.action');
    });
});

// User Routes
Route::resource('users', UserController::class);

// Equipment Routes
Route::resource('equipments', EquipmentController::class);

// Rental Routes
Route::resource('rentals', RentalController::class);
Route::resource('equipment-rental', EquipmentRentalItemController::class);

// Vessel Routes
Route::resource('vessels', VesselController::class);
Route::resource('services', VesselServiceController::class);
Route::resource('vessel-schedules', VesselScheduleController::class);
Route::resource('vessel-inspections', VesselInspectionController::class);
Route::resource('vessel-inspections-details', VesselInspectionDetailController::class);

// Diving Lessons Routes
Route::resource('diving-lessons', DivingLessonController::class);
Route::resource('divers-logs', DiversLogController::class);

// Diving Applications Routes
Route::resource('diving-applications', DivingApplicationController::class);
