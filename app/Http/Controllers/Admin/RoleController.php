<?php

namespace App\Http\Controllers\Admin;

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

    public function addRoleForUser(RoleRequest $request, User $user)
    {
        $role = Role::where('name', $request->validated())->first();

        if ($role) {
            $user->assignRole($role);
            return redirect()->back()->with('success', 'Vai trò đã được gán cho người dùng '.$user->hoSo->ho_ten);
        }

    }

    public function removeRoleForUser(RoleRequest $request, User $user)
    {
        $role = Role::where('name', $request->validated())->first();
        $user->removeRole($role);
        return redirect()->back()->with('success', 'Vai trò đã được xóa khỏi người dùng '.$user->hoSo->ho_ten);
    }

}