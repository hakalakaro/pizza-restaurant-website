<?php
// We need to use sessions, so you should always start sessions using the below code
session_start();
// If the user is not logged in redirect to the main page
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

// Connect to database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info
$stmt->bind_param('i', $_SESSION['id']);

$stmt->execute();

$stmt->bind_result($password, $email);

$stmt->fetch();

$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kim's Corner - Fullstack project</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="profilestyles.css" />
    <script src="script.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
    <!-- Header of the site-->
    <div class="header">

        <h1>
            <a style="text-decoration: none; color: white;" href="#">Kim's Corner</a>
        </h1>

    </div>

    <!-- Nav links-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid ">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: white;" onclick="homeFunction()">
                <i class="fa fa-home" style="font-size:24px;"></i>
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;" onclick="menuFunction()">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;" onclick="dealsFunction()">Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;" onclick="orderNow()">Order Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;" onclick="profileFunction()">
                            <i class='far fa-user-circle' style='font-size:20px'></i> My profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="color: white;">
                            <i class='fas fa-door-open' style='font-size:20px'></i> Logout</a>
                        
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" id="searchinput" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn" type="submit" style="background-color: #EDBB99; color: white;">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Reviews panel on the left-->
    <div class="row">
        <div class="aside col-3 col-s-3" id="left">

            <hr size="4" width="100%" color="white" style="opacity: 1.0;" />
            
            <h2 style="margin-top: 35px;">Reviews</h2>
            
            <p style="margin-top: 35px;">
                <q>Best pizza in town!</q>
            </p>
            <h3>*****</h3>
            
            <p style="margin-top: 35px;">
                <q>Must see when visiting Helsinki.</q>
            </p>
            <h3>*****</h3>
            
            <p style="margin-top: 35px;">
                <q>Friendly customer service.</q>
            </p>
            <h3>*****</h3>
            
            <p style="margin-top: 35px;">
                <q>Kim knows his business.</q>
            </p>
            <h3>*****</h3>
                                    
            <button class="btn" style="margin-top: 35px;border-radius: 6px; border-color: transparent; background-color: #EDBB99; color: white;">More</button>
            
            <hr size="4" width="100%" color="white" style="opacity: 1.0;margin-top: 35px;" />
        </div>

        <!-- Profile page in the middle-->
        <div class="col-6 col-s-9" id="profilepage">

            <h1 style="margin-top: 30px;">Profile Page</h1><br />
            <h4>Account details</h4>

            <p style="margin-top: 35px;">
                Username: <?=$_SESSION['name']?>
            </p>

            <p style="margin-top: 35px; word-wrap: break-word;  overflow-wrap: break-word;word-break: break-word;">
                <!-- prevent overflow of long password when resizing page-->
                Password: <?=$password?>
            </p>

            <p style="margin-top: 35px;">
                Email: <?=$email?>
            </p>

            <h4 style="margin-top: 35px;">Order History</h4>

            <p style="margin-top: 35px; margin-bottom: 320px;">
                No orders found.
            </p>

        </div>

        <!-- Homepage div, hidden-->
        <div class="col-6 col-s-9" id="homepage">

            <h1 class="fadein">Kim's Corner</h1>
            <p class="fadein">Established since 2006 in Helsinki, Finland. Pizza made from the finest ingredients with years of experience. </p>
        </div>

        <!-- Orderpage is hidden until opened-->
        <div class="col-6 col-s-9" id="orderpage">
            <h1 style="margin-top: 30px;">Make your order</h1>
           
            <p style="margin-top: 50px;">Item #2</p>
            
            <p style="margin-top: 30px;">Item #3</p>
            
            <p style="margin-top: 30px;">Item #4</p>
            
            <p style="margin-top: 30px;">Item #5</p>
            
            <p style="margin-top: 30px;">Item #6</p>

            <p style="margin-top: 30px;">Item #7</p>

            <p style="margin-top: 30px; margin-bottom: 275px;">Item #8</p>

        </div>

        <!-- Middle div is hidden until it's opened with a click from navbar-->
        <div class="col-6 col-s-9" id="middle">
            
            <h1>Kim's Corner</h1>
            <p>Established since 2006 in Helsinki, Finland. Pizza made from the finest ingredients with years of experience. </p>

        </div>
                
        <!-- Menu div is hidden until it's opened with a click from navbar-->
        <div class="col-6 col-s-9" id="menu">

            <h1 style="margin-top: 30px;">Our Menu</h1>
            
            <h2 style="margin-top: 35px;">Pizzas</h2>
            
            <p>Margharita 10 €</p>
            
            <p>Americana 11.5€</p>
           
            <p>Tropicana 11€</p>
            
            <p>Mexicana 12€</p>
            
            <p>Opera Special 14€</p>
            
            <h2 style="margin-top: 35px;">Drinks</h2>
            
            <p>Coca Cola 0.5L 3€</p>
            
            <p>Heineken 0.5L 4.5€</p>
            
            <p style="padding-bottom: 40px;">Red Wine 12CL 6.5€</p>

        </div>

        <!-- Deals div is hidden until it's opened with a click from navbar-->
        <div class="col-6 col-s-9" id="deals">

            <h1 style="margin-top: 30px;">Current deals</h1>
            
            <p>Buy two pizzas, get third for free.</p>
            
            <p>Margharita pizza 9€</p>
            
            <p>Americana pizza 10€</p>
            
            <p>0,5L softdrink included in every order</p>
            
            <p>-15% takeaway</p>

            <p>-15% takeaway</p>

            <p>-15% takeaway</p>

            <p style="padding-bottom: 140px;">-15% takeaway</p>

        </div>

        <!-- Right side of the site-->
            <div class="aside col-3 col-s-12" id="right">
                <hr size="4" width="100%" color="white" style="opacity: 1.0;" />
                
                <h2 style="margin-top: 35px;">What?</h2>
                <p>Kim's Corner is a pizza restaurant that uses only the finest ingredients to provide You with a spectacular dining experience.</p>
                
                <h2 style="margin-top: 35px;">Where?</h2>
                <p>We are located in Punavuori, Helsinki.</p>
                
                <h2 style="margin-top: 35px;">How?</h2>
                <p>With Kim's, everything is possible.</p>
                <p> Try it yourself!</p>
                
                
                <h2 style="margin-top: 35px;">When?</h2>
                <p>We are open Monday-Saturday 12.00 - 22.00</p>
                

                <hr size="4" width="100%" color="white" style="opacity: 1.0; margin-top: 35px;" />
                
                <h2 style="margin-top: 35px;">Contact us</h2>
                
                <p>Contact us using our contact form below.</p>

                <!-- Contact form on the right side of the site-->
                <div class="dropdown" id="dropdown2">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" style="background-color: #EDBB99; color: white; border-color: transparent;">
                        <i class='fas fa-envelope'></i>
                    </button>
                    <form class="dropdown-menu p-4" id="messageform" style="background-color: #F6DDCC;">
                        <div class="mb-3">
                            <label for="exampleDropdownFormfname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="exampleDropdownFormfname" placeholder="First name.." required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormlname" class="form-label">Last Name</label>
                            <input type="text" class="form-control required" id="exampleDropdownFormlname" placeholder="Last name.." required />
                        </div>
                        <div class="mb-3">

                            <label for="exampleDropdownFormemail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleDropdownFormemail" placeholder="Email.." required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormphone" class="form-label">Phone number</label>
                            <input type="tel" class="form-control" id="exampleDropdownFormnumber" placeholder="Phone number.." required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormdate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="exampleDropdownFormdate" required />
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormmessage" class="form-label">*Message</label>
                            <textarea id="viesti" name="viesti" class="form-check form-control" required></textarea>
                        </div>

                        <input type="submit" class="btn btn-primary" />
                    </form>
                </div>
            </div>
        </div>
    
    <!-- Footer of the site-->
    <div class="footer">
        <p>© Kim's Corner est. 2006</p>
    </div>

</body>
</html>