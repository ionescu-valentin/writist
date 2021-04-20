<?php
require 'dbh.inc.php';

if (isset($_POST['author'])) {
    $author = $_POST['author'];
    $comment = $_POST['content'];
    $article_id = $_POST['artID'];

    function timeago($date)
    {
        $timestamp = strtotime($date);

        $strTime = array("second", "minute", "hour", "day", "month", "year");
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff     = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
        }
    }


    $date = date("Y-m-d h:i:s a");

    $sql = "INSERT INTO comments (article_index, comment_author, comment_body, date) VALUES (? ,? ,? ,?)";
    $stmt = mysqli_stmt_init($conn);
    #making sure the info is correct
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "We are sorry! A database error has occured. Please try again later!";
    } else {
        #inserting the data into the database
        mysqli_stmt_bind_param($stmt, "isss", $article_id, $author, $comment, $date);
        mysqli_stmt_execute($stmt);
    }

    $sql = "SELECT * FROM comments WHERE article_index=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<span class='red-text'>We are sorry! A database error has occured. Please try again later!</span>";

        #cautam articolul dupa id in baza de date
    } else {
        mysqli_stmt_bind_param($stmt, "i", $article_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $comm_items[] = $row;
            }

            // sorting the comments in descending order by date
            $comm_items = array_reverse($comm_items, true);

            foreach ($comm_items as $item) {
                echo '<div class="row">
                                        <h6 class="col s6 blue-text text-darken-4">' . $item['comment_author'] . '</h6>
                                        <p class="col s6">' . timeago($item['date']) . '</p>
                                        </div>
                                        <p>' . $item['comment_body'] . '</p>
                                        <div class="divider"></div>
                                        <script>document.getElementById("comment-textarea").value = "";
                                        document.getElementById("submit-comment").classList.add("disabled");
                                        </script>';
            }
        } else {
            echo "no article detected in the db";
        }
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<script>location.reload();</script>";
}
