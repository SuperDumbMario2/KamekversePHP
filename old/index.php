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
<!-- saved from url=(0073)https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/ -->
<html lang="en" data-sitecatalyst-suite-id="miiverseweb" data-account-server-origin="https://id.nintendo.net" prefix="og: http://ogp.me/ns#" class="os-win" style="--wm-toolbar-height: 1px;"><head>

    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="ja_JP">
    <meta property="og:locale:alternate" content="es_LA">
    <meta property="og:locale:alternate" content="fr_CA">
    <meta property="og:locale:alternate" content="pt_BR">
    <meta property="og:locale:alternate" content="en_GB">
    <meta property="og:locale:alternate" content="fr_FR">
    <meta property="og:locale:alternate" content="es_ES">
    <meta property="og:locale:alternate" content="de_DE">
    <meta property="og:locale:alternate" content="it_IT">
    <meta property="og:locale:alternate" content="nl_NL">
    <meta property="og:locale:alternate" content="pt_PT">
    <meta property="og:locale:alternate" content="ru_RU">
    <meta property="og:title" content="Miiverse | Nintendo">
    <meta property="og:type" content="article">
    <meta property="og:description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta property="og:site_name" content="Miiverse | Nintendo">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="miiverse.nintendo.net">
    <link rel="shortcut icon" href="../ass/favicon.png?mM9KNw_M04SIP2y9VGgdNA">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20150706001027im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?-Z4Fk7Q3nvDXr5zkiOrxuA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20150706001027im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?7BG8CXQUNg9puEyX86P55g">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20150706001027im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?gzQJApFdFdAqkVtWHcUP_A">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20150706001027im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?U-l5y2aDgriioqMnoD4Rzg">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">
    <script src="./ass/complete-en.js"></script>
  </head>

  <body class="guest-top guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
    
    <div id="wrapper">
      <div id="sub-body">
        <?php include "./components/header.php"; ?>
      </div>
      
      <a class="redesign-banner" href="../"><span class="redesign-banner-text">Kamekverse has the new Miiverse layout too!</span></a>


      
      <div id="main-body">

<h2 class="welcome-message">Welcome to Kamekverse!</h2>
<div id="about">

  <img src="./ass/welcome-image.png">
  <p>Kamekverse is an another one Miiverse Clone™ made by SuperDumbMario2. It is the first clone to offer a full access to both the offdevice, portal (Wii U) and 3DS layouts. It is also the first clone coded from scratch in 2025.

</p>
</div>

<div class="body-content" id="community-top" data-region="USA">


  <div class="headline">
    <h2 class="headline-text">Communities</h2>
    <form method="GET" action="./search.php" class="search">
      <input type="text" name="query" placeholder="Search Communities" minlength="2" maxlength="20"><input type="submit" value="q" title="Search">
    </form>
  </div>

  <div id="identified-user-banner">
    <a href="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/identified_user_posts?view_region_id=2" data-pjax="#body" class="list-button us">
      <span class="title">Get the latest news here!</span>
      <span class="text">Posts from Verified Users</span>
    </a>
  </div>

  

  <div id="tab-wiiu-body" class="tab-body">
    <h3 class="label label-wiiu"><img src="./ass/hot-icon-wiiu.png" class="hot-icon">Spotlight</h3>
    <ul class="icon-list">
        <?php
        $sql = "SELECT * FROM community WHERE featured = 1 ORDER BY pk DESC LIMIT 5";
        if($result = mysqli_query($conn, $sql)){
            foreach($result as $community){
                $id = $community['id'];
                echo '<li>
        <a href="./community.php?id=' . $id . '" data-pjax="#body">
          <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
        </a>
      </li>';
            }
        }
      ?>
      
      
      
      
    </ul>

    <h3 class="label label-wiiu">
      New Communities
      
    </h3>

    <ul class="list community-list community-title-list">
<?php
$sql = "SELECT * FROM community WHERE special = 0 AND usergenerated = 0 AND private = 0 ORDER BY pk DESC LIMIT 12";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $community) {
    $id = $community["id"];
    $name = $community["name"];
    $community_flair_id = $community["community_flair_id"];
    $flair_name = $community["flair_name"];
echo '<li id="community" class="trigger " tabindex="0">
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . $name . '</a>
        <span class="platform-tag"><img src="../cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      <span class="text">' . $flair_name . '</span>
  </div>
</li>';
  }}}

?>






















    </ul>
    <div class="buttons-content">
      <a href="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/communities/categories/wiiu_all" class="button">Show More</a>
    </div>
  </div>
  <h3 class="label label-3ds">
      User-generated Communities
      
    </h3>
    <ul class="list community-list community-title-list">
<?php
$sql = "SELECT * FROM community WHERE usergenerated = 1 ORDER BY pk DESC LIMIT 12";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $community) {
    $id = $community["id"];
    $name = $community["name"];
    $community_flair_id = $community["community_flair_id"];
    $flair_name = $community["flair_name"];
echo '<li id="community" class="trigger " tabindex="0">
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . $name . '</a>
        <span class="platform-tag"><img src="../cdn/community_flair_icons/' . $community_flair_id . '.png"></span>
      <span class="text">' . $flair_name . '</span>
  </div>
</li>';
  }}}

?>






















    </ul>
    <div class="buttons-content">
      <a href="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/communities/categories/wiiu_all" class="button">Show More</a>
    </div>
  

  <h3 class="label">Special</h3>
  <ul class="list community-list community-title-list">
<?php
$sql = "SELECT * FROM community WHERE special = 1 ORDER BY pk DESC LIMIT 12";
if($result1 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result1) != 0 ) {
  foreach($result1 as $community) {
    $id = $community["id"];
    $name = $community["name"];
echo '<li id="community" class="trigger " tabindex="0">
  <span class="icon-container"><img src="../cdn/community_icons/' . $id . '.png" class="icon"></span>
  <div class="body">
      <a class="title" href="./community.php?id=' . $id . '" tabindex="-1">' . $name . '</a>
  </div>
  
</li>';
  }}}
?>



  </ul>

</div>

<div id="about">
  <a href="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/guide/terms" class="arrow-button"><span>Use of Miiverse</span></a>
  <a href="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/guide/" class="arrow-button"><span>Miiverse Code of Conduct &amp; FAQs</span></a>
  
  
</div>

<div id="language-select-page" class="dialog none">
<div class="dialog-inner">
  <div class="window">
    <h1 class="window-title">Switch languages</h1>
    <div class="window-body"><div class="window-body-inner message">
      <form method="post" action="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/locale">
        <div class="select-content">
          <div class="select-button">
            <label><span class="select-button-content">Select a language.</span><br><select name="locale.lang">
            <option value="de-DE">Deutsch</option>
            <option value="en-GB">English (UK/Australia)</option>
            <option value="en-US" selected="">English (US)</option>
            <option value="es-ES">Español (España)</option>
            <option value="es-MX">Español (Latinoamérica)</option>
            <option value="fr-CA">Français (Canada)</option>
            <option value="fr-FR">Français (France)</option>
            <option value="it-IT">Italiano</option>
            <option value="nl-NL">Nederlands</option>
            <option value="pt-BR">Português (Brasil)</option>
            <option value="pt-PT">Português (Portugal)</option>
            <option value="ru-RU">Русский</option>
            <option value="ja-JP">日本語</option>
          </select>
        </label></div>
        </div>
        <div class="form-buttons">
          <input type="button" class="olv-modal-close-button gray-button" value="Cancel">
          <input type="submit" class="post-button black-button" value="OK">
        </div>          <input type="hidden" name="location" value="/">      </form>
    </div></div>
  </div>
</div>
</div>

<div id="region-select-page" class="dialog none">
<div class="dialog-inner">
  <div class="window">
    <h1 class="window-title">Switch regions</h1>
    <div class="window-body"><div class="window-body-inner message">
      <form method="post" action="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/locale">
        <div class="select-content">
          <div class="select-button">
            <label><span class="select-button-content">Select a community region.</span><br><select name="view_region_id">
            <option value="1">Japan</option>
            <option value="2" selected="">Americas</option>
            <option value="4">Europe and Oceania</option>
          </select>
        </label></div>
        </div>
        <div class="form-buttons">
          <input type="button" class="olv-modal-close-button gray-button" value="Cancel">
          <input type="submit" class="post-button black-button" value="OK">
        </div>          <input type="hidden" name="location" value="/">      </form>
    </div></div>
  </div>
</div>
</div>



<div id="wiiu-filter-select-page" class="dialog none filter-select-page">
<div class="dialog-inner">
  <div class="window">
    <h1 class="window-title">Filter</h1>
    <div class="window-body"><div class="window-body-inner message">
      <form method="get" action="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/">
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
</div>

<div id="3ds-filter-select-page" class="dialog none filter-select-page">
<div class="dialog-inner">
  <div class="window">
    <h1 class="window-title">Filter</h1>
    <div class="window-body"><div class="window-body-inner message">
      <form method="get" action="https://web.archive.org/web/20150706001027/https://miiverse.nintendo.net/">
        <div class="select-content">
          <div class="select-button">
            <label><span class="select-button-content"></span><br><select name="category">
            <option value="/communities/categories/3ds_all">All Software</option>
            <option value="/communities/categories/3ds_game">3DS Games</option>
            <option value="/communities/categories/3ds_virtualconsole">Virtual Console</option>
            <option value="/communities/categories/3ds_other">Others</option>
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
</div>


      </div>
      <div id="footer">
        <div id="sidebar">
        </div>
        <?php
        if(!isset($sessuid)){
          echo '<p id="copyright"><a>© 2025 SuperDumbMario2. UNRELATED TO NINTENDO, HATENA AND OTHER COMPANIES BEHIND MIIVERSE</a></p>';
        }
        ?>
      </div>
    </div>
  


</body></html>