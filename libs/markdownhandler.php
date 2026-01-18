<?php
// kamekverse bb/custom emoji handler
// markdown converter, unused as it's replaced with bb code converter
function markdownToHTML($text){
    $text = explode("\n", $text);
    foreach($text as $line){
        if(str_starts_with($line, "# ")){
            $nline = str_replace("# ", "", $line);
            $nline = "<h1 class=\"heading1\">" . $nline . "</h1>";
        } elseif(str_starts_with($line, "## ")){
            $nline = str_replace("## ", "", $line);
            $nline = "<h2 class=\"heading2\">" . $nline . "</h2>";
        } elseif(str_starts_with($line, "### ")){
            $nline = str_replace("### ", "", $line);
            $nline = "<h3 class=\"heading3\">" . $nline . "</h3>";
        } elseif(str_starts_with($line, "#### ")){
            $nline = str_replace("#### ", "", $line);
            $nline = "<h4>" . $nline . "</h4>";
        } elseif(str_starts_with($line, "##### ")){
            $nline = str_replace("##### ", "", $line);
            $nline = "<h5 class=\"heading5\">" . $nline . "</h5>";
        } else {
            $nline = $line;
        }
        $ntext[] = $nline;
    }
    $ntext = implode("\n", $ntext);
    return $ntext;
}
// bb code converter
function bbToHTML($text){
    $text = str_replace("[b]", "<b class=\"bold\">",  $text);
    $text = str_replace("[/b]", "</b>",  $text);
    return $text;
}
/* echo markdownToHTML("# Test
## Test
### Test
#### Test
##### Test

uwuwuwuwuuw"); */
// echo bbToHTML("[b]test[/b]");
?>