<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// admin login routes
$routes->get('/Auth/login', 'AuthController::index');
$routes->post('/Auth/loggedUser', 'AuthController::loginUser');
$routes->get('/Auth/logout', 'AuthController::logout');

// group all the pages and add auth
$routes->group('', ['filter' => 'AuthCheck'], function($routes){

// dashboard routes
$routes->get('/admin', 'Home::index');
$routes->get('/pending-rates-reviews', 'Home::pendingRatesReviews');
$routes->get('/pending-room', 'Home::pendingRoomReservation');
$routes->get('/accepted-room', 'Home::acceptedRoomReservation');
$routes->get('/completed-room', 'Home::completedRoomReservation');
$routes->get('/cancelled-room', 'Home::cancelledRoomReservation');
$routes->get('/pending-entrance-cottage', 'Home::pendingEntranceCottage');
$routes->get('/accept-room-reservation/(:num)', 'Home::acceptRoomReservation/$1');
$routes->post('/reject-room-reservation/(:num)', 'Home::rejectRoomReservation/$1');
$routes->post('/reject-event-booking/(:num)', 'Home::rejectEventBooking/$1');
$routes->get('/checkout-today', 'Home::checkouToday');
$routes->post('/room-checkin-now/(:num)', 'Home::checkInNow/$1');
$routes->get('/checkin', 'Home::checkIn');
$routes->get('/resubmit-gcash-ref-no-room/(:num)', 'Home::resubmitGcashRefNoRoom/$1');
$routes->get('/room-checkin-today', 'Home::roomCheckinToday'); //incoming customer to checkin today
$routes->get('/room-extend-stay/(:num)', 'Home::roomExtendStay/$1');
$routes->put('/process-room-extend-stay/(:num)', 'Home::processRoomExtendStay/$1');
$routes->get('/checkout-process/(:num)', 'Home::checkoutProcess/$1');
$routes->get('/Approved/rates-reviews/(:num)', 'Home::ratesApprove/$1');
$routes->get('/Delete/rates-reviews/(:num)', 'Home::deleteRates/$1');






// rides routs
$routes->get('/Rides', 'RidesController::adminShow');
$routes->get('/Rides/add', 'RidesController::add');
$routes->post('/Rides/store', 'RidesController::store');
$routes->get('/Rides/edit/(:num)', 'RidesController::edit/$1');
$routes->put('/Rides/update/(:num)', 'RidesController::update/$1');
$routes->get('/Rides/delete/(:num)', 'RidesController::delete/$1');



// events place transaction routes
$routes->get('/pending-event-booking', 'Home::pendingEventBooking');
$routes->get('/accepted-event-booking', 'Home::acceptedEventBooking');
$routes->get('/completed-event-booking', 'Home::completedEventBooking');
$routes->get('/cancelled-event-booking', 'Home::cancelledEventBooking');
$routes->get('/resubmit-gcash-ref-no/(:num)', 'Home::resubmitGcashRefNo/$1');
$routes->get('/accept-event-booking/(:num)', 'Home::acceptEventBooking/$1');
$routes->get('/mark-fully-paid/(:num)', 'Home::markFullyPaid/$1');
$routes->get('/mark-as-completed/(:num)', 'Home::markAsCompleted/$1');
$routes->get('/active-event-booking', 'Home::activeEventBooking');

// contacts
$routes->get('/Contacts', 'ContactsController::index');
$routes->get('/Contacts/edit/(:num)', 'ContactsController::edit/$1');
$routes->put('/Contacts/update/(:num)', 'ContactsController::update/$1');




// gcash info
$routes->get('/Payment/gcash-info', 'PaymentController::index');
$routes->get('/Payment/add', 'PaymentController::add');
$routes->post('/Payment/store', 'PaymentController::store');
$routes->post('/Payment/set-status', 'PaymentController::setStatus');
$routes->get('/Payment/edit/(:num)', 'PaymentController::edit/$1');
$routes->put('/Payment/update/(:num)', 'PaymentController::update/$1');

// shutdown website
$routes->get('/Shutdown/shutdown-website', 'ShutdownWebsiteController::index');
$routes->put('/Shutdown/all', 'ShutdownWebsiteController::shutdownAll');
$routes->put('/Shutdown/login', 'ShutdownWebsiteController::shutdownLogin');
$routes->put('/Shutdown/register', 'ShutdownWebsiteController::shutdownRegister');
$routes->put('/Shutdown/room', 'ShutdownWebsiteController::shutdownRoom');
$routes->put('/Shutdown/event', 'ShutdownWebsiteController::shutdownEvent');
$routes->put('/Activate/all', 'ShutdownWebsiteController::activateAll');


/**
 * Users routes
 */
$routes->get('/User/user-management', 'UsersController::index');
$routes->get('/User/add', 'UsersController::addUser');
$routes->post('/User/store', 'UsersController::storeUser');
$routes->get('/User/delete/(:num)', 'UsersController::deleteUser/$1');
$routes->get('/User/edit/(:num)', 'UsersController::editUser/$1');
$routes->put('/User/update/(:num)', 'UsersController::updateUser/$1');


/**
 * Room Category routes
 */
$routes->get('/Room/all-category', 'RoomCategoryController::index');
$routes->get('/Room/add_category', 'RoomCategoryController::addCategory');
$routes->post('/Room/store_room_category', 'RoomCategoryController::storeRoomCategory');
$routes->get('/Room/delete/(:num)', 'RoomCategoryController::deleteRoomCategory/$1');
$routes->get('/Room/edit/(:num)', 'RoomCategoryController::editRoomCategory/$1');
$routes->put('/Room/update_room_category/(:num)', 'RoomCategoryController::updateRoomCategory/$1');

/**
 * Rooms routes
 */
$routes->get('/Room/all-rooms', 'RoomsController::index');
$routes->get('/Room/add_room', 'RoomsController::addRoom');
$routes->get('/Room/edit-room/(:num)', 'RoomsController::edit/$1');
$routes->put('/Room/update-room/(:num)', 'RoomsController::update/$1');
$routes->post('/Room/store_room', 'RoomsController::storeRoom');
$routes->get('/Room/rooms-reservation', 'RoomsController::roomsReservation');
$routes->get('/Room/available-rooms', 'RoomsController::availableRooms');
$routes->get('/Room/view-room-full-details/(:num)', 'RoomsController::viewRoomFullDetails/$1');

//room number routs
$routes->get('/Room-number/room-number', 'RoomNumberController::index');
$routes->get('/Room-number/add', 'RoomNumberController::add');
$routes->post('/Room-number/store', 'RoomNumberController::store');
$routes->get('/Room-number/edit/(:num)', 'RoomNumberController::edit/$1');
$routes->put('/Room-number/update/(:num)', 'RoomNumberController::update/$1');
$routes->get('/Room-number/delete/(:num)', 'RoomNumberController::delete/$1');





/**
 * Room Reservation Transaction routes
 */
$routes->get('/ReservationTransaction/checkin/(:num)', 'RoomReservationTransactionController::index/$1');
$routes->post('/ReservationTransaction/store_room_reservation', 'RoomReservationTransactionController::storeRoomReservation');
$routes->get('/ReservationTransaction/editRoomReservation/(:num)/(:num)', 'RoomReservationTransactionController::editRoomReservation/$1/$2');
$routes->put('/ReservationTransaction/updateRoomReservation/(:num)', 'RoomReservationTransactionController::updateRoomReservation/$1');

/**
 * Events places routes
 */
$routes->get('/Events/events-places', 'EventsPlacesController::index');
$routes->get('/Events/add', 'EventsPlacesController::add');
$routes->post('/Events/store', 'EventsPlacesController::store');
$routes->get('/Events/edit/(:num)', 'EventsPlacesController::edit/$1');
$routes->put('/Events/update/(:num)', 'EventsPlacesController::update/$1');



/**
 * Reports rooms routes
 */
$routes->get('/Reports/generate-reports', 'GenerateReportsController::index');
$routes->get('/Reports/daily-reports', 'GenerateReportsController::dailyReports');
$routes->get('/Reports/weekly-reports', 'GenerateReportsController::weeklyReports');
$routes->get('/Reports/monthly-reports', 'GenerateReportsController::monthlyReports');
$routes->get('/Reports/yearly-reports', 'GenerateReportsController::yearlyReports');
$routes->get('/Reports/custom-reports', 'GenerateReportsController::customReports');
$routes->get('/Reports/show-custom-reports', 'GenerateReportsController::showCustomReports');
$routes->get('/Reports/completed-room-reservation', 'GenerateReportsController::completedRoom');
$routes->get('/Reports/cancelled-room-reservation', 'GenerateReportsController::cancelledRoom');

/**
 * Reports events routes
 */
$routes->get('/Reports-event/custom-reports', 'GenerateReportsController::eventsCustomReports');
$routes->get('/Reports-event/show-custom-reports', 'GenerateReportsController::showEventsCustomReports');
$routes->get('/Reports-event/daily-reports', 'GenerateReportsController::eventsDaily');
$routes->get('/Reports-event/weekly-reports', 'GenerateReportsController::eventsWeekly');
$routes->get('/Reports-event/monthly-reports', 'GenerateReportsController::eventsMonthly');
$routes->get('/Reports-event/yearly-reports', 'GenerateReportsController::eventsYearly');




/**
 * Customers routes inside admin page
 */
$routes->get('/Customer/customer-list', 'CustomersController::index');
$routes->get('/Customer/add', 'CustomersController::addCustomer');
$routes->post('/Customer/store', 'CustomersController::storeCustomer');
$routes->get('/Customer/delete/(:num)', 'CustomersController::deleteCustomer/$1');
$routes->get('/Customer/edit/(:num)', 'CustomersController::editCustomer/$1');

/**
 * Entrance fee routes
 */
$routes->get('/Entrance/entrance-list', 'EntranceController::index');
$routes->get('/Entrance/add', 'EntranceController::add');
$routes->post('/Entrance/store', 'EntranceController::store');
$routes->get('/Entrance/edit/(:num)', 'EntranceController::edit/$1');
$routes->put('/Entrance/update/(:num)', 'EntranceController::update/$1');

/**
 * Cottage fee routes
 */
$routes->get('/Cottage/cottage-list', 'CottageController::index');
$routes->get('/Cottage/add', 'CottageController::add');
$routes->post('/Cottage/store', 'CottageController::store');
$routes->get('/Cottage/edit/(:num)', 'CottageController::edit/$1');
$routes->put('/Cottage/update/(:num)', 'CottageController::update/$1');

});


/**
 * Customer routes
 */
$routes->get('/', 'CustomersController::homepage');
$routes->get('/Customer/all-rooms', 'CustomersController::allRooms');
$routes->post('/Customer/filter-rooms', 'CustomersController::filterRooms');
$routes->get('/Customer/single-room/(:num)', 'CustomersController::singleRoom/$1');
$routes->get('/Customer/check_auth', 'CustomersController::checkAuth');
$routes->get('/Customer/login', 'CustomersController::login');
$routes->get('/Customer/logout', 'CustomersController::logout');
$routes->get('/Customer/register', 'CustomersController::register');
$routes->post('/Customer/auth', 'CustomersController::auth');
$routes->get('/Customer/my-reservation', 'CustomersController::showReservationList');
$routes->get('/Customer/my-reservation-entrance-cottage', 'CustomersController::showEntranceCottageReservation');
$routes->get('/Customer/process-request/(:num)', 'CustomersController::processRoomRequest/$1');
$routes->post('/Customer/process-transaction/(:num)', 'CustomersController::processRoomTransaction/$1');

$routes->post('/Customer/register-process', 'CustomersController::registerProcess');
$routes->get('/Customer/activate', 'CustomersController::activate');
$routes->get('/Customer/activate/(:any)', 'CustomersController::activate/$1');

$routes->get('/Customer/entrance-cottages', 'CustomersController::entranceCottage');
$routes->get('/Customer/process-entrance-cottage/(:num)/(:any)', 'CustomersController::processEntranceCottage/$1/$2');

$routes->post('/Customer/cancel-reservation', 'CustomersController::cancelReservation');
$routes->post('/Customer/process-entrance-cottage-transaction', 'CustomersController::processEntranceCottageTransaction');
$routes->get('/Customer/my-profile', 'CustomersController::myProfile');
$routes->post('/Customer/change-contact', 'CustomersController::changeContact');
$routes->post('/Customer/change-pass', 'CustomersController::changePassword');
$routes->post('/Customer/change-profile', 'CustomersController::changeProfile');
$routes->get('/Customer/forgot-password', 'CustomersController::forgotPassword');
$routes->post('/Customer/forgot-password-process', 'CustomersController::forgotPasswordProcess');
$routes->get('/Customer/reset-password/(:any)', 'CustomersController::resetPassword/$1');
$routes->post('/Customer/reset-password/(:any)', 'CustomersController::resetPassword/$1');

$routes->get('Customer/events-place', 'CustomersController::eventsPlace');
$routes->get('Customer/event-place-details/(:num)', 'CustomersController::eventPlaceDetails/$1');
$routes->get('Customer/select-booked-date/(:num)', 'CustomersController::selectBookedDate/$1');
$routes->get('Customer/book-event/(:any)/(:num)', 'CustomersController::bookEvent/$1/$2');
$routes->post('Customer/process-booking-event/(:num)', 'CustomersController::processBookingEvent/$1');
$routes->get('/Customer/my-reservation-events-place', 'CustomersController::showEventsPlaceReservation');
$routes->put('/Customer/update-ref-no', 'CustomersController::updateRefNo');
$routes->put('/Customer/update-ref-no-room', 'CustomersController::updateRefNoRoom');
$routes->post('/Customer/cancel-booking-event', 'CustomersController::cancelBookingEvent');

$routes->get('Customer/leave-a-review/(:any)/(:any)', 'CustomersController::leaveAReview/$1/$2');
$routes->post('Customer/process-rates-reviews', 'CustomersController::processRatesReviews');

$routes->get('/Customer/rides', 'RidesController::index');
$routes->get('/success', 'CustomersController::success');









/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
