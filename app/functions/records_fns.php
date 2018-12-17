<?php
include_once FNSPATH."file_storage_fns.php";
define("TODO_FILE","todo");

function todo_getAll(){
    return fs_getAll(TODO_FILE);
}

function todo_add($name,$text){
    $note = [
        "name"=>$name,
        "text"=>$text
    ];
    fs_append($note,TODO_FILE);
}

function todo_del($id){
    fs_del($id,TODO_FILE);
}