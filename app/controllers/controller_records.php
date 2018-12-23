<?php

function action_addcat(){
    $catname = $_POST["cat_name"];
    rec_addCat($catname);
    redirect("/");
    return "";
}
function action_delcat(){
    $catname=$_GET["catName"];
    rec_delCat($catname);
    return redirect("/");
}

function action_viewcat(){
    $catname=$_GET["catName"];
    putCurrentCatIntoSession($catname);
    rec_showCat();
    return redirect("/");
}
function action_addfile(){
    $filename=$_POST["file_name"];
    $filevalue=$_POST["key"];
    rec_addFile($filename,$filevalue);
    return redirect("/");
}
function action_delfile(){
    $filename=$_GET["fileName"];
    rec_delFile($filename);
    return redirect("/");



}
