<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\FlatsController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\UserComplaintsController;
use App\Http\Controllers\UserBillsController;
use App\Http\Controllers\UserAnnouncementsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AdminController::class, 'showLogin'])->name('admin.login');

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
Route::post('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

Route::get('/admin/member', [AdminController::class, 'showMemberList'])->name('admin.member');
Route::post('/members', [AdminController::class, 'store'])->name('members.store');
Route::put('/members/{id}', [AdminController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [AdminController::class, 'destroy'])->name('members.destroy');
Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/allotments', [AdminController::class, 'showAllotments'])->name('admin.allotments');
Route::get('/admin/bill', [BillsController::class, 'showBillList'])->name('admin.bill');
Route::post('/bills', [BillsController::class, 'store'])->name('bills.store');
Route::put('/bills/{id}', [BillsController::class, 'update'])->name('bills.update');
Route::delete('/bills/{id}', [BillsController::class, 'destroy'])->name('bills.destroy');
Route::get('/bills', [BillsController::class, 'showBillList'])->name('bills.index');

Route::get('/admin/flat', [FlatsController::class, 'showFlatList'])->name('admin.flat');
Route::post('/flats', [FlatsController::class, 'store'])->name('flats.store');
Route::put('/flats/{id}', [FlatsController::class, 'update'])->name('flats.update');
Route::delete('/flats/{id}', [FlatsController::class, 'destroy'])->name('flats.destroy');
Route::get('/flats', [FlatsController::class, 'showFlatList'])->name('flats.index');

Route::get('/admin/visitor', [VisitorsController::class, 'showVisitorList'])->name('admin.visitor');
Route::post('/visitors', [VisitorsController::class, 'store'])->name('visitors.store');
Route::put('/visitors/{id}', [VisitorsController::class, 'update'])->name('visitors.update');
Route::delete('/visitors/{id}', [VisitorsController::class, 'destroy'])->name('visitors.destroy');
Route::get('/visitors', [VisitorsController::class, 'showVisitorList'])->name('visitors.index');

Route::get('/admin/announcement', [AnnouncementsController::class, 'showAnnouncementList'])->name('admin.announcement');
Route::post('/announcements', [AnnouncementsController::class, 'store'])->name('announcements.store');
Route::put('/announcements/{id}', [AnnouncementsController::class, 'update'])->name('announcements.update');
Route::delete('/announcements/{id}', [AnnouncementsController::class, 'destroy'])->name('announcements.destroy');
Route::get('/announcements', [AnnouncementsController::class, 'showAnnouncementList'])->name('announcements.index');

Route::get('/admin/complaint', [ComplaintsController::class, 'showComplaintList'])->name('admin.complaint');
Route::post('/complaints', [ComplaintsController::class, 'store'])->name('complaints.store');
Route::put('/complaints/{id}', [ComplaintsController::class, 'update'])->name('complaints.update');
Route::delete('/complaints/{id}', [ComplaintsController::class, 'destroy'])->name('complaints.destroy');
Route::get('/complaints', [ComplaintsController::class, 'showComplaintList'])->name('complaints.index');

//--------------------------------------User routes------------------------------------

Route::get('/user/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');

Route::get('/user/login', [UserController::class, 'showLogin'])->name('user.login');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login.submit');
Route::get('/user/register', [UserController::class, 'showRegister'])->name('user.register');
Route::post('/user/register', [UserController::class, 'register'])->name('user.register.submit');

Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
Route::post('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

Route::get('/user/flat', [FlatsController::class, 'showFlatList'])->name('user.flat');
Route::post('/flats', [FlatsController::class, 'store'])->name('flats.store');
Route::put('/flats/{id}', [FlatsController::class, 'update'])->name('flats.update');
Route::delete('/flats/{id}', [FlatsController::class, 'destroy'])->name('flats.destroy');
Route::get('/flats', [FlatsController::class, 'showFlatList'])->name('flats.index');

Route::get('/user/complaint', [UserComplaintsController::class, 'showComplaintList'])->name('user.complaint');
Route::post('/complaints', [UserComplaintsController::class, 'store'])->name('complaints.store');
Route::put('/complaints/{id}', [UserComplaintsController::class, 'update'])->name('complaints.update');
Route::delete('/complaints/{id}', [UserComplaintsController::class, 'destroy'])->name('complaints.destroy');
Route::get('/complaints', [UserComplaintsController::class, 'showComplaintList'])->name('complaints.index');

Route::get('/user/bill', [UserBillsController::class, 'showBillList'])->name('user.bill');
Route::post('/bills', [UserBillsController::class, 'store'])->name('bills.store');
Route::put('/bills/{id}', [UserBillsController::class, 'update'])->name('bills.update');
Route::delete('/bills/{id}', [UserBillsController::class, 'destroy'])->name('bills.destroy');
Route::get('/bills', [UserBillsController::class, 'showBillList'])->name('bills.index');

Route::get('/user/announcement', [UserAnnouncementsController::class, 'showAnnouncementList'])->name('user.announcement');
Route::post('/announcements', [UserAnnouncementsController::class, 'store'])->name('announcements.store');
Route::put('/announcements/{id}', [UserAnnouncementsController::class, 'update'])->name('announcements.update');
Route::delete('/announcements/{id}', [UserAnnouncementsController::class, 'destroy'])->name('announcements.destroy');
Route::get('/announcements', [UserAnnouncementsController::class, 'showAnnouncementList'])->name('announcements.index');


//http://127.0.0.1:8000/admin/profile