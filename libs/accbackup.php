<?php
// acc backup lib for kamekverse, creates and imports data backups. allows also creation of community backups.
// create acc backup
function createAccBackup(string $accid, int $postdepth, bool $full){
    include_once "./dbconnect.php";
    global $conn;
    $rfull = false;
    if(isset($_SESSION["id"]) && $_SESSION["id"] == $accid && $full == true){
        $rfull = true;
    }
    $backup = "{\"type\":\"user\"; \"full\":\"$rfull\";\"miidata\":\"";
    $sql = "SELECT * FROM accounts WHERE id = '$accid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) != 0){
            foreach($result as $user){
                $miidata = $user["miidata"];
                $backup = $backup . "$miidata\";\"username:\"";
                $username = $user["username"];
                $backup = $backup . "$username\";\"displayname:\"";
                $username = $user["displayname"];
                $backup = $backup . "$username\";\"description:\"";
                $description = $user["description"];
                $backup = $backup . "$description\";\"discord:\"";
                $discord = $user["discord"];
                $backup = $backup . "$discord\";\"skill:\"";
                $skill = $user["skill"];
                $backup = $backup . "$skill\";\"nickname_color:\"";
                $nickname_color = $user["nickname_color"];
                $backup = $backup . "$nickname_color\";\"fav_communities:\"";
                $fav_communities = $user["fav_communities"];
                $backup = $backup . "$fav_communities\";\"id:\"";
                $id = $user["id"];
                $backup = $backup . "$id\";\"community_list:\"";
                if($full == true){
                    $sql = "SELECT * FROM community WHERE creator_id = '$id' ORDER BY pk DESC";
                } else {
                    $sql = "SELECT * FROM community WHERE creator_id = '$id' AND private = 0";
                }
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $com){
                        $cid = $com["id"];
                        $cname = $com["name"];
                        $cdesc = $com["description"];
                        $cname = $com["name"];
                        $callowedusers = $com["allowed_userlist"];
                        $community_flair_id = $com["community_flair_id"];
                        $flair_name = $com["flair_name"];
                        $blue_badges = $com["blue_badges"];
                        $golden_badges = $com["golden_badges"];
                        $is_swearblocked = $com["is_swearblocked"];
                        $backup = $backup . "{\"id\":\"$cid\";\"name\":\"$cname\";\"description\":\"$cdesc\";\"allowed_userlist\":\"$callowedusers\";\"community_flair_id\":\"$community_flair_id\";\"flair_name\":\"$flair_name\";\"blue_badges\":\"$blue_badges\";\"golden_badges\":\"$golden_badges\";\"is_swearblocked\":\"$is_swearblocked\";};";
                    }
                }
                $backup = $backup . "\";\"post_list:\"";
                if($postdepth == -1){
                    $sql = "SELECT * FROM posts WHERE creator_id = '$id'";
                } else {
                    $sql = "SELECT * FROM posts WHERE creator_id = '$id' LIMIT $postdepth";
                }
                if($result = mysqli_query($conn, $sql)){
                    foreach($result as $post){
                        $pid = $post["id"];
                        $pcid = mysqli_real_escape_string($conn, $post["community_id"]);
                        if(!$full){
                            $sql = "SELECT * FROM community WHERE id = '$pcid'";
                            if($result = mysqli_query($conn, $sql)){
                                foreach($result as $communi){
                                    $privacy = $communi["private"];
                                }
                            }
                            if($privacy == true){
                                continue;
                            }
                        }
                        $feeling = $post["feeling"];
                        $pbody = $post["body"];
                        $pid_old = $post["id_old"];
                        $pis_old = $post["is_old"];
                        $pcreation_date = $post["creation_date"];
                        $phas_image = $post["has_image"];
                        $backup = $backup . "{\"id\":\"$pid\";\"community_id\":\"$pcid\";\"feeling\":\"$feeling\";\"body\":\"$pbody\";\"id_old\":\"$pid_old\";\"is_old\":\"$pis_old\";\"creation_date\":\"$pcreation_date\";\"has_image\":\"$phas_image\"};";
                        }
                    }
                    $backup = $backup . "\";\"comment_list\":\"";
                    $sql = "SELECT * FROM comments WHERE creator_id = '$id'";
                    if($result = mysqli_query($conn, $sql)){
                        foreach($result as $comment){
                            $cid = $comment["id"];
                            $cpid = $comment["post_id"];
                            if(!$full){
                                $sql = "SELECT * FROM posts WHERE id = '$cpid'";
                                if($result = mysqli_query($conn, $sql)){
                                    foreach($result as $op){
                                        $opc = $op["community_id"];
                                        $sql = "SELECT * FROM community WHERE id = '$opc'";
                                        if($result = mysqli_query($conn, $sql)){
                                            foreach($result as $communi){
                                                $privacy = $communi["private"];
                                            }
                                        }
                                    }
                                }
                                if($privacy == true){
                                    continue;
                                }
                            }
                            $cbody = $comment["body"];
                            $ccreation_date = $comment["creation_date"];
                            $cfeeling = $comment["feeling"];
                            $backup = $backup . "{\"id\":\"$cid\";\"post_id\":\"$cpid\";\"body\":\"$cbody\";\"creation_date\":\"$ccreation_date\";\"feeling\":\"$cfeeling\";};";
                        }
                    }
                    $backup = $backup . "\";}";
            }
        } else {
            return "{\"errorcode\":\"user_does_not_exist\"}";
        }
    }
    return $backup;
}
// echo createAccBackup("cc1938594866f2277877", -1, true)
?>