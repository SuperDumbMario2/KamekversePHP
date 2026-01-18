<?php 
include "./dbconnect.php";
include "./cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<!DOCTYPE html>
<!-- saved from url=(0121)https://web.archive.org/web/20160307150210/https://miiverse.nintendo.net/titles/14866558073037299863/14866558073037299866 -->
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" prefix="og: http://ogp.me/ns#" class="os-win" style="--wm-toolbar-height: 1px;">

    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">

    
    
    <link rel="shortcut icon" href="./ass/favicon.png?mM9KNw_M04SIP2y9VGgdNA">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20160307150210im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20160307150210im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20160307150210im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20160307150210im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
    <?php
    if(isset($_COOKIE["themes"])){
      $themes = $_COOKIE["themes"];
      $themelist = explode(", ", $themes);
      foreach($themelist as $theme){
        echo '<link rel="stylesheet" type="text/css" href="./ass/' . $theme . '.css">';
      }
    }
    ?></head>

  <body class="community-top guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      <?php include "./components/header.php" ?>

      
      <div id="main-body">

      <div class="main-column"><div class="post-list-outline">

  
<h2 class="label">All Posts    </h2><div class="list post-list js-post-list" data-next-page-url="/users/kimberlyfrye/posts?page_param=%7B%22upinfo%22%3A%221502174494.21074%2C1508736463%2C1508736462.28421%22%2C%22reftime%22%3A%22-1502174494.21074%22%2C%22order%22%3A%22desc%22%2C%22per_page%22%3A%2225%22%7D&amp;view_id=008307158013000003578e27ab272a58">
<a href="./activity.php">Looking for activity feed?</a>
<?php
$sql = "SELECT * FROM posts ORDER BY pk DESC";
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
$sqlc = "SELECT * FROM community WHERE id = '$cid'";
if($result3 = mysqli_query($conn, $sqlc)) {
foreach($result3 as $community){
  $cname = $community["name"];
}
}
if(isset($sessuid) == false){
$sessuid = false;
}
$yeahlink = "\"./toggle_yeah.php?id=$pid&r=feed\"";
$nahlink = "\"./toggle_nah.php?id=$pid&r=feed\"";
$id_in_yeahlist = strpos($yeahlist, $sessuid);
$id_in_nahlist = strpos($nahlist, $sessuid);
$yeahdisable = "";
      $nahdisable = "";
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
      if($id_in_nahlist == false){
        if(!isset($_SESSION["betastyle"]) || $_SESSION["betastyle"] == false){
        if($feeling == "happy" || str_starts_with($feeling, "normal") || str_starts_with($feeling, "blink")){
          $nahbutton = "Nah.";
        }
        elseif(str_starts_with($feeling, "like") || str_starts_with($feeling, "wink")){
          $nahbutton = "Nah!";
        }
        elseif($feeling == "frustrated" || $feeling == "puzzled" || str_starts_with($feeling, "sorrow")){
          $nahbutton = "Nah...";
        }
        elseif($feeling == "surprised" || str_starts_with($feeling, "anger") || str_starts_with($feeling, "surprise")){
          $nahbutton = "Nah?!";
        }
        elseif(preg_match('/^\d+$/', $feeling)){
          if($feeling == "25" || $feeling == "26"){
            $nahbutton = "Nah!";
          } else {
            $nahbutton = "Nah.";
          }
        }
        else{
          $nahbutton = "kamekverse.portal.notmii";
        }
      } else {
        $nahbutton = "Not mii";
      }
      }
      else{
        $nahbutton = "Unnah";
      }
      if($banned == 0){
        echo '<div id="post" class="post post-subtype-default trigger" tabindex="0"><p class="community-container"><a class="test-community-link" href="./community.php?id=' . $cid . '"><img src="./cdn/community_icons/' . $cid . '.png" class="community-icon">' . $cname . '</a></p><a href="./user.php?id=' . $uid . '" class="icon-container ' . $badge . '"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="icon"></a><p class="user-name"><a ' . $nickcss . '>' . $username . '</a></p>
<p class="timestamp-container">
  <a class="timestamp" href="./post.php?id=' . $pid . '">' . $date . '</a>
</p>

<div class="body">
<div class="post-content"">

    <div class="tag-container">

    </div>    <p class="post-content-text" onclick="window.open(\'post.php?id=' . $pid . '\')">' . markdownToHTML(htmlentities($body)) . '</p>';
    if($posts["has_image"] == true){
      if(!$pis_old){
        echo '<div class="screenshot-container still-image"><img src="./cdn/post_images/' . $pid . '.png"></div>';
      } else {
        echo '<div class="screenshot-container still-image"><img src="./cdn/post_images/' . $pid_old . '.png"></div>';
      }
    } 
    echo '

    <div class="post-meta">
    <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button ' . $yeahdisable . '" data-is-in-reply-list="1" data-feeling="normal" data-community-id="14866558073037299866" data-url-id="AYMHAAACAAADVHlAEFNvVw" data-track-label="reply" data-title-id="14866558073037299863" data-track-action="yeah" data-track-category="empathy"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a><a href=' . $nahlink . '><button type="button" ' . $nahdisable . ' class="symbol submit empathy-button empathy-button-nah ' . $nahdisable . '" data-is-in-reply-list="1" data-feeling="normal" data-community-id="14866558073037299866" data-url-id="AYMHAAACAAADVHlAEFNvVw" data-track-label="reply" data-title-id="14866558073037299863" data-track-action="yeah" data-track-category="empathy"><span class="empathy-button-text">' . $nahbutton . '</span></button></a>
      <div class="empathy ' . $empathy_added . ' symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></div>
      <div class="nah ' . $notmii_added . ' symbol"><span class="symbol-label">Nahs</span><span class="empathy-count">' . $nahs . '</span></div>
      <div class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></div><div class="played symbol"><span class="symbol-label">Played</span></div>
    </div>
</div>
</div>
</div>';
      } else {
        continue;
      }
} 
}}
?>

      </div>
    </div>
        
  </div>
</div>
</div>
</div>

<div>
        <div id="footer-inner">          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2</p>
          </div>
        </div>
      </div>
    </div>
  </body></html>