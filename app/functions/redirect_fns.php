<?php

function redirect($url){
    header("Location:{$url}");
    return "";
}

function redirect_back_with_errors($errors)
{
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION["errors"] = $errors;
    $_SESSION["old"] = $_POST;
    return redirect($_SERVER["HTTP_REFERER"]);
}
