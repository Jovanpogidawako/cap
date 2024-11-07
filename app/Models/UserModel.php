<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_form';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'email', 
        'password', 
        'image', 
        'phone',       // User's phone number
        'address',     // User's address
        'gender',      // User's gender
        'created_at',  // Account creation timestamp
        'updated_at',
        'is_admin'   // Last update timestamp
    ];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function updateUserProfile($id, $data)
    {
        return $this->update($id, $data);
    }
     // Function to get feedback for the user
     public function getUserFeedback($userId)
     {
         $feedbackModel = new \App\Models\FeedbackModel();
         return $feedbackModel->getFeedbackByUserId($userId);
     }
 
}
