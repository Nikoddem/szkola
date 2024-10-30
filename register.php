<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<meta charset="UTF-8">
    <title>Rejestracja</title>
    <style>
        /* Stylowanie kontenera */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Stylowanie formularza */
        form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        /* Stylowanie pól formularza */
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Stylowanie przycisku */
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
        <form action="register.php" method="POST">
            <h2>Rejestracja</h2>
            <input type="text" name="username" placeholder="Nazwa użytkownika" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Hasło" required><br>
            <button type="submit">Zarejestruj się</button>
        </form>
    </div>
</body>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Nazwa użytkownika" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
        <button type="submit">Zarejestruj się</button>
    </form>
</body>
</html>



<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $usersFile = 'users.txt';

    // Sprawdź, czy email już istnieje
    $fileContent = file_get_contents($usersFile);
    if (strpos($fileContent, $email) !== false) {
        echo "Ten email jest już używany!";
    } else {
        // Zapisz nowego użytkownika do pliku
        $userData = "$username,$email,$password\n";
        file_put_contents($usersFile, $userData, FILE_APPEND);
        
        // Po udanej rejestracji przekieruj na stronę logowania
        header("Location: login.php");
        exit(); // Zakończ skrypt po przekierowaniu
    }
}
?>