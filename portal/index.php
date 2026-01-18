<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
$con = "wiiu";
if(isset($_GET["view_platform"])){
  $con = $_GET["view_platform"];
}
if($con == "wiiu"){
  $acon = "3ds";
  $dacon = "3DS";
} else {
  $acon = "wiiu";
  $dacon = "Wii U";
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
<header id="header">
  <a id="header-favorites-button" href="https://portal-t1.olv.app.nintendo.net/communities/favorites" data-pjax="#body">Favorite Communities</a>
  
  <h1 id="page-title" class="left">Communities</h1>
  

</header>




<div class="body-content" id="community-top" data-region="USA">


  <div class="community-list community-list-<?php echo $con; ?>">
    
    <div class="banner-container">
      <a href="https://portal-t1.olv.app.nintendo.net/identified_user_posts?view_region_id=2" data-pjax="#body" class="button identified-user-button">
        <span class="title">Get the latest news here!</span>
        <span class="text">Posts from Verified Users</span>
      </a>
    </div>
    <div class="headline headline-<?php echo $con; ?>">
      <h2>New Communities</h2>
      


    </div>
    <ul class="list-content-with-icon-column" id="community-top-content">
        
<?php
$sql = "SELECT * FROM community WHERE special = 0 AND private = 0 AND community_flair_id = '$con' ORDER BY pk DESC LIMIT 6";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $community){
    $id = $community["id"];
    $name = $community["name"];
    $flair_name = $community["flair_name"];
    echo '<li id="community" class="">
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  <a href="./community.php?id=' . $id . '" data-pjax="#body" class="scroll to-community-button"></a>
  <div class="body">
    <div class="body-content">
        <span class="community-name title">' . $name . '</span>
          <span class="platform-tag platform-tag-' . $con . '"></span>
        <span class="text">' . $flair_name . '</span>
      
      
    </div>
  </div>
</li>';
  }
}
?>

    </ul>
    <a href="https://portal-t1.olv.app.nintendo.net/communities/categories/<?php echo $con; ?>_all" data-pjax="#body" class="more-button scroll">Show More</a>

    <h2 class="headline headline-special">Special</h2>
    <ul class="list-content-with-icon-column" id="community-top-content">
        
<?php
$sql = "SELECT * FROM community WHERE usergenerated = 0 AND special = 1 AND private = 0 ORDER BY pk DESC LIMIT 6";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $community){
    $id = $community["id"];
    $name = $community["name"];
    echo '<li id="community" class="">
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  <a href="./community.php?id=' . $id . '" data-pjax="#body" class="scroll to-community-button"></a>
  <div class="body">
    <div class="body-content">
        <span class="community-name title">' . $name . '</span>
      
      
    </div>
  </div>
</li>';
  }
}
?>

    </ul>
    <div class="community-list-footer">
      <a href="./?view_platform=<?php echo $acon; ?>" class="platform-button platform-button-<?php echo $acon; ?>" data-pjax="#body"><?php echo $dacon; ?> Communities</a>
      <a href="./console_selector.php" class="platform-button" style="color:#000;" data-pjax="#body">Console Selector</a>
    </div>
    

  </div>
  
</div>


    </div>

    <a id="scroll-to-top" style="display: none;" class="disabled" data-disabled-href="#"></a>
<div id="message-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Communities</h1>
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
    <h1 class="window-title">Communities</h1>
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
    <h1 class="window-title">Communities</h1>
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

  

<button type="button" class="accesskey-L" style="display: none;"></button><button type="button" class="accesskey-R" style="display: none;"></button></body></html>