/* Exibe o erro e anula o restante do código*/
    if (typeof jQuery === 'undefined') {
        throw new Error('OLTemplates JavaScript requires jQuery 3.1 >');
        alert("ERROR: OLTemplates JavaScript requires jQuery 3.1 >");
    }
    /* 
    * Finaliza a navegação no template
    */
    $(document).on("click", "a, button:not(.btn-template)", function (e) {
        e.preventDefault();
    });
    /*
    * Remover a visibilidade da body até que os novos elementos estejam prontos
    */
    $("body").css("opacity", 0);
    /*
    * Acompanhamento para os eventos mouseenter e mouseleave não gerem sobrecarga
    */
    window.closeActions = false;
    /*
    * document Ready
    */
    $(document).ready(function(){
        //init
        setTimeout(function(){        
            $("body").css("opacity", 1);
            //initTemplate();
            //Criar botões
            initTemplate();
        }, 1000);
        /*
        * Evento clique no botão editar
        */
        $(document).on("click", "button[name=edit_title], button[name=edit_content], button[name=edit_image], button[name=edit_picture]", function () {
            console.log('Editar: ' + $(this).attr("data-target"));
            /* Comunicar a página parente  */
            //identifyObject($("*[data-id=" + $(this).attr("data-target") + "]"));
            var type = $(this).attr("data-type");
            var id = $(this).attr("data-target");
            var tipo_matrix = getMatrix(type);
            var dados       = setMatrix($("*[data-id=" + id + "]"), type, tipo_matrix);
            console.log('matrix', dados);
            window.parent.setValues(id, dados, type);
        });
        /*
        * Evento clique no botão excluir
        */
        $(document).on("click", "button[name=delete_title], button[name=delete_content], button[name=delete_image], button[name=delete_picture]", function () {
            console.log('Remover: ' + $(this).attr("data-target"));
            $("*[data-id=" + $(this).attr("data-target") + "]").remove();
        });
        /*
        * Exibir os botões de ações
        */
        $(document).on('mouseenter', ".object-editable", function(e){
            /*Somente se a action for igual a false*/
            if(window.closeActions==false) {
                //Mudar o valor da ação para não gerar um novo evento
                window.closeActions=true;
                //Armazenar valores do objeto ativo
                var _id     = $(this).attr("data-id"), 
                    _width  = $(this).outerWidth(),
                    _height = $(this).outerHeight(),
                    _type   = $(this).attr("data-type"),
                    _left   = $(this).offset().left + (_width/2); 
                    _top    = $(this).offset().top; 
                //somente para imagens e pictures
                if(_type == 'image' || _type == 'picture'){
                    _top = _top - (_height/2);                        
                }    
                //posicionar botões
                positionButton(0, 0, _type, _id);                        
            }
        }); 
        /*
        * Esconder botões após o mouse deixar o objeto editável
        */
        $(document).on('mouseleave', ".object-editable", function(){
                /*Somente se a action for igual a true*/
            if(window.closeActions==true){
                $(".ol-btn-group").fadeOut(300);
                window.closeActions=false;  
            }                
        }); 
    });
    /*
    * Inicia os objetos que compõe um template
    */
    function initTemplate()
    {
        //Procura os objetos e transforma em novos objetos editáveis
        $(document).find("*[data-editable='true']").each(function(){ 
            var $t = $(this);                
            //obj = replaces($t);
            obj = $t[0].outerHTML;
            replaceElementHref($t, obj);           
        });
        //Criar botões
        createButtons();            
    } 

    function replaceElementHref(t, html)
    {
        var obj_parent = t.parent(), 
            obj_parent_type = obj_parent[0].nodeName;

        if(obj_parent_type == 'A')
        {
            obj_parent.before(html);
            obj_parent.remove();

        } else {
            console.log('parent não href');
            t[0].outerHTML = html;
        }
            
    }
    /*
    * Transforma um objeto marcado em um item editável
    */
    function replaces(obj)
    {
        var type = obj[0].nodeName, 
            data = atributesList(type), 
            result =  atributesElement(data, obj), 
            fake_type = normalizeType(obj[0].nodeName),
            obj_parent = obj.parent(), 
            obj_parent_type = obj_parent[0].nodeName
            temp = '';   

        temp += '<span class="object-editable" data-editable="true" ';  
        temp += 'data-type="'+fake_type+'" ';
        temp += 'data-id="' + obj.attr('data-id') + '" >';

        
        if(obj_parent_type == 'A'){
           temp += '<a href="'+obj_parent.attr("href")+'"';
           if(obj_parent.attr("target")!=undefined){
            temp +=  'target="'+obj_parent.attr("target") +'"';
           }
           temp += '>';
                              
        }
        
        switch ( type ) {
            case 'PICTURE':
                temp += '<picture data-edit="true" data-id="'+obj.attr('data-id')+'" '+ getAtributes(result) +'>'+ obj.html() +' </picture>';
            break;
            case 'H1':
            case 'H2':
            case 'H3':
            case 'H4':
            case 'H5':
            case 'H6':
            case 'DIV':
                temp += '<'+obj[0].nodeName.toLowerCase()+' '+ getAtributes(result) + ' data-edit="true" data-id="'+obj.attr('data-id')+'">'+obj.html()+'</'+obj[0].nodeName.toLowerCase()+'>';
            break;
            case 'IMG':
                temp += '<img data-edit="true" data-id="'+obj.attr('data-id')+'" '+ getAtributes(result) +' />';
            break;                
        }

        if(obj_parent_type == 'A'){
            temp += '</a>';            
         }
         return temp;
    }
    /*
    * Adapta os typos de objetos para a forma do template
    */
    function normalizeType(type)
    {
        var new_type = "";

        switch ( type ) {
            case 'PICTURE':
                new_type = type;
            break;
            case 'H1':
            case 'H2':
            case 'H3':
            case 'H4':
            case 'H5':
            case 'H6':
                new_type = "title";
            break;
            case 'DIV':
                new_type = "content";
            break;
            case 'IMG':
                new_type = "image";
            break;
        }

        return new_type.toLowerCase();
    }
    /*
    * Retorna os atributos do objeto em formato de texto
    */
    function getAtributes(result)
    {
        var text = "";
        $.each(result, function(a,b){
            if(a != "data-edit" && a != "data-id"){
                text += ' '+a +'="'+b +'"';
            }
        }); 
        return text;
    }
    /*
    * Define quais atributos um objeto pode conter
    */
    function atributesList(type)
    {
        var data = ['class', 'data', 'dir', 'id', 'lang', 'style', 'tabindex', 'title', 'translate']; 
        if(type == 'IMG'){
            data.push('src');
            data.push('alt');
        }
        return data;
    }
    /*
    * Recolhe e armazena os atributos existentes em um objeto
    */
    function atributesElement(data, obj)
    {
        var _result = {};
        for( key in data ) {
            _result[data[key]] = (obj.attr(data[key]) != undefined) ? obj.attr(data[key]) : "";
            /*Atributos data-* */
            if(data[key] == 'data') {
                $.each(obj.data(), function(a,b){
                    _result['data-'+a] = b;
                });                    
            }
        }

        return _result;
    }
    /*
    * Cria os botões e armazena dentro do obejto editável
    */
    function createButtons() 
    {
        var style_btn_edit, style_btn_delete;
        style_btn_edit = ' background-color: #f8ac59; border-color: #f8ac59; color: #FFFFFF; margin-right:5px;';
        style_btn_delete = ' background-color: #ec4758; border-color: #ec4758; color: #FFFFFF;';

        $(document).find("*[data-editable=true]").each(function(){
            var $t = $(this), _id = $t.attr("data-id"), _type = $t.attr("data-type"), obj = '';                   
                obj += '<div class="ol-btn-group" data-target="' + _id + '">';
                obj += '<button type="button" class="btn-template" style="'  + style_btn_edit + '" name="edit_' + _type + '" data-type="' + _type + '" data-target="' + _id + '">';
                obj += '<img src="/assets/theme-admin/images/pencil.svg" class="img-button-template">';
                obj += '</button>';
                obj += '<button type="button" class="btn-template" style="' + style_btn_delete + '" name="delete_' + _type + '" data-type="' + _type + '" data-target="' + _id + '">';
                obj += '<img src="/assets/theme-admin/images/trash.svg" class="img-button-template">';
                obj += '</button>';
                obj += '</div>';
                $(this).append(obj);
        });
    }
    /*Positiona os botões*/
    function positionButton(_top, _left, _type, _id) 
    {
        $(".ol-btn-group[data-target="+_id+"]").css({'top' : _top + 'px', 'left' : _left + 'px', 'display' : 'block'});
    }
    /*
    *** Segunda etapa comunicação e trasição para página parente
    */
    var matrix_complete = {
            _id : '',
            _content: {value:'', type:'input' },
            _type: {value:'', type:'select' },
            _css: {value:'', type:'input' },
            _style: {value:'', type:'input'},
            _link: {value:'', type:'input'},
            _link_target: {value:'', type:'select'}
    };  

    function getMatrix(type)
    {
        matrix = clearMatrix(matrix_complete);
        return matrix;
    }
    function clearMatrix(matrix)
    {
        matrix['_content'].value = "";
        matrix['_type'].value = "";
        matrix['_css'].value = "";
        matrix['_style'].value = "";
        matrix['_link'].value = "";
        matrix['_link_target'].value = "";

        return matrix;
    }

    function setMatrix(t, type, matrix)
    {
        //tipo imagem
        if(type == 'image'){
            //Dados básicos
            t.find("img:not(.img-button-template)").each(function () {
                matrix['_content'].value = $(this).attr('src');
                matrix['_type'].value = $(this).prop("tagName").toLowerCase();
                matrix['_css'].value = $(this).attr("class");
                matrix['_style'].value = $(this).attr("style");
            });
            //Link
            t.find("a").each(function () {
                matrix['_link'].value = $(this).attr('href');
                matrix['_link_target'].value = $(this).attr("target");
            });
        }//dados do tipo titulo
        else if(type== 'title') {
            //básicos
            t.find("h1, h2, h3, h4, h5, h6").each(function () {    
                matrix['_content'].value = $(this).text();
                matrix['_type'].value = $(this).prop("tagName").toLowerCase();
                matrix['_css'].value = $(this).attr("class");
                matrix['_style'].value = $(this).attr("style");         
            });
            //link
            t.find(matrix['_type'].value + " a").each(function () {
                matrix['_link'].value = $(this).attr('href');
                matrix['_link_target'].value = $(this).attr("target");
            });
        }
        else if(type == 'content') {
            var child = $('span[data-id='+t.attr("data-id")+'] > div');
            matrix['_css'].value = child.attr("class");
            matrix['_style'].value = child.attr("style");
            matrix['_content'].value = child.html();            
        }
        else if(type == 'picture')
        {
            var $img = $('span[data-id='+t.attr("data-id")+']  picture > img');
            var $picture = $('span[data-id='+t.attr("data-id")+'] picture');
            //Dados básicos
            matrix['_content'].value = $img.attr('src');
            matrix['_type'].value = 'picture';
            matrix['_css'].value = $picture.attr("class");
            matrix['_style'].value = $picture.attr("style");
            //link
            $('span[data-id='+t.attr("data-id")+']').find('a').each(function () {
                matrix['_link'].value = $(this).attr('href');
                matrix['_link_target'].value = $(this).attr("target");
            });

        }
        matrix['_id'] = t.attr("data-id");

        return matrix;
    }
/**
 * 
 * Monta um elemento do tipo title or content
 */    
function setContentOrTitle(dados)
{
    var obj = "";
    dados['_type'].value = (dados['_type'].value == "") ? "div" : dados['_type'].value;
    obj += '<' + dados['_type'].value;
    obj += ' data-edit="true" data-id="'+dados['_id']+'"';
    if (dados['_css'].value) {
        obj += ' class="' + dados['_css'].value + '"';
    }

    if (dados['_style'].value) {
        obj += ' style="' + dados['_style'].value + '"';
    }
    obj += '>';
    //link somente títulos
    if (typeof dados['_link'] == 'object' && dados['_link'].value) {
        obj += '<a href="' + dados['_link'].value + '"';
        obj += ' title="' + dados['_content'].value + '"'
        if (dados['_link_target'].value) {
            obj += ' target="' + dados['_link_target'].value + '"';
        }
        obj += '>';
    }

    obj += dados['_content'].value;

    //link somente títulos
    if (typeof dados['_link'] == 'object' && dados['_link'].value) {
        obj += '</a>';
    }

    obj += '</' + dados['_type'].value + '>';

    return obj;
}
/**
 * Monta um elemento do tipo imagem
 */
function setImage(dados)
{
    var obj = "";

    if (typeof dados['_link'] == 'object' && dados['_link'].value) {

        obj += '<a href="' + dados['_link'].value + '"';

        if (dados['_link_target'].value) {
            obj += ' target="' + dados['_link_target'].value + '"';
        }

        obj += '>';
        obj += '<img data-edit="true" data-id="'+dados['_id']+'" src="'+dados['_content'].value+'"';
    }else{
        obj += '<img data-edit="true" data-id="'+dados['_id']+'" src="'+dados['_content'].value+'"';
    }

    if (dados['_css'].value) {
        obj += ' class="' + dados['_css'].value + '"';
    }

    if (dados['_style'].value) {
        obj += ' style="' + dados['_style'].value + '"';
    }

    obj += '>';

    if (typeof dados['_link'] == 'object' && dados['_link'].value) {
        obj += '</a>';
    }

    return obj;
}
/*
* Monta um elemento do tio picture
*/
function setPicture(dados)
{
    var obj = "";
    if (typeof dados['_link'] == 'object' && dados['_link'].value) {
        obj += '<a href="' + dados['_link'].value + '"';
        if (dados['_link_target'].value) {
            obj += ' target="' + dados['_link_target'].value + '"';
        }
        obj += '>';
    }
        obj += '<picture data-edit="true" data-id="'+dados['_id']+'"';
    
    if (dados['_css'].value) {
        obj += ' class="' + dados['_css'].value + '"';
    }

    if (dados['_style'].value) {
        obj += ' style="' + dados['_style'].value + '"';
    }
    
    obj += '>';
    
    if(typeof dados['_sources'] != 'undefined')
    {
        console.log('setPicture object ', dados['_sources']);
        for(key in dados['_sources'])
        {
            obj += '<source media="(max-width: '+key+'px)" srcset="'+dados['_sources'][key]+'">';
        }
    }

    obj += '<img src="'+dados['_content'].value+'" />';
    obj += '</picture>'; 

    if (typeof dados['_link'] == 'object' && dados['_link'].value) {
        obj += '</a>';
    }

    return obj;
}


function setTypeElement(id, data, type)
{
    var obj = "";
    //formar o novo elemento
    if(type == 'title' || type == 'content')
    {
        obj += setContentOrTitle(data);
    }
    else if(type == 'image')
    {
        obj += setImage(data);
    }else if(type == 'picture')
    {
        obj += setPicture(data);
    }
    //remover o elemento antigo
    var span = "span.object-editable[data-id="+id+"]";
    $(span + " > h1, " + span + " > h2, " + span + " > h3, " + span + " > h4, " + span + " > h5, " + span + " > h6, " + span + " > a, " + span + " > img, " + span + " > picture, " + span + " > div:not(.ol-btn-group)")
    .remove();   
    
    $(span).prepend(obj);

}    
/* Montar objetos originais */
function getContentValues(id, type)
{
    var content, span = "span.object-editable[data-id="+id+"]";
    if(type == 'image' || type == 'picture')
    {
        var existe_href = 0;
        $(span).find('a').each(function(){
            existe_href++;
        }) ;    
        
        if(existe_href > 0 )
        {
            content = $(span + " > a");
            
        }else {
            
            var nt = (type == 'picture') ? type : 'img';
            content = $(span + " > " + nt);
           
        }
    }
    else if(type == 'content')
    {
        content = $(span + " > div");
    }
    else if(type == 'title')
    {
        content = $(span + " > h1, " + span + " > h2, " + span + " > h3, " + span + " > h4, " + span + " > h5, " + span + " > h6 ");
    }    
    return content[0].outerHTML;   
}
function getAllValues()
{
    var dados = [], i=0, contents = [];
    $("body").find('*[data-editable=true]').each(function () {
        var type = $(this).attr("data-type"),
              id = $(this).attr("data-id");        
        contents[i]  = {'id' : id, 'content' : getContentValues(id, type)};

        i++;
    });
    return contents;
}    