<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en"><!--
  Archive processed by SingleFile 
  url: https://3ds-us.olv.nintendo.net/titles/14866558072985245728/14866558073038702637/new?view_id=00830715882b0000765748073208b476&page_param=%7B%22upinfo%22%3A%221491342839.48531%2C1491343029%2C1491343028.26671%22%2C%22reftime%22%3A%22-1491342839.48531%22%2C%22per_page%22%3A%2215%22%2C%22order%22%3A%22desc%22%7D 
  saved date: Tue Apr 04 2017 18:02:36 GMT-0400 (Eastern Daylight Time) 
 --><head><script type="text/javascript">Object.defineProperty(window.navigator, 'userAgent', { get: function(){ return 'Mozilla/5.0 (Nintendo 3DS/3) AppleWebKit/532.7 (KHTML, like Gecko) NX/1.8.9 miiverse/8.1.prod.US'; } });Object.defineProperty(window.navigator, 'vendor', { get: function(){ return ''; } });</script>
     <meta charset="utf-8">
     <title>Kamekverse</title>
     <link rel="stylesheet" type="text/css" href="./ass/n3ds.css">
     <script type="text/javascript" src="./ass/complete_en.js"></script>
   <link type="image/x-icon" rel="shortcut icon" href="data:text/html;base64,PGh0bWw+DQo8aGVhZD48dGl0bGU+NDA0IE5vdCBGb3VuZDwvdGl0bGU+PC9oZWFkPg0KPGJvZHkgYmdjb2xvcj0id2hpdGUiPg0KPGNlbnRlcj48aDE+NDA0IE5vdCBGb3VuZDwvaDE+PC9jZW50ZXI+DQo8aHI+PGNlbnRlcj5uZ2lueDwvY2VudGVyPg0KPC9ib2R5Pg0KPC9odG1sPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0K"></head>
     <div id="body" class="community-post-list" data-region-id="2">
 <?php
 $id = $_GET["id"];
 $sql = "SELECT * FROM community WHERE id = '$id'";
 if($result = mysqli_query($conn, $sql)){
  foreach($result as $community){
    $name = $community["name"];
    $desc = $community["description"];
    $flairid = $community["community_flair_id"];
    $special = $community["special"];
    echo '<div class="title-header with-header-banner">
    <div class="header-banner-container post-subtype-default-container">
        <img src="../cdn/community_banners/' . $id . '.png" height="168" width="400">
    </div>
  <h1 class="info-content">
    <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon" width="48" height="48"></span>
    <span class="title-container">
      <span class="title">' . $name . '</span>
    </span>
  </h1>';
  if($special == false){
    echo '<span class="platform-tag platform-tag-' . $flairid . '"></span>';
  }
echo '</div>



<div id="header-meta" class="header-meta-with-description">
  

  

  


</div>


<div class="community-info">
    <p class="text">' . $desc . '</p>
</div>';
  }
 }
 ?>
 <div class="body-content tab3-content">  <div class="tab-body">
       <div class="post-buttons-content with-memo-button">
         <a href="https://3ds-us.olv.nintendo.net/titles/14866558072985245728/14866558073038702637/post" class="post-button js-post-button " data-pjax="1"><span class="symbol">Post</span></a>
         
       </div>
   <div class="post-list list" data-olv-community-id="14866558073038702637"><?php
 $sql = "SELECT * FROM posts WHERE community_id = '$id' ORDER BY pk DESC";
 if($result = mysqli_query($conn, $sql)){
  foreach($result as $posts){
    $pid = $posts["id"];
    $body = $posts["body"];
    $yeahs = $posts["yeahs"];
    $replies = $posts["replies"];
    $feeling =  $posts["feeling"];
    $uid = $posts["creator_id"];
    $date = $posts["creation_date"];
    $yeahlist = $posts["yeahlist"];
    $badge = "";
    
    $sqlu = "SELECT * FROM accounts WHERE (id = '$uid')";
    if($result2 = mysqli_query($conn, $sqlu)) {
      foreach($result2 as $user){
        if($user["banned"] == 0 || $imadmin == 1 || $anarchy == true || $bans == false){
        $mii = $user["miidata"];
        $uname = $user["displayname"];
        $badge = $user["badge"];
        $banned = 0;
        $nickcolor = htmlentities($user["nickname_color"]);
        $nickcss = "";
        if(isset($nickcolor)){
        $nickcss = 'style=" color: ' . $nickcolor . ';"';
        }
        if(isset($_SESSION["id"])){
          foreach($blocklistar as $buid){
            if($uid === $buid){
              $banned = 1;
            }
          }
        }
        } else {
          $banned = 1;
        }
      }
    }
    if(isset($sessuid) == false){
      $sessuid = false;
    }
    $yeahlink = "\"../toggle_yeah.php?id=$pid&r=community&layout=n3ds\"";
    $id_in_yeahlist = strpos($yeahlist, $sessuid);
    $yeahdisable = "";
      $empathy_added = "";
      if(isset($_SESSION["id"]) == false){
        $yeahlink = "";
        $yeahdisable = "disabled";
      } elseif($id_in_yeahlist !== false){
        $empathy_added = "empathy-added";
      } elseif($_SESSION["id"] == $uid) {
        $yeahlink = "";
        $yeahdisable = "disabled";
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
    if($banned == 0){
    echo '<div id="post" class="post scroll post-subtype-default">
     <div class="body">
     <a href="./user.php?id=' . $uid . '" data-pjax="1" class="user-icon-container ' . $badge . ' scroll-focus"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon" width="32" height="32"></a>
     <div class="post-container">
       <div class="user-container">
         <p class="user-name"><a href="./user.php?id=' . $uid . '" data-pjax="1" ' . $nickcss . '>' . $uname . '</a></p>
         <p class="timestamp-container">
             <span class="timestamp">' . $date . '</span>
             
         </p>
       </div>      <div class="post-content">        <p class="post-content-text">
           <a href="./post.php?id=' . $pid . '" class="to-permalink-button" data-pjax="1" tabindex="0">' . $body . '</a>
         </p>        <div class="post-meta">
           <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button ' . $yeahdisable . '" data-feeling="normal"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a>
           <span class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></span><span class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></span>
         </div>
       </div>
     </div>
   </div>
 </div>';
} else {
  continue;
 }
  }
 }
 ?>  </div>
   
   </div>
 </div>
 </div>
   
 </body></html>