<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

 $routes->get('user/register', 'UserController::register');
$routes->post('signin', 'UserController::register');
$routes->get('user/login', 'UserController::login');
$routes->post('user/login', 'UserController::login');
$routes->get('user/home', 'UserController::home');
$routes->get('user/updateProfile', 'UserController::updateProfile');
$routes->post('user/updateProfile', 'UserController::edit_prof');
$routes->get('user/logout', 'UserController::logout');

$routes->get('/', 'RegisterController::index');
$routes->get('/signup', 'RegisterController::index');
$routes->match(['get', 'post'], 'RegisterController/store', 'RegisterController::store');
$routes->match(['get', 'post'], 'LoginController/loginAuth', 'LoginController::loginAuth');
$routes->get('/signin', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/prof', 'LoginController::profile');


$routes->get('/addtocart', 'CarController::cart'); 
$routes->get('/carma', 'Admin::carinfo');
$routes->get('/checkout', 'CarController::checkout');
$routes->get('/home', 'HomeController::index');
$routes->get('/ecom', 'HomeController::ecom');
$routes->get('/cars', 'CarController::index');
$routes->get('/car', 'CarController::index');
$routes->get('/rent', 'HomeController::rent');
$routes->get('/get', 'HomeController::start');
$routes->get('/logout', 'SigninController::logout');
$routes->get('/fecars', 'HomeController::fecars');
$routes->post('rental', 'RentController::rent'); // Route for handling form submission


$routes->get('admin', 'Admin::index');
$routes->get('admin/search', 'Admin::search'); // New route for searching users
$routes->post('admin/update/(:num)', 'Admin::update/$1'); // New route for updating user data
$routes->get('admin/delete/(:num)', 'Admin::delete/$1'); // New route for deleting a user

$routes->group('admin', ['namespace' => 'App\Controllers'], function($routes) {
    // Add Car
    $routes->post('addCar', 'CarController::addCar');

    // Update Car
    $routes->post('updateCar/(:num)', 'CarController::updateCar/$1');

    // Delete Car
    $routes->get('deleteCar/(:num)', 'CarController::deleteCar/$1');
});




$routes->get('/car_management', 'Admin::usercar');
$routes->get('/car_user', 'CarController::index'); // Assuming you have an index method for listing cars
$routes->post('admin/updateCar/(:num)', 'CarController::updateCar/$1');
$routes->get('admin/deleteCar/(:num)', 'CarController::deleteCar/$1');

$routes->post('rent', 'RentController::rent'); // Route for handling form submission
$routes->group('rental', function ($routes) {
    // Route to display the rental form
    $routes->get('/', 'Rental::index');

    // Route to handle form submission
    $routes->post('submit', 'Rental::submit');}
);

$routes->get('/rentman', 'Rental::adminIndex');

$routes->get('/eco', 'CarController::fetch');
$routes->get('/car/addToCart/(:num)', 'CarController::addToCart/$1');
$routes->get('/car/buy/(:num)', 'CarController::buy/$1');
$routes->get('/car/checkout', 'CarController::checkout');
$routes->get('admin/edit/(:num)', 'AdminController::edit/$1');
$routes->post('admin/update/(:num)', 'AdminController::update/$1');


$routes->post('admin/addCar', 'CarController::addCar');
$routes->get('admin/editCar/(:num)', 'CarController::editCar/$1');
$routes->post('admin/updateCar', 'CarController::updateCar');
$routes->get('admin/deleteCar/(:num)', 'CarController::deleteCar/$1');

$routes->get('rental/delete/(:num)', 'Rental::delete/$1');
$routes->post('rental/updateRental', 'Rental::updateRental');




$routes->get('/ui', 'Admin::design');
$routes->get('admin/recent-users', 'Admin::recentUsers');



$routes->get('/imageupload', 'ImageUpload::index');
$routes->post('/imageupload/upload', 'ImageUpload::upload');
$routes->get('/imageupload/show', 'ImageUpload::show');


$routes->get('/checkouts', 'CheckoutController::checkout'); // Checkout page





$routes->get('image', 'ImageUpload::index');
$routes->post('image-upload/upload', 'ImageUpload::upload');
$routes->get('image-view', 'ImageUpload::view');

$routes->get('/admin/car_management', 'CarController::indexs');
$routes->get('/car/create', 'CarController::create');
$routes->post('/car/store', 'CarController::store');
$routes->get('/car/edit/(:num)', 'CarController::edit/$1');
$routes->post('car/update/(:num)', 'CarController::update/$1');
$routes->get('/car/delete/(:num)', 'CarController::delete/$1');
$routes->get('car/edit/(:num)', 'CarController::getCar/$1');



$routes->post('payment/submit', 'PaymentController::submit');
$routes->get('payments', 'PaymentController::index');
$routes->get('payment/delete', 'PaymentController::delete');

$routes->post('payment/submit', 'PaymentController::submit');
$routes->get('payments', 'PaymentController::checkout');
$routes->get('payment/delete', 'PaymentController::delete');

$routes->get('payment/delete/(:num)', 'PaymentController::delete/$1');

// Update Payment (POST)
$routes->post('payment/update/(:num)', 'PaymentController::update/$1');

// You can also include a route for searching payments
$routes->get('payment/search', 'PaymentController::search'); // Example if search is implemented
      



$routes->get('/car_management', 'ProductController::index');
$routes->get('carslist', 'ProductController::indexs');

$routes->get('/car_management', 'ProductController::index');
$routes->get('admins', 'ProductController::index');
$routes->get('carslist', 'ProductController::indexs');
$routes->post('admins/add', 'ProductController::add');
$routes->get('admins/delete/(:num)', 'ProductController::delete/$1');
$routes->get('admins/edit/(:num)', 'ProductController::edit/$1');
$routes->post('admins/edit/(:num)', 'ProductController::edit/$1');
$routes->get('/dashboard', 'CarController::dashboard');
$routes->get('analytics', 'Analytics::index');


$routes->get('/hello', 'SignupController::hello');

$routes->get('/logins', 'UserController::logins');  // Show login form
$routes->get('/login', 'UserController::index');  // Show login form
$routes->post('/login', 'UserController::loginAuth');  // Handle login submission
$routes->get('/logout', 'UserController::logout');  // Logout
$routes->get('/register', 'UserController::register');  // Show registration form
$routes->post('/register', 'UserController::store');  // Handle registration submission
$routes->post('/UserController/store', 'UserController::store');
$routes->post('/product/submitPayment', 'PaymentController::submitPayment');

$routes->post('submitPayment', 'ProductController::submitPayment');
$routes->get('/History', 'ProductController::History');
$routes->get('rental/history', 'Rental::history');
$routes->get('ren', 'Rental::show');
$routes->get('historia', 'HistoryController::combinedHistory');

$routes->get('rental/mapping', 'Rental::mapping');
$routes->get('profs', 'UserController::profile');
$routes->get('edit_prof', 'UserController::edit_prof');




$routes->get('user_management', 'UserController::index'); // Display all users
$routes->get('admin/editUser/(:num)', 'UserController::editUser/$1'); // Edit user by ID
$routes->post('admin/editUser/(:num)', 'UserController::editUser/$1'); // Handle the edit form submission
$routes->get('admin/deleteUser/(:num)', 'UserController::deleteUser/$1'); //
$routes->get('product/rent/(:num)', 'ProductController::rent/$1');
$routes->get('shows/(:num)', 'ProductController::trial/$1');
$routes->post('/rental-management/approve/(:num)', 'Rental::approve/$1');
$routes->post('/rental-management/decline/(:num)', 'Rental::decline/$1');

// Admin Routes
$routes->get('admin/return_car/(:num)', 'AdminController::returnCar/$1');
$routes->get('admin/confirm_return/(:num)', 'AdminController::confirmReturn/$1');

// User Routes
$routes->post('/delete_purchase/(:num)', 'PaymentController::delete/$1');
$routes->post('/deleteRental/(:num)', 'HistoryController::deleteRental/$1');
$routes->post('updateApprovalStatus/(:num)/(:any)', 'Rental::updateApprovalStatus/$1/$2');
$routes->get('returnees/(:num)', 'Rental::returnees/$1'); // Assuming YourController is the name of your controller

$routes->get('/admin/returnees', 'Rental::adminReturnees');
// Rental return route
$routes->post('/rental/returnRental', 'Rental::returnRental');

$routes->get('/returnees/(:num)', 'Rental::returnees/$1'); // Route to handle rental return (view return details)
$routes->get('/returnees-list', 'Rental::returneesList'); // Route to view the list of returned rentals

// POST route to handle updating rental status as "returned"
$routes->post('rentals/markAsReturned/(:num)', 'Rental::markAsReturned/$1');


$routes->get('returnees', 'Rental::viewReturnees'); // Link to view all returned items
$routes->post('/payment/toggleApproval/(:num)', 'PaymentController::toggleApproval/$1');

$routes->get('/feedback', 'Feedback::index');
$routes->get('/feedback/create', 'Feedback::create');
$routes->post('/feedback/create', 'Feedback::create');
$routes->get('/admin/feedback', 'Feedback::admin');
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/submit', 'Contact::submit');
$routes->get('/contact/messages', 'Contact::messages');
$routes->get('/contact/delete/(:num)', 'Contact::delete/$1');

// In Config/Routes.php or where you define your routes

$routes->post('rent/accept-rental/(:num)', 'Rental::acceptRental/$1');
$routes->post('rent/decline-rental/(:num)', 'Rental::declineRental/$1');
$routes->post('product/toggleApproval/(:num)', 'ProductController::toggleApproval/$1');


$routes->post('rentals/return/(:num)', 'Rental::returnRental/$1');
$routes->get('/returned_rentals', 'Rental::viewReturnedRentals');
$routes->get('user/returned_rentals', 'Rental::userReturnedRentals');

$routes->get('rentals/print-agreement/(:num)', 'Rental::printAgreement/$1');
// In app/Config/Routes.php
$routes->get('rentals/agreement/(:num)', 'Rental::showAgreement/$1');
$routes->get('purchase/agreement/(:num)', 'ProductController::generateAgreement/$1');