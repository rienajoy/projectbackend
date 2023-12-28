<?php



use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EventTypeController;
use App\Http\Controllers\Api\OfficerController;
use Illuminate\Support\Facades\Route;







    /* AuthController*/

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/officer (1)/OfficerDashboard', [AuthController::class, 'OfficerDashboard'])->name('officer (1)/OfficerDashboard');
    Route::get('admin/dashboard', [AuthController::class, 'AdminDashboard'])->name('admin/dashboard');



    
    /* AdminController*/

    Route::get('/get-officers', [AdminController::class, 'getOfficers']);
    Route::post('/officers/add', [AdminController::class, 'addOfficer']);
    Route::put('/officers/{userID}', [AdminController::class, 'updateOfficer']);
    Route::delete('/officers/{userID}', [AdminController::class, 'deleteOfficer']);
    


    /* EventTypeController*/

    Route::get('/eventTypes', [EventTypeController::class, 'index']);
    
    

    /* AdminController*/
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events/create', [EventController::class, 'create']);
    Route::delete('/events/{eventID}', [EventController::class, 'deleteEvent'])->name('events.deleteEvent');
    Route::delete('/events', [EventController::class, 'deleteAllEvents'])->name('events.deleteAllEvents');
    Route::put('/events/{eventID}', [EventController::class, 'updateEvent'])->name('events.updateEvent');
    Route::post('/events/{eventID}/join/{userID}', [EventController::class, 'joinEvent']);
    Route::post('/events/{eventID}/cancel-join/{userID}', [EventController::class, 'cancelJoinEvent']);
    Route::get('/events/{eventID}/attendees', [EventController::class, 'getEventAttendees']);
    Route::get('/events/{eventID}/decline-count', [EventController::class, 'getEventDeclinedAttendees']);

