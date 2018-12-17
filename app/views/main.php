<h2>mainpage</h2>
hello MVC
<?php if($user!=NULL):?>
    Hello <?=$user["login"]?> <a href="/logout">logout</a>
<?php else: ?>
    <br><a href="/register">регисрация</a>
    <br><a href="/login">вход</a>
<?php endif; ?>
