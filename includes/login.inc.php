<?php
require 'dbh.inc.php';

if (isset($_POST['submit'])) {

    #variabile pt datele de logare
    $username = $_POST['username'];
    $password = $_POST['password'];

    #in caz ca vreun camp e gol
    if (empty($username) || empty($password)) {
        echo "<span class='red-text'>All fields need to be filled in!</span>
        <script>document.getElementById('log-password').classList.add('invalid');
                    document.getElementById('log-username').classList.add('invalid');
                    </script>";
    }

    #verificam daca baza de date e ok
    else {
        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "<span class='red-text'>We are sorry! A database error has occured. Please try again later!</span>";

            #verificam daca datele sunt corecte
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passcheck = password_verify($password, $row['password']);
                if ($passcheck === false) {
                    echo "<span class='red-text'>Incorrect password!</span>
                    <script>document.getElementById('log-password').classList.add('invalid');</script>";
                } else if ($passcheck === true) {
                    session_start();
                    $_SESSION['userID'] = $row['user_index'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['fName'] = $row['first_name'];
                    $_SESSION['lName'] = $row['last_name'];
                    $_SESSION['email'] = $row['email_address'];

                    echo "<script>location.reload();</script>";
                    exit();
                } else {
                    echo "<span class='red-text'>Incorrect username and password!</span>
                    <script>document.getElementById('log-password').classList.add('invalid');
                    document.getElementById('log-username').classList.add('invalid');
                    </script>";
                }
            } else {
                echo "<span class='red-text'>Incorrect username!</span>
                <script>document.getElementById('log-username').classList.add('invalid');</script>";
            }
        }
    }
} else {
    echo "<span class='red-text'>No log in attempt detected!</span>";
}
