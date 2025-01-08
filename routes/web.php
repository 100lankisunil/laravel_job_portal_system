<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommanController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Pages
Route::get("/dashboard", [CommanController::class, "dashboardPage"])->name("dashboard")->middleware('can:isAdminOrEmployer');
Route::get("/", [CommanController::class, "homePage"])->name("home");
Route::get("/register", [CommanController::class, "registerPage"])->name("register");
Route::get("/login", [CommanController::class, "loginPage"])->name("login");


//Admin and Authentication Routes
Route::post("/authentication/register", [AdminController::class, "authRegiter"])->name("auth_regiter");
Route::post("/authentication/login", [AdminController::class, "authLogin"])->name("auth_login");
Route::get("/authentication/logout", [AdminController::class, "authLogout"])->name("auth_logout");
Route::get("/authentication/edit", [AdminController::class, "userEdit"])->name("editUser");
Route::post("/authentication/update", [AdminController::class, "userUpdate"])->name("updateUser");
Route::get("/authentication/delete", [AdminController::class, "userDelete"])->name("deleteUser");
Route::get("/authentication/alljobslist", [AdminController::class, "allJobsList"])->name("all_job_list");
Route::get("/authentication/applicationsslist", [AdminController::class, "allApplicationsList"])->name("all_applications_admin_list");



//Employers Routes
Route::post("/employer/postJob", [EmployerController::class, "postJob"])->name("postJob");
Route::get("/employer/joblist", [EmployerController::class, "manageJob"])->name("job_list");
Route::get("/jobs/edit", [EmployerController::class, "jobsEdit"])->name("editJobs");
Route::post("/jobs/update", [EmployerController::class, "jobsUpdate"])->name("updateJobs");
Route::get("/Jobs/delete", [EmployerController::class, "jobsDelete"])->name("deleteJobs");
Route::get("/employer/allapplicationsslist/{id}", [EmployerController::class, "allApplicationsList"])->name("all_applications_list");
Route::post("/employer/approve", [EmployerController::class, "approveApplication"])->name("approve");
Route::post("/employer/rejected", [EmployerController::class, "rejectApplication"])->name("rejected");
Route::post("/employer/pending", [EmployerController::class, "pendingApplication"])->name("pending");




//job seeker route
Route::get("jobseeker/findjobs", [UserController::class, "findJobs"])->name("findjobs");
Route::get("jobseeker/viewjob/{id}", [UserController::class, "viewJobPage"])->name("viewjob");
Route::post("jobseeker/applyjob", [UserController::class, "uploadResume"])->name("applyJob");
Route::get("jobseeker/joblist/{id}", [UserController::class, "joblistPage"])->name("joblist");
