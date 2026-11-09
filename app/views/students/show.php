
<?php
function studentDetailEscape($value)
{
    return htmlspecialchars(
        (string)($value ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Details</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm mx-auto" style="max-width: 750px;">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Student Details</h4>
        </div>

        <div class="card-body p-4">

            <h5 class="mb-4">
                <?= studentDetailEscape(
                    $student['first_name'] . ' ' .
                    $student['last_name']
                ) ?>
            </h5>

            <table class="table table-bordered">

                <tr>
                    <th>Student ID</th>
                    <td><?= (int)$student['id'] ?></td>
                </tr>

                <tr>
                    <th>Roll Number</th>
                    <td><?= studentDetailEscape($student['roll_number']) ?></td>
                </tr>

                <tr>
                    <th>First Name</th>
                    <td><?= studentDetailEscape($student['first_name']) ?></td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td><?= studentDetailEscape($student['last_name']) ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?= studentDetailEscape($student['email']) ?></td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td><?= studentDetailEscape($student['phone']) ?></td>
                </tr>

                <tr>
                    <th>Gender</th>
                    <td><?= studentDetailEscape($student['gender']) ?></td>
                </tr>

                <tr>
                    <th>Date of Birth</th>
                    <td><?= studentDetailEscape($student['date_of_birth']) ?></td>
                </tr>

                <tr>
                    <th>Course</th>
                    <td><?= studentDetailEscape($student['course']) ?></td>
                </tr>

                <tr>
                    <th>Academic Year</th>
                    <td><?= studentDetailEscape($student['year']) ?></td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td><?= studentDetailEscape($student['address']) ?></td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td><?= studentDetailEscape($student['created_at']) ?></td>
                </tr>

                <tr>
                    <th>Updated At</th>
                    <td><?= studentDetailEscape($student['updated_at']) ?></td>
                </tr>

            </table>

            <a
                href="<?= BASE_PATH ?>/students"
                class="btn btn-secondary"
            >
                Back to Students
            </a>

        </div>
    </div>

</div>

</body>
</html>
