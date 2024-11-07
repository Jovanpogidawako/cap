<?php

namespace App\Controllers;

use App\Models\PurchaseHistoryModel;
use App\Models\RentingModel;

class HistoryController extends BaseController
{
    public function combinedHistory() 
    {
        // Get the logged-in user's ID
        $userId = session()->get('user_id');
    
        if (!$userId) {
            return redirect()->to('/signin')->with('error', 'Please log in to view your history.');
        }
    
        $rentingModel = new RentingModel();
 
    
        // Fetch rental history for the user

        $rentals = $rentingModel->getRentalsWithUserAndProductInfo($userId);
    
        foreach ($rentals as &$rental) {
            $rental['Status'] = $this->calculateRentalStatus($rental);
            $rental['statusColor'] = $this->getStatusColor($rental['Status']);
            $rental['approval_status'] = $rental['approval_status'] ?? 'pending';
        }
    
   
    
        // Combine rentals and purchases into one array for the view
        $data = [
            'rentals' => $rentals,
        ];
    
        return view('combined_history', $data);
    }
    
    public function deleteRental($rentalId)
{
    // Ensure the user is logged in
    $userId = session()->get('user_id');
    if (!$userId) {
        return redirect()->to('/signin')->with('error', 'Please log in to delete a rental.');
    }

    $rentingModel = new RentingModel();

    // Delete the rental record if it belongs to the logged-in user
    if ($rentingModel->deleteRentalById($rentalId, $userId)) {
        return redirect()->to('/historia')->with('success', 'Rental history deleted successfully.');
    } else {
        return redirect()->to('/historia')->with('error', 'Unable to delete rental history.');
    }
}

    
    

    // Define the calculateRentalStatus method
    private function calculateRentalStatus($rental)
    {
        $currentDate = date('Y-m-d');
        if ($rental['EndDate'] < $currentDate) {
            return 'Completed';
        } elseif ($rental['StartDate'] > $currentDate) {
            return 'Upcoming';
        } else {
            return 'Ongoing';
        }
    }

    // Define the getStatusColor method
    private function getStatusColor($status)
    {
        switch (strtolower($status)) {
            case 'completed':
                return 'success';
            case 'upcoming':
                return 'primary';
            case 'ongoing':
                return 'info';
            default:
                return 'secondary';
        }
    }
}