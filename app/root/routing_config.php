<?php
return [
    "/" => "main@index",
    "/login" => "login@login",
    "/register" => "login@register",
    "/logout" => "login@logout",
    "/login/handle" => "login@loginhandle",
    "/register/handle" => "login@registerhandle",
    "/contacts" => "main@contacts",
    "addcat"=>"records@addcat",
    "/delcat"=>"records@delcat",
    "/viewcat"=>"records@viewcat",
    "/addfile"=>"records@addfile",
    "/delfile"=>"records@delfile"
];
