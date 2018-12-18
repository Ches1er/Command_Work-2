<?php

function action_addcat(){
    $catname = $_POST["cat_name"];
    rec_addCat($catname);
    redirect("/");
    return "";
}