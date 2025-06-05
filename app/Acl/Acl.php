<?php

namespace App\Acl;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Acl
{
    //Quy tắt: ROLE_
    const ROLE_SUPER_ADMIN = 'trưởng phòng đào tạo';

    const ROLE_ADMIN = 'trưởng khoa';

    const ROLE_ADMIN_DEPARTMENT = 'trưởng bộ môn';

    //Head of Student Political Affairs Department
    const ROLE_ADMIN_STUDENT_POLITICAL_AFFAIRS = 'trưởng phòng công tác sinh viên';

    const ROLE_STAFF = 'giảng viên';

    //--------------------------------------------------------------------------
    //Quy tắt: PERMISSION_
    const PERMISSION_ASSIGNEE = 'gán vai trò';

    const PERMISSION_VIEW_MENU_DASHBOARD = 'xem menu bảng điều khiển';
    
    // Roles
    const PERMISSION_ROLE_LIST = 'danh sách vai trò';

    const PERMISSION_ROLE_CREATE = 'tạo vai trò';

    const PERMISSION_ROLE_EDIT = 'chỉnh sửa vai trò';
    
    const PERMISSION_ROLE_DELETE = 'xóa vai trò';

    //Permissions
    const PERMISSION_PERMISSION_LIST = 'danh sách quyền';
    
    const PERMISSION_PERMISSION_CREATE = 'tạo quyền';
    
    const PERMISSION_PERMISSION_EDIT = 'chỉnh sửa quyền';
    
    const PERMISSION_PERMISSION_DELETE = 'xóa quyền';

    const PERMISSION_PERMISSION_ASSIGN = 'gán quyền';

    //Chương trình đào tạo
    const PERMISSION_TRAINING_PROGRAM_LIST = 'danh sách chương trình đào tạo';

    // const PERMISSION_TRAINING_PROGRAM_CREATE = 'tạo chương trình đào tạo';

    // const PERMISSION_TRAINING_PROGRAM_EDIT = 'chỉnh sửa chương trình đào tạo';

    // const PERMISSION_TRAINING_PROGRAM_DELETE = 'xóa chương trình đào tạo';

    //SINH VIÊN
    const PERMISSION_STUDENT_LIST = 'danh sách sinh viên';

    //Giảng viên
    const PERMISSION_USER_LIST = 'danh sách người dùng';
    
    //Lớp
    const PERMISSION_CLASS_LIST = 'danh sách lớp học';

    const PERMISSION_CLASS_CREATE = 'tạo lớp học';

    const PERMISSION_CLASS_EDIT = 'chỉnh sửa lớp học';

    // const PERMISSION_CLASS_DELETE = 'xóa lớp học';

    //Phòng học
    const PERMISSION_ROOM_LIST = 'danh sách phòng học';

    const PERMISSION_ROOM_CREATE = 'tạo phòng học';

    const PERMISSION_ROOM_EDIT = 'chỉnh sửa phòng học';

    // const PERMISSION_ROOM_DELETE = 'xóa phòng học';

    //....


    /**
     * @param  array  $exclusives Exclude some permissions from the list
     */
    public static function permissions(array $exclusives = []): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) use ($exclusives) {
                return ! in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function menuPermissions(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function roles(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $roles = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            return array_values($roles);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    // Danh mục Các quyền
    public static array $groupedPermissions = [
        'Hệ thống' => [
            self::PERMISSION_ASSIGNEE,
            self::PERMISSION_VIEW_MENU_DASHBOARD,
        ],
        'Vai trò' => [
            self::PERMISSION_ROLE_LIST,
            self::PERMISSION_ROLE_CREATE,
            self::PERMISSION_ROLE_EDIT,
            self::PERMISSION_ROLE_DELETE,
        ],
        'Quyền' => [
            self::PERMISSION_PERMISSION_LIST,
            self::PERMISSION_PERMISSION_CREATE,
            self::PERMISSION_PERMISSION_EDIT,
            self::PERMISSION_PERMISSION_DELETE,
            self::PERMISSION_PERMISSION_ASSIGN,
        ],
        'Chương trình đào tạo' => [
            self::PERMISSION_TRAINING_PROGRAM_LIST,
        ],
        'Sinh viên' => [
            self::PERMISSION_STUDENT_LIST,
        ],
        'Giảng viên' => [
            self::PERMISSION_USER_LIST,
        ],
        'Lớp học' => [
            self::PERMISSION_CLASS_LIST,
            self::PERMISSION_CLASS_CREATE,
            self::PERMISSION_CLASS_EDIT,
        ],
        'Phòng học' => [
            self::PERMISSION_ROOM_LIST,
            self::PERMISSION_ROOM_CREATE,
            self::PERMISSION_ROOM_EDIT,
        ],
    ];

    public static function groupedPermissions(): array
    {
        return self::$groupedPermissions;
    }

}
