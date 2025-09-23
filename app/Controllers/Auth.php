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
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('dashboard'));
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

            if ($this->validate($rules, $messages)) {
                $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                
                $userData = [
                    'name'       => $this->request->getPost('name'),
                    'email'      => $this->request->getPost('email'),
                    'password'   => $hashedPassword,
                    'role'       => 'student',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $builder = $this->db->table('users');
                
                if ($builder->insert($userData)) {
                    $this->session->setFlashdata('success', 'Registration successful! Please login with your credentials.');
                    return redirect()->to(base_url('login'));
                } else {
                    $this->session->setFlashdata('error', 'Registration failed. Please try again.');
                }
            } else {
                $this->session->setFlashdata('errors', $this->validation->getErrors());
            }
        }

        return view('auth/register');
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            return $this->redirectByRole();
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

            if ($this->validate($rules, $messages)) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $builder = $this->db->table('users');
                $user = $builder->where('email', $email)->get()->getRowArray();

                if ($user && password_verify($password, $user['password'])) {
                    $sessionData = [
                        'userID'     => $user['id'],
                        'name'       => $user['name'],
                        'email'      => $user['email'],
                        'role'       => $user['role'],
                        'isLoggedIn' => true
                    ];

                    $this->session->set($sessionData);
                    $this->session->setFlashdata('success', 'Welcome back, ' . $user['name'] . '!');
                    return $this->redirectByRole();
                } else {
                    $this->session->setFlashdata('error', 'Invalid email or password.');
                }
            } else {
                $this->session->setFlashdata('errors', $this->validation->getErrors());
            }
        }

        return view('auth/login');
    }

    private function redirectByRole()
    {
        $role = $this->session->get('role');
        
        switch ($role) {
            case 'admin':
                return redirect()->to(base_url('admin/dashboard'));
            case 'teacher':
                return redirect()->to(base_url('teacher/dashboard'));
            case 'student':
                return redirect()->to(base_url('student/dashboard'));
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        $this->session->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to(base_url('login'));
    }

    public function dashboard()
    {
        if (!$this->isLoggedIn()) {
            $this->session->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to(base_url('login'));
        }

        return $this->redirectByRole();
    }

    private function isLoggedIn(): bool
    {
        return $this->session->get('isLoggedIn') === true;
    }

    public function getCurrentUser(): array
    {
        return [
            'userID' => $this->session->get('userID'),
            'name'   => $this->session->get('name'),
            'email'  => $this->session->get('email'),
            'role'   => $this->session->get('role')
        ];
    }
}