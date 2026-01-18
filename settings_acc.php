<?php 
include "./dbconnect.php";
include "./cfg.php";
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
$sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $account){
    $displayname = $account["displayname"];
    $miidata = $account["miidata"];
    $desc = $account["description"];
    $nickcolor = $account["nickname_color"];
    $discord = $account["discord"];
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
    <h2 class="label">Account Settings</h2>
    <div id="guide" class="help-content">
      <div>
        <p>Don't see what you're looking for? Check in <a href=./settings.php style="display: inline;">site settings</a>.</p>
        <h2>Info</h2>
        <form method="post">
          <p>Your displayname: <input type="text" name="Displayname" value="<?php echo $displayname ?>" required /></p>
          <p>Your Mii data: <input type="text" name="Mii" value="<?php echo $miidata ?>" required /></p>
          <p>Your description: <textarea name="Desc" rows="5" cols="40"></textarea></p>
          <p>Your nickname color: <input type="color" name="nickcolor" value="<?php echo $nickcolor ?>" /></p>
          <p>Game exp.: <select name="exp" required>
                    <option value="beginner">Beginner</option>
                      <option value="intermediate">Intermediate</option>
                      <option value="expert">Expert</option>
                    </select></p>
         <p>Discord tag: <input type="text" name="discord" value="<?php echo $discord ?>" /></p>
          <input type="submit" name="profileinfo" value="Save!" class="black-button" />
        </form>
        <?php
        if(isset($_POST["profileinfo"])){
          $Displayname_new = mysqli_real_escape_string($conn, $_POST["Displayname"]);
          $Mii_new = mysqli_real_escape_string($conn, $_POST["Mii"]);
          if(isset($_POST["nickcolor"])) {
          $Nickcolor_new = mysqli_real_escape_string($conn, $_POST["nickcolor"]);} else{
            $Nickcolor_new = $nickcolor;
          }
          if(isset($_POST["Desc"])){
          $Desc_new = mysqli_real_escape_string($conn, $_POST["Desc"]);} else {
            $Desc_new = mysqli_real_escape_string($conn, $desc);
          }
          $exp = mysqli_real_escape_string($conn, $_POST["exp"]);
          if(isset($_POST["discord"])){
          $newdiscord = mysqli_real_escape_string($conn, $_POST["discord"]);
          } else {
            $newdiscord = $discord;
          }
          $sql = "UPDATE accounts SET displayname = '$Displayname_new', miidata = '$Mii_new', description = '$Desc_new', nickname_color = '$Nickcolor_new', skill = '$exp', discord = '$newdiscord' WHERE id = '$sessuid';";
          if(mysqli_query($conn, $sql)){
            echo "Your account info has been changed.";
          }
        }
        ?>
        <h2>Security</h2>
        <form method="post">
          <input type="submit" value="Logout everywhere..." name="fulllogout" class="black-button" /></br>
          <p>Change password</p>
          <input type="password" placeholder="Your current password" name="currpwd" /></br>
          <input type="password" placeholder="Your new password" name="newpwd" /></br>
          <input type="submit" value="Change" name="changepwd" class="black-button" />
        </form>
        <?php
        if(isset($_POST["fulllogout"])){
          $sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
          if($result = mysqli_query($conn, $sql)){
            foreach($result as $u){
              $pwdid = $u["PasswordID"]+1;
              $sql = "UPDATE accounts SET PasswordID = $pwdid WHERE id = '$sessuid'";
              if(mysqli_query($conn, $sql)){
                echo "<script>window.location.href = \"./\";</script>";
              }
            }
          }
        }
        if(isset($_POST["changepwd"])){
          $currpwd = mysqli_real_escape_string($conn, $_POST["currpwd"]);
          $newpwd = mysqli_real_escape_string($conn, $_POST["newpwd"]);
          if($result = mysqli_query($conn, $sql)){
            foreach($result as $u){
              $pwdid = $u["PasswordID"]+1;
              $reqpwd = password_verify($currpwd, $u["password"]);
              if($reqpwd == true){
                $pwd = password_hash($newpwd, PASSWORD_DEFAULT);
              $sql = "UPDATE accounts SET PasswordID = $pwdid, password = '$pwd' WHERE id = '$sessuid'";
              if(mysqli_query($conn, $sql)){
                echo "<script>window.location.href = \"./\";</script>";
              }
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