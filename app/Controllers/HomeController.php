<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CarModel;
use App\Models\UserModel;
  
class HomeController extends Controller
{
    public function index()
    {   
        // Assuming you have a UserModel to fetch user data
        $userModel = new UserModel(); // Adjust this based on your model structure
        $userId = session()->get('user_id'); // Assuming user ID is stored in session
    
        // Fetch user data
        $user = $userModel->find($userId);
    
        // Pass user data to the view
        return view('user/usertest', ['user' => $user]);
    }
    
    public function ecom()
    {   

        echo view('user/ecom');
    
    }
    public function cars()
    {   

        echo view('user/cars');
    
    }
    public function rent()
    {   

        echo view('user/renting');
    
    }
    public function start()
    {   

        echo view('layout/getstarted');
    
    }
    public function admin()
    {   

        echo view('dashboard');
    
    }
    public function fecars()
    {
        // Load the car model
        $carModel = new CarModel();

        // Fetch all cars from the database
        $cars = $carModel->findAll();

        // Pass the cars data to the view
        return view('layout/fecars', ['cars' => $cars]);
    }



}