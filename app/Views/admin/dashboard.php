<?= view('templates/header', ['title' => $title ?? 'Admin Dashboard - MARUHOM LMS']) ?>

<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-primary text-white rounded">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-light text-primary rounded-circle p-3 fs-4">
                                👨‍💼
                            </span>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Welcome, <?= esc($user['name']) ?>!</h2>
                            <p class="mb-0 opacity-75">Admin Dashboard - Manage your learning management system</p>
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
    </div>

    <!-- Management Links and Recent Activity -->
    <div class="row g-4">
        <!-- Management Links -->
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

        <!-- Recent Activity Table -->
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
                                        <th class="border-0 fw-bold">User</th>
                                        <th class="border-0 fw-bold">Email</th>
                                        <th class="border-0 fw-bold">Role</th>
                                        <th class="border-0 fw-bold">Joined</th>
                                        <th class="border-0 fw-bold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentUsers as $user): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-secondary rounded-circle me-3 p-2">
                                                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                                    </span>
                                                    <span class="fw-semibold"><?= esc($user['name']) ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted"><?= esc($user['email']) ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                $badgeClass = match($user['role']) {
                                                    'admin' => 'bg-danger',
                                                    'teacher' => 'bg-success',
                                                    'student' => 'bg-primary',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $badgeClass ?> rounded-pill">
                                                    <?= ucfirst($user['role']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <?= date('M j, Y', strtotime($user['created_at'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary btn-sm">View</button>
                                                    <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                                </div>
                                            </td>
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
    </div>

    <!-- System Overview -->
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
                                    <small class="text-muted">Active Session:</small>
                                    <div class="fw-bold">Admin Panel</div>
                                </div>
                            </div>
                        </div>
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