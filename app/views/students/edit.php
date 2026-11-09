
<?php
function editEscape($value)
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

    <title>Update Student</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm mx-auto" style="max-width: 850px;">

        <div class="card-header bg-warning">
            <h4 class="mb-0">Update Student Details</h4>
        </div>

        <div class="card-body p-4">

            <?php if (!empty($errors['general'])): ?>
                <div class="alert alert-danger">
                    <?= editEscape($errors['general']) ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_PATH ?>/students/update" method="POST">

                <input type="hidden" name="id"
                       value="<?= (int)$student['id'] ?>">

                <input type="hidden" name="csrf_token"
                       value="<?= editEscape($csrfToken) ?>">

                <h5 class="mb-3">Personal Information</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Roll Number *</label>
                        <input type="text" name="roll_number"
                               class="form-control"
                               value="<?= editEscape($student['roll_number']) ?>"
                               required>
                        <small class="text-danger">
                            <?= editEscape($errors['roll_number'] ?? '') ?>
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name"
                               class="form-control"
                               value="<?= editEscape($student['first_name']) ?>"
                               required>
                        <small class="text-danger">
                            <?= editEscape($errors['first_name'] ?? '') ?>
                        </small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name"
                               class="form-control"
                               value="<?= editEscape($student['last_name']) ?>"
                               required>
                        <small class="text-danger">
                            <?= editEscape($errors['last_name'] ?? '') ?>
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth"
                               class="form-control"
                               value="<?= editEscape($student['date_of_birth']) ?>">
                        <small class="text-danger">
                            <?= editEscape($errors['date_of_birth'] ?? '') ?>
                        </small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select Gender</option>

                            <?php foreach (['Male', 'Female', 'Other'] as $gender): ?>
                                <option value="<?= $gender ?>"
                                    <?= ($student['gender'] ?? '') === $gender
                                        ? 'selected' : '' ?>>
                                    <?= $gender ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <small class="text-danger">
                            <?= editEscape($errors['gender'] ?? '') ?>
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="<?= editEscape($student['email']) ?>">
                        <small class="text-danger">
                            <?= editEscape($errors['email'] ?? '') ?>
                        </small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone"
                           class="form-control"
                           value="<?= editEscape($student['phone']) ?>">
                </div>

                <hr>

                <h5 class="mb-3">Academic Information</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Course *</label>
                        <input type="text" name="course"
                               class="form-control"
                               value="<?= editEscape($student['course']) ?>"
                               required>
                        <small class="text-danger">
                            <?= editEscape($errors['course'] ?? '') ?>
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Academic Year *</label>
                        <input type="text" name="year"
                               class="form-control"
                               value="<?= editEscape($student['year']) ?>"
                               required>
                        <small class="text-danger">
                            <?= editEscape($errors['year'] ?? '') ?>
                        </small>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control"
                              rows="3"><?= editEscape($student['address']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    Update Student
                </button>

                <a href="<?= BASE_PATH ?>/students"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
