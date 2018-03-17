<?php $this->layout('layouts/layout') ?>


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form class="form-horizontal" method="POST" action="/register/check">

                        <?php

                            if (isset($error)) {
                                echo '<div class="row alert-danger alerta-peligro"><ul>';

                                foreach ($error as $e) {
                                    if ($e !== true) {
                                        echo '<li>' . $e . '</li>';
                                    }
                                }

                                echo '</ul></div>';
                            }

                        ?>

                        <div class="row form-group <?= isset($error['name']) ? ' has-error' : '' ?>">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control texto-negro" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" autofocus>
                            </div>
                        </div>

                        <div class="row form-group<?= isset($error['email']) ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control texto-negro" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            </div>
                        </div>

                        <div class="row form-group<?= isset($error['password']) ? ' has-error' : '' ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control texto-negro" name="password">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control texto-negro" name="password_confirmation">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

