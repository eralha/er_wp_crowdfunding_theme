//Form criar projecto adicionar novos temas
function nivesController (){
	this.niveis = [
	  	{
	  		titulo : "",
	  		valor : "",
	  		descricao : ""
	  	}
	  ];
}
nivesController.prototype.parseIndex = function (obj){
	for(var i = 0; i < obj.length; i++){
	  	obj[i].index = i+1;
	  }
}

nivesController.prototype.inputChange = function(container){
	$(container).find('input').on('input', function() {
		var index = $(this).parent().parent().parent().index();
		var prop = $(this).attr('id');
		this.niveis[index][prop] = $(this).val();
		$('#proj_recompensas').val(JSON.stringify(this.niveis));
	});
}

nivesController.prototype.init = function(){
	this.parseIndex(this.niveis);
	$( "#tmplNivel" ).tmpl( this.niveis ).appendTo( ".recompenssas-list" );
	this.inputChange('.recompenssas-list .recompenssas-list-item');
}

nivesController.prototype.addNivel = function(){
	console.log(this);
	this.niveis.push({
		titulo : "",
		valor : "",
		descricao : ""
	});
	$('.recompenssas-list').html('');
	this.parseIndex(this.niveis);
	$( "#tmplNivel" ).tmpl( this.niveis ).appendTo( '.recompenssas-list' );
	this.inputChange('.recompenssas-list .recompenssas-list-item');
}

function replaceKeys(string, key, content){
    while(String(string).indexOf(key) != -1){
    	string = String(string).replace(key, content)
    }
    return string;
}

function projectListPage(){
	(function($){
	    $(document).ready(function(){
			var page = 1;
			function loadMoreProjectos(){
				var _postData = {};
				$.ajax({
				  url: "/projectos/?page="+page,
				  dataType: 'html',
				  data: _postData,
				  type: 'POST',
				  success : loadPostsSucess,
				});
			}

			function loadPostsSucess(data){
				var html = $(data).find(".project-list-container");

				/*
				console.log(html);
				console.log($(html).find(".no-data").length);
				console.log($(".project-list-container").find(".no-data").length);
				*/
				

				if($(html).find(".no-data").length > 0 && $(".project-list-container").find(".no-data").length == 0){
					$(".project-list-container").append(html);
					return;
				}

				$(".project-list-container").append($(html).html());

				var items = $(".project-list-container .col-md-4");
				$(items).each(function(){
					$(".project-list-container").append(this);
				});
				parseGrid('.project-list-container .col-md-4', 3);
			}
			$(".loadMoreProjectos").click(function(){
				if($(".project-list-container").find(".no-data").length > 0) { return; }
				page ++;
				loadMoreProjectos();
			});
		});
	})(jQuery);
}

function parseGrid(selector, colls){
	var count  = 1;
	var output = "";
	
	$(selector).each(function(){
		if(count == 1){
			output += '<div class="row card-loop card-loop-home">';
		}
		
			if(count > 1 && count < colls){
				$(this).addClass("middle");
			}
			output += $(this).outerHTML();
			count ++;
		
		if(count > colls){
			count = 1;
			output += "</div>";
		}
		
	});
	
	$(selector).parent().html(output);
}
(function($){
    $(document).ready(function(){

    	parseGrid('.project-list-container .col-md-4', 3);

    });
})(jQuery);
$ = jQuery;