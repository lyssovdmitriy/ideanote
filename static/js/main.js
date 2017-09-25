jQuery(document).ready(function($) {
	$.get('/ajax/note/', function(data, status){
		$("#content-wrap").html(data);
	});
	getPads();
	init();	
	app_ob.getnotelist('/ajax/getnotes/1');
});			

var app_ob = {
	save_btn: '#save-btn',
	cancel_btn: '#cancel-btn',
	edit_btn: '#edit-btn',
	new_btn: '#new-btn',
	del_btn: '#del-btn',
	cancel: function(link,ob){
		$.get(link, function(data, status){
			$("#content-wrap").html(data);
		});
		this.update_btn();
	},
	edit: function(link,ob){
		$.get(link, function(data, status){
			$("#content-wrap").html(data);
			$('#note-content').bind('keydown', 'ctrl+s', function(event){
				if (event.preventDefault) { // если метод существует
			    event.preventDefault(); // то вызвать его
			  } else { // иначе вариант IE8-:
			    event.returnValue = false;
			  }
				app_ob.save($(app_ob.save_btn).attr('href'));

			});
		});
		$(this.edit_btn).hide();
		$(this.new_btn).hide();
		$(this.del_btn).hide();
		$(this.save_btn).show();
		$(this.cancel_btn).show();
	},
	save: function(link){
		var form = $('#edit-form').serialize();
    $.ajax({
        type: 'POST',
        url: link,
        data: form,
        success: function(data) {
          $("#content-wrap").html(data);
          app_ob.getnotelist('/ajax/getnotes/');
        },
        error:  function(xhr, str){
	   			alert('Возникла ошибка: ' + xhr.responseCode);
         }
    });	
		this.update_btn();
	},
	delete: function(link){
		$.get(link, function(data, status){
        app_ob.getnotelist('/ajax/getnotes/');
		});
		this.update_btn();
	},
	show: function(link,ob){
		$('#notes-tree a').removeClass('active');
		$(ob).addClass('active');
		$.get(link, function(data, status){
			$("#content-wrap").html(data);
		});
		this.update_btn();
	},
	update_btn: function(){
		$(this.save_btn).hide();
		$(this.cancel_btn).hide();
		$(this.edit_btn).show();
		$(this.new_btn).show();
		$(this.del_btn).show();

	},

	getnotelist: function(link){
		$.get(link, function(data, status){
			$("#notes-tree").html(data);
			init();
		});
		$('div.dropdown-menu').removeClass('show');
	}

}


function getPads() {
	$.get('/ajax/getpads', function(data, status){
		$("#pad-menu").html(data);
		init();
	});
}


function init(){
	

	$('a').click(function() {
		var action = $(this).data('action');
		if (action == undefined) {
			return true;
		}
		var link = $(this).attr('href');
		app_ob[action](link,this);
		return false;
	});

}