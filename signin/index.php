<?php
    error_reporting(E_ALL); // debug
    ini_set("display_errors", 1); // debug
    include 'php/session_check.php';

    $welcome = '';
    if (isset($_COOKIE['__USER_FULL_NAME__'])) { 
        $welcome = 'Welcome back, '.$_COOKIE['__USER_FULL_NAME__']
        .' <a href="../signout/php/cookie_signout.php">(Not '.$_COOKIE['__USER_FULL_NAME__'].'?)</a>'; 
    };

    echo $_SERVER['SERVER_NAME'];
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

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    
    <!-- JQuery link -->
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- JavaScript link -->
    <script type="text/javascript" src="js/SignInForm.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
  
</head>

<body>

    <div class="container">
        
        <div class = "formContainer">   
            <form class="form-signin form" id="SignInForm" action="php/session_signin.php" novalidate>
          
                <a href= "../"><img id= "logo" src = "../image/proconnect/logo_text.png"></a>
                
                <!-- Invalid input alert -->
                <div class="alert alert-danger" role="alert" style="display: none"><b>Invalid Input</b></div>
                
                <label class="text-info"><?=$welcome?></label>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" name="Username" id="email-login" class="form-control" placeholder="Email address" autofocus>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="Password" id="email-password" class="form-control" placeholder="Password" >
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <p id= "signUp">Not a member?  <a href= "../signup/">Join now</a></p>
                </div>

            </form>
     
         <div>
    </div> <!-- /container -->

</body>
</html>
