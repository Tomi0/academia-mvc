<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Asignaturas en <?= $category->name ?></h2>

    <div class="list-group margen-arriba">

        <?php if (!isset($category->subjects) || count($category->subjects) <= 0) { ?>

            <h4>De momento no hay asignaturas en este curso.</h4>

        <?php } else { ?>

            <?php foreach ($category->subjects as $subject) { ?>

                <a href="/subjects/show/<?= $subject->slug ?>" class="list-group-item list-group-item-action"><?= $subject->name ?></a>

            <?php } ?>

        <?php } ?>

    </div>

</div>