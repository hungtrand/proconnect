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
						 <label class="radio-inline">
						  <input class= "country-option" type="radio" name="inlineRadioOptions-country" id="inlineRadio1-country" value="United States" checked> United States
						</label>
						<label class="radio-inline">
						  <input class= "country-option" type="radio" name="inlineRadioOptions-country" id="inlineRadio2-country" value="Other" > Other
						</label>
					</div>
					
                    <div class="form-group" id="zipcode-group" >
                        <label for="zipcode">Zip Code</label> <br />
                        <input class="form-control" id="zipcode" type="text" name="zipcode" placeholder="Zip Code" required>
                    </div>
					
					<div id = "other-country-group" style = "display: none;">
					<div class="form-group" id="countryname-group" >
                        <input class="form-control" id="country-name" type="text" name="country-name" placeholder="Country" required>
                    </div>
                    <div class="form-group" id="postalcode-group" >
                        <label for="postal-code">Postal Code</label> <br />
                        <input class="form-control" id="postal-code" type="text" name="postal-code" placeholder="Postal Code" required>
                    </div>
					</div>

                    <div class="form-group">
                        <label for="address">Address</label> <br />
                        <input class="form-control" id="address" type="text" name="address" placeholder="Address" required>
                    </div>
					
					<div class="form-group">
                        <label for="phonenumber">Phone Number</label> <br />
                        <input class="form-control" id="phonenumber" type="text" name="phonenumber" placeholder="###-###-####" required>
                    </div>
					  <!--I am Currently-->
					<div class="form-group">
						  <label class="control-label" for="usertype">I am currently</label> <br />
						 <label class="radio-inline">
						  <input class= "signup-option" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="employed" checked> Employed
						</label>
						<label class="radio-inline">
						  <input class= "signup-option" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="looking" > Job Seeker
						</label>
						<label class="radio-inline">
						  <input class= "signup-option" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="student" > Student
						</label>
					</div>
					<!--For employed-->	 
					<div id= "employedSelection">
						<div class="form-group">
						  <!-- Job title-->
						  <label class="control-label" for="jobTitle">Job title</label> <br />
						  <div class="controls" >
							<input class="form-control"type="text" id="jobTitle" name="jobTitle" placeholder="" class="input-xlarge" required>
						  </div>
						</div>
					 
						<div class="form-group">
						  <!-- Company -->
						  <label class="control-label"  for="company">Company</label> <br />
						  <div class="controls">
							<input class="form-control" type="text" id="company" name="company" placeholder="" class="input-xlarge" required>
						  </div>
						</div>
					</div>
						<!--For Job Seekers-->
					<div  id= "jobSeekerSelection" style= "display:none;">
						  <!--Most recent Job title-->
						 <div class="form-group">
						  <label class="control-label" for="recentJobTitle">Most recent Job title</label>
						  <div class="controls">
							<input class="form-control" type="text" id="recentJobTitle" name="MostRecentJobTitle" placeholder="" class="input-xlarge" required>
						  </div>
						</div>

						  <!--Most recent Company -->
						<div class="form-group">
						  <label class="control-label"  for="recentCompany">Most recent Company</label>
						  <div class="controls">
							<input class="form-control" type="text" id="recentCompany" name="MostRecentCompany" placeholder="" class="input-xlarge" required>
						  </div>
						</div>

						  <!--Time Period-->
						<div class="form-group">
						  <label class="control-label" for="timePeriod">Time period</label>
						  <div class="row">
						    <div class="col-md-5">
							<select class="form-control" id= "start-yearpicker-seeker" name="start-yearpicker" required>
									<option value="" selected>-</option>
									<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
									<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
									<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
									<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
									<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
									<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
							</select>
							</div>
							<div class="col-md-2 text-center">to </div>
							
							  <div class="col-md-5">
							<select class="form-control" id= "end-yearpicker-seeker" name="end-yearpicker"  required>
									<option value="" selected>-</option>
									<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
									<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
									<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
									<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
									<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
									<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
							</select>
							</div>
						  </div>
						</div>
					</div>	
					<!--For Students-->
					<div id= "studentSelection" style= "display:none;">
						<!--School/University -->
						<div class="form-group">
							  <label class="control-label"  for="school">School/University</label>
							  <div class="controls">
								<input class="form-control" type="text" id="school" name="school" placeholder="" class="input-xlarge" required>
							  </div>
						</div>
						
						<!--Time Period-->
						<div class="form-group">
						  <label class="control-label" for="timePeriod">Time period</label>
						  <div class="row">
						    <div class="col-md-5">
							<select class="form-control" id= "start-yearpicker-student" name="start-yearpicker" required>
									<option value="" selected>-</option>
									<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
									<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
									<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
									<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
									<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
									<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
							</select>
							</div>
							<div class="col-md-2 text-center">to </div>
							
							  <div class="col-md-5">
							<select class="form-control" id= "end-yearpicker-student" name="end-yearpicker"  required>
									<option value="" selected>-</option>
									<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
									<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
									<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
									<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
									<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
									<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
							</select>
							</div>
						  </div>
						</div>
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
