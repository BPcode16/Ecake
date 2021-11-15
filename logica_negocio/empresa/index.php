<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- Check Admin -->
<link rel="stylesheet" href="../../public/assets/css/custom.css">

<!-- Alertas -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<!-- Magnific popup -->
<link href="../../public/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

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
              <div class="col-lg-12">
                <div class="card m-b-20">
                  <div class="card-body">

                    <h4 class="mt-0 header-title">Configuración de la empresa</h4>
                    <p class="text-muted m-b-30 font-14">Aquí podrá personalizar su ecommerce.</p>

                    <div class="row">
                      <div class="col-6">
                        <h5 class="mt-0 font-14 m-b-15 text-muted">Logo</h5>
                        <a class="image-popup-no-margins" href="../../public/assets/images/base/logo4.png">
                          <img class="img-responsive" src="../../public/assets/images/base/logo4.png" width="145">
                        </a>
                        <p class="mt-2 mb-0 font-14 text-muted">Click para zoom a la ímagen</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

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

      <!-- Magnific popup -->
      <script src="../../public/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
      <script src="../../public/assets/pages/lightbox.js"></script>

      <script src="../../public/assets/pages/lightbox.js"></script>

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
      <script src="../validaciones/validar_input.js"></script>


</body>

</html>