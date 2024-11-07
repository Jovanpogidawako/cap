<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'user_name', 'email', 'message'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Function to get feedback by user ID
    public function getFeedbackByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    // Function to get all feedback for admin
    public function getAllFeedback()
    {
        return $this->findAll();
    }
    
}
