<?php $this->layout('layouts/layout') ?>

<div class="container">

    <h2>Cursos en <?= $category->name ?></h2>

    <div class="list-group margen-arriba">

        <?php foreach ($category->categories as $cat) { ?>

            <a href="/category/show/<?= $cat->slug ?>" class="list-group-item list-group-item-action"><?= $cat->name ?></a>

        <?php } ?>

    </div>

</div>

