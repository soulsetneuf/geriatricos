
<div class="col-md-<?= $tamanoSelect ?>">
    <!--   <div class="box box-primary">  -->

        <?php
        $arrLista=array();
        foreach($arrSelect->result() as $value)
        {
            $arrLista[$value->id]=$value->nombre;
        }
        $arrAtributosSelect=array(
            "name"=>$nombreSelect,
            "class"=>"form-control",
            "multiple"=>"multiple",
            "size"=>"10",
            "id"=>$idSelect
        );

        $arrAtributosLabel=array(
            "name"=>$nombreSelect,
            "class"=>"form-control",
            "multiple"=>"multiple",
            "size"=>"10"
        );
        ?>
        <div class="box-header">
            <h3 class="box-title">
            <?php echo form_label($nombreLabel); ?>
            </h3>
        </div>
        <?php
        echo form_dropdown($arrAtributosSelect, $arrLista);
        ?>
    <!--  </div> -->
</div>