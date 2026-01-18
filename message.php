<?php 
include "./dbconnect.php";
include "./cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}

if(isset($_GET["id"]) && isset($_GET["mode"])){
  $mode = $_GET["mode"];
  $id = $_GET["id"];
} else {
  die('Either id or mode wasn\'t specified in the url. As idk where/who are you messaging, or how are you messaging (dm or a group chat), i cannot serve this.');
}
                    if(isset($_SESSION["id"])){
                    if(isset($_GET["id"])){
                    if(isset($_POST["feeling"]) && isset($_POST["nmsg"])){
                      $feeling = mysqli_real_escape_string($conn, $_POST["feeling"]);
                      $nmsg =  mysqli_real_escape_string($conn, $_POST["nmsg"]);
                      $sql = "INSERT INTO msg (feeling, content, id_from, id_to, mode) VALUES ('$feeling', '$nmsg', '$sessuid', '$id', '$mode')";
                      if(mysqli_query($conn, $sql)){
                        header("Location: ./message.php?id=$id&mode=$mode");
                      } else {
                        echo 'error';
                      }
                    }
                  }
                  else{
                    die("no user specified");
                  }
                  }
                  else {
                    die("log in pls");
                  }
                    ?>
<!DOCTYPE html>
<!-- lol kamekverse -->
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1" class="os-win" style="--wm-toolbar-height: 1px;"><head>    
    <title>Kamekverse</title>
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="Miiverse">
    <meta name="description" content="Miiverse is a service that lets you communicate with other players from around the world. It is accessible via Wii U and systems in the Nintendo 3DS family.">
    <meta name="keywords" content="Miiverse,ミーバース,任天堂,Nintendo,Wii U,3DS">    <link rel="shortcut icon" href="./ass/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://web.archive.org/web/20171023052741im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-57x57.png?Ag2tdrIcl30F8RewVb7MpA">
    <link rel="apple-touch-icon" sizes="114x114" href="https://web.archive.org/web/20171023052741im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-114x114.png?np5stZwxPtIFygwO41QXAA">
    <link rel="apple-touch-icon" sizes="72x72" href="https://web.archive.org/web/20171023052741im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-72x72.png?s4ECPF96pvErA7s03oG3gQ">
    <link rel="apple-touch-icon" sizes="144x144" href="https://web.archive.org/web/20171023052741im_/https://d13ph7xrk1ee39.cloudfront.net/img/apple-touch-icon-144x144.png?Cp5sZwpS_1aly-SFq8AeIA">
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
    </head>  <body class="guest is-autopagerized" data-token="" data-static-root="https://d13ph7xrk1ee39.cloudfront.net/">
 
      
  <?php include "./components/header.php" ?>      
      <div id="main-body">
<!-- 69420000000000000000000069420694 --><?php
if(isset($_GET["id"]) && isset($_GET["mode"])){
$sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) != 0) {
  foreach($result as $user){
    if(isset($imadmin) == false){
      $imadmin = 0;
    }
    if($user["banned"] == 0 || $imadmin == 1 || $anarchy == true || $bans == false){
    $username = htmlentities($user["username"]);
    $displayname = htmlentities($user["displayname"]);
    $followers = htmlentities($user["followers"]);
    $friends = htmlentities($user["friends"]);
    $skill = htmlentities($user["skill"]);
    $discord = htmlentities($user["discord"]);
    $bio = htmlentities($user["description"]);
    $mii = htmlentities($user["miidata"]);
    $nickcolor = htmlentities($user["nickname_color"]);
    $nickcss = "";
    if(isset($nickcolor)){
      $nickcss = 'style=" color: ' . $nickcolor . ';"';
    }
    $badge = $user["badge"];
    echo '<div id="sidebar" class="user-sidebar">
  <div class="sidebar-container">
    <div id="sidebar-profile-body" class="">
      <div class="icon-container ' . $badge . '">
        <a>
          <img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=normal" . '" class="icon">
        </a>
      </div>
      
      <a class="nick-name" ' . $nickcss . '>' . $displayname . '</a>
      <p class="id-name">' . $username . '</p>
    </div>
    
    <ul id="sidebar-profile-status">
      <li><a class=""><span><span class="number test-friend-count">' . $friends . '</span>Friends</span></a></li>
      
      <li><a class=""><span><span class="number test-follower-count">' . $followers . '</span>Followers</span></a></li>
    </ul>
  </div>
  </div>
  ';
  
  } else {
    die('<div class="no-content track-error" data-track-error="403">
    <div>
      <p>This user is hidden.
      </p>
    </div>
  </div>');
  }}
} else {
  die('User not found.');
}
}
}
?>
<div class="main-column"><div class="post-list-outline">
  <?php
  if($mode == "dm"){
    // mode direct message, from 1 user to another user
    $sql = "SELECT * FROM accounts WHERE id = '$id'";
  if($result = mysqli_query($conn, $sql)){
    foreach($result as $usr){
      $miiusr = $usr["miidata"];
      $badgeu = $usr["badge"];
      $displaynameu = $usr["displayname"];
      echo '<h2 class="label">Messages Exchanged with ' . $displaynameu . '</h2>';
    }
  }
  } elseif($mode == "gm"){
    // mode group message, a group chat
    $sql = "SELECT * FROM group_chs WHERE id = '$id'";
  if($result = mysqli_query($conn, $sql)){
    foreach($result as $gc){
      $gcname = $gc["name"];
      $gcinvite = $gc["invite"];
      echo '<h2 class="label">Messages Exchanged on ' . $gcname . '</h2>';
    }
  }
  }
  ?>
  <div class="list admin-messages">
  <div>
    <?php if($mode == "gm"){echo "Invite: $gcinvite";} ?>
        <form method="post">
        <?php
        if(isset($_GET["feeling_type"]) && $_GET["feeling_type"] == "extended"){
          echo '<p>Expression: <select name="feeling">
          <!-- Options provided by https://mii-unsecure.ariankordi.net/ -->
            <option value="normal">Normal</option>
            <option value="smile">Smile</option>
            <option value="anger">Anger</option>
            <option value="sorrow">Sorrow</option>
            <option value="surprise">Surprise</option>
            <option value="blink">Blink</option>
            <option value="normal_open_mouth">Normal (open mouth)</option>
            <option value="smile_open_mouth">Smile (open mouth)</option>
            <option value="anger_open_mouth">Anger (open mouth)</option>
            <option value="surprise_open_mouth">Surprise (open mouth)</option>
            <option value="sorrow_open_mouth">Sorrow (open mouth)</option>
            <option value="blink_open_mouth">Blink (open mouth)</option>
            <option value="wink_left">Wink (left eye open)</option>
            <option value="wink_right">Wink (right eye open)</option>
            <option value="wink_left_open_mouth">Wink (left eye and mouth open)</option>
            <option value="wink_right_open_mouth">Wink (right eye and mouth open)</option>
            <option value="like_wink_left">Wink (left eye open and smiling)</option>
            <option value="like_wink_right">Wink (right eye open and smiling)</option>
            <option value="frustrated">Frustrated</option>
                <!-- AFL/Miitomo expressions -->
                <option value="19">Bored</option>
                <option value="20">Bored open mouth</option>
                <option value="21">Sigh mouth straight</option>
                <option value="22">Sigh</option>
                <option value="23">Disgusted mouth straight</option>
                <option value="24">Disgusted</option>
                <option value="25">Love</option>
                <option value="26">Love mouth open</option>
                <option value="27">Determined mouth straight</option>
                <option value="28">Determined</option>
                <option value="29">Cry mouth straight</option>
                <option value="30">Cry</option>
                <option value="31">Big smile mouth straight</option>
                <option value="32">Big smile</option>
                <option value="33">Cheeky</option>
                <option value="35">Resolve eyes funny mouth</option>
                <option value="36">Resolve eyes funny mouth open</option>
                <option value="37">Smug</option>
                <option value="38">Smug mouth open</option>
                <option value="39">Resolve</option>
                <option value="40">Resolve mouth open</option>
                <option value="41">Unbelievable</option>
                <option value="43">Cunning</option>
                <option value="45">Raspberry</option>
                <option value="47">Innocent</option>
                <option value="49">Cat</option>
                <option value="51">Dog</option>
                <option value="53">Tasty</option>
                <option value="55">Money mouth straight</option>
                <option value="56">Money</option>
                <option value="57">Confused mouth straight</option>
                <option value="58">Confused</option>
                <option value="59">Cheerful mouth straight</option>
                <option value="60">Cheerful</option>
                <option value="61">Blank</option>
                <option value="63">Grumble mouth straight</option>
                <option value="64">Grumble</option>
                <option value="65">Moved mouth straight</option>
                <option value="66">Moved (aka pleading face)</option>
                <option value="67">Singing mouth small</option>
                <option value="68">Singing</option>
                <option value="69">Stunned</option>
          </select></p>';
        }
        else {
          echo '<div class="feeling-selector" enctype="multipart/form-data">
                        <label class="feeling-button feeling-button-normal checked">
                            <input type="radio" name="feeling" value="normal" required checked>
                        </label>
                        <label class="feeling-button feeling-button-happy">
                            <input type="radio" name="feeling" value="happy">
                        </label>
                        <label class="feeling-button feeling-button-like">
                            <input type="radio" name="feeling" value="like">
                        </label>
                        <label class="feeling-button feeling-button-surprised">
                            <input type="radio" name="feeling" value="surprised">
                        </label>
                        <label class="feeling-button feeling-button-frustrated">
                            <input type="radio" name="feeling" value="frustrated">
                        </label>
                        <label class="feeling-button feeling-button-puzzled">
                            <input type="radio" name="feeling" value="puzzled">
                        </label>
                    </div>
                    <a href="./message.php?id=' . $_GET["id"] . '&feeling_type=extended" class=exfeelinglink>Not enough expressions? Try the extended expression mode!</a>';
        }
        ?>
                    <textarea name="nmsg" rows="5" cols="40" required></textarea>
                    <input type="submit" class="black-button" style="text-align: center; margin: 0 auto; display: block;" value="Send!" /> 
        </form>
      </div>
  <?php 
  if($mode == "dm"){
    $sql = "SELECT * FROM msg WHERE id_from = '$id' OR id_to = '$id' ORDER BY pk DESC;";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) != 0){
      foreach($result as $msg){
        $id_to = $msg["id_to"];
        $id_from = $msg["id_from"];
        if($id_from == $id){
          $mii = $miiusr;
        } else {
          $mii = $cmii;
        }
        if($id_to != $sessuid && $id_from != $sessuid){
          continue;
        } 
        $content = $msg["content"];
        $feeling = $msg["feeling"];
        $timestamp = $msg["timestamp"];
        echo '<div class="post scroll other">
        <a href="./user.php?id=' . $id_from . '" class="icon-container ' . $badgeu . '"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=" . htmlentities($feeling) . "" . '" class="icon"></a>
          
        <p class="timestamp-container">
          <span class="timestamp">' . $timestamp . '</span>
        </p>
        <div class="post-body">
        <p class="post-content msg">' . $content . '</p>
          <div class="post-meta">
          </div>
          
        </div>
      </div>';
      }
    }
  }
  } elseif($mode == "gm"){
    $sql = "SELECT * FROM msg WHERE id_to = '$id' AND mode = 'gm' ORDER BY pk DESC;";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) != 0){
      foreach($result as $msg){
        $id_from = $msg["id_from"];
        $sql = "SELECT * FROM accounts WHERE id = '$id_from'";
        if($result = mysqli_query($conn, $sql)){
          foreach($result as $usr){
            $cmii = $usr["miidata"];
            $badgeu = $usr["badge"];
          }
        }
        $mii = $cmii;
        $content = $msg["content"];
        $feeling = $msg["feeling"];
        $timestamp = $msg["timestamp"];
        echo '<div class="post scroll other">
        <a href="./user.php?id=' . $id_from . '" class="icon-container ' . $badgeu . '"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . htmlentities($mii) . "&type=face&width=120&expression=" . htmlentities($feeling) . "" . '" class="icon"></a>
          
        <p class="timestamp-container">
          <span class="timestamp">' . $timestamp . '</span>
        </p>
        <div class="post-body">
        <p class="post-content msg">' . $content . '</p>
          <div class="post-meta">
          </div>
          
        </div>
      </div>';
      }
    }
  }
  }
  ?>
  </div>
  </div>
</div></div>
      </div>
      <div>
        <div id="footer-inner">          <div class="link-container">
            
              <p><a href="./contact.php" class="test-contact-link">Contact Us</a></p>
            
            <p id="copyright">© 2025 SuperDumbMario2</p>
          </div>
        </div>
      </div>
    </div>
  
</body></html>