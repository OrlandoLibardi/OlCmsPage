@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Páginas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li class="active">Páginas </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        @can('create')
        <a href="javascript:;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-pages">Nova Página</a>
        @else
        <a href="javascript:;" class="btn btn-success btn-sm disabled alert-action">Nova Página</a>
        @endcan
    </div>
</div>

@endsection @section('content')

<div class="row">
    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Paginas cadastradas</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="results">
                            <thead>
                                <tr>
                                    <td width="10"><input type="checkbox" name="excludeAll"></td>
                                    <td>Título da página</td>
                                    <td width="200">URL</td>
                                    <td width="150">Criado em:</td>
                                    <td width="150">Atualizado em:</td>
                                    <td width="50">Visualizar</td>
                                    <td width="50">Status</td>

                                    <td width="50">Editar</td>
                                </tr>
                            </thead>
                            <tbody>
                                @can('edit')
                                @foreach ($data as $key=>$page)
                                    <tr>
                                        <td><input type="checkbox" name="exclude" value="{{ $page->id }}"> </td>
                                        <td>{{ $page->name }}</td>
                                        <td>{{ $page->alias }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td>{{ $page->updated_at }}</td>
                                        <td class="text-center"><a href="{{ Route('pages.show', ['id' => $page->id ]) }}" target="_view" class="btn btn-info btn-sm"><i class="fa fa-share" aria-hidden="true"></i></a></td>
                                        <td class="text-center">
                                            @include('admin.includes.btn_status', ['id' => $page->id, 'status' => $page->status])
                                        </td>
                                        <td class="text-center">
                                            @include('admin.includes.btn_edit', ['route' => route('pages.edit', ['id' => $page->id])])
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                @foreach ($data as $key=>$page)
                                    <tr>
                                        <td><input type="checkbox" name="exclude" value="{{ $page->id }}"> </td>
                                        <td>{{ $page->name }}</td>
                                        <td>{{ $page->alias }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td>{{ $page->updated_at }}</td>
                                        <td class="text-center"><a href="{{ Route('pages.show', ['id' => $page->id ]) }}" target="_view" class="btn btn-info btn-sm"><i class="fa fa-share" aria-hidden="true"></i></a></td>
                                        <td class="text-center">
                                            @include('admin.includes.btn_status_disabled', ['id' => $page->id, 'status' => $page->status])
                                        </td>
                                        <td class="text-center">
                                            @include('admin.includes.btn_edit_disabled', ['route' => route('pages.edit', ['id' => $page->id])])
                                        </td>
                                    </tr>
                                @endforeach
                                @endcan
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<div id="modal-pages" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione um modelo de arquivo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                            {!! Form::open(['route' => 'create-temp-file', 'method'=>'POST', 'id'=>'templates', 'name' => 'form-template', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                <label for="template" class="col-sm-3 control-label">Arquivo base</label>
                                <div class="col-sm-9">
                                    {!! Form::select('template', $files, null, ['class' => 'form-control', 'placeholder' => '--Selecione--']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    {!! Form::submit('Enviar', ['class' => "btn btn-sm btn-primary"]) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection
@push('style')
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>
$("#templates").OLForm({listErrorPosition: 'after', listErrorPositionBlock: '.modal-header', btn : true}, locationIn);
function locationIn(a){ window.location = "{{ Route('pages.create') }}?file_route="+a.url; }
/*Exclude*/
$("#results").OLExclude({'action' : "/admin/pages/destroy/", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});

$(document).on("click", "a.btn-status:not(.disabled)", function(){
    var $this = $(this),
    _url  = '/admin/pages/status/',
    _id = $this.attr("data-id"),
    _status = $this.attr("data-status");
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content") } });
    $.ajax({
        data: {'id' : _id, 'status' : _status},
        method: 'PUT',
        url: _url,
        beforeSend: function() {
            $this.addClass("disabled");
        },
        success: function(exr) {
            toggleStatus($this, _status);
        },
        error: function(exr, sender) {
            console.log(exr);

        },
        complete: function() {
            //$this.removeClass("disabled");
        },
    });
});

function toggleStatus($this, status){
    if(status == 1){
        $this.attr("class", "btn btn-default btn-sm btn-status")
             .attr("data-status", 0)
             .attr("title", "Colocar Online?");
    }else{
        $this.attr("class", "btn btn-primary btn-sm btn-status")
             .attr("data-status", 1)
             .attr("title", "Colocar Offline?");
    }
}

</script>

@endpush
