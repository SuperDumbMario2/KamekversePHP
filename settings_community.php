<?php 
include "./dbconnect.php";
include "./cfg.php";
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
$cid = mysqli_real_escape_string($conn, $_GET["id"]);
if(!isset($cid)){
    die("Invalid community ID!");
}
$sql = "SELECT * FROM community WHERE id = '$cid'";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) == 0){
        die("Invalid community ID!");
    } else {
    foreach($result as $com){
        $name = htmlentities($com["name"]);
        $creator_id = $com["creator_id"];
        $desc = htmlentities($com["description"]);
        $private = $com["private"];
        $community_flair_id = htmlentities($com["community_flair_id"]);
        $flair_name = htmlentities($com["flair_name"]);
        $isLocked = $com["locked"];
        $allowed_userlist = htmlentities($com["allowed_userlist"]);
    }}
}
if($sessuid != $creator_id && $imadmin == false){
    die("You do not own this community!");
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
    <h2 class="label">Community Settings For <?php echo $name ?></h2>
    <div id="guide" class="help-content">
      <div>
        <h2>Info</h2>
        <form method="post" enctype="multipart/form-data">
          <p>Community name: <input type="text" name="name" value="<?php echo $name ?>" required /></p>
          <p>Community description: <textarea name="desc" rows="5" cols="40"><?php echo $desc ?></textarea></p>
          <p>Flair image: <select name="flair">
                    <option value="null" <?php if($community_flair_id === "null") echo "selected"; ?>>None</option>
                      <option value="nes" <?php if($community_flair_id === "nes") echo "selected"; ?>>NES</option>
                      <option value="snes" <?php if($community_flair_id === "snes") echo "selected"; ?>>SNES</option>
                      <option value="n64" <?php if($community_flair_id === "n64") echo "selected"; ?>>N64</option>
                      <option value="gcn" <?php if($community_flair_id === "gcn") echo "selected"; ?>>GameCube</option>
                      <option value="wii" <?php if($community_flair_id === "wii") echo "selected"; ?>>Wii</option>
                      <option value="wiiu" <?php if($community_flair_id === "wiiu") echo "selected"; ?>>Wii U</option>
                      <option value="gb" <?php if($community_flair_id === "gb") echo "selected"; ?>>Game Boy</option>
                      <option value="vb" <?php if($community_flair_id === "vb") echo "selected"; ?>>Virtual Boy</option>
                      <option value="gba" <?php if($community_flair_id === "gba") echo "selected"; ?>>Game Boy Advance</option>
                      <option value="ds" <?php if($community_flair_id === "ds") echo "selected"; ?>>DS</option>
                      <option value="3ds" <?php if($community_flair_id === "3ds") echo "selected"; ?>>3DS</option>
                      <option value="switch" <?php if($community_flair_id === "switch") echo "selected"; ?>>Switch</option>
                      <option value="switch2" <?php if($community_flair_id === "switch2") echo "selected"; ?>>Switch 2</option>
                      <option value="wiiu-3ds" <?php if($community_flair_id === "wiiu-3ds") echo "selected"; ?>>Wii U/3DS</option>
                    </select></p>
        
         <p>Flair text: <input type="text" name="flairt" value="<?php echo $flair_name ?>" /></p>
         <p>Community icon: <input type="file" name="icon" /></p>
         <p>Community banner: <input type="file" name="banner" /></p>
          <input type="submit" name="infocm" value="Save!" class="black-button" />
        </form>
        <?php
        if(isset($_POST["infocm"])){
            if(isset($_POST["name"])){
                $name = mysqli_real_escape_string($conn, $_POST["name"]);
                
            }
            else {
                die("No name present!");
            }
            if(isset($_POST["desc"])){
                $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
            }
            else {
                $desc = " ";
            }
            if(isset($_POST["flair"])){
                $community_flair_id = mysqli_real_escape_string($conn, $_POST["flair"]);
            }
            else {
                $community_flair_id = "null";
            }
            if(isset($_POST["flairt"])){
                $flair_name = mysqli_real_escape_string($conn, $_POST["flairt"]);
            }
            else {
                $flair_name = " ";
            }
            if(isset($_FILES["icon"])){
                if(is_uploaded_file($_FILES["icon"]["tmp_name"])){
                $iconTmpPath = $_FILES['icon']['tmp_name'];
                $iconName = $_FILES['icon']['name'];
                $iconSize = $_FILES['icon']['size'];
                $iconType = $_FILES['icon']['type'];
                $iconuploadPath = './cdn/community_icons/' . $cid . ".png";
                if(move_uploaded_file($iconTmpPath, $iconuploadPath)){
                }
                else{
                  die("Error uploading the new icon");
            }}
            }
            if(isset($_FILES["banner"])){
                if(is_uploaded_file($_FILES["banner"]["tmp_name"])){
                    $bannerTmpPath = $_FILES['banner']['tmp_name'];
                    $bannerName = $_FILES['banner']['name'];
                    $bannerSize = $_FILES['banner']['size'];
                    $bannerType = $_FILES['banner']['type'];
                    $banneruploadPath = './cdn/community_banners/' . $cid . ".png";
                    if(move_uploaded_file($bannerTmpPath, $banneruploadPath)){
                    }
                    else{
                      die("Error uploading the new banner");
                }}}
            $sql2 = "UPDATE community SET name = '$name', description = '$desc', community_flair_id = '$community_flair_id', flair_name = '$flair_name' WHERE id = '$cid'";
            if($result = mysqli_query($conn, $sql2)){
                if (mysqli_affected_rows($conn) > 0) {
                echo "Done";
                } else {
                    echo "Nothing changed!";
                }
            } else {
                echo "Error";
            }
        }
        ?>
        <h2>Privacy options</h2>
        <?php
        if($private != true){
          echo '<form method="post">This community is not private!</form>';
        } else {
          echo '<form method="post">
          <h3>User list managment</h3>
          <p>Add user (Enter username): <input type="text" name="addusername" /><input type="submit" name="adduser" class="button" value="Add!" />
          <p>Remove user (Enter username): <input type="text" name="remusername" /><input type="submit" name="remuser" class="button" value="Remove!" />';
          if(isset($_POST["adduser"])){
            $addusername = mysqli_real_escape_string($conn, $_POST["addusername"]);
            $sql = "SELECT * FROM accounts WHERE username = '$addusername'";
            if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) != 0){
                foreach($result as $adduser){
                  $addid = $adduser["id"];
                  if(strpos($addid, $allowed_userlist) === false){
                    $add_allowed_userlist = explode(", ", $allowed_userlist);
                    $add_allowed_userlist[] = $addid;
                    $add_allowed_userlist = mysqli_real_escape_string($conn, implode(", ", $add_allowed_userlist));
                    $sql = "UPDATE community SET allowed_userlist = '$add_allowed_userlist' WHERE id = '$cid'";
                    if(mysqli_query($conn, $sql)){
                      echo "Done adding $addusername";
                    } else {
                      echo "Error adding $addusername";
                    }
                  } else {
                    die("This user is already in!");
                  }
                }
              } else {
                die("This user doesn't exist!");
              }
            }
          } elseif(isset($_POST["remuser"])) {
            $remusername = mysqli_real_escape_string($conn, $_POST["remusername"]);
            $sql = "SELECT * FROM accounts WHERE username = '$remusername'";
            if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) != 0){
                foreach($result as $remuser){
                  $remid = $remuser["id"];
                  if(strpos($allowed_userlist, $remid) !== false){
                    $rem_allowed_userlist = explode(", ", $allowed_userlist);
                    $remid_in_userlist = array_search($remid, $rem_allowed_userlist);
                    if($remid_in_userlist !== false){
                      unset($rem_allowed_userlist[$remid_in_userlist]);
                      $rem_allowed_userlist = implode(", ", $rem_allowed_userlist);
                      $sql = "UPDATE community SET allowed_userlist = '$rem_allowed_userlist' WHERE id = '$cid'";
                      if(mysqli_query($conn, $sql)){
                        echo "Done removing user";
                      } else {
                        echo "Error removing user";
                      }
                    } else {
                      echo "This user is not in!";
                    }
                  } else {
                    echo "This user is not in!";
                  }
                }
              } else {
                die("This user does not exist!");
              }
            }
          }
          echo '<h3>User list</h3>';
          $userlistarray = explode(", ", mysqli_real_escape_string($conn, $allowed_userlist));
          foreach($userlistarray as $userlistuserid){
            $sql = "SELECT * FROM accounts WHERE id = '$userlistuserid'";
            if($result = mysqli_query($conn, $sql)){
              foreach($result as $user){
                $resultname = htmlentities($user["username"]);
                echo '<a href=./user.php?id=' . $userlistuserid . '>' . $resultname . '</a></br>';
              }
            }
          }
        }
        ?>

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