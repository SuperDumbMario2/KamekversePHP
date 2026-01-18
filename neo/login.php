<?php 
include "../dbconnect.php";
include "../cfg.php";
?>
<?php 
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $epassword = mysqli_real_escape_string($conn, $_POST["password"]);
        $sql = "SELECT * FROM accounts WHERE username = '$username'";
        if($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) != 0){
            foreach($result as $account){
                $pwdresult = password_verify($epassword, $account["password"]);
                if($pwdresult==true){
                    $_SESSION["id"] = $account["id"];
                    $_SESSION["pwdid"] = $account["PasswordID"];header("Location: ./");
                }
                else{
                    echo "Incorrect password!";
                }
            }
        } else {
            echo "This user does not exist! </br>";
        }
        }
        else{
            echo "Undefined error. </br>";
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
        <h2>Sign In</h2>
        <p>Please login into your <?php echo $site_name; ?> account.</p>
        
    </div>
    <div class="hb-container hb-l-inside-half hb-mg-top-none">              

            <div class="auth-input-double">               
                <label>
                    <input type="text" name="username" maxlength="16" title="username" placeholder="<?php echo $site_name; ?> Username" required="">
                </label>
                <label>
                    <input type="password" name="password" maxlength="16" title="pwd" placeholder="Password" required="">
                </label>
            </div>

            
            
            
            
            <input type="submit" class="hb-btn hb-is-decide" id="btn_text" value="Sign In">
            <?php
            if($block_signups == false){
                echo '<p><a class="hb-icon-external" target="_blank" href="../signup.php">Sign up</a>
                
                </p>';
            }
            else{
                echo '<p>Sign-ups are disabled for this instance.</p>';
            }
            ?>
                       
    </div>
    </form>
    <?php 
     /* if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $epassword = mysqli_real_escape_string($conn, $_POST["password"]);
        $sql = "SELECT * FROM accounts WHERE username = '$username'";
        if($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) != 0){
            foreach($result as $account){
                $pwdresult = password_verify($epassword, $account["password"]);
                if($pwdresult==true){
                    $_SESSION["id"] = $account["id"];
                    $_SESSION["pwdid"] = $account["PasswordID"];
                    if(isset($_GET["r"])){
                        if($_GET["r"] == "portal"){
                            echo "Done! You can now go to <a href=../portal/>home page</a>. </br>";
                        }
                        elseif($_GET["r"] == "n3ds"){
                            echo "Done! You can now go to <a href=../n3ds/>home page</a>. </br>";
                        }
                        else {
                            echo "Done! You can now go to <a href=../>home page</a>. </br>";
                        }
                    }
                    else {
                        echo "Done! You can now go to <a href=../>home page</a>. </br>";
                    }
                }
                else{
                    echo "Incorrect password!";
                }
            }
        } else {
            echo "This user does not exist! </br>";
        }
        }
        else{
            echo "Undefined error. </br>";
        }
    } */
    ?>
</div>
                <!-- //.hb-contents -->
            </div>
        </div>
        <footer class="hb-footer">
            <!-- footer -->
            <div class="hb-footer-wrapper">
                <div class="hb-footer-link">
                    

 
                </div>                            
                <p class="hb-footer-copyright">©SDM2 (Unrelated to Nintendo)</p>
            </div>
            <!-- //footer -->
        </footer>
        <!-- //.hb-wrapper -->
    </div> 
    
    
    <!--[if lte IE 9]><script src="https://id.<?php echo $site_name; ?>.net/js/placeholders_hb.js"></script><![endif]-->
    
    
    



</body></html>