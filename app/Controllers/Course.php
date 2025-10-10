<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Course extends BaseController
{
    protected $session;
    protected $courseModel;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
    }

    /**
     * Handle AJAX enrollment request
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function enroll()
    {
        // Set response header for JSON
        $this->response->setContentType('application/json');

        // Check if user is logged in
        if ($this->session->get('isLoggedIn') !== true) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You must be logged in to enroll in courses.'
            ])->setStatusCode(401);
        }

        // Check if request is POST
        if ($this->request->getMethod() !== 'POST') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method.'
            ])->setStatusCode(405);
        }

        // Get user ID from session
        $userId = $this->session->get('userID');
        
        // Get course ID from POST request
        $courseId = $this->request->getPost('course_id');

        // Validate course ID
        if (!$courseId || !is_numeric($courseId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid course ID provided.'
            ])->setStatusCode(400);
        }

        try {
            // Check if course exists and is active
            $course = $this->courseModel->getCourseWithInstructor($courseId);
            if (!$course) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Course not found.'
                ])->setStatusCode(404);
            }

            if ($course['status'] !== 'active') {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'This course is not currently available for enrollment.'
                ])->setStatusCode(400);
            }

            // Check if user is already enrolled
            if ($this->enrollmentModel->isAlreadyEnrolled($userId, $courseId)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'You are already enrolled in this course.'
                ])->setStatusCode(409);
            }

            // Check enrollment capacity
            $currentEnrollments = $this->enrollmentModel->where('course_id', $courseId)->countAllResults();
            if ($currentEnrollments >= $course['max_students']) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'This course has reached its maximum enrollment capacity.'
                ])->setStatusCode(400);
            }

            // Prepare enrollment data
            $enrollmentData = [
                'user_id' => $userId,
                'course_id' => $courseId,
                'enrollment_date' => date('Y-m-d H:i:s')
            ];

            // Insert enrollment record
            $enrollmentId = $this->enrollmentModel->enrollUser($enrollmentData);

            if ($enrollmentId) {
                // Get updated enrollment count
                $newEnrollmentCount = $this->enrollmentModel->where('course_id', $courseId)->countAllResults();
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Successfully enrolled in ' . esc($course['title']) . '!',
                    'enrollment_id' => $enrollmentId,
                    'course_title' => $course['title'],
                    'instructor_name' => $course['instructor_name'],
                    'enrollment_count' => $newEnrollmentCount,
                    'max_students' => $course['max_students']
                ])->setStatusCode(200);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to enroll in course. Please try again.'
                ])->setStatusCode(500);
            }

        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Enrollment error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while processing your enrollment. Please try again.'
            ])->setStatusCode(500);
        }
    }

    /**
     * Get available courses for enrollment
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function getAvailableCourses()
    {
        // Check if user is logged in
        if ($this->session->get('isLoggedIn') !== true) {
            return redirect()->to(base_url('login'));
        }

        $userId = $this->session->get('userID');

        try {
            // Get all active courses
            $allCourses = $this->courseModel->getActiveCourses();
            
            // Get user's enrolled course IDs
            $enrolledCourses = $this->enrollmentModel->where('user_id', $userId)->findAll();
            $enrolledCourseIds = array_column($enrolledCourses, 'course_id');

            // Filter out already enrolled courses
            $availableCourses = array_filter($allCourses, function($course) use ($enrolledCourseIds) {
                return !in_array($course['id'], $enrolledCourseIds);
            });

            // Add enrollment count to each course
            foreach ($availableCourses as &$course) {
                $course['current_enrollments'] = $this->enrollmentModel->where('course_id', $course['id'])->countAllResults();
                $course['spots_remaining'] = $course['max_students'] - $course['current_enrollments'];
                $course['is_full'] = $course['current_enrollments'] >= $course['max_students'];
            }

            return $this->response->setJSON([
                'success' => true,
                'courses' => array_values($availableCourses)
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error fetching available courses: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to load available courses.'
            ])->setStatusCode(500);
        }
    }

    /**
     * Unenroll from a course
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function unenroll()
    {
        // Set response header for JSON
        $this->response->setContentType('application/json');

        // Check if user is logged in
        if ($this->session->get('isLoggedIn') !== true) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You must be logged in to unenroll from courses.'
            ])->setStatusCode(401);
        }

        // Check if request is POST
        if ($this->request->getMethod() !== 'POST') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method.'
            ])->setStatusCode(405);
        }

        $userId = $this->session->get('userID');
        $courseId = $this->request->getPost('course_id');

        // Validate course ID
        if (!$courseId || !is_numeric($courseId)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid course ID provided.'
            ])->setStatusCode(400);
        }

        try {
            // Check if user is enrolled
            if (!$this->enrollmentModel->isAlreadyEnrolled($userId, $courseId)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'You are not enrolled in this course.'
                ])->setStatusCode(400);
            }

            // Remove enrollment
            $deleted = $this->enrollmentModel->where('user_id', $userId)
                                           ->where('course_id', $courseId)
                                           ->delete();

            if ($deleted) {
                // Get course info
                $course = $this->courseModel->find($courseId);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Successfully unenrolled from ' . esc($course['title']) . '.'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to unenroll from course. Please try again.'
                ])->setStatusCode(500);
            }

        } catch (\Exception $e) {
            log_message('error', 'Unenrollment error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while processing your unenrollment.'
            ])->setStatusCode(500);
        }
    }
}
