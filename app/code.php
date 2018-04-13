<?php


function generateLink($folders, $fileName, $host = null) {
    $link = "";
    if (isset($host) && $host != "") {
        $link .= $host . '/';
    }
    if (isset($folders) && $folders != "") {

            $link .= $folders . '/';

    }
    if (isset($fileName) && $folders != "") {
        $link .= $fileName . '.html';
    }
    return $link;
}