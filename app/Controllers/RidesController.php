<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RidesModel;

class RidesController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {   
        $rides = new RidesModel();
        $data['rides'] = $rides->findAll();

        return view('customer/show-rides', $data);
    }

    public function adminShow()
    {   
        $rides = new RidesModel();
        $data['rides'] = $rides->findAll();

        return view('admin/rides/index', $data);
    }

    public function add()
    {
        return view('admin/rides/add');
    }

    public function store()
    {
        $validated = $this->validate([
            'rides_name' => 'required|alpha_space',

            'image' => 'is_image[image]|max_size[image,2048]|mime_in[image,image/png,image/jpeg,image/jpg]',

            'description' => 'required',

        ]);

        if(!$validated)
        {
            return view('admin/rides/add', ['validation'=>$this->validator]);
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
            'rides_name' => $this->request->getPost('rides_name'),
            'image' => $imageName,
            'description' => $this->request->getPost('description'),
        ];

        $ride = new RidesModel();
        $save = $ride->insert($data);

        if($save)
        {

            return redirect()->to(base_url('Rides/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Ride added successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Rides/add'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving user')
            ->with('status', 'error');
        }
    }

    public function edit($id = null)
    {   
        $ride = new RidesModel();
        $data['ride'] = $ride->find($id);

        return view('admin/rides/edit', $data);
    }

    public function update($id = null)
    {
        $validated = $this->validate([
            'rides_name' => 'required|alpha_space',

            'image' => 'is_image[image]|max_size[image,2048]|mime_in[image,image/png,image/jpeg,image/jpg]',

            'description' => 'required',

        ]);

        $ride = new RidesModel();
        $data['ride'] = $ride->find($id);

        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/rides/add', $data);
        }

        if($img = $this->request->getFile('image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $image = $ride->find($id);
        $image_res = $image->image;

        $db = db_connect();

        if(!empty($_FILES['image']['name']))
        {
            
            unlink("uploads/".$image_res);
            $updateImage = "UPDATE tbl_rides SET image = :image: WHERE id = :id: LIMIT 1";
            $db->query($updateImage, [
                'image' => $imageName,
                'id' => $id,
            ]);
           
        }

        $data = [
            'rides_name' => $this->request->getPost('rides_name'),
            'description' => $this->request->getPost('description'),
        ];

        $update = $ride->update($id, $data);

        if($update)
        {
            return redirect()->to(base_url('Rides'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Ride updaed successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Rides'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving user')
            ->with('status', 'error');
        }

    }

    public function delete($id = null)
    {
        $ride = new RidesModel();
        $image = $ride->find($id);
        $image_res = $image->image;

        unlink("uploads/".$image_res);
        $ride->delete($id);


        $data = [
            'status' => 'Success',
            'status_text' => 'Ride deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
}
