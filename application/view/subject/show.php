<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Documentos <?= isset($subject->name) ? 'en ' . $subject->name : '' ?></h2>

    <?= \Mini\Libs\Sesion::get('user')->id == $subject->user_id ? '<a class="btn btn-primary" href="/subjects/edit/' . $subject->slug . '">Editar asignatura</a>' : '' ?>

    <div class="card margen-arriba">

        <div class="card-header">
            Documentos de la asignatura
        </div>

        <div class="card-body">

            <?php if (!isset($subject->documents) || count($subject->documents) == 0) { ?>

                <h4>No hay documentos en esta asignatura</h4>

            <?php } else { ?>

                <?php foreach ($subject->documents as $document) { ?>

                    <p><a href="/documents/show/<?= $document->slug ?>"><?= $document->name ?></a></p>

                    <p><?= $document->description ?></p>

                    <a href="/documents/show/<?= $document->slug ?>" class="btn btn-primary">Ver documento</a>

                    <hr>

                <?php } ?>

            <?php } ?>

        </div>

    </div>

</div>