<?php $this->layout('admin/layouts/layout') ?>

<div class="panel panel-green">
    <div class="panel-heading">
        Editar asignatura
    </div>
    <div class="panel-body">

        <form action="/adminsubjects/update/<?= $subject->slug ?>" method="POST">

            <div class="row">
                <div class="form-group col-lg-6 <?= isset($errors['name']) && $errors['name'] !== true ? 'has-error' : '' ?>">
                    <label for="name">Nombre de la asignatura</label>
                    <input type="text" name="name" id="name" placeholder="introduzca un nombre" class="form-control" value="<?= isset($_POST['name']) ? $_POST['name'] : isset($subject->name) ? $subject->name : '' ?>">
                    <?= isset($errors['name']) && $errors['name'] !== true ? '<span>' . $errors['name'] . '</span>' : '' ?>
                </div>
                <div class="form-group col-lg-6 <?= isset($errors['category_id']) && $errors['category_id'] !== true ? 'has-error' : '' ?>">
                    <label for="category_id">Curso</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <?php foreach($categories as $category) { ?>
                            <option <?php if (isset($_POST['category_id'])) { echo $_POST['category_id'] == $category->id ? 'selected' : ''; } else { echo $subject->category_id == $category->id ? 'selected' : ''; } ?> value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php } ?>
                    </select>
                    <?= isset($errors['category_id']) && $errors['category_id'] !== true ? '<span>' . $errors['category_id'] . '</span>' : '' ?>
                </div>
            </div>

            <div class="row">

                <div class="form-group col-lg-3 <?= isset($errors['user_id']) && $errors['user_id'] !== true ? 'has-error' : '' ?>">
                    <label for="user_id" class="control-label">Profesor:</label>
                </div>
                <div class="form-group col-lg-9">
                    <select name="user_id" id="user_id" class="form-control">
                        <?php foreach($users as $user) { ?>
                            <?php if ($user->rol->name == 'profesor') { ?>
                                <option <?php if (isset($_POST['user_id'])) { echo $_POST['user_id'] == $user->id ? 'selected' : ''; } else { echo $subject->user_id == $user->id ? 'selected' : ''; } ?> value="<?= $user->id ?>"><?= $user->name ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <?= isset($errors['user_id']) && $errors['user_id'] !== true ? '<span>' . $errors['user_id'] . '</span>' : '' ?>
                </div>

            </div>

            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary margen-izquierda-normal">Editar</button>
                </div>
            </div>

        </form>

    </div>
</div>

<?php var_dump($subject) ?>