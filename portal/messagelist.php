<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en" data-google-analytics-tracking-id="UA-68779773-2"><head>
    <meta charset="utf-8">
    <title>Kamekverse</title>
      <link rel="stylesheet" type="text/css" href="./ass/portal.css">
      <script type="text/javascript" src="./ass/complete_en.js"></script>

    </head>

  <body data-is-first-friend="1" data-hashed-pid="eaf4e66b5d54608bee3886b694e1e895" data-user-id="hol_down" data-age="30" data-gender="MALE" data-game-skill="3" data-follow-done="0" data-post-done="1" data-lang="en" data-country="ca" data-user-region="USA" data-profile-url="/users/hol_down">
  <?php include "./components/header.php" ?>

    
    <div id="body">

    

    
    <div id="body"><header id="header">
  
  <h1 id="page-title" class="">Messages</h1>

</header><div class="body-content" id="messages-list">  <div class="tutorial-window">
    <p>In Messages, you can send messages to friends and view past messages. If you want to play a game with a friend or get some tips if you're stuck, try sending a message!</p>
    <a href="#" class="button tutorial-close-button" data-tutorial-name="messages">Close</a>
  </div>  <ul class="list-content-with-icon-and-text arrow-list">
  <?php
        $nickcolor = "#000";
        $sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
        if($result = mysqli_query($conn, $sql)){
          foreach($result as $me){
            $f = explode(", ", $me["friend_list"]);
            foreach($f as $fr){
              $sql = "SELECT * FROM accounts WHERE id = '$fr'";
              if($result = mysqli_query($conn, $sql)){
                  foreach($result as $fri){
                    $dname = $fri["displayname"];
                    $uname = $fri["username"];
                    $miidata = $fri["miidata"];
                    echo '<li>
                    <a href="./user.ph?id=' . $fr . '" data-pjax="#body" class="icon-container trigger"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($miidata) . "&type=face&width=120&expression=normal" . '" class="icon"></a>
                    <a href="./message.php?id=' . $fr . '" data-pjax="#body" class="arrow-button"></a>
                    <div class="body">
                      <p class="title">
                        <span class="nick-name">' . htmlentities($dname) . '</span>
                        <span class="id-name">' . htmlentities($uname) . '</span>
                      </p>
                      
                      
                        <p class="text"></p>
                      
                    </div>
                  </li>';
                  }
              }
            }
          }
        }
        ?>
      
  </ul>
</div></div>

    <a id="scroll-to-top" style="display: none;" class="disabled" data-disabled-href="#"></a>
<div id="message-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Messages</h1>
    <div class="window-body"><div class="window-body-inner message">
      <p class="pre-line"></p>
    </div></div>
    <div class="window-bottom-buttons single-button">
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>

<div id="confirm-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Messages</h1>
    <div class="window-body"><div class="window-body-inner message">
      <p></p>
    </div></div>
    <div class="window-bottom-buttons">
      <a href="#" class="button cancel-button" data-sound="SE_WAVE_CANCEL">Cancel</a>
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>

<div id="parental-confirm-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Messages</h1>
    <div class="window-body">
      <div class="window-body-inner message">
        <p></p>
        <input type="password" controller="drc" minlength="4" maxlength="4" inputform="monospace" guidestring=" " class="parental_code textarea-line" name="parental_code" placeholder="Tap to enter the PIN." keyboard="pin">
      </div>
    </div>
    <div class="window-bottom-buttons">
      <a href="#" class="button cancel-button" data-sound="SE_WAVE_CANCEL">Back</a>
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>
<div id="capture-page" class="capture-page window-page none" data-modal-types="capture" data-is-template="1">
    <div class="capture-container">
        <div><img src="data:image/gif;base64,R0lGODlhEAAQAIAAAP%2F%2F%2FwAAACH5BAEAAAAALAAAAAAQABAAAAIOhI%2Bpy%2B0Po5y02ouzPgUAOw%3D%3D" class="capture"></div>
        <a href="#" class="olv-modal-close-button cancel-button accesskey-B" data-sound="SE_WAVE_CANCEL"><span>Back</span></a>
    </div>
</div>

  

<button type="button" class="accesskey-L" style="display: none;"></button><button type="button" class="accesskey-R" style="display: none;"></button>
</body></html>