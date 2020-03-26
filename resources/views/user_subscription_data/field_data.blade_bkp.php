<div class="form-group">
<?php
$i = 1;
foreach ($office_field_data as $data) {
    $type = $data->field_type;
    $value_data = json_decode($data->field_input, true);
    ?>
    
    <?php if ($i == 3) { ?></div><div class="form-group"><?php $i = 1; } 
    switch ($type) {
        ?><?php
        case "text":
            ?>
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
                <input placeholder="Name" class="form-control" name="name" type="text" value="{{$value_data[$data->field_title]}}">
            </div>
            <?php
            break;
        case "singlefile":
            ?>
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
                <?php if(!empty($value_data[$data->field_title])) {?>
                <a href="http://localhost/Bankacfo_final/public/help/{{$value_data[$data->field_title]}}" target="_blank" class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$value_data[$data->field_title]}}</a>
            <?php } else {echo "No File Uploaded"; } ?>
            </div>
            <?php
            break;
        case "logtext":
            ?>
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
                <textarea class="form-control" rows="3" placeholder="Enter Address..." name="sup_address" id="sup_address" style="resize: vertical; max-width: 400px; min-width: 200px;" spellcheck="false">{{$value_data[$data->field_title]}}</textarea> 
            </div> 
            <?php
            break;
        case "multiplefile":
            ?>
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
                <?php
                $file_data = explode(",", $value_data[$data->field_title]);
                foreach ($file_data as $f) {
                    if ($f != "") {
                        ?>
                        <a href="http://localhost/Bankacfo_final/public/help/{{$f}}" target="_blank" class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$f}}</a>
                        <br/>
                        <br/>
                        <?php
                    }else{
                        echo "No File Uploaded";
                    }
                }
                ?>
            </div>
            <?php
            break;
    }
    $i++;
}
?>