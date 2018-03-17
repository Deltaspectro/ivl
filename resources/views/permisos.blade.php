@extends('layouts.app')

@section('content')
<div id="permisos">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2">
			<center><h3>MODULO DE PERMISOS</h3></center>
		</div>

	</div>
	<div class="row">
		<div class="col-sm-2 col-sm-offset-4">
			<a href="#" class="bnt btn-danger" data-toggle="modal" data-target="#create">Nuevo </a>
		</div>
		<div class="col-sm-2 col-sm-offset-2">
			<a href="#" class=" btn-danger">Mostrar</a>
		</div>
		@include('permisos.create')
	</div>
	<div class="row"> 

<div class="col-md-5">
	<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th colspan="2">
						&nbsp;
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="permiso in permisos">
					<td width="10px">@{{ permioso.id }}</td>
					<td>@{{ permiso.name	 }}</td>
					<td width="10px">
						<a href="#" class="btn btn-warning btn-sm">Editar</a>
					</td>
					<td width="10px">
						<a href="#" class="btn btn-danger btn-sm">Eliminar</a>
					</td>
				</tr>
			</tbody>
		</table>
		
		<nav>
	      <ul class="pagination">
	        <li v-if="pagination.current_page > 1">
	          <a href="#" @click.prevent="changePage(pagination.current_page - 1)">
	            <span>Atras</span>
	          </a>
	        </li>

	        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
	          <a href="#" @click.prevent="changePage(page)">
	            @{{ page }}
	          </a>
	        </li>

	        <li v-if="pagination.current_page < pagination.last_page">
	          <a href="#" @click.prevent="changePage(pagination.current_page + 1)">
	            <span>Siguiente</span>
	          </a>
	        </li>
	      </ul>
    	</nav>
    </div>
		<div class="col-md-5">
			<pre>
				@{{ $data }}
			</pre>
		</div>
	</div>
</div>

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript">
	new Vue({
		el:"#permisos",
		created: function() {
                this.getPermiso();
            },
		data:{
			 permisos:[],
			 pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
                },
			permiso:{
				nombre:'',
				display:'',
				descripcion:''
			},
			fillRol: {'id': '', 'name': '','display_name': '','description': ''},
			errors: '',
			offset: 3,

		},
		computed: {
                isActived: function() {
                    return this.pagination.current_page;
                },
                pagesNumber: function() {
                    if(!this.pagination.to){
                        return [];
                    }

                    var from = this.pagination.current_page - this.offset; 
                    if(from < 1){
                        from = 1;
                    }

                    var to = from + (this.offset * 2); 
                    if(to >= this.pagination.last_page){
                        to = this.pagination.last_page;
                    }

                    var pagesArray = [];
                    while(from <= to){
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;
                }
            },
		methods:{
			getPermiso: function(page) {
				var urlUsers="{{ route('permisos/obtener') }}";
                axios.get(urlUsers).then(response => {
                  this.permisos = response.data,
                  this.pagination = response.data.pagination ,
                   console.log(response.data) 
                });
                console.log(urlUsers);
              },
			submit: function()
			{
				if(this.permiso.nombre=="" || this.permiso.display=="" || this.permiso.descripcion=="")
				{
					toastr["warning"]("Necesita rellenar todos los campos!")

					return;
				}
				var url="{{ route('permisos/create') }}";
				axios.post(url,{
					permiso: this.permiso
				}).then(response=>{
					this.permiso.nombre='';
					this.permiso.display='';
					this.permiso.descripcion='';
					$("#create").modal('toggle');
					toastr["success"]("Se ha creado el rol con exito!")
					toastr.options = {
					  "closeButton": false,
					  "debug": false,
					  "newestOnTop": false,
					  "progressBar": false,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				}).catch(error=>{
					toastr["error"]("Ya existe un permiso con ese nombre.")
					toastr.options = {
					  "closeButton": false,
					  "debug": false,
					  "newestOnTop": false,
					  "progressBar": false,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				});
			},
			
		
		},
		changePage: function(page) {
                this.pagination.current_page = page;
                this.getKeeps(page);
            }
	});
</script>
@endsection