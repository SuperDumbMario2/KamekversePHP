<?php
include "./dbconnect.php";
include "./cfg.php";
if(isset($_SESSION["id"]) == false){
    header("Location: ./login.php");
  } else {
    if(isset($_GET["id"])){
    $rid = $_GET["id"];
    $sql = "SELECT * FROM accounts WHERE id = '$sessuid'";
    if($result = mysqli_query($conn, $sql)){
        foreach($result as $me){
            $fr = explode(", ", $me["friend_request_list"]);
            $f = explode(", ", $me["friend_list"]);
            $fa = $me["friends"];
            $ridinmyfrlist = array_search($rid, $fr);
            if($ridinmyfrlist !== false){
                unset($fr[$ridinmyfrlist]);
                $f[] = $rid;
                $fa = $fa+1;
            } else {
                echo "This user did not friend-request you!";
            }
            $fr = implode(", ", $fr);
            $f = implode(", ", $f);
            $sql = "UPDATE accounts SET friend_request_list = '$fr', friend_list = '$f', friends = '" . $fa . "' WHERE id = '$sessuid'";
            if(mysqli_query($conn, $sql)){
                $sql = "SELECT * FROM accounts WHERE id = '$rid'";
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $fr){
            $f = explode(", ", $fr["friend_list"]);
            $fa = $fr["friends"];
            $ridinfrlist = array_search($rid, $fr);
                $f[] = $sessuid;
                $fa = $fa+1;
            $fr = implode(", ", $fr);
            $f = implode(", ", $f);
            $sql = "UPDATE accounts SET friend_list = '$f', friends = '" . $fa . "' WHERE id = '$rid'";
            if(mysqli_query($conn, $sql)){
                header("Location: ./notifications.php");
            }
                    }
                }
            }
        }
    }
} else {
    echo "No user requested";
}
  }
?>