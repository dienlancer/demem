@extends("admin.master")
@section("content")
<?php 
$linkCancel             =   route('admin.'.$controller.'.getList');
$linkSave               =   route('admin.'.$controller.'.save');
$linkUploadFile         =   route('admin.'.$controller.'.uploadFile');
$linkCreateAlias         =   route('admin.'.$controller.'.createAlias');
$inputFullName          =   '<input type="text" class="form-control" name="fullname"   id="fullname"  onblur="createAlias(this)"     value="'.@$arrRowData['fullname'].'">'; 
$inputAlias             =   '<input type="text" class="form-control" name="alias"      id="alias"          value="'.@$arrRowData['alias'].'">';
$inputTitle             =   '<textarea id="title" name="title" rows="2" cols="100" class="form-control" >'.@$arrRowData['title'].'</textarea>'; 
$inputMetakeyword             =   '<textarea id="meta_keyword" name="meta_keyword" rows="2" cols="100" class="form-control" >'.@$arrRowData['meta_keyword'].'</textarea>'; 
$inputMetadescription             =   '<textarea id="meta_description" name="meta_description" rows="2" cols="100" class="form-control" >'.@$arrRowData['meta_description'].'</textarea>'; 
$inputSortOrder         =   '<input type="text" class="form-control" name="sort_order" id="sort_order"     value="'.@$arrRowData['sort_order'].'">';
$status                 =   (count($arrRowData) > 0) ? @$arrRowData['status'] : 1 ;
$arrStatus              =   array(-1 => '- Select status -', 1 => 'Publish', 0 => 'Unpublish');  
$ddlStatus              =   cmsSelectbox("status","status","form-control",$arrStatus,$status,"");
$parent_id              =   (count($arrRowData) > 0) ? @$arrRowData['parent_id'] : null ; 
$ddlCategoryArticle     =   cmsSelectboxCategory('category_article_id','category_article_id', 'form-control', $arrCategoryArticleRecursive, $parent_id,"");
$id                     =   (count($arrRowData) > 0) ? @$arrRowData['id'] : "" ;
$inputID                =   '<input type="hidden" name="id" id="id" value="'.@$id.'" />'; 
$picture                =   "";
$strImage               =   "";
$setting= getSettingSystem();
if(count($arrRowData > 0)){
    if(!empty(@$arrRowData["image"])){
        $picture        =   '<div class="col-sm-6"><center>&nbsp;<img src="'.url("/upload/".@$arrRowData["image"]).'" style="width:100%" />&nbsp;</center></div><div class="col-sm-6"><a href="javascript:void(0);" onclick="deleteImage();"><img src="'.url('public/admin/images/delete-icon.png').'"/></a></div>';                        
        $strImage       =   @$arrRowData["image"];
    }        
}    
$inputPictureHidden     =   '<input type="hidden" name="image_hidden" id="image_hidden" value="'.@$strImage.'" />';
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="{{$icon}}"></i>
            <span class="caption-subject font-dark sbold uppercase">{{$title}}</span>
        </div>
        <div class="actions">
           <div class="table-toolbar">
            <div class="row">
                <div class="col-md-12">
                    <button onclick="save()" class="btn purple">Lưu <i class="fa fa-floppy-o"></i></button> 
                    <a href="<?php echo $linkCancel; ?>" class="btn green">Thoát <i class="fa fa-ban"></i></a>                    </div>                                                
                </div>
            </div>    
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal" role="form" name="frm" enctype="multipart/form-data">
            {{ csrf_field() }}          
                <?php echo $inputPictureHidden; ?>                
                <?php echo  $inputID; ?>         
            <div class="form-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Chủ đề</b></label>
                        <div class="col-md-10">
                            <?php echo $inputFullName; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>                       
                </div>      
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Alias</b></label>
                        <div class="col-md-10">
                            <?php echo $inputAlias; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Chủ đề cha</b></label>
                        <div class="col-md-10">
                            <?php echo $ddlCategoryArticle; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                      
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Hình</b></label>
                        <div class="col-md-10">
                            <input type="file" id="image" name="image"  />   
                            <div id="picture-area"><?php echo $picture; ?>                      </div>                            
                        </div>
                    </div>   
                </div>                       
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Tiêu đề</b></label>
                        <div class="col-md-10">
                            <?php echo $inputTitle; ?>
                            <span class="help-block"></span>
                        </div>
                    </div> 
                </div>
                <div class="row">  
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Meta keyword</b></label>
                        <div class="col-md-10">
                            <?php echo $inputMetakeyword; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>     
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Meta description</b></label>
                        <div class="col-md-10">                            
                            <?php echo $inputMetadescription; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Sắp xếp</b></label>
                        <div class="col-md-10">
                            <?php echo $inputSortOrder; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>     
                </div>       
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label"><b>Trạng thái</b></label>
                        <div class="col-md-10">                            
                            <?php echo $ddlStatus; ?>
                            <span class="help-block"></span>
                        </div>
                    </div>   
                </div>                                                                 
            </div>                          
        </form>
    </div>
</div>
<script type="text/javascript" language="javascript">
    function resetErrorStatus(){
        var id                   =   $("#id");
        var fullname             =   $("#fullname");
        var alias                =   $("#alias");
        var category_article_id  =   $("#category_article_id");
        var sort_order           =   $("#sort_order");
        var status               =   $("#status");
        
        $(fullname).closest('.form-group').removeClass("has-error");
        $(alias).closest('.form-group').removeClass("has-error");
        $(category_article_id).closest('.form-group').removeClass("has-error");
        $(sort_order).closest('.form-group').removeClass("has-error");
        $(status).closest('.form-group').removeClass("has-error");        

        $(fullname).closest('.form-group').find('span').empty().hide();
        $(alias).closest('.form-group').find('span').empty().hide();
        $(category_article_id).closest('.form-group').find('span').empty().hide();
        $(sort_order).closest('.form-group').find('span').empty().hide();
        $(status).closest('.form-group').find('span').empty().hide();        
    }

    function uploadFileImport(){    
        var token = $('input[name="_token"]').val();       
        var image=$("#image");        
        var file_upload=$(image).get(0);
        var files = file_upload.files;
        var file  = files[0];    
        var formdata = new FormData();
        formdata.append("image", file);
        formdata.append("_token", token);
        var ajax = new XMLHttpRequest();        
        ajax.addEventListener("load",  false);        
        ajax.open("POST", "<?php echo $linkUploadFile; ?>");
        ajax.send(formdata);    
    }
    function deleteImage(){
        var xac_nhan = 0;
        var msg="Bạn có muốn xóa ?";
        if(window.confirm(msg)){ 
            xac_nhan = 1;
        }
        if(xac_nhan  == 0){
            return 0;
        }
        $("#picture-area").empty();
        $("input[name='image_hidden']").val("");        
    }
    function save(){
        var id=$("#id").val();        
        var fullname=$("#fullname").val();
        var alias=$("#alias").val();
        var title=$("#title").val();
        var meta_keyword=$("#meta_keyword").val();
        var meta_description=$("#meta_description").val();
        var category_article_id=$("#category_article_id").val();
        var image = $("#image").val();
        if (image != '')
            image = image.substr(image.lastIndexOf('\\') + 1);       
        var image_hidden=$("#image_hidden").val(); 
        var sort_order=$("#sort_order").val();
        var status=$("#status").val();     
        var token = $('input[name="_token"]').val();   
        resetErrorStatus();
        var dataItem={
            "id":id,
            "fullname":fullname,
            "alias":alias,
            "title":title,
            "meta_keyword":meta_keyword,
            "meta_description":meta_description,
            "category_article_id":category_article_id,
            "image":image,
            "image_hidden":image_hidden,
            "sort_order":sort_order,
            "status":status,
            "_token": token
        };
        $.ajax({
            url: '<?php echo $linkSave; ?>',
            type: 'POST',
            data: dataItem,
            
            async: false,
            success: function (data) {
                if(data.checked==true){
                    uploadFileImport();
                    window.location.href = "<?php echo $linkCancel; ?>";
                }else{
                    var data_error=data.error;
                    if(typeof data_error.fullname               != "undefined"){
                        $("#fullname").closest('.form-group').addClass(data_error.fullname.type_msg);
                        $("#fullname").closest('.form-group').find('span').text(data_error.fullname.msg);
                        $("#fullname").closest('.form-group').find('span').show();                        
                    }
                    if(typeof data_error.alias                  != "undefined"){
                        $("#alias").closest('.form-group').addClass(data_error.alias.type_msg);
                        $("#alias").closest('.form-group').find('span').text(data_error.alias.msg);
                        $("#alias").closest('.form-group').find('span').show();                       
                    }
                    if(typeof data_error.sort_order               != "undefined"){
                        $("#sort_order").closest('.form-group').addClass(data_error.sort_order.type_msg);
                        $("#sort_order").closest('.form-group').find('span').text(data_error.sort_order.msg);
                        $("#sort_order").closest('.form-group').find('span').show();                        
                    }
                    if(typeof data_error.status               != "undefined"){
                        $("#status").closest('.form-group').addClass(data_error.status.type_msg);
                        $("#status").closest('.form-group').find('span').text(data_error.status.msg);
                        $("#status").closest('.form-group').find('span').show();

                    }                    
                }
                spinner.hide();
            },
            error : function (data){
                spinner.hide();
            },
            beforeSend  : function(jqXHR,setting){
                spinner.show();
            },
        });
    }
    function createAlias(ctrl){
        var fullname    = $(ctrl).val();
        var token       = $('form[name="frm"] > input[name="_token"]').val();     
        var dataItem={            
            "fullname":fullname,            
            "_token": token
        };        
        $.ajax({
            url: '<?php echo $linkCreateAlias; ?>',
            type: 'POST',
            data: dataItem,            
            async: false,
            success: function (data) {
                /*if(data.checked==false){
                    var data_error=data.error;                    
                    if(typeof data_error.alias                  != "undefined"){
                        $("#alias").closest('.form-group').addClass(data_error.alias.type_msg);
                        $("#alias").closest('.form-group').find('span').text(data_error.alias.msg);
                        $("#alias").closest('.form-group').find('span').show();                       
                    }                                
                }*/
                //console.log(data);
                spinner.hide();
            },
            error : function (data){
                spinner.hide();
            },
            beforeSend  : function(jqXHR,setting){
                spinner.show();
            },
        });
    }
</script>
@endsection()            