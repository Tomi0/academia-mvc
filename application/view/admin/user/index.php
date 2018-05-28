<?php $this->layout('admin/layouts/layout') ?>

<div class="row">
    <div class="col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                Todos los usuarios
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($users as $user) { ?>

                    <tr>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->rol->name ?></td>
                        <td class="text-center">
                            <a href="/adminuser/edit/<?= $user->email ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="/adminuser/delete/<?= $user->email ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Seguro que quiere eliminar al usuario?');">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>

                    <?php } ?>

                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <div class="col-lg-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                Usuarios pendientes de validación
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Rol: invitado</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($users as $user) { ?>

                        <?php if ($user->rol->name === 'invitado') { ?>

                        <tr>
                            <td><?= $user->name ?></td>
                            <td><?= $user->email ?></td>
                            <td class="text-center">
                                <a href="/adminuser/edit/<?= $user->email ?>" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <a href="/adminuser/delete/<?= $user->email ?>" class="btn btn-xs btn-danger" onclick="return confirm('Al no validarlo será eliminado. ¿Está seguro?');">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>

                        <?php } ?>

                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>

</div>