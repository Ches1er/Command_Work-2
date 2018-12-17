<?php
include_once FNSPATH."file_storage_fns.php";
define("USERSFILEPATH","users");

function _auth_getAllUsers(){
    return fs_getAll(USERSFILEPATH);
}
function _auth_getUserById($id){
    return fs_getById($id,USERSFILEPATH);
}
function _auth_insertUser($user){
    fs_append($user,USERSFILEPATH);
}
function _auth_getUserByLogin($login){
    $users = _auth_getAllUsers();
    foreach ($users as $u)
        if($u["login"]===$login) return $u;
    return NULL;
}

function _auth_sessionAutostart(){
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
}


function _auth_hash_pass($pass){
    return hash("sha256",$pass);
}

function  _auth_create_user_session($user){
    $id = $user["id"];
    _auth_sessionAutostart();
    $_SESSION["user_id"]=$id;
    $_SESSION["user_agent"]=md5($_SERVER["HTTP_USER_AGENT"]);
}


function auth_register($name,$pass){
    if(_auth_getUserByLogin($name)!==NULL) return false;
    $user=[
        "login"=>$name,
        "pass"=>_auth_hash_pass($pass)
    ];
    _auth_insertUser($user);
    return true;
}

function auth_login($name,$pass){
    $user = _auth_getUserByLogin($name);
    if($user===NULL) return false;
    if ($user["pass"]!==_auth_hash_pass($pass)) return false;
    _auth_create_user_session($user);
    return true;
}

function auth_logout(){
    _auth_sessionAutostart();
    session_destroy();
}

function auth_isAuth(){
    _auth_sessionAutostart();
    if(empty($_SESSION["user_id"])||empty($_SESSION["user_agent"])) return false;
    if($_SESSION["user_agent"]!==md5($_SERVER["HTTP_USER_AGENT"])) return false;
    return true;
}

function auth_currentUser(){
    if(!auth_isAuth()) return NULL;
    return _auth_getUserById($_SESSION["user_id"]);
}

