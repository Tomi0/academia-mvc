<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h3>Necesitas una clave para poder entrar en la asignatura</h3>

    <div class="matricula margen-arriba">

        <form action="/subjects/matricula/<?= isset($subject->slug) ? $subject->slug : '' ?>" method="POST">

            <div class="row form-group <?= isset($error) ? 'has-error' : '' ?>">

                <label class="control-label col-md-2" for="matricula">Clave: </label>

                <input type="password" name="matricula" class="form-control col-md-6" placeholder="clave de la asignatura" id="matricula">

                <?php isset($error) ? "<small class='has-error'>$error</small>" : '' ?>

            </div>

            <div class="row form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

        </form>

    </div>

</div>