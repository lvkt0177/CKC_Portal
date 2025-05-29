<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:' . Acl::PERMISSION_PERMISSION_LIST, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_PERMISSION_CREATE, ['only' => ['create', 'store']]);
        $this->middleware('permission:' . Acl::PERMISSION_PERMISSION_EDIT, ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . Acl::PERMISSION_PERMISSION_DELETE, ['only' => ['destroy']]);
    }

    public function index()
    {
        $groupedPermissions = Acl::groupedPermissions();
        
        return view('admin.roles.permissions.index', compact('groupedPermissions'));
    }

}
