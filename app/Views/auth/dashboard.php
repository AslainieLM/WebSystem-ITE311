<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    
    <title><?= isset($title) ? $title : 'Dashboard - Maruhom LMS' ?></title>
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
            <strong>Maruhom LMS</strong>
        </a>
        
        <div class="navbar-nav ml-auto">
            <span class="navbar-text text-white mr-3">
                Welcome, <?= isset($user) ? htmlspecialchars($user['name']) : 'Student' ?>
            </span>
            <a class="nav-link text-white" href="<?= base_url('/') ?>">Homepage</a>
            <a class="nav-link text-white" href="<?= base_url('logout') ?>" 
               onclick="return confirm('Are you sure you want to logout?')">
                Logout
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 mb-4">
                <h2 class="text-center text-primary">
                    <strong>Maruhom Learning Management System</strong>
                </h2>
                <p class="text-center text-muted">Your Gateway to Online Learning</p>
            </div>
        </div>

        <div class="row">
            <!-- My Courses Card -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h5 class="mb-0">My Courses</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                Web Development
                                <span class="badge badge-primary badge-pill">75%</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                Database Design
                                <span class="badge badge-warning badge-pill">45%</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                PHP Programming
                                <span class="badge badge-info badge-pill">90%</span>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-success btn-sm">View All Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 px-0">
                                <small class="text-muted">Today, 2:30 PM</small>
                                <p class="mb-1">Completed "PHP Basics" lesson</p>
                            </div>
                            <div class="list-group-item border-0 px-0">
                                <small class="text-muted">Yesterday, 4:15 PM</small>
                                <p class="mb-1">Submitted Assignment #3</p>
                            </div>
                            <div class="list-group-item border-0 px-0">
                                <small class="text-muted">2 days ago</small>
                                <p class="mb-1">Started "Database Design" course</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" 
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
</body>
</html>