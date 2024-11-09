<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RentingModel;
use App\Models\ProductModel;
use DateTime;
use TCPDF; // This is correct. Importing TCPDF as a class.


class Rental extends BaseController
{
    public function index()
    {
        $model = new RentingModel();
        
        // Check if the user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/signin')->with('message', 'Please log in to access this page.');
        }
        
        // Get all rentals
        $rentals = $model->findAll();
        
        // Prepare data for the view
        $rentCars = []; // This will hold the cars and their status
        foreach ($rentals as $rental) {
            // Assuming you have a way to get the car info based on the product_id
            $car = $this->getCarById($rental['product_id']); // Fetch car details using product_id
            
            // Calculate the rental status
            $rentalStatus = $this->calculateRentalStatus($rental);
            
            // Set the status for the car
            $car['status'] = $rentalStatus; // This line adds the status to the car info
            
            // Add the car to the rentCars array
            $rentCars[] = $car;
        }
    
        $data = [
            'rentCars' => $rentCars,
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('user_name'),
            'user_phone' => session()->get('user_phone'),
            'user_email' => session()->get('user_email')
        ];
        
        return view('user/renting', $data);
    }
    
    public function submit()
    {
        log_message('debug', 'Rental submission started');

        if (!session()->get('user_id')) {
            log_message('error', 'Rental submission attempted without user_id in session');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not logged in'
            ]);
        }

        log_message('debug', 'User ID from session: ' . session()->get('user_id'));

        $model = new RentingModel();

        $rules = [
            'firstlocation' => 'required',
            'secondlocation' => 'required',
            'phone' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric',
            'product_id' => 'required|numeric',
            'valid_id' => 'uploaded[valid_id]|max_size[valid_id,1024]|is_image[valid_id]'
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'Validation failed: ' . json_encode($this->validator->getErrors()));
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'user_id' => session()->get('user_id'),
            'product_id' => $this->request->getVar('product_id'),
            'FirstLocation' => $this->request->getVar('firstlocation'),
            'SecondLocation' => $this->request->getVar('secondlocation'),
            'Name' => $this->request->getVar('name'),
            'Phone' => $this->request->getVar('phone'),
            'StartDate' => $this->request->getVar('start_date'),
            'EndDate' => $this->request->getVar('end_date'),
            'StartTime' => $this->request->getVar('start_time'),
            'EndTime' => $this->request->getVar('end_time'),
            'price' => $this->request->getVar('price'),
            'Status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        log_message('debug', 'Rental data: ' . json_encode($data));

        try {
            $insertId = $model->insert($data);

            if ($insertId === false) {
                log_message('error', 'Rental insertion failed. Data: ' . json_encode($data));
                throw new \Exception('Failed to insert rental record');
            }

            // Handle valid ID image upload
            $validId = $this->request->getFile('valid_id');
            if ($validId->isValid() && !$validId->hasMoved()) {
                $model->uploadValidId($insertId, $validId);
            }

            log_message('info', 'Rental submitted successfully. ID: ' . $insertId . ', User ID: ' . $data['user_id']);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Rental submitted successfully'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Rental submission error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error occurred while submitting the rental: ' . $e->getMessage()
            ]);
        }
    }

    public function adminIndex()
    {
        $model = new RentingModel();
        $rentals = $model->findAll();

        // Update status and color for each rental
        foreach ($rentals as &$rental) {
            $rental['Status'] = $this->calculateRentalStatus($rental);
            $rental['statusColor'] = $this->getStatusColor($rental['Status']);
        }

        return view('admin/rental_management', ['rentals' => $rentals]);
    }
    public function getRentals()
    {
        $rentModel = new RentingModel();
        $productModel = new ProductModel();
    
        // Retrieve all rentals
        $rentals = $rentModel->findAll();
        
        $events = [];
        foreach ($rentals as $rental) {
            // Get product information based on product_id from the rentals
            $product = $productModel->find($rental['product_id']);
            
            // Determine rental status
            $currentDateTime = new DateTime();
            $startDateTime = new DateTime($rental['StartDate'] . ' ' . $rental['StartTime']);
            $endDateTime = new DateTime($rental['EndDate'] . ' ' . $rental['EndTime']);
            $status = 'pending';
    
            if ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
                $status = 'ongoing';
            } elseif ($currentDateTime > $endDateTime) {
                $status = 'done';
            }
    
            $rental['Status'] = $status;
    
            // Handle potential product retrieval issue
            if ($product === null) {
                log_message('warning', "Product with ID {$rental['product_id']} not found.");
                $carModel = 'N/A';
            } else {
                $carModel = isset($product['model']) ? $product['model'] : 'N/A';
            }
    
            // Add rental data and product info to events
            $events[] = [
                'id' => $rental['RentalID'],
                'title' => $rental['Name'],
                'start' => $rental['StartDate'] . 'T' . $rental['StartTime'],
                'end' => $rental['EndDate'] . 'T' . $rental['EndTime'],
                'color' => $this->getRentalColor($status),
                'extendedProps' => [
                    'firstLocation' => isset($rental['FirstLocation']) ? $rental['FirstLocation'] : 'Unknown',
                    'secondLocation' => isset($rental['SecondLocation']) ? $rental['SecondLocation'] : 'Unknown',
                    'phone' => isset($rental['Phone']) ? $rental['Phone'] : 'N/A',
                    'price' => isset($rental['price']) ? $rental['price'] : 'N/A',
                    'status' => $status,
                    'carModel' => $carModel,
                ]
            ];
        }
    
        return $this->response->setJSON($events);
    }
    
    
    
    
    public function updateRental()
    {
        $model = new RentingModel();

        // Get rental ID and form data
        $rentalId = $this->request->getVar('rental_id');
        $data = [
            'FirstLocation' => $this->request->getVar('firstlocation'),
            'SecondLocation' => $this->request->getVar('secondlocation'),
            'Name' => $this->request->getVar('name'),
            'Phone' => $this->request->getVar('phone'),
            'StartDate' => $this->request->getVar('start_date'),
            'EndDate' => $this->request->getVar('end_date'),
            'StartTime' => $this->request->getVar('start_time'),
            'EndTime' => $this->request->getVar('end_time'),
        ];

        // Update the rental record in the database
        $model->update($rentalId, $data);

        // Redirect back to the rental management page after updating
        return redirect()->to(site_url('rentman'))->with('status', 'Rental updated successfully');
    }

    public function deleteRental($id)
    {
        $model = new RentingModel();
        $model->delete($id); // Delete the rental by its ID

        // Redirect to admin page with success message
        return redirect()->to(site_url('rentman'))->with('status', 'Rental deleted successfully');
    }

    public function history()
    {
        $model = new RentingModel();
        $rentals = $model->findAll(); // Retrieve all rentals

        // Update status and color for each rental
        foreach ($rentals as &$rental) {
            $rental['Status'] = $this->calculateRentalStatus($rental);
            $rental['statusColor'] = $this->getStatusColor($rental['Status']);
        }

        return view('user/renting_history', ['rentals' => $rentals]);
    }

    private function calculateRentalStatus($rental)
    {
        $currentDateTime = new DateTime();
        $startDateTime = new DateTime($rental['StartDate'] . ' ' . $rental['StartTime']);
        $endDateTime = new DateTime($rental['EndDate'] . ' ' . $rental['EndTime']);

        if ($currentDateTime < $startDateTime) {
            return 'Upcoming';
        } elseif ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
            return 'Ongoing';
        } else {
            return 'Completed';
        }
    }

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'Completed':
                return '#28a745'; // Green
            case 'Ongoing':
                return '#007bff'; // Blue
            case 'Upcoming':
                return '#ffc107'; // Yellow
            default:
                return '#6c757d'; // Grey
        }
    }
    
    public function show()
    {
        $model = new RentingModel();
        $rentals = $model->findAll(); // Retrieve all rentals
        foreach ($rentals as &$rental) {
            $rental['Status'] = $this->calculateRentalStatus($rental);
            $rental['statusColor'] = $this->getStatusColor($rental['Status']);
        }

        return view('user/renting_history', ['rentals' => $rentals]);
    }
    public function mapping() 
    {
        $model = new RentingModel();
        
        // Fetch all rental records
        $data['rental_data'] = $model->findAll(); 

        // Check if rental data was retrieved
        if (empty($data['rental_data'])) {
            session()->setFlashdata('message', 'No rental information found.');
        }

        return view('admin/rental_map', $data); // Pass data to the view
    }
   // In CarManagementController.php or similar
   public function acceptRental($rentalId)
   {
       $rentingModel = new RentingModel();
       $result = $rentingModel->updateApprovalStatus($rentalId, 'approved');
       
       if ($result) {
           return $this->response->setJSON(['status' => 'success', 'message' => 'Rental approved successfully']);
       } else {
           return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to approve rental']);
       }
   }

   public function declineRental($rentalId)
   {
       $rentingModel = new RentingModel();
       $result = $rentingModel->updateApprovalStatus($rentalId, 'declined');
       
       if ($result) {
           return $this->response->setJSON(['status' => 'success', 'message' => 'Rental declined successfully']);
       } else {
           return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to decline rental']);
       }
   }
   public function returnRental($rentalId)
   {
       $rentingModel = new RentingModel();
   
       // Update the rental status to 'Returned'
       $result = $rentingModel->updateRentalStatus($rentalId, 'returned');
   
       if ($result) {
           return $this->response->setJSON(['success' => true, 'message' => 'Rental returned successfully.']);
       } else {
           return $this->response->setJSON(['success' => false, 'message' => 'Failed to return rental.']);
       }
   }
   
   public function viewReturnedRentals()
   {
       $rentingModel = new RentingModel();
       $returnedRentals = $rentingModel->getReturnedRentalsWithDetails();
   
       return view('admin/returned_rentals', ['returnedRentals' => $returnedRentals]);
   }
   

   public function userReturnedRentals()
   {
       $rentingModel = new RentingModel();
       $userId = session()->get('user_id');  // Assumes a logged-in user's ID is stored in session
       
       // Retrieve only returned rentals for this user
       $returnedRentals = $rentingModel->getReturnedRentalsWithDetails($userId);
   
       return view('user/returned_rentals', ['returnedRentals' => $returnedRentals]);
   }
// Add this method to your Rental controller


public function showAgreement($rentalId)
{
    $model = new RentingModel();
    $rental = $model->find($rentalId);

    if (!$rental) {
        return redirect()->back()->with('error', 'Rental not found');
    }

    // Check if rental is approved
    if ($rental['approval_status'] !== 'approved') {
        return redirect()->back()->with('error', 'Agreement is only available for approved rentals');
    }

    // Get product model details
    $productModel = new ProductModel();
    $product = $productModel->find($rental['product_id']);
    $rental['product_model'] = $product ? $product['model'] : 'Unknown Model';

    // Generate PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Luxury Car Rentals');
    $pdf->SetTitle('Rental Agreement');
    $pdf->SetSubject('Rental Agreement for ' . $rental['Name']);

    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page
    $pdf->AddPage();

    // HTML content
    $html = view('rental_agreement_pdf', ['rental' => $rental]);

    // Print text using writeHTMLCell()
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('rental_agreement.pdf', 'D');
    exit;
}
}