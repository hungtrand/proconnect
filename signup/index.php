<?php
    error_reporting(E_ALL); // debug
    ini_set("display_errors", 1); // debug
    include '../signin/php/session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign Up for ProConnect</title>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signup.css" rel="stylesheet">
    
    <!-- JQuery link -->
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- JavaScript link -->
    <script type="text/javascript" src="js/SignUpForm.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
  
</head>

<body>

    <div class="container-fluid">
        <div class="row visible-md visible-lg" style="height: 150px"></div>
        
        <div class="row">
            <div class ="formContainer col col-xs-12 col-sm-10 col-md-4 col-lg-4 col-sm-offset-1 col-md-offset-4 col-lg-offset-4">
                <header class="text-center"><a href= "../"><img id= "logo" src = "../image/proconnect/logo_text.png"></a></header>
                
                <form id="SignUpForm" action="php/user_signup.php" class="text-left" novalidate>
                    <div class="form-group" style="overflow: auto;">
                        <div class="col-xs-6" style="padding: 0 5px 0 0">
                            <label for"first">First Name:</label> <br />
                            <input class="form-control" id="first" type="text" name="first" placeholder="First name" required> 
                        </div>

                        <div class="col-xs-6" style="padding: 0 0 0 5px">
                            <label for"last">Last Name:</label> <br />
                            <input class="form-control" id="last" type="text" name="last" placeholder="Last name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label> <br />
                        <input class="form-control" id="email" type="email" name="email" placeholder="professional@proconnect.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label> <br />
                        <input class="form-control" id="password" type="password" name="password" placeholder="6 or more characters" required>
                    </div>

                    <div class="form-group">
                        <label for="confpassword">Confirm Password</label> <br />
                        <input class="form-control" id="confpassword" type="password" name="confpassword" placeholder="retype your password above" required>
                    </div>

                    <!-- Invalid input alert -->
                    <div class="form-group">
                        <div class="alert alert-danger text-center" role="alert" style="display: none; margin-top: 10px;"><b>Invalid Input :</b> Please correct the marked field(s)</div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-warning btn-lg btn-block" id = "signup-btn"type="submit"><b>Join now</b></button>
                        <br />
                        <a href="../signin/">Already a member? Sign in.</a>
                    </div>

                </form>
             <div>
        </div>
    </div> <!-- /container -->

</body>
</html>
