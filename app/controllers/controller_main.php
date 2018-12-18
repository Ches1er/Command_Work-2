<?php
function action_index(){
    $data = [
        "title"=>"Главная",
        "currentUser"=>auth_currentUser(),
        "categories"=>rec_getCategories()
    ];
    return renderViewWithTemplate("main","default",$data);
}
