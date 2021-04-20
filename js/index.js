// importing JQuery
var jqueryScript = document.createElement('script');
jqueryScript.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
jqueryScript.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(jqueryScript);

// importing materialize
var materializeScript = document.createElement('script');
materializeScript.src = 'js/materialize.min.js';
materializeScript.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(materializeScript);

// #############################
// PUBLIC VARS AND CONSTS HERE 
// #############################


const getSidenav = document.getElementById("sidebar-menu");
const getBottomNav = document.getElementById("bottom-nav-wrapper");
const getLoginForm = document.getElementById("login-modal");
const getIcon = document.getElementsByName("bottom-icon");


// ##################
// FUNCTIONS HERE 
// ###################

// initializing materialize items with jquery
$(document).ready(function () {
    $('.tabs').tabs();

    $(".slider").slider();

    $('.dropdown-trigger').dropdown();

    $('.collapsible').collapsible();

    $('.modal').modal();

    $('.sidenav').sidenav();

    $('.tooltipped').tooltip();

    $('input#prev-title').characterCounter();
});

// form validation with jquery & ajax
$(document).ready(function () {

    // sending signup info to the php file
    $("#signup-form").submit(function (event) {
        event.preventDefault();
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var password2 = $("#password2").val();
        var submit = $("#send_signup_attempt").val();
        $("#signup-data").load("includes/signup.inc.php", {
            firstName: firstName,
            lastName: lastName,
            email: email,
            username: username,
            password: password,
            password2: password2,
            submit: submit
        });
    });

    // sending login info to the php file
    $("#login-form").submit(function (event) {
        event.preventDefault();
        var logUsername = $("#log-username").val();
        var logPassword = $("#log-password").val();
        var submit = $("#send-login-attempt").val();

        $.ajax(
            {
                type: "POST",
                url: "includes/login.inc.php",
                data: {
                    username: logUsername,
                    password: logPassword,
                    submit: submit
                },
                success: function (data) {
                    $("#login-data").html(data);
                }
            });
    });

    // sending provisory article title info to the php file
    $("#prev-title").on("input", function () {
        var username = $("#hidden-username").val();
        var category = $("input[name='category_option']:checked").val();
        var title = $("#prev-title").val();
        $.ajax(
            {
                type: "POST",
                url: "includes/artUpload.inc.php",
                data: {
                    username: username,
                    prevTitle: title,
                    category: category
                },
                success: function (data) {
                    $("#write-preps-info").html(data);
                }
            });
    });

    // sending final article title info to the php file
    $("#writing-title").on("input", function () {
        var username = $("#hidden-username").val();
        var category = $("#category").val();
        var title = $("#writing-title").val();
        $.ajax(
            {
                type: "POST",
                url: "includes/artUpload.inc.php",
                data: {
                    username: username,
                    title: title,
                    category: category
                },
                success: function (data) {
                    $("#write-data").html(data);
                }
            });
    });

    // make the post comment btn appear when not empty
    $("#comment-textarea").on("input", function () {
        if (!$("#comment-textarea").val()) {
            $("#submit-comment").addClass('disabled');
        } else {
            $("#submit-comment").removeClass('disabled');
        }

    });

    // sending comment to the database
    $("#comment-form").submit(function (event) {
        event.preventDefault();
        var author = $("#comment-author").val();
        var content = $("#comment-textarea").val();
        var artID = $("#article-index").val();
        $("#comments-section").load("includes/commentUpload.inc.php",
            {
                author: author,
                content: content,
                artID: artID
            });
    });
});

// rearrangint items according to the screen size
const reArrange = () => {

    // width 992px or lower
    if (window.matchMedia("(max-width: 992px)").matches) {

    }

    // width between 600px and 992px
    if (window.matchMedia("(max-width: 992px) and (min-width: 600px)").matches) {
        for (let i = 0; i < getIcon.length; i++) {
            getIcon[i].classList.add("medium");
            getIcon[i].classList.remove("small");
        }

    }

    // width 600px or lower
    if (window.matchMedia("(max-width: 600px)").matches) {
        // resizing bottom menu icons by screen width
        for (let i = 0; i < getIcon.length; i++) {
            getIcon[i].classList.remove("medium");
            getIcon[i].classList.add("small");
        }
    }

}

// ##################
// EVENTS HERE 
// ###################



