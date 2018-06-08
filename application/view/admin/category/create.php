<?php $this->layout('admin/layouts/layout') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Crear nuevo curso
            </div>
            <div class="panel-body">

                <form action="/admincategories/store" method="POST">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group  <?= isset($errors['name']) && $errors['name'] !== true ? 'has-error' : '' ?>">
                                <label for="nameId">Nombre del curso</label>
                                <input type="text" class="form-control" name="name" id="nameId" placeholder="nombre del curso" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                                <?= isset($errors['name']) && $errors['name'] !== true ? '<span>' . $errors['name'] . '</span>' : '' ?>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group <?= isset($errors['category_id']) && $errors['category_id'] !== true ? 'has-error' : '' ?>">

                                <label for="categoryID">Curso al que pertenece</label>

                                <select name="category_id" id="categoryID" class="form-control">

                                    <option value="">Ninguno</option>

                                    <?php foreach($categories as $category) { ?>

                                        <option <?= isset($_POST['category_id']) ? $_POST['category_id'] == $category->id ? 'selected' : '' : '' ?> value="<?= $category->id ?>"><?= $category->name ?></option>

                                    <?php } ?>

                                </select>

                                <?= isset($errors['category_id']) && $errors['category_id'] !== true ? '<span>' . $errors['category_id'] . '</span>' : '' ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <a href="/admincategories" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>