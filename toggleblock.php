<?php
include "./dbconnect.php";
include "./cfg.php";
if(isset($_SESSION["id"]) == false){
  header("Location: ./login.php");
} else {
    $id = $_GET["id"];
    $blocks = $blocklistar;
    if(in_array($id, $blocks) !== false){
        unset($blocks[in_array($id, $blocks)]);
    }
    else{
        $blocks[] = $id;
    }
    $blocks = mysqli_real_escape_string($conn, implode(", ", $blocks));
    $sql = "UPDATE accounts SET blockList = '$blocks' WHERE id = '$sessuid'";
    if(mysqli_query($conn, $sql)){
        header("Location: ./user.php?id=$id");
    } else {
        echo "Error blocking $id!";
    }
}
?>