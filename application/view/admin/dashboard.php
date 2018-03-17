<?php $this->layout('admin/layouts/layout') ?>


<div class="row">
    <div class="col">
        <h2>Usuario autenticado: <?= \Mini\Libs\Sesion::get('email') ?></h2>
    </div>
</div>