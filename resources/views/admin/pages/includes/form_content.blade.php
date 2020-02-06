<div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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
                                    <textarea name="content_content" class="form-control" id="content_content"
                                        placeholder="Digite aqui seu texto..."></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content_css" class="col-sm-2 control-label">Class CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="content_css" id="content_css"
                                        placeholder="Separe com espaços">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content_style" class="col-sm-2 control-label">Style CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="content_style" name="content_style"
                                        placeholder="font-size:12px; line-height:21px;">
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