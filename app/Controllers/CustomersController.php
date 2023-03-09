<?php

namespace App\Controllers;

use App\Libraries\Hash;
use Faker\Provider\Base;
use App\Models\CottageModel;
use App\Models\PaymentModel;
use App\Models\EntranceModel;
use App\Models\CustomersModel;
use App\Models\EventsPlacesModel;
use App\Models\RatesReviewsModel;
use App\Controllers\BaseController;
use App\Models\ShutdownWebsiteModel;
use App\Models\EventsPlacesTransactionModel;
use App\Models\EntranceCottageTransactionModel;
use App\Models\RoomReservationTransactionModel;

class CustomersController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'date']);
    }

    // show customer homepage
    public function homepage()
    {
        $data['rooms'] = $this->showAllRooms();
        $data['today'] = $this->countTodayCustomer();
        $entrance = new EntranceModel();
        $cottage = new CottageModel();

        $data['cottages'] = $cottage->findAll();
        $data['entrance'] = $entrance->find(1);

        $rate = new RatesReviewsModel();
        $data['rates'] = $rate->where('status', 'approved')->findAll();

        return view('customer/index', $data);
    }

    // count today customer in pmp
    public function countTodayCustomer()
    {
        $db = db_connect();
        $room_reservation = $db->table('tbl_room_reservation_transactions');
        $events = $db->table('tbl_events_transaction');
        $res1 = $room_reservation->select('sum(total_person) as today')->where('transaction_status !=', 'cancelled')->where('transaction_status !=', 'completed')->where('checkin = curdate()')->get()->getRow();

        $res2 = $events->select('sum(total_person) as today')->where('transaction_status !=', 'cancelled')->where('date_book = curdate()')->get()->getRow();
            
        return $res1->today + $res2->today;
    }

    // show all rooms
    public function allRooms()
    {

        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        $data['rooms'] = $this->showAllRooms();

        return view('customer/all-rooms', $data);
    }

    // function for showing all rooms
    public function showAllRooms()
    {
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id');
        $builder->orderBy('available_rooms', 'desc');
        // $builder->limit('3');
        
        return $data['rooms'] = $builder->get()->getResult();

    }

    // list of verified customer in admin side
    public function index()
    {
        $db = db_connect();
        $builder = $db->table('tbl_customers');
        $builder->select('*');
        $builder->where('account_status', 'active');
        $data['customers'] = $builder->get()->getResult();

        return view('admin/customer/customer-list', $data);
    }

    // show add customer page in admin side
    public function addCustomer()
    {
        return view('admin/customer/add-customer');
    }

    // store customer in admin side
    public function storeCustomer()
    {
        $validated = $this->validate([
            'name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Full Name is required',
                    'alpha_space' => 'Full Name cannot accept numbers and symbols',
                ]
            ],

            'contact' => [
                'rules' => 'required|alpha_numeric|exact_length[11]|is_unique[tbl_customers.contact]',
                'errors' => [
                    'required' => 'Contact is required',
                    'alpha_numeric' => 'Contact cannot accept letters and symblos',
                    'exact_length' => 'Contact should only have 11 numbers',
                    'is_unique' => 'Contact number already use',
                ],
            ],

            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gender is required',
                ]
            ],

            'birthdate' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Birthdate is required',
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_customers.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email',
                    'is_unique' => 'Email already exist',
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[6]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be 6 character long',
                    'max_length' => 'Password cannot be longer than 20 characters',
                ]
            ],

            'profile' => [
                'rules' => 'is_image[profile]|max_size[profile,2048]|mime_in[profile,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

        ]);

        if(!$validated)
        {
            return view('admin/customer/add-customer', ['validation' => $this->validator]);
        }

        if($img = $this->request->getFile('profile'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // assign variable to hold the value of image

        if(!empty($_FILES['profile']['name']))
        {
            $profile = $imageName;
        }
        else
        {
            $profile = "user_male.jpg";
        }

        $hash = Hash::encrypt($this->request->getPost('password'));

        $name = $this->request->getPost('name');
        $contact = $this->request->getPost('contact');
        $gender = $this->request->getPost('gender');
        $birthdate = $this->request->getPost('birthdate');
        $age = $this->request->getPost('age');
        $email = $this->request->getPost('email');
        $password = $hash;
        $profile = $profile;

        $data = [
            'name' => $name,
            'contact' => $contact,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'age' => $age,
            'email' => $email,
            'password' => $hash,
            'profile' => $profile,
            'account_status' => "active",
        ];

        $customer = new CustomersModel();
        $save = $customer->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Customer/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Customer added successfully')
            ->with('status', 'error');
        }
    }

    // delete customer in admin side
    public function deleteCustomer($id = null)
    {
        $customer = new CustomersModel();
        $findProfile = $customer->find($id);
        $profile = $findProfile->profile;

        if($profile == "user_male.jpg")
        {
            $customer->delete($id);
        }
        else
        {
            unlink("uploads/".$profile);
            $customer->delete($id);
        }

        $data = [
            'status' => 'Success',
            'status_text' => 'Customer Deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }

    // filtering available rooms in customer side
    public function filterRooms()
    {
        $checkin = strtotime($this->request->getPost('checkin'));
        $checkout = strtotime($this->request->getPost('checkout'));

        $checkin2 = $this->request->getPost('checkin');
        $checkout2 = $this->request->getPost('checkout');

        if($checkout < $checkin || $checkout == $checkin)
        {
            return redirect()->to(base_url('Customer/all-rooms'))
            ->with('status_icon', 'warning')
            ->with('status_text', 'Invalid Checkin and Checkout date format')
            ->with('warning', 'Success'); 
        }

        $adults = $this->request->getPost('adults');
        $children = $this->request->getPost('children');

        $db = db_connect();
        $room = $db->table('tbl_rooms');
        $room->select('*');
        $room->where('room_status', 'active');
        $room_res = $room->get()->getResult();

        // echo "<pre>";
        // print_r($room_res);
        // die;


        if(isset($_POST['checkin']))
        {
            foreach($room_res as $haha)
            {
                $builder = $db->table('tbl_room_reservation_transactions');
                $builder->select('COUNT(*) AS total_book');
                $builder->where('transaction_status !=', 'completed');
                $builder->where('room_id', $haha->id);
                $builder->where('checkin', $checkout2);
                $builder->where('checkout', $checkin2);
                $result = $builder->get()->getResult();

                foreach($result as $hoho)
                {   
                    $res = $haha->available_rooms - $hoho->total_book;
                    if($res == 0)
                    {
                        
                        $builder = $db->table('tbl_room_reservation_transactions');
                        $builder->select('*');
                        $builder->where('transaction_status !=', 'completed');
                        $builder->where('room_id', $haha->id);
                        $builder->where('checkin >', $checkout2);
                        $builder->where('checkout <', $checkin2);
                        $result = $builder->get()->getResult();
                    }
                    else
                    {
                        $builder = $db->table('tbl_rooms');
                        $builder->select('*');
                        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id');
                        $data['filters'] = $builder->get()->getResult();
                    }
                }
            
            }
        }


        // $builder = $db->table('tbl_rooms');
        // $builder->select('available_rooms');
        // $builder->where('transaction_status !=', 'completed');
        // $builder->where('checkin <', $checkin2);
        // $builder->where('checkout >', $checkout2);


        // $data['filters'] = $builder->get()->getResult();

        return view('customer/all-rooms', $data);
    }

    // showing single room in customer side
    public function singleRoom($id = null)
    {

        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id');
        $builder->where('id =', $id);
        $data['single_room'] = $builder->get()->getRow();

        return view('customer/single-room', $data);
    }

    // edit customer info in admin side
    public function editCustomer($id = null)
    {
        $customer = new CustomersModel();
        $data['customer'] = $customer->find($id);
        return view('admin/customer/edit-customer', $data);
    }

    // showing login page in customer side
    public function login()
    {   
        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        return view('customer/login', $data);
    }

    // checking if user has authentication
    public function checkAuth()
    {
        session()->setFlashdata('invalid', 'You need to login first');
        return redirect()->to(base_url('/Customer/login'));
    }

    // logging in the customer if he/she has account
    public function auth()
    {
        $website = new ShutdownWebsiteModel();
        // validate user input
        $validated = $this->validate([

            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Please enter your email',
                    'valid_email' => 'Please enter a valid email',
                ]
            ],

            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please enter your Password',
                    
                ]
            ],

        ]);

        $data['website'] = $website->find(1);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            
            return view('customer/login', $data);
        }
        else
        {
            // check the user details in database
            $email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
            $password = $this->request->getPost('password', FILTER_SANITIZE_SPECIAL_CHARS);

            $user = new CustomersModel();
            $userInfo = $user->where('email', $email)->where('account_status', 'active')->first();

            if($userInfo)
            {   

                if($checkPass = Hash::check($password, $userInfo->password))
                {
                    $data = [
                        'loggedCustomerId' => $userInfo->id,
                        'loggedCustomerName' => $userInfo->name,
                        'loggedUserCustomerProfile' => $userInfo->profile,
                    ];

                    session()->set($data);

                    return redirect()->to(base_url('/'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Welcome ' . ucwords(session()->get('loggedCustomerName')))
                    ->with('status', 'Success');;
                }
                else
                {

                    session()->setFlashdata('invalid', 'Invalid Credentials');
                    return view('customer/login', $data);
                    
                }

            }
            else
            {
                session()->setFlashdata('invalid', 'Invalid Credentials');
                return view('customer/login', $data);
            }
        }
    }

    // logging out customer session
    public function logout()
    {
        if(session()->has('loggedCustomerId') || session()->has('loggedCustomerName') || session()->has('loggedUserCustomerProfile'))
        {
            session()->remove('loggedCustomerId');
            session()->remove('loggedCustomerName');
            session()->remove('loggedUserCustomerProfile');
        }

        return redirect()->to(base_url('/Customer/login'))->with('invalid', 'You are logged out');
    }

    // register customer
    public function register()
    {

        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        $db = db_connect();
        $builder = $db->table('tbl_customers');
        $builder->select('activation_date');
        $builder->where('account_status', 'inactive');
        $regTime = $builder->get()->getResult();
        
        // auto delete all the customer account with inactive account_status in tbl_customers
        // if ther activation_date is less than 1 hour
        foreach($regTime as $result){
            $current_time = (int)strtotime(date('Y-m-d h:i:s'));
            $register_time = (int)strtotime($result->activation_date);
            $time_difference = (int)$current_time - (int)$register_time;

            if(3600 < $time_difference)
            {
                $delete_query = "DELETE FROM tbl_customers WHERE activation_date = :activation_date:";
                $db->query($delete_query, [
                    'activation_date' => $result->activation_date
                ]);
            }
        }

        return view('customer/register', $data);
    }

    // show customer their own room reservation
    public function showReservationList()
    {   

        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }

       
        $data['pendings'] = $this->showReservationListFunc('pending');

        $data['accepteds'] = $this->showReservationListFunc('accepted');

        $data['completed'] = $this->showReservationListFunc('completed');

        $data['cancelled'] = $this->showReservationListFunc('cancelled');

        $data['rejected'] = $this->showReservationListFunc('rejected');

        return view('customer/my-reservation', $data);
    }

    public function showReservationListFunc($status)
    {
        $customer_id = session()->get('loggedCustomerId');

        $db = db_connect();
        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('customer_id', $customer_id);
        $builder->where('transaction_status', $status);
        return $builder->get()->getResult();
    }

    // show process room reservation request
    public function processRoomRequest($id = null)
    {   

        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }

        $website = new ShutdownWebsiteModel();
        $inactive = $website->find(1);

        if($inactive->room_reservation == 1)
        {
            return redirect()->to(base_url('Customer/login'));
        }

        $customer_id = session()->get('loggedCustomerId');

        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id', 'inner');
        $builder->where('id', $id);
        $data['room'] = $builder->get()->getRow(); // getRow return single row

        
        $customer = new CustomersModel();
        $data['customer'] = $customer->find($customer_id);

        $builder = $db->table('tbl_payment_info');
        $builder->select('*');
        $builder->where('status', 'active');
        $data['payment'] = $builder->get()->getRow();

        return view('customer/process-request', $data);
    }

    // process room reservation request
    public function processRoomTransaction($id = null)
    {   

        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }
        $db = db_connect();
        $builder = $db->table('tbl_payment_info');
        $builder->select('*');
        $builder->where('status', 'active');
        $data['payment'] = $builder->get()->getRow();

        $validated = $this->validate([
            

            'checkin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Checkin date is required',
                ]
            ],

            'checkout' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Checkout date is required',
                ]
            ],

            'reference_number' => [
                'rules' => 'required|is_unique[tbl_room_reservation_transactions.gcash_reference_number]',
                'errors' => [
                    'required' => 'Reference number is required',
                    'is_unique' => 'Refenrence number already used!'
                ]
            ]
        ]);

        if(!$validated)
        {
            $customer_id = session()->get('loggedCustomerId');

            $db = db_connect();
            $builder = $db->table('tbl_rooms');
            $builder->select('*');
            $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id', 'inner');
            $builder->where('id', $id);
            $data['room'] = $builder->get()->getRow(); // getRow return single row

        
            $customer = new CustomersModel();
            $data['customer'] = $customer->find($customer_id);
            $data['validation'] = $this->validator;

            return view('customer/process-request', $data);
        }

        $checkins = strtotime($this->request->getPost('checkin'));
        $checkouts = strtotime($this->request->getPost('checkout'));

        $checkin2 = $this->request->getPost('checkin');
        $checkout2 = $this->request->getPost('checkout');

        $db = db_connect();
        $room = $db->table('tbl_rooms');
        $room->select('available_rooms');
        $room->where('room_status', 'active');
        $room->where('id', $this->request->getPost('room_id'));
        $room_res = $room->get()->getResult();


        foreach($room_res as $row)
        {
            $available_rooms = $row->available_rooms;
        }

        

        if(isset($_POST['checkin']))
        {
            // print_r($available_rooms);
            // die;
            $builder = $db->table('tbl_room_reservation_transactions');
            $builder->select('COUNT(*) AS total_book');
            $builder->where('transaction_status !=', 'completed');
            $builder->where('room_id', $this->request->getPost('room_id'));
            // $where = "checkin < $checkout2 OR checkin < $checkin2 AND checkout > $checkin2 OR checkout < $checkin2";
            $builder->where('checkin <',  $checkout2);
            $builder->where('checkout >', $checkin2);
            $result = $builder->get()->getResult();

            // print_r($result);
            // die;

            foreach($result as $hoho)
            {   

                $res = ((int)$available_rooms - (int)$hoho->total_book);

            //     print_r($res);
            // die;
                if($res == 0)
                {
                    return redirect()->back()
                    ->with('status_icon', 'warning')
                    ->with('status_text', 'Sorry all rooms between that date is not available')
                    ->with('warning', 'Success'); 
                }
                else
                {
                    if($checkouts < $checkins || $checkouts == $checkins)
                    {
                        return redirect()->back()
                        ->with('status_icon', 'warning')
                        ->with('status_text', 'Invalid Checkin & Checkout date format')
                        ->with('warning', 'Success'); 
                    }
            
            
                    $room_id = $this->request->getPost('room_id');
                    $customer_id = $this->request->getPost('customer_id');
                    $adults = $this->request->getPost('adults');
                    $children = $this->request->getPost('children');
                    $total_peron = $adults + $children;
                    $checkin = $this->request->getPost('checkin');
                    $checkout = $this->request->getPost('checkout');
                    $total_bill = $this->request->getPost('total_bill');
                    $deposit = $this->request->getPost('deposit');
                    $unique_id = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
                
                    $data = [
                        'room_id' => $room_id,
                        'customer_id' => $customer_id,
                        'unique_id' => $unique_id,
                        'transaction_type' => 'online',
                        'total_bill' => $total_bill,
                        'payment_deposit' => $deposit,
                        'checkin' => $checkin,
                        'checkout' => $checkout,
                        'transaction_status' => 'pending',
                        'total_person' => $total_peron,
                        'gcash_reference_number' => $this->request->getPost('reference_number'),
                    ];  
            
                    // update available_rooms column by decrementing the value of every reserved count
                    // $db = db_connect();
                    // $update_query = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0, available_rooms - 1, 0) WHERE id = :id: LIMIT 1";
                    // $db->query($update_query, [
                    //     'id' => $room_id,
                    // ]);
            
                
                    $customer = new RoomReservationTransactionModel();
                    $save = $customer->insert($data);
                    
                    if($save)
                    {
                        return redirect()->to(base_url('Customer/my-reservation'))
                        ->with('status_icon', 'success')
                        ->with('status_text', 'Reservation added successfully')
                        ->with('status', 'Success'); 
                    }
                    else
                    {
                        return redirect()->to(base_url('Customer/my-reservation'))
                        ->with('status_icon', 'error')
                        ->with('status_text', 'Error Processing Transaction')
                        ->with('status', 'Success'); 
                    }
                }
            }

            

        }

        

       
      
    }

    public function registerProcess()
    {   

        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);
        $validated = $this->validate([
            'name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Full name is required',
                    'alpha_space' => 'Full name only accepts letters and white spaces'
                ]
            ],

            'gender' => 'required',

            'contact' => [
                'rules' => 'required|is_unique[tbl_customers.contact]|exact_length[11]|numeric',
                'errors' => [
                    'required' => 'Contact number is required',
                    'is_unique' => 'Contact number already exist',
                    'exact_length' => 'Contact number should only have 11 numbers',
                    'alpha_numeric' => 'Contact number cannot accept letters and symbols',

                ]
            ],

            'birthdate' => 'required',

            'age' => 'required',

            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_customers.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email',
                    'is_unique' => 'Email already exist',
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[6]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be 6 character long',
                    'max_length' => 'Password cannot be longer than 20 characters',
                ]
            ],

            'address' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Address is required',
                    'alpha_space' => 'Address only accepts letters and white spaces'
                ]
            ],
        ]);

        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('customer/register', $data);
        }

        $unique_id = md5(str_shuffle('abcdefghijklmnopqrstubwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.time()));
        $date_now = date('Y-m-d h:i:s');
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => Hash::encrypt($this->request->getPost('password')),
            'gender' => $this->request->getPost('gender'), 
            'contact' => $this->request->getPost('contact'), 
            'birthdate' => $this->request->getPost('birthdate'), 
            'age' => $this->request->getPost('age'),
            'profile' => 'user_male.jpg',
            'address' => $this->request->getPost('address'),
            'activation_key' => $unique_id,
            'activation_date' => $date_now,
            'room_cancellation_limit' => 3
        ];

        $customer = new CustomersModel();
        $save = $customer->insert($data);

        if($save)
        {
            $to = $this->request->getPost('email');
            $subject = 'Account Activation link';
            $message = "<h4>Hi ".$this->request->getPost('name')."</h4>
            Your account created successfully. Please click the below link to activate your account<br><br>"
            . "This link will expire after 1 hour<br>"
            . "<a href='".base_url()."/Customer/activate/".$unique_id."'>Activate Now</a>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-Account-Activation','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                session()->setFlashdata('success', 'Account created please check your email and activate your account now');
                return redirect()->to(base_url('Customer/register'));
            }
            else
            {   
                $data['error'] = "Error saving info";
                // $data = $email->printDebugger(['header']);
                // print_r($data);
            }
        }
    }

    public function activate($key = null)
    {   
        $data = [];
        if(!empty($key))
        {   
            $db = db_connect();
            $builder = $db->table('tbl_customers');
            $builder->select('activation_date,activation_key,account_status');
            $builder->where('activation_key', $key);
            $customer_data = $builder->get()->getRow();

            if($customer_data)
            {
                if($customer_data->account_status == 'inactive')
                {
                    if($this->verifyExpiryTime($customer_data->activation_date))
                    {
                        
                        $update_query = "UPDATE tbl_customers SET account_status = :account_status: WHERE activation_key = :activation_key: LIMIT 1";
                        $db->query($update_query, [
                            'account_status' => 'active',
                            'activation_key' => $key
                        ]);

                        if($update_query)
                        {
                            $data['success'] = 'Account activated successfully';
                        }
                        
                    }
                    else
                    {
                        $delete_query = "DELETE FROM tbl_customers WHERE activation_key = :activation_key: LIMIT 1";
                            $db->query($delete_query, [
                                'activation_key' => $key
                            ]);
                        $data['error'] = 'Activation link was expired';
                    }
                }
                else
                {
                    $data['success'] = 'Your account is already activated';
                }
            }

        }
        else
        {
            $data['error'] = "Unable to find unique key";
        }

        return view('customer/activate', $data);
    }

    public function verifyExpiryTime($time)
    {
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $register_time = strtotime($time);
        $time_difference = $current_time - $register_time;

        // return 1hr
        if(3600 > $time_difference)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function entranceCottage()
    {
        $entrance = new EntranceModel();
        $cottage = new CottageModel();

        $data['cottages'] = $cottage->findAll();
        $data['entrance'] = $entrance->find(1);

        return view('customer/entrance-cottage', $data);
    }

    public function processEntranceCottage($id = null, $visit_type = null)
    {   

        $db = db_connect();

        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }

        $customer_id = session()->get('loggedCustomerId');

        if($visit_type == 'day')
        {
            $builder = $db->table('tbl_entrance');
            $builder->select('adult_price ,child_price');
            $data['entrance_fee'] = $builder->get()->getRow();
            $data['day'] = "day";
            $data['visit_type'] = "day";

        }

        if($visit_type == 'night')
        {
            $builder = $db->table('tbl_entrance');
            $builder->select('night_adult ,night_child');
            $data['entrance_fee'] = $builder->get()->getRow();
            $data['night'] = "night";
            $data['visit_type'] = "night";

        }

        $cottage = new CottageModel();
        $data['cottage'] = $cottage->find($id);

        
        $customer = new CustomersModel();
        $data['customer'] = $customer->find($customer_id);
        return view('customer/process-entrance-cottage', $data);
    }

    public function processEntranceCottageTransaction()
    {
        $validated = $this->validate([
            'adults' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please specify total adult',
                    'numeric' => 'Only accepts numbers'
                ]
            ],

            'date_visit' => 'required',
            'time_arrival' => 'required',

            'reference_number' => [
                'rules' => 'required|is_unique[tbl_entrance_cottage_transaction.gcash_reference_number]',
                'errors' => [
                    'required' => 'Reference number is required',
                    'is_unique' => 'That reference number is already exist!'
                ]
            ],
            
        ]);

        if(!$validated)
        {
            return redirect()->back();

            
        }

        $unique_id = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
        $data = [
            'unique_id' => $unique_id,
            'cottage_id' => $this->request->getPost('cottage_id'),
            'customer_id' => $this->request->getPost('customer_id'),
            'visit_type' => $this->request->getPost('visit_type'),
            'date_visit' => $this->request->getPost('date_visit'),
            'time_arrival' => $this->request->getPost('time_arrival'),
            'transaction_status' => 'pending',
            'total_bill' => $this->request->getPost('total_bill'),
            'total_adult' => $this->request->getPost('adults'),
            'total_child' => $this->request->getPost('children'),
            'total_person' => $this->request->getPost('total_person'),  
            'gcash_reference_number' => $this->request->getPost('reference_number'),  
        ];

        $entrance_cottages = new EntranceCottageTransactionModel();
        $save = $entrance_cottages->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Customer/my-reservation-entrance-cottage'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Reservation added successfully')
            ->with('status', 'Success'); 
        }
        else
        {
            return redirect()->to(base_url('Customer/my-reservation-entrance-cottage'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error Processing Transaction')
            ->with('status', 'Success'); 
        }
    }

    public function showEntranceCottageReservation()
    {
        $data['pendings'] = $this->showEntranceCottageReservationFunc('pending');

        return view('customer/my-reservation-entrance-cottage', $data);
    }

    public function showEntranceCottageReservationFunc($status)
    {
        $customer_id = session()->get('loggedCustomerId');

        $db = db_connect();
        $builder = $db->table('tbl_entrance_cottage_transaction');
        $builder->select('*');
        $builder->join('tbl_cottage', 'tbl_cottage.id = tbl_entrance_cottage_transaction.cottage_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_entrance_cottage_transaction.customer_id', 'inner');
        $builder->where('customer_id', $customer_id);
        $builder->where('transaction_status', $status);
        return $builder->get()->getResult();
    }

    public function cancelReservation()
    {
        $db = db_connect();

        // $update_customer = "UPDATE tbl_customers SET room_cancellation_limit = IF(room_cancellation_limit > 0, room_cancellation_limit - 1, 0) WHERE id = :id:";
        // $db->query($update_customer, [
        //     'id' => $this->request->getPost('customer_id'),
        // ]);

        // $room_count = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0 || available_rooms = 0, available_rooms + 1, 0) WHERE id = :id: LIMIT 1";
        // $db->query($room_count, [
        //     'id' => $this->request->getPost('room_id'),
        // ]);

        $update_trans = "UPDATE tbl_room_reservation_transactions SET transaction_status = :transaction_status:, cancellation_message = :mess: WHERE transaction_id = :id:";
        $db->query($update_trans, [
            'transaction_status' => 'cancelled',
            'mess' => $this->request->getPost('description'),
            'id' => $this->request->getPost('transaction_id'),
        ]);

        $to = $this->request->getPost('email');
        $subject = 'Room Reservation Cancellation Policy';
        $message = 'Hi '.$this->request->getPost('name').",<br>

        <h4>Cancellation Policy</h4>
        <p>
            Your " .$this->request->getPost('deposit'). " deposit payment won't be returned.
        </p><br><br>";

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('PMP-ROOM-CANCELLATION-NOTIF','PMP');
        $email->setSubject($subject);
        $email->setMessage($message);

        if($email->send())
        {
            return redirect()->to(base_url('Customer/my-reservation'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room reservation cancel succcesfullt')
            ->with('warning', 'Success');
        }
        else
        {   
            $data['error'] = "Error saving info";
            // $data = $email->printDebugger(['header']);
            // print_r($data);
        }
    }

    public function myProfile()
    {
        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }

        $id = session()->get('loggedCustomerId');
        $customer = new CustomersModel();
        $data['profile'] = $customer->find($id);

        return view('customer/my-profile', $data);
    }

    public function changeContact()
    {
        $id = $this->request->getPost('id');
        $validated = $this->validate([
            'contact' => [
                'rules' => 'required|exact_length[11]|alpha_numeric|is_unique[tbl_customers.contact,id,{id}]',
                'errors' => [
                    'required' => 'Contact number is required',
                    'is_unique' => 'Contact already exist',
                    'exact_length' => 'Contact number should only have 11 numbers',
                    'alpha_numeric' => 'Contact number cannot accept letters and symbols',
                ]
            ]
        ]);

        $data['validation'] = $this->validator;
        $customer = new CustomersModel();
        $data['profile'] = $customer->find($id);

        if(!$validated)
        {
            return view('customer/my-profile', $data);
        }

        $data = [
            'contact' => $this->request->getPost('contact')
        ];

        $customer = new CustomersModel();
        $update = $customer->update($id, $data);

        if($update)
        {
            return redirect()->to(base_url('Customer/my-profile'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Contact updated successfully')
            ->with('status', 'Success'); 
        }
        else
        {
            return redirect()->to(base_url('Customer/my-profile'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error updating data')
            ->with('status', 'Success'); 
        }
    }

    public function changePassword()
    {
        $id = $this->request->getPost('id');

        $validated = $this->validate([
            'current_pass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Current Password is required',
                ]
            ],

            'new_pass' => [
                'rules' => 'required|min_length[6]|max_length[20]',
                'errors' => [
                    'required' => 'New Password is required',
                    'min_length' => 'New Password must be 6 character long',
                    'max_length' => 'New Password cannot be longer than 20 characters',
                ]
            ],

            'confirm_pass' => [
                'rules' => 'required|matches[new_pass]',
                'errors' => [
                    'required' => 'Confirm Password is required',
                    'matches' => 'Confirm Password must match new password',
                ]
            ],
        ]);

        $data['validation'] = $this->validator;
        $customer = new CustomersModel();
        $data['profile'] = $customer->find($id);
        $data['validation2'] = "Current password doesn't match";
        if(!$validated)
        {
            return view('customer/my-profile', $data);
        }

        $customer = new CustomersModel();
        $pass = $customer->find($id);
        $get_pass = $pass->password;

        $current_pass = $this->request->getPost('current_pass');

        $new_pass = Hash::encrypt($this->request->getPost('new_pass'));

        if(Hash::check($current_pass, $get_pass))
        {
            $db = db_connect();
            $update_pass = "UPDATE tbl_customers SET password = :password: WHERE id =:id: LIMIT 1";
            $db->query($update_pass, [
                'password' => $new_pass,
                'id' => $id
            ]);

            return redirect()->to(base_url('Customer/my-profile'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Password change successfully')
            ->with('status', 'Success'); 
        }
        else
        {
            $data['validation'] = $this->validator;
            $data['validation2'] = "Current password doesn't match";
            $customer = new CustomersModel();
            $data['profile'] = $customer->find($id);
            return view('customer/my-profile', $data);
            
        }
    }

    public function changeProfile()
    {
        $validated = $this->validate([
            'profile' => [
                'rules' => 'is_image[profile]|max_size[profile,4048]|mime_in[profile,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

        ]);
        $id = $this->request->getPost('id');
        $data['validation'] = $this->validator;
        $customer = new CustomersModel();
        $data['profile'] = $customer->find($id);

        if(!$validated)
        {
            return view('customer/my-profile', $data);
        }

        // check if image has value

        if($img = $this->request->getFile('profile'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // check the profile image name
        
        $prof = $customer->find($id);
        $profile = $prof->profile;

        $db = db_connect();

        if(!empty($_FILES['profile']['name']))
        {
            if($profile != "user_male.jpg")
            {
                unlink("uploads/".$profile);
                $updateProfile = "UPDATE tbl_customers SET profile = :profile: WHERE id = :id: LIMIT 1";
                $db->query($updateProfile, [
                    'profile' => $imageName,
                    'id' => $id,
                ]);
            }
            else
            {
                $updateProfile = "UPDATE tbl_customers SET profile = :profile: WHERE id = :id: LIMIT 1";
                $db->query($updateProfile, [
                    'profile' => $imageName,
                    'id' => $id,
                ]);
            }
        }

        return redirect()->to(base_url('Customer/my-profile'))
        ->with('status_icon', 'success')
        ->with('status_text', 'Profile change successfully')
        ->with('status', 'Success'); 

    }

    public function forgotPassword()
    {
        return view('customer/forgot-password');
    }

    public function updatedAt($id)
    {   

        $db = db_connect();
        $builder = $db->table('tbl_customers');
        $builder->where('activation_key', $id);
        $builder->update(['updated_at'=>date('Y-m-d h:i:s')]);
        
        if($db->affectedRows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function forgotPasswordProcess()
    {
        $validated = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Please enter your email',
                    'valid_email' => 'Please enter a valid email'
                ]
            ]
        ]);

        $data['validation'] = $this->validator;
        if(!$validated)
        {
            return view('customer/forgot-password', $data);
        }

        $email = $this->request->getPost('email');

        $db = db_connect();
        $builder = $db->table('tbl_customers');
        $builder->select('activation_key, account_status, email, password, name');
        $builder->where('email', $email);
        $customer_data = $builder->get()->getRow();

        

        // print_r($result);
        // die;

        if(!empty($customer_data))
        {
            if($this->updatedAt($customer_data->activation_key))
            {
                $to = $email;
                $subject = 'Reset Password Link';
                $message = "<h4>Hi ".$customer_data->name."</h4>
                There was a request to change your password!<br><br>"
                . "If you did not make this request then please ignore this email.<br><br>"
                . "Otherwise, please click the link below to change your password<br><br>"
                . "<a href='".base_url()."/Customer/reset-password/".$customer_data->activation_key."'>Reset Password</a>";

                $email = \Config\Services::email();
                $email->setTo($to);
                $email->setFrom('PMP-Reset-Password-Notif','PMP');
                $email->setSubject($subject);
                $email->setMessage($message);

                if($email->send())
                {
                    session()->setFlashdata('success', 'We just sent the reset password link to your email. Please verify it within 10 minutes.');
                    return redirect()->to(base_url('Customer/forgot-password'));
                }
                else
                {   
                    $data['error'] = "Error saving info";
                }
            }
            else
            {
                session()->setFlashdata('invalid', 'Unable to update please try again later');
                return view('customer/forgot-password', ['validation' => $this->validator]);
            }
        }
        else
        {
            session()->setFlashdata('invalid', 'Email does not exist.');
            return view('customer/forgot-password', ['validation' => $this->validator]);
        }
        
    }

    public function verifyActivationKey($key)
    {   
        $db = db_connect();
        $builder = $db->table('tbl_customers');
        $builder->select('activation_key, email, updated_at');
        $builder->where('activation_key', $key);
        $result = $builder->get();

        if(count($result->getResult()) == 1)
        {
            return $result->getRowObject();
        }
        else
        {
            return false;
        }
    }


    public function resetPassword($activation_key = null)
    {

        if(!empty($activation_key))
        {
            $customer_data = $this->verifyActivationKey($activation_key);
            if(!empty($customer_data))
            {
                if($this->checkExpiryDate($customer_data->updated_at))
                {
                    $rules = [
                        'password' => [
                            'rules' => 'required|min_length[6]|max_length[20]',
                            'errors' => [
                                'required' => 'Please enter new password',
                                'min_length' => 'New password must have atleast 6 characters in length',
                                'max_length' => 'New password cannot exceed to 20 characters'
                            ]
                        ],

                        'confirm_password' => [
                            'rules' => 'required|matches[password]',
                            'errors' => [
                                'required' => 'Please enter confirm password', 
                                'matches' => 'Confirm Password must match new password',
                            ]
                        ]
                    ];

                    if($this->validate($rules))
                    {
                        $new_pass = Hash::encrypt($this->request->getPost('password'));
                        $db = db_connect();
                        $update_pass = "UPDATE tbl_customers SET password = :password: WHERE activation_key = :key: LIMIT 1";
                        $db->query($update_pass, [
                            'password' => $new_pass,
                            'key' => $activation_key
                        ]);

                        if($update_pass)
                        {
                            session()->setFlashdata('success', 'Password reset successfully');
                            return redirect()->to(base_url('Customer/login'));
                        }
                    }
                    else
                    {
                        $data['validation'] = $this->validator;

                    }
                }
                else
                {
                    $data['error'] = "Reset password link was expired";
                }
            }
            else
            {
                $data['error'] = "Unable to find customer data";
            }
        }
        else
        {
            $data['error'] = "Unauthorized access!";
        }

        return view('customer/reset-password', $data);
    }

    public function checkExpiryDate($time)
    {
        // $update_time = strtotime($time);
        // $current_time = time();
        // $time_difference = ($current_time - $update_time)/60;

        // if($time_difference < 600)
        // {
        //     return true;
        // }
        // else
        // {
        //     return false;
        // }

        $current_time = strtotime(date('Y-m-d h:i:s'));
        $update_time = strtotime($time);
        $time_difference = $current_time - $update_time;

        // return 1hr
        if($time_difference < 600)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function eventsPlace()
    {

        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);
        $db = db_connect();

        $builder = $db->table('tbl_events_places');
        $builder->select('*');
        $builder->where('status', 'active');
        $data['results'] = $builder->get()->getResult();

        return view('customer/events-place', $data);
    }

    public function eventPlaceDetails($id = null)
    {

        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        $event = new EventsPlacesModel();
        $data['event'] = $event->find($id);

        return view('customer/event-details', $data);
    }

    public function selectBookedDate($id = null)
    {

        if(!session()->has('loggedCustomerId'))
        {   
            session()->setFlashdata('invalid', 'You need to login first');
            return redirect()->to(base_url('Customer/login'));
        }

        $event = new EventsPlacesModel();
        $data['event'] = $event->find($id);

        return view('customer/select-book-date', $data);
    }

    public function bookEvent($date = null, $id = null)
    {
        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        $event = new EventsPlacesModel();
        $data['event'] = $event->find($id);

        $res = $event->find($id);

        $data['half'] = $res->rate / 2;

        $customer_id = session()->get('loggedCustomerId');
        $customer = new CustomersModel();
        $data['customer'] = $customer->find($customer_id);

        $db = db_connect();
        $builder = $db->table('tbl_payment_info');
        $builder->select('*');
        $builder->where('status', 'active');
        $data['payment'] = $builder->get()->getRow();

        $data['date'] = $date;
        return view('customer/process-book-event', $data);
    }

    public function processBookingEvent($id = null)
    {

        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }
        
        $validated = $this->validate([
            'date_book' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date book is required is required',
                ]
            ],

            'total_person' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Total person is required',
                ]
            ],

            'reference_number' => [
                'rules' => 'required|is_unique[tbl_events_transaction.gcash_reference_number]',
                'errors' => [
                    'required' => 'Reference number is required',
                    'is_unique' => 'Refenrence number already used!'
                ]
            ]
        ]);

        $event = new EventsPlacesModel();

        if(!$validated)
        {
            $customer_id = session()->get('loggedCustomerId');

            $website = new ShutdownWebsiteModel();
            $data['website'] = $website->find(1);

            
            $data['event'] = $event->find($id);

            $res = $event->find($id);

            $data['half'] = $res->rate / 2;

            $customer_id = session()->get('loggedCustomerId');
            $customer = new CustomersModel();
            $data['customer'] = $customer->find($customer_id);

            $db = db_connect();
            $builder = $db->table('tbl_payment_info');
            $builder->select('*');
            $builder->where('status', 'active');
            $data['payment'] = $builder->get()->getRow();

            $data['date'] = $this->request->getPost('date_book');;

        
            $customer = new CustomersModel();
            $data['customer'] = $customer->find($customer_id);
            $data['validation'] = $this->validator;

            return view('customer/process-book-event', $data);
        }

        $curr_date = strtotime(date('Y-m-d'));
        $date_book = strtotime($this->request->getPost('date_book'));
        $date_book2 = $this->request->getPost('date_book');

        $db = db_connect();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->where('date_book', $date_book2);
        $builder->where('event_place_id', $id);
        $builder->where('transaction_status !=', 'cancelled');
        // $builder->where('date_book')->limit(1);
        $bookings = $builder->countAllResults();

        if($bookings == 1)
        {
            return redirect()->back()
            ->with('status_icon', 'warning')
            ->with('status_text', 'That date is already booked!')
            ->with('status', 'Success'); 
        }

        if($date_book < $curr_date)
        {
            return redirect()->back()
            ->with('status_icon', 'warning')
            ->with('status_text', 'Invalid date booked')
            ->with('status', 'Success'); 
        }

        $unique_id = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));

        $data = [
            'unique_id' => $unique_id,
            'customer_id' => $this->request->getPost('customer_id'),
            'event_place_id' => $id,
            'date_book' => $this->request->getPost('date_book'),
            'total_bill' => $this->request->getPost('total_bill'),
            'payment_deposit' => $this->request->getPost('deposit'),
            'total_person' => $this->request->getPost('total_person'),
            'gcash_reference_number' => $this->request->getPost('reference_number'),
        ];

        $event_tra = new EventsPlacesTransactionModel();
        $save = $event_tra->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Customer/my-reservation-events-place'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Reservation added successfully')
            ->with('status', 'Success'); 
        }
        else
        {
            return redirect()->to(base_url('Customer/my-reservation-events-place'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error Processing Transaction')
            ->with('status', 'Success'); 
        }

    }

    public function showEventsPlaceReservation()
    {

        if(!session()->has('loggedCustomerId'))
        {   
            session()->setFlashdata('invalid', 'Invalid Credentials');
            return redirect()->to(base_url('Customer/login'));
        }

        $data['pendings'] = $this->showEventsPlaceFunc('pending');
        $data['accepteds'] = $this->showEventsPlaceFunc('accepted');
        $data['completed'] = $this->showEventsPlaceFunc('completed');
        $data['cancelled'] = $this->showEventsPlaceFunc('cancelled');

        return view('customer/my-reservation-events-place', $data);
    }

    public function showEventsPlaceFunc($status)
    {
        $customer_id = session()->get('loggedCustomerId');

        $db = db_connect();
        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('customer_id', $customer_id);
        $builder->where('transaction_status', $status);
        return $builder->get()->getResult();
    }

    public function updateRefNo()
    {
        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }
        
        $validated = $this->validate([
            'reference_number' => [
                'rules' => 'required|is_unique[tbl_events_transaction.gcash_reference_number]',
                'errors' => [
                    'required' => 'Reference number is required',
                    'is_unique' => 'Refenrence number already used!'
                ]
            ]
        ]);

        if(!$validated)
        {
            // $data['pendings'] = $this->showEventsPlaceFunc('pending');
            // $data['accepteds'] = $this->showEventsPlaceFunc('accepted');
            // $data['completed'] = $this->showEventsPlaceFunc('completed');
            // $data['cancelled'] = $this->showEventsPlaceFunc('cancelled');
    
            // return view('customer/my-reservation-events-place', $data);

            return redirect()->to(base_url('Customer/my-reservation-events-place'))
            ->with('status_icon', 'warning')
            ->with('status_text', 'Reference no. already used!')
            ->with('warning', 'Success'); 
        }

        $db = db_connect();

        $update = "UPDATE tbl_events_transaction SET gcash_reference_number = :ref:, resubmit_ref = :resub: WHERE transaction_id = :id: LIMIT 1";
        $db->query($update, [
            'ref' => $this->request->getPost('reference_number'),
            'resub' => Null,
            'id' => $this->request->getPost('id')
        ]);

        if($update)
        {
            return redirect()->to(base_url('Customer/my-reservation-events-place'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Ref no. updated please wait for our email verification')
            ->with('warning', 'Success'); 
        }
    }

    public function updateRefNoRoom()
    {
        if(!session()->has('loggedCustomerId'))
        {
            return redirect()->to(base_url('Customer/login'));
        }
        
        $validated = $this->validate([
            'reference_number' => [
                'rules' => 'required|is_unique[tbl_room_reservation_transactions.gcash_reference_number]',
                'errors' => [
                    'required' => 'Reference number is required',
                    'is_unique' => 'Refenrence number already used!'
                ]
            ]
        ]);

        if(!$validated)
        {
            return redirect()->to(base_url('Customer/my-reservation'))
            ->with('status_icon', 'warning')
            ->with('status_text', 'Reference no. already used!')
            ->with('warning', 'Success'); 
        }

        $db = db_connect();

        $update = "UPDATE tbl_room_reservation_transactions SET gcash_reference_number = :ref:, resubmit_ref = :resub: WHERE transaction_id = :id: LIMIT 1";
        $db->query($update, [
            'ref' => $this->request->getPost('reference_number'),
            'resub' => Null,
            'id' => $this->request->getPost('id')
        ]);

        if($update)
        {
            return redirect()->to(base_url('Customer/my-reservation'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Ref no. updated please wait for our email verification')
            ->with('warning', 'Success'); 
        }
    }

    public function cancelBookingEvent()
    {
        $db = db_connect();

        // $update_customer = "UPDATE tbl_customers SET room_cancellation_limit = IF(room_cancellation_limit > 0, room_cancellation_limit - 1, 0) WHERE id = :id:";
        // $db->query($update_customer, [
        //     'id' => $this->request->getPost('customer_id'),
        // ]);

        // $room_count = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0 || available_rooms = 0, available_rooms + 1, 0) WHERE id = :id: LIMIT 1";
        // $db->query($room_count, [
        //     'id' => $this->request->getPost('room_id'),
        // ]);

        $update_trans = "UPDATE tbl_events_transaction SET transaction_status = :transaction_status:, cancellation_message = :mess: WHERE transaction_id = :id:";
        $db->query($update_trans, [
            'transaction_status' => 'cancelled',
            'mess' => $this->request->getPost('description'),
            'id' => $this->request->getPost('transaction_id'),
        ]);

        $to = $this->request->getPost('email');
        $subject = 'Events & Place Cancellation Policy';
        $message = 'Hi '.$this->request->getPost('name').",<br>

        <h4>Cancellation Policy</h4>
        <p>
        Your " .$this->request->getPost('deposit'). " deposit payment won't be returned.
        </p><br><br>";

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('PMP-EVENT & PLACE-CANCELLATION-NOTIF','PMP');
        $email->setSubject($subject);
        $email->setMessage($message);

        if($email->send())
        {
            return redirect()->to(base_url('Customer/my-reservation-events-place'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Event place booking cancel successfully!')
            ->with('warning', 'Success');
        }
        else
        {   
            $data['error'] = "Error saving info";
            // $data = $email->printDebugger(['header']);
            // print_r($data);
        }
    }

    public function leaveAReview($username = null, $profile = null)
    {

        $data['username'] = $username;
        $data['profile'] = $profile;
        return view('customer/leave-a-review', $data);
    }

    public function processRatesReviews()
    {
        $data = [
            'rates' => $this->request->getPost('rate'),
            'reviews' => $this->request->getPost('review'),
            'rate_by' => $this->request->getPost('username'),
            'picture' => $this->request->getPost('profile'),
        ];

        $rates = new RatesReviewsModel();
        $save = $rates->insert($data);

        if($save)
        {
            return redirect()->to(base_url('success'));
        }
        else
        {   
            $data['error'] = "Error saving info";
            // $data = $email->printDebugger(['header']);
            // print_r($data);
        }
        
    }

    public function success()
    {
        return view('customer/success');
    }

}
