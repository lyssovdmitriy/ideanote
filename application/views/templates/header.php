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
     <!--  <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Блокноты
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="pad-menu">
         
        </div>
      </li>
    </ul>
    <ul class="navbar-nav float-right">

      <li class="nav-item">
        <a 
        	class="nav-link btn btn-light" 
        	href="/ajax/editor/new" 
        	id="new-btn" 
        	data-action="edit" 
        	>Создать</a>
		  </li>

		  <li class="nav-item">
        <a 
        	class="nav-link btn  btn-light" 
        	href="/ajax/editor" 
        	id="edit-btn" 
        	data-action="edit" 
        	>Редактировать</a>
		  </li>

		  <li class="nav-item">
        <a 
        	class="nav-link btn btn-default" 
        	href="/ajax/delete" 
        	id="del-btn" 
        	data-action="delete" 
        	>Удалить</a>
		  </li>

      <li class="nav-item">
        <a 
        	class="nav-link btn  btn-light" 
        	href="/ajax/note" 
        	id="cancel-btn" 
        	data-action="cancel"
        	style="display:none" 
        	>Отменить</a>
      </li>
      <li class="nav-item">
        <a 
        	class="nav-link btn  btn-light" 
        	href="/ajax/save" 
        	id="save-btn" 
        	data-action="save" 
        	style="display:none"       	
        	>Сохранить</a>
      </li>
      <li class="nav-item">
        <a 
        	class="nav-link btn  btn-default" 
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