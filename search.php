<?php 
include "./dbconnect.php";
include "./cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
if(isset($_GET["query"])){
  $q = mysqli_real_escape_string($conn, $_GET["query"]);
}
?>
<!DOCTYPE html>
<!-- saved from url=(0102)https://web.archive.org/web/20171107230203/https://miiverse.nintendo.net/titles/search?query=cubeshift -->
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" prefix="og: http://ogp.me/ns#" class="os-win" style="--wm-toolbar-height: 1px;"><head>

    
    <title><?php echo $site_name; ?></title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">
    
    <link rel="shortcut icon" href="./ass/favicon.png?mM9KNw_M04SIP2y9VGgdNA">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20171107230203im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20171107230203im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20171107230203im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20171107230203im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
      </head>

  <body class="search guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
  <?php include "./components/header.php" ?>

      
      <div id="main-body">

<div class="main-column"><div class="post-list-outline">
  <h2 class="label">Search Communities</h2>

  <form method="GET" action="./search.php" class="search">
    <input type="text" name="query" placeholder="Mario, Closedverse, etc." minlength="2" maxlength="20"><input type="submit" value="q" title="Search">
  </form>

  <div class="search-content">
      <p class="note">Communities found for "<?php echo $q; ?>."</p>
      <ul class="list community-list community-title-list">
<?php
$sql = "SELECT * FROM community WHERE name LIKE '%$q%'";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $comm){
    $name = $comm["name"];
    $id = $comm["id"];
    $flairid = $comm["community_flair_id"];
    $flair = $comm["flair_name"];
    echo '<li class="trigger test-community-list-item " tabindex="0">
  <img src="./cdn/community_banners/' . $id . '.png" class="community-list-cover">
  <div class="community-list-body">
  <span class="icon-container"><img src="./cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a href="./community.php?id=' . $id . '" class="title" tabindex="-1">' . $name . '</a>
      
        <span class="platform-tag"><img src="./cdn/community_flair_icons/' . $flairid . '.png"></span>
      
      <span class="text">' . $flair . '</span>
  </div>
  </div>
</li>';
  }
}
?>

      </ul>
  </div>
</div></div>

      </div>
      <div id="footer">
        <div id="footer-inner">





          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2. UNRELATED TO NINTENDO, HATENA AND OTHER COMPANIES BEHIND MIIVERSE</p>
          </div>
        </div>
      </div>
    </div>
  


</body></html>