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
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-content-copy"></i></span>
                                        <div class="mini-stat-info">
                                            <span id="categorias_registradas" class="counter text-blue-grey"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">65241</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Categorías registradas
                                        </font></font></div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-xl-6" id="registrar_categoria" style="cursor: pointer;">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="mdi mdi-library-plus"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registrar nueva Categoría</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            ¡Hey! agrega nuevas categorías a tus pasteles.
                                        </font></font></div>
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

            <div class="modal fade" id="md_registrar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">¡Hey! Agrega nuevas categorias para tus pasteles<br>
                        <div class="alert alert-danger mb-0" role="alert">
                            <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Importante! </font></font></strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Los cambios marcados con * son obligatorios.
                            </font></font></div>
                        </h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                     <form name="formulario_registro" id="formulario_registro">
                     <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                        <input type="hidden" name="llave_categoria" id="llave_categoria" value="">
                        

                          <div class="row">
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nombre *</label>
                                <input type="text" autocomplete="off" name="nombre" data-parsley-error-message="Campo requerido" id="nombre" class="form-control" required placeholder="Ingrese el nombre de la categoría"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Descrición *</label>
                                <input type="text" autocomplete="off" name="descrip" data-parsley-error-message="Campo requerido" id="descrip" class="form-control" required placeholder="Agrega una descripcion a la categoría"/>
                              </div>
                            </div>


                          </div>
                     
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit"  class="btn btn-primary">Guardar</button>
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

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        


        <script src="funciones_categoria.js"></script>


    </body>
</html>