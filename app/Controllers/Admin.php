<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        //
    }

    public function dashboard()
    {
        if (!$this->isLoggedIn() || $this->session->get('role') !== 'admin') {
            $this->session->setFlashdata('error', 'Access denied. Admin privileges required.');
            return redirect()->to(base_url('login'));
        }
        $data = $this->getDashboardData();
        
        return view('admin/dashboard', $data);
    }

    private function getDashboardData()
    {
        $totalUsers = $this->db->table('users')->countAll();
        
        $totalAdmins = $this->db->table('users')->where('role', 'admin')->countAllResults();
        $totalTeachers = $this->db->table('users')->where('role', 'teacher')->countAllResults();
        $totalStudents = $this->db->table('users')->where('role', 'student')->countAllResults();
        
        $recentUsers = $this->db->table('users')
                                ->orderBy('created_at', 'DESC')
                                ->limit(5)
                                ->get()
                                ->getResultArray();

        return [
            'user' => [
                'userID' => $this->session->get('userID'),
                'name'   => $this->session->get('name'),
                'email'  => $this->session->get('email'),
                'role'   => $this->session->get('role')
            ],
            'title' => 'Admin Dashboard - MGOD LMS',
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
            'recentUsers' => $recentUsers
        ];
    }

    private function isLoggedIn(): bool
    {
        return $this->session->get('isLoggedIn') === true;
    }
}
