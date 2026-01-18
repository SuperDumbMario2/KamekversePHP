<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<html lang="en"><!--
  Archive processed by SingleFile 
  url: https://3ds-us.olv.nintendo.net/posts/AYMHAAADAAB2V0fXkfdAxA 
  saved date: Sun Nov 27 2016 02:33:42 GMT-0500 (Eastern Standard Time) 
 --><head>
     <meta charset="utf-8">
     <title>Kamekverse</title>
     <link rel="stylesheet" type="text/css" href="./ass/n3ds.css">
     
   </head>
   <body data-user-id="0005000e0000069" data-is-first-post="1" data-profile-url="">
     <div id="body" class="post-permalink" data-region-id="2">
 
 
 <div id="header">
   <div id="header-body">
     <h1 id="page-title"><span>Post</span></h1>
   </div>
 </div>
 
 
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

         $yeahlink = "\"../toggle_yeah.php?id=$pid&r=post&layout=n3ds\"";
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
 echo '<div id="post-permalink-content">
   <div id="header-meta">
     
 
     <p class="community-container"><a href="./community.php?id=' . $cid . '" class="community" data-pjax="1"><span class="community-container-inner"><img src="../cdn/community_icons/' . $cid . '.png" class="community-icon" width="14" height="14">' . $cname . '</span></a></p>
   </div>
   <div id="post-permalink-body" class="post scroll post-subtype-default">
     <a href="./user.php?id=' . $uid . '" data-pjax="1" class="user-icon-container scroll-focus"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon" width="32" height="32"></a>
     <header>
       <div class="header-inner">
         <p class="user-name"><a href="./user.php?id=' . $uid . '" data-pjax="1">' . $displayname . '</a></p>
         <p class="timestamp-container">
           <a class="timestamp">' . $date . '</a>
              
 
         </p>
       </div>
     </header>
 
 
 
     <div class="post-content">
 
             <p class="post-content-text">' . $body . '</p>
     </div>
 
 
 
     <div class="post-meta">
         
 
       <div class="expression">
       <a href=' . $yeahlink . '><button type="button" ' . $yeahdisable . ' class="symbol submit ' . $yeahdisable . ' empathy-button" data-feeling="normal" data-other-empathy-count="1"><span class="empathy-button-text">' . $yeahbutton . '</span></button></a>
       </div>
 
 
       
 
     </div>
 
   </div>
 
   <div id="empathy-content" class="post-permalink-feeling">
     <p class="post-permalink-feeling-text">' . $yeahs . ' people gave this a Yeah.</p>
     
   </div>
 </div>';
        }}}}
 ?>
 
 <div class="body-content">
   <div id="post-permalink-comments">
 
 <ul class="post-permalink-reply  list reply-list" data-parent-post-id="AYMHAAADAAB2V0fXkfdAxA">
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
       $nickcss = 'style=" color: ' . $nickcolor . ';"';
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
       echo '<li id="reply-AYMHAAADAAB2V0fXkwoYIQ" class="test-reply scroll other">
 
   
   
 
   <a href="./user.php?id=' . $uid . '" data-pjax="1" class="user-icon-container scroll-focus"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=" . $feeling . "" . '" class="user-icon"></a>
   <div class="reply-body">
     <header>
       <div class="header-inner">
         <p class="user-name"><a href="./user.php?id=' . $uid . '" data-pjax="1">' . $displayname . '</a></p>
         <p class="timestamp-container">
           <span class="timestamp">' . $date . '</span>
                   </p>
       </div>
     </header>
 
       <p class="reply-content-text">
         <a href="https://3ds-us.olv.nintendo.net/replies/AYMHAAADAAB2V0fXkwoYIQ" class="to-permalink-button" data-pjax="#body">' . $body . '</a>
       </p>
 
 
     <div class="reply-meta">
       <button type="button" class="symbol submit empathy-button reply" data-feeling="normal" data-action="/replies/AYMHAAADAAB2V0fXkwoYIQ/empathies"><span class="empathy-button-text">' . $yeahbutton . '</span></button>
       <span class="empathy symbol"><span class="symbol-label">Yeahs</span><span class="empathy-count">' . $yeahs . '</span></span>
       <div class="report-buttons-content">
         
       </div>
     </div>
 
 
   </div>
 </li>';
      }}}
 ?>
 
 
 
 </ul>
 
   </div>
   <div>
     <a href="https://3ds-us.olv.nintendo.net/posts/AYMHAAADAAB2V0fXkfdAxA/reply" class="post-button reply-button test-reply-button" data-pjax="1"><span class="symbol">Comment</span></a>
   </div>
 </div>    </div>
   
 </body></html>