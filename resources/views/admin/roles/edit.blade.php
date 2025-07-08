@extends('admin.layouts.app')

@section('title', 'Quản lý vai trò')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/role_permissions.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Gán quyền cho vai trò</h3>
                        <a href="{{ route('giangvien.roles.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('giangvien.roles.update-permissions', $role) }}" method="POST" data-confirm>
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên vai trò:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" disabled>
                            </div>
                    
                            <div class="mb-3">
                                <label class="form-label">Gán quyền:</label>
                                <div class="row">
                                    <div class="permissions-container">
                                        @foreach ($groupedPermissions as $group => $permissions)
                                            @php
                                                $groupId = Str::slug($group);
                                            @endphp
                                    
                                            <div class="permission-group border rounded mb-3 shadow-sm">
                                                <div class="group-header bg-light px-3 py-2 d-flex justify-content-between align-items-center" onclick="toggleGroup('{{ $groupId }}')">
                                                    <h5 class="m-0">
                                                        {{ $group }}
                                                    </h5>
                                                    <div>
                                                        <i class="fas fa-chevron-down ms-2 toggle-icon"></i>
                                                        <button type="button" class="btn btn-sm btn-success select-all-btn" onclick="selectAllInGroup('{{ $groupId }}', event)">
                                                            Chọn tất cả
                                                        </button>
                                                    </div>
                                                </div>
                                    
                                                <div class="group-content px-3 py-2 show" id="{{ $groupId }}">
                                                    @foreach ($permissions as $permission)
                                                        <div class="permission-item mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input {{ $groupId }}-checkbox"
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $permission->id }}"
                                                                       id="perm_{{ $permission->id }}"
                                                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                            @if (!empty($permission->description))
                                                                <div class="permission-description text-muted ms-4">
                                                                    {{ $permission->description }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật vai trò</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        // Toggle nhóm quyền
        function toggleGroup(groupId) {
            const content = document.getElementById(groupId);
            const icon = content.previousElementSibling.querySelector('.toggle-icon');
            
            if (content.classList.contains('show')) {
                content.classList.remove('show');
                icon.classList.remove('rotated');
            } else {
                content.classList.add('show');
                icon.classList.add('rotated');
            }
        }

        // Chọn tất cả quyền trong nhóm
        function selectAllInGroup(groupId, event) {
            event.stopPropagation();
            const group = document.getElementById(groupId);
            const checkboxes = group.querySelectorAll('input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });
            
            updateSelectedCount();
        }

        // Cập nhật số lượng quyền đã chọn
        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
            document.getElementById('selectedCount').textContent = checkedBoxes.length;
        }

        // Lưu quyền
        function savePermissions() {
            const roleSelect = document.getElementById('roleSelect');
            const selectedRole = roleSelect.value;
            
            if (!selectedRole) {
                alert('Vui lòng chọn vai trò trước khi lưu quyền!');
                return;
            }
            
            const checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
            const permissions = Array.from(checkedBoxes).map(cb => cb.value);
            
            console.log('Vai trò:', selectedRole);
            console.log('Quyền được chọn:', permissions);
            
            alert(`Đã lưu ${permissions.length} quyền cho vai trò "${roleSelect.options[roleSelect.selectedIndex].text}"`);
        }

        // Xử lý sự kiện thay đổi checkbox
        document.addEventListener('change', function(e) {
            if (e.target.type === 'checkbox') {
                updateSelectedCount();
            }
        });

        // Khởi tạo: mở nhóm đầu tiên
        document.addEventListener('DOMContentLoaded', function() {
            toggleGroup('user-management');
            updateSelectedCount();
        });
    </script>
@endsection