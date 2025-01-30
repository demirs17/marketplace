<?php

use App\Models\User;
use Core\Session;

?>
<link rel="stylesheet" href="css/welcome.css">

<header>
    <div class="menu_icon">-></div>
    <div>sahibinden</div>
    <div class="account">
        <?php if(User::hasLoggedIn()){ ?>
    
            <div class="user"><?php echo Session::get("user_email")."#".Session::get("user_id") ?></div>
            <a href="logout">logout</a>
    
        <?php }else{ ?>
    
            <a href="/login">login</a>
    
        <?php } ?>
    </div>
</header>
<div class="main">
    <div class="sidebar">
        <div class="categories">
            <div class="section">
                <a href="category?parentCategory=emlak" class="title">Emlak</a>
                <a href="category?category=konut" class="category">konut</a>
                <a href="category?category=işyeri" class="category">işyeri</a>
                <a href="category?category=arsa" class="category">arsa</a>
            </div>
            <div class="section">
                <a href="category?parentCategory=vasıta" class="title">Vasıta</a>
                <a href="category?category=otomobil" class="category">Otomobil</a>
                <a href="category?category=motosiklet" class="category">Motosiklet</a>
                <a href="category?category=ticari araçlar" class="category">Ticari araçlar</a>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="options">
            <div class="option selected">Son yüklenenler</div>
        </div>
        <div class="ads" id="ads"></div>
    </div>
</div>

<script src="js/welcome.js"></script>