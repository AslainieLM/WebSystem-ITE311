<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Student extends BaseController
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
    }

    public function dashboard()
    {
        if (!$this->isLoggedIn() || $this->session->get('role') !== 'student') {
            $this->session->setFlashdata('error', 'Access denied. Student privileges required.');
            return redirect()->to(base_url('login'));
        }
        $data = $this->getDashboardData();
        
        return view('student/dashboard', $data);
    }

    private function getDashboardData()
    {       
        $enrolledCourses = 3; 
        $completedAssignments = 8; 
        $pendingAssignments = 2; 
        
        return [
            'user' => [
                'userID' => $this->session->get('userID'),
                'name'   => $this->session->get('name'),
                'email'  => $this->session->get('email'),
                'role'   => $this->session->get('role')
            ],
            'title' => 'Student Dashboard - MGOD LMS',
            'enrolledCourses' => $enrolledCourses,
            'completedAssignments' => $completedAssignments,
            'pendingAssignments' => $pendingAssignments
        ];
    }

    private function isLoggedIn(): bool
    {
        return $this->session->get('isLoggedIn') === true;
    }
}
