
<div class="modal fade" id="create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Crear Nuevo Rol</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>

				
			</div>
			<div class="modal-body">
								<label for="newRol.name">Nombre</label>
								<input type="text" name="name" class="form-control" v-model="newRol.name">
								<label for="newRol.display_name">Nombre para mostrar</label>
								<input type="text" name="display_name" class="form-control" v-model="newRol.display_name">
								<label for="newRol.description">Descripcion</label>
								<input type="text" name="description" class="form-control" v-model="newRol.description">



								
								<span v-for="error in errors" class="text-danger">@{{ error }}</span>
				<div style="background: red">
                    
                    <div v-for="permiso in permisos">
                    	<input type="checkbox" id="1" :value="permiso.id" v-model="CheckPermisos">
  						<label for="@{{permiso.name}}">@{{permiso.name}}</label>
                </div>
                </div>
                <input type="btn" class="btn btn-primary" value="Guardar" @click="send">
</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>