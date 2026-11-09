
<?php
function studentListEscape($value)
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

    <title>All Students</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>All Students</h2>
            <p class="text-muted mb-0">
                Manage your student records.
            </p>
        </div>

        <a
            href="<?= BASE_PATH ?>/students/create"
            class="btn btn-primary"
        >
            + Add Student
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <?php if (empty($students)): ?>

                <div class="text-center py-5">
                    <h5>No students found</h5>
                    <p class="text-muted">
                        Start by adding your first student.
                    </p>

                    <a
                        href="<?= BASE_PATH ?>/students/create"
                        class="btn btn-primary"
                    >
                        Add Student
                    </a>
                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>Roll Number</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($students as $student): ?>

                                <tr>
                                    <td>
                                        <?= studentListEscape($student['roll_number']) ?>
                                    </td>

                                    <td>
                                        <?= studentListEscape(
                                            $student['first_name'] . ' ' .
                                            $student['last_name']
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= studentListEscape($student['email']) ?>
                                    </td>

                                    <td>
                                        <?= studentListEscape($student['phone']) ?>
                                    </td>

                                    <td>
                                        <?= studentListEscape($student['course']) ?>
                                    </td>

                                    <td>
                                        <?= studentListEscape($student['year']) ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">

                                            <a
                                                href="<?= BASE_PATH ?>/students/show?id=<?= (int)$student['id'] ?>"
                                                class="btn btn-sm btn-info text-white"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="<?= BASE_PATH ?>/students/edit?id=<?= (int)$student['id'] ?>"
                                                class="btn btn-sm btn-warning"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="<?= BASE_PATH ?>/students/delete"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this student?');"
                                            >
                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= (int)$student['id'] ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="csrf_token"
                                                    value="<?= studentListEscape($csrfToken) ?>"
                                                >

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endif; ?>

            <a
                href="<?= BASE_PATH ?>/dashboard"
                class="btn btn-secondary mt-3"
            >
                Back to Dashboard
            </a>

        </div>
    </div>

</div>

</body>
</html>
