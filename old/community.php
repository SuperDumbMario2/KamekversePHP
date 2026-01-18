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
<!-- saved from url=(0121)https://web.archive.org/web/20150321110511/https://miiverse.nintendo.net/titles/14866558073007174237/14866558073007174239 -->
<html lang="en" data-sitecatalyst-suite-id="miiverseweb" data-account-server-origin="https://id.nintendo.net" class="os-win" style="--wm-toolbar-height: 67px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">










    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">
    <link rel="shortcut icon" href="../ass/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20150321110511im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?-Z4Fk7Q3nvDXr5zkiOrxuA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20150321110511im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?7BG8CXQUNg9puEyX86P55g">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20150321110511im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?gzQJApFdFdAqkVtWHcUP_A">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20150321110511im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?U-l5y2aDgriioqMnoD4Rzg">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
  </head>

  <body class=" guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">




 
    
    <div id="wrapper">
      <div id="sub-body">
        <?php include "./components/header.php"; ?>
      </div>


      
      <div id="main-body">

<?php
$id = mysqli_real_escape_string($conn, $_GET["id"]);
$sql = "SELECT * FROM community WHERE id='$id'";
if($result = mysqli_query($conn, $sql)) {
  foreach($result as $community) {
    $name = $community["name"];
    $lock = $community["locked"];
    $desc = $community["description"];
echo '<div id="page-title">' . $name . '</div><div class="header-banner-container"><img src="../cdn/community_banners/' . $id . '.png"></div>
<div id="community-content" class="" data-sitecatalyst-event="event51,event52" data-sitecatalyst-var-evar24="20" data-sitecatalyst-var-evar25="14866558073007174237" data-sitecatalyst-var-evar26="14866558073007174239" data-sitecatalyst-var-evar34="14866558073007174237:unplayed">
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>

  <span class="title">' . $name . '</span>
  <span class="text">' . $desc . '</span>
  
  
</div>';
  }}
?>


  




<div class="body-content" id="community-post-list" data-region="">
  
  <div class="list post-list">



<?php
$sql = "SELECT * FROM posts WHERE community_id = '$id'";
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
      $nahs = $posts["nahs"];
      $nahlist = $posts["nahlist"];
      $badge = "";
      
      $sqlu = "SELECT * FROM accounts WHERE (id = '$uid') ORDER BY pk DESC";
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
      $yeahlink = "\"../toggle_yeah.php?id=$pid&r=community&layout=old\"";
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
    echo '<div id="post" class="post trigger" tabindex="0">
  <a href="./user.php?id=" class="icon-container"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="icon"></a>
    <p class="timestamp-container">
      <a class="timestamp">' . $date . '</a>
    </p>
  <p class="user-name"><a href="./user.php?id=' . $uid . '">' . $username . '</a></p>
  <p class="community-container"><a href="./community.php?id=' . $id . '"><img src="../cdn/community_icons/' . $id . '.png" class="community-icon">' . $name . '</a></p>

  <div class="body">
    <div class="post-content">



      <p class="post-content-text">' . $body . '</p>


      <div class="post-meta">
        <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button" data-feeling="what"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a>
        <div class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></div>
        <div class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></div>
      </div>
    </div>




    
  </div>
</div>';
  } else {
    continue;
  }
}
}
?>




















































































































  </div>
</div>



      </div>
      <div id="footer">
        <div id="sidebar">
        </div>
        <p id="copyright"><a href="https://web.archive.org/web/20150321110511/http://www.nintendo.com/?country=US&amp;lang=en">© 2015 Nintendo</a></p>
      </div>
    </div>
  


</body></html>