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

// Route::get('/', function () {
//     return view('users.home');
// });


Route::get('/', 'UserController@welcome')->name('welcome');
Route::get('/send-payment', 'PaymentController@sendPaymentToseller')->name('sendPaymentToseller');

//Route::get('/test', 'SellerController@getYourGyms');
Route::get('/sellerlogin', 'SellerController@sellerlogin')->name('sellerlogin');
Route::get('/partner-with-us', 'SellerController@partner_with_Us')->name('partnerwithus');

Route::get('/partnerwithus', 'SellerController@partner_with_Us')->name('partner');
Route::get('/trainer', 'TrainemygymrController@trainer')->name('trainer');
Route::get('/trainer/list', 'TrainerController@trainerListing')->name('trainerlisting');

Route::post('/register-as-seller', 'SellerController@registerasseller')->name('registerasseller');

Route::post('/sellerLoginPost', 'UserController@sellerLoginPost')->name('sellerLoginPost');
Route::post('/findGymNearByYou', 'SellerController@findGymNearByYou')->name('findGymNearByYou');
Route::post('/findGymNearByYouLocateMe', 'SellerController@findGymNearByYouLocateMe')->name('findGymNearByYouLocateMe');
Route::post('/findTrainerNearByMyLocation', 'SellerController@findTrainerNearByMyLocation')->name('findTrainerNearByMyLocation');


Route::get('/yourgyms/{location}/{cat_id}', 'UserController@gymsNearYou')->name('gymsNearYou');
Route::get('/yourtrainers/{location}/{cat_id}', 'UserController@trainersNearYou')->name('trainersNearYou');

Route::get('/mygym/{id}', 'UserController@gymsDetail')->name('gymdetail');
Route::get('/mygym/packages/{pack_id}', 'UserController@gymPackageDetail')->name('packdetailetail');


/**************** Product listing *******************/
Route::post('/find-available-Stores', 'SellerController@findStoresNearByMyLocation')->name('findStoresNearByMyLocation');
Route::get('/product-stores/{location}/{cat_id}', 'UserController@availableStores')->name('availableStores');
Route::get('/product/detail/', 'UserController@productDetail')->name('productDetail');

/**************** Product listing *******************/

/*************trainer ****************/
Route::get('/trainerlogin', 'TrainerController@trainerlogin')->name('trainerlogin');
Route::get('/trainerwithus', 'TrainerController@trainerwithus')->name('trainerwithus');
Route::post('/otp-verify', 'TrainerController@OtpVerifyOnPhone')->name('OtpVerifyOnPhone');

Route::post('/register-as-trainer', 'TrainerController@registerastrainer')->name('trainerasseller');
Route::post('/trainer-login-post', 'TrainerController@trainerLoginPost')->name('trainerLoginPost');

Route::group(['middleware' => ['role:freelancer'],'prefix' => 'trainer'], function () {
    Route::get('/dashboard', 'TrainerController@dashboard')->name('trainerDashboard');
    Route::get('/packages', 'TrainerController@packagesList')->name('trainerpackagesList');
    Route::get('/add-package', 'TrainerController@packagesAdd')->name('trainerpackagesAdd');
    Route::post('/addPackagePost', 'TrainerController@addPackagePost')->name('addPackagebytrainerpost');
    Route::post('/delete-package', 'TrainerController@deleteMyPackage')->name('deleteMyPackage');

    Route::get('/change-password', 'TrainerController@changepassword')->name('trainerchangepassword');
    Route::get('/orders', 'TrainerController@getmyorder')->name('trainergetmyorder');
    Route::get('/setting', 'TrainerController@generalsettings')->name('generalsettings');
    Route::post('/setting/update/{trainer_id}', 'TrainerController@updateGeneralSettings')->name('updateGeneralSettingspost');
    Route::patch('packages/{package}/update', ['as' => 'trainer-packages.update', 'uses' => 'TrainerController@updatePackage']);

    Route::get('package/{package}',  ['as' => 'trainer-package.edit', 'uses' => 'TrainerController@editPackage']);
    Route::get('/customer', 'TrainerController@getMyCustomer')->name('getTrainerCustomer');
     Route::get('/wallet', 'TrainerController@getmywallet')->name('trainerWallet');

    /************ Assign Nutrition ********************/
    Route::get('/nutritions', 'TrainerController@getNutrition')->name('getAllNutrition');
    Route::get('/assign-nutrition','TrainerController@assignNutrition')->name('assignNutrition');
    Route::post('/assign-nutrition','TrainerController@assignNutritionToUser')->name('nutritionpost');
    Route::post('/delete-nutrition','TrainerController@deleteNutrition')->name('deleteNutrition');
    /************ Assign Workout ********************/
    Route::get('/workouts', 'TrainerController@getWorkouts')->name('getAllWorkouts');
    Route::get('/assign-workout','TrainerController@assignWorkout')->name('assignWorkout');
    Route::post('/assign-workout','TrainerController@assignWorkoutToUser')->name('workoutpost');
    Route::post('/delete-workout','TrainerController@deleteWorkouts')->name('deleteWorkouts');
    /****************** Store Functionality ***********/
    Route::get('/product-list', 'TrainerController@getAllProductList')->name('getAllProductList');
    Route::get('/my-store', 'TrainerController@getMyStore')->name('myStoreInfo');
    Route::post('/my-store', 'TrainerController@createStoreRequest')->name('StoreRequest');
    Route::get('/add-product', 'TrainerController@addNewProduct')->name('addNewProduct');
    Route::post('/add-product', 'TrainerController@addNewProductPost')->name('productPost');
    Route::get('/edit-product/{product_id}', 'TrainerController@updateProduct')->name('updateProduct');
    Route::post('/edit-product/{product_id}', 'TrainerController@updateProduct')->name('updateProductPost');
    Route::post('/delete-product','TrainerController@deleteProduct')->name('deleteProduct');
    /***************** Attandance system ******************/
   // Route::get('/attendance', 'TrainerController@getAttendance')->name('getAttendance');
    Route::get('/attendance-management', 'TrainerController@checkattendance')->name('checkattendance');
    Route::post('/mark-attendance', 'TrainerController@SubmitUserAttandance')->name('markuserattandance');
});


/****************** Cart route *************/
Route::get('/check-out', 'UserController@mygymcheckout')->name('checkout');
//Route::get('/add-to-cart/{pack_id}', 'UserController@addToCart')->name('addToCart');
Route::post('/add-to-cart', 'UserController@newAddToCart')->name('addToCart');


Route::delete('remove-from-cart', 'UserController@remove');
Route::delete('remove-all-cart', 'UserController@removeAll');

/******************** user Sign up *************************/
Route::get('/signin', 'UserController@signin')->name('signin');
Route::get('/signup', 'UserController@signup')->name('signup');
Route::get('/forgot-password', 'UserController@forgotPassword')->name('forgotpassword');

Route::post('/user-sign-up', 'UserController@usersignupost')->name('usersignup');
Route::get('/logout', 'UserController@logout')->name('logout');

/****************** profile *********************/
Route::get('/profile/', 'UserController@profile')->name('myprofile');
Route::get('/profile/order', 'UserController@myorders')->name('order');
Route::get('/profile/notification', 'UserController@notification')->name('notification');
Route::get('/profile/order/{id}', 'UserController@orderDetails');
Route::get('/profile/reset-password', 'UserController@resetPassword')->name('userchangepassword');
Route::post('/profile/updateAuthUserPassword', 'ProfileController@updateAuthUserPassword')->name('updateAuthUserPassword');
Route::post('update_avatar', 'ProfileController@changeProfilePicture');
/****************** Paypal payment gateway ***************/

//Route::view('/checkout', 'paypal.checkout-page');
Route::post('/makepayment', 'PaymentController@createPayment')->name('create-payment');
Route::get('/confirm', 'PaymentController@confirmPayment')->name('confirm-payment');
Route::get('/adaptive-paypal', 'PaypalController@createPayment')->name('adaptive-paypal-payment');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/home', 'SellerController@getGeocode')->name('getGeocode');


//Auth::routes();

/*Route::group(['middleware' => ['auth']], function() {
   	Route::resource('roles','RoleController');
    //Route::resource('users','UserController');
    Route::resource('products','ProductController');

});*/

Route::group(['middleware' => ['role:seller'],'prefix' => 'seller'], function () {
    Route::get('/dashboard', 'SellerController@sellerDashboard')->name('sellerDashboard');
    Route::get('/packages', 'SellerController@packagesList')->name('packages');
    Route::get('/add-package', 'SellerController@packagesAdd')->name('add-package');
    Route::post('/addPackagePost', 'SellerController@addPackagePost')->name('addPackagePost');
    //Route::get('/package-edit/{id}', 'SellerController@editPackage')->name('package-edit');
    Route::get('package/{package}',  ['as' => 'package.edit', 'uses' => 'SellerController@editPackage']);
    Route::patch('packages/{package}/update', ['as' => 'packages.update', 'uses' => 'SellerController@updatePackage']);
    Route::get('/delete-package/{id}', 'SellerController@deletePackage');
    Route::get('/gym-detail', 'SellerController@updateMyGymDetail')->name('updateseller');
    Route::patch('/gym-detail/update', ['as' => 'gym.update', 'uses' =>'SellerController@updateMyGymPost']);
    Route::get('/myCustomer', 'SellerController@getMyCustomer')->name('getmycustmer');
    Route::get('/change-password', 'SellerController@changepassword')->name('changepassword');
    Route::get('/orders', 'SellerController@getmyorder')->name('getmyorder');
    Route::get('/orders/{order_id}', 'SellerController@getmyordersummary')->name('getmyordersummary');
    Route::get('/my-wallet', 'SellerController@getmywallet')->name('getmywallet');

    /************ Assign Nutrition ********************/
    Route::get('/nutritions', 'SellerController@getAllNutrition')->name('getNutrition');
    Route::get('/assign-nutrition','SellerController@assignNutritionToCustomer')->name('assignNutritionUser');
    Route::post('/assign-nutrition','SellerController@assignNutritionPost')->name('assignutritionpost');
    Route::post('/delete-nutrition','SellerController@deleteAssignedNutrition')->name('deleteAssignNutrition');
    /************ Assign Workout ********************/
    Route::get('/workouts', 'SellerController@getAllWorkouts')->name('getWorkouts');
    Route::get('/assign-workout','SellerController@assignWorkoutToNewUSer')->name('assignWorkoutnewUser');
    Route::post('/assign-workout','SellerController@assignWorkoutPost')->name('assignWorkoutPost');
    Route::post('/delete-workout','SellerController@deleteAssignedWorkouts')->name('deleteAssignWorkouts');
    /****************** Store Functionality ***********/
    Route::get('/product-list', 'SellerController@getMyProduct')->name('getMyProductList');
    Route::get('/my-store', 'SellerController@getStore')->name('getMyStore');
    Route::post('/my-store', 'SellerController@createStoreRequest')->name('StorePostRequest');
    Route::get('/add-product', 'SellerController@addProduct')->name('addProduct');
    Route::post('/add-product', 'SellerController@addNewProductPost')->name('NewProductPost');
    Route::get('/edit-product/{product_id}', 'SellerController@updateProduct')->name('updateProduct');
    Route::post('/edit-product/{product_id}', 'SellerController@updateProduct')->name('updateProPost');
    Route::post('/delete-product','SellerController@deleteMyProduct')->name('deleteMyProduct');
    /***************** Attandance system ******************/
   // Route::get('/attendance', 'TrainerController@getAttendance')->name('getAttendance');
    Route::get('/attendance-management', 'SellerController@checkCustomerAttendance')->name('checkUserAttendance');
    Route::post('/mark-attendance', 'SellerController@markUserAttandance')->name('markattandance');

});

/******************************* Admin Section *****************************/
Route::get('/administrator', 'AdminController@login');

Route::group(['middleware' => ['role:admin'],'prefix' => 'admin'], function () {


Route::get('/dashboard', 'AdminController@dashboard')->name('adminDashboard');
Route::get('/all-users', 'AdminController@getallusers')->name('getallusers');

Route::get('/all-sellers', 'AdminController@getAllSellers')->name('getAllSellers');
Route::get('/approved-seller', 'AdminController@approvedSeller')->name('approvedSeller');
Route::get('/unapproved-sellers', 'AdminController@UnapprovedSeller')->name('UnapprovedSeller');
Route::get('/seller/{seller_id}', 'AdminController@getSellerDetails');
Route::get('/seller/edit/{seller_id}', 'AdminController@editSellerDetails');

Route::patch('/seller/{seller_id}/update', 'AdminController@updateSellerDetailsPost')->name('updateSellerDetailsPost');
/******************* Trainer **********************/
Route::get('/all-trainers', 'AdminController@getAllTrainers')->name('getAllTrainers');
Route::get('/approved-trainers', 'AdminController@approvedTrainers')->name('approvedTrainers');
Route::get('/unapproved-trainers', 'AdminController@UnapprovedTrainers')->name('UnapprovedTrainers');
Route::get('/trainer/edit/{trainer_id}', 'AdminController@getTrainerDetail');

Route::post('/trainer/{trainer_id}/update', 'AdminController@updateTrainerPost')->name('updateTrainerPost');
Route::get('/add-trainer', 'AdminController@addtrainer')->name('addTrainer');
Route::post('/trainer/add/post', 'AdminController@addTrainerPost')->name('addTrainerPost');



Route::get('/all-packages', 'AdminController@getAllPackages')->name('getAllPackages');
Route::get('/add-package', 'AdminController@AddPackageByAdministrator')->name('AddPackageByAdmin');
Route::post('/addnew-package', 'AdminController@addnewPackagePost')->name('addnewPackagePost');

Route::get('/approved-packages', 'AdminController@getApprovePackages')->name('getApprovePackages');
Route::get('/unapproved-packages', 'AdminController@getUnapprovePackages')->name('getUnapprovePackages');
Route::get('/package/{pack_id}', 'AdminController@getPackageDetail')->name('getPackdetail');
Route::get('/package/edit/{package_id}', 'AdminController@editPackageDetails');

Route::patch('/package/{package_id}/update', 'AdminController@updatePackageDetailsPost')->name('updatePackageDetailsPost');


Route::post('/updatepackage', 'AdminController@changePackageStatus');

/********************* Store functionality ********************/
Route::get('/all-stores', 'AdminController@getAllStores')->name('getAllStores');
Route::get('/approved-stores', 'AdminController@getApprovedStores')->name('getApprovedStores');
Route::get('/unapproved-stores', 'AdminController@getUnapprovedStores')->name('getUnapprovedStores');
Route::get('/store/{store_id}', 'AdminController@getStoreDetail')->name('getStoreDetail');
Route::post('/change-store-status', 'AdminController@changeStoreStatus');
/*********************** Product functionality *******************/

Route::get('/all-products', 'AdminController@getAllProducts')->name('getAllProducts');
Route::get('/approved-products', 'AdminController@getApprovedProducts')->name('getApprovedProducts');
Route::get('/unapproved-products', 'AdminController@getUnapprovedProducts')->name('getUnapprovedProducts');
Route::get('/product/{product_id}', 'AdminController@getProductDetail')->name('getProductDetail');
Route::get('/product/edit/{product_id}', 'AdminController@editProductDetails');
Route::patch('/product/{product_id}/update', 'AdminController@updateProductDetailsPost')->name('updateProductDetailsPost');
Route::post('/change-product-status', 'AdminController@changeProductStatus');
Route::get('/add-product', 'AdminController@addProductByAdmin')->name('addProductByAdmin');
Route::post('/add-product-post', 'AdminController@addProductByAdminPost')->name('addProductByAdminPost');

/*****************************************************************/
Route::get('/change-password', 'AdminController@adminChangePassword')->name('adminChangePassword');
Route::post('/updateSeller', 'AdminController@changeSellerStatus');
Route::post('/updateTrainer', 'AdminController@updateTrainerStatus');
Route::post('/deactive-seller', 'AdminController@DeactivateSeller');


Route::get('/order/{order_id}', 'AdminController@orderSummary')->name('orderSummary');

Route::get('/all-orders', 'AdminController@getAllOrders')->name('getAllOrders');
Route::get('/all-payment', 'AdminController@getAllPayment')->name('getAllPayment');
Route::get('/success-order', 'AdminController@getCompletedOrder')->name('getCompletedOrder');
Route::get('/fail-orders', 'AdminController@getFailedOrder')->name('getFailedOrder');

Route::get('/all-promotions', 'AdminController@getAllpromotions')->name('getAllPromotions');
Route::get('/add-promotion', 'AdminController@addnewPromotion')->name('addnewPromotion');
Route::post('/add-promotion-post', 'AdminController@addnewPromotionPost')->name('addnewPromotionPost');
Route::get('promotions/{promo_id}/edit', ['as' => 'promotion.edit', 'uses' => 'AdminController@updatePromotion']);
Route::post('promotions/{promo_id}/update', ['as' => 'promotion.updatepost', 'uses' => 'AdminController@updatePromotionpost']);

Route::get('promotions/{promo_id}/delete', ['as' => 'promo.delete', 'uses' => 'AdminController@deletePromotion']);

Route::get('/general-settings', 'AdminController@settings')->name('generalSettigs');
Route::patch('/general-settings/update', ['as' => 'setting.update', 'uses' =>'AdminController@updateGymSettingPost']);


/********************* Start Cities ********************************/
Route::get('/all-cities', 'AdminController@getAllCities')->name('getAllCities');
Route::get('/add-city', 'AdminController@addnewcity')->name('addnewcity');
Route::post('/create-city', 'AdminController@addnewcityPost')->name('creatnewcity');
Route::get('city/{city_id}/delete', ['as' => 'city.delete', 'uses' => 'AdminController@deleteCity']);
Route::get('city/{city_id}/edit', ['as' => 'city.edit', 'uses' => 'AdminController@updateCity']);
Route::post('city/{city_id}/update', ['as' => 'city.editpost', 'uses' => 'AdminController@updateCitypost']);
/************************* End Cities *****************************/



/********************* Start Gym Categories ********************************/
Route::get('/all-gym-Categories', 'AdminController@getAllGymCategories')->name('getAllGymCategories');
Route::get('/add-category', 'AdminController@addnewcategory')->name('addnewcategory');
Route::post('/create-category', 'AdminController@addnewcategoryPost')->name('creatnewcategory');
Route::get('category/{cat_id}/delete', ['as' => 'category.delete', 'uses' => 'AdminController@deleteCategory']);
Route::get('category/{cat_id}/edit', ['as' => 'category.edit', 'uses' => 'AdminController@updateCategory']);
Route::post('category/{cat_id}/update', ['as' => 'category.editpost', 'uses' => 'AdminController@updateCategorypost']);
/************************* End gym Categories *****************************/


/********************* Start Gym Facilities ********************************/
Route::get('/all-gym-facilities', 'AdminController@getAllGymfacilities')->name('getAllGymfacilities');
Route::get('/add-facility', 'AdminController@addnewfacilities')->name('addnewfacilities');
Route::post('/create-facility', 'AdminController@addfacilityPost')->name('addfacilityPost');

Route::get('facility/{facility_id}/delete', ['as' => 'facility.delete', 'uses' => 'AdminController@deleteFacility']);
Route::get('facility/{facility_id}/edit', ['as' => 'facility.edit', 'uses' => 'AdminController@updateFacility']);
Route::post('facility/{facility_id}/update', ['as' => 'facility.editpost', 'uses' => 'AdminController@updateFacilitypost']);
/************************* End gym Facilities *****************************/





/************************* Add New Seller *********************************/
Route::get('/add-seller', 'AdminController@addSellerByAdmin')->name('addSellerByAdmin');
Route::post('/register-seller', 'AdminController@addSellerByAdminPost')->name('addSellerByAdminPost');


/********************** Add Marketing executive  *******************/
Route::get('/marketing-executive', 'AdminController@addMarketingExecutive')->name('addMarketingExecutive');
Route::post('/marketing-executive-post', 'AdminController@addMarketingExecutivePost')->name('addMarketingExecutivePost');
Route::get('/all-marketing-executive', 'AdminController@allMarketingExecutive')->name('allMarketingExecutive');
Route::get('/all-marketing-executive/{mktexecutive_id}', 'AdminController@updateMarketingExecutive')->name('updateMarketingExecutive');

Route::post('all-marketing-executive/{mktexecutive_id}/update', 'AdminController@updateMarketingExecutivePost')->name('updateMarketingExecutivePost');


  /************ Assign Workout ********************/
  Route::get('/all-workouts', 'AdminController@getAllAssignedWorkouts')
  ->name('getAllAssignedWorkouts');
  Route::get('/assign-workout','AdminController@assignWorkouts')->name('assignNewWorkout');
  Route::post('/assign-workout','AdminController@workoutsAssign')->name('workoutAssignpost');
  Route::post('/delete-workout','AdminController@deleteWorkoutsByAdmin')->name('deleteWorkoutsByAdmin');
   /************ Assign Nutrition ********************/
    Route::get('/nutritions', 'AdminController@getNutritions')->name('getNutritions');
    Route::get('/assign-nutrition','AdminController@assignNutritions')->name('assignNutritions');
    Route::post('/assign-nutrition','AdminController@assignNutritionsPost')->name('assignNutritionsPost');
    Route::post('/delete-nutrition','AdminController@deleteAssignedNutritions')->name('deleteAssignNutritions');
    /************ Add attendance********************/
     Route::get('/attendance-management', 'AdminController@markOrCheckAttendance')->name('markOrCheckAttendance');
    Route::post('/mark-attendance', 'AdminController@SubmitAttandance')->name('attandanceMark');


});

/******************** Marketing executive Section **************************/

// Route::get('/nutrition-list', 'MktController@nutritionList')->name('nutritionList');
// Route::get('/nutritionassign', 'MktController@nutritionAssign')->name('addnutrition');
// Route::get('/workoutlog', 'MktController@workoutlog')->name('workoutLog');
// Route::get('/workoutassign', 'MktController@workoutAssign')->name('workoutAssign');
// Route::get('/attendance', 'MktController@attendance')->name('attendance');


Route::get('/sales-executive/login', 'MktController@salesExecutiveLogin')->name('salesExecutiveLogin');

Route::group(['middleware' => ['role:salesexecutive'],'prefix' => 'sales-executive'], function () {

    Route::get('/dashboard', 'MktController@dashboard')->name('mktDashboard');
    Route::get('/my-seller', 'MktController@getMySellers')->name('mysellers');
    Route::get('/register-seller', 'MktController@createNewSeller')->name('createNewSeller');
    Route::post('/register-seller', 'MktController@createSellerPost')->name('createSellerPost');
    Route::get('/edit/{seller_id}', 'MktController@editSellerDetails');

    Route::patch('/edit/{seller_id}', 'MktController@updateSellerDetailsPost')
    ->name('updateSellerDetailsPost');
    Route::post('/delete-seller', 'MktController@deleteSeller')->name('deleteSeller');

    Route::get('/my-settings', 'MktController@MyGeneralsettings')->name('mySettings');
    Route::get('/my-wallet', 'MktController@myWallet')->name('myWallet');
    Route::post('/setting/update/{salesexecutive_id}', 'MktController@updateMySettings')
    ->name('updateGeneralSettingspost');
    Route::get('/change-password', 'MktController@changepassword')->name('executivechangepassword');
    /******************************** PAckage **********************/
    Route::get('/packages', 'MktController@packagesList')->name('salesExePackagesList');
    Route::get('/add-package', 'MktController@packagesAdd')->name('salesExePackagesAdd');
    Route::post('/addPackagePost', 'MktController@addPackagePost')->name('addPackagebysalesExepost');
     Route::post('/delete-package', 'MktController@DeletePackage')->name('DeletePackage');
    Route::patch('packages/{package}/update', ['as' => 'salesExe-packages.update', 'uses' => 'MktController@updatePackage']);

    Route::get('package/{package}',  ['as' => 'salesExe-package.edit', 'uses' => 'MktController@editPackage']);

});



