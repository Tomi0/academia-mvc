<?php $this->layout('admin/layouts/layout') ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Todas las asignaturas
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Pertenece a</th>
                <th>Profesor</th>
                <th>Codigo matricula</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($subjects as $subject) { ?>

            <tr>
                <td><?= $subject->name ?></td>
                <td><?= $subject->category->name ?></td>
                <td><?= $subject->user->name ?></td>
                <td>
                    <?= $subject->matricula ?>
                    <a href="/adminsubjects/matricula/<?= $subject->slug ?>" class="btn btn-xs btn-info pull-right" onclick="return confirm('¿Seguro que quiere cambiar la matricula de esta asignatura?')">
                        <i class="fa fa-refresh"></i>
                    </a>
                </td>
                <td>
                    <a href="/adminsubjects/edit/<?= $subject->slug ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="/adminsubjects/delete/<?= $subject->slug ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Seguro que quiere eliminar esta asignatura? Se borrarán todos sus documentos.')"><i class="fa fa-times"></i></a>
                </td>
            </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
</div>