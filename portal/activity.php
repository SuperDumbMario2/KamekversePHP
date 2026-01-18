<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1"><!--
  Archive processed by SingleFile 
  url: https://portal-us.olv.nintendo.net/titles/14866558072985245728/14866558073038702637 
  saved date: Sun Apr 23 2017 12:50:52 GMT-0400 (Eastern Daylight Time) 
 --><head><link rel="stylesheet" type="text/css" href="./ass/portal.css">
 <script type="text/javascript" src="./ass/complete-emu.js"></script>
 <script type="text/javascript" src="./ass/complete-en.js"></script>
   <link type="image/x-icon" rel="shortcut icon" href="data:text/plain;base64,bm90IGZvdW5k"></head>
   <title>Kamekverse</title>
   <body>
   <?php include "./components/header.php" ?>
 
   <div id="body"><title>Activity Feed</title>
<header id="header">
  
  
  <h1 id="page-title" class="left">Activity Feed</h1>
  

</header>

<div class="body-content js-post-list post-list" id="activity-feed" data-next-page-url="/?page_param=%7B%22upinfo%22%3A%221493216174%2C1493244531%2C1493244535.3865%22%2C%22reftime%22%3A%22-1493216174%22%2C%22order%22%3A%22desc%22%2C%22per_page%22%3A%2220%22%7D&amp;view_id=00830715984800007657480eac9b0f8a">
    
      
        

<?php
$sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $user){
    $fl = explode(", ", $user["follows"]);
    foreach($fl as $friend){
      $sql = "SELECT * FROM posts WHERE creator_id = '$friend' ORDER BY pk DESC";
if($result = mysqli_query($conn, $sql)){
foreach($result as $posts){
$pid = htmlentities($posts["id"]);
$pid_old = htmlentities($posts["id_old"]);
$pis_old = htmlentities($posts["is_old"]);
$body = htmlentities($posts["body"]);
$yeahs = htmlentities($posts["yeahs"]);
$replies = htmlentities($posts["replies"]);
$feeling =  htmlentities($posts["feeling"]);
$uid = htmlentities($posts["creator_id"]);
$cid = mysqli_real_escape_string($conn, $posts["community_id"]);
$date = htmlentities($posts["creation_date"]);
$yeahlist = htmlentities($posts["yeahlist"]);
$nahlist = htmlentities($posts["nahlist"]);
$nahs = htmlentities($posts["nahs"]);
$cname = "Undefined community ID $cid";
$sqlu = "SELECT * FROM accounts WHERE (id = '$uid')";
    if($result2 = mysqli_query($conn, $sqlu)) {
      foreach($result2 as $user){
        if($user["banned"] == 0 || $imadmin == 1 || $anarchy == true || $bans == false){
        $mii = $user["miidata"];
        $username = $user["displayname"];
        $badge = $user["badge"];
        $banned = 0;
        $nickcolor = htmlentities($user["nickname_color"]);
          $nickcss = "";
          if(isset($nickcolor)){
          $nickcss = 'style=" color: ' . $nickcolor . ';"';
          }
        } else {
          $banned = 1;
        }
      }
$sqlc = "SELECT * FROM community WHERE id = '$cid'";
if($result3 = mysqli_query($conn, $sqlc)) {
foreach($result3 as $community){
  $cname = $community["name"];
}
}
if(isset($sessuid) == false){
$sessuid = false;
}
$id_in_yeahlist = strpos($yeahlist, $sessuid);
$id_in_nahlist = strpos($nahlist, $sessuid);
$yeahdisable = "";
      $nahdisable = "";
      $yeahlink = "\"./toggle_yeah.php?id=$pid&r=activity\"";
      $nahlink = "\"./toggle_nah.php?id=$pid&r=activity\"";
      $empathy_added = "";
      $notmii_added = "";
      if(isset($_SESSION["id"]) == false){
        $yeahlink = "";
        $nahlink = "";
        $yeahdisable = "disabled";
        $nahdisable = "disabled";
      } elseif($id_in_yeahlist !== false && $id_in_nahlist === false){
        $nahlink = "";
        $nahdisable = "disabled";
        $empathy_added = "empathy-added";
      } elseif($id_in_yeahlist === false && $id_in_nahlist !== false){
        $yeahlink = "";
        $yeahdisable = "disabled";
        $notmii_added = "notmii-added";
      } 
      if(isset($sessuid) && $sessuid == $uid){
        $yeahlink = "";
        $nahlink = "";
        $yeahdisable = "disabled";
        $nahdisable = "disabled";
      }
      if($id_in_yeahlist == false){
        if(!isset($_SESSION["betastyle"]) || $_SESSION["betastyle"] == false){
          if($feeling == "happy" || str_starts_with($feeling, "normal") || str_starts_with($feeling, "blink")){
            $yeahbutton = "Yeah!";
          }
          elseif(str_starts_with($feeling, "like") || str_starts_with($feeling, "wink")){
            $yeahbutton = "Yeah♥";
          }
          elseif($feeling == "frustrated" || $feeling == "puzzled" || str_starts_with($feeling, "sorrow")){
            $yeahbutton = "Yeah...";
          }
          elseif($feeling == "surprised" || str_starts_with($feeling, "anger") || str_starts_with($feeling, "surprise")){
            $yeahbutton = "Yeah?!";
          }
          elseif(preg_match('/^\d+$/', $feeling)){
            if($feeling == "25" || $feeling == "26"){
              $yeahbutton = "Yeah♥";
            } else {
              $yeahbutton = "Yeah!";
            }
          }
          else{
            $yeahbutton = "kamekverse.portal.miitoo";
          }
        } else {
          $yeahbutton = "Mii too";
        }
      }
      else{
        $yeahbutton = "Unyeah";
      }
echo '<div id="post-AYMHAAADAAB2V0gOqv2RZw" class="post scroll post-subtype-default" data-post-permalink-url="/posts/AYMHAAADAAB2V0gOqv2RZw">
<a href="./user.php?id=' . $uid . '" class="user-icon-container scroll-focus  ' . $badge . '" data-pjax="#body"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon"></a>
<div class="post-body-content">
  <div class="post-body">
    <header>
      <span class="user-name" ' . $nickcss . '>' . $username . '</span>
      <span class="timestamp">' . $date . '</span>
      
      
    </header>          

      <a href="./community.php?id=' . $cid . '" class="community-content test-post-target-href" data-pjax="#body">
        <span class="title-icon-container" data-pjax="#body"><img src="../cdn/community_icons/' . $cid . '.png" class="title-icon"></span>
        <span class="community-name">' . $cname . '</span>
      </a>
    

    <div class="post-content">



          <p class="post-content-text">' . htmlentities($body) . '</p>
    </div>


    <div class="post-meta">
      <button type="button" class="submit miitoo-button" data-feeling="normal" data-action="/posts/AYMHAAADAAB2V0gOqv2RZw/empathies" data-sound="SE_WAVE_MII_ADD" data-community-id="14866558073038702637" data-url-id="AYMHAAADAAB2V0gOqv2RZw" data-track-label="default" data-title-id="14866558072985245728" data-track-action="yeah" data-track-category="empathy">' . $yeahbutton . '</button>
      <a href="https://portal-us.olv.nintendo.net/posts/AYMHAAADAAB2V0gOqv2RZw" class="to-permalink-button" data-pjax="#body">
        <span class="feeling">' . $yeahs . '</span>
        <span class="reply">' . $replies . '</span>
      </a>
    </div>
  </div>
</div>
</div>';
}
}}
    }
  }
}
?>
</div></div>
 
   
 
 <button type="button" class="accesskey-L" style="display: none;"></button><button type="button" class="accesskey-R" style="display: none;"></button><button type="button" class="accesskey-Y" style="display: none;"></button></body></html>