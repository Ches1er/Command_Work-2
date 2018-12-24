<?php
//SUPPORT FNS
function _rec_save_data($data){
    fs_saveFile($data,"records");
}
//Get files from current catalogue
function _rec_getFiles_()
{
    $records = fs_getAll("records");
    foreach ($records as &$record) {
        if ($record["user"] === auth_currentUser()["login"]) {
            return $record["categories"][$_SESSION["current_cat_name"]];
        }
    }
    return NULL;
}
//Check if user already has file w same name
function _rec_getFileMatch($filename){
    $files = _rec_getFiles_();
    foreach ($files as $file=>$value){
        if ($file===$filename){
            _auth_sessionAutostart();
            $_SESSION["error"]="Cant add new file, this file's already exists";
            return true;
        }
    }
    return false;
}
//CATALOGUES
//Get all catalogues for current user
function rec_getCategories(){
    $records = fs_getAll("records");
    foreach ($records as $record){
        if ($record["user"]===auth_currentUser()["login"]){
            return $record["categories"];
        }
    }
    return NULL;
}
//Check if user already has catalogue w same name
function _rec_getCatMatch($new_cat_name){
    $cat_array = rec_getCategories();
    foreach ($cat_array as $old_cat_name=>$value){
        if ($old_cat_name===$new_cat_name){
            _auth_sessionAutostart();
            $_SESSION["error"]="Cant add new catalogue, this catalogue's already exists";
            return true;
        }
    }
    return false;
}
//Add catalogue
function rec_addCat($catname){
    if (_rec_getCatMatch($catname)) return NULL;
    $records = fs_getAll("records");
    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $record["categories"][$catname]=[];
        }
    }
    $_SESSION["error"]="";
    _rec_save_data($records);
}
//Putting current catalogue into session
function putCurrentCatIntoSession($catname){
    _auth_sessionAutostart();
    $_SESSION["current_cat_name"]=$catname;
}
//Get array w current catalogue files
function rec_showCat(){
    if (auth_isAuth()){
        $categories = rec_getCategories();
        foreach ($categories as $category=>$files){
            if ($category===@$_SESSION["current_cat_name"]){
                return $files;
            }
        }
    }
    return NULL;
}
//Delete catalogue
function rec_delCat($catname){
    $records = fs_getAll("records");
    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $record["categories"]=array_filter($record["categories"], function ($key)use($catname){
                return $key!= $catname;
            },ARRAY_FILTER_USE_KEY);
        }
    }
    _rec_save_data($records);
}
//FILES
//Add file to the current catalogue
function rec_addFile($filename,$filevalue)
{
    if (_rec_getFileMatch($filename))return NULL; //checking matches
    $records = fs_getAll("records");
    foreach ($records as &$record) {
        if ($record["user"] === auth_currentUser()["login"]) {
            $record["categories"][$_SESSION["current_cat_name"]][$filename] = $filevalue;
        }
    }
    $_SESSION["error"]="";
    _rec_save_data($records);
}
//Del file from the current catalogue
function rec_delFile($fileId){
    $records = fs_getAll("records");
    foreach ($records as &$record){
        if ($record["user"]===auth_currentUser()["login"]){
            $files_array = &$record["categories"][$_SESSION["current_cat_name"]];
            $files_array=array_filter($files_array, function ($key)use($fileId){
                return $key!= $fileId;
            },ARRAY_FILTER_USE_KEY);
        }
    }
    _rec_save_data($records);
}
