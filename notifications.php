<?php 
include "./dbconnect.php";
include "./cfg.php";
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" class="os-win" style="--wm-toolbar-height: 1px;"><head>

    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">
    
    <link rel="shortcut icon" href="./ass/favicon.png?mM9KNw_M04SIP2y9VGgdNA">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">

  </head>

  <body class=" guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      


  <?php include "./components/header.php" ?>

      
      <div id="main-body">


<div class="main-column">
  <div class="post-list-outline">
    <h2 class="label">Notifications</h2>
    <div id="guide" class="help-content">
      <div>
      <div class="list news-list" tabindex="0">
        <?php
        $nickcolor = "#000";
        $sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
        if($result = mysqli_query($conn, $sql)){
          foreach($result as $me){
            $fr = array_filter(array_map('trim', explode(", ", $me["friend_request_list"])));
            foreach($fr as $id){
              $sql = "SELECT * FROM accounts WHERE id = '$id'";
              if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) != 0) {
                foreach($result as $friend){
                  $name = htmlentities($friend["displayname"]);
                  $mii = htmlentities($friend["miidata"]);
                  $nickcolor = htmlentities($friend["nickname_color"]);
                  $nickcss = "";
    if(isset($nickcolor)){
      $nickcss = 'style=" color: ' . $nickcolor . ' !important ;"';
    }
                  echo '
  
  <a href="./user.php?id=' . $id . '" class="icon-container"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=normal" . '" class="icon"></a>
  <div class="body">Unanswered friend request by <a href="./user.php?id=' . $id . '" ' . $nickcss . ' class="nick-name">' . $name . '</a>.
      



<div class="toggle-button">
<a href="./accept_fr.php?id=' . $id . '" class="black-button">Accept</a><a href="./reject_fr.php?id=' . $id . '" class="black-button">Reject</a></br></br>
</div>
  </div>';
                }
              } else {
                echo "nop";
              }
              }
            }
          }
        }
        ?>
        </div>
        </div></div>
      </div>
    </div>
  </div>
</div>
      </div>








      

  


    </body></html>