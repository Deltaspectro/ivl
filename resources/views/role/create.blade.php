<form method="POST" v-on:submit.prevent="createRol">
<div class="modal fade" id="create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Crear</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label for="name">Nombre</label>
				<input type="text" name="name" class="form-control" v-model="newRol">
				<label for="display_name">Nombre para mostrar</label>
				<input type="text" name="display_name" class="form-control" v-model="newRol">
				<label for="description">Descripcion</label>
				<input type="text" name="description" class="form-control" v-model="newRol">
				<span v-for="error in errors" class="text-danger">@{{ error }}</span>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Guardar">
			</div>
		</div>
	</div>
</div>
</form>