
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management System</title>
</head>

<body>

    <h1>Student Management System</h1>

    <?php if (isset($_SESSION['user_id'])): ?>

        <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>

        <p>You are successfully logged in.</p>

        <p>
            Email:
            <?= htmlspecialchars($_SESSION['user_email']) ?>
        </p>

        <form action="<?= BASE_PATH ?>/logout" method="POST">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
            >

            <button type="submit">Logout</button>

        </form>

    <?php else: ?>

        <h2>Welcome Guest!</h2>

        <p>Please log in to access your account.</p>

        <a href="<?= BASE_PATH ?>/login">Login</a>

        <br><br>

        <a href="<?= BASE_PATH ?>/register">Register</a>

    <?php endif; ?>

</body>
</html>
