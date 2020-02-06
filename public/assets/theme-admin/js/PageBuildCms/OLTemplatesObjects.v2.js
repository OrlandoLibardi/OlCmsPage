/* 
 * Esse script lê todas as ocorrências marcadas como editáveis 
 * e a formata para criar uma interface visual com a aplicação
 */
(function($) {
	"use strict";
	$.fn.OLTemplatesObjects = function(options) {
        var $el = $(this);
		var defaults = {
            objects_load : '#objects_load'
		};
		var settings = $.extend({}, defaults, options);
        
        function initLoad(){
            var id = 1;
            $el.find('*[data-edit=true]').each(function(){
                var $t = $(this),
                    content = setObject(setType($t.prop('tagName')), $t[0].outerHTML, id);
                    $t.replaceWith(content);
                id++;
            });
        }

        function setType(data){
            if(data == 'H1' || data == 'H2' || data == 'H3' || data == 'H4' || data == 'H5' || data == 'H6'){
                return 'title';
            }
            else if(data == 'DIV'){
                return 'content';
            }
            else if(data = 'IMG'){
                return 'image';
            }
            else if(data == 'PICTURE'){
                return 'picture';
            }
        }

        function setObject(type, html, id){
            return '<span class="object-editable" data-editable="true" data-type="'+type+'" data-id="'+id+'">'+html+'</span>';
        }

        return initLoad();

    }
}(jQuery));
