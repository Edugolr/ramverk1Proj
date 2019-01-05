<?php

namespace Anax\View;

$user = isset($user) ? $user : null;

?>
<div class='hr'>
    <hr>
    <img class="round" alt="<?= $user->acronym ?>" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($user->email)));?>"/>
</div>
<div class="grid-container" style="grid-template-columns: 50% auto;">
    <div class="grid-item border-right">
        <p><b>Acronym:</b> <?= $user->acronym ?></p>
        <p><b>Förnamn:</b> <?= $user->firstname ?></p>
        <p><b>Efternamn:</b> <?= $user->lastname ?></p>
        <p><b>Email/användarnamn:</b> <?= $user->email ?></p>
    </div>
    <div class="grid-item">
        <?php  $userQuestions = $questions->findAllWhere("userID = ?", $user->id) ?>
        <?php $userAnswers = $answers->findAllWhere("userID = ?", $user->id) ?>
        <?php $userComments = $comments->findAllWhere("userID = ?", $user->id) ?>
        <h1>frågor  <?= count($userQuestions) ?></h1>
        <?php foreach ($userQuestions as $userQuestions): ?>
            <p><a href="<?= url("questions/view/{$userQuestions->id}"); ?>"><?=  $userQuestions->title ?></a></p>
        <?php endforeach; ?>
        <h1>svar <?= count($userAnswers) ?></h1>
        <?php foreach ($userAnswers as $userAnswers): ?>
            <p><a href="<?= url("questions/view/{$userAnswers->questionID}"); ?>"><?=  $userAnswers->answer ?></a></p>

        <?php endforeach; ?>
        <h1>kommentarer <?= count($userComments) ?></h1>
        <?php foreach ($userComments as $userComments): ?>
            <?php $link = $userComments->questionID ?: $userComments->answerID; ?>
            <p><a href="<?= url("questions/view/{$link}"); ?>"><?= $userComments->comment ?></a></p>
        <?php endforeach; ?>
    </div>
</div>
