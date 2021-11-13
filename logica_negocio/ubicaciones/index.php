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
                  <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class=" mdi mdi-map-marker"></i></span>
                  <div class="mini-stat-info">
                    <span id="ubicacion_registrados" class="counter text-blue-grey">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">65241</font>
                      </font>
                    </span>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        Municipios con cobertura
                      </font>
                    </font>
                  </div>
                  <div class="clearfix"></div>

                </div>
              </div>

              <div class="col-md-6 col-xl-6" id="registrar_ubicacion" style="cursor: pointer;">
                <div class="mini-stat clearfix bg-white">
                  <span class="mini-stat-icon bg-teal mr-0 float-right"><i class=" mdi mdi-google-maps"></i></span>
                  <div class="mini-stat-info">
                    <span class="counter text-teal">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Ver mapa</font>
                      </font>
                    </span>
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">
                        De cobertura del país
                      </font>
                    </font>
                  </div>
                  <div class="clearfix"></div>

                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-xl-12">
                <div class="mini-stat clearfix bg-white">
                  <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class=" mdi mdi-library-plus"></i></span>
                  <div class="mini-stat-info">

                    <span class="counter text-teal">
                      <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Gestión de cobertura</font>
                      </font>
                    </span>
                    <br>
                    <form name="formulario_registro" id="formulario_registro">
                      <div class="container">
                        <div class="row">
                          <div class="col-sm">
                            <label>Departamentos</label>
                            <select class="form-control form-select-lg mb-3" id="lista1" name="lista1">
                              <option selected value="1">Ahuachapán</option>
                              <option value="2">Santa Ana</option>
                              <option value="3">Sonsonate</option>
                              <option value="4">La Libertad</option>
                              <option value="5">Chalatenango</option>
                              <option value="6">San Salvador</option>
                              <option value="7">Cuscatlán</option>
                              <option value="8">La Paz</option>
                              <option value="9">Cabañas</option>
                              <option value="10">San Vicente</option>
                              <option value="11">Usulután</option>
                              <option value="12">Morazán</option>
                              <option value="13">San Miguel</option>
                              <option value="14">La Unión</option>
                            </select>
                          </div>
                          <div class="col-sm">
                            <div id="select2lista"></div>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group">
                            <label>Costo de envío ($) *</label>
                            <input type="number" min="0" step="1" step="any" maxlength="10" autocomplete="off" name="costoenvio" data-parsley-error-message="Campo requerido" required id="costoenvio" class="form-control" required placeholder="Ingrese costo de envio" />
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="d-flex">
                    <div class="mr-auto pl-4">
                    <div id="select2boton"></div>
                     </div>
                    <div class="pr-5">
                      <button id="btn_guardar" class="btn btn-primary ml-auto">Actualizar datos</button>
                    </div>
                  </div>
                </div>
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


  <script src="funciones_ubicacion.js"></script>


</body>

</html>