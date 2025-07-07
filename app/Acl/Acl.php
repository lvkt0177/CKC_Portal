<?php

namespace App\Acl;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Acl
{
    //Quy tắt: ROLE_
    /*  
        1. Admin
        2. Nhân viên phòng đào tạo
        3. Nhân viên phòng công tác chính trị
        4. Giảng viên bộ môn
        5. Giảng viên chủ nhiệm
        6. trưởng khoa
    */
    //------------------------
    const ROLE_SUPER_ADMIN = 'admin';
    const ROLE_PHONG_DAO_TAO = 'trưởng phòng đào tạo';
    const ROLE_PHONG_CONG_TAC_CHINH_TRI = 'trưởng phòng công tác chính trị';
    const ROLE_GIANG_VIEN_BO_MON = 'giảng viên bộ môn';
    const ROLE_GIANG_VIEN_CHU_NHIEM = 'giảng viên chủ nhiệm';
    const ROLE_TRUONG_KHOA = 'trưởng khoa';

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


    //Biên bản SHCN
    const PERMISSION_SECRETARY_REPORT_LIST = 'danh sách biên bản';
    const PERMISSION_SECRETARY_REPORT_SHOW = 'xem biên bản';
    const PERMISSION_SECRETARY_REPORT_CREATE = 'tạo biên bản';
    const PERMISSION_SECRETARY_REPORT_EDIT = 'chỉnh sửa biên bản';
    const PERMISSION_SECRETARY_REPORT_DELETE = 'xóa biên bản';
    const PERMISSION_SECRETARY_REPORT_CONFIRM = 'gửi biên bản';
    const PERMISSION_SECRETARY_REPORT_DELETE_ABSENCE_STUDENT = 'xoá sinh viên vắng';

    // Cấp mật khẩu
    const PERMISSION_STUDENT_PASSWORD_LIST = 'danh sách sinh viên liên hệ cấp lại mật khẩu';
    const PERMISSION_STUDENT_PASSWORD_UPDATE = 'cập nhật sinh viên liên hệ cấp lại mật khẩu';

    //CTDT
    const PERMISSION_CTDT_LIST = 'danh sách chương trình đào tạo';
    const PERMISSION_CTDT_WEEK_SHOW = 'xem tuần';
    const PERMISSION_CTDT_WEEK_CREATE = 'tạo tuần';
    
    //Điểm môn học
    const PERMISSION_SCORE_LIST = 'danh sách điểm môn học';
    const PERMISSION_SCORE_EDIT = 'chỉnh sửa điểm môn học';

    //Giảng viên
    const PERMISSION_TEACHER_LIST = 'danh sách giảng viên';
    const PERMISSION_TEACHER_SHOW_SCHEDULE = 'xem lịch dạy';

    // Giấy xác nhận
    const PERMISSION_STUDENT_CONFIRMATION_LIST = 'danh sách sinh viên đăng ký giấy xác nhận';
    const PERMISSION_STUDENT_CONFIRMATION_UPDATE = 'cập nhật sinh viên đăng ký giấy xác nhận';
    
    //Lịch học
    const PERMISSION_VIEW_TIMETABLE = 'xem lịch học';
    const PERMISSION_TIMETABLE_LIST = 'danh sách lịch học';
    const PERMISSION_TIMETABLE_CREATE = 'tạo lịch học';
    const PERMISSION_TIMETABLE_UPDATE = 'chỉnh sửa lịch học';
    const PERMISSION_TIMETABLE_DESTROY = 'xóa lịch học';
    const PERMISSION_TIMETABLE_COPY = 'sao chép tuần';

    //Lịch thi
    const PERMISSION_TIMETABLE_EXAM = 'lịch thi';
    const PERMISSION_TIMETABLE_EXAM_SHOW = 'lịch thi';
    const PERMISSION_TIMETABLE_EXAM_CREATE = 'tạo lịch thi';

    //Lop
    const PERMISSION_CLASS = 'xem lớp học';
    const PERMISSION_CLASS_STUDENT_LIST = 'danh sách sinh viên lớp học';
    const PERMISSION_CLASS_INPUT_CONDUCT_SCORE = 'nhập điểm rèn luyện';

    //Phiếu lên lớp
    const PERMISSION_VIEW_CLASS_RECORD    = 'Xem phiếu lên lớp';
    const PERMISSION_CREATE_CLASS_RECORD  = 'Tạo phiếu lên lớp';

    //Phòng học
    const PERMISSION_ROOM_LIST = 'danh sách phòng học';
    const PERMISSION_ROOM_CREATE = 'tạo phòng học';
    const PERMISSION_ROOM_EDIT = 'chỉnh sửa phòng học';

    //Sinh viên
    const PERMISSION_STUDENT_LIST = 'danh sách sinh viên';
    const PERMISSION_STUDENT_EDIT_ROLE = 'chỉnh sửa chức vụ sinh viên';

    //Thông báo
    const PERMISSION_NOTICE_LIST = 'danh sách thông báo';
    const PERMISSION_NOTICE_SHOW = 'xem thông báo';
    const PERMISSION_NOTICE_CREATE = 'tạo thông báo';
    const PERMISSION_NOTICE_EDIT = 'chỉnh sửa thông báo';
    const PERMISSION_NOTICE_DELETE = 'xóa thông báo';
    const PERMISSION_NOTICE_CONFIRM = 'gửi thông báo';

    //.................................................................
    // Thư ký
    const PERMISSION_SECRETARY_CREATE_REPORT = 'thư ký tạo biên bản';


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
        'Biên bản SHCN' => [
            self::PERMISSION_SECRETARY_REPORT_LIST,
            self::PERMISSION_SECRETARY_REPORT_SHOW,
            self::PERMISSION_SECRETARY_REPORT_CREATE,
            self::PERMISSION_SECRETARY_REPORT_EDIT,
            self::PERMISSION_SECRETARY_REPORT_DELETE,
            self::PERMISSION_SECRETARY_REPORT_CONFIRM,
            self::PERMISSION_SECRETARY_REPORT_DELETE_ABSENCE_STUDENT,
        ],
        'Cấp lại mật khẩu' => [
            self::PERMISSION_STUDENT_PASSWORD_LIST,
            self::PERMISSION_STUDENT_PASSWORD_UPDATE,
        ],
        'Chương Trình Đào Tạo' => [
            self::PERMISSION_TRAINING_PROGRAM_LIST,
            self::PERMISSION_CTDT_LIST,
            self::PERMISSION_CTDT_WEEK_SHOW,
            self::PERMISSION_CTDT_WEEK_CREATE,
        ],
        'Điểm môn học' => [
            self::PERMISSION_SCORE_LIST,
            self::PERMISSION_SCORE_EDIT,
        ],
        'Giảng viên' => [
            self::PERMISSION_TEACHER_LIST,
            self::PERMISSION_TEACHER_SHOW_SCHEDULE,
        ],
        'Giấy xác nhận' => [
            self::PERMISSION_STUDENT_CONFIRMATION_LIST,
            self::PERMISSION_STUDENT_CONFIRMATION_UPDATE,
        ],
        'Lịch học' => [
            self::PERMISSION_VIEW_TIMETABLE,
            self::PERMISSION_TIMETABLE_LIST,
            self::PERMISSION_TIMETABLE_CREATE,
            self::PERMISSION_TIMETABLE_UPDATE,
            self::PERMISSION_TIMETABLE_DESTROY,
            self::PERMISSION_TIMETABLE_COPY,
        ],
        'Lịch thi' => [
            self::PERMISSION_TIMETABLE_EXAM,
            self::PERMISSION_TIMETABLE_EXAM_SHOW,
            self::PERMISSION_TIMETABLE_EXAM_CREATE,
        ],
        'Lớp học' => [
            self::PERMISSION_CLASS,
            self::PERMISSION_CLASS_STUDENT_LIST,
            self::PERMISSION_CLASS_INPUT_CONDUCT_SCORE,
        ],
        'Phiếu lên lớp' => [
            self::PERMISSION_VIEW_CLASS_RECORD,
            self::PERMISSION_CREATE_CLASS_RECORD,
        ],
        'Phòng học' => [
            self::PERMISSION_ROOM_LIST,
            self::PERMISSION_ROOM_CREATE,
            self::PERMISSION_ROOM_EDIT,
        ],
        'Sinh viên' => [
            self::PERMISSION_STUDENT_LIST,
            self::PERMISSION_STUDENT_EDIT_ROLE,
        ],
        'Thông báo' => [
            self::PERMISSION_NOTICE_LIST,
            self::PERMISSION_NOTICE_SHOW,
            self::PERMISSION_NOTICE_CREATE,
            self::PERMISSION_NOTICE_EDIT,
            self::PERMISSION_NOTICE_DELETE,
            self::PERMISSION_NOTICE_CONFIRM,
        ],
    ];

    public static function groupedPermissions(): array
    {
        return self::$groupedPermissions;
    }

}
