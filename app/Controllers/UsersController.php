<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Controllers\BaseController;
use App\Models\ActivityLogModel;
use App\Models\UsersModel;

class UsersController extends BaseController
{   

    public function __construct()
    {
        helper(['url', 'form']);
    }
    /**
     * View the user page
     */
    public function index()
    {   

        $user = new UsersModel();
        $data['users'] = $user->findAll();

        return view('admin/user/user-management', $data);
    }

    /**
     * View the add user page
     * 
     */
    public function addUser()
    {
        return view('admin/user/add_user');
    }

    /**
     * Store user info in database
     */
    public function storeUser()
    {
        // validate the user inputs

        $validated = $this->validate([

            'firstname' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'First Name is required',
                    'alpha_space' => 'First Name cannot accept numbers and symbols',
                ]
            ],

            'middlename' => [
                'rules' => 'permit_empty|alpha_space',
                'errors' => [
                    'required' => 'Middle Name is required',
                    'alpha_space' => 'Middle Name cannot accept numbers and symbols',
                ]
            ],

            'lastname' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Last Name is required',
                    'alpha_space' => 'Last Name cannot accept numbers and symbols',
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_users.email]',
                'errors' => [
                    'required' => 'Email Name is required',
                    'valid_email' => 'Please enter a valid email',
                    'is_unique' => 'Email already exist',
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[6]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be 6 character long',
                    'max_length' => 'Password cannot be longer than 20 characters',
                ]
            ],

            'user_access' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'User Access is required',
                ]
            ],

            'profile' => [
                'rules' => 'is_image[profile]|max_size[profile,2048]|mime_in[profile,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

        ]);

        if(!$validated)
        {
            return view('admin/user/add_user', ['validation'=>$this->validator]);
        }

        // check if image has value

        if($img = $this->request->getFile('profile'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // assign variable to hold the value of image

        if(!empty($_FILES['profile']['name']))
        {
            $profile = $imageName;
        }
        else
        {
            $profile = "user_male.jpg";
        }

        $password = $this->request->getPost('password');
        $hash = Hash::encrypt($password);
        $firstname = $this->request->getPost('firstname');

        $data = [
            'firstname' => $firstname,
            'middlename' => $this->request->getPost('middlename'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'password' => $hash,
            'user_access' => $this->request->getPost('user_access'),
            'profile' => $profile,
            'date_added' => date('Y-m-d H:i:s'),
        ];

        

        $user = new UsersModel();
        
        $save = $user->insert($data);

        if($save)
        {

            return redirect()->to(base_url('User/add'))
            ->with('status_icon', 'success')
            ->with('status_text', 'User added successfully')
            ->with('status', 'Success');
            
        }
        else
        {
            return redirect()->to(base_url('User/add'))
            ->with('status_icon', 'error')
            ->with('status_text', 'Error saving user')
            ->with('status', 'error');
        }
    }

    /**
     * Delete user info in database
     */
    public function deleteUser($id = null)
    {
        $user = new UsersModel();
        $userProfile = $user->find($id);
        $profile = $userProfile->profile;

        if($profile == "user_male.jpg")
        {
            $user->delete($id);
        }
        else
        {
            unlink("uploads/".$profile);
            $user->delete($id);
        }

        $data = [
            'status' => 'Success',
            'status_text' => 'User Deleted successfully',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }

    /**
     * Show edit user page
     */
    public function editUser($id = null)
    {
        
        $user = new UsersModel();
        $data['user'] = $user->find($id);

        return view('admin/user/edit_user', $data);
    }

    /**
     * Update user info in database
     */
    public function updateUser($id = null)
    {
        
        $id = $this->request->getPost('id');

        // validate the user inputs
        $validated = $this->validate([

            'firstname' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'First Name is required',
                    'alpha_space' => 'First Name cannot accept numbers and symbols',
                ]
            ],

            'middlename' => [
                'rules' => 'permit_empty|alpha_space',
                'errors' => [
                    'required' => 'Middle Name is required',
                    'alpha_space' => 'Middle Name cannot accept numbers and symbols',
                ]
            ],

            'lastname' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Last Name is required',
                    'alpha_space' => 'Last Name cannot accept numbers and symbols',
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_users.email,id,{id}]',
                'errors' => [
                    'required' => 'First Name is required',
                    'valid_email' => 'Please enter a valid email',
                    'is_unique' => 'Email already use',
                ]
            ],

            'password' => [
                'rules' => 'permit_empty|min_length[6]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be 6 character long',
                    'max_length' => 'Password cannot be longer than 20 characters',
                ]
            ],

            'user_access' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'User Access is required',
                ]
            ],

            'profile' => [
                'rules' => 'is_image[profile]|max_size[profile,2048]|mime_in[profile,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'is_image' => 'Please upload a valid image',
                    'max_size' => 'Image size to large',
                    'mime_in' => 'Allowed image type is .png, .jpeg, .jpg',
                ]
            ],

        ]);

        $updateUser = new UsersModel();
        $data['user'] = $updateUser->find($id);
        $data['validation'] = $this->validator; 

        if(!$validated)
        {
            return view('admin/user/edit_user', $data);
        }

        // check if image has value

        if($img = $this->request->getFile('profile'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        // check the profile image name
        
        $prof = $updateUser->find($id);
        $profile = $prof->profile;

        $db = db_connect();

        if(!empty($_FILES['profile']['name']))
        {
            if($profile != "user_male.jpg")
            {
                unlink("uploads/".$profile);
                $updateProfile = "UPDATE tbl_users SET profile = :profile: WHERE id = :id: LIMIT 1";
                $db->query($updateProfile, [
                    'profile' => $imageName,
                    'id' => $id,
                ]);
            }
            else
            {
                $updateProfile = "UPDATE tbl_users SET profile = :profile: WHERE id = :id: LIMIT 1";
                $db->query($updateProfile, [
                    'profile' => $imageName,
                    'id' => $id,
                ]);
            }
        }

        $password = $this->request->getPost('password', FILTER_SANITIZE_SPECIAL_CHARS);
        $hash = Hash::encrypt($password);

        if(!empty($password))
        {
            $updatePassword = "UPDATE tbl_user SET password = :password: WHERE id = :id: LIMIT 1";
            $db->query($updatePassword, [
                'password' => $hash,
                'id' => $id,
            ]);
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middlename' => $this->request->getPost('middlename'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'user_access' => $this->request->getPost('user_access'),
        ];

        $updateUser->update($id, $data);

        return redirect()->to(base_url('User/user-management'))
            ->with('status_icon', 'success')
            ->with('status_text', 'User updated successfully')
            ->with('status', 'Success');
            
    }
}
