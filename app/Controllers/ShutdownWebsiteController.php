<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ShutdownWebsiteModel;

class ShutdownWebsiteController extends BaseController
{

    public function index()
    {
        $website = new ShutdownWebsiteModel();
        $data['website'] = $website->find(1);

        return view('admin/shutdown/index', $data);
    }

    public function shutdownAll()
    {   
        $db = db_connect();
        $update = "UPDATE tbl_shutdown_website SET room_reservation = :room_reservation:, event_reservation = :event_reservation:, login = :login:, register = :register: WHERE id =:id:";
        $db->query($update, [
            'room_reservation' => 1,
            'event_reservation' => 1,
            'login' => 1,
            'register' => 1,
            'id' => 1
        ]);

        if($update)
        {
            return redirect()->to(base_url('Shutdown/shutdown-website'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Shutdown all successfully')
            ->with('status', 'Success'); 
        }
    }

    public function activateAll()
    {   
        $db = db_connect();
        $update = "UPDATE tbl_shutdown_website SET room_reservation = :room_reservation:, event_reservation = :event_reservation:, login = :login:, register = :register: WHERE id =:id:";
        $db->query($update, [
            'room_reservation' => 0,
            'event_reservation' => 0,
            'login' => 0,
            'register' => 0,
            'id' => 1
        ]);

        if($update)
        {
            return redirect()->to(base_url('Shutdown/shutdown-website'))
            ->with('status_icon', 'success')
            ->with('status_text', 'Activate all successfully')
            ->with('status', 'Success'); 
        }
    }

    public function shutdownLogin()
    {   
        $status = $this->request->getPost('status');
        if($status == 0) // 0 = active
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET login = :login: WHERE id =:id:";
            $db->query($update, [
                'login' => 1, // 1 = inactive
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Login shutdown successfully')
                ->with('status', 'Success'); 
            }
        }

        else
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET login = :login: WHERE id =:id:";
            $db->query($update, [
                'login' => 0,
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Login activated successfully')
                ->with('status', 'Success'); 
            }
        }
    }

    public function shutdownRegister()
    {   
        $status = $this->request->getPost('status');
        if($status == 0) // 0 = active
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET register = :register: WHERE id =:id:";
            $db->query($update, [
                'register' => 1, // 1 = inactive
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Register shutdown successfully')
                ->with('status', 'Success'); 
            }
        }

        else
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET register = :register: WHERE id =:id:";
            $db->query($update, [
                'register' => 0,
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Register activated successfully')
                ->with('status', 'Success'); 
            }
        }
    }

    public function shutdownRoom()
    {   
        $status = $this->request->getPost('status');
        if($status == 0) // 0 = active
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET room_reservation = :room_reservation: WHERE id =:id:";
            $db->query($update, [
                'room_reservation' => 1, // 1 = inactive
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Room reservation shutdown successfully')
                ->with('status', 'Success'); 
            }
        }

        else
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET room_reservation = :room_reservation: WHERE id =:id:";
            $db->query($update, [
                'room_reservation' => 0,
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Room reservation activated successfully')
                ->with('status', 'Success'); 
            }
        }
    }

    public function shutdownEvent()
    {   
        $status = $this->request->getPost('status');
        if($status == 0) // 0 = active
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET event_reservation = :event_reservation: WHERE id =:id:";
            $db->query($update, [
                'event_reservation' => 1, // 1 = inactive
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Event reservation shutdown successfully')
                ->with('status', 'Success'); 
            }
        }

        else
        {
            $db = db_connect();
            $update = "UPDATE tbl_shutdown_website SET event_reservation = :event_reservation: WHERE id =:id:";
            $db->query($update, [
                'event_reservation' => 0,
                'id' => 1
            ]);
    
            if($update)
            {
                return redirect()->to(base_url('Shutdown/shutdown-website'))
                ->with('status_icon', 'success')
                ->with('status_text', 'Event reservation activated successfully')
                ->with('status', 'Success'); 
            }
        }
    }
}
