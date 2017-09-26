jQuery(document).ready(function($) {
	$.get('/ajax/note/', function(data, status){
		$("#content-wrap").html(data);
	});
	// getPads();
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
			getCurNote();
			init();
		});
		$('div.dropdown-menu').removeClass('show');
	},

	newpad: function(link){
		$.get(link, function(data, status){
			$("#popup").html(data);
			$("#popup").show('400');
			init();
		});
		$('div.dropdown-menu').removeClass('show');		
	},



	makenewpad: function(link){
		var form = $('#newpadform').serialize();
    $.ajax({
        type: 'POST',
        url: link,
        data: form,
        success: function(data) {
					$('#popup').hide('400');
          console.log(data);
					getPads();
          app_ob.getnotelist('/ajax/getnotes/');
          	$.get('/ajax/note/', function(data, status){
							$("#content-wrap").html(data);
						});
        },
        error:  function(xhr, str){
        	console.log('Возникла ошибка: ' + xhr.responseCode);
        	console.log(str);
         }
    });	
	},

	savepad: function(){
		var form = $('#editpadform').serialize();
    $.ajax({
        type: 'POST',
        url: '/ajax/savepad',
        data: form,
        success: function(data) {
					$('#popup').hide('400');
          console.log(data);
					getPads();
        },
        error:  function(xhr, str){
        	console.log('Возникла ошибка: ' + xhr.responseCode);
        	console.log(str);
         }
    });	
	}



}


function getPads() {
	$.get('/ajax/getpads', function(data, status){
		$("#notes-tree").html(data);
		init();
	});
}


function init(){	
	$('a').unbind('click', a_click); 
	$('a').bind('click', a_click); 

	$('.pad_menu').click(function(event) {
		padChangeMenuOpen(this);
		event.stopPropagation();
	});
}


function a_click() {
		var action = $(this).data('action');
		if (action == undefined) {
			return true;
		}
		var link = $(this).attr('href');		
		app_ob[action](link,this);
		return false;	
}

function getCurNote(){
	$.get('/ajax/note/', function(data, status){
		$("#content-wrap").html(data).show('400');
	});
}

function delPad(data){
	var title = data.title;
	var id = data.id;
	var ret = confirm('Вы действительно хотите удалить блокнот "'+title+'"?');
	if (ret) {
		$.get('/ajax/deletepad/'+id, function(data, status){
			console.log(data);
			getPads();
			getCurNote();
		});
	}
	return false;
}

function padChangeMenuOpen(ob){
	var data = $(ob).data();
	$(ob).hide('400');
	$('#pmf_'+data.id).animate({	'width': '100px'},'400').addClass('active');

	$('#pmf_'+data.id+'>.change').unbind('click');
	$('#pmf_'+data.id+'>.change').click(function(e) {
		e.stopPropagation();
		$('#pmf_'+data.id).animate({	'width': '0px'},'400').removeClass('active');
		$(ob).show('400');
		editpad(data.id);
		return false;
	});


	$('#pmf_'+data.id+'>.del').unbind('click');
	$('#pmf_'+data.id+'>.del').click(function(e) {
		e.stopPropagation();
		$('#pmf_'+data.id).animate({	'width': '0px'},'400').removeClass('active');
		$(ob).show('400');
		delPad(data);
		return false;
	});
}


function editpad(id){
	$.get('/ajax/editpad/'+id, function(data, status){
		$("#popup").html(data);
		$("#popup").show('400');
		init();
	});
}
