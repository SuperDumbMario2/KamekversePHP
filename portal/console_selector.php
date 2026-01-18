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
<header id="header">
  <h1 id="page-title" class="left">Consoles</h1>
</header>




<div class="body-content" id="community-top" data-region="USA">
    <div class="community-list-footer">
      <a href="./?view_platform=switch2" class="platform-button platform-button-switch2" data-pjax="#body">Switch 2 Communities</a>
      <a href="./?view_platform=switch" class="platform-button platform-button-switch" data-pjax="#body">Switch Communities</a>
      <a href="./?view_platform=wiiu" class="platform-button platform-button-wiiu" data-pjax="#body">Wii U Communities</a>
      <a href="./?view_platform=3ds" class="platform-button platform-button-3ds" data-pjax="#body">3DS Communities</a>
      <a href="./?view_platform=wii" class="platform-button platform-button-wii" data-pjax="#body">Wii Communities</a>
      <a href="./?view_platform=ds" class="platform-button platform-button-wii" data-pjax="#body">DS Communities</a>
      <a href="./?view_platform=gcn" class="platform-button platform-button-gcn" data-pjax="#body">GameCube Communities</a>
      <a href="./?view_platform=gba" class="platform-button platform-button-gcn" data-pjax="#body">GBA Communities</a>
      <a href="./?view_platform=n64" class="platform-button platform-button-n64" data-pjax="#body">Nintendo 64 Communities</a>
      <a href="./?view_platform=vb" class="platform-button platform-button-vb" data-pjax="#body">Virtual Boy Communities</a>
      <a href="./?view_platform=gb" class="platform-button platform-button-wii" data-pjax="#body">Game Boy Communities</a>
      <a href="./?view_platform=snes" class="platform-button platform-button-snes" data-pjax="#body">SNES Communities</a>
      <a href="./?view_platform=nes" class="platform-button platform-button-3ds" data-pjax="#body">NES Communities</a>
    </div>
    

  </div>
  
</div>
</body></html>