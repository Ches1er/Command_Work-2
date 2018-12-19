<?php
function action_index(){
    $data = [
        "title"=>"Главная",
        "currentUser"=>auth_currentUser(),
        "error"=>$_SESSION["error"],
        "categories"=>rec_getCategories()
    ];
    return renderViewWithTemplate("main","default",$data);
}
