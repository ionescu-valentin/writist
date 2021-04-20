<?php
session_start();

require "includes/dbh.inc.php";
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

    <title>Writist</title>
</head>

<!-- body of the document here -->

<body id="browsing-area" class="blue lighten-4">

    <!-- tabs on mobile -->
    <div id="browsing-tabs" class="blue darken-2">
        <ul class="tabs tabs-transparent center">
            <li class="tab"><a href="#stories">Stories</a></li>
            <li class="tab"><a href="#rhymes">catchy rhymes</a></li>
            <li class="tab"><a href="#opinions">Unpopular opinions</a></li>
        </ul>
    </div>

    <!--#########sidenav content -->
    <ul id='sidebar-menu' class='sidenav sidenav-fixed'>
        <!-- logo -->
        <li><a href="index.php" class="brand-logo">

                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="27" viewBox="0 0 658.475 137.254">
                    <path id="Path_1" data-name="Path 1" d="M165.938,67.965,130.342,194H113.027L87.1,101.891a57.66,57.66,0,0,1-2.021-12.832h-.352a65.105,65.105,0,0,1-2.285,12.656L56.338,194H39.2L2.285,67.965h16.26l26.807,96.68A63.452,63.452,0,0,1,47.461,177.3H47.9a74.71,74.71,0,0,1,2.725-12.656l27.861-96.68h14.15l26.719,97.383a71.238,71.238,0,0,1,2.109,11.777h.352A70.6,70.6,0,0,1,124.189,165l25.752-97.031ZM275.01,194H257.432l-21.094-35.332a76.952,76.952,0,0,0-5.625-8.394,32.066,32.066,0,0,0-5.581-5.669,19.331,19.331,0,0,0-6.152-3.208,25.3,25.3,0,0,0-7.427-1.011H199.424V194H184.658V67.965h37.617a53.609,53.609,0,0,1,15.249,2.065,34.119,34.119,0,0,1,12.129,6.284,29.2,29.2,0,0,1,8.042,10.5,34.828,34.828,0,0,1,2.9,14.722,35.45,35.45,0,0,1-1.978,12.085,31.562,31.562,0,0,1-5.625,9.8,34.1,34.1,0,0,1-8.789,7.339,44.87,44.87,0,0,1-11.558,4.7v.352a26.583,26.583,0,0,1,5.493,3.208,30.23,30.23,0,0,1,4.438,4.263,56.462,56.462,0,0,1,4.175,5.581q2.065,3.12,4.614,7.251ZM199.424,81.324v45.7h20.039a30.392,30.392,0,0,0,10.239-1.67,23.7,23.7,0,0,0,8.13-4.79,21.722,21.722,0,0,0,5.361-7.646,25.6,25.6,0,0,0,1.934-10.151q0-10.107-6.548-15.776t-18.94-5.669ZM307.09,194H292.324V67.965H307.09ZM414.756,81.324H378.369V194H363.6V81.324H327.3V67.965h87.451ZM449.3,194H434.531V67.965H449.3Zm27.246-5.1V171.5a33.8,33.8,0,0,0,7.163,4.746,58.035,58.035,0,0,0,8.789,3.56,69.967,69.967,0,0,0,9.272,2.241,51.7,51.7,0,0,0,8.613.791q13.623,0,20.347-5.054t6.724-14.546a17.08,17.08,0,0,0-2.241-8.877,25.247,25.247,0,0,0-6.2-6.9,61.484,61.484,0,0,0-9.36-5.977q-5.405-2.856-11.646-6.021-6.592-3.34-12.3-6.768a53.319,53.319,0,0,1-9.932-7.559,31.529,31.529,0,0,1-6.636-9.36,28.973,28.973,0,0,1-2.417-12.261A28.831,28.831,0,0,1,480.5,84.532a32.415,32.415,0,0,1,9.932-10.5,45.026,45.026,0,0,1,14.019-6.152,64.189,64.189,0,0,1,16.04-2.021q18.633,0,27.158,4.482V86.949q-11.162-7.734-28.652-7.734a47.123,47.123,0,0,0-9.668,1.011,27.31,27.31,0,0,0-8.613,3.3,19.081,19.081,0,0,0-6.152,5.889,15.63,15.63,0,0,0-2.373,8.789,18.1,18.1,0,0,0,1.8,8.35,20.465,20.465,0,0,0,5.317,6.416,52.962,52.962,0,0,0,8.569,5.625q5.054,2.725,11.646,5.977,6.768,3.34,12.832,7.031a58.652,58.652,0,0,1,10.635,8.174,36.323,36.323,0,0,1,7.251,9.932,27.918,27.918,0,0,1,2.681,12.48q0,9.316-3.647,15.776a29.935,29.935,0,0,1-9.844,10.5,42.992,42.992,0,0,1-14.282,5.845,78.218,78.218,0,0,1-17.051,1.8,69.482,69.482,0,0,1-7.383-.483q-4.395-.483-8.965-1.406a73.151,73.151,0,0,1-8.657-2.285A26.939,26.939,0,0,1,476.543,188.9ZM652.588,81.324H616.2V194H601.436V81.324h-36.3V67.965h87.451Z" transform="translate(2.387 -62.355)" fill="none" stroke="#227abe" stroke-width="7" style="mix-blend-mode: multiply;isolation: isolate" />
                </svg>


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

    <!-- ########## main page content here-->
    <div id="page-content">
        <div class="container">
            <!-- grid layout -->
            <div class="row">
                <!-- card 1  -->
                <div class="col s12">
                    <div class="card black">
                        <div class="card-content white-text">
                            <span class="card-title">What do we offer</span>
                            <p>
                                de facut pagina pt profil<br> de pus id diferite la inputurile din formuri <br>
                                make the randomizer work <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- browse stories -->
            <div id="stories">
                <h4 class="category-description">Top 10 in Stories</h4>
                <ul class="collapsible popout">

                    <?php
                    $sql = "SELECT * FROM writings;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['category'] === "story") {
                                echo
                                    '<li>
                                        <div class="collapsible-header">' . $row['title'] . '<span class="collapsible-author">' . $row['writer_username'] . '</span>
                                    </div>
                                    <div class="collapsible-body"><span>' . $row['writing_demo'] . '</span>
                                    <form method="GET" action="article.php">
                                    <input type="number" class="hide" name="article_id" value="' . $row['writing_index'] . '">                                    
                            <button type="submit" name="goto_article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read more</button>
                                </form>
                                <div class="reactions-box">
                                    <a><i class="material-icons">thumb_up</i>' . $row['likes_number'] . '</a>
                                    <a><i class="material-icons">textsms</i>' . $row['comments_number'] . '</a>
                                </div>
                        </div>
                        </li>';
                            }
                        }
                    } else {
                        echo '<h4 class = "red-text">Database error: No table found!</h4>';
                    }
                    ?>

                    <li>
                        <div class="collapsible-header">Title 2 <span class="collapsible-author">by_Tudorică_tânărul </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                    <li>
                        <div class="collapsible-header">Title 3 <span class="collapsible-author">by_Tudor_vârstă_medie </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Title 4 <span class="collapsible-author">by_Tudor_vârstă_medie </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>
                    </li>

                </ul>
            </div>

            <!-- browse rhymes -->
            <div id="rhymes">
                <h4 class="category-description">Top 10 in Rhymes</h4>
                <ul class="collapsible popout">
                    <?php
                    $sql = "SELECT * FROM writings;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['category'] === "poetry") {
                                echo
                                    '<li>
                                        <div class="collapsible-header">' . $row['title'] . '<span class="collapsible-author">' . $row['writer_username'] . '</span>
                                    </div>
                                    <div class="collapsible-body"><span>' . $row['writing_demo'] . '</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read more</a>
                                <div class="reactions-box">
                                    <a><i class="material-icons">thumb_up</i>' . $row['likes_number'] . '</a>
                                    <a><i class="material-icons">textsms</i>' . $row['comments_number'] . '</a>
                                </div>
                        </div>
                        </li>';
                            }
                        }
                    } else {
                        echo '<h4 class = "red-text">Database error: No table found!</h4>';
                    }
                    ?>
                    <li>
                        <div class="collapsible-header">Title 2 <span class="collapsible-author">by_Tudorică_tânărul </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                    <li>
                        <div class="collapsible-header">Title 3 <span class="collapsible-author">by_Tudor_vârstă_medie </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                </ul>
            </div>

            <!-- browse opinions -->
            <div id="opinions">
                <h4 class="category-description">Top 10 in Unpopular opinions</h4>
                <ul class="collapsible popout">
                    <li>
                        <div class="collapsible-header">Title 1 <span class="collapsible-author">by_Tudorică_batranul </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                    <li>
                        <div class="collapsible-header">Title 2 <span class="collapsible-author">by_Tudorică_tânărul </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                    <li>
                        <div class="collapsible-header">Title 3 <span class="collapsible-author">by_Tudor_vârstă_medie </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                </ul>
            </div>
            <a class="btn blue darken-2 white-text see-all-btn">See all <i class="material-icons right">chevron_right</i></a>
            <!-- challenge section -->
            <div id="challenge">
                <div class="card amber darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">The weekly challenge: Advice to your younger self</span>
                        <p>Accept this week's challenge and do your best trying to Lorem ipsum, dolor sit amet
                            consectetur
                            adipisicing elit. Dolorem reiciendis incidunt officia deserunt! Tempora, modi?
                        </p>
                    </div>
                </div>
                <h4>Latest writings in this week's challenge:</h4>
                <ul class="collapsible popout">
                    <li>
                        <div class="collapsible-header">Title 1 <span class="collapsible-author">by_Tudorică_batranul </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                    <li>
                        <div class="collapsible-header">Title 2 <span class="collapsible-author">by_Tudorică_tânărul </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                    <li>
                        <div class="collapsible-header">Title 3 <span class="collapsible-author">by_Tudor_vârstă_medie </span>
                        </div>
                        <div class="collapsible-body"><span>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Esse
                                fuga
                                natus blanditiis quaerat facere cumque ex ullam! Corrupti, temporibus dolorum!</span>
                            <a href="#article" class="btn btn-flat btn-small blue-text text-darken-4"><i class="material-icons right">navigate_next</i>
                                read
                                more</a>
                        </div>

                    </li>
                </ul>
                <a class="btn amber darken-4 white-text see-all-btn">See all <i class="material-icons right">chevron_right</i></a>
            </div>

            <!-- generate random section -->
            <div id="randomSection">
                <div class="card pink darken-3">
                    <div class="card-content white-text">
                        <span class="card-title">Read some random generated article</span>
                        <p>Don't know what to read? You may be surprised of how many Lorem ipsum, dolor sit amet
                            consectetur
                            adipisicing elit. Dolorem reiciendis incidunt officia deserunt! Tempora, modi?
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6">
                        <div class="collection ">
                            <a class="collection-item active">Random category</a>
                            <a class="collection-item">Story time</a>
                            <a class="collection-item">Catchy rhyme</a>
                            <a class="collection-item">Unpopular opinion</a>
                        </div>
                        <div class="row">
                            <p class="col s12 m12 l6">
                                <label for="impressions">
                                    <input id="impressions" type="checkbox" />
                                    <span>50+ Impressions</span>
                                </label>
                            </p>
                            <p class="col s12 m12 l6">
                                <label for="latest">
                                    <input id="latest" type="checkbox" />
                                    <span>7 days old or younger</span>
                                </label>
                            </p>
                        </div>
                        <a class="btn pink darken-4 hide-on-small-only">Generate!</a>
                    </div>
                    <div class="col s12 hide-on-med-and-up">
                        <a class="btn pink darken-4 full-button">Generate!</a>
                    </div>
                    <div class="col s12 m6">
                        <div id="random-generated" class="card pink darken-2">
                            <div class="card-content white-text">
                                <span class="card-title">Read some random generated article </span>
                                <p> Don't know what to read? You may be surprised of how many Lorem ipsum, dolor
                                    sitametconsectetur
                                </p>
                                <br>
                                <p> <span>by</span> tudorel</p>
                                <div class="reactions-box">
                                    <a><i class="material-icons">thumb_up</i> 1</a>
                                    <a><i class="material-icons">textsms</i> 14</a>
                                </div>
                            </div>
                            <div class="card-action">
                                <a> let's Read it!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of container content -->
        </div>
    </div>

    <footer class="page-footer pink darken-2">
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
        <div class="footer-copyright pink darken-2 white-text ">
            <div class="container">
                <!-- bottom -->
                © 2014 Copyright Text
            </div>
        </div>
    </footer>

</body>

<!-- import index.js -->
<script src="js/index.js"></script>
<!-- import specific JS code -->
<script src="js/browse.js"></script>

</html>