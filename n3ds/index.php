<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
$con = "3ds";
if(isset($_GET["view_platform"])){
  $con = $_GET["view_platform"];
}
if($con == "3ds"){
  $acon = "wiiu";
  $dacon = "Wii U";
}
else{
  $acon = "3ds";
  $dacon = "3DS";
}
?>
<!DOCTYPE html>
<html lang="en"><!--
 Archive processed by SingleFile 
 url: https://ctr-d1.olv.app.nintendo.net/communities 
 saved date: Mon Mar 20 2017 23:53:07 GMT-0400 (Eastern Daylight Time) 
--><head>
    <meta charset="utf-8">
    <title>Kamekverse</title>
    <link rel="stylesheet" type="text/css" href="./ass/n3ds.css">
    <script type="text/javascript" src="./ass/complete_en.js"></script>
  <link type="image/x-icon" rel="shortcut icon" href="data:text/html;base64,PGh0bWw+DQo8aGVhZD48dGl0bGU+NDA0IE5vdCBGb3VuZDwvdGl0bGU+PC9oZWFkPg0KPGJvZHkgYmdjb2xvcj0id2hpdGUiPg0KPGNlbnRlcj48aDE+NDA0IE5vdCBGb3VuZDwvaDE+PC9jZW50ZXI+DQo8aHI+PGNlbnRlcj5uZ2lueDwvY2VudGVyPg0KPC9ib2R5Pg0KPC9odG1sPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0K"></head>
  <body data-user-id="" data-is-first-post="1" data-is-first-favorite="1">
    <div id="body" class="community-top platform-<?php echo $con ?> guest" data-region-id="2"><div class="title-header text-header">
  <div class="header-banner-container">
    <div class="header-banner">
      <p>Check out the communities for games that you play or games that you're curious about!</p>
    </div>
  </div>
  <h1 class="info-content">
    <span class="icon-container"></span>
    <span class="title-container">
      <span class="title">Communities</span>
    </span>
  </h1>
</div>
<div class="community-top-top-container">
  <span class="top-left-button title-search-button"><span class="symbol">Search</span><input data-action="/titles/search" name="query" class="title-search-title-id" minlength="2" maxlength="20" type="text" monospace="on" guide="Search Communities" cave_oninput="$(document.activeElement).trigger('input')"></span>
  
</div>

<div class="body-content" id="community-top" data-region="USA">

  <div class="news-label-content">

  </div>
  <?php
  if(isset($sessuid) == false){
    echo '<div id="community-top-guest-guide" class="tutorial-window">
    <p>Kamekverse is a Miiverse Clone made by SuperDumbMario2, with portal, 3ds, old and new offdevice layouts, private communities and more cool features. Click <a href="../login.php?r=n3ds">HERE</a> to log into your Kamekverse account</p>
  </div>';
  }
  ?>

  <div id="identified-user-banner" class="news-label us">
    <a href="https://ctr-d1.olv.app.nintendo.net/identified_user_posts?view_region_id=2" data-pjax="#body">
      <span class="title">Get the latest news here!</span>
      <span class="text">Posts from Verified Users</span>
    </a>
  </div>
  <div class="community-list">
    <div class="headline with-filter headline-<?php echo $con ?>">
      <h2>New Communities</h2>
        
    </div>
    <ul class="list-content-with-icon-and-text arrow-list" id="community-top-content">
    <?php
$sql = "SELECT * FROM community WHERE special = 0 AND private = 0 AND community_flair_id = '$con' ORDER BY pk DESC LIMIT 6";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $community){
    $id = $community["id"];
    $name = $community["name"];
    $flair_name = $community["flair_name"];
    echo '<a href="./community.php?id=' . $id . '" data-pjax="#body" class="scroll to-community-button"><li id="community" class="">
    
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  
  <div class="body">
    <div class="body-content">
        <span class="community-name title">' . $name . '</span>
          <span class="platform-tag platform-tag-' . $con . '"></span>
        <span class="text">' . $flair_name . '</span>
      
      
    </div>
  </div>
  
</li></a>';
  }
}
?>
    </ul>
    
    <a href="https://ctr-d1.olv.app.nintendo.net/communities/categories/3ds_all" class="more-button scroll" data-pjax="1">Show More</a>
    <h2 class="headline headline-special">Special</h2>
    <ul class="list-content-with-icon-and-text arrow-list" id="community-top-content">
    <?php
$sql = "SELECT * FROM community WHERE usergenerated = 0 AND special = 1 AND private = 0 ORDER BY pk DESC LIMIT 6";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $community){
    $id = $community["id"];
    $name = $community["name"];
    echo '<a href="./community.php?id=' . $id . '" data-pjax="#body" class="scroll to-community-button"><li id="community" class="">
    
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  
  <div class="body">
    <div class="body-content">
        <span class="community-name title">' . $name . '</span>
      
      
    </div>
  </div>
  
</li></a>';
  }
}
?>
    </ul>
  </div>
  <?php
  if(!isset($sessuid)){
    echo '<div id="guide-button-content">
    <a id="guide-button" href="https://ctr-d1.olv.app.nintendo.net/guide" class="big-button scroll" data-pjax="1">Miiverse Code of Conduct &amp; FAQs</a>
  </div>';
  }
  ?>

</div>

<div class="community-list-footer">
   <a href="./console_selector.php" class="platform-button-wii platform-button" data-pjax="1">Console Selector</a>
  <a href="./?view_platform=<?php echo $acon; ?>" class="platform-button" data-pjax="1"><?php echo $dacon; ?> Communities</a>
</div>

    </div>
  
</body></html>