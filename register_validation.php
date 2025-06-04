<?php

include('database.php');

$vorname = $nachname = $email = $passwort = "";
$vornameErr = $nachnameErr = $emailErr = $passwortErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["vorname"])) {
    $vornameErr = "Vorname ist erforderlich!";
  } else {
    $vorname = test_input($_POST["vorname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $vorname)) {
      $vornameErr = "Only letters and white space allowed!";
    }
  }

  if (empty($_POST["nachname"])) {
    $nachnameErr = "Nachname ist erforderlich!";
  } else {
    $nachname = test_input($_POST["nachname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nachname)) {
      $nachnameErr = "Only letters and white space allowed!";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email ist erforderlich!";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Üngültige Email Adresse!";
    }
  }

  if (empty($_POST["passwort"])) {
    $passwortErr = "Passwort ist erforderlich!";
  } else {
    $passwort = test_input($_POST["passwort"]);
    // check if name only contains letters and whitespace
    $passwordValidation = validatePassword($passwort);
    if ($passwordValidation !== "Password is valid.") {
      $passwortErr = $passwordValidation;
    }
  }

  // Saving user in database
  if (empty($vornameErr) && empty($nachnameErr) && empty($emailErr) && empty($passwortErr)) {
    try {
      // Hash the password securely
      $hashedPassword = password_hash($passwort, PASSWORD_DEFAULT);

      // Prepare and execute SQL query
      $stmt = $pdo->prepare("INSERT INTO Benutzer (vorname, nachname, email, passwort) VALUES (?, ?, ?, ?)");
      $stmt->execute([$vorname, $nachname, $email, $hashedPassword]);

      header("Location: login.php");
      exit;
    } catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
    }
  }
}

function validatePassword($password)
{
  $errors = [];

  // Check for minimum length
  if (strlen($password) < 8) {
    $errors[] = "at least 8 characters";
  }

  // Check for at least one uppercase letter
  if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "at least one uppercase letter";
  }

  // Check for at least one number
  if (!preg_match('/\d/', $password)) {
    $errors[] = "at least one number";
  }

  // Final result
  if (empty($errors)) {
    return "Password is valid.";
  } else {
    return "Password must contain: " . implode(", ", $errors) . ".";
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
