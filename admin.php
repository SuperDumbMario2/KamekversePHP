<?php 
include "./dbconnect.php";
include "./cfg.php";
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

<?php
if(isset($_SESSION["id"])){
if($imadmin == 0){
    die("You're not an admin.");
}
} else {
    die("log in pls");
}
?>
<div class="main-column">
  <div class="post-list-outline">
    <h2 class="label">Kamekverse Admin Console</h2>
    <div id="guide" class="help-content">
    <p style="text-align: center; margin: 0 auto; display: block;">
            <?php
            if(isset($_POST["ban"])){
                $banr = mysqli_real_escape_string($conn, $_POST["banr"]);
                $uname = mysqli_real_escape_string($conn, $_POST["uname"]);
                if(strtolower($uname) === strtolower($owner)){
                    echo "Log - not funny. ";
                } else {
                $sql = "UPDATE accounts SET banned = '1', banreason = '$banr' WHERE username = '$uname'";
                if(mysqli_query($conn, $sql)){
                    echo "Log - done banning user";
                }
                else{
                    echo "Log - error banning user";
                }}
            }
            elseif(isset($_POST["ccc"])){
                $cat = mysqli_real_escape_string($conn, $_POST["cat"]);
                $id = mysqli_real_escape_string($conn, $_POST["cid"]);
                if($cat == "norm"){
                    $sql = "UPDATE community SET usergenerated = '0', special = '0' WHERE id = '$id'";
                }
                elseif($cat == "ug"){
                    $sql = "UPDATE community SET usergenerated = '1', special = '0' WHERE id = '$id'";
                }
                elseif($cat == "sp"){
                    $sql = "UPDATE community SET usergenerated = '0', special = '1' WHERE id = '$id'";
                }
                if(mysqli_query($conn, $sql)){
                    echo "Log - done changing community category";
                }
                else{
                    echo "Log - error changing community category";
                }
            }
            elseif(isset($_POST["unban"])){
                $uname = mysqli_real_escape_string($conn, $_POST["uname"]);
                if(strtolower($uname) === strtolower($owner)){
                    echo "Log - not funny. ";
                } else {
                $sql = "UPDATE accounts SET banned = '0', banreason = '' WHERE username = '$uname'";
                if(mysqli_query($conn, $sql)){
                    echo "Log - done unbanning user";
                } else {
                    echo "Log - error unbanning user";
                }}
            }
            elseif(isset($_POST["purge"])){
                $uname = mysqli_real_escape_string($conn, $_POST["uname"]);
                if(strtolower($cusername) === strtolower($owner)) {
                if(strtolower($uname) === strtolower($owner)){
                    echo "Log - not funny. ";
                } else {
                $sql = "SELECT * FROM accounts WHERE username = '$uname' ";
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $acc){
                        $uid = $acc["id"];
                        $sql = "UPDATE accounts SET displayname = '$uname', banned = '0', bantype = '', description = '', fav_communities = '', follower_list = '', miidata = '0800400308040402020c0301060406020a0000000000000804000a0100214004000214031304170d04000a040109', skill = 'beginner', discord = '', followers = '', friends = '', friend_list = '', friend_request_list = '', banreason = '', admin = '', badge = '' WHERE username = '$uname'";
                        if(mysqli_query($conn, $sql)){
                           $sql = "DELETE FROM posts WHERE creator_id = '$uid'";
                           if(mysqli_query($conn, $sql)){
                            $sql = "DELETE FROM community WHERE creator_id = '$uid'";
                            
                            if(mysqli_query($conn, $sql)){
                                $sql = "DELETE FROM comments WHERE creator_id = '$uid'";
                                if(mysqli_query($conn, $sql)){
                                    echo "Log - done purging user";
                                }
                                else{
                                    "Log - error purging user";
                                }
                            }
                           }
                        }
                        else{
                            echo "Log - Error purging account";
                        }
                        }
                    }
                }} else {
                    echo "Log - You're not the owner.";
                }
            }
            elseif(isset($_POST["makeadmin"])){
                $uname = mysqli_real_escape_string($conn, $_POST["uname"]);
                if(strtolower($cusername) === strtolower($owner)) {
                    $sql = "UPDATE accounts SET admin = '1' WHERE username = '$uname'";
                    if(mysqli_query($conn, $sql)){
                        echo "Log - Done making user admin!";
                    }
                    else{
                        echo "Log - Error making user admin";
                    }
                } else {
                    echo "Log - You're not an admin.";
                }
            }
            elseif(isset($_POST["makever"])){
                $uname = mysqli_real_escape_string($conn, $_POST["uname"]);
                $sql = "UPDATE accounts SET badge = 'official-user' WHERE username = '$uname'";
                if(mysqli_query($conn, $sql)){
                    echo "Log - Done making user verified!";
                }
                else{
                    echo "Log - Error making user verifieds";
                }
            }
            elseif(isset($_POST["updatepostids"])){
                $sc = 0;
                $ec = 0;
                $upc = 0;
                $sql = "SELECT * FROM posts";
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $post){
                        $id_old = $post["id_old"];
                        $new_id = $post["id"];
                        if(strlen($new_id) < 1 || !isset($new_id)){
                            $new_id = generate_kop_id("post");
                            $sql = "UPDATE posts SET id = '$new_id' WHERE id_old = '$id_old'";
                            if(mysqli_query($conn, $sql)){
                                $sc++;
                            } else {
                                $ec++;
                            }
                        } else {
                            $upc++;
                        }
                    }
                }
                echo "Post IDs updated, $sc posts successfully updated, $ec errors, $upc posts were already updated.";
            }
            elseif(isset($_POST["mapop"])){
                $sc = 0;
                $ec = 0;
                $dc = 0;
                $sql = "SELECT * FROM posts";
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $post){
                        $id_old = $post["id_old"];
                        $is_old = $post["is_old"];
                        if(!$is_old && strlen($old_id) < 1 || !$is_old && isset($old_id)){
                            $sql = "UPDATE posts SET is_old = 1 WHERE id_old = '$id_old'";
                            if(mysqli_query($conn, $sql)){
                                $sc++;
                            } else {
                                $ec++;
                            }
                        } else {
                            $dc++;
                        }
                    }
                }
                echo "Old posts mapped, $sc posts successfully mapped, $ec errors, $dc posts were already mapped.";
            }
            elseif(isset($_POST["karmarecompute"])){
                $same = 0;
                $recomputed = 0;
                $sql = "SELECT * FROM accounts";
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $user){
                        $uid = $user["id"];
                        $miicoins = $user["karma"];
                        $newmiicoins = 0;
                        $sql = "SELECT * FROM posts WHERE creator_id = '$uid'";
                        if($result = mysqli_query($conn, $sql)){
                            foreach($result as $post){
                                $yeahs = $post["yeahs"];
                                $nahs = $post["nahs"];
                                $newmiicoins = $newmiicoins+$yeahs;
                                $newmiicoins = $newmiicoins-$nahs;
                            }
                        }
                        if($newmiicoins != $miicoins){
                            $sql = "UPDATE accounts SET karma = $newmiicoins WHERE id = '$uid'";
                            if(mysqli_query($conn, $sql)){
                                $recomputed = $recomputed + 1;
                            }
                        } else {
                            $same = $same + 1;
                        }
                    }
                }
                echo "$same users already had the correct mii coin amount, $recomputed had it to be recomputed";
            }
            else{
                echo "Log - no action";
            }
            ?>
            </p>
      <div>
        <h2>Ban user</h2>
            <form method="post">
                <p>Ban reason: <input type="text" name="banr" required /></p>
                <p>Username: <input type="text" name="uname" required /></p>
                <p>Confirm <input type="checkbox" name="ban" required /></p>
                <input type="submit" value="Ban" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Unban user</h2>
            <form method="post">
                <p>Username: <input type="text" name="uname" required /></p>
                <p>Confirm <input type="checkbox" name="unban" required /></p>
                <input type="submit" value="Unban" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Change community category</h2>
            <form method="post">
                <p>Community ID: <input type="text" name="cid" required /></p>
                <p>Category: </p><select name="cat">
                      <option value="norm">Normal</option>
                      <option value="ug">User-generated</option>
                      <option value="sp">Special</option>
                    </select>
                <p>Confirm <input type="checkbox" name="ccc" required /></p>
                <input type="submit" value="Change" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Purge user (only the owner can do this)</h2>
            <form method="post">
                <p>Username: <input type="text" name="uname" required /></p>
                <p>Confirm <input type="checkbox" name="purge" required /></p>
                <input type="submit" value="Purge" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Make user admin (only the owner can do this) (this does NOT give the user "verified" badge)</h2>
            <form method="post">
                <p>Username: <input type="text" name="uname" required /></p>
                <p>Confirm <input type="checkbox" name="makeadmin" required /></p>
                <input type="submit" value="Make admin" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Make user verified</h2>
            <form method="post">
                <p>Username: <input type="text" name="uname" required /></p>
                <p>Confirm <input type="checkbox" name="makever" required /></p>
                <input type="submit" value="Make verified" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Update Post IDs</h2>
            <form method="post">
                <p>Confirm <input type="checkbox" name="updatepostids" required /></p>
                <input type="submit" value="Update IDs" class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Map "old" posts</h2>
            <form method="post">
                <p>Confirm <input type="checkbox" name="mapop" required /></p>
                <input type="submit" value="Map old posts..." class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
            </form>
            <h2>Recompute karma/Mii coins</h2>
            <form method="post">
                <p>Confirm <input type="checkbox" name="karmarecompute" required /></p>
                <input type="submit" value="Recompute..." class="black-button" style="text-align: center; margin: 0 auto; display: block;" />
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