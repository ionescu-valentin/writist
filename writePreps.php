<?php
session_start();

require 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

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
    <!-- import editorJs and its features (header and list) -->
    <title>Write menu</title>
</head>

<!-- the body of the document -->

<body class="blue lighten-3">
    <!--#########sidenav content -->
    <ul id='sidebar-menu' class='sidenav sidenav-fixed'>
        <li><a href="index.php" class="brand-logo">WRITIST</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <!-- profile panel -->
        <li class="hide-on-med-and-down">
            <div class="user-view row ">
                <a href="#user" class="col s6"><i class="material-icons medium">account_circle</i></a>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<div class="row col s6"><a href="#name" class="name col s12"><h5>My profile</h5></a>
            <a href="#email" class="col s12"><span class="email">' . $_SESSION["username"] . '</span></a></div>';
                } else {
                    header("Location: ../index.php");
                    echo "<script>alert('Please log in first!')</script>";
                }
                ?>
            </div>
            <div class="divider"></div>
        </li>
        <!-- navigation panel -->
        <li class="sidenav-subcategory hide-on-med-and-down">
            <a>Where to?</a>
        </li>
        <li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
        <li class="hide-on-med-and-down"><a href="browse.php"><i class="material-icons">filter_list</i>Read</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <ul>
                <!-- More writing options -->
                <li class="sidenav-subcategory"><a href="#!">More writing options</a></li>
                <li><a href="#!"><i class="material-icons">lightbulb_outline</i>Writing ideas</a></li>
                <li><a href="#!"><i class="material-icons">extension</i>Poetry tips and tricks</a></li>
                <div class="divider"></div>
                <!-- More reading options -->
                <li class="no-padding hide-on-med-and-down">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header">More reading options<i class="material-icons">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul class="side-read-color">
                                    <li><a href="#!"><i class="material-icons">insert_chart</i>browse by category</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">local_activity</i>weekly challenge</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">gesture</i>generate random</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- more options on mobile -->
                <li class="sidenav-subcategory hide-on-large-only"><a>More reading options</a></li>
                <ul class="side-read-color hide-on-large-only">
                    <li><a href="#!"><i class="material-icons">insert_chart</i>browse by category</a>
                    </li>
                    <li><a href="#!"><i class="material-icons">local_activity</i>weekly challenge</a>
                    </li>
                    <li><a href="#!"><i class="material-icons">gesture</i>generate random</a></li>
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
        <ul id="bottom-in-write" class="bottom-menu">
            <li class="sidenav-trigger" data-target="sidebar-menu"><a href="#"><i name="bottom-icon" class="material-icons medium">sort</i><span class="menu-item-name medium hide">Menu</span></a>
            </li>
            <li><a href="browse.php"><i name="bottom-icon" class=" material-icons medium">import_contacts</i><span class="menu-item-name hide">Read</span> </a>
            </li>
            <li><a href="write.php"><i name="bottom-icon" class=" material-icons medium">mode_edit</i><span class="menu-item-name">Create</span> </a>
            </li>
            <li><a href="#" class="flow-text"><i name="bottom-icon" class="material-icons medium">account_box</i><span class="menu-item-name hide">Profile</span></a>
            </li>
        </ul>
    </div>

    <!-- navigation bar -->
    <nav class="blue darken-2 hide-on-med-and-down">
        <div class="navbar-wrapper ">
            <h5 class="brand-logo center">Writist mode ON</h5>
        </div>
    </nav>

    <!-- ############ main content -->
    <main id="write-content" class="container">

        <div id="write-preparations">
            <h4>It's a great day for sharing your inspiration!</h4>


            <form method="POST" id="preps-form" action="write.php">
                <input type="text" class="hide" id="hidden-username" value="<?= $_SESSION['username'] ?>">
                <div class="row">
                    <h6 class="col s12">First, choose a category:</h6>
                    <div class="radio-categories col s12 row">
                        <p class="col s12 l4">
                            <label>
                                <input name="category_option" type="radio" value="story" checked />
                                <span>Story</span>
                            </label>
                        </p>
                        <p class="col s12 l4">
                            <label>
                                <input name="category_option" type="radio" value="poetry" />
                                <span>Poetry/Rhymes</span>
                            </label>
                        </p>
                        <p class="col s12 l4">
                            <label>
                                <input name="category_option" type="radio" value="opinion" />
                                <span>Unpopular opinion/Advice</span>
                            </label>
                        </p>
                    </div>

                    <div class="row col s12">
                        <h6 class="col s12">Now give your future creation a suggestive name. <br> Not sure yet? You can
                            change this later..</h6>
                        <div class="input-field col s8 l6">
                            <input id="prev-title" type="text" name="prev_title" data-length="25" required>
                            <label for="prev-title">Title</label>
                        </div>

                        <span id="write-preps-info"></span>
                    </div>
                    <button id="start-writing" name="submit_category" value="Submit" class="btn waves-effect blue darken-2 white-text col s4 l3 offset-s2 offset-l1">
                        Start writing!</button>
                </div>
            </form>

        </div>
    </main>

</body>

<!-- import JS magic -->
<script src="js/index.js"></script>

</html>