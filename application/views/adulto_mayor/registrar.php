<!-- form start -->
<form class="form-horizontal" METHOD="POST" action="<?= base_url()?>adulto_mayor/registrar_ingreso">
<div class="col-md-2" >
    <input class="btn btn-block btn-success" type="submit" value="Guardar">
</div>
<div class="col-md-12" >
</div>
<secction class="col-lg-8 connectedSortable ui-sortable">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">DATOS DE REGISTRO</h3>
        </div>
        <!-- /.box-header -->
            <input type="hidden" name="persona_id" value="<?= $persona_id ?>">
            <div class="box-body">
                <table border="0">
                    <tr>
                        <td><label >GERIÁTRICO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                        <td>
                            <select name="t_cenAcogida" id="t_cenAcogida" style="width:180px">
                                <option value="1">Rdo. Javier willig - Tupiza</option>
                                <option value="2"> Divina PRovidencia - Villazon</option>
                                <option value="3">hermanas de calcuta san roque - Potosí</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                    <tr>
                        <td> <label >A SOLICITUD DE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                        <td>
                            <select name="adulto_mayor_solicitud" style="width:120px">
                                    <option value="DEFENSORIA">Defensoria</option>
                                    <option value="FISCALIA">Fiscalia</option>
                                    <option value="POLICIA">Policia</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                    <tr>
                        <td><label>MODALIDAD: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>:</label></td>
                        <td>
                            <select name="adulto_mayor_modalidad" id="t_modalidad" style="width:150px" class="valid">
                                <option value="CIRCUNSTANCIAL">Circunstancial</option>
                                <option value="DEFINITIVO">Definitivo</option>
                            </select>
                        </td>
                        <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                        <td><label for="inputEmail3" class="col-sm-2 control-label">Dirección de familia: </label></td>
                        <td><input type="text" name="direccion_familia"></td>
                        <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                        <td><label for="inputEmail3" class="col-sm-2 control-label">Observaciones: </label></td>
                        <td><textarea rows="4" cols="0" name="observaciones"></textarea></td>
                    
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</secction>
<?= $datos_usuario ?><br>
<secction class="col-xs-12 xs-placeholder">
    <div class="box box-info">
        <div class="box-body">
            <?= $select_tipologias ?>
            <?= $select_tipologias_vacia ?>
            <div class="col-md-2">
                <br><br>
                <input class="btn btn-block btn-warning" type="button" class="pasar izq" value="Agregar" id="izdeT"><br>
                <input class="btn btn-block btn-danger" type="button" class="quitar der" value="Quitar" id="deizT">
                <br>
                <!--<input type="button" class="pasartodos izq" value=">> >>" id="izdeTAll">
                <input type="button" class="quitartodos der" value="<< <<" id="deizTAll">-->
            </div>
            <?= $select_problematica ?>
            <?= $select_problematica_vacia ?>
            <div class="col-md-2">
                <br><br>
                <input class="btn btn-block btn-warning" type="button" class="pasar izq" value="Agregar" id="izdeP" title="Derecha"><br>
                <input class="btn btn-block btn-danger" type="button" class="quitar der" value="Quitar" id="deizP">
            </div>
        </div>
    </div>
    </form>
    <!-- en form-->
</secction>
<script type="text/javascript">$().ready(function () {
        $('#izdeP').click(function () {
            return !$('#l_ProvFamiliar option:selected').remove().appendTo('#l_ProvFamiliarList');
        });
        $('#deizP').click(function () {
            return !$('#l_ProvFamiliarList option:selected').remove().appendTo('#l_ProvFamiliar');
        });
        $('#izdeT').click(function () {
            return !$('#l_Tipologias option:selected').remove().appendTo('#l_TipologiasList'), get_categorias();
        });
        $('#deizT').click(function () {
            return !$('#l_TipologiasList option:selected').remove().appendTo('#l_Tipologias'), get_categorias();
        });
    });
</script>

</div>