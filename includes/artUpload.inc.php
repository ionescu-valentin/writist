<?php
require 'dbh.inc.php';

if (isset($_POST['prevTitle'])) {
    $username = $_POST['username'];
    $category = $_POST['category'];
    $title = $_POST['prevTitle'];

    $sql = "SELECT * FROM writings WHERE title=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<span class='red-text'>We are sorry! A database error has occured. Please try again later!</span>";
    } else if (empty($title)) {
        echo "Please enter a title!";
        #checking the database for the requested value
    } else {
        mysqli_stmt_bind_param($stmt, "s", $title);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($category === $row['category'] && $username === $row['writer_username']) {
                echo "Unfortunately, you can only use a title once for each category!";
            } else {
                echo "Nice one!";
            }
        } else {
            echo "Nice one!";
        }
    }
} else if (isset($_POST['title'])) {
    $username = $_POST['username'];
    $category = $_POST['category'];
    $title = $_POST['title'];

    $sql = "SELECT * FROM writings WHERE title=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<span class='red-text'>We are sorry! A database error has occured. Please try again later!</span>";
    } else if (empty($title)) {
        echo "Please enter a title!";
        #checking the database for the requested value
    } else {
        mysqli_stmt_bind_param($stmt, "s", $title);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($category === $row['category'] && $username === $row['writer_username']) {
                echo "Unfortunately, you can only use a title once for each category!";
            } else {
                echo "Nice one!";
            }
        } else {
            echo "Nice one!";
        }
    }
} else {
    echo "<script>location.reload();</script>";
}
