
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Student Management System</title>
</head>

<body>

    <h1>Create Account</h1>

    <p>Register to access the Student Management System.</p>

    <?php if (!empty($error)): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form action="<?= BASE_PATH ?>/register" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrfToken) ?>"
        >

        <div>
            <label>Full Name</label>
            <input
                type="text"
                name="name"
                placeholder="Enter your name"
                maxlength="100"
                required
            >
        </div>

        <br>

        <div>
            <label>Email</label>
            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                maxlength="150"
                required
            >
        </div>

        <br>

        <div>
            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Create password"
                minlength="8"
                required
            >
        </div>

        <br>

        <div>
            <label>Confirm Password</label>
            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                minlength="8"
                required
            >
        </div>

        <br>

        <button type="submit">Register</button>

    </form>

    <p>
        Already have an account?
        <a href="<?= BASE_PATH ?>/login">Login here</a>
    </p>

</body>
</html>
