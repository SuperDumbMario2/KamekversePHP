<script src="./ass/complete-en.js"></script>
<?php
    if(isset($_SESSION["themes"])){
      $themes = $_SESSION["themes"];
      $themelist = explode(", ", $themes);
      foreach($themelist as $theme){
        echo '<link rel="stylesheet" type="text/css" href="./ass/' . $theme . '.css">';
      }
    }
    if(isset($_SESSION["themecolor"]) && isset($_SESSION["themes"])){
      $theme = $_SESSION["themecolor"];
      echo '<style>
      :root {
        --theme: ' . $theme . ' !important;
      }
      </style>';
    }
    ?>
<div id="wrapper">
      <div id="sub-body">
        <menu id="global-menu">
          <li id="global-menu-logo"><h1><a href="./"><img src="./ass/menu-logo.png" alt="Kamekverse" width="165" height="30"></a></h1></li>
          <li id="global-menu-login">
            <?php 
            if(isset($_SESSION["id"])){
              $id = $_SESSION["id"];
              $badge = "";
              $sql = "SELECT * FROM accounts WHERE id = '$id'";
              if($result = mysqli_query($conn, $sql)) {
                foreach($result as $acc) {
                  $displayname = $acc["displayname"];
                  $id = $acc["id"];
                  $mii = $acc["miidata"];
                  $badge = $acc["badge"];
                  $FRList = $acc["friend_request_list"];
                  $frnum = count(explode(", ", $FRList)) - 1;
                  /* echo '<div class="headline"><div class="username-container">
                  <span><h2><span>' . $acc["displayname"] . '</span></h2></span>
                  <div class="dropdown-menu">
                      <a href="./user.php?id=' . $id . '">My Profile</a><br>
                      <a href="./settings.php">Settings</a><br>
                      <a href="./logout.php">Logout</a>
                  </div>
              </div>'; */
              echo '<li id="global-menu-list">
              <ul>
                <li id="global-menu-mymenu"><a href="./user.php?id=' . $id . '"><span class="icon-container ' . $badge . '"><img src="https://mii-unsecure.ariankordi.net/miis/image.png?data=' . $mii . '&type=face&width=120&expression=normal" alt="User Page"></span><span>User Page</span></a></li>
          <li id="global-menu-feed"><a href="./feed.php" class="symbol"><span>Feed</span></a></li>
                <li id="global-menu-community"><a href="./" class="symbol"><span>Communities</span></a></li>
                <li id="global-menu-msg"><a href="./messagelist.php" class="symbol"><span>Messages</span></a></li>
          <li id="global-menu-news"><a href="./notifications.php" class="symbol">'; 
          if($frnum != 0){
            echo '<span class="badge">' . $frnum . '</span>';
          } else {
          echo '<span class="badge" style="display: none;">0</span>';
          }
           echo '</a></li>
                <li id="global-menu-my-menu"><button class="symbol js-open-global-my-menu open-global-my-menu"></button>
                  <menu id="global-my-menu" class="invisible none">
                    <li><a href="./settings.php" class="symbol my-menu-operman"><span><p style="font-family: \'MiiverseSymbols\'; display: inline; color: blue;">Y</p> Kamekverse settings</span></a></li>
                    <li><a href="./settings_acc.php" class="symbol my-menu-operman"><span><p style="font-family: \'MiiverseSymbols\'; display: inline; color: blue;">Y</p> Account settings</span></a></li>
                    ';
                    if($acc["admin"] == 1 || $anarchy == true){
                      echo '<li><a href="./admin.php" class="symbol my-menu-operman"><span><p style="font-family: \'MiiverseSymbols\'; display: inline; color: blue;">Y</p> Admin panel</span></a></li>';
                    }
                    echo '<li><a href="./logout.php" class="symbol my-menu-openman"><span>Log out</span></a></li>
                  </menu>
                </li>
              </ul>
            </li>';
                }
              }
            }
            else{
              echo '<a href="./login.php">
              <input type="image" alt="Sign in" src="./ass/signin_base.png">
            </a>'; 
            }
            ?>
          </li>
        </menu>
      </div>