// Store div ids into variables, to easily toggle their visibility
var x = document.getElementById("middle");
var y = document.getElementById("menu");
var i = document.getElementById("deals");
var u = document.getElementById("homepage");
var o = document.getElementById("profilepage");
var j = document.getElementById("orderpage");

// Toggle style display of profile page to visible
function profileFunction() {
    
    x.style.display = "none";
    y.style.display = "none";
    i.style.display = "none";
    u.style.display = "none";
    o.style.display = "block";
    j.style.display = "none";
}

// Toggle style display of order page to visible if the user is logged in.
function orderNow() {
    $.ajax({
        type: "POST",
        url: 'sessioncheck.php',
        success: function (response) {
            if (response == 1) {
                
                document.getElementById("orderpage").style.display = "block";
                document.getElementById("middle").style.display = "none";
                document.getElementById("menu").style.display = "none";
                document.getElementById("deals").style.display = "none";
                document.getElementById("homepage").style.display = "none";
                document.getElementById("profilepage").style.display = "none";
            } else {
                alert("Please login to make an order.");
            }
        }
    });
}

// Toggle style display of deals page to visible
function dealsFunction() {
    
    x.style.display = "none";
    y.style.display = "none";
    i.style.display = "block";
    u.style.display = "none";
    o.style.display = "none";
    j.style.display = "none";
}

// Toggle style display of home page to visible
function homeFunction() {
    
    x.style.display = "block";
    y.style.display = "none";
    i.style.display = "none";
    u.style.display = "none";
    o.style.display = "none";
    j.style.display = "none";
}

// Toggle style display of menu page to visible
function menuFunction() {
    
    x.style.display = "none";
    y.style.display = "block";
    i.style.display = "none";
    u.style.display = "none";
    o.style.display = "none";
    j.style.display = "none";
}

// Apply fadeout to login message
$('.fadeout').fadeOut(10000);
// Apply fadein to middle div text on login.
$('.fadein').fadeIn(8000);

$(document).ready(function () {

    // change contact form text box size
    $("#message").animate({ width: "350px", height: "150px" }, "slow");

    

    // contact form submit event
    document.getElementById("messageform").addEventListener("submit", function (event) {

        event.preventDefault();

        if (this.checkValidity()) {

            alert("Form Submitted Successfully");
        }
    });

    // register form submit event
    $('#registerform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'createacc.php',
            type: 'post',
            data: $('#registerform').serialize(),
            success: function (response) {
                if (response == "success") {
                    alert("Account created successfully! You may now login.");
                } else {
                    alert("An error occurred, please try again later.");
                }
            }
        });
    });

});