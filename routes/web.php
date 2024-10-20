<?php


use App\Http\Controllers\WebController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\savedJobController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Author\AuthorCompanyController;
use App\Http\Controllers\Author\AuthorJobApplicationController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminCompanyCategoryController;
use App\Http\Controllers\Admin\AdminCompanyController;

use Illuminate\Support\Facades\Route;



//Public routes
Route::get('/', [WebController::class, 'index'])->name('home.index');
Route::get('/job/{job}', [WebController::class, 'job'])->name('post.show');
Route::get('employer/{employer}', [WebController::class, 'employer'])->name('employer.show');

//Return vue page
Route::get('/search', [WebController::class, 'jobs'])->name('job.index');

Route::get('/faqs', [WebController::class, 'faqs'])->name('home.faqs');

// Contact Us
Route::get('/contact', [WebController::class, 'contactForm'])->name('contact');
Route::post('/contact', [WebController::class, 'mail'])->name('contact.submit');

// For FAQ 


//Auth routes
Route::middleware('auth')->prefix('account')->group(function () {
  //Every auth routes AccountController
  Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
  Route::get('overview', [AccountController::class, 'overview'])->name('account.overview');
  Route::get('deactivate', [AccountController::class, 'deactivateView'])->name('account.deactivate');
  Route::delete('delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
  Route::get('change-password', [AccountController::class, 'changePasswordView'])->name('account.changePassword');
  Route::put('change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');


  //User Role routes
  Route::group(['middleware' => ['role:user|author|admin']], function () {
    //SavedJobs
    Route::get('my-saved-jobs', [savedJobController::class, 'index'])->name('account.savedJob.index');
    Route::get('my-saved-jobs/{id}', [savedJobController::class, 'store'])->name('account.savedJob.store');
    Route::delete('my-saved-jobs/{id}', [savedJobController::class, 'destroy'])->name('account.savedJob.destroy');

    //Apply jobs
    Route::get('apply-job', [AccountController::class, 'applyJobView'])->name('account.applyJob');
    Route::post('apply-job', [AccountController::class, 'applyJob'])->name('account.applyJob');
    Route::get('my-applied-jobs', [AccountController::class, 'appliedJob'])->name('account.appliedJob');
    
    //Become employer
    Route::get('become-employer', [AccountController::class, 'becomeEmployerView'])->name('account.becomeEmployer');
    Route::post('become-employer', [AccountController::class, 'becomeEmployer'])->name('account.becomeEmployer');
  });

});

//Author Role Routes
Route::group(['prefix' => 'author', 'middleware' => ['auth', 'role:author|admin']], function () {
  Route::get('author-section', [AuthorController::class, 'authorSection'])->name('author.authorSection');
  Route::get('/job-list', [AuthorJobApplicationController::class, 'jobList'])->name('author.viewAllJob');
  Route::get('job-application/{id}', [AuthorJobApplicationController::class, 'show'])->name('author.jobApplication.show');
  Route::delete('job-application', [AuthorJobApplicationController::class, 'destroy'])->name('author.jobApplication.destroy');
  Route::get('job-application', [AuthorJobApplicationController::class, 'index'])->name('author.jobApplication.index');

  Route::get('post/create', [AuthorPostController::class, 'create'])->name('author.post.create');
  Route::post('/post', [AuthorPostController::class, 'store'])->name('author.post.store');
  Route::get('post/{post}/edit', [AuthorPostController::class, 'edit'])->name('author.post.edit');
  Route::put('post/{post}', [AuthorPostController::class, 'update'])->name('author.post.update');
  Route::delete('post/{post}', [AuthorPostController::class, 'destroy'])->name('author.post.destroy');
  Route::get('view-all-jobs', [AuthorPostController::class, 'viewAllJobs'])->name('author.viewAllJobs');


  Route::get('company/create', [AuthorCompanyController::class, 'create'])->name('author.company.create');
  Route::post('company', [AuthorCompanyController::class, 'store'])->name('author.company.store');
  Route::get('company/edit', [AuthorCompanyController::class, 'edit'])->name('author.company.edit');
  Route::put('company/{id}', [AuthorCompanyController::class, 'update'])->name('author.company.update');
  Route::delete('company', [AuthorCompanyController::class, 'destroy'])->name('author.company.destroy');

});

//Admin Role Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
  Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

  // for users
  Route::get('view-all-users', [AdminController::class, 'viewAllUsers'])->name('admin.user.viewAllUsers');
  Route::post('view-all-users/{id}', [AdminUserController::class, 'destroyUser'])->name('admin.user.destroy');

  Route::get('category/{category}/edit', [AdminCompanyCategoryController::class, 'edit'])->name('admin.category.edit');
  Route::post('category', [AdminCompanyCategoryController::class, 'store'])->name('admin.category.store');
  Route::put('category/{id}', [AdminCompanyCategoryController::class, 'update'])->name('admin.category.update');
  Route::delete('category/{id}', [AdminCompanyCategoryController::class, 'destroy'])->name('admin.category.destroy');

  // for Authors list by Admin
  Route::get('/authors', [AdminAuthorController::class, 'index'])->name('admin.author.index');
  Route::get('/authors/create', [AdminAuthorController::class, 'create'])->name('admin.author.create');
  Route::post('/authors', [AdminAuthorController::class, 'store'])->name('admin.author.store');
  Route::get('/authors/{id}/edit', [AdminAuthorController::class, 'edit'])->name('admin.author.edit');
  Route::put('/authors/{id}', [AdminAuthorController::class, 'update'])->name('admin.author.update');
  Route::delete('/authors/{id}', [AdminAuthorController::class, 'destroy'])->name('admin.author.delete');
  Route::get('/authors/{id}/manage-company', [AdminAuthorController::class, 'manageCompany'])->name('admin.author.manageCompany');

  // For Company Routes
  Route::get('/authors/{id}/company/create', [AdminCompanyController::class, 'create'])->name('admin.company.create');
  Route::post('/authors/{id}/company', [AdminCompanyController::class, 'store'])->name('admin.company.store');
  Route::get('/authors/{id}/company/edit', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
  Route::put('/authors/{id}/company', [AdminCompanyController::class, 'update'])->name('admin.company.update');
  Route::delete('/authors/{id}/company', [AdminCompanyController::class, 'destroy'])->name('admin.company.destroy');

  // For Frequently Asked Question
});
