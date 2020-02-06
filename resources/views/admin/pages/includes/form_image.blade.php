<div id="modal-image" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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
                                        <input type="text" name="image_content" class="form-control" id="image_content"
                                            placeholder="Sua imagem aqui!">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" name="search-image"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image_css" class="col-sm-2 control-label">Class CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="image_css" id="image_css"
                                        placeholder="Separe com espaços">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_style" class="col-sm-2 control-label">Style CSS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="image_style" name="image_style"
                                        placeholder="display:block; max-width:100%;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_link" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="image_link" name="image_link"
                                        placeholder="/home">
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