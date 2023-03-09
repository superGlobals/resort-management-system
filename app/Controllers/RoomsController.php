<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomCategoryModel;
use App\Models\RoomNumberModel;
use App\Models\RoomReservationTransactionModel;
use App\Models\RoomsModel;

class RoomsController extends BaseController
{   

    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Show all rooms page
     */
    public function index()
    {
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id', 'inner');
        $data['rooms'] = $builder->get()->getResult();

        return view('admin/room/all-rooms', $data);
    }

    /**
     * Show add room page
     */
    public function addRoom()
    {
        $room_category = new RoomCategoryModel();
        $data['room_category'] = $room_category->findAll();

        return view('admin/room/add_room', $data);
    }

    /**
     * Store room info in database
     */
    public function storeRoom()
    {
        //validate user inputs

        $validated = $this->validate([
            'room_name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Room Name is required',
                    'alpha_space' => 'Room Name only accept letters and white spaces',
                ]
            ],
            'room_category' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room Category is required',
                ]
            ],
            'rate_per_night' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Rate per night is required',
                    'alpha_numeric' => 'Rate per night only accept numbers',
                ]
            ],
            'room_status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room Status is required',
                ]
            ],
            'room_image' => [
                'rules' => 'is_image[room_image]|max_size[room_image,4048]|mime_in[room_image,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

            'room_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room Description in required',
                ]
            ],
        ]);

        $room_category = new RoomCategoryModel();
        $data['room_category'] = $room_category->findAll();
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/room/add_room', $data);
        }

        // check if image has value

        if($img = $this->request->getFile('room_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $room_name = $this->request->getPost('room_name');
        $room_category = $this->request->getPost('room_category');
        $available_rooms = $this->request->getPost('available_rooms');
        $rate_per_night = $this->request->getPost('rate_per_night');
        $room_status = $this->request->getPost('room_status');
        $room_image = $imageName;
        $room_description = $this->request->getPost('room_description');

        $data = [
            'room_name' => $room_name,
            'room_category_id' => $room_category,
            'available_rooms' => $available_rooms,
            'rate_per_night' => $rate_per_night,
            'room_status' => $room_status,
            'room_image' => $room_image,
            'room_description' => $room_description,
        ];
       
        $rooms = new RoomsModel();
        $save = $rooms->insert($data);
        
        if($save)
        {
            return redirect()->to(base_url('Room/add_room'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room added successfully')
            ->with('status', 'Success'); 
        }

    }

    public function edit($id = null)
    {
        $room_category = new RoomCategoryModel();
        $data['room_category'] = $room_category->findAll();
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->where('id', $id);
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id', 'inner');
        $data['room'] = $builder->get()->getRow();
        return view('admin/room/edit-room', $data);
    }

    public function update($id = null)
    {
        $validated = $this->validate([
            'room_name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Room Name is required',
                    'alpha_space' => 'Room Name only accept letters and white spaces',
                ]
            ],
            'room_category' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room Category is required',
                ]
            ],
            'rate_per_night' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Rate per night is required',
                    'alpha_numeric' => 'Rate per night only accept numbers',
                ]
            ],
            'room_status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room Status is required',
                ]
            ],
            'room_image' => [
                'rules' => 'is_image[room_image]|max_size[room_image,4048]|mime_in[room_image,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

            'room_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room Description in required',
                ]
            ],
        ]);

        $room_category = new RoomCategoryModel();
        $data['room_category'] = $room_category->findAll();
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id', 'inner');
        $data['room'] = $builder->get()->getRow();
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/room/edit-room', $data);
        }

        if($img = $this->request->getFile('room_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $room = new RoomsModel();

        $room_img = $room->find($id);
        $room_image = $room_img->room_image;

        $db = db_connect();

        if(!empty($_FILES['room_image']['name']))
        {
            
            unlink("uploads/".$room_image);
            $updateProfile = "UPDATE tbl_rooms SET room_image = :room_image: WHERE id = :id: LIMIT 1";
            $db->query($updateProfile, [
                'room_image' => $imageName,
                'id' => $id,
            ]);
           
        }

        $data = [
            'room_name' => $this->request->getPost('room_name'),
            'room_category_id' => $this->request->getPost('room_category'),
            'available_rooms' => $this->request->getPost('available_rooms'),
            'rate_per_night' => $this->request->getPost('rate_per_night'),
            'room_status' => $this->request->getPost('room_status'),
            'room_description' => $this->request->getPost('room_description'),
        ];
       
        $update = $room->update($id,$data);
        
        if($update)
        {
            return redirect()->to(base_url('Room/all-rooms'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room updated successfully')
            ->with('status', 'Success'); 
        }
    }

    /**
     * Show all rooms reservation
     */
    public function roomsReservation()
    {
        $db = db_connect();
        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('*');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('transaction_status', 'accepted');
        $data['reserved_rooms'] = $builder->get()->getResult();

        return view('admin/room/rooms-reservation', $data);
    }

    /**
     * Show all available rooms
     */
    public function availableRooms()
    {
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id');
        $data['rooms'] = $builder->get()->getResult();

        return view('admin/room/available-rooms', $data);
    }

    /**
     * Show single room
     */
    public function viewRoomFullDetails($id = null)
    {
        $db = db_connect();
        $builder = $db->table('tbl_rooms');
        $builder->select('*');
        $builder->join('tbl_room_category', 'tbl_room_category.category_id = tbl_rooms.room_category_id');
        $builder->where('available_rooms >', 0);
        $builder->where('id', $id);
        $data['room'] = $builder->get()->getRow();

        return view('admin/room/room-full-details', $data);
    }

}
