<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments'; // The 'payments' table
    protected $primaryKey = 'id';
    protected $allowedFields = ['car_image', 'car_model', 'car_price', 'card_number', 'card_name', 'card_address', 'payment_method'];

    /**
     * Get payments with associated car details from the products table.
     *
     * @return array
     */
    public function getPaymentsWithCarDetails()
    {
        return $this->db->table('payments')
            ->join('products', 'payments.car_model_id = products.id') // Join with the products table
            ->select('payments.*, products.image as car_image, products.model as car_model, products.price as car_price, payments.status') // Include 'status'
            ->get()
            ->getResultArray();
    }
        
}