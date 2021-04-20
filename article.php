<?php
session_start();

require 'includes/dbh.inc.php';

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

#if the POST Article button has been pressed
if (isset($_POST['submit_writing'])) {
    if (isset($_POST['HTML_writing'])) {
        $username = $_SESSION['username'];
        $writing_title = $_POST['writing_title'];
        $writing_content = $_POST['HTML_writing'];
        $category = $_POST['category'];
        $date = date("j. m. Y ");
        $demo = $_POST['writing_demo'];
        $likes_no = 0;
        $comments_no = 0;
        $article_exists = false;

        $sequel = "SELECT * FROM writings WHERE writer_username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sequel)) {
            echo "<span class='red-text'>We are sorry! A database error has occured. Please try again later!</span>";

            #verificam daca datele sunt corecte
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($category === $row['category']) {
                        if ($writing_title === $row['title']) {
                            $article_exists = true;
                            $article_id = $row['writing_index'];
                        }
                    }
                }
            }
        }

        if (!$article_exists) {
            $sql = "INSERT INTO writings (writer_username,title,writing_content, category, date, writing_demo, likes_number, comments_number) VALUES (? ,? ,? ,? ,? ,? ,? , ?)";
            $stmt = mysqli_stmt_init($conn);
            #making sure the info is correct
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "We are sorry! A database error has occured. Please try again later!";
            } else {
                #inserting the data into the database
                mysqli_stmt_bind_param($stmt, "ssssssii", $username, $writing_title, $writing_content, $category, $date, $demo, $likes_no, $comments_no);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        echo 'No article detected';
    }
    // when the browse page sents to article
} else if (isset($_GET['goto_article'])) {
    $article_id = $_GET['article_id'];

    $sequel = "SELECT * FROM writings WHERE writing_index=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sequel)) {
        echo "<span class='red-text'>We are sorry! A database error has occured. Please try again later!</span>";

        #verificam daca datele sunt corecte
    } else {
        mysqli_stmt_bind_param($stmt, "i", $article_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['writer_username'];
                $writing_title = $row['title'];
                $writing_content = $row['writing_content'];
                $likes_no = $row['likes_number'];
                $comments_no = $row['comments_number'];
            }
        } else {
            echo "no article detected in the db";
        }
    }
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- head of the doc here -->

<head>
    <!-- adding the characters set -->
    <meta charset="UTF-8" />
    <!-- Let browser know website is optimized for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- import materialize css style -->
    <link rel="stylesheet" href="css/materialize.css" />
    <!-- import local stylesheet -->
    <link rel="stylesheet" href="css/styles.css" />
    <!-- import google fonts icons -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- import jquery library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- import materialize javascript -->
    <script src="js/materialize.min.js"></script>

    <title>Article name</title>
</head>

<!-- body of the document here -->

<body class="blue lighten-4">

    <!--#########sidenav content -->
    <ul id='sidebar-menu' class='sidenav sidenav-fixed'>
        <!-- logo -->
        <li><a href="index.php" class="brand-logo">Writist
            </a></li>
        <li>
            <div class="divider"></div>
        </li>

        <!-- the user profile -->
        <li class="hide-on-med-and-down">
            <div class="user-view row ">
                <a href="#user" class="col s6"><i class="material-icons medium">account_circle</i></a>
                <?php
                if (!isset($_SESSION['username'])) {
                    echo '<a id="login-nav-link" data-target="login-modal" class="modal-trigger col s6"> <h5>Log in</h5></a>';
                } else {
                    echo '<div class="row col s6"><a href="#name" class="name col s12"><h5>My profile</h5></a>
            <a href="#email" class="col s12"><span class="email">' . $_SESSION["username"] . '</span></a></div>';
                }
                ?>
            </div>
            <div class="divider"></div>
        </li>

        <!-- navigation -->
        <li class="sidenav-subcategory hide-on-med-and-down">
            <a>Where to?</a>
        </li>
        <li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
        <li class="hide-on-med-and-down"><a href="writePreps.php"><i class="material-icons">mode_editor</i>Write</a></li>
        <li>
            <div class="divider"></div>
        </li>

        <!-- read & write menu on large-->
        <li>
            <ul>
                <!-- More reading options -->
                <li class="sidenav-subcategory"><a>More reading options</a></li>
                <ul class="side-read-color">
                    <li><a href="#!"><i class="material-icons">insert_chart</i>browse by category</a>
                    </li>
                    <li><a href="#!"><i class="material-icons">local_activity</i>weekly challenge</a>
                    </li>
                    <li><a href="#!"><i class="material-icons">gesture</i>generate random</a></li>
                </ul>

                <div class="divider"></div>
                <li class="no-padding hide-on-med-and-down">
                    <ul class="collapsible collapsible-accordion">
                        <!-- More writing options -->
                        <li>
                            <a class="collapsible-header">More writing options<i class="material-icons">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="#!"><i class="material-icons">lightbulb_outline</i>Writing ideas</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">extension</i>Poetry tips and tricks</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- more options for mobile -->
                <li class="sidenav-subcategory hide-on-large-only"><a>More writing options</a></li>
                <ul class="hide-on-large-only">
                    <li><a href="#!"><i class="material-icons">lightbulb_outline</i>Writing ideas</a>
                    </li>
                    <li><a href="#!"><i class="material-icons">extension</i>Poetry tips and tricks</a>
                    </li>
                </ul>
            </ul>
        </li>

        <li>
            <div class="divider"></div>
        </li>

        <!-- log out button -->
        <?php
        if (isset($_SESSION['username'])) {
            echo '<li>
      <br>
      <form method="POST" action="includes/logout.inc.php" class="center">
        <button type="submit" name="log_out" class="btn pink darken-2 white-text">Log out</button>
      </form>
    </li>';
        }
        ?>

    </ul>

    <!-- bottom-navigation for mobile -->
    <div id="bottom-nav-wrapper" class=" blue darken-4 hide-on-large-only">

        <!-- bottom navigation -->
        <ul id="bottom-in-browse" class="bottom-menu">
            <li class="sidenav-trigger" data-target="sidebar-menu"><a href="#"><i name="bottom-icon" class="material-icons medium">sort</i><span class="menu-item-name medium hide">Menu</span></a>
            </li>
            <li><a href="browse.php"><i name="bottom-icon" class=" material-icons medium">import_contacts</i><span class="menu-item-name">Read</span> </a>
            </li>
            <li><a href="writePreps.php"><i name="bottom-icon" class=" material-icons medium">mode_edit</i><span class="menu-item-name hide">Create</span> </a>
            </li>
            <!-- hidden account li -->
            <?php
            if (isset($_SESSION['username'])) {
                echo '<!-- hidden account li -->
        <li ><a href="#" class="flow-text"><i name="bottom-icon" class="material-icons medium">account_box</i><span class="menu-item-name hide ">Profile</span></a>
        </li>';
            } else {
                echo '<li><a href="#" data-target="login-modal" class="flow-text modal-trigger"><span class="bottom-login">Log
            in</span></a>
      </li>';
            } ?>
        </ul>
    </div>

    <!-- modal login -->
    <div class="modal" id="login-modal">
        <div class="modal-content blue-text text-darken-2">
            <h4 class="modal-header center">Log in</h4>

            <form id="login-form" method="POST" action="includes/login.inc.php">
                <div class="input-field">
                    <input id="log-username" name="log_username" type="text" class="validate">
                    <label for="log-username">Username</label>
                </div>

                <div class="input-field">
                    <input id="log-password" name="log_password" type="password" class="validate">
                    <label for="log-password">Password</label>
                </div>

                <div class="row">
                    <div class="col s6">
                        <button id="send-login-attempt" name="log_submit" type="submit" class="left btn waves-effect blue darken-2">Log in</button>
                    </div>
                    <div class="col s6">
                        <a data-target="signup-modal" class=" btn center waves-effect blue lighten-5 blue-text modal-trigger">Sign
                            up</a>
                    </div>
                </div>

            </form>
            <p id="login-data" class="center"></p>
        </div>
    </div>

    <!-- modal sign up -->
    <div class="modal" id="signup-modal">
        <div class="modal-content blue-text text-darken-2">
            <div class="modal-header center">
                <h4>Sign up</h4>
            </div>

            <form id="signup-form" method="POST" action="includes/signup.inc.php">
                <div class="input-field">
                    <input id="firstName" name="first_name" type="text" pattern="[a-zA-Z]{1,}" title="Please use only letters!" class="validate" required>
                    <label for="firstName">First name</label>
                </div>
                <div class="input-field">
                    <input id="lastName" name="last_name" type="text" pattern="[a-zA-Z]{1,}" title="Please use only letters!" class="validate" required>
                    <label for="lastName">Last name</label>
                </div>
                <div class="input-field">
                    <input id="email" name="email_address" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="validate" title="Please enter a valid e-mail address!" required>
                    <label for="email">E-mail address</label>
                </div>
                <div class="input-field">
                    <input id="username" name="user_name" type="text" pattern="[a-zA-Z][a-zA-Z0-9._]{4,20}" class="validate" title="Letters, numbers and characters that include '_' and '.' !" required>
                    <label for="username">Create your username</label>
                </div>

                <div class="input-field ">
                    <input id="password" type="password" name="password" pattern="[a-zA-Z0-9]{8,}" title="Please enter at least 8 characters!" class="validate" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field">
                    <input id="password2" type="password" name="pass_repeat" minlength="8" class="validate" required>
                    <label for="password2">Repeat password</label>
                </div>

                <div class="center">
                    <button id="send_signup_attempt" name="send_signup_attempt" type="submit" class=" btn center waves-effect blue lighten-5 blue-text ">Sign up</button>
                </div>

            </form>
            <p id="signup-data"></p>
        </div>
    </div>

    <!-- modal confirm comment deletion -->
    <div class="modal" id="delete-com-modal">
        <div class="modal-content blue-text text-darken-2">
            <h4 class="modal-header center">Are you sure?</h4>

            <p class="center">Comfirm your decision by pressing "YES"!</p>
            
            <button class="btn small blue darken-2 modal-close">YES</button>
            <button class="btn small grey lighten-2 blue-text modal-close">CANCEL</button>
        </div>
    </div>
    <!-- ########## main page content here-->
    <main id="article-content" class="container">
        <div class="row">
            <div class="col s12 l8">
                <div class="card white">
                    <div class="card-content ">

                        <?php
                        echo '<h4 class="article-title blue-text text-darken-4">' . $writing_title . '</h4>
                        <p class="author blue-text text-darken-2">' . $username . '</p>
                        <div class="divider"></div>
                        <div class="article-body">
                            ' . $writing_content . '
                        </div>
                        <div class="divider"></div>
                        <div class="reactions-box ">
                            <div class="left">
                                <a><i class="material-icons">thumb_up</i>' . $likes_no . '</a>
                                <a><i class="material-icons">textsms</i>' . $comments_no . '</a>
                            </div>

                            <a class="right"><i class="material-icons">favorite_border</i></a>
                        </div>';
                        ?>

                    </div>
                </div>

            </div>
            <div class="col s12 l8">
                <div class="card white">
                    <div class="card-content">

                        <h5 class="article-title blue-text text-darken-4">Leave a comment:</h5>
                        <form id="comment-form">
                            <div class="row">
                                <textarea id="comment-textarea" class="materialize-textarea col s12 m8"></textarea>
                                <input type="text" name="" id="comment-author" class="hide" value=" <?= $_SESSION['username'] ?> ">
                                <input type="number" name="" id="article-index" class="hide" value="<?= $article_id ?>">
                                <button id="submit-comment" class="col s3 m2 btn blue darken-2 btn-small push-m1 disabled" type="submit">Post</button>
                            </div>

                        </form>
                        <div class="divider"></div>
                        <div id="comments-section" class="article-body">
                            <?php
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
                                        $dateago = timeago($item['date']);
                                        echo '<div class="row">
                                                <h6 class="col s8 blue-text text-darken-4">' . $item['comment_author'] . '</h6>
                                                <p class="col s3">' . $dateago . '</p>
                                                <div class="row col s1">
                                                    <a class="col s12"><i class="material-icons">edit</i></a>
                                                    <a class="col s12 modal-trigger" data-target="delete-com-modal"><i class="material-icons">delete</i></a>
                                                </div>
                                            </div>
                                                <p>' . $item['comment_body'] . '</p>
                                                <div class="divider"></div>
                                            
                                            <script>document.getElementById("comment-textarea").value = "";</script>';
                                    }
                                }
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </main>

    <footer class="page-footer blue darken-4">
        <div class="container">
            <!-- grid layout -->
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Footer Content</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                        content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <!-- footer links -->
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright blue darken-3 white-text ">
            <div class="container">
                <!-- bottom -->
                © 2014 Copyright Text
            </div>
        </div>
    </footer>

</body>

<!-- import index.js -->
<script src="js/index.js"></script>

</html>