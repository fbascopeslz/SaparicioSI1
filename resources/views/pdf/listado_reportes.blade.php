
           
@extends ('layouts.admin')
@section ('contenido')
           <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DEL SISTEMA</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                   
                    <thead><tr>
                      <th>Reporte</th>
                      
                      <th>ver</th>
                      <th>descargar</th>
                    </tr></thead>
                    <tbody>
                    <tr>
                      
                      <td>Reporte de todos nuestros productos</td>
                      <td><a href="crear_reporte_productos/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_productos/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    
                    </tr>
                     <tr>
                      
                      <td>Reporte de todas nuestros ingresos de productos</td>
                      <td><a href="crear_reporte_ingresos/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_ingresos/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    
                    </tr>
                     <tr>
                      
                      <td>Reporte de todas nuestros ingresos de productos por fecha</td>
                      <td><a href="{{url('crear_reporte_ingresos_fechas')}}" ><button class="btn btn-block btn-primary btn-xs">enviar fechas</button></a></td>
                      
                
                    </tr>
                    <tr>
                      
                      <td>Reporte de Inventario</td>
                      <td><a href="crear_reporte_inventario/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_inventario/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    
                    </tr>
                     <tr>
                      
                      
                    
                    </tr>
                    
                   
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>
@endsection