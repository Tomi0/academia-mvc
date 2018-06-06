<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administración academia</title>

    <!-- Bootstrap Core CSS -->
    <link href="/admin-template/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/admin-template/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin-template/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/admin-template/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin-template/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/admin-template/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/admin-template/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="/css/admin-css.css" rel="stylesheet" type="text/css">

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">Panel de administrador</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li class="text-center">
                        <a href="/login/logout" class="btn btn-primary btn-xs"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/adminuser">Administrar usuarios</a>
                            </li>
                            <li>
                                <a href="/adminuser/create">Crear un usuario</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-folder-open fa-fw"></i> Asignaturas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/adminsubjects">Administrar asignaturas</a>
                            </li>
                            <li>
                                <a href="/adminsubjects/create">Crear una asignatura</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admindocuments"><i class="fa fa-file-text fa-fw"></i> Documentos</a>
                    </li>
                    <li>
                        <a href="/adminmatriculas"><i class="fa fa-book fa-fw"></i> Administrar matriculas</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-suitcase fa-fw"></i> Cursos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/admincategories">Administrar cursos</a>
                            </li>
                            <li>
                                <a href="/admincategories/create">Crear un curso</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administración</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?= $this->section('content') ?>

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="/admin-template/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/admin-template/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/admin-template/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="/admin-template/raphael/raphael.min.js"></script>
<script src="/admin-template/morrisjs/morris.min.js"></script>
<script src="/admin-template/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/admin-template/dist/js/sb-admin-2.js"></script>

<script src="/admin-template/datatables/js/jquery.dataTables.min.js"></script>
<script src="/admin-template/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="/admin-template/datatables-responsive/dataTables.responsive.js"></script>
<script src="/admin-templete/dist/js/sb-admin-2.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

</body>

</html>
