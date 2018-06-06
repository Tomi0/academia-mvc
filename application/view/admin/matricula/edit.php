<?php $this->layout('admin/layouts/layout') ?>

<div class="row">
    <div class="col-lg-7">

        <div class="panel panel-primary">
            <div class="panel-heading">
                Matricular en
            </div>
            <div class="panel-body">

                <form action="/adminmatriculas/store/<?= $user->email ?>" method="POST">

                    <div class="form-group">
                        <label for="subject" class="control-label"><?= isset($user->name) ? $user->name : '' ?> matricular en:</label>
                        <select name="subject" id="subject" class="form-control">

                            <?php foreach($subjects as $subject) { ?>

                                <?php $aux = false; ?>

                                <?php foreach ($user->subjects as $subject1) { ?>

                                    <?php if ($subject->id == $subject1->id) { ?>

                                        <?php $aux = true; break; ?>

                                    <?php } ?>

                                <?php } ?>

                                <?php if (!$aux) { ?>
                                    <option value="<?= $subject->id ?>"><?= $subject->name ?> en <?= $subject->category->name ?></option>
                                <?php } ?>

                            <?php } ?>

                        </select>
                        <?= isset($errors['subject']) ? '<span class="text-danger">' . $errors['subject'] . '</span>' : '' ?>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Matricular</button>
                        <a href="/adminmatriculas" class="btn btn-secondary">Volver</a>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= isset($user->name) ? $user->name : '' ?> matriculado en
            </div>
            <div class="panel-body">
                <?php if(isset($user->subjects) && count($user->subjects) > 0) { ?>
                    <?php foreach($user->subjects as $subject) { ?>

                    <p style="display: inline"><?= $subject->name ?> en <?= $subject->category->name ?></p>

                    <a href="/adminmatriculas/desmatricular/<?= $user->email ?>/<?= $subject->slug ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Seguro que quiere desmatricular a este usuario?')">
                        <i class="fa fa-times"></i>
                    </a>

                    <hr />

                    <?php } ?>
                <?php } else { ?>

                <h4>No se encuentra matriculado en ningún curso</h4>

                <?php } ?>
            </div>
        </div>
    </div>
</div>