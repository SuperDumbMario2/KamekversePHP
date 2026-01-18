<?php
include "./dbconnect.php";
include "./cfg.php";
if (isset($_SESSION["id"])) {
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($conn, $_GET["id"]);
        $cliid = $_SESSION["id"];
        if(isset($_GET["mode"]) && $_GET["mode"]=="comment"){
            $comment = true;
            $sql = "SELECT * from comments WHERE id = '$id'";
        }
        else{
            $comment = false;
            $sql = "SELECT * from posts WHERE id = '$id'";
        }

        if($result = mysqli_query($conn, $sql)){
            foreach($result as $post){
                $nahs = $post["nahs"];
                $nahlist = $post["nahlist"];
                
                    $community = $post["community_id"];
                    $user = $post["creator_id"];
                if($comment == false) {
                $pid = $post["id"];
                }
                else{
                    $pid = $post["post_id"];
                }
                $id_in_nahlist = strpos($nahlist, $cliid);
                if($id_in_nahlist == false){
                    $nahs = $nahs+1;
                    $nahlist = $nahlist . ", " . $cliid;
                }
                else{
                    echo $id_in_nahlist;
                    $nahs = $nahs-1;
                    $nahlist = str_replace(", " . $cliid, "", $nahlist); 
                }
                if($comment == false){
                    $sql = "UPDATE posts SET nahs = '$nahs', nahlist = '$nahlist' WHERE id = '$id'";
                }
                else{
                    $sql = "UPDATE comments SET nahs = '$nahs', nahlist = '$nahlist' WHERE id = '$id'";
                }
                if($result2 = mysqli_query($conn, $sql)){
                    $sql = "SELECT * FROM accounts WHERE id = '$user'";
                    if($result = mysqli_query($conn, $sql)){
                        foreach($result as $op){
                            $karma = $op["karma"];
                            if($id_in_nahlist == false){
                                $karma = $op["karma"]-1;
                            } else {
                                $karma = $op["karma"]+1;
                            }
                            $sql = "UPDATE accounts SET karma = $karma WHERE id = '$user'";
                            if(mysqli_query($conn, $sql)){
                                if(isset($_GET["r"])){
                                    $r = $_GET["r"];
                                    if($r=="community"){
                                        if($layout == "offdevice"){
                                            header("Location: ./community.php?id=$community");
                                        } else {
                                            header("Location: ./$layout/community.php?id=$community");
                                        }
                                    }
                                    elseif($r=="post"){
                                        if($layout == "offdevice"){
                                        header("Location: ./post.php?id=$pid");
                                    } else {
                                        header("Location: ./$layout/post.php?id=$pid");
                                    }
                                    }
                                    elseif($r=="user"){
                                        if($layout == "offdevice"){
                                        header("Location: ./user.php?id=$user");
                                    } else {
                                        header("Location: ./$layout/user.php?id=$user");
                                    }
                                    }
                                    elseif($r=="feed"){
                                        if($layout == "offdevice"){
                                        header("Location: ./feed.php");
                                        } else {
                                            header("Location: ./$layout/feed.php");
                                        }
                                    }
                                    elseif($r=="activity"){
                                        if($layout == "offdevice"){
                                        header("Location: ./activity.php");
                                    } else {
                                        header("Location: ./$layout/activity.php");
                                    }
                                    }
                                    else{
                                        echo "idk where to redirect you. layout: $layout";
                                    }
                                 }
                                 else{
                                    echo "no redirect parameter specifed so idk where to redirect you.";
                                 }
                            }
                        }
                    }
                }
            }
        }
    }
}
else{
    header("Location: ./login.php");
}
?>