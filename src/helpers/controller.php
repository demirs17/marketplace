<?php

use Config\AppConfig;

function view(string $view, array $data = []){
    foreach($data as $key=>$d){
        $$key = $d;
    }
    include(AppConfig::view_dir . "\\" . $view . ".php");
    exit;
}

function redirect(string $url, array $data = [])
{
    if (headers_sent() === false){
        foreach($data as $key=>$d){
            $$key = $d;
        }
        header('Location: ' . $url, true, false ? 301 : 302);
    }
    exit;
}