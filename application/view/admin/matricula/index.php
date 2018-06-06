<?php $this->layout('admin/layouts/layout') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <p><i class="fa fa-comment"></i> Solo se puenden matricular en asignaturas a alumnos.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Matricular alumnos
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                    <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>ROL</th>
                        <th>ACCIONES</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach($users as $user) { ?>

                        <?php if ($user->rol->name == 'alumno') { ?>

                            <tr>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->rol->name ?></td>
                                <td>

                                    <a href="/adminmatriculas/edit/<?= $user->email ?>" class="btn btn-primary">Modificar matriculas</a>

                                </td>
                            </tr>

                        <?php } ?>

                    <?php } ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
