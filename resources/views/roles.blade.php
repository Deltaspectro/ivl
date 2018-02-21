
@extends('layouts.app')

@section('content')

 <div id="main" class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h1>VUEjs y Laravel</h1>
                    <ul v-for="item in lists" class="list-group">
                        <li  class="list-group-item">                      
                            id: @{{ item.id }}
                        </li>
                        <li  class="list-group-item">
                            name: @{{ item.name }}
                        </li>
                        <li  class="list-group-item">
                            Nombre: @{{ item.display_name }}
                        </li>
                        <li  class="list-group-item">
                            Descripcion: @{{ item.description }}
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8">
                    <h1>JSON</h1>
                    <pre>
                        @{{ $data | json }}
                    </pre>
                </div>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.1/axios.min.js"></script>
        

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
                lists: []
            },
            methods: {
                getUsers: function() {
                    axios.get(urlUsers).then(response => {
                        this.lists = response.data
                    });
                }
            }
        });
    </script>







@endsection