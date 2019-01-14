<?php

namespace Anax\View;

$user = isset($user) ? $user : null;

if (empty($di->session->get("login"))) {
    $urlToLogin = url("user/login");
    $urlToRegister = url("user/create");
    ?>
    <p>
        <h1>Du måste vara inloggad för att nå denna sida.</h1>
        <p><button class="btn green" name="button" onclick="window.location.href = '<?= $urlToLogin ?>';">Logga in</button></p>
        <p><button class="btn blue" name="button" onclick="window.location.href = '<?= $urlToRegister ?>';">Registrera</button></p>
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
        <form>
            <input type="button" class="btn orange fullwidth" value="Redigera" onclick="window.location.href='<?= url("user/update/{$user->id}"); ?>'" />
        </form>
        <form class="" action="user/logout" method="post">
            <input class="btn red fullwidth" type="submit" name="" value="Logga ut">
        </form>
    </div>
    <div class="grid-item">
        <?php  $userQuestions = $questions->findAllWhere("userID = ?", $user->id) ?>
        <?php $userAnswers = $answers->findAllWhere("userID = ?", $user->id) ?>
        <?php $userComments = $comments->findAllWhere("userID = ?", $user->id) ?>
        <h1>frågor  <?= count($userQuestions) ?></h1>
        <?php foreach ($userQuestions as $userQuestions) : ?>
            <p><a href="<?= url("questions/view/{$userQuestions->id}"); ?>"><?=  $userQuestions->title ?></a></p>
        <?php endforeach; ?>
        <h1>svar <?= count($userAnswers) ?></h1>
        <?php foreach ($userAnswers as $userAnswers) : ?>
            <p><a href="<?= url("questions/view/{$userAnswers->questionID}"); ?>"><?=  $userAnswers->answer ?></a></p>

        <?php endforeach; ?>
        <h1>kommentarer <?= count($userComments) ?></h1>
        <?php foreach ($userComments as $userComments) : ?>
            <?php $link = $userComments->questionID ?: $userComments->answerID; ?>
            <p><a href="<?= url("questions/view/{$link}"); ?>"><?= $userComments->comment ?></a></p>
        <?php endforeach; ?>
    </div>

</div>

    <?php
}
