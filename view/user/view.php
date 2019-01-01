<?php

namespace Anax\View;

$user = isset($user) ? $user : null;

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
