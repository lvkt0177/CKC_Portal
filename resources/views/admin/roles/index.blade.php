@extends('admin.layouts.app')

@section('title', 'Quản lý vai trò')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Phân quyền và vai trò</h3>
                        <a href="{{ route('giangvien.permissions.index') }}" class="btn btn-primary">Danh sách các quyền</a>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <table class="team-table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th style="min-width: 150px">Tên vai trò</th>
                                        <th style="min-width: 250px">Quyền</th>
                                        <th style="min-width: 160px">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td class="">
                                                @php
                                                    $maxPermissions = 6;
                                                    $totalPermissions = $role->permissions->count();
                                                    $displayed = $role->permissions->take($maxPermissions);
                                                @endphp

                                                @foreach ($displayed as $permission)
                                                    <span
                                                        class="badge bg-info text-white my-1">{{ $permission->name }}</span>
                                                @endforeach

                                                @if ($totalPermissions > $maxPermissions)
                                                    <span
                                                        class="badge bg-secondary my-1 text-light">+{{ $totalPermissions - $maxPermissions }}
                                                        quyền khác</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center gap-1">
                                                @if ($role->name !== Acl()::ROLE_SUPER_ADMIN)
                                                    <a href="{{ route('giangvien.roles.edit', $role) }}" class="btn btn-warning btn-sm"><i
                                                            class="bi bi-pencil"></i></a>
                                                @else
                                                    <span class="text-muted">Không thể thao tác</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
