<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Teacher extends BaseController
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
        if (!$this->isLoggedIn() || $this->session->get('role') !== 'teacher') {
            $this->session->setFlashdata('error', 'Access denied. Teacher privileges required.');
            return redirect()->to(base_url('login'));
        }

        $data = $this->getDashboardData();
        
        return view('teacher/dashboard', $data);
    }

    private function getDashboardData()
    {
        $totalCourses = 5; 
        $totalStudents = 25; 
        
        return [
            'user' => [
                'userID' => $this->session->get('userID'),
                'name'   => $this->session->get('name'),
                'email'  => $this->session->get('email'),
                'role'   => $this->session->get('role')
            ],
            'title' => 'Teacher Dashboard - MGOD LMS',
            'totalCourses' => $totalCourses,
            'totalStudents' => $totalStudents
        ];
    }

    private function isLoggedIn(): bool
    {
        return $this->session->get('isLoggedIn') === true;
    }
}
