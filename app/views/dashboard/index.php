
<?php
// Escape output safely
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .sidebar {
            min-height: 100vh;
            background: #172554;
            color: white;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
        }

        .content {
            padding: 30px;
        }

    </style>

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- Sidebar -->
        <aside class="col-md-3 col-lg-2 sidebar p-4">

            <h4 class="mb-4">Student MS</h4>

            <a href="<?= BASE_PATH ?>/dashboard"
               class="active">
                Dashboard
            </a>

            <a href="<?= BASE_PATH ?>/students">
                Students
            </a>

            <hr>

            <form action="<?= BASE_PATH ?>/logout"
                  method="POST">

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= e($_SESSION['csrf_token']) ?>"
                >

                <button
                    type="submit"
                    class="btn btn-outline-light w-100">
                    Logout
                </button>

            </form>

        </aside>


        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 content">

            <!-- Welcome Section -->
            <div class="mb-4">

                <h2>
                    Welcome, <?= e($userName) ?>!
                </h2>

                <p class="text-muted">
                    Here's your student management overview.
                </p>

            </div>


            <!-- Statistics Cards -->
            <div class="row g-4">

                <div class="col-md-6 col-xl-4">

                    <div class="card stat-card shadow-sm p-3">

                        <div class="card-body">

                            <h6 class="text-muted">
                                Total Students
                            </h6>

                            <h2 class="fw-bold">
                                <?= e($totalStudents) ?>
                            </h2>

                            <p class="text-muted mb-0">
                                Students registered in your system
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-6 col-xl-4">

                    <div class="card stat-card shadow-sm p-3">

                        <div class="card-body">

                            <h6 class="text-muted">
                                Recent Records
                            </h6>

                            <h2 class="fw-bold">
                                <?= count($recentStudents) ?>
                            </h2>

                            <p class="text-muted mb-0">
                                Latest student records
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Quick Actions -->
            <div class="mt-5">

                <h4>Quick Actions</h4>

                <div class="d-flex gap-3 mt-3 flex-wrap">

                    <a href="<?= BASE_PATH ?>/students/create"
                       class="btn btn-primary">
                        Add Student
                    </a>

                    <a href="<?= BASE_PATH ?>/students"
                       class="btn btn-outline-primary">
                        View Students
                    </a>

                </div>

            </div>


            <!-- Recent Students -->
            <div class="mt-5">

                <h4>Recently Added Students</h4>

                <div class="card shadow-sm border-0 mt-3">

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover">

                                <thead>

                                    <tr>
                                        <th>Roll Number</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Year</th>
                                    </tr>

                                </thead>

                                <tbody>

                                <?php if (!empty($recentStudents)): ?>

                                    <?php foreach ($recentStudents as $student): ?>

                                        <tr>

                                            <td>
                                                <?= e($student['roll_number']) ?>
                                            </td>

                                            <td>
                                                <?= e($student['first_name'] . ' ' . $student['last_name']) ?>
                                            </td>

                                            <td>
                                                <?= e($student['course']) ?>
                                            </td>

                                            <td>
                                                <?= e($student['year']) ?>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="4"
                                            class="text-center text-muted py-4">

                                            No student records available yet.

                                        </td>

                                    </tr>

                                <?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>
