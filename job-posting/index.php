<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
// initialize variables with default values
include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$Title = "Feed - Proconnect";
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];
$JobTitle = $UData['TITLE'];

ob_start();

?>
    <div class="container">
        
        
    </div>

<?php
    $Content = ob_get_clean();
    include __DIR__."/../master/index.php";
?>

  <!-- Custom modal handler -->
  <script src="js/index.js"></script>

  <!-- Custom CSS -->
  <link href="css/index.css" rel="stylesheet">