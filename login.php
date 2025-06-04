<?php
session_start();

// If already logged in, skip login page
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

// Catch error passed back from login_check.php
$loginErr = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Studynest – Anmeldung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="global.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 60px auto;
            background: #ffffffcc;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.09);
            padding: 36px 28px;
        }

        .btn-main {
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <img src="images/logo.png" alt="Studynest Logo" style="width:90px;">
            <h2 class="mt-2">Anmelden</h2>
        </div>
        <form action="login_validation.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pw" class="form-label">Passwort</label>
                <input type="password" name="passwort" id="pw" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100 btn-main">Anmelden</button>
            <p class="error"><?php echo $loginErr ?></p>
        </form>
        <div class="text-center mt-3">
            <a href="register.html">Noch kein Konto? Registrieren</a>
        </div>
    </div>
</body>

</html>