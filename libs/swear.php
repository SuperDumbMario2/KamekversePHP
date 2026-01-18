<?php
// kamekverse swearbot
// bans use of swear words in specific communities
$swearWords = ["fuck", "shit", "retarded", "retard", "nigga", "cunt", "nigger", "kike", "wigger", "bitch", "faggot", "tranny", "whore"];
// Check presence of swear words in a piece of text.
function checkSwear($content){
    // a shitty way to remove spaces from content
    $content = explode(" ", $content);
    $content = implode("", $content);
    $content = strtolower($content);
    global $swearWords;
    $result = false;
    foreach($swearWords as $s){
        $has = strpos($content, $s);
        if($has === false){
            continue;
        } else {
            $result = true;
            break;
        }
    }
    return $result;
}
// One-round swear word removal code
function removeSwears($content){
    $content = explode(" ", $content);
    global $swearWords;
    foreach($swearWords as $badword){
        if(in_array($badword, $content)){
            $swearpos = array_search($badword, $content);
            unset($content[$swearpos]);
        }
    }
    $content = implode(" ", $content);
    return $content;
}
// One-round aggressive swear word removal code
function removeSwearsA($content){
    $content = explode(" ", $content);
    $key = 0;
    foreach($content as $part){
        if(checkSwear($part)){
            unset($content[$key]);
        }
        $key++;
    }
    $content = implode(" ", $content);
    return $content;
}
// A proper censorship function, which ends after 100 rounds. A loop of removeSwears basically.
function censorSwears($content){
    for($i=0; $i<100; $i++){
        if(checkSwear($content)){
            $content = removeSwears($content);
        } else {break;}
    }
    return $content;
}
// A proper aggresive censorship function, which ends after 100 rounds. A loop of removeSwearsA basically.
function censorSwearsA($content){
    for($i=0; $i<100; $i++){
        if(checkSwear($content)){
            $content = removeSwearsA($content);
        } else {break;}
    }
    return $content;
}
?>