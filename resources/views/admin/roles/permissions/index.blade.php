@extends('admin.layouts.app')

@section('title', 'Quản lý quyền')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách các quyền theo nhóm </h3>

                        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">Quay lại</a>

                    </div>

                    <div class="card-body">
                        <div class="row g-4">
                            @foreach ($groupedPermissions as $group => $permissions)
                                <div class="col-md-6 my-1">
                                    <div class="p-3 border rounded shadow-sm h-100">
                                        <h5 class="fw-bold text-h1 mb-3">{{ $group }}</h5>
                                        
                                        @foreach ($permissions as $permission)
                                            <div class="badge bg- text-dark border mb-2 me-2 p-2" style="font-size: 0.9rem;">
                                                {{ $permission }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
