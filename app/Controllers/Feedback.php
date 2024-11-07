<?php 

namespace App\Controllers;

use App\Models\FeedbackModel;

class Feedback extends BaseController
{
    public function index()
    {
        // Load user feedback
        $model = new FeedbackModel();
        $userId = session()->get('user_id'); // Assuming user ID is stored in session
        $data['feedback'] = $model->getFeedbackByUserId($userId);
        return view('user/feedback_view', $data);
    }

    public function admin()
    {
        // Load all feedback for admin
        $model = new FeedbackModel();
        $data['feedback'] = $model->getAllFeedback();
        return view('admin/feedback_list', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $model = new FeedbackModel();
            $data = [
                'user_id'   => session()->get('user_id'), // Assuming user ID is stored in session
                'user_name' => $this->request->getPost('user_name'),
                'email'     => $this->request->getPost('email'),
                'message'   => $this->request->getPost('message')
            ];
            $model->save($data);
            return redirect()->to('/feedback')->with('message', 'Feedback submitted successfully');
        }
        return view('feedback_form');
    }
}
