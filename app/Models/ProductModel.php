<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'model',
        'price',
        'image',
        'mileage',
        'fueltype',
        'transmission',
        'car_model_id',
        'car_price',
        'is_available',
        'category',
        'approval_status', // Add this field to allow updates
        'payment_image', // Adding payment image to allowed fields
    ];

    // Retrieve all available products
    public function getAllProducts()
    {
        return $this->where('is_available', 1)->findAll(); // Retrieve only available products
    }

    // Retrieve a specific product by ID
    public function getProduct($id)
    {
        return $this->find($id);
    }

    // Update car availability
    public function updateCarAvailability($carModel)
    {
        return $this->set('is_available', 0) // Set availability to false
                    ->where('model', $carModel) // Use the car model to find the correct record
                    ->update();
    }

    // (Optional) Get unavailable products
    public function getUnavailableProducts()
    {
        return $this->where('is_available', 0)->findAll(); // Retrieve unavailable products
    }
    public function getProductsByCategory($category)
    {
        return $this->where('category', $category)->findAll();
    }
    public function updateCarsAvailability($productId, $isAvailable)
{
    return $this->update($productId, ['is_available' => $isAvailable]);
}
private function getCarById($productId) {
    $model = new ProductModel();
    return $model->find($productId);
}
public function rentCar($productId)
{
    $model = new ProductModel();
    // Mark the car as unavailable when it's rented
    $model->updateCarsAvailability($productId, 0); // Set is_available to 0
}

public function returnCar($productId)
{
    $model = new ProductModel();
    // Mark the car as available again when it's returned
    $model->updateCarsAvailability($productId, 1); // Set is_available to 1
}
public function savePaymentImage($productId, $imagePath)
    {
        return $this->update($productId, ['payment_image' => $imagePath]);
    }
}
