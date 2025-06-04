<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Studynest – Registrieren</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="global.css">
    <style>
        .register-container {
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

        .required {
            color: red;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    include('register_validation.php');
    ?>

    <div class="register-container">
        <div class="text-center mb-4">
            <img src="images/logo.png" alt="Studynest Logo" style="width:90px;">
            <h2 class="mt-2">Registrieren</h2>
        </div>
        <form action="register.php" method="post">
            <div class="mb-3">

                <label for="vorname" class="form-label">Vorname</label>
                <span class="required">*</span>
                <input type="text" name="vorname" id="vorname" class="form-control" required>
                <span class="error">
                    <p>
                        <?php echo $vornameErr; ?>
                    </p>
                </span>
            </div>
            <div class="mb-3">
                <label for="nachname" class="form-label">Nachname</label>
                <span class="required">*</span>
                <input type="text" name="nachname" id="nachname" class="form-control" required>
                <span class="error">
                    <p>
                        <?php echo $nachnameErr; ?>
                    </p>
                </span>
            </div>
            <div class="mb-3">
                <label for="regemail" class="form-label">E-Mail</label>
                <span class="required">*</span>
                <input type="email" name="email" id="regemail" class="form-control" required>
                <span class="error">
                    <p>
                        <?php echo $emailErr; ?>
                    </p>
                </span>
            </div>
            <div class="mb-3">
                <label for="regpw" class="form-label">Passwort</label>
                <span class="required">*</span>
                <input type="password" name="passwort" id="regpw" class="form-control" required>
                <span class="error">
                    <p>
                        <?php echo $passwortErr; ?>
                    </p>
                </span>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-main">Registrieren</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.html">Schon registriert? Anmelden</a>
        </div>
    </div>
</body>

</html>