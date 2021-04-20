<?php
session_start();

require 'includes/dbh.inc.php';

// get the data from the provisory pages
if (isset($_POST['submit_category'])) {
    if (isset($_POST['category_option'])) {
        $category = $_POST['category_option'];
        $prevTitle = $_POST['prev_title'];
        $username = $_SESSION['username'];
    } else {
        echo 'An error has occured while trying to get the category!';
    }
} else {
    echo 'An error has occured while trying to prepare the article!';
}

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
    <script src="js/editorJs/editor.js"></script>
    <script src="js/editorJs/heading-editor.js"></script>
    <script src="js/editorJs/list-editor.js"></script>
    <title>Write</title>
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
        echo '<li>
      <br>
      <form method="POST" action="includes/logout.inc.php" class="center">
        <button type="submit" name="log_out" class="btn pink darken-2 white-text">Log out</button>
      </form>
    </li>';
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
            <li><a href="#" class="flow-text"><i name="bottom-icon" class="material-icons medium">account_box</i><span class="menu-item-name hide">Account</span></a>
            </li>
        </ul>
    </div>

    <!-- navigation bar -->
    <nav class="blue darken-2 hide-on-med-and-down">
        <div class="navbar-wrapper ">
            <h5 class="brand-logo center">Writist mode ON</h5>

            <!-- Post options -->
            <ul id="post-options" class="right">
                <!-- the label for the submit input -->
                <li><label for="post-button" class="btn btn-flat btn-large white-text">Post now!
                        <i class="material-icons right">check</i></label>
                </li>
            </ul>
        </div>
    </nav>


    <!-- ############ main content -->
    <main id="write-content" class="container">
        <div id="write-space" class="">
            <form id="post-article" action="article.php" method="POST">
                <input type="text" class="hide" id="hidden-username" value="<?= $_SESSION['username'] ?>">
                <div class="row">
                    <?= '
                        <input class="hide" name="category" type="text" id="category" value="' . $category . '">
                        <p class="white-text">' . $category . '</p>
                        <div class="input-field col s6">
                            <input id="writing-title" name="writing_title" type="text" autocomplete="off" value="' . $prevTitle . '">
                            <label for="writing-title">Title</label>
                        </div>
                    '  ?>

                </div>
                <!-- the hidden editor content in HTML format -->
                <input type="text" id="writing" name="HTML_writing" class="hide">

                <!-- the demo input -->
                <div class="input-field">
                    <input type="text" id="writing-demo" name="writing_demo" autocomplete="off" required>
                    <label for="writing-demo">Demo</label>
                </div>
                <p id="write-data"></p>

                <!-- hide the submit input and give the power to the label in navbar -->
                <input type="submit" id="post-button" class="hide" name="submit_writing">
            </form>

            <!-- editor JS box -->
            <div id="editor-holder" class="white">
                <div id="editorjs" class="white"></div>
            </div>

            <!-- save the editor content and turn it into HTML -->
            <a class="btn blue darken-2 white-text" id="save-writing">Save Text</a>
        </div>

    </main>

</body>

<!-- import JS magic -->
<script src="js/index.js"></script>
<script src="js/write.js"></script>

</html>