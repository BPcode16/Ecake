<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- Check Admin -->
<link rel="stylesheet" href="../../public/assets/css/custom.css">

<?php include '../../layouts/headerStyle.php'; ?>



<body class="fixed-left">

  <?php include '../../layouts/loader.php'; ?>

  <!-- Begin page -->
  <div id="wrapper">

    <?php include '../../layouts/navbar.php'; ?>

    <!-- Start right Content here -->
    <div class="content-page">
      <!-- Start content -->
      <div class="content">

        <!-- Top Bar Start -->
        <?php include '../../layouts/toolbar.php'; ?>
        <!-- Top Bar End -->

        <!-- ==================
                         PAGE CONTENT START
                         ================== -->

        <div class="page-content-wrapper">

          <div class="container-fluid">

            <div class="row">

              <div class="col-md-6 col-xl-6">
                <div class="mini-stat clearfix bg-white">
                  <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-content-copy"></i></span>
                  <div class="mini-stat-info">
                    <span class="counter text-blue-grey">
                      <div id="empleados_registradas"></div>
                    </span>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Empleados registrados
                      </font>
                    </font>
                  </div>
                  <div class="clearfix"></div>

                </div>
              </div>

              <div class="col-md-6 col-xl-6" id="registrar_empleado" style="cursor: pointer;">
                <div class="mini-stat clearfix bg-white">
                  <span class="mini-stat-icon bg-teal mr-0 float-right"><i class=" mdi mdi-account-circle"></i></span>
                  <div class="mini-stat-info">
                    <span class="counter text-teal">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Añadir empleado</font>
                      </font>
                    </span>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Agrege mas empleados a su empresa
                      </font>
                    </font>
                  </div>
                  <div class="clearfix"></div>

                </div>
              </div>
            </div>

            <!-- Comienza el datatable -->
            <div class="row">
              <div class="col-12">
                <div class="card m-b-20">
                  <div class="card-body">

                    <div id="aqui_tabla" class="table">
                    </div>


                  </div>
                </div>
              </div> <!-- end col -->
            </div> <!-- end row -->

          </div><!-- container -->

        </div> <!-- Page content Wrapper -->

      </div> <!-- content -->

      <?php include '../../layouts/footer.php'; ?>

    </div>
    <!-- End Right content here -->

    <!-- Comienzo del modal -->

    <div class="modal fade" id="md_registrar_empleado" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">
              <div id="titulo"></div> <br>
              <div style="font-size: 12px;" class="alert alert-info mb-0" role="alert">
                <strong>
                  ¡Importante!
                </strong>
                Los cambios marcados con * son obligatorios.
              </div>
            </h6>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form name="formulario_registro" id="formulario_registro">
              <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
              <input type="hidden" name="llave_empleado" id="llave_empleado" value="">
              <input type="hidden" name="validar" id="validar" value="">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="Juan Carlos" id="nombre" name="nombre" maxlength="50">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="apellido">Apellido *</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="Perez Soza" id="apellido" name="apellido" maxlength="50">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="correo">Correo *</label>
                    <input type="text" class="form-control" placeholder="jose145@gmail.com" id="correo" name="correo" maxlength="75">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pass">Contraseña *</label>

                    <div class="input-group">
                      <input type="Password" id="pass" name="pass" maxlength="25" placeholder="************" Class="form-control">

                      <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="administrador">Administrador</label>
                    <div class="position-relative">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="administrador" id="flexRadioDefault1" value="1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Si
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="administrador" id="flexRadioDefault2" value="0">
                        <label class="form-check-label" for="flexRadioDefault2">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="Limpiar()" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">
              <div id="valboton"></div>
            </button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- END wrapper -->


  <?php include_once '../../layouts/footerScript.php'; ?>

  <!-- Peity chart JS -->
  <script src="../../public/plugins/peity-chart/jquery.peity.min.js"></script>

  <!--C3 Chart-->
  <script src="../../public/plugins/d3/d3.min.js"></script>
  <script src="../../public/plugins/c3/c3.min.js"></script>

  <!-- KNOB JS -->
  <script src="../../public/plugins/jquery-knob/excanvas.js"></script>
  <script src="../../public/plugins/jquery-knob/jquery.knob.js"></script>

  <!-- Page specific js -->
  <script src="../../public/assets/pages/dashboard.js"></script>

  <!-- App js -->
  <script src="../../public/assets/js/app.js"></script>

  <!-- Parsley js -->

  <script src="../../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <!-- sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script src="funciones_empleado.js"></script>
  <!-- <script src="../validaciones/validar_input.js"></script> -->


</body>

</html>