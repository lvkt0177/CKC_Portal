<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Acl\Acl;
use App\Http\Requests;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Http\Requests\Role\RoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . Acl::PERMISSION_ROLE_LIST, ['only' => ['index']]);
    }

    // api/admin/role
    public function index()
    {
        $roles = Role::with('permissions')->get();
        
        return response()->json([
            'success' => true,
            'roles' => $roles
        ]);
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->roles()->sync([$request->role_id]);

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật chức vụ thành công',
        ]);
    }

}