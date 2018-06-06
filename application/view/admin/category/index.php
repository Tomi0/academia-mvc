<?php $this->layout('admin/layouts/layout') ?>

<div class="row">
    <div class="col-lg-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Pertenece a</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($categories as $category) { ?>

                <tr>
                    <td><?= $category->name ?></td>
                    <td><?= isset($category->category->name) ? $category->category->name : '-' ?></td>
                    <td>
                        <a href="/admincategories/delete/<?= $category->slug ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Seguro que quiere eliminar el curso, los subcursos también serán eliminados?')">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
</div>