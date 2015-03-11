<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Forgot Password</title>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/forgotPassword.css" rel="stylesheet">
    
    <!-- JQuery link -->
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- JavaScript link -->
    <script type="text/javascript" src="js/ForgotPasswordForm.js"></script>
    <script type="text/javascript" src="js/ForgotPasswordMain.js"></script>
  
</head>

<body>

    <div class="container">
        
        <div class = "formContainer">   
            <form class="form-forgot form" id="ForgotPasswordForm" novalidate>
          
                <a href= "../"><img id= "logo" src = "../image/proconnect/logo_text.png"></a>
                
                <!-- Invalid input alert -->
                <div class="alert alert-danger" role="alert" style="display: none"><b>Invalid Input</b></div>
                
               <!--<label class="text-info"></label>--> 
				 <div class="label"><p><b>Please enter your email to reset password</p></b></div>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" name="Username" id="email-login" class="form-control" placeholder="Email address" autofocus>
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>
                </div>

            </form>
     
         <div>
    </div> <!-- /container -->

</body>
</html>
