<?php

function _rec_save_data($data){
    fs_saveFile($data,"records");
}

function rec_getCategories(){
    $records = fs_getAll("records");
    foreach ($records as $record){
        if ($record["user"]===auth_currentUser()["login"]){
            return $record["categories"];
        }
    }
}

function rec_addCat($catname){
    $records = fs_getAll("records");
    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $record["categories"][$catname]=[];
        }
    }
    _rec_save_data($records);
    return true;
}

        //FILES

function rec_addFile($filename,$filevalue){
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