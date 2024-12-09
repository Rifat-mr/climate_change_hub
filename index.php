<?php
include 'db.php';
session_start();

// Registration logic
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='index.php'>Login</a>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Login logic
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid credentials!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Climate Hub</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <h1>Climate Change Awareness Hub</h1>
        <p>Login to access the portal</p>
    </header>

    <main>
        <!-- Registration Form -->
        <?php if (isset($_GET['register'])): ?>
            <form method="POST">
                <h2>Register</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="register">Register</button>
                <p><a href="index.php">Back to Login</a></p>
            </form>
        <?php else: ?>
            <!-- Login Form -->
            <form method="POST">
                <h2>Login</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p><a href="?register">Don't have an account? Register</a></p>
            </form>
        <?php endif; ?>
    </main>

    <!-- Logout Button -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="logout-container">
            <a href="?logout" class="logout-btn">Logout</a>
        </div>
    <?php endif; ?>
</body>
</html>
