<h2>mainpage</h2>
<?php if ($currentUser!==NULL):?>
    <div>Вы авторизованы</div>
    <div class="main_user">Main user:<?=$currentUser["login"]?></div>
    <a href="/logout" class="logout">Logout</a>
    <div class="error"><?=$error?></div>
    <form action="/addcat" method="post">
        <dl>
            <dt><input type="text" name="cat_name"></dt>
            <dt><input type="submit"></dt>
        </dl>
    </form>

<!-- Кнопка, при нажатии на которую будет выводится содержимое каталога, будет только лишь
добавлять этот каталог в переменную сессии "текущий каталог". Выбери место в коде, куда будет прилетать
значение переменной "текущий каталог" и пробрось эту переменную через "дату" во вью. -->

<?php endif;?>
<?php if($currentUser===NULL):?>
    <div class="main_user">Main user:No active users</div>
    <a href="/login">Login</a>
    <a href="/register">SignUp</a>
<?php endif;?>
