<?php $Nro=0; ?>
<!-- Main content -->
<section class="content">
     <?php
          if((isset($nuevo) && ($nuevo!=null)))
          {
               if($nuevo)
               ?>
               <div class="row">
                    <div class="col-md-4">
                         <a href="<?php echo $enlace_bonton;?>" class="btn btn-success">Nuevo</a>
                    </div>
               </div>

     <?php
          }
     ?>
     <div class="row">
          <div class="col-xs-12">
               <div class="box">
                    <div class="box">
                         <!-- /.box-header -->
                         <div class="box-body">

                              <table id="example1" class="table table-bordered table-striped">
                                   <thead>
                                   <tr>
                                        <th>Nro</th>
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
                                   if($arr_tabla!=false)
                                   foreach($arr_tabla->result_array() as $fila)
                                   {?>
                                        <tr>
                                             <?php
                                             $Nro++;
                                             echo "<td>";
                                             echo $Nro;
                                             echo "</td>";

                                             $id_persona=0;
                                             foreach ($nombre_campos_tabla as $value){
                                                  echo "<td>$fila[$value]</td>";
                                                       $id_persona=$fila[$value];
                                             }
                                             ?>
                                             <?php
                                             echo "<td>";
                                             foreach($enlaces as $value){
                                                  echo "<a href='".$value['direccion']."".$id_persona."'>".$value['nombre enlace']."</a><br>";
                                             }
                                             echo  "</td>";
                                             ?>
                                        </tr>
                                        <?php
                                   }
                                   ?>
                                   </tbody>
                                   <!--
                                   <tfoot>
                                   <tr>
                                        <th><a href=#>Todo</a></th>
                                   </tr>
                                   </tfoot>
                                   -->
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