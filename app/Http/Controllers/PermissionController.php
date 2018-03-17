<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permission::get();

        return response()->json($permisos);
    }

    public function view()
    {
        return view('permisos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
         $permiso = new Permission();
        $permiso->name = $request->permiso['nombre'];
        $permiso->display_name = $request->permiso['display'];
        $permiso->description = $request->permiso['descripcion'];
        $permiso->save();
        return $permiso->id;
        
    }
    /**
     * Display a listing of the resource.
     *
     *  @return \Illuminate\Http\Response
     */
    public function obtener()
    {
        $permisos = Permission::orderBy('id', 'DESC')->paginate(20);

        return response()->json([
            'pagination' => [
                'total'         => $permisos->total(),
                'current_page'  => $permisos->currentPage(),
                'per_page'      => $permisos->perPage(),
                'last_page'     => $permisos->lastPage(),
                'from'          => $permisos->firstItem(),
                'to'            => $permisos->lastPage(),
            ],
            'permisos' => $permisos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
