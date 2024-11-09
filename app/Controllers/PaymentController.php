<?php 
namespace App\Controllers;  

use App\Models\ProductModel;
use App\Models\PaymentModel;
use App\Models\PurchaseHistoryModel;
use CodeIgniter\Controller;
class PaymentController extends BaseController  
{  
    protected $paymentModel;  

    public function __construct()  
    {  
        $this->paymentModel = new PaymentModel();  
    }  
    public function submit()  
    {  
        $fileIDImage = $this->request->getFile('id-image');
        $filePaymentImage = $this->request->getFile('payment-image');
    
        // Upload valid ID image if exists
        $idImagePath = null;
        if ($fileIDImage->isValid() && !$fileIDImage->hasMoved()) {
            $idImagePath = $fileIDImage->store('uploads/id_images', $fileIDImage->getRandomName());
        }
    
        // Upload payment image if exists
        $paymentImagePath = null;
        if ($filePaymentImage->isValid() && !$filePaymentImage->hasMoved()) {
            $paymentImagePath = $filePaymentImage->store('uploads/payment_images', $filePaymentImage->getRandomName());
        }
    
        // Gather other data
        $data = [  
            'user_id' => session()->get('user_id'),
            'car_model' => $this->request->getPost('car_model'),
            'car_image' => $this->request->getPost('car_image'),
            'price' => $this->request->getPost('price'),
            'payment_method' => $this->request->getPost('payment-method'),
            'purchase_date' => date('Y-m-d H:i:s'),
            'id_image' => $idImagePath, // Save the path to the database
            'payment_image' => $paymentImagePath,
        ];
    
        // Log the purchase
        $purchaseHistoryModel = new PurchaseHistoryModel();
        if ($purchaseHistoryModel->logPurchase($data)) {  
            return redirect()->to('/payments')->with('success', 'Payment submitted successfully.');  
        } else {  
            return redirect()->back()->withInput()->with('errors', $purchaseHistoryModel->errors());  
        }  
    }
    

    public function update($id)  
    {  
        $payment = $this->paymentModel->find($id);  

        if (!$payment) {  
            return redirect()->to('/payments')->with('error', 'Payment record not found.');  
        }  

        $data = [  
            'card_number' => $this->request->getPost('card-number'),  
            'card_name'   => $this->request->getPost('card-name'),  
            'card_address'=> $this->request->getPost('card-address'),  
            'payment_method' => $this->request->getPost('payment-method'),  
            'car_model_id' => $this->request->getPost('car_model_id'),  // ensure this exists in your form  
        ];  

        // Update the record in the database  
        if ($this->paymentModel->update($id, $data)) {  
            return redirect()->to('/payments')->with('success', 'Payment updated successfully.');  
        } else {  
            // Handle validation errors  
            return redirect()->back()->withInput()->with('errors', $this->paymentModel->errors());  
        }  
    }  
    public function index()  
    {
        $purchaseHistoryModel = new PurchaseHistoryModel();
        $data['purchases'] = $purchaseHistoryModel->getPurchaseHistory();
        return view('admin/payment_management', $data);
    }

    public function delete($id)  
    {  
        $payment = $this->paymentModel->find($id);  

        if ($payment) {  
            $this->paymentModel->delete($id);  
            return redirect()->to('/payments')->with('success', 'Payment record deleted successfully.');  
        } else {  
            return redirect()->to('/payments')->with('error', 'Payment record not found.');  
        }  
    }
}