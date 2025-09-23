<?= view('templates/header', ['title' => $title ?? 'Student Dashboard - MARUHOM LMS']) ?>

<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-info text-white rounded">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-light text-info rounded-circle p-3 fs-4">
                                👨‍🎓
                            </span>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Welcome, <?= esc($user['name']) ?>!</h2>
                            <p class="mb-0 opacity-75">Student Dashboard - Continue your learning journey</p>
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
                            <h5 class="fw-bold text-primary mb-1"><?= number_format($enrolledCourses) ?></h5>
                            <p class="text-muted mb-0 small">Enrolled Courses</p>
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
                            <span class="badge bg-success rounded-circle p-3 fs-4">✅</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-success mb-1"><?= number_format($completedAssignments) ?></h5>
                            <p class="text-muted mb-0 small">Completed Assignments</p>
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
                            <span class="badge bg-warning rounded-circle p-3 fs-4">⏰</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-warning mb-1"><?= number_format($pendingAssignments) ?></h5>
                            <p class="text-muted mb-0 small">Pending Assignments</p>
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
                            <span class="badge bg-info rounded-circle p-3 fs-4">📊</span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-info mb-1">85%</h5>
                            <p class="text-muted mb-0 small">Average Grade</p>
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
                        <h5 class="fw-bold mb-0">📚 My Enrolled Courses</h5>
                        <button class="btn btn-primary btn-sm">
                            <span class="me-1">🔍</span> Browse Courses
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
                                        <span class="badge bg-primary rounded-pill">In Progress</span>
                                        <small class="text-muted">75% Complete</small>
                                    </div>
                                    <h6 class="fw-bold text-primary">Web Development Fundamentals</h6>
                                    <p class="text-muted small mb-2">Learn HTML, CSS, and JavaScript basics</p>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="me-2">📝 3/5 lessons</span>
                                            <span>⭐ A</span>
                                        </small>
                                        <button class="btn btn-outline-primary btn-sm">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Card 2 -->
                        <div class="col-md-6">
                            <div class="card border border-success">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <span class="badge bg-success rounded-pill">Completed</span>
                                        <small class="text-muted">100% Complete</small>
                                    </div>
                                    <h6 class="fw-bold text-success">Database Management</h6>
                                    <p class="text-muted small mb-2">MySQL and database design principles</p>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="me-2">📝 8/8 lessons</span>
                                            <span>⭐ A+</span>
                                        </small>
                                        <button class="btn btn-outline-success btn-sm">Review</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Card 3 -->
                        <div class="col-md-6">
                            <div class="card border border-warning">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-2">
                                        <span class="badge bg-warning rounded-pill">Started</span>
                                        <small class="text-muted">20% Complete</small>
                                    </div>
                                    <h6 class="fw-bold text-warning">PHP Programming</h6>
                                    <p class="text-muted small mb-2">Server-side scripting with PHP</p>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 20%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="me-2">📝 2/10 lessons</span>
                                            <span>⭐ B+</span>
                                        </small>
                                        <button class="btn btn-outline-warning btn-sm">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Browse Courses Card -->
                        <div class="col-md-6">
                            <div class="card border border-secondary border-2 border-dashed h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                    <span class="display-6 text-muted mb-2">🔍</span>
                                    <h6 class="fw-bold text-muted mb-2">Explore More Courses</h6>
                                    <p class="text-muted small mb-3">Discover new learning opportunities</p>
                                    <button class="btn btn-outline-primary">Browse Courses</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar with Deadlines and Grades -->
        <div class="col-lg-4">
            <!-- Upcoming Deadlines -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="fw-bold mb-0">⏰ Upcoming Deadlines</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-danger rounded-circle me-3 mt-1">📝</span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 small fw-bold">PHP Final Project</p>
                                    <p class="mb-1 text-muted small">Due: Tomorrow, 11:59 PM</p>
                                    <span class="badge bg-danger rounded-pill small">Urgent</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-warning rounded-circle me-3 mt-1">📝</span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 small fw-bold">Web Dev Quiz 3</p>
                                    <p class="mb-1 text-muted small">Due: March 25, 11:59 PM</p>
                                    <span class="badge bg-warning rounded-pill small">3 days left</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-info rounded-circle me-3 mt-1">📝</span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 small fw-bold">Database Assignment</p>
                                    <p class="mb-1 text-muted small">Due: March 30, 11:59 PM</p>
                                    <span class="badge bg-info rounded-pill small">1 week left</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary btn-sm">View All Deadlines</button>
                    </div>
                </div>
            </div>

            <!-- Recent Grades -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="fw-bold mb-0">📊 Recent Grades & Feedback</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 small fw-bold">Database Quiz 2</p>
                                    <p class="mb-1 text-muted small">MySQL Fundamentals</p>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                                <span class="badge bg-success fs-6">A+</span>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 small fw-bold">Web Dev Project 1</p>
                                    <p class="mb-1 text-muted small">HTML/CSS Portfolio</p>
                                    <small class="text-muted">1 week ago</small>
                                </div>
                                <span class="badge bg-primary fs-6">A</span>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1 small fw-bold">PHP Basics Quiz</p>
                                    <p class="mb-1 text-muted small">Variables and Functions</p>
                                    <small class="text-muted">2 weeks ago</small>
                                </div>
                                <span class="badge bg-warning fs-6">B+</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary btn-sm">View Full Gradebook</button>
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