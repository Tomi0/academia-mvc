<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Documentos <?= isset($subject->name) ? 'en ' . $subject->name : '' ?></h2>

    <?= \Mini\Libs\Sesion::get('user')->id == $subject->user_id ? '<a class="btn btn-primary" href="/subjects/edit/' . $subject->slug . '">Editar asignatura</a>' : '' ?>

    <div class="list-group margen-arriba">

        <?php if (!isset($subject->documents) || count($subject->documents) == 0) { ?>

            <h4>No hay documentos en esta asignatura</h4>

        <?php } else { ?>

        <?php foreach ($subject->documents as $document) { ?>

            <a href="/documents/show/<?= $document->slug ?>" class="list-group-item list-group-item-action"><?= $document->name ?></a>

        <?php } ?>

        <?php } ?>

    </div>

</div>