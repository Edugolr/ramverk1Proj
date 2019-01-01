<?php

namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;
/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("questions/create");
$urlToDelete = url("questions/delete");
$urlToLogin = url("user/login");
$urlToRegister = url("user/create");



?>

<div class='hr'>
    <hr>
    <?php if ($di->session->get("user")): ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<?php if (empty($di->session->get("login"))): ?>
    <p>
        <p>Du måste vara inloggad för att kunna skapa nya frågor</p>
        <a href="<?= $urlToLogin ?>">Logga in</a> |
        <a href="<?= $urlToRegister ?>">Registrera</a>
    </p>
    <hr>
<?php else: ?>
    <p>
        <button type="button" name="button" onclick="window.location.href = '<?= $urlToCreate ?>';">Ny fråga</button>
    </p>
<?php endif; ?>
<?php foreach ($items as $item) : ?>
<a href="<?= url("questions/view/{$item->id}"); ?>">
    <div style="max-width:98%" class="card question grid-container">
        <div class="grid-item rank">
            <p>antal svar</p>
        </div>
        <div class="grid-item question">
            <p><?= $item->title ?></p>
            <p><?= $filter->doFilter($item->question, ["markdown"]); ?></p>
        </div>
    </div>
</a>
<?php endforeach; ?>
