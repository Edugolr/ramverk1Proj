<?php

namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;

$answers = isset($answers) ? $answers : null;
$urlToAnswer = url("answer/create");
$urlToLogin = url("user/login");
$urlToRegister = url("user/create");
?>

<div class='hr'>
    <hr>
    <?php if ($di->session->get("user")): ?>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
    <?php endif; ?>
</div>
<div style="max-width:98%" class="card">
    <div class="title">
        <h1><?= $question->title ?></h1>
    </div>
    <div class="question">
        <p><?= $filter->doFilter($question->question, ["markdown"]); ?></p>
        <p class="author"><a href="<?= url("user/view/{$user->id}"); ?>"><?= $user->acronym?></a></p>
    </div>
</div>


<?php foreach ($answers as $answer): ?>
<div style="max-width:70%" class="card">
    <div class="answer">
        <p><?= $filter->doFilter($answer->answer, ["markdown"]); ?></p>
        <p><a href="<?= url("user/view/{$answer->userID}"); ?>">användare: <?= $answer->username ?></a></p>
    </div>
</div>
<?php endforeach; ?>
<?php if (empty($di->session->get("login"))): ?>
    <p>
        <p>Du måste vara inloggad för att kunna svara på frågor</p>
        <a href="<?= $urlToLogin ?>">Logga in</a> |
        <a href="<?= $urlToRegister ?>">Registrera</a>
    </p>
    <hr>
<?php else: ?>
    <p>
        <button type="button" name="button" onclick="window.location.href = '<?=$urlToAnswer."/".$question->id?>';">Svara</button>
    </p>
<?php endif; ?>
