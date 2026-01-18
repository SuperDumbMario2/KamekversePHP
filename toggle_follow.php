<?php
include "./dbconnect.php";
include "./cfg.php";
if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
} else {
    $rid = mysqli_real_escape_string($conn, $_GET["id"]);
    $cid = $sessuid;
    $sql = "SELECT * FROM accounts WHERE id = '$cid'";
    if($result = mysqli_query($conn, $sql)){
        foreach($result as $cu){
            $myfollowlist = explode(", ", $cu["following"]);

            $ridinmyfollowlist = array_search($rid, $myfollowlist);
            if($ridinmyfollowlist === false){
                $t = 1;
                $myfollowlist[] = $rid;
            } else {
                $t = 0;
                unset($myfollowlist[$ridinmyfollowlist]);
            }
            $sql = "UPDATE accounts SET following = '" . implode(", ", $myfollowlist) . "' WHERE id = '$cid'";
            if(mysqli_query($conn, $sql)){
                // Done updating the followed list on your acc, now update the follower list on the acc you want to follow.
                $sql = "SELECT * FROM accounts WHERE id = $rid";
                foreach($result as $ru){
                    $rufollowlist = explode(", ", $cu["follower_list"]);
                    $rufollows = $cu["followers"];
                    $cidinrufollowlist = array_search($cid, $rufollowlist);
                    if($t == 1){
                        $rufollowlist[] = $cid;
                        $rufollows = $rufollows + 1;
                    } else {
                        if ($rufollows > 0) {
                        unset($array[$cidinrufollowlist]);
                        $rufollows = $rufollows - 1;
                        }
                    }
                    $sql = "UPDATE accounts SET follower_list = '" . implode(", ", $rufollowlist) . "', followers = '$rufollows' WHERE id = '$rid'";
                    if(mysqli_query($conn, $sql)){
                        header("Location: ./user.php?id=$rid");
                    }
                }
            }
        }
    }
}
?>