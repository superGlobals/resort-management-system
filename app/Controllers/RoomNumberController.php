<?php

namespace App\Controllers;

use App\Models\RoomNumberModel;
use App\Controllers\BaseController;

class RoomNumberController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {
        $room_num = new RoomNumberModel();
        $data['room_num'] = $room_num->findAll();

        return view('admin/room-number/index', $data);
    }

    public function add()
    {
        return view('admin/room-number/add');
    }

    public function store()
    {
        $validated = $this->validate([
            'room_number' => 'required'
        ]);

        if(!$validated)
        {
            return view('admin/room-number/add', ['validation' => $this->validator]);
        }

        $data = [
            'room_number' => $this->request->getPost('room_number'),
            'room_number_status' => $this->request->getPost('status'),
        ];

        $room_num = new RoomNumberModel();
        $save = $room_num->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Room-number/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room number added successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Room-number/add'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving user')
            ->with('status', 'error');
        }
    }

    public function edit($id = null)
    {
        $room_num = new RoomNumberModel();
        $data['number'] = $room_num->find($id);

        return view('admin/room-number/edit', $data);
    }

    public function update($id = null)
    {
        $validated = $this->validate([
            'room_number' => 'required'
        ]);

        $room_num = new RoomNumberModel();
        $data['number'] = $room_num->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/room-number/add', $data);
        }

        $data = [
          'room_number' => $this->request->getPost('room_number'),
          'room_number_status' => $this->request->getPost('status'),
        ];

        $update = $room_num->update($id, $data);

        if($update)
        {
            return redirect()->to(base_url('Room-number/room-number'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room number updated successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Room-number/room-number'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving user')
            ->with('status', 'error');
        }
    }

    public function delete($id = null)
    {
        $room_num = new RoomNumberModel();
       
        $room_num->delete($id);


        $data = [
            'status' => 'Success',
            'status_text' => 'Room number deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }

}
