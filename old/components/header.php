
          
          <?php
          if(isset($sessuid)){
            echo '<menu id="global-menu"><li id="global-menu-logo"><h1><img src="./ass/menu-logo.png" alt="Miiverse" width="200" height="55"></h1></li><li id="global-menu">
            <ul>
              <li id="global-menu-mymenu"><a href="./user.php?id=' . $sessuid . '"><span class="icon-container official-user"><img src="https://mii-unsecure.ariankordi.net/miis/image.png?data=' . $cmii . '&amp;type=face&amp;width=120&amp;expression=normal" alt="User Page"></span><span>User Page</span></a></li>
        <li id="global-menu-feed"><a href="./feed.php" class="symbol"><span>Activity Feed</span></a></li>
              <li id="global-menu-community"><a href="./" class="symbol"><span>Communities</span></a></li>
        <li id="global-menu-news"><a href="./notifications.php" class="symbol"><span>Notifications</span><span class="badge" style="display: none;">0</span></a></li>
              
            </ul>
          </li></menu>';
          } else {
            echo '<menu id=""><li id="global-menu-logo"><h1><a href="./"><img src="./ass/menu-logo.png" alt="Miiverse" width="200" height="55"></a></h1></li><li id="global-menu-login">
              <a href="../login.php?r=old"><input type="image" alt="Sign in" src="./ass/signin_base.png"></a>
          </li>
          <a class="redesign-banner" href="../"><span class="redesign-banner-text">Kamekverse has the new Miiverse layout too!</span></a></menu>';
          }
          ?>
