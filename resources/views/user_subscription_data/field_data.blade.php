<!--<div class="form-group">-->
<div class="box-header" style="text-align: center;">
    <h3 class="box-title"><b>Client Form Data</b></h3>
</div>
<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
       <label for="userName" class="control-label">User Input</label>
    </div>
    <div class="col-sm-2">
        <label for="userName" class="control-label">Is Approved</label>
    </div>
    <div class="col-sm-4">
        <label for="userName" class="col-sm-2 control-label">Remark</label>
    </div>
</div>
<?php
$i = 1;
foreach ($client_field_data as $data) {
    $type = $data->field_type;
    $value_data = json_decode($data->field_input, true);
    ?>
    
    <?php // if ($i == 3) { ?>
<!--</div><div class="form-group">-->
    <?php // $i = 1; } 
    switch ($type) {
        ?><?php
        case "text":
            ?>
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <input placeholder="{{$data->field_title}}" class="form-control" type="text" value="{{$value_data[$data->field_title]}}" disabled="">
                </div>
                <div class="col-sm-2 form-group">
                    <label class="">
                        <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="1" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 1) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         Yes
                    </label>
                    <label class="">
                        <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve']" value="0" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 0) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         No
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="client_form[{{$data->id}}][comment]" value="{{$data->comment}}">
                </div>
            </div>
            <?php
            break;
        case "number":
            ?>
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <input placeholder="{{$data->field_title}}" class="form-control" type="number" value="{{$value_data[$data->field_title]}}" disabled="">
                </div>
                <div class="col-sm-2 form-group">
                    <label class="">
                        <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="1" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 1) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         Yes
                    </label>
                    <label class="">
                        <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="0" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 0) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         No
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="client_form[{{$data->id}}][comment]" value="{{$data->comment}}">
                </div>
            </div>
            <?php
            break;
        case "dropdown":
            ?>
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <input placeholder="{{$data->field_title}}" class="form-control" type="text" value="{{$value_data[$data->field_title]}}" disabled="">
                </div>
                <div class="col-sm-2 form-group">
                    <label class="">
                        <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="1" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 1) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         Yes
                    </label>
                    <label class="">
                        <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="0" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 0) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         No
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="client_form[{{$data->id}}][comment]" value="{{$data->comment}}">
                </div>
            </div>
            <?php
            break;
        case "singlefile":
            ?>
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <?php if(!empty($value_data[$data->field_title])) {?>
                    <a href="http://localhost/bankacfo_backend/public/help/{{$value_data[$data->field_title]}}"  class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$value_data[$data->field_title]}}</a>
                <?php } else { ?>No file uploaded<?php } ?>
                </div>
                <div class="col-sm-2 form-group">
                    <label class="">
                        <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="1" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 1) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         Yes
                    </label>
                    <label class="">
                        <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="0" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 0) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         No
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="client_form[{{$data->id}}][comment]" value="{{$data->comment}}">
                </div>
            </div>
            <?php
            break;
        case "logtext":
            ?>
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="3" placeholder="{{$data->field_title}}" name="sup_address" id="sup_address" style="resize: vertical; max-width: 400px; min-width: 200px;" spellcheck="false" disabled="">{{$value_data[$data->field_title]}}</textarea> 
                </div> 
                <div class="col-sm-2 form-group">
                    <label class="">
                        <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="1" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 1) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         Yes
                    </label>
                    <label class="">
                        <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="0" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 0) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         No
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="client_form[{{$data->id}}][comment]" value="{{$data->comment}}">
                </div>
            </div>
            <?php
            break;
        case "multiplefile":
            ?>
            <div class="form-group">
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
                <?php
                $file_data = explode(",", $value_data[$data->field_title]);
                foreach ($file_data as $f) {
                    if ($f != "") {
                        ?>
                        <a href="http://localhost/bankacfo_backend/public/help/{{$f}}" target="_blank" class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$f}}</a>
                        <br/>
                        <br/>
                        <?php
                    }else{
                        echo "No File Uploaded";
                    }
                }
                ?>
            </div>
            <div class="col-sm-2 form-group">
                    <label class="">
                        <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="1" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 1) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         Yes
                    </label>
                    <label class="">
                        <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                            <input type="radio" name="client_form[{{$data->id}}][is_approve]" value="0" class="minimal" style="position: absolute; opacity: 0;" <?php if($data->is_approved == 0) echo "checked"; ?>>
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                         No
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="client_form[{{$data->id}}][comment]" value="{{$data->comment}}">
                </div>
            </div>
            <?php
            break;
    }
//    $i++;
}
?>
    <div class="box-header" style="text-align: center;">
        <h3 class="box-title"><b>Office Form Data</b></h3>
            </div>
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
                    <input placeholder="{{$data->field_title}}" class="form-control" name="office_form[{{$data->id}}]" type="text" value="{{$value_data[$data->field_title]}}">
                </div>
                
            <?php
            break;
         case "number":
            ?>
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <input placeholder="{{$data->field_title}}" class="form-control" type="number" name="office_form[{{$data->id}}]" value="{{$value_data[$data->field_title]}}">
                </div>
            <?php
            break;
        case "dropdown":
            ?>
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <select class="form-control select2" name="office_form[{{$data->id}}]">
                        <?php if(isset($data->field_extras)) { $drop_data = json_decode($data->field_extras,true); ?><?php } ?>
                        @foreach($drop_data as $row)
                        <option value="{{$row}}">{{$row}}</option>
                        @endforeach
                    </select>
                </div>
            <?php
            break;
        case "singlefile":
            ?>
            
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-2">
                    <input type="file" class="form-control" name="office_form[{{$data->id}}]" />
                </div>
                <div class="col-sm-2">
                <?php if(!empty($value_data[$data->field_title])) {?>
                    <a href="office_img/{{$value_data[$data->field_title]}}"  class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$value_data[$data->field_title]}}</a>
                <?php } else { ?>No file uploaded<?php } ?>
                </div>
            <?php
            break;
            case "logtext":
            ?>
                <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="3" placeholder="{{$data->field_title}}" name="office_form[{{$data->id}}]" id="sup_address" style="resize: vertical; max-width: 400px; min-width: 200px;" spellcheck="false">{{$value_data[$data->field_title]}}</textarea> 
                </div> 
               
            <?php
            break;
            case "multiplefile":
            ?>
            
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-2">
                <input type="file" class="form-control" name="office_form[{{$data->id}}][]" multiple=""/>
            </div>
            <div class="col-sm-2">
                <?php
                $file_data = explode(",", $value_data[$data->field_title]);
                foreach ($file_data as $f) {
                    if ($f != "") {
                        ?>
                        <a href="office_img/{{$f}}" target="_blank" class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$f}}</a>
                        <br/>
                        <br/>
                        <?php } } ?>
            </div>
            <?php
            break;
    }
    $i++;
}
?>
 </div>
<div class="box-footer">
    <button type="submit"  id="btnsubmit" class="btn btn-success">Submit</button>
    <a href="{{route('roles.index')}}" class="btn btn-danger" >Cancel</a>
</div>           
<!--    <table id="example1" class="table table-bordered table-striped" border="1">
        <thead>
        <tr>
            <td>Label</td>
            <td>User Input</td>
            <td>Approve status</td>
            <td>Comment</td>
        </tr>
        </thead>-->
<?php
//$i = 1;
//foreach ($office_field_data as $data) { 
//    $value_data = json_decode($data->field_input, true);?>
<!--        <tr>
            <td>{{$data->field_title}}</td>
            <td>{{$value_data[$data->field_title]}}</td>
            <td>
                <select>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </td>
            <td>
                <textarea></textarea>
            </td>
        </tr>-->
    
    
<?php     
//} 
?>
    <!--</table>-->
