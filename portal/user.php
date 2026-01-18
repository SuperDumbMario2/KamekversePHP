<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1"><!--
 Archive processed by SingleFile 
 url: https://portal-us.olv.nintendo.net/users/GrahamCracker006/posts 
 saved date: Tue Aug 08 2017 21:46:41 GMT-0400 (Eastern Daylight Time) 
--><head><link rel="stylesheet" type="text/css" href="./ass/portal.css">
<title>Kamekverse</title>
<script type="text/javascript" src="./ass/complete_en.js"></script>
</head>

  <body data-hashed-pid="0e805fdf3e0315cc99f9ded4e3ba7fb2" data-user-id="PMqW3Aa9hr4rVdZn" data-age="32" data-gender="MALE" data-game-skill="3" data-follow-done="1" data-post-done="1" data-lang="en" data-country="us" data-user-region="USA" data-profile-url="/users/PMqW3Aa9hr4rVdZn">
  <?php include "./components/header.php" ?>

    
    <div id="body"><header id="header">
  
    
<div id="dropdown-user-report" class="dropdown">
  
  <div class="dropdown-menu">
      <a href="#" class="button report-button" data-modal-open="#report-violator-page" data-sound="SE_WAVE_OK_SUB" data-community-id="" data-url-id="" data-track-label="user" data-title-id="" data-track-action="openReportModal" data-track-category="reportViolator">Report</a>
      <a href="#" class="button block-button relationship-button" data-modal-open="#block-confirm-page" data-user-id="GrahamCracker006" data-screen-name="Thunda" data-mii-face-url="http://mii-images.cdn.nintendo.net/279c05gn7jdha_normal_face.png" data-action="/users/GrahamCracker006/blacklist.create.json" data-sound="SE_WAVE_OK_SUB">Block</a>
  </div>
</div>

  <?php
  $id = mysqli_real_escape_string($conn, $_GET["id"]);
  $sql = "SELECT * FROM accounts WHERE id = '$id'";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) != 0){
        foreach($result as $usr){
            $displayname = htmlspecialchars($usr["displayname"]);
            $username = htmlspecialchars($usr["username"]);
            $mii = htmlspecialchars($usr["miidata"]);
            $nickcolor = htmlentities($usr["nickname_color"]);
      $nickcss = "";
      if(isset($nickcolor)){
        $nickcss = 'style=" color: ' . $nickcolor . ';"';
        $nickcssbg = 'style=" background-color: ' . $nickcolor . ';"';
      }
        }
        echo '<h1 id="page-title" class=""><p>' . $displayname . '\'s Profile</h1>

        </header><div class="body-content user-page">
        <div class="user-info info-content">
            <span class="user-profile-memo-container"><img src="data:image/png;base64,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" class="user-profile-memo"></span>
            <span class="icon-container"><a href="./user.php"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=normal" . ' alt=\"User Page\" class="icon"></a></span>
          
          <p class="title">
            <span class="nick-name" ' . $nickcss . '>' . $displayname . '</span>
            <span class="id-name">' . $username . '</span>
          </p>
          
            
          
        </div>';
    } else {
        die("User not found");
    }
  } ?>

<menu class="user-menu tab-header">
  <li class="test-user-posts-count tab-button-profile selected"><a data-pjax="#body" data-sound="SE_WAVE_SELECT_TAB"><span class="label">Posts</span></a></li>
  
  
  
</menu>

  <div class="tab-body">
  
<div class="user-page-content js-post-list post-list" data-next-page-url="">
  <div id="user-page-no-content" class="none"></div>
    

<?php
$sql = "SELECT * FROM posts WHERE creator_id = '$id' ORDER BY pk DESC";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $posts){
    $pid = $posts["id"];
      $content = mysqli_real_escape_string($conn, $posts["body"]);
      $yeahs = $posts["yeahs"];
      $replies = $posts["replies"];
      $feeling =  $posts["feeling"];
      $cid = mysqli_real_escape_string($conn, $posts["community_id"]);
      $date = $posts["creation_date"];
      $yeahlist = $posts["yeahlist"];
      $badge = "";
      
      $sqlu = "SELECT * FROM community WHERE (id = '$cid')";
      if($result2 = mysqli_query($conn, $sqlu)) {
        foreach($result2 as $com){
          $cname = mysqli_real_escape_string($conn, $com["name"]);
        }
      }
      if(isset($sessuid) == false){
        $sessuid = false;
      }
      $yeahlink = "\"../toggle_yeah.php?id=$pid&r=user&layout=portal\"";
      $id_in_yeahlist = strpos($yeahlist, $sessuid);
      $yeahdisable = "";
      $empathy_added = "";
      if(isset($_SESSION["id"]) == false){
        $yeahlink = "";
        $yeahdisable = "disabled";
      } elseif($id_in_yeahlist !== false){
        $empathy_added = "empathy-added";
      } elseif($_SESSION["id"] == $id) {
        $yeahlink = "";
        $yeahdisable = "disabled";
      }
      if($id_in_yeahlist == false){
        if(!isset($_SESSION["betastyle"]) || $_SESSION["betastyle"] == false){
          if($feeling == "happy" || str_starts_with($feeling, "normal") || str_starts_with($feeling, "blink")){
            $yeahbutton = "Yeah!";
          }
          elseif(str_starts_with($feeling, "like") || str_starts_with($feeling, "wink")){
            $yeahbutton = "Yeah♥";
          }
          elseif($feeling == "frustrated" || $feeling == "puzzled" || str_starts_with($feeling, "sorrow")){
            $yeahbutton = "Yeah...";
          }
          elseif($feeling == "surprised" || str_starts_with($feeling, "anger") || str_starts_with($feeling, "surprise")){
            $yeahbutton = "Yeah?!";
          }
          elseif(preg_match('/^\d+$/', $feeling)){
            if($feeling == "25" || $feeling == "26"){
              $yeahbutton = "Yeah♥";
            } else {
              $yeahbutton = "Yeah!";
            }
          }
          else{
            $yeahbutton = "kamekverse.portal.miitoo";
          }
        } else {
          $yeahbutton = "Mii too";
        }
      }
      else{
        $yeahbutton = "Unyeah";
      }
echo '<div id="post" class="post scroll post-subtype-default">
<a class="user-icon-container scroll-focus" data-pjax="#body"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=$feeling" . '" class="user-icon"></a>
<div class="post-body-content">
  <div class="post-body">
    <header>
      <span class="user-name" '. $nickcssbg .'>' . $displayname . '</span>
      <span class="timestamp">' . $date . '</span>
      
      
    </header>          

      <a href="./community.php?id=' . $cid . '" class="community-content test-post-target-href" data-pjax="#body">
        <span class="title-icon-container" data-pjax="#body"><img src="../cdn/community_icons/' . $cid . '.png" class="title-icon"></span>
        <span class="community-name">' . $cname . '</span>
      </a>
    

    <div class="post-content" onclick="window.open(\'post.php?id=' . $pid . '\')">



          <p class="post-content-text">' . markdownToHTML(htmlentities($content)) . '</p>
    </div>


    <div class="post-meta">
    <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="submit ' . $yeahdisable . ' miitoo-button" data-feeling="normal" data-sound="SE_WAVE_MII_ADD" data-community-id="14866558073038702637" data-url-id="AYMHAAADAAB2V0gNzrIn0g" data-track-label="default" data-title-id="14866558072985245728" data-track-action="yeah" data-track-category="empathy">' . $yeahbutton . '</button></a><a class="to-permalink-button" data-pjax="#body">
        <span class="feeling">' . $yeahs . '</span>
        <span class="reply">' . $replies . '</span>
      </a>
    </div>
  </div>
</div>



</div>';} }
?>
    
    



</div>

    


    


    


    


    


    


    


    


    


    


    


    


</div>

  </div>
</div></div>

    <a id="scroll-to-top" style="display: inline;" class="" href="#"></a>
<div id="message-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Thunda's Comment</h1>
    <div class="window-body"><div class="window-body-inner message">
      <p class="pre-line"></p>
    </div></div>
    <div class="window-bottom-buttons single-button">
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>

<div id="confirm-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Thunda's Comment</h1>
    <div class="window-body"><div class="window-body-inner message">
      <p></p>
    </div></div>
    <div class="window-bottom-buttons">
      <a href="#" class="button cancel-button" data-sound="SE_WAVE_CANCEL">Cancel</a>
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>

<div id="parental-confirm-dialog-template" class="window-page none">
  <div class="window">
    <h1 class="window-title">Thunda's Comment</h1>
    <div class="window-body">
      <div class="window-body-inner message">
        <p></p>
        <input type="password" controller="drc" minlength="4" maxlength="4" inputform="monospace" guidestring=" " class="parental_code textarea-line" name="parental_code" placeholder="Tap to enter the PIN." keyboard="pin">
      </div>
    </div>
    <div class="window-bottom-buttons">
      <a href="#" class="button cancel-button" data-sound="SE_WAVE_CANCEL">Back</a>
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>
<div id="capture-page" class="capture-page window-page none" data-modal-types="capture" data-is-template="1">
    <div class="capture-container">
        <div><img src="data:image/gif;base64,R0lGODlhEAAQAIAAAP%2F%2F%2FwAAACH5BAEAAAAALAAAAAAQABAAAAIOhI%2Bpy%2B0Po5y02ouzPgUAOw%3D%3D" class="capture"></div>
        <a href="#" class="olv-modal-close-button cancel-button accesskey-B" data-sound="SE_WAVE_CANCEL"><span>Back</span></a>
    </div>
</div>

  

<button type="button" class="accesskey-L" style="display: none;"></button><button type="button" class="accesskey-R" style="display: none;"></button><button type="button" class="accesskey-Y" style="display: none;"></button></body></html>