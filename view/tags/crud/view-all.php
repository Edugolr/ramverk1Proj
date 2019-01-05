<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;

?>
<div class='hr'>
    <hr>
    <?php if ($di->session->get("user")): ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<?php
if (!$tags) : ?>
    <p>There are no tags to show.</p>
<?php
    return;
endif;
?>
<ul class="tags">
    <?php foreach ($tags as $tag) : ?>
        <?php $link=htmlentities($tag->tag) ?>
         <li><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag->tag ?></a></li>
    <?php endforeach; ?>
</ul>
