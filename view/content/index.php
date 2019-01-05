<?php

namespace Anax\View;

$filter = new \Anax\TextFilter\TextFilter;
?>
<div class='hr'>
    <hr>
    <img class="round" alt="" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($di->session->get("user"))));?>"/>
</div>

<h1>senaste frågorna</h1>
<?php foreach ($questions as $question) : ?>
    <?php $answer = $answers->findAllWhere("questionID = ?", $question->id); ?>
    <div style="max-width:98%" class="card question grid-container-question">
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
                <?php $tagsQuestion = explode(" ", $question->tags); ?>
                <?php foreach ($tagsQuestion as $tag) : ?>
                    <?php $link=htmlentities($tag) ?>
                     <li><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endforeach; ?>
<h1>mest populära taggar</h1>
<ul class="tags">
<?php foreach ($tags as $tag): ?>
    <?php $link=htmlentities($tag->tag) ?>
    <li><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag->tag ?></a></li>
<?php endforeach; ?>
</ul>

<h1>mest aktiva användare</h1>

<div class="grid-container">
<?php foreach ($users as $user) : ?>
    <div class="card grid-item">
        <a href="<?= url("user/view/{$user->id}"); ?>">
        <img style="width:100%" alt="<?=$user->firstname ?>" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($user->email)));?>"/>
        </a>
        <h1><?= $user->firstname?> <?=$user->lastname?></h1>
        <p class="title">länk senaste inlägg</p>
        <p>länk senaste kommentar</p>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <p><button type="button" value="Redigera" onclick="window.location.href='mailto:<?=$user->email?>'" />Kontakta</button> </p>

    </div>
<?php endforeach; ?>
</div>
