@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Páginas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li>
                <a href="{{ Route('pages.index') }}">Páginas</a>
            </li>
            <li class="active">Criar um nova página </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        <a href="javascript:savePageTemplate();" class="btn btn-primary btn-sm salvar">Salvar</a>
        <a href="{{ Route('pages.index') }}" class="btn btn-warning btn-sm">Voltar</a>
    </div>
</div>

@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                    data-toggle="tab">Conteúdo</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Detalhes</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <iframe id="iframe" name="iframe" frameborder="0" scrolling="auto"
                    src="{{ Route('page-template', ['template' => $file_route ]) }}"
                    style="width: 100%; min-height: 700px;"></iframe>

            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                {!! Form::open(['route' => 'pages.store', 'method'=>'POST', 'id'=>'form-page', 'name' => 'form-page']) !!}
                {!! Form::hidden('content', $file_route) !!}
                {!! Form::hidden('contents', null) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Título da página</label>
                            {!! Form::text('name', null, ['placeholder' => 'Título da página...','class' =>
                            'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class=""><span class="text-red">*</span> Status</label><br />
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" checked> Online
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0"> Offline
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Meta Title</label>
                            {!! Form::text('meta_title', null, ['placeholder' => 'Meta Title...','class' =>
                            'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Meta Description</label>
                            {!! Form::textarea('meta_description', null, ['placeholder' => 'Meta Description...','class'
                            => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- modal para títulos -->
@include('admin.pages.includes.form_titles')
<!-- formulário do tipo content -->
@include('admin.pages.includes.form_content')
<!-- formulário do tipo imagem -->
@include('admin.pages.includes.form_image')
<!-- 
    modal para gerenciador de imagens 
    ATENÇÃO JÁ EXISTE UM INCLUDE NO GERENCIADOR DE IAMGENS PARA FAZER ESSA INTERFACE, VERIFIQUE A REAL NECESSSIDADE DE UM NOVO MODAL NESTA PÁGINA                            
-->
<div id="modal-files" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="ibox">
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-md-8" id="OLFiles-list-dir">
                                    </div>
                                    <div class="col-md-4" id="OLFiles-form-folder">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="OLFiles-list-files" style="padding-top:15px;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" id="OLFiles-dropzone">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- picture sizes -->
{!! Form::hidden('route-picture', Route('page-picture')) !!}
<!-- picture sizes -->
@endsection
@push('style')
<!-- Adicional Styles -->
<style>
.file .file-name>p {
    width: 100%;
    height: 22px;
    overflow: hidden;
}

#list-dir {
    padding-top: 5px;
}

.file-box {
    float: left;
    width: 33.333333%;
}

.nav-tabs>li.active>a,
.nav-tabs>li.active>a:hover,
.nav-tabs>li.active>a:focus {
    background: #FFF;
}

.tab-pane {
    padding: 15px;
    background: #FFF;

}
</style>
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<link rel="stylesheet" href="{{ asset('assets/theme-admin/js/plugins/summernote/summernote.css') }}">
@endpush
@push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLFiles.jquery.js') }}"></script>
<!-- include summernote css/js -->
<script src="{{ asset('assets/theme-admin/js/plugins/summernote/summernote.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/summernote/lang/summernote-pt-BR.js') }}"></script>

<script>
/*callback do formulário*/
function pageCallback(a){
    window.location = a['edit_route'];
}
/*Ações antes de enviar o formulário*/
function savePageTemplate(){
    var contents = $('#iframe')[0].contentWindow.getAllValues();
    $("input[name=contents]").val(JSON.stringify(contents));
    $("form#form-page").submit();
}
$(document).ready(function() {
    /* Textarea */
    $content = $('#content_content');
    var content_config =  { 
        lang: 'pt-BR', 
        disableDragAndDrop: true,
        dialogsInBody: true,
        toolbar: [
            ['misc', ['undo', 'redo', 'codeview']],
            ['style', [ 'style', 'color', 'fontsize', 'bold', 'italic', 'underline', 'link', 'clear']], 
            ['para', ['table', 'paragraph', 'video']],    
        ]
    };
    $content.summernote(content_config);
    
    /*Evento para formulário de conteúdo*/
    $(document).on("click", "button[name=save_content]", function(e){
        e.preventDefault();
        var m = setMatrix('content', getMatrix('content'));
        $("#iframe")[0].contentWindow.setTypeElement(m['_id'], m, 'content');
        $("#modal-content").modal('hide');
    });
    /* Evento para o formulário de titulos */
    $(document).on("click", "button[name=save_title]", function(e){
        e.preventDefault();
        var m = setMatrix('title', getMatrix('title'));
        $("#iframe")[0].contentWindow.setTypeElement(m['_id'], m, 'title');
        $("#modal-title").modal('hide');
    });
    /*Evento para formulário de imagem ou picture*/
    $(document).on("click", "button[name=save_image]", function(e){
        e.preventDefault();
       
        //sizes
        if( $("input[name=image_type]").val() == 'picture')
        {
            sendPicture();
        }
        else
        {
            saveImage();
            
        }

        $("#modal-image").modal('hide');
        
    });


    function saveImage()
    {
        var m = setMatrix('image', getMatrix('image'));
        var original_type = $("input[name=image_type]").val();
        $("#iframe")[0].contentWindow.setTypeElement(m['_id'], m, original_type);
      
    }

    function savePicture(sources)
    {
        console.log("savePicture", sources);
        var m = setMatrix('image', getMatrix('image'));
        m['_sources'] = sources;
        var original_type = $("input[name=image_type]").val();
        $("#iframe")[0].contentWindow.setTypeElement(m['_id'], m, original_type);
       
    }


    function sendPicture()
    {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content") } });
        $.ajax({
            data: {'img' : $("input[name=image_content]").val()},
            method: 'POST',
            url: $("input[name=route-picture]").val(),
            success: function(exr) {
                console.log("Success", exr);
                savePicture(exr['data']);
            },
            error: function(exr, sender) {
                console.log("error", exr);
                savePicture([]);
            }
        });
    }


    /*Formulário*/
    $("#form-page").OLForm({
        btn: true,
        listErrorPosition: 'after',
        listErrorPositionBlock: '.page-heading'
    }, pageCallback);


    

    /* Gerenciador de imagens*/ 
    $("body").OLFiles({
        actionListFolders: "{{ Route('files-get-all') }}",
        actionCreateFolder: "{{ Route('create-folder') }}",
        actionOpenFile: changeImage,
        actionSendFile: "{{ Route('send-files') }}",
        initialFolder: "public/"
    });

    /*modal images*/
    $('#modal-files').on('hidden.bs.modal', function() {
        $('#modal-image').modal('show');
    });
    $(document).on("click", 'button[name="search-image"]', function() {
        $('#modal-image').modal('hide');
        setTimeout(function() {
            $("#modal-files").modal('show');
        }, 900);
    });
    /*Evento para corrigir bug de modal sobre modal*/
    $(document).on("show.bs.modal", '.modal', function (event) {
        var zIndex = 100000 + (10 * $(".modal:visible").length);
        $(this).css("z-index", zIndex);
        setTimeout(function () {
            $(".modal-backdrop").not(".modal-stack").first().css("z-index", zIndex - 1).addClass("modal-stack");
        }, 0);
    }).on("hidden.bs.modal", '.modal', function (event) {
        $(".modal:visible").length && $("body").addClass("modal-open");
    });


});

/*Alimenta o formulário do modal e exibe*/
function setValues(id, dados, name)
{
    var named = (name =='picture') ? 'image' : name;

    $("input[name="+named+"_id]").val(id);
    for(var key in dados){
        $(dados[key].type+"[name="+named+key+"]").val(dados[key].value);
    }

    if(name == 'picture' || name == 'image')
    {
        $("input[name=image_type]").val(name);
    }

    if(named == 'content'){
        $content.summernote('code', dados['_content'].value);
    }

    $("#modal-"+named).modal('show');
    
}
/*
*** Matrix padrão
*/
var matrix_simple = {
        _id : '',
        _content: { value: '', type: 'textarea' },
        _type : { value : 'div', type : ''},
        _css : { value : '', type : 'input' },
        _style : { value : '', type  : 'input' },
};
var matrix_complete = {
        _id : '',
        _content: {value:'', type:'input' },
        _type: {value:'', type:'select' },
        _css: {value:'', type:'input' },
        _style: {value:'', type:'input'},
        _link: {value:'', type:'input'},
        _link_target: {value:'', type:'select'}
};
var original_type = false;
/**
 * Retorna a matrix padrão de acordo com o tipo de conteúdo
 */  
function getMatrix(type)
{
    if(type == 'title' || type == 'image') {
        matrix = matrix_complete;
    }
    else if(type == 'content'){
        matrix = matrix_simple;
    }
    else if(type== 'picture')
    {
        matrix = matrix_complete;
    }

    return matrix;
}
/**
 * Alimenta uma matrix com os dados do fornulário
 */
function setMatrix(name, matrix)
{
    for(var key in matrix){
        matrix[key].value = $(matrix[key].type+"[name="+name+key+"]").val();
    }
    
    matrix['_id'] = $("input[name="+name+"_id]").val();

    if(name == 'content'){
        matrix['_content'].value = $content.summernote('code');;
    }

    return matrix;
}
/*Alterar a imagem*/
function changeImage(a){
    $("input[name=image_content]").val(a);
    $("#modal-files").modal('hide');
}
</script>
@endpush