<?php 
include "./dbconnect.php";
include "./cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
if(isset($_SESSION["themes"])){
  $thmc = $_SESSION["themes"];
} else {
  $thmc = "";
}
if(isset($_POST["themesel"])){
  if(isset($_POST["theme"])){
    $thm = $_POST["theme"];
  } else {
    $thm = $thmc;
  }
  if(isset($_POST['utendo-toggle'])){
    $thm = $thm . ", noutendo";
  }
    if(!isset($_POST["beta-toggle"])){
      $betah = false;
    } else {
      $betah = true;
    }
    $_SESSION["betastyle"] = $betah;
    $_SESSION["themes"] = $thm;
}
if(isset($_SESSION["themes"])) {
if($_SESSION["themes"] == "indigo_dark"){
  $themec = "#8000ff";
}
elseif($_SESSION["themes"] == "colored"){
  $themec = "#000000";
}
else{
  $themec = "#FFFFFF";
}
} else {
  $themec = "#FFFFFF";
}
if(isset($_SESSION["themecolor"])){
  $themec = $_SESSION["themecolor"];
}
if(isset($_POST["color"])){
  $_SESSION["themecolor"] =  $_POST["tcolor"];
}
if(isset($_POST["colorr"])){
  unset($_SESSION["themecolor"]);
}
if(isset($_POST["bg"])){
  if(isset($_FILES["tbg"])){
    $file = $_FILES['tbg']['tmp_name'];
    $mimeType = mime_content_type($file);
    if($mimeType == "image/png" || $mimeType == "image/jpeg" || $mimeType == "image/webp"){
      $BGDATA = base64_encode(file_get_contents($file));
      $uri = "data:" . $mimeType . ";base64," . $BGDATA;
      $_SESSION["themecolor"] =  "url(" . $uri . ")";
    }
    else{
      die("file not allowed, sorry");
    }
  }
  
}
?>
<!DOCTYPE html>
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
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20170707153913im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
    <link rel="stylesheet" type="text/css" href="./ass/offdevice.css">

  </head>

  <body id="help" class=" guest" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      


  <?php include "./components/header.php" ?>

      
      <div id="main-body">


<div class="main-column">
  <div class="post-list-outline">
    <h2 class="label">Kamekverse Settings</h2>
    <div id="guide" class="help-content">
      <p>It's possible you are looking for <a href=./settings_acc.php style="display: inline;">account settings</a>.</p>
      <div>
        <h2>Theme selector</h2>
        <form method="post">
        <input type="radio" name="theme" value=" ">Light</input></br>
        <input type="radio" name="theme" value="dark">Dark</input></br>
        <input type="radio" name="theme" value="closedversedark">Dark (Closedverse)</input></br>
        <input type="radio" name="theme" value="indigo">Light (Indigo)</input></br>
        <input type="radio" name="theme" value="indigo_dark">Dark (Indigo)</input></br>
        <input type="radio" name="theme" value="miiverse">Miiverse</input></br>
        <input type="radio" name="theme" value="color">Colored</input></br>
        <input type="radio" name="theme" value="colorl">Colored (Light)</input></br>
        <input type="checkbox" name="utendo-toggle" <?php 
        if(strpos($thmc, "noutendo") !== false){
          echo "checked";
        }
        else{
          echo "";
        }
        ?>>Disable Utendo in default themes</input></br>
        <input type="checkbox" name="beta-toggle" value="true" <?php 
        if(isset($_SESSION["betastyle"]) && $_SESSION["betastyle"] !== false){
          echo "checked";
        }
        else{
          echo "";
        }
        ?>>Beta style (Mii too instead of yeahs)</input></br>
        <input type="submit" value="Set!" class="black-button" name="themesel" />
        </form>
        <h2>Theme color (Works only on the Indigo and the Colored themes) (!THIS IS UNSTABLE AND MAY BREAK!)</h2>
        <form method="post">
        <input type="color" name="tcolor" value="<?php echo $themec ?>" />
        <input type="submit" name="color" class="black-button" value="Done!" />
        <input type="submit" name="colorr" class="black-button" value="Reset!" />
        </form>
        <h2>Theme BG (Works only on the Colored theme) (!THIS IS UNSTABLE AND MAY BREAK!)</h2>
        <form method="post" enctype="multipart/form-data">
        <input type="file" name="tbg" required/>
        <input type="submit" name="bg" class="black-button" value="Done!" />
        <input type="submit" name="colorr" class="black-button" value="Reset!" />
        </form>

      </div>
    </div>
  </div>
</div>
      </div>
      <div id="footer">
        <div id="footer-inner">





          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2</p>
          </div>
        </div>
      </div>
    </div>
  



    </body></html>