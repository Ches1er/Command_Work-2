<?php
include_once FNSPATH . "records_fns.php";

function action_index(){
    $data=[];
    $data["title"]="Заметки";
    $data["notes"]=todo_getAll();


    return renderViewWithTemplate("todo","default",$data);
}
function action_add(){
    $name = $_POST["name"];
    $text = $_POST["text"];
    todo_add($name,$text);
    header("Location:/todo");
    return "";
}
function action_del(){
    $id = $_GET["id"];
    todo_del($id);
    header("Location:/todo");
    return "";
}