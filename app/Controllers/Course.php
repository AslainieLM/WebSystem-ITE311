<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EnrollmentModel;

class Course extends BaseController
{
    protected $session;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        
        $this->enrollmentModel = new EnrollmentModel();
    }
    public function enroll()
    {
        $this->response->setContentType('application/json');

        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access. Please login first.',
                'error_code' => 'UNAUTHORIZED'
            ])->setStatusCode(401);
        }

        if ($this->session->get('role') !== 'student') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Access denied. Only students can enroll in courses.',
                'error_code' => 'ACCESS_DENIED'
            ])->setStatusCode(403);
        }

        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method. Only POST requests are allowed.',
                'error_code' => 'INVALID_METHOD'
            ])->setStatusCode(405);
        }

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request type. Only AJAX requests are allowed.',
                'error_code' => 'INVALID_REQUEST_TYPE'
            ])->setStatusCode(400);
        }

        try {
            $config = config('Security');
            if ($config->csrfProtection !== false && $config->csrfProtection !== '') {
                
                $tokenName = $config->csrfTokenName ?? 'csrf_token_name';
                $headerName = $config->csrfHeaderName ?? 'X-CSRF-TOKEN';
                
                $submittedToken = $this->request->getPost($tokenName) ?? $this->request->getHeaderLine($headerName);
                
                $expectedToken = csrf_hash();
                
                if (empty($submittedToken) || empty($expectedToken)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Security token is missing. Please refresh the page and try again.',
                        'error_code' => 'CSRF_MISSING',
                        'csrf_hash' => csrf_hash(),
                        'debug' => [
                            'submitted_token_empty' => empty($submittedToken),
                            'expected_token_empty' => empty($expectedToken),
                            'token_name' => $tokenName
                        ]
                    ])->setStatusCode(403);
                }
                
                if (!hash_equals($expectedToken, $submittedToken)) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Security token validation failed. Please refresh the page and try again.',
                        'error_code' => 'CSRF_INVALID',
                        'csrf_hash' => csrf_hash(),
                        'debug' => [
                            'submitted_token' => substr($submittedToken, 0, 10) . '...',
                            'expected_token' => substr($expectedToken, 0, 10) . '...',
                            'tokens_match' => false
                        ]
                    ])->setStatusCode(403);
                }
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'CSRF validation error: ' . $e->getMessage(),
                'error_code' => 'CSRF_EXCEPTION',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(403);
        }

        $course_id = $this->request->getPost('course_id');
        
        if (!$course_id || !is_numeric($course_id) || $course_id <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Valid course ID is required.',
                'error_code' => 'INVALID_COURSE_ID',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(400);
        }

        $user_id = $this->session->get('userID');

        $course_id = (int)$course_id;

        try {
            $alreadyEnrolled = $this->enrollmentModel->isAlreadyEnrolled($user_id, $course_id);
            
            if ($alreadyEnrolled) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'You are already enrolled in this course.',
                    'error_code' => 'ALREADY_ENROLLED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(409);
            }            
            $philippineTimezone = new \DateTimeZone('Asia/Manila');
            $currentDateTime = new \DateTime('now', $philippineTimezone);
            
            $enrollmentData = [
                'user_id' => $user_id,
                'course_id' => $course_id,
                'enrollment_date' => $currentDateTime->format('Y-m-d H:i:s')
            ];

            $enrollmentResult = $this->enrollmentModel->enrollUser($enrollmentData);

            if ($enrollmentResult) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Successfully enrolled in the course!',
                    'data' => [
                        'enrollment_id' => $enrollmentResult,
                        'user_id' => $user_id,
                        'course_id' => $course_id,                        
                        'enrollment_date' => $enrollmentData['enrollment_date'],
                        'enrollment_date_formatted' => $currentDateTime->format('M j, Y g:iA')
                    ],
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(201);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to enroll in the course. Please try again later.',
                    'error_code' => 'ENROLLMENT_FAILED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(500);
            }

        } catch (\Exception $e) {
            log_message('error', 'Course enrollment error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
                'error_code' => 'INTERNAL_ERROR',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(500);
        }
    }

    public function removeStudent()
    {
        $this->response->setContentType('application/json');

        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access. Please login first.',
                'error_code' => 'UNAUTHORIZED'
            ])->setStatusCode(401);
        }

        if ($this->session->get('role') !== 'teacher') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Access denied. Only teachers can remove students from courses.',
                'error_code' => 'ACCESS_DENIED'
            ])->setStatusCode(403);
        }

        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method. Only POST requests are allowed.',
                'error_code' => 'INVALID_METHOD'
            ])->setStatusCode(405);
        }

        try {
            if (!$this->validate(['csrf_test_name' => 'required'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'CSRF validation failed.',
                    'error_code' => 'CSRF_FAILED'
                ])->setStatusCode(400);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'CSRF validation error.',
                'error_code' => 'CSRF_ERROR'
            ])->setStatusCode(400);
        }

        $student_id = $this->request->getPost('student_id');
        $course_id = $this->request->getPost('course_id');
        
        if (!$student_id || !is_numeric($student_id) || $student_id <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid student ID provided.',
                'error_code' => 'INVALID_STUDENT_ID',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(400);
        }

        if (!$course_id || !is_numeric($course_id) || $course_id <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid course ID provided.',
                'error_code' => 'INVALID_COURSE_ID',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(400);
        }

        $teacher_id = $this->session->get('userID');

        $student_id = (int)$student_id;
        $course_id = (int)$course_id;

        try {
            $db = \Config\Database::connect();
            $course = $db->table('courses')
                ->where('id', $course_id)
                ->where("JSON_CONTAINS(instructor_ids, '\"$teacher_id\"')", null, false)
                ->get()
                ->getRowArray();

            if (!$course) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'You do not have permission to remove students from this course.',
                    'error_code' => 'COURSE_NOT_OWNED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(403);
            }

            $enrollment = $db->table('enrollments')
                ->where('user_id', $student_id)
                ->where('course_id', $course_id)
                ->get()
                ->getRowArray();

            if (!$enrollment) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Student is not enrolled in this course.',
                    'error_code' => 'STUDENT_NOT_ENROLLED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(404);
            }

            $student = $db->table('users')
                ->select('name, email')
                ->where('id', $student_id)
                ->where('role', 'student')
                ->get()
                ->getRowArray();

            if (!$student) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Student not found or invalid.',
                    'error_code' => 'STUDENT_NOT_FOUND',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(404);
            }

            $removeResult = $db->table('enrollments')
                ->where('user_id', $student_id)
                ->where('course_id', $course_id)
                ->delete();

            if ($removeResult) {
                log_message('info', 'Teacher ' . $this->session->get('name') . ' (ID: ' . $teacher_id . ') removed student ' . $student['name'] . ' (ID: ' . $student_id . ') from course "' . $course['title'] . '" (ID: ' . $course_id . ')');

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Student successfully removed from the course.',
                    'data' => [
                        'student_name' => $student['name'],
                        'student_email' => $student['email'],
                        'course_title' => $course['title'],
                        'course_code' => $course['course_code'],
                        'removed_by' => $this->session->get('name'),
                        'removal_date' => date('M j, Y g:iA')
                    ],
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(200);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to remove student from the course. Please try again later.',
                    'error_code' => 'REMOVAL_FAILED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(500);
            }

        } catch (\Exception $e) {
            log_message('error', 'Student removal error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
                'error_code' => 'INTERNAL_ERROR',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(500);
        }
    }

    public function addStudent()
    {
        $this->response->setContentType('application/json');

        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access. Please login first.',
                'error_code' => 'UNAUTHORIZED'
            ])->setStatusCode(401);
        }

        if ($this->session->get('role') !== 'teacher') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Access denied. Only teachers can add students to courses.',
                'error_code' => 'ACCESS_DENIED'
            ])->setStatusCode(403);
        }

        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method. Only POST requests are allowed.',
                'error_code' => 'INVALID_METHOD'
            ])->setStatusCode(405);
        }

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request type. Only AJAX requests are allowed.',
                'error_code' => 'INVALID_REQUEST_TYPE'
            ])->setStatusCode(400);
        }

        $student_id = $this->request->getPost('student_id');
        $course_id = $this->request->getPost('course_id');

        if (!$student_id || !$course_id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Student ID and Course ID are required.',
                'error_code' => 'MISSING_PARAMETERS',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(400);
        }

        $teacher_id = $this->session->get('userID');

        $student_id = (int)$student_id;
        $course_id = (int)$course_id;

        try {
            $db = \Config\Database::connect();
            $course = $db->table('courses')
                ->where('id', $course_id)
                ->where("JSON_CONTAINS(instructor_ids, '\"$teacher_id\"')", null, false)
                ->get()
                ->getRowArray();

            if (!$course) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'You do not have permission to add students to this course.',
                    'error_code' => 'COURSE_NOT_OWNED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(403);
            }

            $student = $db->table('users')
                ->select('name, email')
                ->where('id', $student_id)
                ->where('role', 'student')
                ->get()
                ->getRowArray();

            if (!$student) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Student not found or invalid.',
                    'error_code' => 'STUDENT_NOT_FOUND',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(404);
            }

            $enrollment = $db->table('enrollments')
                ->where('user_id', $student_id)
                ->where('course_id', $course_id)
                ->get()
                ->getRowArray();

            if ($enrollment) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Student is already enrolled in this course.',
                    'error_code' => 'STUDENT_ALREADY_ENROLLED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(400);
            }

            $enrollmentCount = $db->table('enrollments')
                ->where('course_id', $course_id)
                ->countAllResults();

            if ($course['max_students'] > 0 && $enrollmentCount >= $course['max_students']) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Course has reached maximum enrollment limit.',
                    'error_code' => 'ENROLLMENT_LIMIT_REACHED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(400);
            }

            $enrollmentData = [
                'user_id' => $student_id,
                'course_id' => $course_id,
                'enrollment_date' => date('Y-m-d H:i:s')
            ];

            $addResult = $db->table('enrollments')->insert($enrollmentData);

            if ($addResult) {
                log_message('info', 'Teacher ' . $this->session->get('name') . ' (ID: ' . $teacher_id . ') added student ' . $student['name'] . ' (ID: ' . $student_id . ') to course "' . $course['title'] . '" (ID: ' . $course_id . ')');

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Student successfully added to the course.',
                    'data' => [
                        'student_name' => $student['name'],
                        'student_email' => $student['email'],
                        'student_id' => $student_id,
                        'course_title' => $course['title'],
                        'course_code' => $course['course_code'],
                        'enrollment_date' => $enrollmentData['enrollment_date'],
                        'enrollment_date_formatted' => date('M j, Y', strtotime($enrollmentData['enrollment_date'])),
                        'added_by' => $this->session->get('name'),
                        'addition_date' => date('M j, Y g:iA')
                    ],
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(200);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to add student to the course. Please try again later.',
                    'error_code' => 'ADDITION_FAILED',
                    'csrf_hash' => csrf_hash()
                ])->setStatusCode(500);
            }

        } catch (\Exception $e) {
            log_message('error', 'Student addition error: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
                'error_code' => 'INTERNAL_ERROR',
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(500);
        }
    }

    public function getAvailableStudents()
    {
        $this->response->setContentType('application/json');

        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access. Please login first.',
                'error_code' => 'UNAUTHORIZED'
            ])->setStatusCode(401);
        }

        if ($this->session->get('role') !== 'teacher') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Access denied. Only teachers can access this resource.',
                'error_code' => 'ACCESS_DENIED'
            ])->setStatusCode(403);
        }

        $course_id = $this->request->getGet('course_id');

        if (!$course_id || !is_numeric($course_id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Valid course ID is required.',
                'error_code' => 'INVALID_COURSE_ID'
            ])->setStatusCode(400);
        }

        $course_id = (int)$course_id;
        $teacher_id = $this->session->get('userID');

        try {
            $db = \Config\Database::connect();

            $course = $db->table('courses')
                ->where('id', $course_id)
                ->where("JSON_CONTAINS(instructor_ids, '\"$teacher_id\"')", null, false)
                ->get()
                ->getRowArray();

            if (!$course) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Course not found or access denied.',
                    'error_code' => 'COURSE_NOT_OWNED'
                ])->setStatusCode(403);
            }

            $availableStudents = $db->table('users')
                ->select('id, name, email')
                ->where('role', 'student')
                ->where('id NOT IN (SELECT user_id FROM enrollments WHERE course_id = ' . $course_id . ')', null, false)
                ->orderBy('name', 'ASC')
                ->get()
                ->getResultArray();

            return $this->response->setJSON([
                'success' => true,
                'data' => [
                    'students' => $availableStudents,
                    'course_title' => $course['title'],
                    'course_code' => $course['course_code']
                ]
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Get available students error: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
                'error_code' => 'INTERNAL_ERROR'
            ])->setStatusCode(500);
        }
    }
}
