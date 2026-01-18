<?php 
include "./dbconnect.php";
include "./cfg.php";
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
?>
<?php
                    if(isset($_SESSION["id"])){
                    if(isset($_POST["name"]) && isset($_POST["flair"])){
                      $id = generateid();
                      $name = mysqli_real_escape_string($conn, $_POST["name"]);
                      if(isset($_POST["desc"])){
                      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
                    }
                    else{
                      $desc = " ";
                    }
                      if(isset($_POST["private"])){
                        $priv = mysqli_real_escape_string($conn, $_POST["private"]);
                      } else {
                        $priv = false;
                      }
                      $flairid = mysqli_real_escape_string($conn, $_POST["flair"]);
                      if(isset($_POST["flairtext"])){
                        $flairtext = mysqli_real_escape_string($conn, $_POST["flairtext"]);
                      }
                      else{
                        $flairtext = " ";
                      }
                      if(is_uploaded_file($_FILES["icon"]["tmp_name"])){
                      $iconTmpPath = $_FILES['icon']['tmp_name'];
                      $iconName = $_FILES['icon']['name'];
                      $iconSize = $_FILES['icon']['size'];
                      $iconType = $_FILES['icon']['type'];
                      $iconuploadPath = './cdn/community_icons/' . $id . ".png";
                      if(move_uploaded_file($iconTmpPath, $iconuploadPath)){
                      }
                      else{
                        die("Error uploading icon");
                      }
                    } else {
                      if(copy(".\cdn\community_icons\default.png", ".\cdn\community_icons\\$id.png")){

                      }
                      else{
                        die("Error uploading icon - " . $_FILES['icon']['error']);
                      }
                    }
                    if(is_uploaded_file($_FILES["banner"]["tmp_name"])){
                      $bannerTmpPath = $_FILES['banner']['tmp_name'];
                      $bannerName = $_FILES['banner']['name'];
                      $bannerSize = $_FILES['banner']['size'];
                      $bannerType = $_FILES['banner']['type'];
                      $banneruploadPath = './cdn/community_banners/' . $id . ".png";
                      if(move_uploaded_file($bannerTmpPath, $banneruploadPath)){
                      }
                      else{
                        die("Error uploading banner");
                      }
                    } else {
                      if(copy("./cdn/community_banners/default.png", "./cdn/community_banners/$id.png")){

                      }
                      else{
                        die("Error uploading banner");
                      }
                    }
                      $uid = $_SESSION["id"];
                      $badge = "User-generated community by $cdisplayname ($cusername)";
                      $sql = "INSERT INTO community (id, name, description, usergenerated, creator_id, community_flair_id, flair_name, private, allowed_userlist, blue_badges) VALUES ('$id', '$name', '$desc', 1, '$uid', '$flairid', '$flairtext', '$priv', '$sessuid', '$badge')";
                      if($result = mysqli_query($conn, $sql)){
                        header("Location: ./community.php?id=$id");
                      }
                    }
                  }
                  else {
                    die("log in pls");
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
    <h2 class="label">Create Community</h2>
    <div id="guide" class="help-content">
      <div>
        <form method="post" enctype="multipart/form-data">
                    <p>Community name: <input type="text" name="name" required/></p>
                    <p>Community description: <textarea name="desc" rows="5" cols="40" ></textarea></p>
                    <label class="file-button-container">
                    <span class="input-label">Community icon <span>PNG</span></span>
                    <input type="file" name="icon" class="file-button" accept="image/png">
                    <input type="hidden" name="screenshot" value="">
                    </label><label class="file-button-container">
                    <span class="input-label">Community banner <span>PNG</span></span>
                    <input type="file" name="banner" class="file-button" accept="image/png">
                    <input type="hidden" name="screenshot" value="">
                    </label>
                    <p>Community flair: <select name="flair">
                    <option value="null">None</option>
                      <option value="nes">NES</option>
                      <option value="snes">SNES</option>
                      <option value="n64">N64</option>
                      <option value="gcn">GameCube</option>
                      <option value="wii">Wii</option>
                      <option value="wiiu">Wii U</option>
                      <option value="gb">Game Boy</option>
                      <option value="vb">Virtual Boy</option>
                      <option value="gba">Game Boy Advance</option>
                      <option value="ds">DS</option>
                      <option value="3ds">3DS</option>
                      <option value="switch">Switch</option>
                      <option value="switch2">Switch 2</option>
                      <option value="wiiu-3ds">Wii U/3DS</option>
                    </select></p>
                    <p>Community flair text: <input type="text" name="flairtext" maxlength="30" /></p>
                    <p>Private? (Manage users who can access this community in the settings after creating this community): <input type="checkbox" value="1" name="private" /></p>
                    <input type="submit" class="black-button" style="text-align: center; margin: 0 auto; display: block;" value="Create community!" /> 
                    <?php
                    /* if(isset($_SESSION["id"])){
                    if(isset($_POST["name"]) && isset($_POST["flair"])){
                      $id = generateid();
                      $name = mysqli_real_escape_string($conn, $_POST["name"]);
                      if(isset($_POST["desc"])){
                      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
                    }
                    else{
                      $desc = " ";
                    }
                      if(isset($_POST["private"])){
                        $priv = mysqli_real_escape_string($conn, $_POST["private"]);
                      } else {
                        $priv = false;
                      }
                      $flairid = mysqli_real_escape_string($conn, $_POST["flair"]);
                      if(isset($_POST["flairtext"])){
                        $flairtext = mysqli_real_escape_string($conn, $_POST["flairtext"]);
                      }
                      else{
                        $flairtext = " ";
                      }
                      if(is_uploaded_file($_FILES["icon"]["tmp_name"])){
                      $iconTmpPath = $_FILES['icon']['tmp_name'];
                      $iconName = $_FILES['icon']['name'];
                      $iconSize = $_FILES['icon']['size'];
                      $iconType = $_FILES['icon']['type'];
                      $iconuploadPath = './cdn/community_icons/' . $id . ".png";
                      if(move_uploaded_file($iconTmpPath, $iconuploadPath)){
                      }
                      else{
                        die("Error uploading icon");
                      }
                    } else {
                      if(copy(".\cdn\community_icons\default.png", ".\cdn\community_icons\\$id.png")){

                      }
                      else{
                        die("Error uploading icon - " . $_FILES['icon']['error']);
                      }
                    }
                    if(is_uploaded_file($_FILES["banner"]["tmp_name"])){
                      $bannerTmpPath = $_FILES['banner']['tmp_name'];
                      $bannerName = $_FILES['banner']['name'];
                      $bannerSize = $_FILES['banner']['size'];
                      $bannerType = $_FILES['banner']['type'];
                      $banneruploadPath = './cdn/community_banners/' . $id . ".png";
                      if(move_uploaded_file($bannerTmpPath, $banneruploadPath)){
                      }
                      else{
                        die("Error uploading banner");
                      }
                    } else {
                      if(copy("./cdn/community_banners/default.png", "./cdn/community_banners/$id.png")){

                      }
                      else{
                        die("Error uploading banner");
                      }
                    }
                      $uid = $_SESSION["id"];
                      $badge = "User-generated community by $cdisplayname ($cusername)";
                      $sql = "INSERT INTO community (id, name, description, usergenerated, creator_id, community_flair_id, flair_name, private, allowed_userlist, blue_badges) VALUES ('$id', '$name', '$desc', 1, '$uid', '$flairid', '$flairtext', '$priv', '$sessuid', '$badge')";
                      if($result = mysqli_query($conn, $sql)){
                        echo'<p>Done! You can now go to <a href=./community.php?id=' . $id . '>community page</a>.';
                      }
                    }
                  }
                  else {
                    die("log in pls");
                  } */
                    ?>
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