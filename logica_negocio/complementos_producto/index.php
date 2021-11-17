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

                            <div class="col-md-6 col-xl-12" id="registrar_comp" style="cursor: pointer;">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="mdi mdi-library-plus"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Vamos a personalizar más nuestros pasteles!</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Clic aquí y agrega nuevas características a tus pasteles.
                                        </font></font></div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-meteor"></i></span>
                                        <div class="mini-stat-info">
                                            <span id="rellenos_registrados" class="counter text-blue-grey"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">65241</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Sabores de relleno registrados
                                        </font></font></div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-water"></i></span>
                                        <div class="mini-stat-info">
                                            <span id="remojos_registrados" class="counter text-blue-grey"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">65241</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Sabores de remojo registrados
                                        </font></font></div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-4">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="fa fa-codiepie"></i></span>
                                        <div class="mini-stat-info">
                                            <span id="sabores_registrados" class="counter text-blue-grey"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">65241</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Sabores de torta registrados
                                        </font></font></div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <card class="card m-b-20">                                            
                                        <div class="card-body">
                                            <div class="card-body">
                                                <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Relleno de tus pasteles.</font></font></span>
                                            </div>
                                            <div id="aqui_tabla1" class="table">
                                            </div>
                                        </div>
                                    </card>
                                </div>

                                <div class="col-md-12 col-xl-12">
                                    <card class="card m-b-20">                                            
                                        <div class="card-body">
                                            <div class="card-body">
                                                <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Remojo de tus pasteles.</font></font></span>
                                            </div>
                                            <div id="aqui_tabla2" class="table">
                                            </div>
                                        </div>
                                    </card>
                                </div>

                                <div class="col-md-12 col-xl-12">
                                    <card class="card m-b-20">                                            
                                        <div class="card-body">
                                            <div class="card-body">
                                                <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sabores de torta.</font></font></span>
                                            </div>
                                            <div id="aqui_tabla3" class="table">
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

            <div class="modal fade" id="md_registrar_comp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg-6" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                  <div class="mini-stat-info">
                        <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Hora de ingresar nuevas características a tus pasteles!</font></font></span>
                    </div>
                  </div>


                  <div class="modal-body border border-secondary">
                      
                     <form name="formulario_registro_relleno" id="formulario_registro_relleno">
                     <input type="hidden" id="ingreso_datos_relleno" name="ingreso_datos_relleno" value="si_registro">
                        <input type="hidden" name="llave_relleno" id="llave_relleno" value="">
                        

                          <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label>Ingresa tu nuevo sabor de relleno</label>
                                        <div class="input-group mb-3">
                                                <input type="text" name="nombre_relleno" id="nombre_relleno" class="form-control"   maxlength="60" />
                                                    <div class="input-group-append">
                                                    <button type="button" name="btn_registro_relleno" id="btn_registro_relleno" class="btn btn-primary"><i class="fa fa-plus" title="Agregar sabor de relleno"></i> </button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                  </div>


                  <div class="modal-body border border-secondary">
                      
                     <form name="formulario_registro_remojo" id="formulario_registro_remojo">
                     <input type="hidden" id="ingreso_datos_remojo" name="ingreso_datos_remojo" value="si_registro">
                        <input type="hidden" name="llave_remojo" id="llave_remojo" value="">
                        

                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label>Ingresa tu nuevo sabor de remojo</label>
                                        <div class="input-group mb-3">
                                                <input type="text" autocomplete="off" name="nombre_remojo" id="nombre_remojo" class="form-control" maxlength="60" />
                                                    <div class="input-group-append">
                                                    <button type="button" name="btn_registro_remojo" id="btn_registro_remojo" class="btn btn-primary"><i class="fa fa-plus" title="Agregar sabor de remojo"></i> </button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                     
                      
                  </div>

                  <div class="modal-body border border-secondary">
                      
                     <form name="formulario_registro_sabor" id="formulario_registro_sabor">
                     <input type="hidden" id="ingreso_datos_sabor" name="ingreso_datos_sabor" value="si_registro">
                        <input type="hidden" name="llave_sabor" id="llave_sabor" value="">
                        

                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label>Ingresa tu nuevo sabor de torta</label>
                                        <div class="input-group mb-3">
                                                <input type="text" name="nombre_sabor" id="nombre_sabor" class="form-control" maxlength="60"/>
                                                    <div class="input-group-append">
                                                    <button type="button" name="btn_registro_sabor" id="btn_registro_sabor" class="btn btn-primary"><i class="fa fa-plus" title="Agregar sabor de tortaa"></i> </button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                     
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="Limpiar()" data-dismiss="modal">Cerrar</button>
                    </form>
                  </div>
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
        <script src="../validaciones/logo.js"></script>
        <script src="funciones_complementos.js"></script>
        <script src="../validaciones/validar_input.js"></script>

    </body>
</html>