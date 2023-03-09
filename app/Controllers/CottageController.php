<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CottageModel;

class CottageController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {
        $cottage = new CottageModel();
        $data['cottages'] = $cottage->findAll();

        return view('admin/cottage/cottage-list', $data);
    }

    public function add()
    {
        return view('admin/cottage/add_cottage');
    }

    public function store()
    {
        $validated = $this->validate([
            'cottage_name' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Cottage name is required',
                    'alpha_numeric_space' => 'Cottage name only accept letters, numbers and whitespaces'
                ]
            ],

            'cottage_capacity' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Cottage capacity is required',
                    'numeric' => 'Cottage capacity only accepts numbers'
                ]
            ],

            'available_cottage' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Available cottage is required',
                    'numeric' => 'Available cottage only accepts numbers'
                ]
            ],

            'cottage_price' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Cottage price is required',
                    'numeric' => 'Cottage price only accepts numbers'
                ]
            ],

            'cottage_image' => [
                'rules' => 'uploaded[cottage_image]|is_image[cottage_image]|max_size[cottage_image,4028]|mime_in[cottage_image,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'uploaded' => 'Cottage image is required',
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

        ]);

        if(!$validated)
        {
            return view('admin/cottage/add_cottage', ['validation' => $this->validator]);
        }

        // check if image has value

        if($img = $this->request->getFile('cottage_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $data = [
            'cottage_name' => $this->request->getPost('cottage_name'),
            'cottage_capacity' => $this->request->getPost('cottage_capacity'),
            'available_cottage' => $this->request->getPost('available_cottage'),
            'cottage_price' => $this->request->getPost('cottage_price'),
            'cottage_image' => $imageName,
        ];

        $cottage = new CottageModel();
        $save = $cottage->insert($data);

        if($save)
        {

            return redirect()->to(base_url('Cottage/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Cottage added successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Cottage/add'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving Cottage')
            ->with('status', 'error');
        }
    }

    public function edit($id =null)
    {   
        $cottage = new CottageModel();
        $data['cottage'] = $cottage->find($id);

        return view('admin/cottage/edit_cottage', $data);
    }

    public function update($id = null)
    {
        $validated = $this->validate([
            'cottage_name' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Cottage name is required',
                    'alpha_numeric_space' => 'Cottage name only accept letters, numbers and whitespaces'
                ]
            ],

            'cottage_capacity' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Cottage capacity is required',
                    'numeric' => 'Cottage capacity only accepts numbers'
                ]
            ],

            'available_cottage' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Available cottage is required',
                    'numeric' => 'Available cottage only accepts numbers'
                ]
            ],

            'cottage_price' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Cottage price is required',
                    'numeric' => 'Cottage price only accepts numbers'
                ]
            ],

            'cottage_image' => [
                'rules' => 'is_image[cottage_image]|max_size[cottage_image,4028]|mime_in[cottage_image,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

        ]);
        
        $cottage = new CottageModel();
        $data['cottage'] = $cottage->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/cottage/add_cottage', $data);
        }

        // check if image has value

        if($img = $this->request->getFile('cottage_image'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // check the cottage image name
        
        $cot = $cottage->find($id);
        $cottage_img = $cot->cottage_image;

        $db = db_connect();

        if(!empty($_FILES['cottage_image']['name']))
        {
            if($cottage_img != "no_image.jpg")
            {
                unlink("uploads/".$cottage_img);
                $updateCottageImage = "UPDATE tbl_cottage SET cottage_image = :cottage_image: WHERE id = :id: LIMIT 1";
                $db->query($updateCottageImage, [
                    'cottage_image' => $imageName,
                    'id' => $id,
                ]);
            }
            else
            {
                $updateCottageImage = "UPDATE tbl_cottage SET cottage_image = :cottage_image: WHERE id = :id: LIMIT 1";
                $db->query($updateCottageImage, [
                    'cottage_image' => $imageName,
                    'id' => $id,
                ]);
            }
        }

        $data = [
            'cottage_name' => $this->request->getPost('cottage_name'),
            'cottage_capacity' => $this->request->getPost('cottage_capacity'),
            'available_cottage' => $this->request->getPost('available_cottage'),
            'cottage_price' => $this->request->getPost('cottage_price'),
        ];

        $save = $cottage->update($id, $data);

        if($save)
        {

            return redirect()->to(base_url('Cottage/cottage-list'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Cottage updated successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Cottage/cottage-list'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving Cottage')
            ->with('status', 'error');
        }
    }
}
