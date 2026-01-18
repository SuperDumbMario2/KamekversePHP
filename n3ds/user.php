<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en"><head><script type="text/javascript">Object.defineProperty(window.navigator, 'userAgent', { get: function(){ return 'Mozilla/5.0 (Nintendo 3DS/3) AppleWebKit/532.7 (KHTML, like Gecko) NX/1.8.9 miiverse/8.1.prod.US'; } });Object.defineProperty(window.navigator, 'vendor', { get: function(){ return ''; } });</script>
  <meta charset="utf-8">
  <title>Kamekverse</title>
  
  
<link type="image/x-icon" rel="shortcut icon" href="data:text/html;base64,PGh0bWw+DQo8aGVhZD48dGl0bGU+NDA0IE5vdCBGb3VuZDwvdGl0bGU+PC9oZWFkPg0KPGJvZHkgYmdjb2xvcj0id2hpdGUiPg0KPGNlbnRlcj48aDE+NDA0IE5vdCBGb3VuZDwvaDE+PC9jZW50ZXI+DQo8aHI+PGNlbnRlcj5uZ2lueDwvY2VudGVyPg0KPC9ib2R5Pg0KPC9odG1sPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0K">
<link rel="stylesheet" type="text/css" href="./ass/n3ds.css">
<script type="text/javascript" src="./ass/complete_en.js"></script></head>
<body data-user-id="" data-is-first-post="1" data-is-first-favorite="1" data-profile-url="/users/EricDSucksG">
  <div id="body" class="user-page" data-region-id="2">

<div id="user-content-container">
<div id="user-content" class="user-page 
   is-visitor">
  <div id="header">
    <div id="header-body">
      <h1 id="page-title"><span> User Page</span></h1>
    </div>
  </div>
  <?php
  if(isset($_GET["id"])){
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "SELECT * FROM accounts WHERE id = '$id'";
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
  echo '<div class="icon-name-container">
    <div class="user-icon-container  ' . $badge . ' "><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=normal" . '" class="user-icon" width="32" height="32"></div>
    <p class="title">
      
      <span class="nick-name" ' . $nickcss . '>' . $displayname . '</span>
      <span class="id-name">' . $username . '</span>
    </p>
  </div>
</div>
<div id="header-meta">
  
  
  
  
</div>
</div><div id="nav-menu" class="nav-3">
<a data-pjax="1" class="test-user-posts-count ">
  <span class="number">' . $friends . '</span>
  <span class="name">Friends</span>
</a>

<a data-pjax="1" class="test-user-followers-count ">
  <span class="number">' . $followers . '</span>
  <span class="name">Followers</span>
</a>
</div>
<div class="body-content">
<div class="profile-content">';
if(isset($bio)){
  echo '<p class="profile-comment">' . $bio . '</p>';
}

echo '<div class="
   is-visitor">
  <table>
    <tbody>
    
    <tr class="game-skill">
      <th><span>Game Experience</span></th>
      <td>
        <span class="' . $skill . '">' . ucfirst($skill) . '</span>
      </td>
    </tr>
    ';
    if(strlen($discord) != 0){
      echo '<tr class="">
      <th><span>Discord tag</span></th>
      <td>' . $discord . '</td>
    </tr>';
    }
    echo '
  </tbody></table>
</div>';
      }}}} else {die("User not found");}}
?>
 <div class="post-list list">
    <h2 class="headline">Recent Posts</h2>
      <?php
      $sql = "SELECT * FROM posts WHERE (creator_id = '$id') ORDER BY pk DESC";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) != 0){
      foreach($result as $posts){
        $pid = htmlentities($posts["id"]);
        $body = htmlentities($posts["body"]);
        $yeahs = htmlentities($posts["yeahs"]);
        $replies = htmlentities($posts["replies"]);
        $feeling =  htmlentities($posts["feeling"]);
        $uid = htmlentities($posts["creator_id"]);
        $cid = mysqli_real_escape_string($conn, $posts["community_id"]);
        $date = htmlentities($posts["creation_date"]);
        $yeahlist = htmlentities($posts["yeahlist"]);
        $nahlist = htmlentities($posts["nahlist"]);
        $nahs = htmlentities($posts["nahs"]);
        $cname = "Undefined community ID $cid";
        $sqlc = "SELECT * FROM community WHERE id = '$cid'";
        if($result3 = mysqli_query($conn, $sqlc)) {
          foreach($result3 as $community){
            $cname = $community["name"];
          }
        }
        if(isset($sessuid) == false){
          $sessuid = false;
        }
        $yeahdisable = "";
        $nahdisable = "";
        $yeahlink = "\"./toggle_yeah.php?id=$pid&r=user\"";
        $id_in_yeahlist = strpos($yeahlist, $sessuid);
        if(isset($_SESSION["id"]) == false){
          $yeahlink = "";
          $yeahdisable = "disabled";
        } elseif($id_in_yeahlist !== false){
          $empathy_added = "empathy-added";
        } elseif($_SESSION["id"] == $id) {
          $yeahlink = "";
          $yeahdisable = "disabled";
        }
        if(isset($sessuid) && $sessuid == $uid){
          $yeahlink = "";
          $nahlink = "";
          $yeahdisable = "disabled";
          $nahdisable = "disabled";
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
        <div class="body">
        <a href="./user.php?id=' . $uid . '" data-pjax="1" class="user-icon-container ' . $badge . ' scroll-focus"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon" width="32" height="32"></a>
        <div class="post-container">
          <div class="user-container">
            <p class="user-name"><a href="./user.php?id=' . $uid . '" data-pjax="1" ' . $nickcss . '>' . $username . '</a></p>
            <p class="timestamp-container">
                <span class="timestamp">' . $date . '</span>
                
            </p>
          </div>      <div class="post-content">        <p class="post-content-text">
              <a href="./post.php?id=' . $pid . '" class="to-permalink-button" data-pjax="1" tabindex="0">' . $body . '</a>
            </p>        <div class="post-meta">
            <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit empathy-button ' . $yeahdisable . '" data-feeling="normal"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a>
              <span class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></span><span class="reply symbol"><span class="symbol-label">Comment</span><span class="reply-count">' . $replies . '</span></span>
            </div>
          </div>
        </div>
      </div>
    </div>';
          }} else {die('<div class="no-content">
            <p>No posts yet.</p>
          </div>');}}
      ?>
    
  </div>
 
</div>
</div> </div>

</body></html>