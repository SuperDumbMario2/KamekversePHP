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
<!-- saved from url=(0121)https://web.archive.org/web/20160307150210/https://miiverse.nintendo.net/titles/14866558073037299863/14866558073037299866 -->
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" prefix="og: http://ogp.me/ns#" class="os-win" style="--wm-toolbar-height: 1px;"><

    
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
    $id = $_GET["id"];
      echo "<style>
      #wrapper {
        background: #eeeeee url('../cdn/community_banners/$id.png');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  background-attachment: fixed;
    }
      </style>";
    ?>


</head>

  <body class="community-top guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      


<?php include "./components/header.php" ?>

      
      <div id="main-body">


<?php
$id = mysqli_real_escape_string($conn, $_GET["id"]);
$sql = "SELECT * FROM community WHERE id='$id'";
if($result = mysqli_query($conn, $sql)) {
  foreach($result as $community) {
    $name = $community["name"];
    $lock = $community["locked"];
    $blue_badges = $community["blue_badges"];
    $golden_badges = $community["golden_badges"];
    $priv = $community["private"];
    $creator_id = $community["creator_id"];
    $userlist = $community["allowed_userlist"];
    if($imadmin == false && $priv == 1){
      if(isset($sessuid)){
        $me_in_userlist = strpos($sessuid, $userlist);
      if($me_in_userlist === false){
        die("This account is not allowed to access this private community.");
      }
      } else {
        die("log in pls");
      }
    }
    $desc = $community["description"];
    $community_flair_id = $community["community_flair_id"];
echo '<div id="sidebar">
  <section class="sidebar-container" id="sidebar-community">
      <span id="sidebar-cover">
        <a href=./community.php?id=' . $id . '>
          <img src="../cdn/community_banners/' . $id . '.png">
        </a>
      </span>
    <header id="sidebar-community-body">
      <span id="sidebar-community-img">
        <span class="icon-container">
        <a href=./community.php?id=' . $id . '>
            <img src="../cdn/community_icons/' . $id . '.png" class="icon">
          </a>
        </span>
        <span class="platform-tag">
            <img src="../cdn/community_flair_icons/' . htmlentities($community_flair_id) . '.png">
        </span>
      </span>';
      if(isset($blue_badges) && mb_strlen($blue_badges) > 0){
        $ex_blue_badges = explode(", ", $blue_badges);
        foreach($ex_blue_badges as $blue_badge){
          echo '<span class="news-community-badge">' . htmlentities($blue_badge) . '</span>';
        }
      }

      if(isset($golden_badges) && mb_strlen($golden_badges) > 0){
        $ex_golden_badges = explode(", ", $golden_badges);
        foreach($ex_golden_badges as $golden_badge){
          echo '<span class="news-community-badge" style="background: #ffbb00 !important;">' . htmlentities($blue_badge) . '</span>';
        }
      }

      echo '<h1 class="community-name">
      <a href=./community.php?id=' . $id . '>' . htmlentities($name) . '
        </a>      </h1>
    </header>
      <div class="community-description js-community-description">
        
          <p class="text js-full-text">' . htmlentities($desc) . '</p>
          
      </div>
    <div class="sidebar-setting">
      
    </div>
  </section>';
}
}
    ?>

  <?php
  if(isset($_SESSION["id"]) || $lock !== true && $anarchy !== false && $imadmin !== false){
    echo '<a href="./create_post.php?community=' . $id . '" class="button">Create Post</a>';
  }
  if(isset($_SESSION["id"]) && $creator_id == $sessuid){
    echo '<a href="./settings_community.php?id=' . $id . '" class="button">Edit this community...</a>';
  }
  ?>
</div>



<div class="body-content main-column" id="community-post-list" data-region="">
  
  
  
  <div class="via_api" id="via_api-post-list">
    <div class="post-list-outline">
      <h2 class="label label-via_api symbol">
        <span class="label-via_api-msgid">
          Posts
        </span>
      </h2>
<?php
$sql = "SELECT * FROM posts WHERE (community_id = '$id') ORDER BY pk DESC";
if($result = mysqli_query($conn, $sql)) {
  if(mysqli_num_rows($result) != 0){
    $counter = 0;
    foreach($result as $posts){
      $pid = $posts["id"];
      $pid_old = $posts["id_old"];
      $p_is_old = $posts["is_old"];
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
          if(isset($_SESSION["id"])){
            foreach($blocklistar as $buid){
              if($uid === $buid){
                $banned = 1;
              }
            }
          }
          if(isset($nickcolor)){
          $nickcss = 'style=" color: ' . $nickcolor . ';"';
          }
          } else {
            $banned = 1;
          }
        }
      }
      if(isset($sessuid) == false){
        $sessuid = false;
      }
      $yeahlink = "\"./toggle_yeah.php?id=$pid&r=community\"";
      $nahlink = "\"./toggle_nah.php?id=$pid&r=community\"";
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
      echo '      <div class="post-body test-default-post-list-body">
      <div class="list multi-timeline-post-list js-post-list"><div id="post" class="post post-subtype-default trigger" tabindex="0">

  

  <div class="body">
    <div class="post-content" onclick="window.open(\'post.php?id=' . $pid . '\')">
          
          <a href="./user.php?id=' . $uid . '" class="icon-container ' . $badge . '" data-pjax="#body"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="icon"></a>
          
          <p class="user-name"><a href="./user.php?id=' . $uid . '" data-pjax="#body" ' . $nickcss . '>' . htmlentities($username) . '</a></p>
          
            <p class="timestamp-container">
              <a class="timestamp" href="./post.php?id=' . $pid . '" data-pjax="#body">' . $date . '</a>
            </p>
        





            <p class="post-content-text">' . htmlentities($body) . '</p>';
            if($posts["has_image"] == true){
              if($p_is_old == true){
                echo '<p class="post-content-memo"><img src="../cdn/post_images/' . $pid_old . '.png" class="post-memo"></p>';
              } else {
                echo '<p class="post-content-memo"><img src="../cdn/post_images/' . $pid . '.png" class="post-memo"></p>';
              }
            }
            echo '</div>
        <div class="post-meta">
        <a href=' . $yeahlink . '>
        <button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button" data-feeling="like" data-community-id="14866558073037299866" data-url-id="AYMHAAACAAADVHk4ocUnrw" data-track-label="default" data-title-id="14866558073037299863" data-track-action="yeah" data-track-category="empathy"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a><a href=' . $nahlink . '>
        <button type="button" ' . $nahdisable . ' class="symbol submit empathy-button empathy-button-nah" data-feeling="like" data-community-id="14866558073037299866" data-url-id="AYMHAAACAAADVHk4ocUnrw" data-track-label="default" data-title-id="14866558073037299863" data-track-action="yeah" data-track-category="empathy"><span class="empathy-button-text">' . $nahbutton . '</span></button></a>
          <div class="empathy ' . $empathy_added . ' symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></div>
          <div class="nah ' . $notmii_added . ' symbol"><span class="symbol-label">Nahs</span><span class="empathy-count">' . $nahs . '</span></div>
          <div class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></div>
        </div>

  </div>
</div>
</div>
</div>
';

} else {
  continue;
}
    }
  }
  else {
    echo "This community have no posts yet. Why not create one now?";
  }
}
?>

      </div>
    </div>
        
  </div>



</div>
</div>
</div>





    </div>
    
  

    <div>
        <div id="footer-inner">





          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2</p>
          </div>
        </div>
      </div>
</body></html>