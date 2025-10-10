<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'description', 'course_code', 'instructor_id', 
        'category', 'credits', 'duration_weeks', 'max_students', 
        'start_date', 'end_date', 'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all active courses with instructor information
     * 
     * @return array
     */
    public function getActiveCourses()
    {
        return $this->select('courses.*, users.name as instructor_name, users.email as instructor_email')
                    ->join('users', 'courses.instructor_id = users.id', 'left')
                    ->where('courses.status', 'active')
                    ->orderBy('courses.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get courses by instructor
     * 
     * @param int $instructor_id
     * @return array
     */
    public function getCoursesByInstructor($instructor_id)
    {
        return $this->where('instructor_id', $instructor_id)->findAll();
    }

    /**
     * Get course with instructor details
     * 
     * @param int $course_id
     * @return array|null
     */
    public function getCourseWithInstructor($course_id)
    {
        return $this->select('courses.*, users.name as instructor_name, users.email as instructor_email')
                    ->join('users', 'courses.instructor_id = users.id', 'left')
                    ->where('courses.id', $course_id)
                    ->first();
    }
}