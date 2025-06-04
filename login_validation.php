
<?php
session_start();
require_once 'database.php';  // defines $pdo

// 1. Basic input sanitation
$email    = test_input($_POST['email']    ?? '');
$passwort = test_input($_POST['passwort'] ?? '');

if ($email === '' || $passwort === '') {
    $_SESSION['login_error'] = "Bitte füllen Sie alle Felder aus.";
    header("Location: login.php");
    exit;
}

try {
    // 2. Fetch user by email
    $stmt = $pdo->prepare("SELECT id, vorname, passwort FROM Benutzer WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3. Verify password
    if ($user && password_verify($passwort, $user['passwort'])) {
        // 4. Success – store session data
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['vorname'];
        header("Location: home.html");
        exit;
    }

    // 5. Failure – back to login with error
    $_SESSION['login_error'] = "Falsche Email oder Passwort.";
    header("Location: login.php");
    exit;
} catch (PDOException $e) {
    // Optional: log error instead of showing details
    $_SESSION['login_error'] = "Datenbankfehler. Bitte später erneut versuchen.";
    header("Location: login.php");
    exit;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>