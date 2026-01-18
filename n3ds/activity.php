<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Kamekverse</title>
    <link rel="stylesheet" type="text/css" href="./ass/n3ds.css">
    <script type="text/javascript" src="./ass/complete_en.js"></script>
  <link type="image/x-icon" rel="shortcut icon" href="data:text/html;base64,PGh0bWw+DQo8aGVhZD48dGl0bGU+NDA0IE5vdCBGb3VuZDwvdGl0bGU+PC9oZWFkPg0KPGJvZHkgYmdjb2xvcj0id2hpdGUiPg0KPGNlbnRlcj48aDE+NDA0IE5vdCBGb3VuZDwvaDE+PC9jZW50ZXI+DQo8aHI+PGNlbnRlcj5uZ2lueDwvY2VudGVyPg0KPC9ib2R5Pg0KPC9odG1sPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0K"></head>
  <body data-user-id="" data-is-first-post="1" data-is-first-favorite="1">
  <div id="body" class="activity" data-region-id="2"><div class="title-header text-header">
  <div class="header-banner-container">
    <div class="header-banner">
      <p>Here you can view posts and more from the users you follow.</p>
    </div>
  </div>
  <h1 class="info-content">
    <span class="icon-container"></span>
    <span class="title-container">
      <span class="title"><span>Activity Feed</span>
    </span>
  </span></h1>
</div>

<div class="body-content" id="activity-feed">

    <div class="list post-list" data-olv-community-id="">
      
       
    <?php
$sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $user){
    $fl = explode(", ", $user["following"]);
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
echo '<div id="post" data-href="/posts/AYMHAAADAAB2V0gP814W-g" class="post scroll post-subtype-default">
  
<p class="community-container">
  


  <a href="./community.php?id=' . $cid . '" class="test-post-target-href" data-pjax="1"><span class="community-container-inner"><img src="../cdn/community_icons/' . $cid . '.png" class="community-icon" width="14" height="14">' . $cname . '</span>
  </a>
</p>

<div class="body">
<a href="./user.php?id=' . $uid . '" data-pjax="1" class="user-icon-container scroll-focus ' . $badge . '"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon" width="32" height="32"></a>
<div class="post-container">
  <div class="user-container">
    <p class="user-name"><a href="./user.php?id=' . $uid . '" data-pjax="1">' . $username . '</a></p>
    <p class="timestamp-container">
        <span class="timestamp">' . $date . '</span>
        
    </p>
  </div>

  <div class="post-content">



    <p class="post-content-text">
      <a href="./post.php?id=' . $pid . '" class="to-permalink-button" data-pjax="1" tabindex="0">' . htmlentities($body) . '</a>
    </p>

    <div class="post-meta">
      <a href="../toggle_yeah.php?id=' . $pid . '&r=activity&layout=n3ds"><button type="button" class="symbol submit empathy-button" data-feeling="surprised" data-action="/posts/AYMHAAADAAB2V0gP814W-g/empathies"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a>
      <span class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></span><span class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></span>
    </div>
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
    </div>

</div>
</div>
  
</body></html>