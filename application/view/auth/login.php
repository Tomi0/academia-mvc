<?php $this->layout('layouts/layout') ?>

    <section class="formulario-login">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form class="form-horizontal" method="POST" action="/login/check">

                        <?php //$this->insert('partials/feedback') ?>

                        <?= isset($error) ? '<div class="row alert-danger alerta-peligro">
                            <dvi class="col-md-12  text-center text-capitalize"><p>' . $error . '</p></dvi>
                        </div>' : '' ?>

                        <div class="row form-group <?= $error ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control texto-negro" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required autofocus>
                            </div>
                        </div>

                        <div class="row form-group <?= $error ? ' has-error' : '' ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control texto-negro" name="password" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

