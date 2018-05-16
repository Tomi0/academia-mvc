<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Cursos:</h2>

    <div class="list-group margen-arriba">

        <?php foreach ($categories as $category) { ?>

            <a href="/category/show/<?= $category->slug ?>" class="list-group-item list-group-item-action"><?= $category->name ?></a>

        <?php } ?>

    </div>

</div>
