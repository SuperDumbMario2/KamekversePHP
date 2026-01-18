<?php
// This code handles sending friend requests, cancelling them and unfriending users.
// If you want to see the logic of accepting them, see the "accept_fr.php" file.
include "./dbconnect.php";
include "./cfg.php";
if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
} else {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $cid = $sessuid;
    $sql = "SELECT * FROM accounts WHERE id = '$id'";
    if($result = mysqli_query($conn, $sql)){
        foreach($result as $usr){
           $friendrlist = explode(", ", $usr["friend_request_list"]);
           $friendlist = explode(", ", $usr["friend_list"]);
           $friends = $usr["friends"]; 
           $idinfriendr = array_search($cid, $friendrlist);
           $idinfriend = array_search($cid, $friendlist);
           if($idinfriendr === false && $idinfriend === false){
            $friendrlist[] = $cid;
           } elseif($idinfriend !== false && $idinfriendr === false) {
            unset($friendlist[$idinfriend]);
            $friends = $friends - 1;
           } else {
            unset($friendrlist[$idinfriendr]);
           }
           $friendrlist = implode(", ", $friendrlist);
           $friendlist = implode(", ", $friendlist);
           $sql = "UPDATE accounts SET friend_request_list = '$friendrlist', friends = '$friends', friend_list = '$friendlist' WHERE id = '$id'";
           if(mysqli_query($conn, $sql)){
            header("Location: ./user.php?id=$id");
           } else {
            echo "error!";
           }
        }
    }
}
?>