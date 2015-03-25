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

    <title>Set Up for ProConnect</title>
    <!-- JQuery link -->
  <script type="text/javascript" src="../lib/jquery/jquery-2.1.3.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <!-- Bootstrap core CSS -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Latest compiled and minified JavaScript -->
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>


     <!--Custom styles for this template -->
    <link href="css/setup.css" rel="stylesheet">
    
    <!-- JavaScript link -->
	    <script type="text/javascript" src="js/setUp.js"></script>
    <script type="text/javascript" src="js/SetUpForm.js"></script>
    <script type="text/javascript" src="js/SetUpMain.js"></script>
  
</head>

<body>

    <div class="container-fluid">
        
        <div class="row">
            <div class ="formContainer col col-xs-12 col-sm-10 col-md-4 col-lg-4 col-sm-offset-1 col-md-offset-4 col-lg-offset-4">
                <header class="text-center"><a href= "../"><img id= "logo" src = "../image/proconnect/logo_text.png"></a></header>
                
                <form id="SetUpForm" action="php/user_setup.php" class="text-left" novalidate>
					<div class="form-group">				
						<label for="country">Country</label> <br />
						<select id="country" class="form-control" type="text" name="country" placeholder="Country" required>
						  <option>United States</option>
						  <option>2</option>
						  <option>3</option>
						  <option>4</option>
						  <option>5</option>
						</select>
					</div>
                    <div class="form-group" id="zipcode-group" >
                        <label for="zipcode">Zip Code</label> <br />
                        <input class="form-control" id="zipcode" type="text" name="zipcode" placeholder="Zip Code" required>
                    </div>

                    <div class="form-group" id="postalcode-group" style = "display: none;">
                        <label for="postal-code">Postal Code</label> <br />
                        <input class="form-control" id="postal-code" type="text" name="postal-code" placeholder="Postal Code" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label> <br />
                        <input class="form-control" id="address" type="text" name="address" placeholder="Address" required>
                    </div>
					
					<div class="form-group">
                        <label for="phonenumber">Phone Number</label> <br />
                        <input class="form-control" id="phonenumber" type="text" name="phonenumber" placeholder="###-###-####" required>
                    </div>
					

                    <!-- Invalid input alert -->
                    <div class="form-group">
                        <div class="alert alert-danger text-center" role="alert" style="display: none; margin-top: 10px;"><b>Invalid Input :</b> Please correct the marked field(s)</div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-warning btn-lg btn-block" id = "setup-btn"type="submit"><b>Submit</b></button>
                        <br />
                        <a href="../profile-user-POV" style="float:right">Skip this step >></a>
                    </div>

                </form>
             <div>
        </div>
    </div> <!-- /container -->

</body>
</html>
