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
            <li class="active">Editar um nova página </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        <a href="javascript:savePageTemplate();" class="btn btn-primary btn-sm salvar">Salvar</a>
        <a href="{{ Route('pages.index') }}" class="btn btn-warning btn-sm">Voltar</a>
    </div>
</div>

@endsection @section('content')
<div class="row">
    <!-- iframe -->
    <div class="col-md-9">
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="height: 700px">
                <iframe id="iframe" name="iframe" frameborder="0" scrolling="auto" src="{{ Route('page-template', ['template' => $file_route ]) }}" style="width: 100%; height: 100%;"></iframe>
            </div>
        </div>
    </div>
    <!-- detalhes da página -->
    <div class="col-md-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Detalhes da página</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    {!! Form::open(['route' => ['pages.update', 'id' => $page->id], 'method'=>'PUT', 'id'=>'form-page', 'name' => 'form-page']) !!}
                    
                    
                    {!! Form::hidden('content', $file_route) !!}
                    {!! Form::hidden('contents', null) !!}
                    {!! Form::hidden('alias', $page->alias) !!}

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Título da página</label>
                            {!! Form::text('name', $page->name, ['placeholder' => 'Título da página...','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class=""><span class="text-red">*</span> Status</label><br />
                            <label class="radio-inline">
                              <input type="radio" name="status" value="1" @if($page->status==1) checked @endif> Online
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="status" value="0" @if($page->status==0) checked @endif> Offline
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Meta Title</label>
                            {!! Form::text('meta_title', $page->meta_title, ['placeholder' => 'Meta Title...','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Meta Description</label>
                            {!! Form::textarea('meta_description', $page->meta_description, ['placeholder' => 'Meta Description...','class' => 'form-control']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
</div>
<!-- modal para títulos -->
<div id="modal-title" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Títulos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" name="form_title">
                            <input type="hidden" name="title_id">
                            <div class="form-group">
                                <label for="content" class="col-sm-2 control-label">Texto</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title_content" class="form-control" id="content" placeholder="Digite aqui seu texto...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">Tipo</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="title_type" id="type" placeholder="Selecione o tipo">
                                        <option value="h1">H1</option>
                                        <option value="h2">H2</option>
                                        <option value="h3">H3</option>
                                        <option value="h4">H4</option>
                                        <option value="h5">H5</option>
                                        <option value="h6">H6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="css" class="col-sm-2 control-label">Class CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title_css" id="css" placeholder="Separe com espaços">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="style" class="col-sm-2 control-label">Style CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="style" name="title_style" placeholder="font-size:12px; line-height:21px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link" name="title_link" placeholder="/home">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link_target" class="col-sm-2 control-label">Link Target</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="link_taget" name="title_link_target">
                                        <option value="">--Selecione--</option>
                                        <option value="_blank">Nova guia</option>
                                        <option value="_self">Mesma guia</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" name="save_title">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- formulário do tipo content -->
<div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Conteúdos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" name="form_content">
                            <input type="hidden" name="content_id">
                            <input type="hidden" name="content_type">
                            <div class="form-group">
                                <label for="content_content" class="col-sm-2 control-label">Conteúdo</label>
                                <div class="col-sm-10">
                                    <textarea name="content_content" class="form-control" id="content_content" placeholder="Digite aqui seu texto..."></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content_css" class="col-sm-2 control-label">Class CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="content_css" id="content_css" placeholder="Separe com espaços">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content_style" class="col-sm-2 control-label">Style CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="content_style" name="content_style" placeholder="font-size:12px; line-height:21px;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" name="save_content">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- formulário do tipo imagem -->
<div id="modal-image" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Imagem</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" name="form_content">
                            <input type="hidden" name="image_id">
                            <input type="hidden" name="image_type">
                            <div class="form-group">
                                <label for="image_content" class="col-sm-2 control-label">Imagem</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="image_content" class="form-control" id="image_content" placeholder="Sua imagem aqui!">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" name="search-image"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image_css" class="col-sm-2 control-label">Class CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="image_css" id="image_css" placeholder="Separe com espaços">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_style" class="col-sm-2 control-label">Style CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="image_style" name="image_style" placeholder="display:block; max-width:100%;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_link" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="image_link" name="image_link" placeholder="/home">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_link_target" class="col-sm-2 control-label">Link Target</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="image_link_target" name="image_link_target">
                                        <option value="">--Selecione--</option>
                                        <option value="_blank">Nova guia</option>
                                        <option value="_self">Mesma guia</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" name="save_image">Salvar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- modal para gerenciador de imagens -->
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
                            <div class="row" >
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

@endsection
@push('style')
<!-- Adicional Styles -->
<style>
.file .file-name > p {
    width: 100%;
    height: 22px;
    overflow: hidden;
}
#list-dir{
    padding-top: 5px;
}
.file-box {
    float: left;
    width: 33.333333%;
}
</style>
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLFiles.jquery.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/pages.js')}}"></script>
<script>
$(document).ready(function(){
    /*Formulário*/
    $("#form-page").OLForm({btn : true, listErrorPosition: 'after', listErrorPositionBlock: '.page-heading'}, pageCallback);
    /*Gerenciador de imagens*/
    $("body").OLFiles({
        actionListFolders : "{{ Route('files-get-all') }}",
        actionCreateFolder : "{{ Route('create-folder') }}",
        actionOpenFile : changeImage,
        actionSendFile : "{{ Route('send-files') }}",
        initialFolder : "public/"
    });
    /*modal images*/
    $('#modal-files').on('hidden.bs.modal', function () {
        $('#modal-image').modal('show');
    });
    $(document).on("click", 'button[name="search-image"]', function(){
        $('#modal-image').modal('hide');
        setTimeout(function(){
            $("#modal-files").modal('show');
        }, 900);
    });

});
</script>
@endpush
