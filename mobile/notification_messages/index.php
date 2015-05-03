<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once($_SERVER['DOCUMENT_ROOT'].'/signout/php/session_check_signout.php');

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];
if (isset($_COOKIE['__USER_PROFILE_IMAGE__'])) {
    $ProfileImage = $_COOKIE['__USER_PROFILE_IMAGE__'];
} else {
    $ProfileImage = '/image/user_img.png';
}

  $Title = "Message Notifications"; //require for front end

  ob_start();

?>
    <link rel="stylesheet" type="text/css" href="../css/notification_display.css">
    <div>
        <h4 class="mobile-noti-header">Messages</h4>
        <ul id="message-list" class="mobile-noti-list">
            <div class="iam-loading" >
                <div>
                  <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                </div>
            </div>
        </ul>
    </div>

<?php
    $Content = ob_get_clean();
    include $_SERVER["DOCUMENT_ROOT"]."/master/index.php";
?>
    <!-- Custom Proconnect Script -->
    <script type="text/javascript" src="../js/mobile_notification_display.js"></script>





