<style>
    /* Initially hide the dropdown */
    .dropdown-menu {
        display: none;
        border: 1px solid #ccc; /* Add a border for the box */
        background-color: #f9f9f9; /* Light background for the box */
        padding: 10px; /* Add some padding to the box */
        position: absolute; /* Ensure it stays within the container */
        z-index: 1000; /* Bring it to the top layer */
    }

    /* Show the dropdown box when hovering over the container */
    .username-container:hover .dropdown-menu {
        display: block;
    }

    /* Style the options inside the dropdown menu */
    .dropdown-menu > .option {
        margin: 5px 0; /* Space between options */
        cursor: pointer; /* Make it clear that options are clickable */
    }

    .dropdown-menu > .option:hover {
        background-color: #e0e0e0; /* Highlight the option when hovered */
    }
</style>
<div id="wrapper">
      <div id="sub-body">
        <menu id="global-menu">
          <li id="global-menu-logo"><h1><a href="./"><img src="./ass/menu-logo.png" alt="Miiverse" width="165" height="30"></a></h1></li>
          <li id="global-menu-login">
            <?php 
            if(isset($_SESSION["id"])){
              $id = $_SESSION["id"];
              $sql = "SELECT * FROM accounts WHERE id = '$id'";
              if($result = mysqli_query($conn, $sql)) {
                foreach($result as $acc) {
                  $displayname = $acc["displayname"];
                  echo '    <div class="username-container">
                  <span>' . $acc["displayname"] . '</span>
                  <div class="dropdown-menu">
                      <a href="./user.php?id=' . $id . '">My Profile</a><br>
                      <a href="./settings.php">Settings</a><br>
                      <a href="./logout.php">Logout</a>
                  </div>
              </div>';
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