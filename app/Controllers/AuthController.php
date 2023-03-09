<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\UsersModel;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    /**
     * Activate the helper and create function in helper folder
     */
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        if(session()->has('loggedUserId'))
        {
            return redirect()->to(base_url('dashboard/home'));
        }
        else
        {
            return view('admin/auth/login');
        }
    }

    /**
     * Loggedin user
     */
    public function loginUser()
    {
        // validate user input
        $validated = $this->validate([

            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Please enter your email',
                    'valid_email' => 'Please enter a valid email',
                ]
            ],

            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please enter your Password',
                    
                ]
            ],

        ]);

        if(!$validated)
        {
            return view('admin/auth/login', ['validation' => $this->validator]);
        }
        else
        {
            // check the user details in database
            $email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
            $password = $this->request->getPost('password', FILTER_SANITIZE_SPECIAL_CHARS);

            $user = new UsersModel();
            $userInfo = $user->where('email', $email)->first();

            if($userInfo)
            {   

                if($checkPass = Hash::check($password, $userInfo->password))
                {
                    $data = [
                        'loggedUserId' => $userInfo->id,
                        'loggedUserAccess' => $userInfo->user_access,
                        'loggedFirstName' => $userInfo->firstname,
                        'loggedUserProfile' => $userInfo->profile,
                    ];

                    session()->set($data);

                    return redirect()->to(base_url('/admin'))
                    ->with('status_icon', 'success')
                    ->with('status_text', 'Welcome ' . ucfirst(session()->get('loggedUserAccess')) .' '. ucfirst(session()->get('loggedFirstName')))
                    ->with('status', 'Success');;
                }
                else
                {
                    session()->setFlashdata('invalid', 'Invalid Credentials');
                    return redirect()->to(base_url('/Auth/login'));
                }

            }
            else
            {
                session()->setFlashdata('invalid', 'Invalid Credentials');
                return redirect()->to(base_url('/Auth/login'));
            }
        }
    }

    public function logout()
    {
        if(session()->has('loggedUserId') || session()->has('loggedUserRole') || session()->has('loggedUserProfile'))
        {
            session()->remove('loggedUserId');
            session()->remove('loggedUserRole');
            session()->remove('loggedUserProfile');
        }

        return redirect()->to(base_url('/Auth/login'))->with('invalid', 'You are logged out');
    }
}
