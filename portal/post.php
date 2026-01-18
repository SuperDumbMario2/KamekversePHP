<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en" data-google-analytics-tracking-id="UA-68779773-1"><head>
    
    <title>Kamekverse</title>
    <link rel="stylesheet" type="text/css" href="./ass/portal.css">
    <script type="text/javascript" src="./ass/complete_en.js"></script>
    

    
  </head>

  <body data-hashed-pid="0e805fdf3e0315cc99f9ded4e3ba7fb2" data-user-id="PMqW3Aa9hr4rVdZn" data-age="32" data-gender="MALE" data-game-skill="3" data-follow-done="1" data-post-done="1" data-lang="en" data-country="us" data-user-region="USA" data-profile-url="/users/PMqW3Aa9hr4rVdZn">
  <?php include "./components/header.php" ?>

    
    <div id="body"><header id="header" class="">
  <a id="header-reply-button" class="header-button reply-button" href="#" data-modal-open="#add-reply-page">Comment</a>
  
  <h1 id="page-title">Post</h1>

</header>
<?php
$id = mysqli_real_escape_string($conn, $_GET["id"]);
$sql = "SELECT * FROM posts WHERE id = '$id'";
if($result = mysqli_query($conn, $sql)){
  foreach($result as $post){
    if(mysqli_num_rows($result) != 0) {
      foreach($result as $post) {
        $pid = $post["id"];
        $body = $post["body"];
        $yeahs = $post["yeahs"];
        $replies = $post["replies"];
        $feeling =  $post["feeling"];
        $uid = mysqli_real_escape_string($conn, $post["creator_id"]);
        $cid = mysqli_real_escape_string($conn, $post["community_id"]);
        $date = $post["creation_date"];
        $yeahlist = $post["yeahlist"];
        $badge = "";
        $sqlu = "SELECT * FROM accounts WHERE id = '$uid'";
        if($result2 = mysqli_query($conn, $sqlu)) {
          foreach($result2 as $user){
            if($user["banned"] == 0 || $imadmin == 1 || $anarchy == true || $bans == false){
            $mii = $user["miidata"];
            $displayname = $user["displayname"];
            $username = $user["username"];
            $badge = $user["badge"];
            $nickcolor = htmlentities($user["nickname_color"]);
      $nickcss = "";
      if(isset($nickcolor)){
        $nickcss = 'style=" color: ' . $nickcolor . ';"';
      }
            } else {
              die('<div class="no-content track-error" data-track-error="403">
      <div>
        <p>This post is hidden.
        </p>
      </div>
    </div>');
            }
          }
        }
        $sqlc = "SELECT * FROM community WHERE id = '$cid'";
        if($result3 = mysqli_query($conn, $sqlc)) {
          foreach($result3 as $community){
            $cname = $community["name"];
          }
        }
        if(isset($sessuid) == false){
          $sessuid = false;
        }
        $yeahlink = "\"../toggle_yeah.php?id=$pid&r=post&layout=portal\"";
        $id_in_yeahlist = strpos($yeahlist, $sessuid);
        $yeahdisable = "";
        $empathy_added = "";
        if(isset($_SESSION["id"]) == false){
          $yeahlink = "";
          $yeahdisable = "disabled";
        } elseif($id_in_yeahlist !== false){
          $empathy_added = "empathy-added";
        } elseif($_SESSION["id"] == $uid) {
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
    echo '<div class="body-content post-subtype-default" id="post-permalink">
  <div id="post-permalink-content">
    <div id="post-permalink-header">
      

      <a href="./community.php?id=' . $cid . '" data-pjax="#body" class="community"><img src="../cdn/community_icons/' . $cid . '.png" class="community-icon">' . $cname . '</a>

      

    </div>
    <div id="post-permalink-body">
      <a href="./user.php?id=' . $uid . '" data-pjax="#body" class="user-icon-container"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon"></a>
      <p class="user-name" '. $nickcss .'>' . $displayname . '<span class="user-id">' . $username . '</span></p>
      <p class="timestamp">' . $date . '</p>



      <div class="post-content">

              <p class="post-content-text">' . $body . '</p>
      </div>

      <div class="post-meta">
          

        <div class="expression">
        <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="submit ' . $yeahdisable . ' miitoo-button" data-other-empathy-count="4" data-sound="SE_WAVE_MII_ADD" data-community-id="14866558073038702637" data-url-id="AYMHAAADAAADV44MUg0L9Q" data-track-label="default" data-title-id="14866558072985245728" data-track-action="yeah" data-track-category="empathy">' . $yeahbutton . '</button>
        </div>

      </div>

    </div>

    <div class="post-permalink-feeling">
      <p class="post-permalink-feeling-text">' . $yeahs . ' people gave this a Yeah.</p>
      
    </div>
  </div>';
  }}}
}
?>
  <div id="post-permalink-comments">

<ul class="post-permalink-reply">
<?php
$sql = "SELECT * FROM comments WHERE (post_id='$id')";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) != 0){
    foreach($result as $comment) {
      $coid = $comment["id"];
      $uid = $comment["creator_id"];
      $body = $comment["body"];
      $yeahs = $comment["yeahs"];
      $yeahlist = $comment["yeahlist"];
      $date = $comment["creation_date"];
      $feeling = $comment["feeling"];
      $sqlu = "SELECT * FROM accounts WHERE (id = '$uid')";
      if($result2 = mysqli_query($conn, $sqlu)) {
        foreach($result2 as $user){
          $mii = $user["miidata"];
          $displayname = $user["displayname"];
          $badge = $user["badge"];
          $nickcolor = htmlentities($user["nickname_color"]);
    $nickcss = "";
    if(isset($nickcolor)){
      $nickcss = 'style=" background-color: ' . $nickcolor . ';"';
    }
        }
      }
      $id_in_yeahlist = strpos($yeahlist, $sessuid);
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
echo '<li id="reply" class="test-fresh-reply scroll other">
  <a href="./user.php?id=' . $uid . '" data-pjax="#body" class="scroll-focus user-icon-container"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon"></a>
  <div class="reply-content">
    <header>
      <span class="user-name" ' . $nickcss . '>' . $displayname . '</span>
      <span class="timestamp">' . $date . '</span>
      
    </header>


<p class="reply-content-text">' . $body . '</p>



    <div class="reply-meta">
      <button type="button" class="submit miitoo-button" data-feeling="normal" data-action="/replies/AYMHAAADAAADV44MUV9mpA/empathies" data-sound="SE_WAVE_MII_ADD" data-community-id="14866558073038702637" data-url-id="AYMHAAADAAADV44MUV9mpA" data-track-label="reply" data-title-id="14866558072985245728" data-track-action="yeah" data-track-category="empathy">Yeah!</button>
      <a class="to-permalink-button" data-pjax="#body">
        <span class="feeling">' . $yeahs . '</span>
      </a>
    </div>
  </div>
</li>';}}}
?>


</ul>

  </div>

</div>
</div>

    <a id="scroll-to-top" style="display: inline;" class="" href="#"></a>





<div id="capture-page" class="capture-page window-page none" data-modal-types="capture" data-is-template="1">
    <div class="capture-container">
        <div><img src="data:image/gif;base64,R0lGODlhEAAQAIAAAP%2F%2F%2FwAAACH5BAEAAAAALAAAAAAQABAAAAIOhI%2Bpy%2B0Po5y02ouzPgUAOw%3D%3D" class="capture"></div>
        <a href="#" class="olv-modal-close-button cancel-button accesskey-B" data-sound="SE_WAVE_CANCEL"><span>Back</span></a>
    </div>
</div>

  

<button type="button" class="accesskey-L" style="display: none;"></button><button type="button" class="accesskey-R" style="display: none;"></button><button type="button" class="accesskey-Y" style="display: none;"></button></body></html>