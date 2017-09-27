<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="/static/css/main.css">
	<title><?=$title?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eee" id="navbar">
  <a class="navbar-brand" href="" onclick="return false;">IDEANOTE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="" class="nav-link" onclick="getPads(); return false;">Блокноты</a>
      </li>

		  <li class="nav-item">
        <a 
        	class="nav-link" 
        	href="/ajax/editor" 
        	id="edit-btn" 
        	data-action="edit" 
          style=" margin-left: 65px;" 
        	>Редактировать</a>
		  </li>

		  <li class="nav-item">
        <a 
        	class="nav-link" 
        	href="/ajax/delete" 
        	id="del-btn" 
        	data-action="delete" 
        	>Удалить заметку</a>
		  </li>

      <li class="nav-item">
        <a 
        	class="nav-link" 
        	href="/ajax/note" 
        	id="cancel-btn" 
        	data-action="cancel"
        	style="display:none; margin-left: 55px;" 
        	>Отменить</a>
      </li>
      <li class="nav-item">
        <a 
        	class="nav-link" 
        	href="/ajax/save" 
        	id="save-btn" 
        	data-action="save" 
        	style="display:none"       	
        	>Сохранить</a>
      </li>
      <li class="nav-item"
          style="float:right" 
      >
        <a 
          class="nav-link" 
          href="/login/out" 
        	>Выход</a>
      </li>
    </ul>
  </div>
</nav>
<div id="sidebar">
	<div id="notes-tree">
		
	</div>
	
</div>
<div id="popup">
  
</div>