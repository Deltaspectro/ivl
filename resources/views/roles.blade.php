
@extends('layouts.app')
 <!-- Scripts -->
    
@section('content')

 <div id="main" class="container">
  <div class="row">
    <div class="col-sm-8">
        <h1>VUEjs y Laravel</h1>
        <a href="#" class="btn btn-primary pull-right" @click="nuevoRol">
    Nueva tarea
    </a>

    @include('role/create')
    @include('role/edit')
      <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th colspan="2">
                    &nbsp;
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(role, index) in roles" :id="'col' + index">
                <td width="10px">@{{ role.id }}</td>
                <td>@{{ role.display_name }}</td>
                <td>@{{ role.description }}</td>
                <td width="10px">
                    <a href="#" class="btn btn-warning btn-sm" @click="edit(role)">Editar</a>
                </td>
                <td width="10px">
                    <!--con el ".prevent" ya no se regresca la pagina-->
                    <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        </tbody>
      </table>
      <nav>
      <ul class="pagination">
        <li v-if="pagination.current_page > 2">
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
    <div id="Role-permisos">
                  

                </div>
                
    </div>
    <div class="col-sm-4">
        <h1>JSON</h1>
        <pre>
            @{{ $data | json }}
        </pre>
    </div>
  </div>
        </div>
        
<script src="{{ asset('js/app.js') }}"></script>
   
    <script type="text/javascript">
        new Vue({
            el: '#main',
            created: function() {
                this.getUsers();
                this.getRolPer();
            },
            data: {
                roles: [],
                permisos:[],
                CheckPermisos: [],
                pagination: {
      'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
    },
                newRol: {'id': '', 'name': '','display_name': '','description': ''},
                fillRol: {'id': '', 'name': '','display_name': '','description': ''},
                errors: '',
                offset: 3,
                rol_tpm:'',
                rol_permissions:[],

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
            methods: {
                 getRolPer: function(page) {
                var urlUsers="{{ route('permiso') }}";
                axios.get(urlUsers).then(response => {
                  this.permisos = response.data
                });
              },
              getUsers: function(page) {
                var urlUsers = 'role?page='+page;
                axios.get(urlUsers).then(response => {
                  this.roles = response.data.roles.data,
                  this.pagination = response.data.pagination  
                });
              },
              
              send:function()
              {
                url = "{{ route('roles/store') }}";
                axios.post(url, {

                  name: this.newRol.name,
                  display_name: this.newRol.display_name,
                  description: this.newRol.description,
                  permisos: this.CheckPermisos
                }).then(response => {
                  $('#create').modal('toggle');
                  this.getRolPer();
                  toastr.success('Nueva tarea creada con éxito');
                  this.newRol = '';
                  this.errors = [];
                }).catch(error => {
                  this.errors = response.data,
                  console.log(response.data)
                });
              },
              nuevoRol: function()
              {
                this.errors="";
                //this.CheckPermisos=[];
                this.newRol.name='';
                this.newRol.display_name='';
                this.newRol.description='';
                $("#create").modal('show');
              },
              edit: function(role){
                this.rol_tpm = role;
                $("#edit").modal('show');
                var url = "";
                axios.post(url,{
                  id: this.rol_tpm.id
                }).then (resnpose =>{
                  this.rol_permissions = response.data
                }).catch( error =>{
                  console.log(response.data)
                });
              },
 changePage: function(page) {
                this.pagination.current_page = page;
                this.getUsers(page);
            }

            },
           
        });
    </script>




@endsection