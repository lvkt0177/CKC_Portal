<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Acl\Acl;
use App\Http\Requests;
use \Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('permission:' . Acl::PERMISSION_ROLE_LIST, ['only' => ['index']]);
       $this->middleware('permission:' . Acl::PERMISSION_ROLE_CREATE, ['only' => ['create', 'store']]);
       $this->middleware('permission:' . Acl::PERMISSION_ROLE_EDIT, ['only' => ['edit', 'update']]);
       $this->middleware('permission:' . Acl::PERMISSION_ROLE_DELETE, ['only' => ['destroy']]);
        
    } 

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

}
