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
<html lang="en"><head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <title><?php echo $site_name; ?></title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="<?php echo $site_name; ?>">
    <meta name="description" content="Kamekverse is a miiverse clone made in php by SuperDumbMario2.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS, miiverse clone, superdumbmario2">

    <meta property="og:title" content="<?php echo $site_name; ?>">
    <meta property="og:type" content="article">
    <meta property="og:description" content="Kamekverse is a miiverse clone made in php by SuperDumbMario2.">
    <meta property="og:site_name" content="<?php echo $site_name; ?>">

    

    
    <link rel="shortcut icon" href="./ass/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20160304013611im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20160304013611im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20160304013611im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20160304013611im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
    <script type="text/javascript" src="./ass/complete_en.js"></script>
      
</head>

  <body class="guest-top guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
        <?php include "./components/header.php" ?>

      
      <div id="main-body">
      <div id="about">
<?php
if(isset($_SESSION["id"]) == false){
  echo '
  <div id="about-inner">
    <div id="about-text">
      <h2 class="welcome-message">Welcome to ' . $site_name . '!</h2>
      <p>' . $site_name . ' is an another one Miiverse Clone™ made by SuperDumbMario2. It is the first clone to offer a full access to both the offdevice, portal (Wii U) and 3DS layouts. </p>
      <div class="guest-terms-content">
        <a class="symbol guest-terms-link test-guest-terms " href="./use.php">Use of ' . $site_name . '</a>
      </div>
    </div>
    <img src="./ass/welcome-image.png">
  </div>';
}
?>
</div>
<?php
if($note == true){
  echo '<div style="padding:15px 35px 15px 15px;margin-bottom:20px;border:1px solid #bce8f1;border-radius:4px;color:#31708f;background-color:#d9edf7">
<b>Note</b>: ' . $notecontent . '
<a href="#" style="float:right;font-size:21px;font-weight:700;line-height:1;text-shadow:0 1px 0 #fff;opacity:.2;filter:alpha(opacity=20);text-decoration:none;position:relative;top:-2px;right:-21px;color:inherit" onclick="event.preventDefault();$(this).parent().remove()">×</a>
</div>';
}
?>
<div class="body-content" id="community-top" data-region="USA">
          <?php 
          $sql = "SELECT * FROM posts WHERE featured = '1' ORDER  BY pk DESC LIMIT 1";
          if($result = mysqli_query($conn, $sql)){
            foreach($result as $post){
              $pid = $post["id"];
              $pid_old = $post["id_old"];
              $pis_old = $post["is_old"];
              $imagepath = "./cdn/post_images/feature_default.png";
              if(!$pis_old){
                if(file_exists('./cdn/post_images/' . $pid . '.png')) {
                  $imagepath = './cdn/post_images/' . $pid . '.png';
                }
              } else {
                if(file_exists('./cdn/post_images/' . $pid_old . '.png')) {
                  $imagepath = './cdn/post_images/' . $pid_old . '.png';
                }
              }
              
              $content = $post["body"];
              $feeling = $post["feeling"];
              $uid = $post["creator_id"];
              $sqlu = "SELECT * FROM accounts WHERE id = '$uid'";
              if($result = mysqli_query($conn, $sqlu)){
                foreach($result as $user){
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
              $cid = $post["community_id"];
              $sqlc = "SELECT * FROM community WHERE id = '$cid'";
      if($result3 = mysqli_query($conn, $sqlc)) {
        foreach($result3 as $community){
          $cname = $community["name"];
          $flairid = $community["community_flair_id"];
          $flair = $community["flair_name"];
        }
      }
              echo '<div class="community-main">
                  <div id="community-eyecatch">
                    <div id="community-eyecatch-main"><div class="eyecatch-diary-post js-eyecatch-diary-post test-eyecatch-diary-post"">
            <a href="./post.php?id=' . $pid . '" class="community-eyecatch-image test-community-eyecatch-image" style="background-image: url(\'' . $imagepath . '\')">
              <span class="icon-container">
                <img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=" . htmlentities($feeling) . "" . '" alt="profile" class="icon community-eyecatch-usericon test-community-eyecatch-usericon">
              </span>
              <p class="community-eyecatch-balloon test-community-eyecatch-balloon"><span>' . $content . '</span></p>
            </a>
            <a href="./community.php?id=' . $cid . '" class="community-eyecatch-info test-community-eyecatch-info-link">
              <img src="./cdn/community_icons/' . $cid . '.png" width="40" height="40" class="community-eyecatch-infoicon test-community-eyecatch-infoicon">
              <h4 class="community-game-title test-community-game-title" data-index="1">' . $cname . '</h4>
              <p class="community-game-device test-community-game-device">
                  <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $flairid . '.png"></span>
                <span class="text test-community-device-text">' . $flair . '</span>
              </p>
            </a>
          </div>
          </div>
          </div>
        </div>'; 
            }
          }
          ?>
  <div class="community-top-sidebar">
  <form method="GET" action="./search.php" class="search">
      <input type="text" name="query" placeholder="Search Communities" minlength="2" maxlength="20"><input type="submit" value="q" title="Search">
    </form>
    <div id="identified-user-banner">
      <a href="./verifiedposts.php" data-pjax="#body" class="list-button us">
        <span class="title">Get the latest news here!</span>
        <span class="text">Posts from Verified Users</span>
      </a>
    </div>      </div>

  <div class="community-main">
  <h3 class="community-title symbol">Featured Communities</h3>
  <div>
        <ul class="list community-list community-card-list test-hot-communities">
<?php 
$sql = "SELECT * FROM community WHERE featured = 1 ORDER BY pk DESC LIMIT 6";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $community) {
    $id = $community["id"];
    $name = $community["name"];
    $community_flair_id = $community["community_flair_id"];
    $flair_name = $community["flair_name"];
echo '<li id="community-14866558073037299866" class="trigger test-community-list-item " tabindex="0">
  <img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . $name . '</a>
      
        <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      
      <span class="text">' . $flair_name . '</span>
  </div>
  </div>
</li>';
        }}}

?>

        </ul>
      </div>

      
      

          <h3 class="community-title symbol">
        <span>New Communities</span></h3>

      <div>
        <ul class="list community-list community-card-list device-new-community-list">
        <?php
$sql = "SELECT * FROM community WHERE usergenerated = 0 AND special = 0 AND private = 0 ORDER BY pk DESC LIMIT 6";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $communities_new) {
    $id = $communities_new["id"];
    $name = $communities_new["name"];
    $community_flair_id = $communities_new["community_flair_id"];
    $flair_name = $communities_new["flair_name"];
    echo '<li id="community" class="trigger test-community-list-item " tabindex="0">
  <img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . htmlentities($name) . '
</a>
      
        <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      
      <span class="text">' . htmlentities($flair_name) . '</span>
  </div>
  </div>
</li>';
  }
}
else{
  echo "No communities of this type have been created yet. </br>";
}
}
?>

        </ul>
        <a href="./all_comm.php?type=normal" class="big-button">Show More</a>
      </div>      

      <div class="community-main">

      
      

<h3 class="community-title symbol">
<span>User-Generated Communities</span></h3>

<div>
<ul class="list community-list community-card-list device-new-community-list">
<?php
$sql = "SELECT * FROM community WHERE usergenerated = 1 AND special = 0 AND private = 0 ORDER BY pk DESC LIMIT 6";
if($result1 = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result1) != 0 ) {
foreach($result1 as $communities_new) {
$id = $communities_new["id"];
$name = $communities_new["name"];
$community_flair_id = $communities_new["community_flair_id"];
$flair_name = $communities_new["flair_name"];
echo '<li id="community" class="trigger test-community-list-item " tabindex="0">
<img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
<div class="community-list-body">
<span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
<div class="body">
<a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . htmlentities($name) . '
</a>

<span class="platform-tag"><img src="./cdn/community_flair_icons/' . $community_flair_id . '.png"></span>

<span class="text">' . htmlentities($flair_name) . '</span>
</div>
</div>
</li>';
}
}
else{
echo "No communities of this type have been created yet. </br>";
}
}
?>
</ul>
<a href="./all_comm.php?type=usergenerated" class="big-button">Show More</a>
<?php
if(isset($_SESSION["id"])) {
echo '<a href="./create_community.php" class="big-button">Create Community</a>';
}
?>
</div>

      
    <h3 class="community-title">Special</h3>
    <ul class="list community-list community-card-list special-community-list">
    <?php
$sql = "SELECT * FROM community WHERE usergenerated = 0 AND special = 1 AND private = 0 ORDER BY pk DESC LIMIT 6";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $communities_new) {
    $id = $communities_new["id"];
    $name = $communities_new["name"];
    $community_flair_id = $communities_new["community_flair_id"];
    $flair_name = $communities_new["flair_name"];
    echo '<li id="community" class="trigger test-community-list-item " tabindex="0">
  <img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . htmlentities($name) . '
</a>
      
        <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      
      <span class="text">' . htmlentities($flair_name) . '</span>
  </div>
  </div>
</li>';
  }
}
else{
  echo "No communities of this type have been created yet. </br>";
}
}
?>
</ul>
<a href="./all_comm.php?type=special" class="big-button">Show More</a>

    <?php
    if(isset($sessuid)){
      echo '<h3 class="community-title">Private Communities (accessible to you)</h3>
      <ul class="list community-list community-card-list special-community-list">';
      $sql = "SELECT * FROM community WHERE private = 1 ORDER BY pk DESC LIMIT 6";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $communities_new) {
    $id = $communities_new["id"];
    $allowed_userlist = $communities_new["allowed_userlist"];
    $exallowed_userlist = explode(", ", $allowed_userlist);
    if(!in_array($sessuid, $exallowed_userlist)){
      continue;
    }
    $name = $communities_new["name"];
    $community_flair_id = $communities_new["community_flair_id"];
    $flair_name = $communities_new["flair_name"];
    echo '<li id="community" class="trigger test-community-list-item " tabindex="0">
  <img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . htmlentities($name) . '
</a>
      
        <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      
      <span class="text">' . htmlentities($flair_name) . '</span>
  </div>
  </div>
</li>';
  }
}
else{
  echo "No communities of this type have been created yet. </br>";
}
}
echo '</ul>
    <a href="./all_comm.php?type=private" class="big-button">Show More</a>';
    }
    
?>
    </ul>
    <?php
    if($imadmin == true){
      echo '<h3 class="community-title">[ADMIN] - All Private Communities</h3>
      <ul class="list community-list community-card-list special-community-list">';
      $sql = "SELECT * FROM community WHERE private = 1 ORDER BY pk DESC LIMIT 6";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $communities_new) {
    $id = $communities_new["id"];
    $name = $communities_new["name"];
    $community_flair_id = $communities_new["community_flair_id"];
    $flair_name = $communities_new["flair_name"];
    echo '<li id="community" class="trigger test-community-list-item " tabindex="0">
  <img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . htmlentities($name) . '
</a>
      
        <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      
      <span class="text">' . htmlentities($flair_name) . '</span>
  </div>
  </div>
</li>';
  }
}
else{
  echo "No communities of this type have been created yet. </br>";
}
}
echo '</ul>
    <a href="./all_comm.php?type=privateadmn" class="big-button">Show More</a>';
    }
    
?>
</ul>
      </div>
      <div id="footer">
        <div id="footer-inner">          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2. UNRELATED TO NINTENDO, HATENA AND OTHER COMPANIES BEHIND MIIVERSE</p>
          </div>
        </div>
      </div>
    </div>
  </body></html>