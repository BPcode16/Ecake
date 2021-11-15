<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
 <link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
 <?php include '../../layouts/headerStyle.php'; ?>
<style>
    
    div#registrar_usuario {
        cursor: pointer;
    }
    .error_modificado li.parsley-required {
        position: absolute;
        margin-top: 42px;
        margin-left: -330px;
    }
</style>
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
                            <div class="col-md-6 col-xl-6" >
                                <div class="mini-stat clearfix bg-white">
                                    <span class="mini-stat-icon bg-purple mr-0 float-right"><i class="mdi mdi-cake"></i></span>
                                    <div class="mini-stat-info">
                                        <span class="counter text-purple" id="cantidad_productos">25140</span>
                                        Productos registrados
                                    </div>
                                    <div class="clearfix"></div>
                                     
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6" id="registrar_producto" style="cursor: pointer;">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="mdi mdi-library-plus"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-teal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Vamos a agregar nuevos productos!</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            Clic aquí y agrega nuevos productos a tu catálogo.
                                        </font></font></div>
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

            <!-- aca las modales-->
   
            <!-- Comienzo del modal -->

            <div class="modal fade" id="md_registrar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">¡Perfecto! Vamos a registrar un nuevo producto. <br></h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                     <form name="formulario_registro" id="formulario_registro" >
                        <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                        <input type="hidden" id="llave_producto" name="llave_producto" value="si_registro">
                          <div class="row">

                           <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Categoría</label>
                                <select id="categoria" name="categoria" class="form-control">

                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nombre del pastel</label>
                                <input type="text" autocomplete="off" name="nombre" data-parsley-required-message="El nombre es requerido" data-quien_es="nombre" id="nombre" class="form-control validar_campos_unicos" required placeholder="Ingrese el nombre de su producto"/>
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Tiempo de procesado </label>
                                <select id="tiempo" name="tiempo" class="form-control select2">
                                     
                                    <option value="1" selected >1 día</option>
                                    <option value="2" >2 días</option>
                                    <option value="3" >3 días</option>
                                    <option value="4" >4 días</option>
                                    <option value="5" >5 días</option>
                                    <option value="6" >6 días</option>
                                    <option value="7" >7 días</option>
                                    <option value="8" >8 días</option>
                                    <option value="9" >9 días</option>
                                    <option value="10" >10 días</option>
                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Relleno</label>
                                <select id="relleno" name="relleno" class="form-control select2">
                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Remojo</label>
                                <select id="remojo" name="remojo" class="form-control select2">
                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Sabor de la torta</label>
                                <select id="sabor" name="sabor" class="form-control select2">
                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                    <label>Descrición</label>
                                    <div>
                                        <textarea required class="form-control" id="descrip" name="descrip" rows="5" data-parsley-error-message="Campo requerido" placeholder="Agrega una descripcion de su producto"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seleccione la imagen de tu pastel</label>
                                    <input id="imagen_producto" name="imagen_producto"  data-buttonText="Seleccionar" type="file" class="filestyle" data-buttonname="btn-secondary">
                                    <label style="display:none;font-size: 12px; list-style: none; color: #ea553d; margin-top: 5px;" id="error_en_la_imagen">El formato de la imagen no es valido</label>
                                    <label style="display:none;font-size: 12px; list-style: none; color: #ea553d; margin-top: 5px;" id="error_en_la_imagen_t">Ingrese una imagen menor a 5MB</label>
                                    
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
        <!-- End Right content here -->

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

    <!-- Required datatable js -->
    <script src="../../public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../../public/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../../public/plugins/datatables/jszip.min.js"></script>
    <script src="../../public/plugins/datatables/pdfmake.min.js"></script>
    <script src="../../public/plugins/datatables/vfs_fonts.js"></script>
    <script src="../../public/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.print.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../../public/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../../public/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="../../public/assets/pages/datatables.init.js"></script>
        
    <!-- App js -->
    <script src="../../public/assets/js/app.js"></script>
    <script src="../../public/plugins/select2/js/select2.min.js"></script>
    

    
    
    <script src="../../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script src="funciones_producto.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>