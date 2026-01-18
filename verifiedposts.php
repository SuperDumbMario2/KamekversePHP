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
<!-- saved from url=(0111)https://web.archive.org/web/20160819120028/https://miiverse.nintendo.net/identified_user_posts?view_region_id=2 -->
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" class="os-win" style="--wm-toolbar-height: 1px;"><head>

    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">



    
    <link rel="shortcut icon" href="./ass/favicon.png?mM9KNw_M04SIP2y9VGgdNA">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20160819120028im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20160819120028im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20160819120028im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20160819120028im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
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
      
</head>

  <body class="identified_user guest is-autopagerized" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      


    <?php include "./components/header.php" ?>

      
      <div id="main-body">
<div class="main-column"><div class="post-list-outline">
<div id="image-header-content">
  <span class="image-header-title">
    <span class="title">Posts from Verified Users</span>
    <span class="text">Get the latest news here!</span>
  </span>
  <img src="./ass/identified-user.png">
</div>
<div class="list post-list js-post-list test-identified-post-list" data-next-page-url="/identified_user_posts?view_region_id=2&amp;offset=30">
  
  
<?php
$sql = "SELECT * FROM posts ORDER BY pk DESC";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $post) {
    $pid = htmlentities($post["id"]);
    $body = htmlentities($post["body"]);
    $yeahs = htmlentities($post["yeahs"]);
    $replies = htmlentities($post["replies"]);
    $feeling =  htmlentities($post["feeling"]);
    $uid = htmlentities($post["creator_id"]);
    $cid = htmlentities($post["community_id"]);
    $cname = "Undefined community ID $cid"; 
    $date = htmlentities($post["creation_date"]);
    $yeahlist = htmlentities($post["yeahlist"]);
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
    $sqlc = "SELECT * FROM community WHERE id = '$cid'";
      if($result3 = mysqli_query($conn, $sqlc)) {
        foreach($result3 as $community){
          $cname = $community["name"];
        }
      }
    $id_in_yeahlist = strpos($yeahlist, $sessuid);
    if($id_in_yeahlist == false){
      if($feeling == "normal" || $feeling == "happy" || $feeling == "normal"){
        $yeahbutton = "Yeah!";
      }
      elseif($feeling == "like"){
        $yeahbutton = "Yeah♥";
      }
      elseif($feeling == "frustrated" || $feeling == "puzzled"){
        $yeahbutton = "Yeah...";
      }
      elseif($feeling == "surprised"){
        $yeahbutton = "Yeah?!";
      }
      else{
        $yeahbutton = "kamekverse.portal.miitoo";
      }
    }
    else{
      $yeahbutton = "Unyeah";
    }
    if($badge != "official-user"){
      continue;
    }
    echo '  <div id="post" class="post trigger post-subtype-default" tabindex="0">
    <p class="community-container">
      

      <a href="./community.php?id=' . $cid . '"><img src="./cdn/community_icons/' . $cid . '.png" class="community-icon">' . $cname . '</a>
    </p>
    <a href="./user.php?id=' . $uid . '" class="icon-container official-user"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="icon"></a>
    <p class="user-name"><a href="./user.php?id=' . $uid . '" ' . $nickcss . '>' . $username . '</a></p>
    

    <div class="body">
      <div class="post-content" onclick="window.open(\'post.php?id=' . $pid . '\')">
        <div class="tag-container">

          
        </div>
        
            <p class="post-content-text">' . $body . '</p>

        <div class="post-meta">
          
          <div class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></div>
          <div class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></div>
        </div>
      </div>
    </div>
  </div>';
  }
}
?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
</div>
</div></div>


      </div>
      <div id="footer">
        <div id="footer-inner">
          <div class="link-container">
            
              <p><a href="https://web.archive.org/web/20160819120028/http://www.nintendo.com/interest-based-ads-policy" class="test-about-ad-link">Interest-Based Ads</a></p>
              
              <p><a href="https://web.archive.org/web/20160819120028/http://support.nintendo.com/miiversehelp" class="test-contact-link">Contact Us</a></p>
              <p><a href="https://web.archive.org/web/20160819120028/http://www.nintendo.com/corp/privacy.jsp" class="test-privacy-policy-link">Privacy Notice</a></p>
            
            <p id="copyright"><a href="https://web.archive.org/web/20160819120028/http://www.nintendo.com/?country=US&amp;lang=en">© 2016 Nintendo</a></p>
          </div>
        </div>
      </div>
    </div>
  


</body></html>