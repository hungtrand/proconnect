<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug

$Email = '';
$ForgotPasswordKey = '';

if (isset($_GET['Email'])) $Email = $_GET['Email'];
session_start();
$ForgotPasswordKey = $_SESSION['__ForgotPasswordKey__'];
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

    <title>Reset Password</title>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resetPassword.css" rel="stylesheet">
    
    <!-- JQuery link -->
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- JavaScript link -->
    <script type="text/javascript" src="js/ResetPasswordForm.js"></script>
    <script type="text/javascript" src="js/ResetPasswordMain.js"></script>
  
</head>

<body>

    <div class="container">
        
        <div class = "formContainer">   
            <form class="form-reset form" id="ResetPasswordForm" action="php/UpdatePassword.php" novalidate>
                <input type="hidden" name="Email" value="<?=$Email?>" />
                <input type="hidden" name="ForgotPasswordKey" value="<?=$ForgotPasswordKey?>" />
          
                <a href= "../"><img id= "logo" src = "../image/proconnect/logo_text.png"></a>
                
                <!-- Invalid input alert -->
                <div class="alert alert-danger" role="alert" style="display: none"><b>Invalid Input</b></div>
                
                    <!--<label class="text-info"></label> -->
				<div class="label"><p><b>Please enter new password</p></b></div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">New Password</label>
                    <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="New Password" >
                </div>
				<div class="form-group">
                    <label for="confirmPassword" class="sr-only">Confirm Password</label>
                    <input type="password" name="PasswordConfirm" id="passwordConfirm" class="form-control" placeholder="Confirm Password" >
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
                </div>

            </form>
     
         </div>
    </div> <!-- /container -->

</body>
</html>
