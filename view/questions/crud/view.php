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
    <?php if ($di->session->get("user")): ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<h1>Fråga</h1>
<div style="max-width:98%" class="card">
    <div class="title">
        <h1><?= $question->title ?></h1>
    </div>
    <div class="question">
        <p><?= $filter->doFilter($question->question, ["markdown"]); ?></p>
        <p class="author"><a href="<?= url("user/view/{$user->id}"); ?>"><?= $user->acronym?></a></p>
    </div>
    <?php if (empty($di->session->get("login"))): ?>
        <p>
            <p>Du måste vara inloggad för att kunna svara eller kommentera på frågor</p>
            <a href="<?= $urlToLogin ?>">Logga in</a> |
            <a href="<?= $urlToRegister ?>">Registrera</a>
        </p>
        <hr>
    <?php else: ?>
        <p><button type="button" name="button" onclick="window.location.href = '<?=$urlToAnswer."/".$question->id?>';">Svara</button></p>
        <p><button type="button" name="button" onclick="window.location.href = '<?=$urlToComment."/".$question->id. "/". "questionID"?>';">Kommentera</button></p>
    <?php endif; ?>
</div>


<h1>Kommentarer</h1>
<?php foreach ($questionComment as $questionComment): ?>
    <div style="max-width:80%" class="card">
        <div class="questionComment">
            <p><?= $filter->doFilter($questionComment->comment, ["markdown"]); ?></p>
            <p><a href="<?= url("user/view/{$questionComment->userID}"); ?>">användare: <?= $questionComment->username ?></a></p>
        </div>
    </div>
<?php endforeach; ?>
<h1>Svar</h1>
<?php foreach ($answers as $answer): ?>
<div style="max-width:90%" class="card">
    <div class="answer">
        <p><?= $filter->doFilter($answer->answer, ["markdown"]); ?></p>
        <p><a href="<?= url("user/view/{$answer->userID}"); ?>">användare: <?= $answer->username ?></a></p>
        <p><button type="button" name="button" onclick="window.location.href = '<?=$urlToComment."/".$answer->id. "/". "answerID"?>';">Kommentera</button></p>
        <?php  $comments = $comment->findAllWhere("answerID = ?", $answer->id) ?>
        <div class="answerComments">
            <?php foreach ($comments as $comments): ?>
                <p><?= $filter->doFilter($comments->comment, ["markdown"]); ?></p>
                <p><a href="<?= url("user/view/{$comments->userID}"); ?>">användare: <?= $comments->username ?></a></p>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php endforeach; ?>
