<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RentingModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class UserController extends Controller
{
    public function register()
    {
        helper(['form', 'url']);
        $userModel = new UserModel();

        if ($this->request->getMethod() == 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'name' => 'required',
                'email' => 'required|valid_email|is_unique[user_form.email]',
                'password' => 'required|min_length[6]',
                'cpassword' => 'required|matches[password]',
                'phone' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $file = $this->request->getFile('image');
                $imageName = $file->getRandomName();
                $file->move('uploads/', $imageName);

                $userModel->save([
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                    'phone' => $this->request->getPost('phone'),
                    'address' => $this->request->getPost('address'),
                    'gender' => $this->request->getPost('gender'),
                    'image' => $imageName,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                return redirect()->to('/signin')->with('message', 'Registered successfully!');
            }

            return view('signup', ['validation' => $validation]);
        }

        return view('signup');
    }
    public function login()
    {
        helper(['form', 'url']);
        $userModel = new UserModel();
    
        if ($this->request->getMethod() == 'post') {
            $user = $userModel->getUserByEmail($this->request->getPost('email'));
    
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Check if user is an admin
                if ($user['is_admin'] == 1) {
                    session()->set([
                        'user_id' => $user['id'],
                        'is_admin' => true,
                    ]);
                    return redirect()->to('/ui'); // Redirect to admin dashboard
                } else {
                    session()->set([
                        'user_id' => $user['id'],
                        'is_admin' => false,
                    ]);
                    return redirect()->to('/home'); // Redirect to regular user home
                }
            }
            
            // Authentication failed
            return redirect()->back()->with('message', 'Incorrect email or password!');
        }
    
        return view('signin');
    }
    


    // ... (other methods remain the same)

    public function adminDashboard()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/signin');
        }

       return view('ui');
    }

    public function home()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/signin');
        }

        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('home', ['user' => $user]);
    }

    public function updateProfile()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('signin');
        }

        helper(['form', 'url']);
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        if ($this->request->getMethod() == 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'update_name' => 'required',
                'update_email' => 'required|valid_email',
                'update_phone' => 'required',
                'update_address' => 'required',
                'update_gender' => 'required',
                'old_password' => 'required',
                'new_password' => 'permit_empty|min_length[6]',
                'confirm_password' => 'matches[new_password]',
                'update_image' => 'permit_empty|max_size[update_image,2048]|is_image[update_image]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $updateData = [
                    'name' => $this->request->getPost('update_name'),
                    'email' => $this->request->getPost('update_email'),
                    'phone' => $this->request->getPost('update_phone'),
                    'address' => $this->request->getPost('update_address'),
                    'gender' => $this->request->getPost('update_gender'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($this->request->getPost('new_password')) {
                    $updateData['password'] = password_hash($this->request->getPost('new_password'), PASSWORD_BCRYPT);
                }

                if ($this->request->getFile('update_image')->isValid()) {
                    $file = $this->request->getFile('update_image');
                    $imageName = $file->getRandomName();
                    $file->move('uploads/', $imageName);
                    $updateData['image'] = $imageName;
                }

                $userModel->update(session()->get('user_id'), $updateData);
                return redirect()->to('/user/home')->with('message', 'Profile updated successfully!');
            }

            return view('edit_prof', ['user' => $user, 'validation' => $validation]);
        }

        return view('edit_prof', ['user' => $user]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/signin');
    }

    public function profile()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/signin');
        }

        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('profile', ['user' => $user]);
    }

    public function edit_prof()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('signin');
        }

        helper(['form', 'url']);
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        if ($this->request->getMethod() == 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'update_name' => 'required',
                'update_email' => 'required|valid_email',
                'update_phone' => 'required',
                'update_address' => 'required',
                'update_gender' => 'required',
                'update_image' => 'permit_empty|max_size[update_image,2048]|is_image[update_image]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $updateData = [
                    'name' => $this->request->getPost('update_name'),
                    'email' => $this->request->getPost('update_email'),
                    'phone' => $this->request->getPost('update_phone'),
                    'address' => $this->request->getPost('update_address'),
                    'gender' => $this->request->getPost('update_gender')
                ];

                if ($this->request->getFile('update_image')->isValid()) {
                    $file = $this->request->getFile('update_image');
                    $imageName = $file->getRandomName();
                    $file->move('uploads/', $imageName);
                    $updateData['image'] = $imageName;
                }

                $userModel->update(session()->get('user_id'), $updateData);
                return redirect()->to('/edit_prof')->with('message', 'Profile updated successfully!');
            }

            return view('edit_profile', ['user' => $user, 'validation' => $validation]);
        }

        return view('edit_profile', ['user' => $user]);
    }
    public function index()
    {
        $userModel = new UserModel();
        $rentingModel = new RentingModel();
        
        $users = $userModel->findAll();
        
        foreach ($users as &$user) {
            $rentals = $rentingModel->where('user_id', $user['id'])->findAll();
            $user['rentals'] = $rentals; // Ensure this line is present
            
            // Add debug logging
            log_message('debug', "User ID: {$user['id']}, Name: {$user['name']}, Rental count: " . count($rentals));
        }
        
        $data['users'] = $users;
        
        // Add more debug information
        log_message('debug', 'All users data: ' . json_encode($data['users']));
        
        return view('admin/user_management', $data);
    }
    

    public function editUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $validation = \Config\Services::validation();
            $validation->setRules([
                'name' => 'required',
                'email' => 'required|valid_email',
                'phone' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'image' => 'permit_empty|max_size[image,2048]|is_image[image]'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $updateData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone'),
                    'address' => $this->request->getPost('address'),
                    'gender' => $this->request->getPost('gender'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($this->request->getFile('image')->isValid()) {
                    $file = $this->request->getFile('image');
                    $imageName = $file->getRandomName();
                    $file->move('uploads/', $imageName);
                    $updateData['image'] = $imageName;
                }

                $userModel->update($id, $updateData);
                return redirect()->to('/user_management')->with('message', 'User updated successfully!');
            }

            return view('admin/user_management', ['user' => $user, 'validation' => $validation]);
        }

        return view('admin/user_management', ['user' => $user]);
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/user_management')->with('message', 'User deleted successfully!');
    }

    public function returnCar($rentalId)
    {
        $rentalModel = new RentalModel();
        $rental = $rentalModel->find($rentalId);

        if (!$rental) {
            return redirect()->back()->with('error', 'Rental not found.');
        }

        $penaltyRate = 100.00;
        $totalPrice = (float) $rental['price'];
        $penalty = 0;

        $endDate = new Time($rental['EndDate'] . ' ' . $rental['EndTime']);
        $currentDate = Time::now();

        if ($currentDate->isAfter($endDate)) {
            $hoursLate = $endDate->difference($currentDate)->getHours();
            $penalty = $hoursLate * $penaltyRate;
            $totalPrice += $penalty;
        }

        return view('user/return_confirmation', [
            'rental' => $rental,
            'totalPrice' => $totalPrice,
            'penalty' => $penalty,
            'isLate' => $penalty > 0,
            'hoursLate' => $hoursLate ?? 0
        ]);
    }

    public function confirmReturn($rentalId)
    {
        $rentalModel = new RentalModel();
        $rentalModel->update($rentalId, ['Status' => 'Returned']);

        return redirect()->to('combined_history')->with('message', 'Car successfully returned.');
    }
}