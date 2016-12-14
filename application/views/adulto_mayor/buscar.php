<?php 
  foreach ($personas->result() as $value) {
 ?>
<div class="row">
 <div class="col-md-6">
	<div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title">Datos personales</h3>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form role="form">
	              <div class="box-body">
	                <div class="form-group">
						 <label for="exampleInputEmail1">Nombres</label>
						 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $value->nombre;?>" readonly>
	                </div>
	                <div class="form-group">
						 <label for="exampleInputEmail1">Apellidos</label>
						 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $value->apellido_p.' '.$value->apellido_m ;?>" readonly>
	                </div>
	            </form>
	</div>
 </div>
 <div class="col-md-6">
	<div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title">Datos personales</h3>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form role="form">
	              <div class="box-body">
	                <div class="form-group">
						 <label for="exampleInputEmail1">Nombres</label>
						 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $value->nombre;?>" readonly>
	                </div>
	                <div class="form-group">
						 <label for="exampleInputEmail1">Apellidos</label>
						 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $value->apellido_p.' '.$value->apellido_m ;?>" readonly>
	                </div>
	            </form>
	</div>
 </div>
</div>
<?php
 }
 ?>