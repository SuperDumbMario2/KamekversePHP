<?php
// id generator for koopa/kamekverse
// generates ids faithful to Miiverse.
function generate_kop_id($feature){
    if($feature == "post"){
        $prepend = "AYMHAAADAAADV44";
        $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $rand = str_shuffle($chars);
        $id = $prepend . substr($rand, 0, 8);
    } elseif($feature == "general"){
        $chars = "1234567890abcdef";
        $id = str_shuffle($chars);
    } elseif($feature == "invite"){
        $id = "";
        $chars = "ABCDEF1234567890";
        for($i = 0; $i<4; $i++){
            $id = $id . substr(str_shuffle($chars), 0, 3) . "-";
        }
        $id = substr($id, 0, 15);
    }
    return $id;
}
?>