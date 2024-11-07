<?php

namespace App\Models;

use CodeIgniter\Model;

class RentingModel extends Model
{
    protected $table            = 'renting';
    protected $primaryKey       = 'RentalID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'product_id', // Add product_id to connect with products
        'FirstLocation',
        'SecondLocation',
        'Name',
        'Phone',
        'StartDate',
        'EndDate',
        'StartTime',
        'EndTime',
        'RentStatus',
        'price',
        'Status',
        'created_at',
        'approval_status',
        'valid_id_image'
    ];

    // Method to get rentals with user and product info
    public function getRentalsWithUserAndProductInfo($userId)
    {
        return $this->select('
                user_form.id AS user_id, 
                user_form.name AS user_name, 
                user_form.email AS user_email, 
                user_form.phone AS user_phone, 
                user_form.address AS user_address, 
                renting.RentalID AS rental_id, 
                renting.FirstLocation, 
                renting.SecondLocation, 
                renting.StartDate, 
                renting.EndDate, 
                renting.StartTime, 
                renting.EndTime, 
                renting.price, 
                renting.Status, 
                renting.approval_status, 
                renting.valid_id_image,
                products.model AS product_model, 
                products.price AS product_price
            ')
            ->join('user_form', 'user_form.id = renting.user_id')
            ->join('products', 'products.id = renting.product_id')
            ->where('renting.user_id', $userId)
            ->findAll();
    }
    
    
    public function getRentalsForUser($userId)
    {
        $rentals = $this->where('user_id', $userId)->findAll();
        log_message('debug', "Rentals for user $userId: " . json_encode($rentals));
        return $rentals;
    }

    public function findAllForUser($userId)
    {
        $rentals = $this->where('user_id', $userId)->findAll();
        log_message('debug', "Rentals for user $userId: " . json_encode($rentals));
        return $rentals;
    }

    public function getRentalsWithCarModel()
    {
        return $this->select('renting.*, products.model AS carModel')
                    ->join('products', 'renting.product_id = products.id')
                    ->findAll();
    }
    // In RentingModel.php

    public function updateApprovalStatus($rentalId, $status)
    {
        return $this->update($rentalId, ['approval_status' => $status]);
    }
    
    public function deleteRentalById($rentalId, $userId)
    {
        return $this->where('RentalID', $rentalId)
                    ->where('user_id', $userId)
                    ->delete();
    }
    public function getRentalById($rentalId)
    {
        return $this->select('
                renting.RentalID AS rental_id, 
                renting.FirstLocation, 
                renting.SecondLocation, 
                renting.StartDate, 
                renting.EndDate, 
                renting.StartTime, 
                renting.EndTime, 
                renting.price, 
                products.model AS product_model,
                user_form.name AS user_name
            ')
            ->join('user_form', 'user_form.id = renting.user_id')
            ->join('products', 'products.id = renting.product_id')
            ->where('renting.RentalID', $rentalId)
            ->first();
    }
    public function getAllReturnees($userId)
    {
        return $this->select('
                renting.RentalID AS rental_id, 
                renting.FirstLocation, 
                renting.SecondLocation, 
                renting.StartDate, 
                renting.EndDate, 
                renting.StartTime, 
                renting.EndTime, 
                renting.price, 
                renting.RentStatus,
                products.model AS product_model, 
                user_form.name AS user_name, 
                user_form.email AS user_email, 
                user_form.phone AS user_phone
            ')
            ->join('user_form', 'user_form.id = renting.user_id')
            ->join('products', 'products.id = renting.product_id')
            ->where('renting.RentStatus', 'Returned')
            ->where('renting.user_id', $userId)
            ->findAll();
    }
    
    
public function updateRentalStatus($rentalId, $status)
{
    return $this->update($rentalId, ['RentStatus' => $status]);
}
public function uploadValidId($rentalId, $image)
    {
        $imageName = $image->getRandomName();
        $image->move(ROOTPATH . 'public/uploads/valid_ids', $imageName);

        return $this->update($rentalId, ['valid_id_image' => $imageName]);
    }
    public function getValidIdImage($rentalId)
    {
        $rental = $this->select('valid_id_image')->find($rentalId);
        return $rental ? $rental['valid_id_image'] : null;
    }
}
