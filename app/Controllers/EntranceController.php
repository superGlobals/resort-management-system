<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EntranceModel;

class EntranceController extends BaseController
{   
    
    public function __construct()
    {
        helper(['url', 'form']);
    }
    /**
     * Show entrance fee
     */
    public function index()
    {
        $entrance =  new EntranceModel();
        $data['entrances'] = $entrance->findAll();

        return view('admin/entrance/entrance-list', $data);
    }

    /**
     * Show add entrace fee page
     */
    public function add()
    {
        return view('admin/entrance/add_entrance');
    }

    /**
     * Store entrance fee 
     */
    public function store()
    {
        $validated = $this->validate([
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
        ]);

        if(!$validated)
        {
            return view('admin/entrance/add_entrance', ['validation' => $this->validator]);
        }

        $data = [
            'adult_price' => $this->request->getPost('adult_price'),
            'child_price' => $this->request->getPost('child_price'),
        ];

        $entrance = new EntranceModel();
        $save = $entrance->insert($data);

        if($save)
        {

            return redirect()->to(base_url('Entrance/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Entrance fee added')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Entrance/add'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving entrance')
            ->with('status', 'error');
        }
    }

    /**
     * sHOW EDIT ENTRANCE PAGE
     */
    public function edit($id = null)
    {
        $entrance =  new EntranceModel();
        $data['entrance'] = $entrance->find($id);

        return view('admin/entrance/edit_entrance', $data);
    }

    /**
     * Update entrance fee
     */
    public function update($id = null)
    {
        $validated = $this->validate([
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
        ]);

        $entrance =  new EntranceModel();
        $data['entrance'] = $entrance->find($id);
        $data['validation'] = $this->validator;

        if(!$validated)
        {
            return view('admin/entrance/add_entrance', $data);
        }

        $data = [
            'adult_price' => $this->request->getPost('adult_price'),
            'child_price' => $this->request->getPost('child_price'),
            'night_adult' => $this->request->getPost('night_adult'),
            'night_child' => $this->request->getPost('night_child'),
            'overnight_adult' => $this->request->getPost('overnight_adult'),
            'overnight_child' => $this->request->getPost('overnight_child'),
        ];

        $update = $entrance->update($id, $data);

        if($update)
        {

            return redirect()->to(base_url('Entrance/entrance-list'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Entrance fee updated')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('Entrance/entrance-list'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving entrance')
            ->with('status', 'error');
        }
    }
}
