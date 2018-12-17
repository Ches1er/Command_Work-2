<?php



function action_login(){
    if(auth_isAuth()) return redirect("/");
    $errors = @$_SESSION["errors"];
    if($errors!=null) unset($_SESSION["errors"]);
    return renderViewWithTemplate("login","default",["errors"=>$errors]);

}
function action_register(){
    if(auth_isAuth()) return redirect("/");
    $errors = @$_SESSION["errors"];
    $old = @$_SESSION["old"];
    if($errors!=null) unset($_SESSION["errors"]);
    if($old!=null) unset($_SESSION["old"]);

    return renderViewWithTemplate("register","default",["errors"=>$errors,"old"=>$old]);
}
function action_logout(){
    auth_logout();
    return redirect("/");
}
function action_loginhandle(){
    if(empty($_POST["login"])||empty($_POST["pass"]))
        return redirect_back_with_errors("Заполните все поля");
    if(!auth_login($_POST["login"],$_POST["pass"]))
        return redirect_back_with_errors("Логин или пароль неверен");
    return redirect("/");
}
function action_registerhandle(){
    if(empty($_POST["login"])||empty($_POST["pass"])||empty($_POST["pass2"]))
        return redirect_back_with_errors("Заполните все поля");

    if($_POST["pass"]!==$_POST["pass2"])
        return redirect_back_with_errors("Пароли не совпадают");

    if(!auth_register($_POST["login"],$_POST["pass"]))
        return redirect_back_with_errors("Имя пользователя уже занято");

    return redirect("/login");

}