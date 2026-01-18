<?php 
include "../dbconnect.php";
include "../cfg.php";
if($login_only == true){
  if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
}
}
?>
<!DOCTYPE html>
<html lang="en"><!--
 Archive processed by SingleFile 
 url: https://ctr-d1.olv.app.nintendo.net/communities 
 saved date: Mon Mar 20 2017 23:53:07 GMT-0400 (Eastern Daylight Time) 
--><head>
    <meta charset="utf-8">
    <title>Kamekverse</title>
    <link rel="stylesheet" type="text/css" href="./ass/n3ds.css">
    <script type="text/javascript" src="./ass/complete_en.js"></script>
  <link type="image/x-icon" rel="shortcut icon" href="data:text/html;base64,PGh0bWw+DQo8aGVhZD48dGl0bGU+NDA0IE5vdCBGb3VuZDwvdGl0bGU+PC9oZWFkPg0KPGJvZHkgYmdjb2xvcj0id2hpdGUiPg0KPGNlbnRlcj48aDE+NDA0IE5vdCBGb3VuZDwvaDE+PC9jZW50ZXI+DQo8aHI+PGNlbnRlcj5uZ2lueDwvY2VudGVyPg0KPC9ib2R5Pg0KPC9odG1sPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0KPCEtLSBhIHBhZGRpbmcgdG8gZGlzYWJsZSBNU0lFIGFuZCBDaHJvbWUgZnJpZW5kbHkgZXJyb3IgcGFnZSAtLT4NCjwhLS0gYSBwYWRkaW5nIHRvIGRpc2FibGUgTVNJRSBhbmQgQ2hyb21lIGZyaWVuZGx5IGVycm9yIHBhZ2UgLS0+DQo8IS0tIGEgcGFkZGluZyB0byBkaXNhYmxlIE1TSUUgYW5kIENocm9tZSBmcmllbmRseSBlcnJvciBwYWdlIC0tPg0K"></head>
  <body data-user-id="" data-is-first-post="1" data-is-first-favorite="1">
    <div id="body" class="console-selector-top" data-region-id="2"><div class="title-header text-header">
  <div class="header-banner-container">
    <div class="header-banner">
      <p>Check out the lists of supported consoles on Kamekverse to see communities for any of them!</p>
    </div>
  </div>
  <h1 class="info-content">
    <span class="icon-container"></span>
    <span class="title-container">
      <span class="title">Consoles</span>
    </span>
  </h1>
</div>
<div class="community-top-top-container">
</div>

<div class="body-content" id="community-top" data-region="USA">
  <div class="platform-button-list">
  
  <a href="./?view_platform=switch2" class="platform-button platform-button-switch2" data-pjax="1">Switch 2 Communities</a>
  <a href="./?view_platform=switch" class="platform-button platform-button-switch" data-pjax="1">Switch Communities</a>
  <a href="./?view_platform=3ds" class="platform-button platform-button-3ds" data-pjax="1">3DS Communities</a>
  <a href="./?view_platform=wiiu" class="platform-button platform-button-wiiu" data-pjax="1">Wii U Communities</a>
  <a href="./?view_platform=wii" class="platform-button platform-button-wii" data-pjax="1">Wii Communities</a>
  <a href="./?view_platform=ds" class="platform-button platform-button-wii" data-pjax="1">DS Communities</a>
  <a href="./?view_platform=gcn" class="platform-button platform-button-gcn" data-pjax="1">GameCube Communities</a>
  <a href="./?view_platform=gba" class="platform-button platform-button-gcn" data-pjax="1">Gameboy Advance Communities</a>
  <a href="./?view_platform=n64" class="platform-button platform-button-n64" data-pjax="1">Nintendo 64 Communities</a>
  <a href="./?view_platform=vb" class="platform-button platform-button-vb" data-pjax="1">Virtual Boy Communities</a>
  <br>
  <a href="./?view_platform=gb" class="platform-button platform-button-wii" data-pjax="1">Game Boy Communities</a>
  <a href="./?view_platform=snes" class="platform-button platform-button-snes" data-pjax="1">SNES Communities</a>
  <br>
  <a href="./?view_platform=nes" class="platform-button platform-button-3ds" data-pjax="1">NES Communities</a>
</div>
</div>

    </div>
  
</body></html>