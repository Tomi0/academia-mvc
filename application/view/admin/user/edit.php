<?php $this->layout('admin/layouts/layout') ?>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Formulario de edición de usuarios
            </div>

            <div class="panel-body">

                <form action="/adminuser/update/<?= isset($user->email) ? $user->email : 'error' ?>" method="POST">

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group <?= isset($errors['name']) && $errors['name'] !== true ? 'has-error' : '' ?>">
                                <label class="control-label" for="name">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="introduce el nombre" <?= isset($user->name) && !isset($_POST['name']) ? "value=\"" . $user->name . "\"" : '' ?> <?= isset($_POST['name']) ? "value=\"" . $_POST['name'] . "\"" : '' ?>>
                                <?= isset($errors['name']) && $errors['name'] !== true ? '<span>' . $errors['name'] . '</span>' : '' ?>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group <?= isset($errors['email']) && $errors['email'] !== true ? 'has-error' : '' ?>">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="introduce el email" <?= isset($user->email) && !isset($_POST['email']) ? "value=\"" . $user->email . "\"" : '' ?> <?= isset($_POST['email']) ? "value=\"" . $_POST['email'] . "\"" : '' ?>>
                                <?= isset($errors['email']) && $errors['email'] !== true ? '<span>' . $errors['email'] . '</span>' : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group <?= isset($errors['password']) && $errors['password'] !== true ? 'has-error' : '' ?>">
                                <label class="control-label" for="password">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="introduce contraseña">
                                <?= isset($errors['password']) && $errors['password'] !== true ? '<span>' . $errors['password'] . '</span>' : '' ?>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group <?= isset($errors['role']) && $errors['role'] !== true ? 'has-error' : '' ?>">
                                <label class="control-label">Rol: </label>
                                <select class="form-control" name="role">

                                    <?php foreach($roles as $role) { ?>

                                        <option <?php if (isset($user->rol_id) && $user->rol_id == $role->id) echo 'selected'; ?> value="<?= $role->id ?>"><?= $role->name ?></option>

                                    <?php } ?>

                                </select>
                                <?= isset($errors['role']) && $errors['role'] !== true ? '<span>' . $errors['role'] . '</span>' : '' ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary">Guardar usuario</button>
                            <a href="/adminuser" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>