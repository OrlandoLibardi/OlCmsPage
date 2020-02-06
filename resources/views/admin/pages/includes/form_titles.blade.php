<div id="modal-title" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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
                                    <input type="text" name="title_content" class="form-control" id="content"
                                        placeholder="Digite aqui seu texto...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">Tipo</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="title_type" id="type"
                                        placeholder="Selecione o tipo">
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
                                    <input type="text" class="form-control" name="title_css" id="css"
                                        placeholder="Separe com espaços">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="style" class="col-sm-2 control-label">Style CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="style" name="title_style"
                                        placeholder="font-size:12px; line-height:21px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link" name="title_link"
                                        placeholder="/home">
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