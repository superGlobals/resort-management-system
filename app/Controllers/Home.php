<?php

namespace App\Controllers;

use App\Models\BrgyInfoModel;
use App\Models\CustomersModel;
use App\Models\RatesReviewsModel;
use App\Models\RoomNumberModel;

class Home extends BaseController
{
    public $db;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->db = db_connect();
    }
    public function index()
    {

        $date = date('Y-m-d');
        $date2 = strtotime(date('Y-m-d'));

        $builder = $this->db->table('tbl_room_reservation_transactions');
        $data['checkin_today'] = $builder->where('checkin = ', $date)->where('payment_status', Null)->where('transaction_status', 'accepted')->countAllResults();
        $data['checkout_today'] = $builder->where('checkout = ', $date)->where('transaction_status', 'accepted')->countAllResults();

        $rates = $this->db->table('tbl_rate_reviews');
        $data['pending_rates'] = $rates->where('status', 'pending')->countAllResults();
       

        // $builder2 = $this->db->table('tbl_entrance_cottage_transaction');
        // $builder2->select('date_visit');
        // $results = $builder2->get()->getResult();
        // $data['count_entrance_cottage'] = $builder2->where('transaction_status', 'pending')->countAllResults();
        // $data['entrance_cottage_today'] = $builder2->where('date_visit =', $date)->where('transaction_status', 'pending')->countAllResults();
        // $tomorrow = strtotime(date("Y-m-d", strtotime("+1 day")));
        // $tomorrow2 = date("Y-m-d", strtotime("+1 day"));
        // $data['entrance_cottage_done'] = $builder2->where('date_visit <', $date)->where('transaction_status', 'accepted')->countAllResults();

        $builder2 = $this->db->table('tbl_events_transaction');
        // $builder2->select('date_visit');
        // $results = $builder2->get()->getResult();
        $data['count_pending_event_booking'] = $builder2->where('transaction_status', 'pending')->countAllResults();

        
        // room reservation daily revenue
        // $builder->select('sum(payment_deposit) AS daily_revenue');
        // $builder->where('transaction_date = curdate()');
        // $builder->where('transaction_status !=', 'cancelled');
        // $builder->where('transaction_status !=', 'pending');
        // $daily_room = $builder->get()->getRow();

        $tbl_room_reservation_transactions = $this->db->table('tbl_room_reservation_transactions');

        $res1 = $tbl_room_reservation_transactions->select('sum(payment_deposit) as daily_revenue')
        ->where('transaction_date = curdate()')
        ->where('transaction_status !=', 'cancelled')
        ->where('transaction_status !=', 'pending')
       ->get()->getRow();

        $tbl_events_transaction = $this->db->table('tbl_events_transaction');
        $res2 = $tbl_events_transaction->select('sum(payment_deposit) as daily_revenue')
        ->where('transaction_date = curdate()')
        ->where('transaction_status !=', 'cancelled')
        ->where('transaction_status !=', 'pending')
       ->get()->getRow();

        $data['daily_revenue'] = $res1->daily_revenue + $res2->daily_revenue;



        // event reservation daily revenue
        // $builder2->select('sum(payment_deposit) AS daily_revenue');
        // $builder2->where('transaction_date = curdate()');
        // $builder2->where('transaction_status !=', 'cancelled');
        // $builder2->where('transaction_status !=', 'pending');
        // $daily_event = $builder2->get()->getRow();

       
        // room reservation weekly revenue
        $builder->select('sum(total_bill) AS weekly_revenue');
        $builder->where('week(transaction_date) = week(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $weekly_revenue1 = $builder->get()->getRow();

        // room reservation weekly revenue
        $builder2->select('sum(total_bill) AS weekly_revenue');
        $builder2->where('week(transaction_date) = week(now())');
        $builder2->where('transaction_status !=', 'cancelled');
        $builder2->where('transaction_status !=', 'pending');
        $weekly_revenue2 = $builder2->get()->getRow();

        $data['weekly_revenue'] = $weekly_revenue1->weekly_revenue + $weekly_revenue2->weekly_revenue;


        // room reservation weekly revenue
        $builder->select('sum(total_bill) AS monthly_revenue');
        $builder->where('month(transaction_date) = month(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $monthly_revenue1 = $builder->get()->getRow();

        // room reservation weekly revenue
        $builder2->select('sum(total_bill) AS monthly_revenue');
        $builder2->where('month(transaction_date) = month(now())');
        $builder2->where('transaction_status !=', 'cancelled');
        $builder2->where('transaction_status !=', 'pending');
        $monthly_revenue2 = $builder2->get()->getRow();

        $data['monthly_revenue'] = $monthly_revenue1->monthly_revenue + $monthly_revenue2->monthly_revenue;

        // room reservation weekly revenue
        $builder->select('sum(total_bill) AS yearly_revenue');
        $builder->where('year(transaction_date) = year(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $yearly_revenue1 = $builder->get()->getRow();

        // room reservation weekly revenue
        $builder2->select('sum(total_bill) AS yearly_revenue');
        $builder2->where('year(transaction_date) = year(now())');
        $builder2->where('transaction_status !=', 'cancelled');
        $builder2->where('transaction_status !=', 'pending');
        $yearly_revenue2 = $builder2->get()->getRow();

        $data['yearly_revenue'] = $yearly_revenue1->yearly_revenue + $yearly_revenue2->yearly_revenue;

        // show pending room reservation
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('room_name, name');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('transaction_status', 'pending');
        $data['pending_rooms'] = $builder->get()->getResult();
        
        $data['today'] = $this->countTodayCustomer();


        // count pending room reservation
        $data['count_pending_room'] = $builder->where('transaction_status', 'pending')->countAllResults();
        // $builder = $db->table('tbl_room_reservation_transactions');
        // $builder->select('transaction_id, room_name, name, total_bill');
        // $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        // $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        // $builder->where('checkout = ', $date);
        // $data['checkouts'] = $builder->get()->getResult();


        return view('admin/home', $data);
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

    /**
     * Show all pending room reservation
     */
    public function pendingRoomReservation()
    {   
        
        $data['pending_rooms'] = $this->reUseAllRoomStatus('pending');

        return view('admin/pending-room-reservation', $data);
    }

    /**
     * Show all accepeted room reservation
     */
    public function acceptedRoomReservation()
    {   
        
        $data['accepted_rooms'] = $this->reUseAllRoomStatus('accepted');

        $room_num = new RoomNumberModel();
        $data['room_number'] = $room_num->where('room_number_status', 'available')->findAll();

        return view('admin/accepted-room-reservation', $data);
    }

    public function completedRoomReservation()
    {   
        
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_room_number', 'tbl_room_number.room_number_id = tbl_room_reservation_transactions.assigned_room_number', 'inner');
        $builder->where('transaction_status', 'completed');
        $builder->where('assigned_room_number !=', Null);
        $builder->orderBy('transaction_date', 'asc');
        $data['completed'] = $builder->get()->getResult();

        return view('admin/completed-room-reservation', $data);
    }

    public function cancelledRoomReservation()
    {
        $data['cancelled'] = $this->reUseAllRoomStatus('cancelled');

        return view('admin/cancelled-room-reservation', $data);
    }

    public function reUseAllRoomStatus($status)
    {
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('transaction_status', $status);
        $builder->where('assigned_room_number', Null);
        $builder->orderBy('transaction_date', 'asc');
        return $builder->get()->getResult();
    }

    public function checkInNow($id = null)
    {
        $update_transac = "UPDATE tbl_room_reservation_transactions SET payment_status = :status:, assigned_room_number = :number: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_transac, [
            'status' => 'fully paid',
            'number' => $this->request->getPost('room_number'),
            'id' => $id,
        ]);

        $update_transac = "UPDATE tbl_room_number SET room_number_status = :status: WHERE room_number_id = :id: LIMIT 1";
        $this->db->query($update_transac, [
            'status' => 'not available',
            'id' => $this->request->getPost('room_number'),
        ]);

        if($update_transac)
        {
            return redirect()->to(base_url('/room-checkin-today'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Room checkin successfully')
                ->with('status', 'Success'); 
        }
    }

    public function checkIn()
    {   
        
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_room_number', 'tbl_room_number.room_number_id = tbl_room_reservation_transactions.assigned_room_number', 'inner');
        $builder->where('transaction_status', 'accepted');
        $builder->where('assigned_room_number !=', Null);
        $builder->orderBy('transaction_date', 'asc');
        $data['all_checkin'] = $builder->get()->getResult();
        return view('admin/all-checkin', $data);
    }

    /**
     * Show all pending entrance cottage
     */
    public function pendingEntranceCottage()
    {   
        // show pending room reservation
        $builder = $this->db->table('tbl_entrance_cottage_transaction');
        $builder->select('*');
        $builder->join('tbl_cottage', 'tbl_cottage.id = tbl_entrance_cottage_transaction.cottage_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_entrance_cottage_transaction.customer_id', 'inner');
        $builder->where('transaction_status', 'pending');
        $builder->orderBy('transaction_date', 'asc');
        $data['pending_entrance_cottage'] = $builder->get()->getResult();

        return view('admin/pending-entrance-cottage', $data);
    }

    public function acceptRoomReservation($id = null)
    {
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('email,name,transaction_id,room_name,unique_id, payment_deposit');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $update_query = "UPDATE tbl_room_reservation_transactions SET transaction_status = :transaction_status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'transaction_status' => 'accepted',
            'id' => $id
        ]);
        // Your Room " .$result->room_name. " has been accepted by admin<br><br>"

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Room Notification';
            $message = "<h4>Hi ".$result->name."</h4>,
            We just receive your initial deposit a total of " .$result->payment_deposit. " <br><br>"
            
            ."When you arrive at the resort, please present the ID given below at the front desk."
            ."<h4>$result->unique_id</h4>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-ROOM-RESERVATION-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/pending-room'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Reservation accepted successfully')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/pending-room'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/pending-room'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }
    }

    public function rejectRoomReservation($id = null)
    {
        $validated = $this->validate([
            'message' => 'required'
        ]);

        if(!$validated)
        {
            return view('admin/pending-room-reservation', ['validation' => $this->validated]);
        }

        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('email,name,transaction_id,room_name,room_id');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $update_query = "UPDATE tbl_room_reservation_transactions SET transaction_status = :transaction_status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'transaction_status' => 'cancelled',
            'id' => $id
        ]);

        // $room_count = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0 || available_rooms = 0, available_rooms + 1, 0) WHERE id = :id: LIMIT 1";
        // $this->db->query($room_count, [
        //     'id' => $result->room_id,
        // ]);

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Room Notification';
            $message = "<h4>Hi ".$result->name."</h4><br><br>
            Your Room " .$result->room_name. " has been cancelled by admin<br><br>"
            ."Reason,<br>"
            . $this->request->getPost('message');

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-ROOM-RESERVATION-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/pending-room'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Reservation cancelled successfully')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/pending-room'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/pending-room'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }


    }

    public function rejectEventBooking($id = null)
    {
        $validated = $this->validate([
            'message' => 'required'
        ]);

        if(!$validated)
        {
            return view('admin/events-place-transaction/pending', ['validation' => $this->validated]);
        }

        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('email,name,transaction_id,events_name,transaction_date');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $update_query = "UPDATE tbl_events_transaction SET transaction_status = :transaction_status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'transaction_status' => 'cancelled',
            'id' => $id
        ]);

        // $room_count = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0 || available_rooms = 0, available_rooms + 1, 0) WHERE id = :id: LIMIT 1";
        // $this->db->query($room_count, [
        //     'id' => $result->room_id,
        // ]);

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Events & Place Notif';
            $message = "<h4>Hi ".$result->name."</h4><br><br>
            Your " .$result->events_name. " Event booking has been cancelled by admin<br><br>"
            ."Reason,<br>"
            . $this->request->getPost('message');

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-EVENTS & PLACE-RESERVATION-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/pending-event-booking'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Booking cancelled successfully')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/pending-event-booking'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/pending-event-booking'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }


    }

    /**
     * Show all checkout 
     */
    public function checkouToday()
    {   
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_room_number', 'tbl_room_number.room_number_id = tbl_room_reservation_transactions.assigned_room_number', 'inner');
        $builder->where('transaction_status', 'accepted');
        $builder->where('checkout', date('Y-m-d'));
        $builder->where('assigned_room_number !=', Null);
        $builder->orderBy('transaction_date', 'asc');
        $data['all_checkout'] = $builder->get()->getResult();

        return view('admin/checkout-today', $data);
    }

    /**
     * Checkout process
     */
    public function checkoutProcess($id = null)
    {
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('email,name,transaction_id,room_name,room_id,profile,room_number_id');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_room_number', 'tbl_room_number.room_number_id = tbl_room_reservation_transactions.assigned_room_number', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $name = $result->name;
        $profile = $result->profile;
        $room_number_id = $result->room_number_id;

        $update_query = "UPDATE tbl_room_reservation_transactions SET transaction_status = :transaction_status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'transaction_status' => 'completed',
            'id' => $id
        ]);

        $update_room_number = "UPDATE tbl_room_number SET room_number_status = :room_number_status: WHERE room_number_id = :id: LIMIT 1";
        $this->db->query($update_room_number, [
            'room_number_status' => 'available',
            'id' => $room_number_id
        ]);

        // $room_count = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0 || available_rooms = 0, available_rooms + 1, 0) WHERE id = :id:";
        // $this->db->query($room_count, [
        //     'id' => $result->room_id,
        // ]);

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Room Notification';
            $message = 'Hi '.$result->name.",<br><br>
            We can’t believe your stay is over! We hope to see you back soon.<br>"
            . "Could you take a moment to let us know how your stay went on<br>"
            ."<a href='".base_url()."/Customer/leave-a-review/".$name."/".$profile."'>Rate us</a>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-ROOM-RESERVATION-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/checkout-today'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Reservation completed successfully')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/checkout-today'))
                    ->with('status_icon', 'error')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/checkout-today'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving data')
            ->with('status', 'Success'); 
        }
    }

    public function pendingEventBooking()
    {   

        $data['pending'] = $this->eventBookingStatusFunc('pending');

        return view('admin/events-place-transaction/pending', $data);
    }

    public function acceptedEventBooking()
    {   

        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('payment_status', Null);
        $builder->where('transaction_status', 'accepted');
        $builder->orderBy('transaction_date', 'asc');
        $data['accepted'] = $builder->get()->getResult();

        return view('admin/events-place-transaction/accepted', $data);
    }

    public function activeEventBooking()
    {
        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('payment_status', 'fully paid');
        $builder->where('transaction_status', 'accepted');
        $builder->orderBy('transaction_date', 'asc');
        $data['active'] = $builder->get()->getResult();

        return view('admin/events-place-transaction/active', $data);
    }

    public function completedEventBooking()
    {   

        $data['completed'] = $this->eventBookingStatusFunc('completed');

        return view('admin/events-place-transaction/completed', $data);
    }

    public function cancelledEventBooking()
    {   

        $data['cancelled'] = $this->eventBookingStatusFunc('cancelled');

        return view('admin/events-place-transaction/cancel', $data);
    }

    

    public function eventBookingStatusFunc($status)
    {
        // show pending event booking
        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('transaction_status', $status);
        $builder->orderBy('transaction_date', 'asc');
        return $builder->get()->getResult();
    }

    public function resubmitGcashRefNo($id = null)
    {

        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('email,name,transaction_id,events_name,transaction_date');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $update_query = "UPDATE tbl_events_transaction SET resubmit_ref = :re: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            're' => 'true',
            'id' => $id
        ]);

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Events & Place Notif';
            $message = "<h4>Hi ".$result->name."</h4>,<br><br>
            It appears that you entered the incorrect GCash reference number when booking the" .$result->events_name. " on " .$result->transaction_date. ".You can resubmit the GCash reference number by logging in again to our website and updating it.<br><br>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-EVENTS & PLACE-RESERVATION-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/pending-event-booking'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Successfuly send notif in customers email')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/pending-event-booking'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/pending-event-booking'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }
    }

    public function resubmitGcashRefNoRoom($id = null)
    {

        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('email,name,transaction_id,room_name,transaction_date');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $update_query = "UPDATE tbl_room_reservation_transactions SET resubmit_ref = :re: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            're' => 'true',
            'id' => $id
        ]);

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Room Notification';
            $message = "<h4>Hi ".$result->name.",</h4><br><br>
            It appears that you entered the incorrect GCash reference number when booking the " .$result->room_name. " on " .$result->transaction_date. ".You can resubmit the GCash reference number by logging in again to our website and go to your room reservation and click Re submit ref no.<br><br>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-ROOM-RESERVATION-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/pending-room'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Successfuly send notif in customers email')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/pending-room'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/pending-room'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }
    }

    public function acceptEventBooking($id = null)
    {
        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('email,name,transaction_id,events_name,transaction_date,payment_deposit,unique_id');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $update_query = "UPDATE tbl_events_transaction SET transaction_status = :status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'status' => 'accepted',
            'id' => $id
        ]);
        // Your Room " .$result->room_name. " has been accepted by admin<br><br>"

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Events & Place Notif';
            $message = "<h4>Hi ".$result->name.",</h4>
            We just receive your initial deposit a total of " .$result->payment_deposit. " <br><br>"
            
            ."When you arrive at the resort, please present the ID given below at the front desk."
            ."<h4>$result->unique_id</h4>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-EVENTS & PLACE-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/pending-event-booking'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Event booking accepted successfully')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/pending-event-booking'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/pending-event-booking'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }
    }

    public function markFullyPaid($id = null)
    {
        $update_query = "UPDATE tbl_events_transaction SET payment_status = :status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'status' => 'fully paid',
            'id' => $id
        ]);

        if($update_query)
        {
            return redirect()->to(base_url('/accepted-event-booking'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Mark as fully paid successfully')
            ->with('status', 'Success'); 
        }
    }

    public function markAsCompleted($id = null)
    {
        $builder = $this->db->table('tbl_events_transaction');
        $builder->select('email,name,profile,transaction_id,events_name,transaction_date,payment_deposit,unique_id');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->where('transaction_id', $id);
        $result = $builder->get()->getRow();

        $name = $result->name;
        $profile = $result->profile;

        $update_query = "UPDATE tbl_events_transaction SET transaction_status = :status: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update_query, [
            'status' => 'completed',
            'id' => $id
        ]);
        // Your Room " .$result->room_name. " has been accepted by admin<br><br>"

        if($update_query)
        {
            $to = $result->email;
            $subject = 'Events & Place Notif';
            $message = "<h4>Hi ".$result->name.",</h4>
            You just finished the activity you had scheduled, and we are delighted to have brightened your day. Regarding the event you scheduled at our resort, kindly leave a review. Simply click the following link to submit a review. <br><br>"
            
            . "<a href='".base_url()."/Customer/leave-a-review/".$name."/".$profile."'>Rate us</a>";

            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('PMP-EVENTS & PLACE-NOTIF','PMP');
            $email->setSubject($subject);
            $email->setMessage($message);

            if($email->send())
            {
                return redirect()->to(base_url('/active-event-booking'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Mark as completed successfully')
                    ->with('status', 'Success'); 
            }
            else
            {
                return redirect()->to(base_url('/active-event-booking'))
                    ->with('status_icon', 'danger')
                    ->with('status_text', 'Error saving data')
                    ->with('status', 'Success'); 
            }
        }
        else
        {
            return redirect()->to(base_url('/active-event-booking'))
                ->with('status_icon', 'danger')
                ->with('status_text', 'Error saving data')
                ->with('status', 'Success'); 
        }
    }

    // incoming customer to checkin today
    public function roomCheckinToday()
    {   
        $date = date('Y-m-d');
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('payment_status', Null);
        $builder->where('transaction_status', 'accepted');
        $builder->where('checkin', $date);
        $data['checkin'] = $builder->get()->getResult();
        $room_num = new RoomNumberModel();
        $data['room_number'] = $room_num->where('room_number_status', 'available')->findAll();
        return view('admin/room-checkin-today/index', $data);
    }

    public function roomExtendStay($id = null)
    {   
        $builder = $this->db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('transaction_id', $id);
        $data['extend'] = $builder->get()->getRow();

        // echo "<pre>";
        // print_r($data);
        // die;
        return view('admin/room-extend-stay', $data);
    }

    public function processRoomExtendStay($id = null)
    {
        $checkin = strtotime($this->request->getPost('checkin'));
        $checkout = strtotime($this->request->getPost('checkout'));
        $current_checkout = strtotime($this->request->getPost('current_checkout'));

        if($checkout <= $current_checkout || $checkout == $checkin)
        {
            return redirect()->back()
            ->with('status_icon', 'warning')
            ->with('status_text', 'Invalid Checkin & Checkout date format')
            ->with('warning', 'Success'); 
        }
        

        $update = "UPDATE tbl_room_reservation_transactions SET total_bill = :total_bill:, checkout =:checkout: WHERE transaction_id = :id: LIMIT 1";
        $this->db->query($update, [
            'total_bill' => $this->request->getPost('total_bill'),
            'checkout' => $this->request->getPost('checkout'),
            'id' => $id
        ]);

        if($update)
        {
            return redirect()->to(base_url('/checkin'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Stay extend successfully')
                ->with('status', 'Success');
        }

    }

    public function pendingRatesReviews()
    {
        $rates = new RatesReviewsModel();
        $data['rates'] = $rates->where('status', 'pending')->findAll();
        return view('admin/rates-reviews/index', $data);
    }

    public function ratesApprove($id = null)
    {
        $rates = new RatesReviewsModel();

        $data = [
          'status' => 'approved'
        ];
        $rates->update($id, $data);

        
            $data = [
                'status' => 'Success',
                'status_text' => 'Rates approved successfully',
                'status_icon' => 'success'
            ];
    
            return $this->response->setJSON($data);
      
    }

    public function deleteRates($id = null)
    {
        $rates = new RatesReviewsModel();

        $rates->delete($id);

        
            $data = [
                'status' => 'Success',
                'status_text' => 'Rates deleted successfully',
                'status_icon' => 'success'
            ];
    
            return $this->response->setJSON($data);
      
    }
}
