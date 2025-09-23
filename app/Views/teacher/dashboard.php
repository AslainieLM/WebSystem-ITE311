<?= view('templates/header', ['title' => $title ?? 'Teacher Dashboard - MARUHOM LMS']) ?>

<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-success text-white rounded">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-light text-success rounded-circle p-3 fs-4">
                                👨‍🏫
                            </span>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Welcome, <?= esc($user['name']) ?>!</h2>
                            <p class="mb-0 opacity-75">Teacher Dashboard - Manage your courses and students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-primary rounded-circle p-3 fs-4">📚</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-primary mb-1"><?= number_format($totalCourses) ?></h5>
                            <p class="text-muted mb-0 small">My Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-success rounded-circle p-3 fs-4">👨‍🎓</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-success mb-1"><?= number_format($totalStudents) ?></h5>
                            <p class="text-muted mb-0 small">Total Students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-warning rounded-circle p-3 fs-4">📝</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-warning mb-1">12</h5>
                            <p class="text-muted mb-0 small">Pending Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-info rounded-circle p-3 fs-4">📋</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-info mb-1">8</h5>
                            <p class="text-muted mb-0 small">Active Assignments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row g-4">
        <!-- My Courses Section -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">📚 My Courses</h5>
                        <button class="btn btn-primary btn-sm">
                            <span class="me-1">➕</span> Create New Course
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Course Card 1 -->
                        <div class="col-md-6">
                            <div class="card border border-primary">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <span class="badge bg-primary rounded-pill">Active</span>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                ⋮
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Edit Course</a></li>
                                                <li><a class="dropdown-item" href="#">View Students</a></li>
                                                <li><a class="dropdown-item" href="#">Add Lesson</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold text-primary">Web Development Fundamentals</h6>
                                    <p class="text-muted small mb-2">Learn HTML, CSS, and JavaScript basics</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="me-2">👥 15 students</span>
                                            <span>📝 5 lessons</span>
                                        </small>
                                        <button class="btn btn-outline-primary btn-sm">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Card 2 -->
                        <div class="col-md-6">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <span class="badge bg-success rounded-pill">Active</span>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                ⋮
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Edit Course</a></li>
                                                <li><a class="dropdown-item" href="#">View Students</a></li>
                                                <li><a class="dropdown-item" href="#">Add Lesson</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold text-success">Database Management</h6>
                                    <p class="text-muted small mb-2">MySQL and database design principles</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="me-2">👥 12 students</span>
                                            <span>📝 8 lessons</span>
                                        </small>
                                        <button class="btn btn-outline-success btn-sm">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Card 3 -->
                        <div class="col-md-6">
                            <div class="card border border-info">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <span class="badge bg-info rounded-pill">Active</span>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                ⋮
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Edit Course</a></li>
                                                <li><a class="dropdown-item" href="#">View Students</a></li>
                                                <li><a class="dropdown-item" href="#">Add Lesson</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold text-info">PHP Programming</h6>
                                    <p class="text-muted small mb-2">Server-side scripting with PHP</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="me-2">👥 18 students</span>
                                            <span>📝 10 lessons</span>
                                        </small>
                                        <button class="btn btn-outline-info btn-sm">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Course Card -->
                        <div class="col-md-6">
                            <div class="card border border-secondary border-2 border-dashed h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                    <span class="display-6 text-muted mb-2">➕</span>
                                    <h6 class="fw-bold text-muted mb-2">Create New Course</h6>
                                    <p class="text-muted small mb-3">Start teaching a new subject</p>
                                    <button class="btn btn-outline-primary">Create Course</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications & Quick Actions -->
        <div class="col-lg-4">
            <!-- Notifications -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="fw-bold mb-0">🔔 Recent Notifications</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-primary rounded-circle me-3 mt-1">📝</span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 small"><strong>New assignment submitted</strong></p>
                                    <p class="mb-1 text-muted small">John Doe submitted "Database Project"</p>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-circle me-3 mt-1">👥</span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 small"><strong>New student enrolled</strong></p>
                                    <p class="mb-1 text-muted small">Sarah Johnson joined "Web Development"</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-warning rounded-circle me-3 mt-1">📝</span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 small"><strong>Assignment due reminder</strong></p>
                                    <p class="mb-1 text-muted small">"PHP Basics Quiz" due in 2 days</p>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary btn-sm">View All Notifications</button>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="fw-bold mb-0">⚡ Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary d-flex align-items-center justify-content-start p-3">
                            <span class="me-3">📚</span>
                            <div class="text-start">
                                <div class="fw-bold">Create New Lesson</div>
                                <small class="text-muted">Add content to your courses</small>
                            </div>
                        </button>
                        
                        <button class="btn btn-outline-success d-flex align-items-center justify-content-start p-3">
                            <span class="me-3">📝</span>
                            <div class="text-start">
                                <div class="fw-bold">Create Assignment</div>
                                <small class="text-muted">Give students new tasks</small>
                            </div>
                        </button>
                        
                        <button class="btn btn-outline-info d-flex align-items-center justify-content-start p-3">
                            <span class="me-3">📊</span>
                            <div class="text-start">
                                <div class="fw-bold">View Gradebook</div>
                                <small class="text-muted">Review student performance</small>
                            </div>
                        </button>
                        
                        <button class="btn btn-outline-secondary d-flex align-items-center justify-content-start p-3">
                            <span class="me-3">💬</span>
                            <div class="text-start">
                                <div class="fw-bold">Message Students</div>
                                <small class="text-muted">Send announcements</small>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>

</body>
</html>