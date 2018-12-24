<?php
function action_index(){
    $data = [
        "title"=>"Главная",
        "currentUser"=>auth_currentUser(),
        "categories"=>rec_getCategories(),
        "files"=>rec_showCat(),
        "error"=>$_SESSION["error"]

    ];
    return renderViewWithTemplate("main","default",$data);
}

