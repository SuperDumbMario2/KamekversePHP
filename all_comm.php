<?php 
include "./dbconnect.php";
include "./cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
if($_GET["type"] == "privateadmn" && $imadmin == false){
  http_response_code(403);
  exit();
}
?>
<!DOCTYPE html>
<!-- saved from url=(0104)https://web.archive.org/web/20160308014635/https://miiverse.nintendo.net/communities/categories/wiiu_all -->
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" class="os-win" style="--wm-toolbar-height: 1px;"><head>

    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">    

    
    <link rel="shortcut icon" href="./ass/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20160308014635im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20160308014635im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20160308014635im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20160308014635im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
      
 </head>

  <body class="category community-top platform-wiiu guest is-autopagerized" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
      <?php include './components/header.php'; ?>

      
      <div id="main-body">

<div class="main-column"><div class="post-list-outline">
  <div class="body-content" id="community-top" data-region="USA">
      <h2 class="label">
        Communities
        
      </h2>
      
      <ul class="list community-list" data-next-page-url="/communities/categories/wiiu_all?offset=30">
<li id="community-14866558073047417457" class="trigger test-community-list-item " data-href="/titles/14866558073047417453/14866558073047417457" tabindex="0">
  <img src="./ass/zlCfzRC1AnEtGNGkdi" class="community-list-cover">
  
</li>

<?php
if(isset($_GET["type"])){
  $type = $_GET["type"];
  if($type == "normal"){
    $sql = "SELECT * FROM community WHERE usergenerated = 0 AND special = 0 AND private = 0 ORDER BY pk DESC";
  }
  elseif($type == "usergenerated"){
    $sql = "SELECT * FROM community WHERE usergenerated = 1 AND special = 0 AND private = 0 ORDER BY pk DESC";
  }
  elseif($type == "special"){
    $sql = "SELECT * FROM community WHERE usergenerated = 0 AND special = 1 AND private = 0 ORDER BY pk DESC";
  } elseif($type == "private"){
    $sql = "SELECT * FROM community WHERE private = 1 ORDER BY pk DESC";
  } elseif($type == "privateadmn"){
    $sql = "SELECT * FROM community WHERE private = 1 ORDER BY pk DESC";
  }
  else{
    $sql = "SELECT * FROM community WHERE private = 0 ORDER BY pk DESC";
  }
}
else{
  $sql = "SELECT * FROM community ORDER BY pk DESC";
}
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) != 0 ) {
  foreach($result as $community){
    $name = $community["name"];
    if($type == "private"){
      if(!isset($sessuid)){
        continue;
      }
      $allowed_userlist = $community["allowed_userlist"];
      $exallowed_userlist = explode(", ", $community["allowed_userlist"]);
      if(!in_array($sessuid, $exallowed_userlist)){
        continue;
      }
    }
    if($type == "privateadmn"){
      if(!$imadmin){
        continue;
      }
    }
    $id = $community["id"];
    $community_flair_id = $community["community_flair_id"];
    $flair_name = $community["flair_name"];
    echo '<li id="community" class="trigger test-community-list-item " tabindex="0">
  <img src="/cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . htmlentities($name) . '</a>
      
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
  </div>
</div></div>

<div id="filter-select-page" class="dialog none">
<div class="dialog-inner">
  <div class="window">
    <h1 class="window-title">Filter</h1>
    <div class="window-body"><div class="window-body-inner message">
      <form method="get" action="https://web.archive.org/web/20160308014635/https://miiverse.nintendo.net/communities/categories/wiiu_all">
        <div class="select-content">
          <div class="select-button">
            <label><span class="select-button-content"></span><br><select name="category">
            <option value="/communities/categories/wiiu_all">All Software</option>
            <option value="/communities/categories/wiiu_game">Wii U Games</option>
            <option value="/communities/categories/wiiu_virtualconsole">Virtual Console</option>
            <option value="/communities/categories/wiiu_other">Others</option>
          </select>
        </label></div>
        </div>
        <div class="form-buttons">
          <input type="button" class="olv-modal-close-button gray-button" value="Cancel">
          <input type="submit" class="post-button black-button" value="OK">
        </div>      </form>
    </div></div>
  </div>
</div>
</div>      </div>
      <div id="footer">
        <div id="footer-inner">          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2</p>
          </div>
        </div>
      </div>
    </div>
  </body></html>