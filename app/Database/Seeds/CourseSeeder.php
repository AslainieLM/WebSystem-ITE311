<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // First, create some teacher users if they don't exist
        $db = \Config\Database::connect();
        
        // Check if we have any teachers
        $teacherCount = $db->table('users')->where('role', 'teacher')->countAllResults();
        
        if ($teacherCount == 0) {
            // Create a sample teacher
            $teacherData = [
                [
                    'name' => 'Dr. Jane Smith',
                    'email' => 'jane.smith@maruhom.edu',
                    'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                    'role' => 'teacher',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Prof. John Doe',
                    'email' => 'john.doe@maruhom.edu',
                    'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                    'role' => 'teacher',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Dr. Alice Johnson',
                    'email' => 'alice.johnson@maruhom.edu',
                    'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                    'role' => 'teacher',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ];
            
            $db->table('users')->insertBatch($teacherData);
        }
        
        // Get teacher IDs
        $teachers = $db->table('users')->where('role', 'teacher')->get()->getResultArray();
        $teacherIds = array_column($teachers, 'id');
        
        if (empty($teacherIds)) {
            echo "No teachers found. Please create teacher accounts first.\n";
            return;
        }
        
        // Sample course data
        $courses = [
            [
                'title' => 'Introduction to Programming',
                'description' => 'Learn the fundamentals of programming using modern languages and development practices. This course covers variables, control structures, functions, and basic algorithms.',
                'course_code' => 'CS101',
                'instructor_id' => $teacherIds[0],
                'category' => 'Computer Science',
                'credits' => 3,
                'duration_weeks' => 16,
                'max_students' => 25,
                'start_date' => date('Y-m-d', strtotime('+1 week')),
                'end_date' => date('Y-m-d', strtotime('+17 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Web Development Fundamentals',
                'description' => 'Comprehensive introduction to web development including HTML, CSS, JavaScript, and modern frameworks. Build real-world projects and learn industry best practices.',
                'course_code' => 'WEB201',
                'instructor_id' => $teacherIds[0],
                'category' => 'Web Development',
                'credits' => 4,
                'duration_weeks' => 14,
                'max_students' => 20,
                'start_date' => date('Y-m-d', strtotime('+2 weeks')),
                'end_date' => date('Y-m-d', strtotime('+16 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Database Design and Management',
                'description' => 'Learn how to design, implement, and manage relational databases. Topics include SQL, normalization, indexing, and database optimization techniques.',
                'course_code' => 'DB301',
                'instructor_id' => count($teacherIds) > 1 ? $teacherIds[1] : $teacherIds[0],
                'category' => 'Database',
                'credits' => 3,
                'duration_weeks' => 12,
                'max_students' => 30,
                'start_date' => date('Y-m-d', strtotime('+1 week')),
                'end_date' => date('Y-m-d', strtotime('+13 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Build native and cross-platform mobile applications. Learn iOS and Android development, UI/UX design principles, and app store deployment.',
                'course_code' => 'MOB401',
                'instructor_id' => count($teacherIds) > 1 ? $teacherIds[1] : $teacherIds[0],
                'category' => 'Mobile Development',
                'credits' => 4,
                'duration_weeks' => 16,
                'max_students' => 15,
                'start_date' => date('Y-m-d', strtotime('+3 weeks')),
                'end_date' => date('Y-m-d', strtotime('+19 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'description' => 'Master essential data structures and algorithms. Topics include arrays, linked lists, trees, graphs, sorting, and searching algorithms with complexity analysis.',
                'course_code' => 'CS202',
                'instructor_id' => count($teacherIds) > 2 ? $teacherIds[2] : $teacherIds[0],
                'category' => 'Computer Science',
                'credits' => 4,
                'duration_weeks' => 16,
                'max_students' => 25,
                'start_date' => date('Y-m-d', strtotime('+2 weeks')),
                'end_date' => date('Y-m-d', strtotime('+18 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Cybersecurity Fundamentals',
                'description' => 'Introduction to cybersecurity concepts, threat analysis, risk management, and security best practices. Learn to protect systems and data from cyber threats.',
                'course_code' => 'SEC501',
                'instructor_id' => count($teacherIds) > 2 ? $teacherIds[2] : $teacherIds[0],
                'category' => 'Cybersecurity',
                'credits' => 3,
                'duration_weeks' => 14,
                'max_students' => 20,
                'start_date' => date('Y-m-d', strtotime('+1 week')),
                'end_date' => date('Y-m-d', strtotime('+15 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Machine Learning Basics',
                'description' => 'Introduction to machine learning concepts, supervised and unsupervised learning, neural networks, and practical applications using Python.',
                'course_code' => 'ML601',
                'instructor_id' => count($teacherIds) > 2 ? $teacherIds[2] : $teacherIds[0],
                'category' => 'Artificial Intelligence',
                'credits' => 4,
                'duration_weeks' => 16,
                'max_students' => 18,
                'start_date' => date('Y-m-d', strtotime('+4 weeks')),
                'end_date' => date('Y-m-d', strtotime('+20 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Project Management for IT',
                'description' => 'Learn project management methodologies, Agile and Scrum frameworks, risk management, and team leadership skills for technology projects.',
                'course_code' => 'PM701',
                'instructor_id' => $teacherIds[0],
                'category' => 'Project Management',
                'credits' => 3,
                'duration_weeks' => 12,
                'max_students' => 5, // Small class for testing "course full" functionality
                'start_date' => date('Y-m-d', strtotime('+1 week')),
                'end_date' => date('Y-m-d', strtotime('+13 weeks')),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        // Check if courses already exist
        $existingCourses = $db->table('courses')->countAllResults();
        
        if ($existingCourses == 0) {
            // Insert courses
            $this->db->table('courses')->insertBatch($courses);
            echo "Sample courses have been created successfully!\n";
        } else {
            echo "Courses already exist in the database.\n";
        }
    }
}