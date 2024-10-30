<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>


<style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="login.php" method="POST">
            <h2>Logowanie</h2>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Hasło" required><br>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
</body>
</html>


<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usersFile = 'users.txt';
    $fileContent = file($usersFile, FILE_IGNORE_NEW_LINES);

    $userFound = false;

    foreach ($fileContent as $user) {
        list($storedUsername, $storedEmail, $storedPassword) = explode(',', $user);

        if ($email == $storedEmail && password_verify($password, trim($storedPassword))) {
            $_SESSION['username'] = $storedUsername;
            $_SESSION['email'] = $storedEmail;
            $userFound = true;
            
            // Po udanym zalogowaniu przekieruj na index.php
            header("Location: index.php");
            exit();
        }
    }

    if (!$userFound) {
        echo "Błędne dane logowania.";
    }
}
?>
<?php
session_start();

// Sprawdź, czy użytkownik jest zalogowany
if (isset($_SESSION['username'])) {
    echo "Witaj, " . htmlspecialchars($_SESSION['username']) . "!";
} else {
    // Jeśli nie jest zalogowany, przekieruj do strony logowania
    header("Location: login.php");
    exit();
}
?>