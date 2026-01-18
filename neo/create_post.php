<?php 
include "../dbconnect.php";
include "../cfg.php";
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
?>
<?php
                    $id = generate_kop_id("post");
                    if(isset($_SESSION["id"])){
                    if(isset($_GET["community"])){
                    if(isset($_POST["feeling"]) && isset($_POST["postcontent"])){
                      $sqlc = "SELECT * FROM community WHERE id = '" . mysqli_real_escape_string($conn, $_GET["community"]) . "'";
                      $postcontent = mysqli_real_escape_string($conn, $_POST["postcontent"]);
                      if($resultc = mysqli_query($conn, $sqlc)){
                        if(mysqli_num_rows($resultc) !== 0){
                          foreach($resultc as $c){
                            if($c["locked"] == true){
                              die("You cannot post here");
                            }
                            if($c["is_swearblocked"] == true && checkSwear($postcontent) == true){
                              $postcontent = censorSwears($postcontent);
                              if(checkSwear($postcontent) == true){
                                $postcontent = censorSwearsA($postcontent);
                                if(checkSwear($postcontent) == true){
                                  die("You are swearing in a community which does not allow swearing, and the censorship function failed to do it's job even tho it's practically impossible due to the aggressive censorship function being practically unbypassable.");
                                }
                              }
                              if(strlen($postcontent) < 1){
                                die ("You are swearing in a community which does not allow swearing, and your post was made out entriely of a swear word.");
                              }
                            }
                          }
                        } else {
                          die("Invalid community");
                        }
                      }
                      $has_image = false;
                      if(isset($_FILES["img"]) && is_uploaded_file($_FILES["img"]["tmp_name"])){
                        $imgTmpPath = $_FILES['img']['tmp_name'];
                        $imgName = $_FILES['img']['name'];
                        $imgSize = $_FILES['img']['size'];
                        $imgType = $_FILES['img']['type'];
                        $imguploadPath = '../cdn/post_images/' . $id . ".png";
                        if(move_uploaded_file($imgTmpPath, $imguploadPath)){
                          $has_image = true;
                        } else {
                          die("Error: IMG");
                        }
                        
                      }
                      $feeling = mysqli_real_escape_string($conn, $_POST["feeling"]);
                      $uid = $_SESSION["id"];
                      $cid = mysqli_real_escape_string($conn, $_GET["community"]);
                      $sql = "INSERT INTO posts (creator_id, community_id, feeling, body, id, has_image) VALUES ('$uid', '$cid', '$feeling', '$postcontent', '$id', '$has_image')";
                      if($result = mysqli_query($conn, $sql)){
                        header("Location: ./community.php?id=$cid");
                      }
                    }
                  }
                  else{
                    die("no community specified");
                  }
                  }
                  else {
                    header("Location: ./login.php");
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
  <?php
  if(isset($_GET["community"])){
    echo ' <style>
  #wrapper {
    background: #eeeeee url(\'../cdn/community_banners/' . $_GET["community"] . '.png\');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  background-attachment: fixed;
  }
  </style>';
}
  ?>

      
      <div id="main-body">


<div class="main-column">
  <div class="post-list-outline">
    <h2 class="label">Create Post</h2>
    <div id="guide" class="help-content">
      <div>
        <form method="post" enctype="multipart/form-data">
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
                    <a href="./create_post.php?feeling_type=extended&community=' . $_GET["community"] . '" class=exfeelinglink>Not enough expressions? Try the extended expression mode!</a>';
        }
        ?>
        
        

                    <p>Post content: <textarea name="postcontent" rows="5" cols="40" placeholder="Share your thoughts in a post to this community." required></textarea></p>
                    <label class="file-button-container">
    <span class="input-label">Image <span>PNG</span></span>
    <input type="file" name="img" class="file-button" accept="image/png">
    <input type="hidden" name="screenshot" value="">
  </label>
                    <input type="submit" class="black-button" style="text-align: center; margin: 0 auto; display: block;" value="Add post!" />
                    <?php
                    /* $id = generateid();
                    if(isset($_SESSION["id"])){
                    if(isset($_GET["community"])){
                    if(isset($_POST["feeling"]) && isset($_POST["postcontent"])){
                      $sqlc = "SELECT * FROM community WHERE id = '" . mysqli_real_escape_string($conn, $_GET["community"]) . "'";
                      if($resultc = mysqli_query($conn, $sqlc)){
                        if(mysqli_num_rows($resultc) !== 0){
                          foreach($resultc as $c){
                            if($c["locked"] == true){
                              die("You cannot post here");
                            }
                          }
                        } else {
                          die("Invalid community");
                        }
                      }
                      $has_image = false;
                      if(isset($_FILES["img"]) && is_uploaded_file($_FILES["img"]["tmp_name"])){
                        $imgTmpPath = $_FILES['img']['tmp_name'];
                        $imgName = $_FILES['img']['name'];
                        $imgSize = $_FILES['img']['size'];
                        $imgType = $_FILES['img']['type'];
                        $imguploadPath = '../cdn/post_images/' . $id . ".png";
                        if(move_uploaded_file($imgTmpPath, $imguploadPath)){
                          $has_image = true;
                        } else {
                          die("Error: IMG");
                        }
                        
                      }
                      $feeling = mysqli_real_escape_string($conn, $_POST["feeling"]);
                      $postcontent = mysqli_real_escape_string($conn, $_POST["postcontent"]);
                      $uid = $_SESSION["id"];
                      $cid = mysqli_real_escape_string($conn, $_GET["community"]);
                      $sql = "INSERT INTO posts (creator_id, community_id, feeling, body, id, has_image) VALUES ('$uid', '$cid', '$feeling', '$postcontent', '$id', '$has_image')";
                      if($result = mysqli_query($conn, $sql)){
                        echo'<p>Done! You can now go to <a href=./community.php?id=' . $cid . '>community page</a> or <a href=./post.php?id=' . $id . '>post page</a>.</p>';
                      }
                    }
                  }
                  else{
                    die("no community specified");
                  }
                  }
                  else {
                    header("Location: ./login.php");
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
  


    <!-- <script>
      // AI slop, beacuse idk JS and i am not going to learn JS for a small detail. If you are going to complain "KaMeKvErSe Is Ai SlOp!!11!111111!1!1" this is the only shit made by ai in this clone and you are free to delete your Kamekverse acc if you really care abt a small JS block being AI.
const inputs = document.querySelectorAll('.feeling-selector .feeling-button input');

inputs.forEach((input) => {
  input.addEventListener('change', () => {
    inputs.forEach((btn) => {
      btn.checked = false; 
      btn.parentElement.classList.remove('checked'); 
    });

    input.checked = true; 
    input.parentElement.classList.add('checked'); 
  });
});

    </script> 
  This code is now legacy as i found out about complete_en.js from Nintendo themselves.-->
    </body></html>