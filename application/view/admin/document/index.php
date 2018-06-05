<?php $this->layout('admin/layouts/layout') ?>

<div class="">

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Crear un documento
                </div>
                <div class="panel-body">
                    <form action="/admindocuments/store" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group <?= isset($errors['name']) && $errors['name'] !== true ? 'has-error' : '' ?>">
                                <div class="col-lg-1">
                                    <label class="control-label" for="name">Nombre:</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="titulo del documento" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                                    <?= isset($errors['name']) && $errors['name'] !== true ? '<span>' . $errors['name'] . '</span>' : '' ?>
                                </div>
                            </div>
                            <div class="form-group <?= isset($errors['subject_id']) && $errors['subject_id'] !== true ? 'has-error' : '' ?>">
                                <div class="col-lg-2">
                                    <label for="subject_id" class="control-label">Asignatura:</label>
                                </div>
                                <div class="col-lg-5">
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <?php foreach($subjects as $subject) { ?>

                                            <option <?= isset($_POST['subject_id']) ? $_POST['subject_id'] == $subject->id ? 'selected' : '' : '' ?> value="<?= $subject->id ?>"><?= $subject->name ?> en <?= $subject->category->name ?></option>

                                        <?php } ?>
                                    </select>
                                    <?= isset($errors['subject_id']) && $errors['subject_id'] !== true ? '<span>' . $errors['subject_id'] . '</span>' : '' ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 form-group <?= isset($errors['description']) && $errors['description'] !== true ? 'has-error' : '' ?>">
                                <label for="description" class="control-label">Descripción</label>
                                <textarea class="form-control" name="description" id="description" rows="10"><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                                <?= isset($errors['description']) && $errors['description'] !== true ? '<span>' . $errors['description'] . '</span>' : '' ?>
                            </div>

                            <div class="col-lg-12 form-group <?= isset($errors['file']) && $errors['file'] !== true ? 'has-error' : '' ?>">
                                <label for="exampleFormControlFile1">Documento</label>
                                <input type="file" class="form-control-file" name="document-file" id="exampleFormControlFile1">
                                <?= isset($errors['file']) && $errors['file'] !== true ? '<span>' . $errors['file'] . '</span>' : '' ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <button type="submit" class="btn btn-primary">Crear documento</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h1>Administración de documentos</h1>
        <hr>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="alert alert-info">
                <p><i class="fa fa-comment"></i> Las asignaturas sin documentos no se mostrarán</p>
            </div>
        </div>

        <?php foreach($subjects as $subject) { ?>

            <?php if(isset($subject->documents) && count($subject->documents) > 0) { ?>

            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Curso: <?= $subject->category->name ?> | Asignatura: <?= $subject->name ?>
                    </div>
                    <div class="panel-body">

                        <table class="table">
                            <tr>
                                <th>Nombre</th>
                                <th>Ver</th>
                                <th>Eliminar</th>
                            </tr>

                            <?php foreach($subject->documents as $document) { ?>

                            <tr>
                                <td><?= $document->name ?></td>
                                <td>
                                    <a href="/documents/show/<?= $document->slug ?>" target="_blank" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="/admindocuments/delete/<?= $document->slug ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Seguro que quiere eliminar esta asignatura? Se borrarán todos sus documentos.')"><i class="fa fa-times"></i></a>
                                </td>

                            </tr>

                            <?php } ?>

                        </table>

                    </div>
                </div>

            </div>

            <?php } ?>

        <?php } ?>

    </div>

</div>
