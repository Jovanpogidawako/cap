<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseHistoryModel extends Model
{
    protected $table = 'purchase_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'car_model', 
        'price', 
        'payment_method', 
        'purchase_date', 
        'customer_name', 
        'customer_address', 
        'car_image', 
        'amount_paid', 
        'total_price', 
        'payment_status',
        'product_id',
        'user_id',
        'is_approved',
        // Add is_approved field
    ];
    protected $useTimestamps = true;
    protected $createdField = 'purchase_date';
    protected $updatedField = '';

    public function logPurchase($data)
    {
        return $this->insert($data);
    }

    public function getPurchaseHistory()
    {
        return $this->orderBy('purchase_date', 'DESC')->findAll();
    }

    public function getPurchasesByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getPurchasesWithProductInfo()
    {
        return $this->select('
                purchase_history.id,
                purchase_history.car_model,
                purchase_history.price,
                purchase_history.payment_method,
                purchase_history.purchase_date,
                purchase_history.customer_name,
                purchase_history.customer_address,
                purchase_history.amount_paid,
                purchase_history.total_price,
                purchase_history.payment_status,
                purchase_history.is_approved,
                products.model AS product_model,
                products.price AS product_price
            ')
            ->join('products', 'products.id = purchase_history.product_id')
            ->orderBy('purchase_date', 'DESC')
            ->findAll();
    }

    public function getPurchaseHistoryByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function updateApprovalStatus($purchaseId, $isApproved)
    {
        $result = $this->update($purchaseId, ['is_approved' => $isApproved]);
        log_message('info', "Approval status update result for ID $purchaseId: " . ($result ? 'Success' : 'Failure'));
        return $result;
    }
}
