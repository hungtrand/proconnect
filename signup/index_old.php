<?php
	//error_reporting(E_ALL); // debug
	//ini_set("display_errors", 1); // debug
  	include '../signin/php/session_check.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Build Your Profile</title>

  <!-- JQuery link -->

  <!-- Latest compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">-->


  <script type="text/javascript" src="../lib/jquery/jquery-2.1.3.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Latest compiled and minified JavaScript -->
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
 <!-- CSS link -->
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  <!-- JavaScript link -->
  <script type="text/javascript" src="js/SignUpForm.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</head>
<body>

<form class="form-horizontal" action='' method="POST" novalidate>
<div id= "logo-container">
<img id= "logo" src = "../image/proconnect/logo_text.png">
</div> 
 <fieldset>
    <div id="legend">
	<p id= "username"><b>User</b></p>, let's start creating your professional profile
   </div>	
   <!-- Invalid input alert -->
	<div class="alert alert-danger" role="alert" style="display: none;"><b>Invalid Input :</b> Please correct the marked field(s)</div>
	<div class = "left">
		<div class="control-group">
		  <!-- Country-->
		  <label class="control-label"  for="country">* Country</label>
		  <div class="controls">
			<select type="text" id="country" name="country" class="input-xlarge"> 
				<option value="United States">United States</option> 
				<option value="United Kingdom">United Kingdom</option> 
				<option value="Afghanistan">Afghanistan</option> 
				<option value="Albania">Albania</option> 
				<option value="Algeria">Algeria</option> 
				<option value="American Samoa">American Samoa</option> 
				<option value="Andorra">Andorra</option> 
				<option value="Angola">Angola</option> 
				<option value="Anguilla">Anguilla</option> 
				<option value="Antarctica">Antarctica</option> 
				<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
				<option value="Argentina">Argentina</option> 
				<option value="Armenia">Armenia</option> 
				<option value="Aruba">Aruba</option> 
				<option value="Australia">Australia</option> 
				<option value="Austria">Austria</option> 
				<option value="Azerbaijan">Azerbaijan</option> 
				<option value="Bahamas">Bahamas</option> 
				<option value="Bahrain">Bahrain</option> 
				<option value="Bangladesh">Bangladesh</option> 
				<option value="Barbados">Barbados</option> 
				<option value="Belarus">Belarus</option> 
				<option value="Belgium">Belgium</option> 
				<option value="Belize">Belize</option> 
				<option value="Benin">Benin</option> 
				<option value="Bermuda">Bermuda</option> 
				<option value="Bhutan">Bhutan</option> 
				<option value="Bolivia">Bolivia</option> 
				<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
				<option value="Botswana">Botswana</option> 
				<option value="Bouvet Island">Bouvet Island</option> 
				<option value="Brazil">Brazil</option> 
				<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
				<option value="Brunei Darussalam">Brunei Darussalam</option> 
				<option value="Bulgaria">Bulgaria</option> 
				<option value="Burkina Faso">Burkina Faso</option> 
				<option value="Burundi">Burundi</option> 
				<option value="Cambodia">Cambodia</option> 
				<option value="Cameroon">Cameroon</option> 
				<option value="Canada">Canada</option> 
				<option value="Cape Verde">Cape Verde</option> 
				<option value="Cayman Islands">Cayman Islands</option> 
				<option value="Central African Republic">Central African Republic</option> 
				<option value="Chad">Chad</option> 
				<option value="Chile">Chile</option> 
				<option value="China">China</option> 
				<option value="Christmas Island">Christmas Island</option> 
				<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
				<option value="Colombia">Colombia</option> 
				<option value="Comoros">Comoros</option> 
				<option value="Congo">Congo</option> 
				<option value="Congo">Congo</option> 
				<option value="Cook Islands">Cook Islands</option> 
				<option value="Costa Rica">Costa Rica</option> 
				<option value="Cote D'ivoire">Cote D'ivoire</option> 
				<option value="Croatia">Croatia</option> 
				<option value="Cuba">Cuba</option> 
				<option value="Cyprus">Cyprus</option> 
				<option value="Czech Republic">Czech Republic</option> 
				<option value="Denmark">Denmark</option> 
				<option value="Djibouti">Djibouti</option> 
				<option value="Dominica">Dominica</option> 
				<option value="Dominican Republic">Dominican Republic</option> 
				<option value="Ecuador">Ecuador</option> 
				<option value="Egypt">Egypt</option> 
				<option value="El Salvador">El Salvador</option> 
				<option value="Equatorial Guinea">Equatorial Guinea</option> 
				<option value="Eritrea">Eritrea</option> 
				<option value="Estonia">Estonia</option> 
				<option value="Ethiopia">Ethiopia</option> 
				<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
				<option value="Faroe Islands">Faroe Islands</option> 
				<option value="Fiji">Fiji</option> 
				<option value="Finland">Finland</option> 
				<option value="France">France</option> 
				<option value="French Guiana">French Guiana</option> 
				<option value="French Polynesia">French Polynesia</option> 
				<option value="French Southern Territories">French Southern Territories</option> 
				<option value="Gabon">Gabon</option> 
				<option value="Gambia">Gambia</option> 
				<option value="Georgia">Georgia</option> 
				<option value="Germany">Germany</option> 
				<option value="Ghana">Ghana</option> 
				<option value="Gibraltar">Gibraltar</option> 
				<option value="Greece">Greece</option> 
				<option value="Greenland">Greenland</option> 
				<option value="Grenada">Grenada</option> 
				<option value="Guadeloupe">Guadeloupe</option> 
				<option value="Guam">Guam</option> 
				<option value="Guatemala">Guatemala</option> 
				<option value="Guinea">Guinea</option> 
				<option value="Guinea-bissau">Guinea-bissau</option> 
				<option value="Guyana">Guyana</option> 
				<option value="Haiti">Haiti</option> 
				<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
				<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
				<option value="Honduras">Honduras</option> 
				<option value="Hong Kong">Hong Kong</option> 
				<option value="Hungary">Hungary</option> 
				<option value="Iceland">Iceland</option> 
				<option value="India">India</option> 
				<option value="Indonesia">Indonesia</option> 
				<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
				<option value="Iraq">Iraq</option> 
				<option value="Ireland">Ireland</option> 
				<option value="Israel">Israel</option> 
				<option value="Italy">Italy</option> 
				<option value="Jamaica">Jamaica</option> 
				<option value="Japan">Japan</option> 
				<option value="Jordan">Jordan</option> 
				<option value="Kazakhstan">Kazakhstan</option> 
				<option value="Kenya">Kenya</option> 
				<option value="Kiribati">Kiribati</option> 
				<option value="Korea, North">Korea, North</option> 
				<option value="Korea, South">Korea, South</option> 
				<option value="Kuwait">Kuwait</option> 
				<option value="Kyrgyzstan">Kyrgyzstan</option> 
				<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
				<option value="Latvia">Latvia</option> 
				<option value="Lebanon">Lebanon</option> 
				<option value="Lesotho">Lesotho</option> 
				<option value="Liberia">Liberia</option> 
				<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
				<option value="Liechtenstein">Liechtenstein</option> 
				<option value="Lithuania">Lithuania</option> 
				<option value="Luxembourg">Luxembourg</option> 
				<option value="Macao">Macao</option> 
				<option value="Macedonia">Macedonia</option> 
				<option value="Madagascar">Madagascar</option> 
				<option value="Malawi">Malawi</option> 
				<option value="Malaysia">Malaysia</option> 
				<option value="Maldives">Maldives</option> 
				<option value="Mali">Mali</option> 
				<option value="Malta">Malta</option> 
				<option value="Marshall Islands">Marshall Islands</option> 
				<option value="Martinique">Martinique</option> 
				<option value="Mauritania">Mauritania</option> 
				<option value="Mauritius">Mauritius</option> 
				<option value="Mayotte">Mayotte</option> 
				<option value="Mexico">Mexico</option> 
				<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
				<option value="Moldova, Republic of">Moldova, Republic of</option> 
				<option value="Monaco">Monaco</option> 
				<option value="Mongolia">Mongolia</option> 
				<option value="Montserrat">Montserrat</option> 
				<option value="Morocco">Morocco</option> 
				<option value="Mozambique">Mozambique</option> 
				<option value="Myanmar">Myanmar</option> 
				<option value="Namibia">Namibia</option> 
				<option value="Nauru">Nauru</option> 
				<option value="Nepal">Nepal</option> 
				<option value="Netherlands">Netherlands</option> 
				<option value="Netherlands Antilles">Netherlands Antilles</option> 
				<option value="New Caledonia">New Caledonia</option> 
				<option value="New Zealand">New Zealand</option> 
				<option value="Nicaragua">Nicaragua</option> 
				<option value="Niger">Niger</option> 
				<option value="Nigeria">Nigeria</option> 
				<option value="Niue">Niue</option> 
				<option value="Norfolk Island">Norfolk Island</option> 
				<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
				<option value="Norway">Norway</option> 
				<option value="Oman">Oman</option> 
				<option value="Pakistan">Pakistan</option> 
				<option value="Palau">Palau</option> 
				<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
				<option value="Panama">Panama</option> 
				<option value="Papua New Guinea">Papua New Guinea</option> 
				<option value="Paraguay">Paraguay</option> 
				<option value="Peru">Peru</option> 
				<option value="Philippines">Philippines</option> 
				<option value="Pitcairn">Pitcairn</option> 
				<option value="Poland">Poland</option> 
				<option value="Portugal">Portugal</option> 
				<option value="Puerto Rico">Puerto Rico</option> 
				<option value="Qatar">Qatar</option> 
				<option value="Reunion">Reunion</option> 
				<option value="Romania">Romania</option> 
				<option value="Russian Federation">Russian Federation</option> 
				<option value="Rwanda">Rwanda</option> 
				<option value="Saint Helena">Saint Helena</option> 
				<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
				<option value="Saint Lucia">Saint Lucia</option> 
				<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
				<option value="Samoa">Samoa</option> 
				<option value="San Marino">San Marino</option> 
				<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
				<option value="Saudi Arabia">Saudi Arabia</option> 
				<option value="Senegal">Senegal</option> 
				<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
				<option value="Seychelles">Seychelles</option> 
				<option value="Sierra Leone">Sierra Leone</option> 
				<option value="Singapore">Singapore</option> 
				<option value="Slovakia">Slovakia</option> 
				<option value="Slovenia">Slovenia</option> 
				<option value="Solomon Islands">Solomon Islands</option> 
				<option value="Somalia">Somalia</option> 
				<option value="South Africa">South Africa</option> 
				<option value="South Georgia">South Georgia</option> 
				<option value="Spain">Spain</option> 
				<option value="Sri Lanka">Sri Lanka</option> 
				<option value="Sudan">Sudan</option> 
				<option value="Suriname">Suriname</option> 
				<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
				<option value="Swaziland">Swaziland</option> 
				<option value="Sweden">Sweden</option> 
				<option value="Switzerland">Switzerland</option> 
				<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
				<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
				<option value="Tajikistan">Tajikistan</option> 
				<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
				<option value="Thailand">Thailand</option> 
				<option value="Timor-leste">Timor-leste</option> 
				<option value="Togo">Togo</option> 
				<option value="Tokelau">Tokelau</option> 
				<option value="Tonga">Tonga</option> 
				<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
				<option value="Tunisia">Tunisia</option> 
				<option value="Turkey">Turkey</option> 
				<option value="Turkmenistan">Turkmenistan</option> 
				<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
				<option value="Tuvalu">Tuvalu</option> 
				<option value="Uganda">Uganda</option> 
				<option value="Ukraine">Ukraine</option> 
				<option value="United Arab Emirates">United Arab Emirates</option> 
				<option value="United Kingdom">United Kingdom</option> 
				<option value="United States">United States</option> 
				<option value="Uruguay">Uruguay</option> 
				<option value="Uzbekistan">Uzbekistan</option> 
				<option value="Vanuatu">Vanuatu</option> 
				<option value="Venezuela">Venezuela</option> 
				<option value="Viet Nam">Viet Nam</option> 
				<option value="Virgin Islands, British">Virgin Islands, British</option> 
				<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
				<option value="Wallis and Futuna">Wallis and Futuna</option> 
				<option value="Western Sahara">Western Sahara</option> 
				<option value="Yemen">Yemen</option> 
				<option value="Zambia">Zambia</option> 
				<option value="Zimbabwe">Zimbabwe</option>
			</select>
		  </div>
		</div>
	 
		<div class="control-group">
		  <!-- ZIP Code -->
		  <label class="control-label" for="zipcode">* ZIP Code</label>
		  <div class="controls">
			<input type="text" id="zipcode" name="zipcode" placeholder="" class="input-xlarge"  required>
			<p class="help-block">e.g.94043</p>
		  </div>
		</div>
		 <div class="control-group">
		  <!--I am Currently-->
		  <label class="control-label" for="usertype">I am currently:</label>
		  <div class="controls">
			<ul id="usertype">
				<li class="employed">
					<label for="employed-btn">
						<input type="radio" name="status-chooser" value="employed" class="signup-option" id="employed-btn">Employed
					</label>
				</li>
				<li class="looking">
					<label for="looking-btn">
						<input type="radio" name="status-chooser" value="looking" class="signup-option" id="looking-btn">Job Seeker
					</label>
				</li>
				<li class="student">
					<label for="student-btn">
						<input type="radio" name="status-chooser" value="student" class="signup-option"id="student-btn">Student
					</label>
				</li>
			</ul>
		  </div>
		</div>

	<!--For employed-->	 
	<div id= "employedSelection">
		<div class="control-group">
		  <!-- Job title-->
		  <label class="control-label" for="jobTitle">* Job title</label>
		  <div class="controls" >
			<input type="text" id="jobTitle" name="jobTitle" placeholder="" class="input-xlarge" required>
			<input type="checkbox" name="self-employed" value="self-employed"><label id= "self">&nbsp;I am self-employed</label><br>
		  </div>
		</div>
	 
		<div class="control-group">
		  <!-- Company -->
		  <label class="control-label"  for="company">* Company</label>
		  <div class="controls">
			<input type="text" id="company" name="company" placeholder="" class="input-xlarge" required>
		  </div>
		</div>
		<div class="control-group">
		  <!-- Industry-->
		  <label class="control-label"  for="industry">* Industry</label>
		  <div class="controls">
			<select type="text" id="industry" name="industry" class="input-xlarge" required> 
				<option value="" selected>-</option><option value="47" class="corp fin">Accounting</option><option value="94" class="man tech tran">Airlines/Aviation</option><option value="120" class="leg org">Alternative Dispute Resolution</option><option value="125" class="hlth">Alternative Medicine</option><option value="127" class="art med">Animation</option><option value="19" class="good">Apparel &amp; Fashion</option><option value="50" class="cons">Architecture &amp; Planning</option><option value="111" class="art med rec">Arts and Crafts</option><option value="53" class="man">Automotive</option><option value="52" class="gov man">Aviation &amp; Aerospace</option><option value="41" class="fin">Banking</option><option value="12" class="gov hlth tech">Biotechnology</option><option value="36" class="med rec">Broadcast Media</option><option value="49" class="cons">Building Materials</option><option value="138" class="corp man">Business Supplies and Equipment</option><option value="129" class="fin">Capital Markets</option><option value="54" class="man">Chemicals</option><option value="90" class="org serv">Civic &amp; Social Organization</option><option value="51" class="cons gov">Civil Engineering</option><option value="128" class="cons corp fin">Commercial Real Estate</option><option value="118" class="tech">Computer &amp; Network Security</option><option value="109" class="med rec">Computer Games</option><option value="3" class="tech">Computer Hardware</option><option value="5" class="tech">Computer Networking</option><option value="4" class="tech">Computer Software</option><option value="48" class="cons">Construction</option><option value="24" class="good man">Consumer Electronics</option><option value="25" class="good man">Consumer Goods</option><option value="91" class="org serv">Consumer Services</option><option value="18" class="good">Cosmetics</option><option value="65" class="agr">Dairy</option><option value="1" class="gov tech">Defense &amp; Space</option><option value="99" class="art med">Design</option><option value="69" class="edu">Education Management</option><option value="132" class="edu org">E-Learning</option><option value="112" class="good man">Electrical/Electronic Manufacturing</option><option value="28" class="med rec">Entertainment</option><option value="86" class="org serv">Environmental Services</option><option value="110" class="corp rec serv">Events Services</option><option value="76" class="gov">Executive Office</option><option value="122" class="corp serv">Facilities Services</option><option value="63" class="agr">Farming</option><option value="43" class="fin">Financial Services</option><option value="38" class="art med rec">Fine Art</option><option value="66" class="agr">Fishery</option><option value="34" class="rec serv">Food &amp; Beverages</option><option value="23" class="good man serv">Food Production</option><option value="101" class="org">Fund-Raising</option><option value="26" class="good man">Furniture</option><option value="29" class="rec">Gambling &amp; Casinos</option><option value="145" class="cons man">Glass, Ceramics &amp; Concrete</option><option value="75" class="gov">Government Administration</option><option value="148" class="gov">Government Relations</option><option value="140" class="art med">Graphic Design</option><option value="124" class="hlth rec">Health, Wellness and Fitness</option><option value="68" class="edu">Higher Education</option><option value="14" class="hlth">Hospital &amp; Health Care</option><option value="31" class="rec serv tran">Hospitality</option><option value="137" class="corp">Human Resources</option><option value="134" class="corp good tran">Import and Export</option><option value="88" class="org serv">Individual &amp; Family Services</option><option value="147" class="cons man">Industrial Automation</option><option value="84" class="med serv">Information Services</option><option value="96" class="tech">Information Technology and Services</option><option value="42" class="fin">Insurance</option><option value="74" class="gov">International Affairs</option><option value="141" class="gov org tran">International Trade and Development</option><option value="6" class="tech">Internet</option><option value="45" class="fin">Investment Banking</option><option value="46" class="fin">Investment Management</option><option value="73" class="gov leg">Judiciary</option><option value="77" class="gov leg">Law Enforcement</option><option value="9" class="leg">Law Practice</option><option value="10" class="leg">Legal Services</option><option value="72" class="gov leg">Legislative Office</option><option value="30" class="rec serv tran">Leisure, Travel &amp; Tourism</option><option value="85" class="med rec serv">Libraries</option><option value="116" class="corp tran">Logistics and Supply Chain</option><option value="143" class="good">Luxury Goods &amp; Jewelry</option><option value="55" class="man">Machinery</option><option value="11" class="corp">Management Consulting</option><option value="95" class="tran">Maritime</option><option value="80" class="corp med">Marketing and Advertising</option><option value="97" class="corp">Market Research</option><option value="135" class="cons gov man">Mechanical or Industrial Engineering</option><option value="126" class="med rec">Media Production</option><option value="17" class="hlth">Medical Devices</option><option value="13" class="hlth">Medical Practice</option><option value="139" class="hlth">Mental Health Care</option><option value="71" class="gov">Military</option><option value="56" class="man">Mining &amp; Metals</option><option value="35" class="art med rec">Motion Pictures and Film</option><option value="37" class="art med rec">Museums and Institutions</option><option value="115" class="art rec">Music</option><option value="114" class="gov man tech">Nanotechnology</option><option value="81" class="med rec">Newspapers</option><option value="100" class="org">Nonprofit Organization Management</option><option value="57" class="man">Oil &amp; Energy</option><option value="113" class="med">Online Media</option><option value="123" class="corp">Outsourcing/Offshoring</option><option value="87" class="serv tran">Package/Freight Delivery</option><option value="146" class="good man">Packaging and Containers</option><option value="61" class="man">Paper &amp; Forest Products</option><option value="39" class="art med rec">Performing Arts</option><option value="15" class="hlth tech">Pharmaceuticals</option><option value="131" class="org">Philanthropy</option><option value="136" class="art med rec">Photography</option><option value="117" class="man">Plastics</option><option value="107" class="gov org">Political Organization</option><option value="67" class="edu">Primary/Secondary Education</option><option value="83" class="med rec">Printing</option><option value="105" class="corp">Professional Training &amp; Coaching</option><option value="102" class="corp org">Program Development</option><option value="79" class="gov">Public Policy</option><option value="98" class="corp">Public Relations and Communications</option><option value="78" class="gov">Public Safety</option><option value="82" class="med rec">Publishing</option><option value="62" class="man">Railroad Manufacture</option><option value="64" class="agr">Ranching</option><option value="44" class="cons fin good">Real Estate</option><option value="40" class="rec serv">Recreational Facilities and Services</option><option value="89" class="org serv">Religious Institutions</option><option value="144" class="gov man org">Renewables &amp; Environment</option><option value="70" class="edu gov">Research</option><option value="32" class="rec serv">Restaurants</option><option value="27" class="good man">Retail</option><option value="121" class="corp org serv">Security and Investigations</option><option value="7" class="tech">Semiconductors</option><option value="58" class="man">Shipbuilding</option><option value="20" class="good rec">Sporting Goods</option><option value="33" class="rec">Sports</option><option value="104" class="corp">Staffing and Recruiting</option><option value="22" class="good">Supermarkets</option><option value="8" class="gov tech">Telecommunications</option><option value="60" class="man">Textiles</option><option value="130" class="gov org">Think Tanks</option><option value="21" class="good">Tobacco</option><option value="108" class="corp gov serv">Translation and Localization</option><option value="92" class="tran">Transportation/Trucking/Railroad</option><option value="59" class="man">Utilities</option><option value="106" class="fin tech">Venture Capital &amp; Private Equity</option><option value="16" class="hlth">Veterinary</option><option value="93" class="tran">Warehousing</option><option value="133" class="good">Wholesale</option><option value="142" class="good man rec">Wine and Spirits</option><option value="119" class="tech">Wireless</option><option value="103" class="art med rec">Writing and Editing</option>
			</select>
		  </div>
		</div>
	</div>
	<!--For Job Seekers-->
	<div id= "jobSeekerSelection" style="display:none">
		<div class="control-group">
		  <!--Most recent Job title-->
		  <label class="control-label" for="recentJobTitle">* Most recent Job title</label>
		  <div class="controls">
			<input type="text" id="recentJobTitle" name="MostRecentJobTitle" placeholder="" class="input-xlarge" required>
			<input type="checkbox" name="self-employed" value="self-employed"><label id= "self">&nbsp;I am self-employed</label><br>
		  </div>
		</div>
		<div class="control-group">
		  <!--Most recent Company -->
		  <label class="control-label"  for="recentCompany">* Most recent Company</label>
		  <div class="controls">
			<input type="text" id="recentCompany" name="MostRecentCompany" placeholder="" class="input-xlarge" required>
		  </div>
		</div>
		<div class="control-group">
		  <!-- Industry-->
		  <label class="control-label"  for="industry">* Industry</label>
		  <div class="controls">
			<select type="text" id="industry-looking" name="industry" class="input-xlarge" required> 
				<option value="" selected>-</option><option value="47" class="corp fin">Accounting</option><option value="94" class="man tech tran">Airlines/Aviation</option><option value="120" class="leg org">Alternative Dispute Resolution</option><option value="125" class="hlth">Alternative Medicine</option><option value="127" class="art med">Animation</option><option value="19" class="good">Apparel &amp; Fashion</option><option value="50" class="cons">Architecture &amp; Planning</option><option value="111" class="art med rec">Arts and Crafts</option><option value="53" class="man">Automotive</option><option value="52" class="gov man">Aviation &amp; Aerospace</option><option value="41" class="fin">Banking</option><option value="12" class="gov hlth tech">Biotechnology</option><option value="36" class="med rec">Broadcast Media</option><option value="49" class="cons">Building Materials</option><option value="138" class="corp man">Business Supplies and Equipment</option><option value="129" class="fin">Capital Markets</option><option value="54" class="man">Chemicals</option><option value="90" class="org serv">Civic &amp; Social Organization</option><option value="51" class="cons gov">Civil Engineering</option><option value="128" class="cons corp fin">Commercial Real Estate</option><option value="118" class="tech">Computer &amp; Network Security</option><option value="109" class="med rec">Computer Games</option><option value="3" class="tech">Computer Hardware</option><option value="5" class="tech">Computer Networking</option><option value="4" class="tech">Computer Software</option><option value="48" class="cons">Construction</option><option value="24" class="good man">Consumer Electronics</option><option value="25" class="good man">Consumer Goods</option><option value="91" class="org serv">Consumer Services</option><option value="18" class="good">Cosmetics</option><option value="65" class="agr">Dairy</option><option value="1" class="gov tech">Defense &amp; Space</option><option value="99" class="art med">Design</option><option value="69" class="edu">Education Management</option><option value="132" class="edu org">E-Learning</option><option value="112" class="good man">Electrical/Electronic Manufacturing</option><option value="28" class="med rec">Entertainment</option><option value="86" class="org serv">Environmental Services</option><option value="110" class="corp rec serv">Events Services</option><option value="76" class="gov">Executive Office</option><option value="122" class="corp serv">Facilities Services</option><option value="63" class="agr">Farming</option><option value="43" class="fin">Financial Services</option><option value="38" class="art med rec">Fine Art</option><option value="66" class="agr">Fishery</option><option value="34" class="rec serv">Food &amp; Beverages</option><option value="23" class="good man serv">Food Production</option><option value="101" class="org">Fund-Raising</option><option value="26" class="good man">Furniture</option><option value="29" class="rec">Gambling &amp; Casinos</option><option value="145" class="cons man">Glass, Ceramics &amp; Concrete</option><option value="75" class="gov">Government Administration</option><option value="148" class="gov">Government Relations</option><option value="140" class="art med">Graphic Design</option><option value="124" class="hlth rec">Health, Wellness and Fitness</option><option value="68" class="edu">Higher Education</option><option value="14" class="hlth">Hospital &amp; Health Care</option><option value="31" class="rec serv tran">Hospitality</option><option value="137" class="corp">Human Resources</option><option value="134" class="corp good tran">Import and Export</option><option value="88" class="org serv">Individual &amp; Family Services</option><option value="147" class="cons man">Industrial Automation</option><option value="84" class="med serv">Information Services</option><option value="96" class="tech">Information Technology and Services</option><option value="42" class="fin">Insurance</option><option value="74" class="gov">International Affairs</option><option value="141" class="gov org tran">International Trade and Development</option><option value="6" class="tech">Internet</option><option value="45" class="fin">Investment Banking</option><option value="46" class="fin">Investment Management</option><option value="73" class="gov leg">Judiciary</option><option value="77" class="gov leg">Law Enforcement</option><option value="9" class="leg">Law Practice</option><option value="10" class="leg">Legal Services</option><option value="72" class="gov leg">Legislative Office</option><option value="30" class="rec serv tran">Leisure, Travel &amp; Tourism</option><option value="85" class="med rec serv">Libraries</option><option value="116" class="corp tran">Logistics and Supply Chain</option><option value="143" class="good">Luxury Goods &amp; Jewelry</option><option value="55" class="man">Machinery</option><option value="11" class="corp">Management Consulting</option><option value="95" class="tran">Maritime</option><option value="80" class="corp med">Marketing and Advertising</option><option value="97" class="corp">Market Research</option><option value="135" class="cons gov man">Mechanical or Industrial Engineering</option><option value="126" class="med rec">Media Production</option><option value="17" class="hlth">Medical Devices</option><option value="13" class="hlth">Medical Practice</option><option value="139" class="hlth">Mental Health Care</option><option value="71" class="gov">Military</option><option value="56" class="man">Mining &amp; Metals</option><option value="35" class="art med rec">Motion Pictures and Film</option><option value="37" class="art med rec">Museums and Institutions</option><option value="115" class="art rec">Music</option><option value="114" class="gov man tech">Nanotechnology</option><option value="81" class="med rec">Newspapers</option><option value="100" class="org">Nonprofit Organization Management</option><option value="57" class="man">Oil &amp; Energy</option><option value="113" class="med">Online Media</option><option value="123" class="corp">Outsourcing/Offshoring</option><option value="87" class="serv tran">Package/Freight Delivery</option><option value="146" class="good man">Packaging and Containers</option><option value="61" class="man">Paper &amp; Forest Products</option><option value="39" class="art med rec">Performing Arts</option><option value="15" class="hlth tech">Pharmaceuticals</option><option value="131" class="org">Philanthropy</option><option value="136" class="art med rec">Photography</option><option value="117" class="man">Plastics</option><option value="107" class="gov org">Political Organization</option><option value="67" class="edu">Primary/Secondary Education</option><option value="83" class="med rec">Printing</option><option value="105" class="corp">Professional Training &amp; Coaching</option><option value="102" class="corp org">Program Development</option><option value="79" class="gov">Public Policy</option><option value="98" class="corp">Public Relations and Communications</option><option value="78" class="gov">Public Safety</option><option value="82" class="med rec">Publishing</option><option value="62" class="man">Railroad Manufacture</option><option value="64" class="agr">Ranching</option><option value="44" class="cons fin good">Real Estate</option><option value="40" class="rec serv">Recreational Facilities and Services</option><option value="89" class="org serv">Religious Institutions</option><option value="144" class="gov man org">Renewables &amp; Environment</option><option value="70" class="edu gov">Research</option><option value="32" class="rec serv">Restaurants</option><option value="27" class="good man">Retail</option><option value="121" class="corp org serv">Security and Investigations</option><option value="7" class="tech">Semiconductors</option><option value="58" class="man">Shipbuilding</option><option value="20" class="good rec">Sporting Goods</option><option value="33" class="rec">Sports</option><option value="104" class="corp">Staffing and Recruiting</option><option value="22" class="good">Supermarkets</option><option value="8" class="gov tech">Telecommunications</option><option value="60" class="man">Textiles</option><option value="130" class="gov org">Think Tanks</option><option value="21" class="good">Tobacco</option><option value="108" class="corp gov serv">Translation and Localization</option><option value="92" class="tran">Transportation/Trucking/Railroad</option><option value="59" class="man">Utilities</option><option value="106" class="fin tech">Venture Capital &amp; Private Equity</option><option value="16" class="hlth">Veterinary</option><option value="93" class="tran">Warehousing</option><option value="133" class="good">Wholesale</option><option value="142" class="good man rec">Wine and Spirits</option><option value="119" class="tech">Wireless</option><option value="103" class="art med rec">Writing and Editing</option>
			</select>
		  </div>
		</div>
		<div class="control-group">
		  <!--Time Period-->
		  <label class="control-label" for="timePeriod">* time period</label>
		  <div class="controls">
			<select name="start-yearpicker" id="start-yearpicker-looking" required>
			<option value="" selected>-</option>
			<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
			<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
			<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
			<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
			<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
			<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
			</select>
			&nbsp; to &nbsp;
			<select name="end-yearpicker" id="end-yearpicker-looking" required>
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
	<!--For Students-->
	<div id= "studentSelection" style="display:none">
		<div class="control-group">
			  <!--School/University -->
			  <label class="control-label"  for="school">* School/University</label>
			  <div class="controls">
				<input type="text" id="school" name="school" placeholder="" class="input-xlarge" required>
			  </div>
		</div>
			
		<div class="control-group">
			  <!--Dates attended-->
			  <label class="control-label" for="dates">* Dates attended</label>
			  <div class="controls">
				<select name="start-yearpicker" id="start-yearpicker-student" required> 
				<option value="" selected>-</option>
				<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
				<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
				<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
				<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
				<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
				<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
				</select>
				&nbsp; to &nbsp;
				<select name="end-yearpicker" id="end-yearpicker-student" required>
				<option value="" selected>-</option>
				
				<option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
				<option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
				<option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
				<option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
				<option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
				<option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
				</select>
				<p class="help-block">Current students: enter your expected graduation year</p>
			  </div>
			</div>
			<div class="control-group">
			  <!--Age-->
			  <label class="control-label" for="age">* Age</label>
			  <div class="controls">
				<input type="checkbox" id = "age" name="age" value="age" required>I am 18 or older.<br>
			  </div>
			</div>
	</div>
	
		<div class="control-group">
		  <!-- Button -->
		  <div class="controls">
			<input type="submit" name="submit" value="Create my profile" id="submit" class="button">
			<p class="help-block">* Indicates required field.</p>
		  </div>
		</div>
			
	</div>
	

	<div class = "right">
		<div class="info box">
		<!-- info -->
		<ul>
			<li class= "title"><b>A ProConnect profile helps you...</b></li>
			<li class= "item">Showcase your skills and experience</li>
			<li class= "item">Be found for new opportunities</li>
			<li class= "item">Stay in touch with colleagues and friends</li>
		</ul>
		
		</div>
	<div>	
  </fieldset>
</form>

</body>


</html>