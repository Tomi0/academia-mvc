<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Documentos <?= isset($subject->name) ? 'en ' . $subject->name : '' ?></h2>

    <div class="list-group margen-arriba">

        <?php foreach ($subject->documents as $document) { ?>

            <a href="/subjects/show/<?= $document->slug ?>" class="list-group-item list-group-item-action"><?= $document->name ?></a>

        <?php } ?>

    </div>

</div>