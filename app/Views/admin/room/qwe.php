<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomCategoryModel;
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
        $builder->join('tbl_room_category', 'tbl_room_category.id = tbl_rooms.room_category_id', 'inner');
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
        $rate_per_night = $this->request->getPost('rate_per_night');
        $room_status = $this->request->getPost('room_status');
        $room_image = $imageName;
        $room_description = $this->request->getPost('room_description');

        $data = [
            'room_name' => $room_name,
            'room_category_id' => $room_category,
            'rate_per_night' => $rate_per_night,
            'room_status' => $room_status,
            'room_image' => $room_image,
            'room_description' => $room_description,
        ];
        $db = db_connect();
        $available_rooms = $db->query("SELECT available_rooms FROM tbl_room_category WHERE id = '$room_category'");
        $availableRoomsResult = $available_rooms->getRow();

        // update available_rooms column by decrementing the value of every rooms add
        
        $update_query = "UPDATE tbl_room_category SET available_rooms = IF(available_rooms > 0, available_rooms - 1, 0) WHERE id = :id:";
        $db->query($update_query, [
            'id' => $room_category,
        ]);

        
        if($availableRoomsResult->available_rooms == 0)
        {
            $room_category = new RoomCategoryModel();
            $data['room_category'] = $room_category->findAll();
            $data['validation'] = $this->validator;

            session()->setFlashdata('status_icon', 'warning');
            session()->setFlashdata('status_text', 'You already add the maximum rooms for that category');
            session()->setFlashdata('warning', 'Success');
            return view('admin/room/add_room', $data);

        }
        else
        {
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
    }
}
