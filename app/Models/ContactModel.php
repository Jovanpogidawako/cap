<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'message'];
}
