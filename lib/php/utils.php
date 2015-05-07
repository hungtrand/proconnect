<?php
/**
 * Format a timestamp to display its age (5 days ago, in 3 days, etc.).
 *
 * @param   int     $timestamp
 * @return  string
 */
function timetostr($timestamp) {
    return '';
    $age = time() - strtotime($timestamp);
    if ($age == 0)
        return "just now";
    $future = ($age < 0);
    $age = abs($age);

    $age = (int)($age / 60);        // minutes ago
    if ($age == 0) return $future ? "momentarily" : "just now";

    $scales = [
        ["min", "min", 60],
        ["hr", "hr", 24],
        ["d", "d", 7],
        ["wk", "wk", 4.348214286],     // average with leap year every 4 years
        ["month", "months", 12],
        ["year", "years", 10],
        ["decade", "decades", 10],
        ["century", "centuries", 1000],
        ["millenium", "millenia", PHP_INT_MAX]
    ];

    foreach ($scales as list($singular, $plural, $factor)) {
        if ($age == 0)
            return $future
                ? "in less than 1 $singular"
                : "less than 1 $singular ago";
        if ($age == 1)
            return $future
                ? "in 1 $singular"
                : "1 $singular ago";
        if ($age < $factor)
            return $future
                ? "in $age $plural"
                : "$age $plural ago";
        $age = (int)($age / $factor);
    }
}

function compress_image($source_url, $destination_url, $quality) { 
    $info = getimagesize($source_url); 

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source_url); 
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source_url); 
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source_url); 
        imagejpeg($image, $destination_url, $quality); 

    return $destination_url; 
}
?>