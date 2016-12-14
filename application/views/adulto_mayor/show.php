<!-- Main content -->
<section class="content">
     <div class="row">
          <div class="col-xs-12">
               <div class="box">
                    <div class="box-header">
                         <h3 class="box-title">Hover Data Table</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box">
                         <div class="box-header">
                              <h3 class="box-title">Adulto mayor</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">

                              <table id="example1" class="table table-bordered table-striped">
                                   <thead>
                                   <tr>
                                        <?php
                                        foreach ($nombre_campos_form as $value) {
                                             echo "<th>$value</th>";
                                        }
                                        ?>
                                        <th>Opcion</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   <?php
                                   foreach($persona->result_array() as $fila)
                                   {?>
                                        <tr>
                                             <?php
                                             foreach ($nombre_campos_tabla as $value) {
                                                  echo "<td>$fila[$value]</td>";
                                             }
                                             ?>
                                             <?php
                                             echo "<td>";
                                             foreach($enlaces as $value){
                                                  echo "<a href='".$value['direccion'].$fila['persona_id']."'>".$value['nombre enlace']."</a><br>";
                                             }
                                             echo  "</td>";
                                             ?>
                                        </tr>
                                        <?php
                                   }
                                   ?>
                                   </tbody>
                                   <tfoot>
                                   <tr>
                                        <th><a href=#>Nuevo</a></th>
                                   </tr>
                                   </tfoot>
                              </table>
                         </div>
                         <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
               </div>
               <!-- /.col -->
          </div>
          <!-- /.row -->
</section>
<!-- /.content -->
</div>
</div>


<table>
	<tr><td><input type="text" name="tb_buscar" id="tb_buscar"></td></tr>
</table>
<div id="datos">
	
</div>
<script type="text/javascript">
$(document).ready(function() 
	{
     elemento="#tb_buscar";
     direccion="<?php echo base_url('Adulto_Mayor/buscar') ?>";
     console.log(direccion);
     evento="keyup";
     mostrar="#datos";
     atributo="ci";
	buscar(elemento,direccion,evento,mostrar,atributo);
});
</script>