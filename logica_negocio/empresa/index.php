<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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

                    <h4 class="text-center mt-0 header-title">Configuración de la empresa</h4>
                    <p class=" text-center m-0text-muted m-b-30 font-14">Aquí podrá personalizar su ecommerce.</p>

                    <form name="formulario_registro" id="formulario_registro">
                      <div class="row">
                        <div class="col-12">
                          <h3 class="text-center m-0">
                            <a class="image-popup-no-margins" href="../../public/assets/images/base/logo4.png">
                              <img class="text-center m-0 img-responsive" src="../../public/assets/images/base/logo4.png" width="165">
                            </a>
                          </h3>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-3">

                          <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_actualizalo">
                          <input type="hidden" name="llave_empresa" id="llave_empresa" value="">
                          <input type="hidden" name="validar" id="validar" value="">

                          <div class="form-group">
                            <label>Nombre *</label>
                            <div>
                              <input type="text" class="form-control" placeholder="Ecake" id="nombre" name="nombre" maxlength="50"/>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Email *</label>
                            <div>
                              <input type="text" class="form-control" placeholder="ecake@gmail.com" id="email" name="email"  maxlength="60"/>
                            </div>
                          </div>
                          <div class="form-group m-b-0">
                              <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                  Guardar
                                </button>
                              </div>
                            </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Horario</label>
                            <div>
                              <textarea class="form-control" rows="4" id="horario" name="horario"  maxlength="200"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Telefono</label>
                            <div>
                              <input type="text" class="form-control" placeholder="9999-9999" id="telefono" name="telefono"  maxlength="9"/>
                            </div>
                          </div>
                          <div class="form-group" type="hidden">
                            
                            <div>
                              <input type="hidden" class="form-control" id="logo" name="logo" />
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label>Direccón</label>
                            <div>
                              <textarea class="form-control" rows="4" id="direccion" name="direccion"  maxlength="200"></textarea>
                            </div>
                          </div>

                        </div>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <?php include '../../layouts/footer.php'; ?>

        </div>
        <!-- End Right content here -->

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

      <script src="funciones_empresa.js"></script>
      <script src="../validaciones/validar_input.js"></script>


</body>

</html>