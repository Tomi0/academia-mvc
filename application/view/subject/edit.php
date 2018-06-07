<?php $this->layout('layouts/layout') ?>

<div class="container">

    <div class="row">
        <div class="col-lg-7">
            <h3>Edición de <?= isset($subject->name) ? $subject->name : '' ?>:</h3>
        </div>
        <div class="col-lg-5 text-right">
            <a href="<?= isset($subject->slug) ? '/subjects/show/' . $subject->slug : '' ?>" class="btn btn-info mini-margen-bot">Volver</a>
        </div>
    </div>

    <div class="row margen-arriba">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Documentos
                </div>
                <div class="card-body">

                    <?php if (isset($subject->documents) && count($subject->documents) > 0) { ?>

                    <table class="table text-center">

                        <tr>
                            <th>Nombre</th>
                            <th>Descrición</th>
                            <th>Acciones</th>
                        </tr>

                        <?php foreach($subject->documents as $document) { ?>

                        <tr>
                            <td><?= $document->name ?></td>
                            <td><?= $document->description ?></td>
                            <td>

                                <a href="<?= '/documents/show/' . $document->slug ?>" target="_blank" class="btn btn-xs btn-primary mini-margen-bot">Ver</a>

                                <a href="<?= '/documents/delete/' . $document->slug ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Seguro que quire eliminar el documento?');">Eliminar</a>

                            </td>
                        </tr>

                        <?php } ?>

                    </table>

                    <?php } else { ?>

                    <strong>No hay documentos en esta asignatura</strong>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <hr>

    <strong>Nuevo documento:</strong>

    <form action="/documents/store/<?= $subject->slug ?>" method="POST" enctype="multipart/form-data">

        <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="nombre del documento" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
            <?= isset($errors['name']) && $errors['name'] !== true ? '<span class="text-danger">' . $errors['name'] . '</span>' : '' ?>
        </div>

        <div class="form-group <?= isset($errors['description']) ? 'has-error' : '' ?>">
            <label for="description">Descripción</label>
            <textarea type="text" name="description" id="description" class="form-control" placeholder="descripción del documento"><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
            <?= isset($errors['description']) && $errors['description'] !== true ? '<span class="text-danger">' . $errors['description'] . '</span>' : '' ?>
        </div>

        <div class="form-group <?= isset($errors['file']) ? 'has-error' : '' ?>">
            <label for="exampleFormControlFile1">Documento</label>
            <input type="file" class="form-control-file" name="document-file" id="exampleFormControlFile1">
            <?= isset($errors['file']) && $errors['file'] !== true ? '<span class="text-danger">' . $errors['file'] . '</span>' : '' ?>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Crear documento</button>
        </div>

    </form>

</div>
