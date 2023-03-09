<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomCategoryModel;

class RoomCategoryController extends BaseController
{
    /**
     * Activate url and form helpers
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Show the room category page
     */
    public function index()
    {
        $room_category_model = new RoomCategoryModel();
        $data['room_category'] = $room_category_model->findAll();

        return view('admin/room/room-category', $data);
    }

    /**
     * Show the add room category page
     */
    public function addCategory()
    {
        return view('admin/room/add_category');
    }

    /**
     * Store room category in database
     */
    public function storeRoomCategory()
    {
        // validate user inputs

        $validated = $this->validate([
            'category_name' => [
                'rules' => 'required|alpha_space|is_unique[tbl_room_category.category_name]',
                'errors' => [
                    'required' => 'Category Name is required',
                    'alpha_space' => 'Category Name cannot accept numbers and symbols',
                    'is_unique' => 'Category Name already exist',
                ]
            ],

            'max_adults_capacity' => [
                'rules' => 'permit_empty|alpha_numeric',
                'errors' => [
                    'alpha_numeric' => 'Adult capacity accept only numbers',
                ]
            ],

            'max_children_capacity' => [
                'rules' => 'permit_empty|alpha_numeric',
                'errors' => [
                    'alpha_numeric' => 'Children capacity accept only numbers',
                ]
            ],
        ]);

        if(!$validated)
        {
            return view('admin/room/add_category', ['validation' => $this->validator]);
        }

        $category_name = $this->request->getPost('category_name');
        $max_adults_capacity = $this->request->getPost('max_adults_capacity');
        $max_children_capacity = $this->request->getPost('max_children_capacity');

        $data = [
            'category_name' => $category_name,
            'max_adults_capacity' => $max_adults_capacity,
            'max_children_capacity' => $max_children_capacity,
        ];

        $room_category_model = new RoomCategoryModel();
        $save = $room_category_model->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Room/add_category'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room Category added')
            ->with('status', 'Success'); 
        }
        else
        {
            return redirect()->to(base_url('Room/add_category'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving room category')
            ->with('status', 'error');
        }

    }


    /**
     * Delete room category in database
     */
    public function deleteRoomCategory($id = null)
    {
        $room_category_model = new RoomCategoryModel();
        $delete = $room_category_model->delete($id);

        $data = [
            'status' => 'Success',
            'status_text' => 'Room Category Deleted',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }

    /**
     * Show edit room category page
     */
    public function editRoomCategory($id = null)
    {
        $room_category_model = new RoomCategoryModel();
        $data['room_category'] = $room_category_model->find($id);

        return view('admin/room/edit_category', $data);
    }

    /**
     * Update room category in database
     */
    public function updateRoomCategory($id = null)
    {
        //validate user inputs
        $id = $this->request->getPost('id');
        $validated = $this->validate([
            'category_name' => [
                'rules' => 'required|alpha_space|is_unique[tbl_room_category.category_name,id,{id}]',
                'errors' => [
                    'required' => 'Category Name is required',
                    'alpha_space' => 'Category Name cannot accept numbers and symbols',
                    'is_unique' => 'Category Name already exist',
                ]
            ],

            'max_adults_capacity' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Adult capacity is required',
                    'alpha_numeric' => 'Adult capacity accept only numbers',
                ]
            ],

            'max_children_capacity' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Children capacity is required',
                    'alpha_numeric' => 'Children capacity accept only numbers',
                ]
            ],
        ]);

        $room_category_model = new RoomCategoryModel();
        $data['room_category'] = $room_category_model->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {   
            return view('admin/room/add_category', $data);
        }

        $category_name = $this->request->getPost('category_name');
        $max_adults_capacity = $this->request->getPost('max_adults_capacity');
        $max_children_capacity = $this->request->getPost('max_children_capacity');

        $data = [
            'category_name' => $category_name,
            'max_adults_capacity' => $max_adults_capacity,
            'max_children_capacity' => $max_children_capacity,
        ];

        $room_category_model->update($id, $data);

        return redirect()->to(base_url('Room/all-category'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Room Category updated')
            ->with('status', 'Success');

    }
}
