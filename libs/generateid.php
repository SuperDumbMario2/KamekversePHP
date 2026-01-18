<?php
// An ID lib for kamekverse, deprecated due to superior Koopa ID lib. This is kept for archival purposes, as well as legacy stuff
function generateid(){
    $length = 20;
    return substr(bin2hex(random_bytes($length)), 0, $length);
}
?>