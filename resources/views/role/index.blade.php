
@extends('layouts.app')

@section('content')

<div class="col-sm-7">
        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
        Nueva tarea
        </a>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tarea</th>
                    <th colspan="2">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="keep in keeps">
                    <td width="10px">@{{ keep.id }}</td>
                    <td>@{{ keep.keep }}</td>
                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editKeep(keep)">Editar</a>
                    </td>
                    <td width="10px">
                        <!--con el ".prevent" ya no se regresca la pagina-->
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteKeep(keep)">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
        @include('create')
    </div>

    <script type="text/javascript">
        
        
new Vue({
    el: '#crud',
    created: function() {
        this.getKeeps();
    },
    data: {
        keeps: []/*,
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },
        newKeep: '',
        fillKeep: {'id': '', 'keep': ''},
        errors: '',
        offset: 3,*/
    },/*
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
    },*/
    methods: {
        getKeeps: function() {
            var urlKeeps = 'tasks';
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data
            });
        },/*
        editKeep: function(keep) {
            this.fillKeep.id   = keep.id;
            this.fillKeep.keep = keep.keep;
            $('#edit').modal('show');
        },
        updateKeep: function(id) {
            var url = 'tasks/' + id;
            axios.put(url, this.fillKeep).then(response => {
                this.getKeeps();
                this.fillKeep = {'id': '', 'keep': ''};
                this.errors   = [];
                $('#edit').modal('hide');
                toastr.success('Tarea actualizada con éxito');
            }).catch(error => {
                this.errors = 'Corrija para poder editar con éxito'
            });
        },*/
        deleteKeep: function(keep) {
            var url = 'tasks/' + keep.id;
            axios.delete(url).then(response => { //eliminamos
                this.getKeeps(); //listamos
                toastr.success('Eliminado correctamente'); //mensaje
            });
        }/*,
        createKeep: function() {
            var url = 'tasks';
            axios.post(url, {
                keep: this.newKeep
            }).then(response => {
                this.getKeeps();
                this.newKeep = '';
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Nueva tarea creada con éxito');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con éxito'
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getKeeps(page);
        }*/
    }
});    
    </script>







    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Role Management</div>

                    <div class="panel-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($roles as $key => $role)

                                <tr class="list-users">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        <a class="btn btn-info" href="">Show</a>
                                        <a class="btn btn-primary" href="">Edit</a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="" class="btn btn-success">New Role</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection