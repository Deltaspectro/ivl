
@extends('layouts.app')

@section('content')

 <div id="main" class="container">
  <div class="row">
    <div class="col-sm-8">
        <h1>VUEjs y Laravel</h1>
        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
    Nueva tarea
    </a>
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
            <tr v-for="role in roles">
                <td width="10px">@{{ role.id }}</td>
                <td>@{{ role.display_name }}</td>
                <td>@{{ role.description }}</td>
                <td width="10px">
                    <a href="#" class="btn btn-warning btn-sm">Editar</a>
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
    @include('role/create')
    </div>
    <div class="col-sm-4">
        <h1>JSON</h1>
        <pre>
            @{{ $data | json }}
        </pre>
    </div>
  </div>
        </div>
        

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        
    var urlUsers = 'role';
        new Vue({
            el: '#main',
            created: function() {
                this.getUsers();
            },
            data: {
                roles: [],
                pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
                },
                newRol: '',
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
            methods: {
              getUsers: function(page) {
                axios.get(urlUsers).then(response => {
                  this.roles = response.data.roles.data,
                  this.pagination = response.data.pagination  
                });
              },
              createKeep: function() {
                axios.post(url, {
                  keep: this.newRol
                }).then(response => {
                  this.getKeeps();
                  this.newRol = '';
                  this.errors = [];
                  $('#create').modal('hide');
                  toastr.success('Nueva tarea creada con éxito');
                }).catch(error => {
                  this.errors = 'Corrija para poder crear con éxito'
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