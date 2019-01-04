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
    <?php if ($di->session->get("user")): ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<?php foreach ($questions as $question) : ?>
    <?php $answer = $answers->findAllWhere("questionID = ?", $question->id); ?>
    <div style="max-width:98%" class="card question grid-container">
        <div class="grid-item rank">
            <p>Antal svar</p>
            <p><?= count($answer) ?></p>
        </div>
        <div class="grid-item question">
            <a href="<?= url("questions/view/{$question->id}"); ?>">
            <p><?= $question->title ?></p>
            </a>
            <p><?= $filter->doFilter($question->question, ["markdown"]); ?></p>
            <ul class="tags">
                <?php $tags = explode(" ", $question->tags); ?>
                <?php foreach ($tags as $tag) : ?>
                     <li><a href=<?= url("tags/questions/{$tag}") ?> class="tag"><?= $tag ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php endforeach; ?>