<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />


<?php include '../../layouts/headerStyle.php'; ?>

<link href="../../public/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
                  <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class=" mdi mdi-account-plus"></i></span>
                  <div class="mini-stat-info">
                    <span id="usuarios_registrados" class="counter text-blue-grey">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">65241</font>
                      </font>
                    </span>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Usuarios registrado
                      </font>
                    </font>
                  </div>
                  <div class="clearfix"></div>

                </div>
              </div>

              <div class="col-md-6 col-xl-6" id="registrar_usuario" onclick="CargarDatos('si_tabla',-1), cancel(), limpiar()" style="cursor: pointer;">
                <div class="mini-stat clearfix bg-white">
                  <span class="mini-stat-icon bg-teal mr-0 float-right"><i class=" mdi mdi-account-circle"></i></span>
                  <div class="mini-stat-info">
                    <span class="counter text-teal">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Registrar</font>
                      </font>
                    </span>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Presentaciones
                      </font>
                    </font>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-12">
                <card class="card m-b-20">
                  <div class="card-body">
                    <div id="aqui_tabla">
                    </div>
                  </div>
                </card>
              </div>
            </div>

          </div><!-- container -->

        </div> <!-- Page content Wrapper -->

      </div> <!-- content -->

      <?php include '../../layouts/footer.php'; ?>

    </div>
    <!-- End Right content here -->


    <!-- Comienzo del modal -->

    <div class="modal fade" onclick="" id="md_registrar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Registra nuevas presentaciones para tus productos<br>
              <div class="alert alert-danger mb-0" role="alert">
                <strong>
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">¡Importante! </font>
                  </font>
                </strong>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Los cambios marcados con * son obligatorios.
                  </font>
                </font>
              </div>
            </h6>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form name="formulario_registro" id="formulario_registro">
              <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
              <input type="hidden" name="idpresentacion" id="idpresentacion" value="">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div id="select2lista"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tamaño *</label>
                    <input type="text" autocomplete="off" name="tamanio" data-parsley-error-message="Campo requerido" id="tamanio" class="form-control" required placeholder="Ingrese tamaño de presentación" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Precio *</label>
                    <input type="number" autocomplete="off" name="precio" data-parsley-error-message="Campo requerido" id="precio" class="form-control" required placeholder="Ingrese precio" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="cancel()" id="boton2" value="1" name="boton2" class="btn btn-secondary">Cerrar</button>
                  <button type="submit" id="boton1" value="1" name="boton1" class="btn btn-primary">Agregar</button>
                </div>
                <div class="col-12">
                  <card class="card m-b-20">
                    <div class="card-body">
                      <div id="aqui_tabla2">
                      </div>
                    </div>
                  </card>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>

  </div>
  <!-- END wrapper -->


  <?php include '../../layouts/footerScript.php'; ?>

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
  <script type="text/javascript" src="../../public/plugins/parsleyjs/parsley.min.js"></script>

  <script src="../../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script src="funciones_usuarios.js"></script>


</body>

</html>