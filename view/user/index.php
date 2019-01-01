<?php

namespace Anax\View;

$user = isset($user) ? $user : null;

if(empty($di->session->get("login"))) {
    $urlToLogin = url("user/login");
    $urlToRegister = url("user/create");
    ?>
    <p>
        <h1>Du måste vara inloggad för att nå denna sida.</h1>
        <a href="<?= $urlToLogin ?>">Logga in</a> |
        <a href="<?= $urlToRegister ?>">Registrera</a>
    </p>
    <?php
} else {
?>
<div class='hr'>
    <hr> 
    <img class="round" alt="<?= $user->acronym ?>" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
</div>
<div class="grid-container" style="grid-template-columns: 50% auto;">
    <div class="grid-item border-right">
        <p><b>Acronym:</b> <?= $user->acronym ?></p>
        <p><b>Förnamn:</b> <?= $user->firstname ?></p>
        <p><b>Efternamn:</b> <?= $user->lastname ?></p>
        <p><b>Email/användarnamn:</b> <?= $di->session->get("user") ?></p>
    </div>
    <div class="grid-item">
        <p>egna trådar</p>
        <p>kommentarer</p>
    </div>

</div>
<div class="grid-container" style="grid-template-columns: 80% auto;">
    <div class="grid-item">
    </div>
    <div class="grid-item">
        <form>
            <input type="button" value="Redigera" onclick="window.location.href='<?= url("user/update/{$user->id}"); ?>'" />
        </form>
        <form class="" action="user/logout" method="post">
            <input class="btn" type="submit" name="" value="Logga ut">
        </form>
    </div>

</div>
<?php
}
