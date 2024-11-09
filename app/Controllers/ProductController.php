<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PaymentModel;
use App\Models\PurchaseHistoryModel;
use CodeIgniter\Controller;
use TCPDF;


class ProductController extends Controller
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->getAllProducts();
        return view('admin_page', $data);
    }
    public function indexs()
{
    $model = new ProductModel();
    $data['rentCars'] = $model->where('is_available', 1)->where('category', 'rent')->findAll();
    $data['ecommerceCars'] = $model->where('is_available', 1)->where('category', 'ecommerce')->findAll();
    return view('user/car_list', $data);
}


    
    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $model = new ProductModel();

            $productName = $this->request->getPost('product_name');
            $productPrice = $this->request->getPost('product_price');
            $productMileage = $this->request->getPost('mileage'); // Fix here: 'mileage' should match the view
            $productFuelType = $this->request->getPost('fueltype'); // Fix here: 'fueltype' should match the view
            $productTransmission = $this->request->getPost('transmission'); // Fix here: 'transmission' should match the view
            $productImage = $this->request->getFile('product_image');
            $productCategory = $this->request->getPost('category'); // New field

            if ($productImage->isValid() && !$productImage->hasMoved()) {
                $imageName = $productImage->getName();
                $productImage->move('uploaded_img', $imageName);

                $model->save([
                    'model' => $productName,
                    'price' => $productPrice,
                    'image' => $imageName,
                    'mileage' => $productMileage,
                    'fueltype' => $productFuelType,
                    'transmission' => $productTransmission,
                    'category' => $productCategory, // Save the category
                ]);

                return redirect()->to('/admins')->with('message', 'New product added successfully');
            } else {
                return redirect()->back()->with('message', 'Image upload failed, please try again.');
            }
        }

        return view('admin_add_product');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        return redirect()->to('/admins')->with('message', 'Product deleted successfully');
    }

    public function edit($id)
    {
        $model = new ProductModel();

        if ($this->request->getMethod() === 'post') {
            $productName = $this->request->getPost('product_name');
            $productPrice = $this->request->getPost('product_price');
            $productMileage = $this->request->getPost('mileage');
            $productFuelType = $this->request->getPost('fueltype');
            $productTransmission = $this->request->getPost('transmission');
            $productCategory = $this->request->getPost('category');
            $productImage = $this->request->getFile('product_image');

            $updateData = [
                'model' => $productName,
                'price' => $productPrice,
                'mileage' => $productMileage,
                'fueltype' => $productFuelType,
                'transmission' => $productTransmission,
                'category' => $productCategory,
            ];

            // Only update the image if a new one is uploaded
            if ($productImage->isValid() && !$productImage->hasMoved()) {
                $imageName = $productImage->getName();
                $productImage->move('uploaded_img', $imageName);
                $updateData['image'] = $imageName; // Add the new image to the update array
            }

            $model->update($id, $updateData);
            return redirect()->to('/admins')->with('message', 'Product updated successfully');
        }

        $data['product'] = $model->getProduct($id);
        return view('admin_update_product', $data);
    }
    public function submitPayment()
    {
        $productModel = new ProductModel();
        $purchaseHistoryModel = new PurchaseHistoryModel();


        // Get the logged-in user's ID
        $userId = session()->get('user_id');
        
        // Gather form data
        $data = [
            'user_id' => $userId,
            'car_model' => $this->request->getPost('car_model'),
            'price' => $this->request->getPost('car_price'),
            'payment_method' => 'face-to-face',  // Only face-to-face allowed
            'customer_name' => $this->request->getPost('card-name'),
            'customer_address' => $this->request->getPost('card-address'),
            'car_image' => $this->request->getPost('car_image'),
            'is_approved' => 0, // Not yet approved
        ];

        // Log purchase
        $purchaseHistoryModel->logPurchase($data);

        // Mark the car as unavailable
        $productModel->updateCarAvailability($this->request->getPost('car_model'));

        // Save the payment image
        $productId = $this->request->getPost('car_model');

        return redirect()->to('/carslist')->with('success', 'Purchase completed successfully!');
    }

    
    
    public function History()
    {
        $purchaseHistoryModel = new PurchaseHistoryModel();
    
        // Get the logged-in user's ID
        $userId = session()->get('user_id'); // Ensure 'user_id' is stored in the session upon login
    
        // Retrieve the user's purchase history
        $data['purchases'] = $purchaseHistoryModel->getPurchaseHistoryByUserId($userId);
    
        return view('purchase_history', $data);
    }
   
    public function rent($id)
    {
        $model = new ProductModel();
        $data['car'] = $model->find($id);

        if (empty($data['car'])) {
            return redirect()->to('/carslist')->with('error', 'Car not found');
        }

        // Fetch user details (assuming you have a logged-in user)
        $data['user_name'] = session()->get('user_name');
        $data['user_phone'] = session()->get('user_phone');

        return view('user/renting', $data);
    }

    public function toggleApproval($purchaseId)
    {
        $isApproved = $this->request->getJSON()->is_approved;
    
        $purchaseHistoryModel = new PurchaseHistoryModel();
        $result = $purchaseHistoryModel->updateApprovalStatus($purchaseId, $isApproved);
    
        return $this->response->setJSON(['success' => $result]);
    }
   

    public function generateAgreement($purchaseId)
    {
        $purchaseModel = new PurchaseHistoryModel();
        $purchase = $purchaseModel->find($purchaseId);

        if (!$purchase) {
            return $this->response->setJSON(['error' => 'Purchase not found']);
        }

        // Check if purchase is approved
        if (!$purchase['is_approved']) {
            return $this->response->setJSON(['error' => 'Purchase agreement is only available for approved purchases']);
        }

        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Luxury Car Sales');
        $pdf->SetTitle('Purchase Agreement');
        $pdf->SetSubject('Purchase Agreement for ' . $purchase['car_model']);

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Add a page
        $pdf->AddPage();

        // HTML content for the agreement
        $html = view('purchase_agreement_pdf', ['purchase' => $purchase]);

        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('purchase_agreement.pdf', 'D');
        exit;
    }
}