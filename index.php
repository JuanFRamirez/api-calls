<?php
include_once 'header.php';

echo '
<div class="header">
<h1>Todo List</h1>
</div>
<div class="insertion">
<form>
<label>Name</label><br>
<input name="name" type="text"/><br>
<label>description</label><br>
<input name="desc" type="text"/><br>
<button type="submit" name="submit" class="submit-button" id="add">Agregar</button> 
<button type="submit" name="submitEdit" class="edit-button" id="edit">Editar y Guardar</button> 
</div>

<div class="container">
</div>

';
include_once 'footer.php';
?>