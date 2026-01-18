<?php
/* Config for Kamekverse.
This contains variables, etc used for the platform. */
// Preparations (exculding db)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . "/libs/generateid.php"; // required to create any content (by generating IDs for it) unless you change the whole logic to use pks as ids. It is outdated and is in process of being phased out, but will be kept for preservation purposes.
include_once __DIR__ . "/libs/koopa_id_lib.php"; // Koopa ID generator, a new id generator for kamekverse.
include_once __DIR__ . "/libs/libban.php"; // required for bans to work, remove if you want to turn bans into shadowbans. Please note that all of the text and functions mentioning bans will remain but the bans themselves will be ignored if this line will not execute. Also you will still be unable to view banned users' posts and stuff. Also, you can specify a shadowban in admin panel.
include_once __DIR__ . "/dbconnect.php"; // db connect
include_once __DIR__ . "/libs/swear.php"; // swear blocker
include_once __DIR__ . "/libs/accbackup.php"; // a lib for account backups.
include_once __DIR__ . "/libs/markdownhandler.php"; // Markdown handler, converts Markdown markup into HTML to display the markdown posts.
// Global parameters
$site_name = "Kamekverse"; // This is for people who might want to change site's name. 
if(isset($_SESSION["id"])){
    $sessuid = $_SESSION["id"]; // this is used in some select scripts beacuse at the moment of adding this a lot of scripts defied this themselves and replacing the defines in the older scripts with use of this is useless so yeah i am not using this everywhere.
}
$block_signups = false; // make it true to block signups
$login_only = false; // make it true if you want to people to log in to view content
$anarchy = false; // make it true to make everyone admin and halt bans.
$bans = true; // make it false to disable bans.
$note = true; // The funny blue note on the home page
$notecontent = "This is in early beta, report bugs to the bug tracker, or e-mail me at kamekverse@proton.me if it's sensitive (ex. something that allows you to see something you are not supposed to (eg. admin panels, users' hashed passwords, private communities...))"; // text in the note
if(isset($_SESSION["id"]) == false){
    $imadmin = 0;
  } // this is to set imadmin to 0 for not logged in users
if(isset($_SESSION["id"])){
    $sql = "SELECT * FROM accounts WHERE id = '" . $_SESSION["id"] . "'";
    if($result = mysqli_query($conn, $sql)){
        foreach($result as $cuser){
            $imadmin = $cuser["admin"];
            $cmii = $cuser["miidata"];
            $cusername = $cuser["username"];
            $cdisplayname = $cuser["displayname"];
            $pwdid = $cuser["PasswordID"];
            if(isset($cuser["blockList"])){
                $blocklist = $cuser["blockList"];
            $blocklistar = explode(", ", $blocklist);
            }
            if(isset($_SESSION["pwdid"])){
                if($pwdid != $_SESSION["pwdid"]){
                    session_unset();
                    session_destroy();
                }
            } else {
                session_unset();
                session_destroy();
            }
        }
    }
}
$owner = "SuperDumbMario2"; // owner's username (NOT DISPLAYNAME). The powers is that admins will not be able to purge the profile or delete stuff associated with this acc, as well as doing other unwanted stuff with it. Also some stuff is limited to this acc, such as purging.
?>