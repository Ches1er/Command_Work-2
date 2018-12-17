<?php
function fs_filename($file){
    return DATAPATH.$file.".json";
}

function fs_getAll($file){
    $file_content = file_get_contents(fs_filename($file));
    return json_decode($file_content,true);
}
function fs_saveFile($arr,$file){
    file_put_contents(fs_filename($file),json_encode($arr));
}

function fs_append($data,$file){
    $arr = fs_getAll($file);
    $data["id"] = time()."_".mt_rand(1000,9999).mt_rand(1000,9999).mt_rand(1000,9999);
    $arr[] = $data;
    fs_saveFile($arr,$file);
}

function fs_getById($id,$file){
    $arr = fs_getAll($file);
    foreach ($arr as $data){
        if($data["id"]===$id) return $data;
    }
    return null;
}
function fs_del($id,$file){
    $arr= fs_getAll($file);
    $arr = array_filter($arr,function ($e) use ($id){
        return $e["id"]!=$id;
    });
    fs_saveFile($arr,$file);
}