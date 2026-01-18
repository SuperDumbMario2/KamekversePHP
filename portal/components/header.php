<menu id="global-menu">
<script type="text/javascript" src="./ass/complete-emu.js"></script>
<script type="text/javascript" src="./ass/complete-en.js"></script>
      <?php
      if(isset($sessuid)){
        $sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
        if($result = mysqli_query($conn, $sql)){
          foreach($result as $usr){
            $mii = $usr["miidata"];
            echo '<li id="global-menu-mymenu"><a href="./user.php?id=' . $sessuid . '" data-pjax="#body" data-sound="SE_WAVE_MENU"><span class="mii-icon"><img src="' . "https://mii-unsecure.ariankordi.net/miis/image.png?data=" . $mii . "&type=face&width=120&expression=normal alt=\"User Page\"></span><span>User Page</span></a></li>";
          }
        }
      } else {
        echo '<li id="global-menu-mymenu"><a href="../login.php?r=portal" data-pjax="#body" data-sound="SE_WAVE_MENU"><span class="mii-icon"><img src="./ass/empty.png" alt=\"Login\"></span><span>Log in</span></a></li>';
      }
      ?>
      <li id="global-menu-feed"><a href="./activity.php" data-pjax="#body" data-sound="SE_WAVE_MENU">Activity Feed</a></li>
      <li id="global-menu-community" class="selected"><a href="./" data-pjax="#body" data-sound="SE_WAVE_MENU">Communities</a></li>
      <li id="global-menu-message"><a href="./messagelist.php" data-pjax="#body" data-sound="SE_WAVE_MENU">Messages<span class="badge" style="display: none;">0</span></a></li>
      <li id="global-menu-news"><a href="https://portal-t1.olv.app.nintendo.net/news/my_news" data-pjax="#body" data-sound="SE_WAVE_MENU">Notifications<span class="badge" style="display: none;">0</span></a></li>
      <li id="global-menu-exit"><a href="#" role="button" data-sound="SE_WAVE_EXIT">Close</a></li>
      <li id="global-menu-back" class="none"><a href="#" role="button" class="accesskey-B" data-sound="SE_WAVE_BACK">Back</a></li>
    </menu>