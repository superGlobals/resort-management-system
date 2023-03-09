<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventsPlacesModel;

class EventsPlacesController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {
        $events = new EventsPlacesModel();
        $data['events'] = $events->findAll();

        return view('admin/events-places/events-places', $data);
    }

    public function add()
    {
        return view('admin/events-places/add');
    }

    public function store()
    {
        $validated = $this->validate([
            'events_name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Events name is required',
                    'alpha_space' => 'Events name cannot accept numbers and symbols'
                ]
            ],

            'max_capacity' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Max capacity is required',
                    'numeric' => 'Max capacity only accpets numbers',
                ]
            ],

            'rate' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Rate is required',
                    'numeric' => 'Rate only accpets numbers',
                ]
            ],

            'status' => 'required',

            'image' => [
                'rules' => 'is_image[image]|max_size[image,4048]|mime_in[image,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

            'description' => 'required'

        ]);

        if(!$validated)
        {
            return view('admin/events-places/add', ['validation' => $this->validator]);
        }

        if($img = $this->request->getFile('image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $data = [
            'events_name' => $this->request->getPost('events_name'),
            'max_capacity' => $this->request->getPost('max_capacity'),
            'rate' => $this->request->getPost('rate'),
            'description' => $this->request->getPost('description'),
            'images' => $imageName,
            'status' => $this->request->getPost('status'),
        ];

        $events = new EventsPlacesModel();
        $save = $events->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Events/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Events added successfully')
            ->with('status', 'Success'); 
        }
    }

    public function edit($id = null)
    {
        $events = new EventsPlacesModel();
        $data['event'] = $events->find($id);

        return view('admin/events-places/edit', $data);
    }

    public function update($id = null)
    {
        $validated = $this->validate([
            'events_name' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Events name is required',
                    'alpha_space' => 'Events name cannot accept numbers and symbols'
                ]
            ],

            'max_capacity' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Max capacity is required',
                    'numeric' => 'Max capacity only accpets numbers',
                ]
            ],

            'rate' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Rate is required',
                    'numeric' => 'Rate only accpets numbers',
                ]
            ],

            'status' => 'required',

            'image' => [
                'rules' => 'is_image[image]|max_size[image,4048]|mime_in[image,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

            'description' => 'required'

        ]);

        $events = new EventsPlacesModel();
        $data['event'] = $events->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/events-places/add', $data);
        }

        if($img = $this->request->getFile('image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $img = $events->find($id);
        $imageRes = $img->images;

        $db = db_connect();

        if(!empty($_FILES['image']['name']))
        {
            unlink("uploads/".$imageRes);
            $updateProfile = "UPDATE tbl_events_places SET images = :images: WHERE id = :id: LIMIT 1";
            $db->query($updateProfile, [
                'images' => $imageName,
                'id' => $id,
            ]);
            
        }

        $data = [
            'events_name' => $this->request->getPost('events_name'),
            'max_capacity' => $this->request->getPost('max_capacity'),
            'rate' => $this->request->getPost('rate'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
        ];

        $save = $events->update($id, $data);

        if($save)
        {
            return redirect()->to(base_url('Events/events-places'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Events updated successfully')
            ->with('status', 'Success'); 
        }

    }
}
