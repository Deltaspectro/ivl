<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Permission;

class RoleController extends Controller
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
     *  @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::orderBy('id', 'DESC')->paginate(2);

        return [
            'pagination' => [
                'total'         => $roles->total(),
                'current_page'  => $roles->currentPage(),
                'per_page'      => $roles->perPage(),
                'last_page'     => $roles->lastPage(),
                'from'          => $roles->firstItem(),
                'to'            => $roles->lastPage(),
            ],
            'roles' => $roles
        ];
    }
    /**
     * Display a listing of the resource.
     *
     *  @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    	
        $permissions = Permission::get();
        return $permissions;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        
        
        
        try{
            //create the new role
        $role = new Role();
        $role->name =$request->name;
        $role->display_name =$request->display_name;
        $role->description =$request->description;
        $role->save();
        foreach ($request->permisos as $key => $value) {
            $role->attachPermission($value);
        }
        return "exito";

        }catch(\Exception $e){
            return $e;
        }




        /*
        Role::create([
            'name' =>'teste',
            'display_name' =>'pruebas',
            'description' =>'nuevo test'
        ]);
        */



        //attach the selected permissions
        /*
        foreach ($request->input('permissions') as $key => $value) {
            $role->attachPermission($value);
        }
        return redirect()->route('roles.index')
            ->with('success','Role created successfully');*/
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    	/*
        $role = Role::find($id); //Find the requested role
        //Get the permissions linked to the role
        $permissions =
            Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->get();
        //return the view with the role info and its permissions
        return view('roles.show',compact('role','permissions'));
        */
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    	/*
        $role = Role::find($id);//Find the requested role
        $permissions = Permission::get(); //get all permissions
        //Get the permissions ids linked to the role
        $rolePermissions =
//            DB::table("permission_role")
//                ->where("permission_role.role_id",$id)
//                ->pluck('permission_role.permission_id','permission_role.permission_id')
//                ->toArray();
            DB::table("permission_role")
                ->where("role_id",$id)
                ->pluck('permission_id')
                ->toArray();
        return view('roles.edit',compact('role','permissions','rolePermissions'));
        */
        $permission = Permission::get();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->lists('permission_role.permission_id','permission_role.permission_id');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
    	/*
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
            'permissions' => 'required',
        ]);
        //Find the role and update its details
        $role = Role::find($id);
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        //delete all permissions currently linked to this role
        DB::table("permission_role")->where("role_id",$id)->delete();
        //attach the new permissions to the role
        foreach ($request->input('permissions') as $key => $value) {
            $role->attachPermission($value);
        }
        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
            */
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    	/*
//        Role::->where('id',$id)->delete();
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
            */
    }

}
