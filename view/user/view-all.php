<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;
?>
<div class='hr'>
    <hr>
    <?php if ($di->session->get("user")): ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<?php
if (!$items) : ?>
    <p>There are no users to show.</p>
<?php
    return;
endif;
?>

<div class="grid-container">
<?php foreach ($items as $item) : ?>
    <div class="card grid-item">
        <a href="<?= url("user/view/{$item->id}"); ?>">
        <img style="width:100%" alt="<?=$item->firstname ?>" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($item->email)));?>"/>
        </a>
        <h1><?= $item->firstname?> <?=$item->lastname?></h1>
        <p class="title">länk senaste inlägg</p>
        <p>länk senaste kommentar</p>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <p><button type="button" value="Redigera" onclick="window.location.href='mailto:<?=$item->email?>'" />Kontakta</button> </p>

    </div>
<?php endforeach; ?>
</div>
