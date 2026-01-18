<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}

$id = mysqli_real_escape_string($conn, $_GET["id"]);
?>
<html lang="en" data-google-analytics-tracking-id="UA-68779773-2"><head>
    <meta charset="utf-8">
    <title>Kamekverse</title>
      <link rel="stylesheet" type="text/css" href="./ass/portal.css">
      <script type="text/javascript" src="./ass/complete_en.js"></script>

    </head>

  <body>
  
    <?php include "./components/header.php" ?>

    
    <div id="body"><header id="header">
  <a id="header-message-button" class="header-button" href="#" data-modal-open="#add-message-page">Write Message</a>
  <?php
  $sql = "SELECT * FROM accounts WHERE id = '$id'";
  if($result = mysqli_query($conn, $sql)){
    foreach($result as $usr){
      $miiusr = $usr["miidata"];
      $badgeu = $usr["badge"];
      $displaynameu = htmlentities($usr["displayname"]);
      $usernameu = htmlentities($usr["username"]);
      echo '<h1 id="page-title" class="">Conversation with ' . $displaynameu . ' (' . $usernameu . ')</h1>';
    }
  }?>
  <?php $sql = "SELECT * FROM msg WHERE id_from = '$id' OR id_to = '$id' ORDER BY pk DESC;";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) != 0){
      foreach($result as $msg){
        $id_to = $msg["id_to"];
        $id_from = $msg["id_from"];
        if($id_from == $id){
          $mii = $miiusr;
        } else {
          $mii = $cmii;
        }
        if($id_to != $sessuid && $id_from != $sessuid){
          continue;
        } 
        $content = $msg["content"];
        $feeling = $msg["feeling"];
        $timestamp = $msg["timestamp"];
        $msgcss = "my-post";
        if($id_from != $sessuid){
          $msgcss = "other-post";
        }
        echo '<div class="body-content message-post-list" id="message-page" data-next-page-url=""><div id="message" class="post scroll ' . $msgcss . '">
        <a href="./user.php?id=' . $id_from . '" data-pjax="#body" class="scroll-focus user-icon-container"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=" . htmlentities($feeling) . "" . '" class="user-icon"></a>
        <header>
          <span class="timestamp">' . $timestamp . '</span>
          
        </header>
        <div class="post-body">      <p class="post-content">' . $content . '</p>
      
            
              
            
        </div>
      </div></div>';
      }
    }
  }
  ?>
</header></div>
  

<button type="button" class="accesskey-L" style="display: none;"></button><button type="button" class="accesskey-R" style="display: none;"></button></body></html>