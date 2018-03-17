
<div class="modal fade" id="create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Crear Nuevo Permiso</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>

				
			</div>
			<div class="modal-body">
				<label for="nombre">Nombre de Permiso</label>
				<input type="text" name="" class="form-control" v-model="permiso.nombre" placeholder="Crear-usuario">
				<label for="display">Nomre para mostrar</label>
				<input type="text" name="" class="form-control" v-model="permiso.display" placeholder="Crea usuarios">
				<label for="display">Descripcion del permiso</label>
				<input type="text" name="" class="form-control" v-model="permiso.descripcion" placeholder="Permiso para la creacion de usuarios en el modulo usuario">
				<span v-for="error in errors" class="text-danger">@{{ error }}</span>
			</div>
			<div class="modal-footer">
				<input type="btn" class="btn btn-primary" value="Guardar" @click.prevent="submit">
			</div>
		</div>
	</div>
</div>