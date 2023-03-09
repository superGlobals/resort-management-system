<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentModel;

class PaymentController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {

        $gcash = new PaymentModel();
        $data['payments'] = $gcash->findAll();
        return view('admin/payment/gcash-info', $data);
    }

    public function add()
    {
        return view('admin/payment/add');
    }

    public function store()
    {
        $validated = $this->validate([
            'gcash_number' => 'required|numeric|exact_length[11]|is_unique[tbl_payment_info.gcash_number]',
            'gcash_qr' => 'is_image[gcash_qr]|max_size[gcash_qr,2048]|mime_in[gcash_qr,image/png,image/jpeg,image/jpg]',
        ]);

        if(!$validated)
        {
            return view('admin/payment/add', ['validation' => $this->validator]);
        }

        if($img = $this->request->getFile('gcash_qr'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $data = [
            'gcash_number' => $this->request->getPost('gcash_number'),
            'gcash_qr' => $imageName,
            'status' => 'inactive'
        ];

        $gcash = new PaymentModel();
        $save = $gcash->insert($data);

        if($save)
        {
            return redirect()->to(base_url('Payment/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Gcash added successfully')
            ->with('status', 'error');
        }
    }

    public function setStatus()
    {
        $db = db_connect();
        
        $builder = $db->table('tbl_payment_info');
        $builder->select('id,status');
        $builder->where('status', 'active');
        $result = $builder->get()->getRow();

        $status = $this->request->getPost('status');

        if($result)
        {
            if($status == 'inactive')
            {

                $update = "UPDATE tbl_payment_info SET status = :status: WHERE id = :id: LIMIT 1";
                $db->query($update, [
                    'status' => 'active',
                    'id' => $this->request->getPost('id')
                ]);


                $update2 = "UPDATE tbl_payment_info SET status = :status: WHERE id = :id: LIMIT 1";
                $db->query($update, [
                    'status' => 'inactive',
                    'id' => $result->id
                ]);
            }
        }
        else
        {
            $update = "UPDATE tbl_payment_info SET status = :status: WHERE id = :id: LIMIT 1";
            $db->query($update, [
                'status' => 'active',
                'id' => $this->request->getPost('id')
            ]);
        }

        if($update)
        {
            return redirect()->to(base_url('Payment/gcash-info'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Updated successfully')
            ->with('status', 'error');
        }
    }

    public function edit($id = null)
    {
        $payment = new PaymentModel();
        $data['payment'] = $payment->find($id);

        return view('admin/payment/edit', $data);
    }

    public function update($id = null)
    {
        $db = db_connect();
        $id = $this->request->getPost('id');
        $file_name = $this->request->getPost('file_name');
        $validated = $this->validate([
            'gcash_number' => 'required|numeric|exact_length[11]|is_unique[tbl_payment_info.gcash_number,id,{id}]',
            'gcash_qr' => 'is_image[gcash_qr]|max_size[gcash_qr,2048]|mime_in[gcash_qr,image/png,image/jpeg,image/jpg]',
        ]);

        $payment = new PaymentModel();
        $data['payment'] = $payment->find($id);
        $data['validation'] = $this->validator;
        if(!$validated)
        {
            return view('admin/payment/edit', $data);
        }

        if($img = $this->request->getFile('gcash_qr'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        if(!empty($_FILES['gcash_qr']['name']))
        {
            unlink("uploads/".$file_name);
            $update = "UPDATE tbl_payment_info SET gcash_qr = :gcash_qr: WHERE id = :id: LIMIT 1";
            $db->query($update, [
                'gcash_qr' => $imageName,
                'id' => $id,
            ]);
        }

        $data = [
            'gcash_number' => $this->request->getPost('gcash_number')
        ];

        $payment = new PaymentModel();
        $save = $payment->update($id, $data);

        if($save)
        {
            return redirect()->to(base_url('Payment/gcash-info'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Updated successfully')
            ->with('status', 'error');
        }
    }
}
