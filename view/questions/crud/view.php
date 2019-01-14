<?php

namespace Anax\View;

$filter = new \Anax\TextFilter\TextFilter;

$answers = isset($answers) ? $answers : null;
$urlToAnswer = url("answer/create");
$urlToLogin = url("user/login");
$urlToRegister = url("user/create");
$urlToComment = url("comment/create")
?>

<div class='hr'>
    <hr>
    <?php if ($di->session->get("user")) : ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>

<div style="max-width:98%" class="card">
    <div class="title">
        <h1><?= $question->title ?></h1>
    </div>
    <div class="question">
        <p><?= $filter->doFilter($question->question, ["markdown"]); ?></p>
        <p class="author" ><a href="<?= url("user/view/{$user->id}"); ?>"><?= $user->acronym?></a></p>
    <?php if (empty($di->session->get("login"))) : ?>
        <p>
            <p>Du måste vara inloggad för att kunna svara eller kommentera på frågor</p>
            <a href="<?= $urlToLogin ?>">Logga in</a> |
            <a href="<?= $urlToRegister ?>">Registrera</a>
        </p>
        <hr>
    <?php else : ?>
        <p><button style="float:right" class="btn orange" name="button" onclick="window.location.href = '<?=$urlToComment."/".$question->id. "/". "questionID"?>';">Kommentera</button></p>
        <p><button style="float:right" class="btn green" name="button" onclick="window.location.href = '<?=$urlToAnswer."/".$question->id?>';">Svara</button></p>

    <hr style="clear:both;">
    </div>
</div>

<?php foreach ($questionComment as $questionComment) : ?>
    <div style="float:right; max-width:70%; min-width:70%" class="card orange">
        <p><?= $filter->doFilter($questionComment->comment, ["markdown"]); ?></p>
        <p class="author" ><a href="<?= url("user/view/{$questionComment->userID}"); ?>"><?= $questionComment->username ?></a></p>
    </div>
<?php endforeach; ?>

<h1 style = "clear:both;">Svar</h1>
<?php foreach ($answers as $answer) : ?>
<div style="max-width:98%" class="card green">
    <div style="" class="answer">
        <p><?= $filter->doFilter($answer->answer, ["markdown"]); ?></p>
        <p class="author" ><a href="<?= url("user/view/{$answer->userID}"); ?>"><?= $answer->username ?></a></p>
    </div>
    <p><button style="position:relative;margin-left:86.5%; margin-bottom:-2.2%;" class="btn orange" name="button" onclick="window.location.href = '<?=$urlToComment."/".$answer->id. "/". "answerID"?>';">Kommentera</button></p>
</div>

<div style="float:right; max-width:70%; min-width:70%" class="card orange">
    <?php  $comments = $comment->findAllWhere("answerID = ?", $answer->id) ?>
    <?php foreach ($comments as $comments) : ?>
        <p><?= $filter->doFilter($comments->comment, ["markdown"]); ?></p>
        <p class="author"><a href="<?= url("user/view/{$comments->userID}"); ?>"><?= $comments->username ?></a></p>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>
<?php endif; ?>
