<?= view('templates/header', ['title' => $title ?? 'Dashboard - MARUHOM LMS']) ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <?php if ($user['role'] === 'admin'): ?>
                    <div class="card-body bg-primary text-white rounded">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="badge bg-light text-primary rounded-circle p-3 fs-4">👨‍💼</span>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1">Welcome, <?= esc($user['name']) ?>!</h2>
                                <p class="mb-0 opacity-75">Admin Dashboard - Manage your learning management system</p>
                            </div>
                        </div>
                    </div>
                <?php elseif ($user['role'] === 'teacher'): ?>
                    <div class="card-body bg-success text-white rounded">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="badge bg-light text-success rounded-circle p-3 fs-4">👨‍🏫</span>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1">Welcome, <?= esc($user['name']) ?>!</h2>
                                <p class="mb-0 opacity-75">Teacher Dashboard - Manage your courses and students</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card-body bg-info text-white rounded">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="badge bg-light text-info rounded-circle p-3 fs-4">👨‍🎓</span>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1">Welcome, <?= esc($user['name']) ?>!</h2>
                                <p class="mb-0 opacity-75">Student Dashboard - Continue your learning journey</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <?php if ($user['role'] === 'admin'): ?>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-circle p-3 fs-4">👥</span>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary mb-1"><?= number_format($totalUsers) ?></h5>
                                <p class="text-muted mb-0 small">Total Users</p>
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
                                <span class="badge bg-success rounded-circle p-3 fs-4">👨‍🏫</span>
                            </div>
                            <div>
                                <h5 class="fw-bold text-success mb-1"><?= number_format($totalTeachers) ?></h5>
                                <p class="text-muted mb-0 small">Total Teachers</p>
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
                                <span class="badge bg-info rounded-circle p-3 fs-4">👨‍🎓</span>
                            </div>
                            <div>
                                <h5 class="fw-bold text-info mb-1"><?= number_format($totalStudents) ?></h5>
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
                                <span class="badge bg-warning rounded-circle p-3 fs-4">📚</span>
                            </div>
                            <div>
                                <h5 class="fw-bold text-warning mb-1">0</h5>
                                <p class="text-muted mb-0 small">Total Courses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($user['role'] === 'teacher'): ?>
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
                                <h5 class="fw-bold text-warning mb-1">0</h5>
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
                                <h5 class="fw-bold text-info mb-1">0</h5>
                                <p class="text-muted mb-0 small">Active Assignments</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
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
                                <h5 class="fw-bold text-info mb-1">0%</h5>
                                <p class="text-muted mb-0 small">Average Grade</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <?php if ($user['role'] === 'admin'): ?>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">🔧 Quick Management</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-start p-3">
                                <span class="me-3">👥</span>
                                <div class="text-start">
                                    <div class="fw-bold">Manage Users</div>
                                    <small class="text-muted">Add, edit, or remove users</small>
                                </div>
                            </a>
                            <a href="#" class="btn btn-outline-success d-flex align-items-center justify-content-start p-3">
                                <span class="me-3">📚</span>
                                <div class="text-start">
                                    <div class="fw-bold">Manage Courses</div>
                                    <small class="text-muted">Create and manage courses</small>
                                </div>
                            </a>
                            <a href="#" class="btn btn-outline-info d-flex align-items-center justify-content-start p-3">
                                <span class="me-3">📊</span>
                                <div class="text-start">
                                    <div class="fw-bold">View Reports</div>
                                    <small class="text-muted">Analytics and reports</small>
                                </div>
                            </a>
                            <a href="#" class="btn btn-outline-secondary d-flex align-items-center justify-content-start p-3">
                                <span class="me-3">⚙️</span>
                                <div class="text-start">
                                    <div class="fw-bold">System Settings</div>
                                    <small class="text-muted">Configure system settings</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">📋 Recent User Activity</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($recentUsers)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recentUsers as $recentUser): ?>
                                            <tr>
                                                <td class="fw-semibold"><?= esc($recentUser['name']) ?></td>
                                                <td class="text-muted"><?= esc($recentUser['email']) ?></td>
                                                <td>
                                                    <span class="badge bg-<?= $recentUser['role'] === 'admin' ? 'danger' : ($recentUser['role'] === 'teacher' ? 'success' : 'primary') ?> rounded-pill">
                                                        <?= ucfirst($recentUser['role']) ?>
                                                    </span>
                                                </td>
                                                <td class="text-muted small"><?= date('M j, Y', strtotime($recentUser['created_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <span class="text-muted">No recent activity found.</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php elseif ($user['role'] === 'teacher'): ?>
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
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">🔔 Recent Notifications</h5>
                    </div>
                </div>
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
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
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
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">⏰ Upcoming Deadlines</h5>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">📊 Recent Grades</h5>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($user['role'] === 'admin'): ?>
        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">📈 System Overview</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="fw-bold text-muted mb-3">User Distribution</h6>
                                    <div class="mb-2">
                                        <span class="badge bg-danger me-2">Admin</span>
                                        <span class="fw-bold"><?= $totalAdmins ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge bg-success me-2">Teachers</span>
                                        <span class="fw-bold"><?= $totalTeachers ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge bg-primary me-2">Students</span>
                                        <span class="fw-bold"><?= $totalStudents ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="fw-bold text-muted mb-3">System Status</h6>
                                    <div class="mb-2">
                                        <span class="badge bg-success me-2">●</span>
                                        <span>System Online</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge bg-info me-2">●</span>
                                        <span>Database Connected</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge bg-primary me-2">●</span>
                                        <span>All Services Running</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="fw-bold text-muted mb-3">Quick Stats</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Last Login:</small>
                                        <div class="fw-bold"><?= date('F j, Y g:i A') ?></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Server Status:</small>
                                        <div class="fw-bold text-success">Online</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>