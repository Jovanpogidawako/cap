<?php

namespace App\Controllers;

use App\Models\ContactModel;
use CodeIgniter\Controller;

class Contact extends Controller
{
    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    // User side - Display contact form
    public function index()
    {
        return view('layout/contacts');
    }

    // User side - Submit contact form
    public function submit()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'message' => 'required|min_length[10]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return view('contact_form', [
                'validation' => $this->validator,
            ]);
        }

        $this->contactModel->save([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'message' => $this->request->getVar('message'),
        ]);

        return redirect()->to('/contact')->with('success', 'Your message has been sent!');
    }

    // Admin side - Display contact messages
    public function messages()
    {
        $data['messages'] = $this->contactModel->findAll();
        return view('admin/messages', $data);
    }

    // Admin side - Delete a message
    public function delete($id)
    {
        $this->contactModel->delete($id);
        return redirect()->to('/contact/messages')->with('success', 'Message deleted successfully.');
    }
}
