<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactsModel;

class ContactsController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }
    public function index()
    {

        $contact = new ContactsModel();
        $data['contact'] = $contact->findAll();
        return view('admin/contacts/index', $data);
    }

    public function edit($id = null)
    {
        $contact = new ContactsModel();
        $data['contact'] = $contact->find($id);
        return view('admin/contacts/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'contact' => $this->request->getPost('contact'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email'),
            'working_hours' => $this->request->getPost('working_hours'),
        ];

        $contact = new ContactsModel();
        $update = $contact->update($id, $data);

        if($update)
        {

            return redirect()->to(base_url('Contacts'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Contacts updated successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Contacts'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving Contacts')
            ->with('status', 'error');
        }
    }
}
