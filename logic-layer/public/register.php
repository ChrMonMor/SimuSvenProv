<?php
$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validation
    if (strlen($username) > 50) {
        $errorMessage = "Username must be 50 characters or less.";
    } elseif (strlen($password) < 6) {
        $errorMessage = "Password must be at least 6 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } else {
        // Prepare POST request to API
        $postData = json_encode([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        $ch = curl_init('http://10.130.56.50/api/register');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 || $httpCode === 201) {
            $successMessage = "Registration successful!";
        } else {
            $errorMessage = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 40px; }
        form { background: white; padding: 24px; max-width: 400px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5c6bc0; color: white; padding: 10px 20px; border: none; border-radius: 4px;
            cursor: pointer; font-size: 16px;
        }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h2 style="text-align:center">Register</h2>

<form method="POST" action="">
    <?php if ($successMessage): ?>
        <p class="success"><?= htmlspecialchars($successMessage) ?></p>
    <?php elseif ($errorMessage): ?>
        <p class="error"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" maxlength="50" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password (min 6 characters)</label>
    <input type="password" id="password" name="password" required minlength="6">

    <input type="submit" value="Register">
</form>

</body>
</html>
