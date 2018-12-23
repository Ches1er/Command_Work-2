<?php if($currentUser===NULL):?>
    <div class="main_user">Main user:No active users</div>
    <a href="/login">Login</a>
    <a href="/register">SignUp</a>
<?php endif;?>



        <?php if ($currentUser!==NULL):?>
            <div class="main_user">User:<?=$currentUser["login"]?>
                <a href="/logout" class="logout">Logout</a>
            </div>
        <div class="content">
            <div class="left">
            <form action="/addcat" method="post">
                <dl>
                    <dt><input type="text" name="cat_name" class="add">
                        <input type="submit" value="add new category" class="addsub">
                    </dt>
                </dl>
            </form>
<?php foreach ($categories as $key=>$category):?>
    <div class="category">
        <div class="catName"><?=$key?></div>
        <a href="/delcat?catName=<?=$key?>" class="del">Delete</a>
        <a href="/viewcat?catName=<?=$key?>" class="view">View</a>
    </div>
<?php endforeach;?>

    </div>
    <div class="right">
        <div class="select">Selected Category: <?php if (!empty($_SESSION["current_cat_name"]))echo $_SESSION["current_cat_name"]?></div>
        <form action="/addfile" method="post">
            <dl>
                <dt><input type="text" name="file_name" class="addfile">
                    <input type="submit" value="add new key" class="addsub"></dt>
                <dt><textarea name="key"></textarea></dt>
                <dt></dt>
            </dl>

        </form>
        <?php foreach ($files as $file=>$value):?>
            <div class="file">
                <div class="key"><?=$file?></div>
                <div class="key value"><?=$value?></div>
                <a href="/delfile?fileName=<?=$file?>" class="del">Delete</a>
            </div>
        <?php endforeach;?>

    </div>
</div>
        <?php endif;?>
