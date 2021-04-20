<?php
session_start();

require "includes/dbh.inc.php";
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
  <title>Writist</title>
</head>

<!-- the body of the document -->

<body class="">
  <!--#########sidenav content -->
  <ul id='sidebar-menu' class='sidenav sidenav-fixed'>
    <!-- Sidebar LOGO -->
    <li><a href="index.php" class="brand-logo">WRITIST</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <!-- Profile panel -->
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
    <!-- Navigation panel -->
    <li class="sidenav-subcategory hide-on-med-and-down">
      <a>Where to?</a>
    </li>
    <li class="hide-on-med-and-down"><a href="writePreps.php"><i class="material-icons">mode_editor</i>Write</a></li>
    <li class="hide-on-med-and-down"><a href="browse.php"><i class="material-icons">filter_list</i>Read</a></li>


    <!-- nav options on mobile -->
    <li class="sidenav-subcategory hide-on-large-only"><a>More reading options</a></li>
    <ul class="side-read-color hide-on-large-only">
      <li><a href="#!"><i class="material-icons">insert_chart</i>browse by category</a>
      </li>
      <li><a href="#!"><i class="material-icons">local_activity</i>weekly challenge</a>
      </li>
      <li><a href="#!"><i class="material-icons">gesture</i>generate random</a></li>
    </ul>
    <li>
      <div class="divider "></div>
    </li>
    <li class="sidenav-subcategory hide-on-large-only"><a>More writing options</a></li>
    <ul class="hide-on-large-only">
      <li><a href="#!"><i class="material-icons">lightbulb_outline</i>Writing ideas</a>
      </li>
      <li><a href="#!"><i class="material-icons">extension</i>Poetry tips and tricks</a>
      </li>
    </ul>

    <!-- More options on desktop -->
    <li class="no-padding hide-on-med-and-down">
      <ul class="collapsible collapsible-accordion">
        <!-- more writing options -->
        <li>
          <a class="collapsible-header">More writing options<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!"><i class="material-icons">lightbulb_outline</i>Writing ideas</a></li>
              <li><a href="#!"><i class="material-icons">extension</i>Poetry tips and tricks</a></li>
            </ul>
          </div>
        </li>
        <li>
          <div class="divider"></div>
        </li>
        <!-- More reading options -->
        <li>
          <a class="collapsible-header">More reading options<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul class="side-read-color">
              <li><a href="#!"><i class="material-icons">insert_chart</i>browse by category</a></li>
              <li><a href="#!"><i class="material-icons">local_activity</i>weekly challenge</a></li>
              <li><a href="#!"><i class="material-icons">gesture</i>generate random</a></li>
            </ul>
          </div>
        </li>
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
    <ul id="bottom-on-med" class="bottom-menu">
      <li class="sidenav-trigger" data-target="sidebar-menu"><a href="#"><i name="bottom-icon" class="material-icons medium">sort</i><span class="menu-item-name medium hide">Menu</span></a>
      </li>
      <li><a href="browse.php"><i name="bottom-icon" class=" material-icons medium">import_contacts</i><span class="menu-item-name hide">Read</span> </a>
      </li>
      <li><a href="writePreps.php"><i name="bottom-icon" class=" material-icons medium">mode_edit</i><span class="menu-item-name hide">Create</span> </a>
      </li>

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

  <!-- ############ main content -->
  <main id="home-content">
    <!-- SLIDER -->
    <div id="slider" class="slider">
      <ul class="slides">
        <li>
          <img src="img/woman1.jpg" />
          <!-- random image -->
          <div class="caption blue left-align">
            <h3>This is our big Tagline!</h3>
            <h5 class="light text-lighten-3">Here's our small slogan.</h5>
          </div>
        </li>
        <li>
          <img src="img/man1.jpg" />
          <!-- random image -->
          <div class="caption right-align">
            <h3>Center Aligned Caption</h3>
            <h5 class="light text-lighten-3">
              Here's our small slogan.
            </h5>
          </div>
        </li>
        <li>
          <img src="img/man2.jpg" />
          <!-- random image -->
          <div class="caption blue right-align">
            <h3>Right Aligned Caption</h3>
            <h5 class="light text-lighten-3">Here's our small slogan.</h5>
          </div>
        </li>
        <li>
          <img src="img/woman2.jpg" />
          <!-- random image -->
          <div class="caption left-align">
            <h3>Left Aligned Caption</h3>
            <h5 class="light text-lighten-3">
              Here's our small slogan.
            </h5>
          </div>
        </li>
      </ul>
    </div>

    <div class="container">
      <!-- grid layout -->
      <div class="row">
        <!-- card 1  -->
        <div class="col s12 m6 ">
          <div class="card blue darken-1">
            <div class="card-content white-text">
              <span class="card-title">What do we offer</span>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta
                ratione, aliquid minima autem tempora, dolor impedit quidem
                tempore dolorem magnam deserunt, illo.
              </p>
            </div>
            <!-- card 1 buttons -->
            <div class="card-action">
              <a href="#" data-target="login-sidenav" class="blue-text text-lighten-5 sidenav-trigger">Log in</a>
              <a href="#" class="blue-text text-lighten-5 right">Sign up</a>

            </div>
          </div>
        </div>
        <!-- card 2 -->

        <div class="col s12 m6 ">
          <div class="card blue darken-1">
            <div class="card-content white-text">
              <span class="card-title ">Features</span>
            </div>
            <!-- card 2 tabs -->
            <div class="card-tabs ">
              <ul class="tabs tabs-fixed-width blue darken-4 ">
                <li class="tab "><a class="blue-text text-lighten-5" href="#test4">Write</a></li>
                <li class="tab"><a class="blue-text text-lighten-5" href="#test5">Learn</a></li>
                <li class="tab"><a class="blue-text text-lighten-5" href="#test6">Share</a></li>
              </ul>
            </div>
            <!-- card 2 tabs content -->
            <div class="card-content grey lighten-2 blue-text">
              <div id="test4">Write about</div>
              <div id="test5">Learn how to</div>
              <div id="test6">share and readaaaaaaaaaaaaaaaaa</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- ########## FOOTER  here-->
  <footer class="page-footer blue darken-3">
    <div class="container">
      <!-- grid layout -->
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Footer Content</h5>
          <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
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
    <div class="footer-copyright white-text ">
      <div class="container">
        <!-- bottom -->
        © 2014 Copyright Text
      </div>
    </div>
  </footer>



</body>
<!-- initializinig JS components -->
<script src="js/index.js"></script>

</html>