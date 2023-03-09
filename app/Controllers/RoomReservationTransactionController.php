<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\RoomReservationTransactionModel;
use App\Models\RoomsModel;

class RoomReservationTransactionController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index($id = null)
    {
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id', 'inner');
        $builder->where('id', $id);
        $data['room'] = $builder->get()->getRow(); // getRow return single row

        $builder = $db->table('tbl_customers');
        $builder->select('*');
        $builder->where('account_status', 'verified');
        $data['customers'] = $builder->get()->getResult(); // getResult return array of results

        return view('admin/room/reservation-transaction', $data);
    }

    public function storeRoomReservation()
    {

        $validated = $this->validate([
            'customer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Customer is required'
                ]
            ],

            'payment_method' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Payment method is required'
                ]
            ],

            'checkin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Checkin is required'
                ]
            ],

            'checkout' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Checkout method is required'
                ]
            ],
        ]);

        $db = db_connect();
        $id = $this->request->getPost('room_id');
        if(!$validated)
        {

            $data['validation'] = $this->validator;

            return redirect()->back();
        }

        $room_rate = $db->query("SELECT rate_per_night FROM tbl_rooms WHERE id = '$id'");
        $room_rate_result = $room_rate->getRow();
        
        $customer = $this->request->getPost('customer');
        $payment_type = $this->request->getPost('payment_method');
        $checkin = strtotime($this->request->getPost('checkin'));
        $checkout = strtotime($this->request->getPost('checkout'));

        $date = $checkout - $checkin;
        $total_date = $date/(60*60*24);
        $price = $room_rate_result->rate_per_night;

        $total_bill = $price * $total_date;

        $transaction_type = 'walk-in';

        $total_person = $this->request->getPost('adults') + $this->request->getPost('children');

        $data = [
            'room_id' => $id,
            'customer_id' => $customer,
            'transaction_type' => $transaction_type,
            'payment_type' => $payment_type,
            'total_bill' => $total_bill,
            'checkin' => $this->request->getPost('checkin'),
            'checkout' => $this->request->getPost('checkout'),
            'transaction_status' => 'accepted',
            'total_person' => $total_person,
        ];

        if($checkout < $checkin || $checkout == $checkin)
        {
            return redirect()->back()
            ->with('status_icon', 'warning')
            ->with('status_text', 'Bawal yan hahah')
            ->with('warning', 'Success'); 
        }

        // update available_rooms column by decrementing the value of every reserved count
        
        $update_query = "UPDATE tbl_rooms SET available_rooms = IF(available_rooms > 0, available_rooms - 1, 0) WHERE id = :id:";
        $db->query($update_query, [
            'id' => $id,
        ]);

        $transaction = new RoomReservationTransactionModel();
        $save = $transaction->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Room/available-rooms'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room reserved successfully')
            ->with('status', 'Success'); 
        }

    }

    /**
     * Show edit room reservation
     */
    public function editRoomReservation($customer_id = null, $room_id = null)
    {
        $db = db_connect();
        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('customer_id', $customer_id);
        $builder->where('room_id', $room_id);
        $data['reserve_room'] = $builder->get()->getRow();

        return view('admin/room/edit_room_reservation', $data);
    }

    /**
     * Update room reservation details
     */
    public function updateRoomReservation($id = null)
    {
        
        $checkin = strtotime($this->request->getPost('checkin'));
        $checkout = strtotime($this->request->getPost('checkout'));
        $checkoutdate_old = strtotime($this->request->getPost('checkoutdate_old'));
        $price = $this->request->getPost('total_bill');

        $date = $checkout - $checkin;
        $total_date = $date/(60*60*24);

        $total_bill = $price * $total_date;

        if($checkout == $checkin)
        {
            return redirect()->back()
            ->with('status_icon', 'warning')
            ->with('status_text', 'Checkout date cannot be the same with checkin date')
            ->with('warning', 'Success'); 
        }

        if($checkout < $checkoutdate_old)
        {
            return redirect()->back()
            ->with('status_icon', 'warning')
            ->with('status_text', 'Bawal yan hahah')
            ->with('warning', 'Success'); 
        }

        $db = db_connect();
        $update_query = "UPDATE tbl_room_reservation_transactions SET total_bill = :total_bill:, checkout = :checkout: WHERE transaction_id = :id:";
        $db->query($update_query, [
            'total_bill' => $total_bill,
            'checkout' => $this->request->getPost('checkout'),
            'id' => $id,
        ]);

        return redirect()->to(base_url('Room/rooms-reservation'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Checkout date updated successfully')
            ->with('status', 'Success');

        
    }
}
