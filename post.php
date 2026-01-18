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
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" prefix="og: http://ogp.me/ns#" class="os-win" style="--wm-toolbar-height: 1px;"><head>    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">        
    <link rel="shortcut icon" href="./ass/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20160325202841im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20160325202841im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20160325202841im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20160325202841im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
    <?php
    if(isset($_COOKIE["themes"])){
      $themes = $_COOKIE["themes"];
      $themelist = explode(", ", $themes);
      foreach($themelist as $theme){
        echo '<link rel="stylesheet" type="text/css" href="./ass/' . $theme . '.css">';
      }
    }
    ?>
      </head>  <body id="post-permlink" class=" guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      
<?php include "./components/header.php" ?>      
      <div id="main-body"><div class="main-column"><div class="post-list-outline"><?php
if(isset($_GET['id'])) {
$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE (id='$id') ORDER BY pk DESC";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) != 0) {
    foreach($result as $post) {
      $pid = $post["id"];
      $pid_old = $post["id_old"];
      $pis_old = $post["is_old"];
      $body = $post["body"];
      $yeahs = $post["yeahs"];
      $replies = $post["replies"];
      $feeling =  $post["feeling"];
      $uid = mysqli_real_escape_string($conn, $post["creator_id"]);
      $cid = mysqli_real_escape_string($conn, $post["community_id"]);
      $date = $post["creation_date"];
      $yeahlist = $post["yeahlist"];
      $nahs = $post["nahs"];
      $nahlist = $post["nahlist"];
      $badge = "";
      $sqlu = "SELECT * FROM accounts WHERE id = '$uid'";
      if($result2 = mysqli_query($conn, $sqlu)) {
        foreach($result2 as $user){
          if($user["banned"] == 0 || $imadmin == 1 || $anarchy == true || $bans == false){
          $mii = $user["miidata"];
          $displayname = $user["displayname"];
          $username = $user["username"];
          $badge = $user["badge"];
          $nickcolor = htmlentities($user["nickname_color"]);
    $nickcss = "";
    if(isset($nickcolor)){
      $nickcss = 'style=" color: ' . $nickcolor . ';"';
    }
          } else {
            die('<div class="no-content track-error" data-track-error="403">
    <div>
      <p>This post is hidden.
      </p>
    </div>
  </div>');
          }
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
      $yeahlink = "\"./toggle_yeah.php?id=$pid&r=post\"";
      $nahlink = "\"./toggle_nah.php?id=$pid&r=post\"";
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
      } 
      if($id_in_yeahlist !== false && $id_in_nahlist === false){
        $nahlink = "";
        $nahdisable = "disabled";
        $empathy_added = "empathy-added";
      } 
      if($id_in_yeahlist === false && $id_in_nahlist !== false){
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
      if(isset($cname)){
      }
      else{
        $cname = "Undefined Community ID " . htmlentities($cid);
      }
echo '<section id="post-content" class="post post-subtype-default">  <header class="community-container">
    
  
    <h1 class="community-container-heading">
      <a href="./community.php?id=' . htmlentities($cid) . '"><img src="./cdn/community_icons/' . htmlentities($cid) . '.png" class="community-icon">' . htmlentities($cname) . '</a>
    </h1>
  </header>  <div class="user-content">
    <a href="./user.php?id=' . $uid . '" class="icon-container ' . $badge . '"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=" . htmlentities($feeling) . "" . '" class="icon"></a>
    <div class="user-name-content">
      <p class="user-name"><a href="./user.php?id=' . $uid . '" ' .$nickcss . '>' . htmlentities($displayname) . '</a><span class="user-id">' . htmlentities($username) . '</span></p>
      <p class="timestamp-container">
        <span class="timestamp">' . $date . '</span>
        
      </p>
    </div>
  </div>
  <div class="body">      <p class="post-content-text">' . markdownToHTML(htmlentities($body)) . '</p>
          ';
          if($post["has_image"] == true){
            if(!$pis_old){
              echo '<div class="screenshot-container still-image"><img src="./cdn/post_images/' . $id . '.png"></div>';
            } else {
              echo '<div class="screenshot-container still-image"><img src="./cdn/post_images/' . $pid_old . '.png"></div>';
            }
          }
          echo '<div class="post-meta">
      <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a>
      <a href=' . $nahlink . '><button type="button" ' . $nahdisable . ' class="symbol submit empathy-button empathy-button-nah"><span class="empathy-button-text">' . $nahbutton . '</span></button></a>
      <div class="empathy ' . $empathy_added . ' symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></div>
      <div class="nah ' . $notmii_added . ' symbol"><span class="symbol-label">Nahs</span><span class="empathy-count">' . $nahs . '</span></div>
      <div class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></div><div class="played symbol"><span class="symbol-label">Played</span></div>
    </div>
  </div>
</section>';
}
} else {
  die("The specified post does not exist.");
}
}
} else {
  die("No post specified.");
}
?>
  
  
<div id="reply-content">
  <h2 class="reply-label">Comments</h2><ul class="list reply-list test-reply-list">
<?php
$sql = "SELECT * FROM comments WHERE (post_id='$id')";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) != 0){
    foreach($result as $comment) {
      $coid = $comment["id"];
      $uid = $comment["creator_id"];
      $body = $comment["body"];
      $yeahs = $comment["yeahs"];
      $yeahlist = $comment["yeahlist"];
      $nahs = $comment["nahs"];
      $nahlist = $comment["nahlist"];
      $date = $comment["creation_date"];
      $feeling = $comment["feeling"];
      $sqlu = "SELECT * FROM accounts WHERE (id = '$uid')";
      if($result2 = mysqli_query($conn, $sqlu)) {
        foreach($result2 as $user){
          $mii = $user["miidata"];
          $displayname = $user["displayname"];
          $badge = $user["badge"];
          $nickcolor = htmlentities($user["nickname_color"]);
    $nickcss = "";
    if(isset($nickcolor)){
      $nickcss = 'style=" color: ' . $nickcolor . ';"';
    }
        }
      }
      $id_in_yeahlist = strpos($yeahlist, $sessuid);
      $id_in_nahlist = strpos($nahlist, $sessuid);
      $yeahdisable = "";
      $nahdisable = "";
      $yeahlink = "\"./toggle_yeah.php?mode=comment&id=$coid&r=post\"";
      $nahlink = "\"./toggle_nah.php?mode=comment&id=$coid&r=post\"";
      if(isset($_SESSION["id"]) == false){
        $yeahlink = "";
        $nahlink = "";
        $yeahdisable = "disabled";
        $nahdisable = "disabled";
      } elseif($id_in_yeahlist !== false && $id_in_nahlist === false){
        $nahlink = "";
        $nahdisable = "disabled";
      } elseif($id_in_yeahlist === false && $id_in_nahlist !== false){
        $yeahlink = "";
        $yeahdisable = "disabled";
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
      echo '<li id="reply" class="post other trigger">
  <a href="./user.php?id=' . htmlentities($uid) . '" class="icon-container ' . $badge . '"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=" . htmlentities($feeling) . "" . '" class="icon"></a>
  <div class="body">
    <div class="header">
      <p class="user-name"><a href="./user.php?id=' . $uid . '" ' . $nickcss . '>' . htmlentities($displayname) . '</a></p>
      <p class="timestamp-container">
        <a class="timestamp">' . $date . '</a>
      </p>
    </div>    <p class="reply-content-text">' . markdownToHTML(htmlentities($body)) . '</p>
<div class="reply-meta">
    <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button ' . $yeahdisable . '" data-is-in-reply-list="1" data-feeling="normal" data-community-id="14866558073037299866" data-url-id="AYMHAAACAAADVHlAEFNvVw" data-track-label="reply" data-title-id="14866558073037299863" data-track-action="yeah" data-track-category="empathy"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a><a href=' . $nahlink . '><button type="button" ' . $nahdisable . ' class="symbol submit empathy-button empathy-button-nah ' . $nahdisable . '" data-is-in-reply-list="1" data-feeling="normal" data-community-id="14866558073037299866" data-url-id="AYMHAAACAAADVHlAEFNvVw" data-track-label="reply" data-title-id="14866558073037299863" data-track-action="yeah" data-track-category="empathy"><span class="empathy-button-text">' . $nahbutton . '</span></button></a>
        <div class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></div>
        <div class="nah symbol"><span class="symbol-label">Nahs</span><span class="empathy-count">' . $nahs . '</span></div>
    </div>
  </div>
</li>';
    }
  }
}
?></ul></div>
<h2 class="reply-label">Add a Comment</h2><?php
if(isset($_SESSION["id"])){
  echo '<a href="./create_comment.php?post=' . $id . '" class="button">Create a Comment</a>';
}
else{
echo "<div class=\"guest-message\">
  <p>You must sign in to post a comment.<br>
<br>
Sign in using a Kamekverse ID to connect to users around the world by writing posts and comments and by giving Yeahs to other people's posts. You can create a Kamekverse ID using the website.</p>
  
  
</div>";
}
?></div></div>  </div>
      <div id="footer">
        <div id="footer-inner">
      <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2</p>
          </div>
        </div>
      </div>
    </div>
  
</div><div class="mask none"></div></body></html>