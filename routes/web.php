<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('frontend.index');
});


Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::post('/supplier/create', 'SupplierCreate')->name('supplier.create');
    Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/update/{id}', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/destroy/{id}', 'SupplierDestroy')->name('supplier.destroy');

});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/all', 'CustomerAll')->name('customer.all');
    Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
    Route::post('/customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
    Route::post('/customer/update/{id}', 'CustomerUpdate')->name('customer.update');
    Route::get('/customer/destroy/{id}', 'CustomerDestroy')->name('customer.destroy');

});

Route::controller(HomeSliderController::class)->group(function () {
    Route::get('/home/slide', 'Homeslider')->name('home.slide');
    Route::post('/update/slide', 'UpdateSlider')->name('update.slider');


});


Route::controller(AboutController::class)->group(function () {
    Route::get('/home/about', 'AboutSlider')->name('home.about');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
    Route::get('/about', 'HomeAbout')->name('about.page');
    Route::get('/about/multi/image', 'AboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
});


Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout',  'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/admin/profile/edit', 'editProfile')->name('edit.profile');
    Route::post('/admin/profile/edit', 'storeProfile')->name('store.profile');
    Route::get('/change/password/', 'changePassword')->name('change.password');
    Route::post('/change/password/', 'updatePassword')->name('update.password');

}
);






Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';






