<?php

        //SUPPORT FNS

function _rec_save_data($data){
    fs_saveFile($data,"records");
}

function _rec_getFiles_(){
    $records=fs_getAll("records");
    foreach ($records as $record){
        if ($record["user"]===auth_currentUser()["login"]){
            return $record["categories"][$_SESSION["current_cat_name"]];
        }
    }
    return NULL;
}

function _rec_getFileMatch($filename){
    $files = _rec_getFiles_();
    foreach ($files as $file=>$value){
        if ($file===$filename)return true;
    }
    return false;
}

        //CATALOGUES

function rec_getCategories(){
    $records = fs_getAll("records");
    foreach ($records as $record){
        if ($record["user"]===auth_currentUser()["login"]){
            return $record["categories"];
        }
    }
}

function _rec_getCatMatch($new_cat_name){
    $cat_array = rec_getCategories();
    foreach ($cat_array as $old_cat_name=>$value){
        if ($old_cat_name===$new_cat_name)return true;
    }
    return false;
}

function rec_addCat($catname){
    if (_rec_getCatMatch($catname)){
        _auth_sessionAutostart();
        $_SESSION["error"]="This catalogue's already exists";
        return false;
    }
    $records = fs_getAll("records");
    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $record["categories"][$catname]=[];
        }
    }
    _rec_save_data($records);
}

        //FILES

function rec_addFile($filename,$filevalue){

    if (_rec_getFileMatch()){
        _auth_sessionAutostart();
        $_SESSION["error"]="This file`s already exists";
        return false;
    }

    $records=fs_getAll("records");
    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $record["categories"][$_SESSION["current_cat_name"]][$filename]=$filevalue;
        }
    }
    _rec_save_data($records);
}

function rec_delFile($fileId){
    $records = fs_getAll("records");

    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $files_array = &$record["categories"][$_SESSION["current_cat_name"]];
            $files_array = array_filter($files_array, function($key) use($fileId){
               return $key!=$fileId;
            },ARRAY_FILTER_USE_KEY);
        }
    }
    _rec_save_data($records);
}