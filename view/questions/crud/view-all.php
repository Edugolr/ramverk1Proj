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
$questions = isset($questions) ? $questions : null;

// Create urls for navigation
$urlToCreate = url("questions/create");
$urlToDelete = url("questions/delete");
$urlToLogin = url("user/login");
$urlToRegister = url("user/create");

?>

<div class='hr'>
    <hr>
    <?php if ($di->session->get("user")) : ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<?php if (empty($di->session->get("login"))) : ?>
    <p>
        <p>Du måste vara inloggad för att kunna skapa nya frågor</p>
        <a href="<?= $urlToLogin ?>">Logga in</a> |
        <a href="<?= $urlToRegister ?>">Registrera</a>
    </p>
    <hr>
<?php else : ?>
    <p>
        <button class="btn fullwidth" name="button" onclick="window.location.href = '<?= $urlToCreate ?>';">Ny fråga</button>
    </p>
<?php endif; ?>
<?php foreach ($questions as $question) : ?>
    <?php $answer = $answers->findAllWhere("questionID = ?", $question->id); ?>
    <div style="max-width:98%" class="card question grid-container-question">
        <div class="grid-item rank">
            <p>Antal svar</p>
            <p><?= count($answer) ?></p>
        </div>
        <div class="grid-item question">
            <a href="<?= url("questions/view/{$question->id}"); ?>">
            <h1><?= $question->title ?></h1>
            </a>
            <p><?= $filter->doFilter($question->question, ["markdown"]); ?></p>
            <ul class="tags">
                <?php $tags = explode(" ", $question->tags); ?>
                <?php foreach ($tags as $tag) : ?>
                    <?php $link=htmlentities($tag) ?>
                     <li><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php endforeach; ?>
