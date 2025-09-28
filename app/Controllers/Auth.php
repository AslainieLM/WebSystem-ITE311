<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $session;
    protected $validation;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
    }

    public function register()
    {
        if ($this->session->get('isLoggedIn') === true) {
            return redirect()->to(uri: base_url(relativePath: 'dashboard'));
        }

        if ($this->request->getMethod() === 'POST') {
            
            $rules = [
                'name'             => 'required|min_length[3]|max_length[100]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'password'         => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]'
            ];

            $messages = [
                'name' => [
                    'required'   => 'Name is required.',
                    'min_length' => 'Name must be at least 3 characters long.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ],
                'email' => [
                    'required'    => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'is_unique'   => 'This email is already registered.'
                ],
                'password' => [
                    'required'   => 'Password is required.',
                    'min_length' => 'Password must be at least 6 characters long.'
                ],
                'password_confirm' => [
                    'required' => 'Password confirmation is required.',
                    'matches'  => 'Password confirmation does not match.'
                ]
            ];

            if ($this->validate(rules: $rules, messages: $messages)) {
                
                $hashedPassword = password_hash(password: $this->request->getPost(index: 'password'), algo: PASSWORD_DEFAULT);
                
                $userData = [
                    'name'       => $this->request->getPost(index: 'name'),
                    'email'      => $this->request->getPost(index: 'email'),
                    'password'   => $hashedPassword,
                    'role'       => 'student',
                    'created_at' => date(format: 'Y-m-d H:i:s'),
                    'updated_at' => date(format: 'Y-m-d H:i:s')
                ];

                $builder = $this->db->table(tableName: 'users');
                
                if ($builder->insert(set: $userData)) {
                    $this->session->setFlashdata(data: 'success', value: 'Registration successful! Please login with your credentials.');
                    return redirect()->to(uri: base_url(relativePath: 'login'));
                } else {
                    $this->session->setFlashdata(data: 'error', value: 'Registration failed. Please try again.');
                }
            } else {
                $this->session->setFlashdata(data: 'errors', value: $this->validation->getErrors());
            }
        }

        return view(name: 'auth/register');
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn') === true) {
            return redirect()->to(uri: base_url(relativePath: 'dashboard'));
        }

        if ($this->request->getMethod() === 'POST') {
            
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required'
            ];

            $messages = [
                'email' => [
                    'required'    => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.'
                ],
                'password' => [
                    'required' => 'Password is required.'
                ]
            ];

            if ($this->validate(rules: $rules, messages: $messages)) {
                $email = $this->request->getPost(index: 'email');
                $password = $this->request->getPost(index: 'password');

                $builder = $this->db->table(tableName: 'users');
                $user = $builder->where(key: 'email', value: $email)->get()->getRowArray();

                if ($user && password_verify(password: $password, hash: $user['password'])) {
                    
                    $sessionData = [
                        'userID'     => $user['id'],
                        'name'       => $user['name'],
                        'email'      => $user['email'],
                        'role'       => $user['role'],
                        'isLoggedIn' => true
                    ];

                    $this->session->set(data: $sessionData);
                    
                    $this->session->setFlashdata(data: 'success', value: 'Welcome back, ' . $user['name'] . '!');
                    return redirect()->to(uri: base_url(relativePath: 'dashboard'));
                    
                } else {
                    $this->session->setFlashdata(data: 'error', value: 'Invalid email or password.');
                }
            } else {
                $this->session->setFlashdata(data: 'errors', value: $this->validation->getErrors());
            }
        }

        return view(name: 'auth/login');
    }

    public function logout()
    {
        $this->session->setFlashdata(data: 'success', value: 'You have been logged out successfully.');
        $this->session->destroy();
        return redirect()->to(uri: base_url(relativePath: 'login'));
    }

    public function dashboard()
    {
        if ($this->session->get('isLoggedIn') !== true) {
            $this->session->setFlashdata(data: 'error', value: 'Please login to access the dashboard.');
            return redirect()->to(uri: base_url(relativePath: 'login'));
        }

        $userRole = $this->session->get(key: 'role');
        
        $baseData = [
            'user' => [
                'userID' => $this->session->get(key: 'userID'),
                'name'   => $this->session->get(key: 'name'),
                'email'  => $this->session->get(key: 'email'),
                'role'   => $this->session->get(key: 'role')
            ]
        ];

        switch ($userRole) {
            case 'admin':
                $totalUsers = $this->db->table('users')->countAll();
                $totalAdmins = $this->db->table('users')->where('role', 'admin')->countAllResults();
                $totalTeachers = $this->db->table('users')->where('role', 'teacher')->countAllResults();
                $totalStudents = $this->db->table('users')->where('role', 'student')->countAllResults();
                $recentUsers = $this->db->table('users')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray();

                $dashboardData = array_merge($baseData, [
                    'title' => 'Admin Dashboard - MARUHOM LMS',
                    'totalUsers' => $totalUsers,
                    'totalAdmins' => $totalAdmins,
                    'totalTeachers' => $totalTeachers,
                    'totalStudents' => $totalStudents,
                    'recentUsers' => $recentUsers
                ]);
                return view('auth/dashboard', $dashboardData);
                
            case 'teacher':
                $dashboardData = array_merge($baseData, [
                    'title' => 'Teacher Dashboard - MARUHOM LMS',
                    'totalCourses' => 0,
                    'totalStudents' => 0
                ]);
                return view('auth/dashboard', $dashboardData);
                
            case 'student':
                $dashboardData = array_merge($baseData, [
                    'title' => 'Student Dashboard - MARUHOM LMS',
                    'enrolledCourses' => 0,
                    'completedAssignments' => 0,
                    'pendingAssignments' => 0
                ]);
                return view('auth/dashboard', $dashboardData);
                
            default:
                return view('auth/dashboard', $baseData);
        }
    }
}