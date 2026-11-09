
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Student Management System</title>
</head>

<body>

    <h1>Welcome Back!</h1>

    <p>Login to your Student Management System account.</p>

    <?php if (!empty($error)): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;">
            <?= htmlspecialchars($success) ?>
        </p>
    <?php endif; ?>

    <form action="<?= BASE_PATH ?>/login" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrfToken) ?>"
        >

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
                placeholder="Enter your password"
                required
            >
        </div>

        <br>

        <button type="submit">Login</button>

    </form>

    <p>
        Don't have an account?
        <a href="<?= BASE_PATH ?>/register">Register here</a>
    </p>

</body>
</html>
