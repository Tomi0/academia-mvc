<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Documentos <?= isset($subject->name) ? 'en ' . $subject->name : '' ?></h2>

    <div class="list-group margen-arriba">

        <?php foreach ($subject->documents as $document) { ?>

            <a href="/subjects/show/<?= $document->slug ?>" class="list-group-item list-group-item-action"><?= $document->name ?></a>

        <?php } ?>

        <?php if (!isset($subject->documents) || count($subject->documents) == 0) { ?>

            <h4>No hay documentos en esta asignatura</h4>

        <?php } ?>

    </div>

</div>