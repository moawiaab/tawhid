<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'details' => 'الرئيسية',
                'status' => 1,
                'title' => 'dashboard_access',
            ],
            [
                'details' => 'مجموعة الشركات',
                'status' => 0,
                'title' => 'group_access',
            ],

            [
                'details' => 'الخزنة العامة',
                'status' => 1,
                'title' => 'public_treasury_access',
            ],
            [
                'details' => 'عرض الفروع',
                'status' => 0,
                'title' => 'account_access',
            ],
            [
                'details' => 'إنشاء فرع جديد',
                'status' => 0,
                'title' => 'account_create',
            ],
            [
                'details' => 'تعديل الفرع',
                'status' => 0,
                'title' => 'account_edit',
            ],
            [
                'details' => 'حذف الفرع',
                'status' => 0,
                'title' => 'account_delete',
            ],
            [
                'details' => 'عرض الأذونات',
                'status' => 0,
                'title' => 'permission_access',
            ],

            [
                'details' => 'إدارة المستخدمين',
                'status' => 1,
                'title' => 'user_management_access',
            ],
            [
                'details' => ' المالية العامة ',
                'status' => 1,
                'title' => 'financial_management_access',
            ],

            [
                'details' => 'إنشاء إذن جديد',
                'status' => 0,
                'title' => 'permission_create',
            ],
            [
                'details' => 'تعديل الإذن',
                'status' => 0,
                'title' => 'permission_edit',
            ],
            [
                'details' => 'حذف الإذن',
                'status' => 0,
                'title' => 'permission_delete',
            ],
            [
                'details' => 'عرض المستخدمين',
                'status' => 1,
                'title' => 'user_access',
            ],
            [
                'details' => 'إنشاء مستخدم جديد',
                'status' => 1,
                'title' => 'user_create',
            ],
            [
                'details' => 'تعديل المستخدم',
                'status' => 1,
                'title' => 'user_edit',
            ],
            [
                'details' => 'حذف المستخدم',
                'status' => 0,
                'title' => 'user_delete',
            ],

            [
                'details' => 'عرض الصلاحيات',
                'status' => 0,
                'title' => 'role_access',
            ],
            [
                'details' => 'إنشاء صلاحية جديدة',
                'status' => 0,
                'title' => 'role_create',
            ],
            [
                'details' => 'تعديل الصلاحية',
                'status' => 0,
                'title' => 'role_edit',
            ],
            [
                'details' => 'حذف الصلاحية',
                'status' => 0,
                'title' => 'role_delete',
            ],

            [
                'details' => 'عرض السنة المالية',
                'status' => 1,
                'title' => 'stage_access',
            ],
            [
                'details' => 'إنشاء سنة مالية جديدة',
                'status' => 1,
                'title' => 'stage_create',
            ],
            [
                'details' => 'تعديل السنة المالية',
                'status' => 1,
                'title' => 'stage_edit',
            ],
            [
                'details' => 'حذف السنة المالية',
                'status' => 1,
                'title' => 'stage_delete',
            ],

            [
                'details' => 'عرض المصروفات',
                'status' => 1,
                'title' => 'expanse_access',
            ],
            [
                'details' => 'إنشاء مصروف جديد',
                'status' => 1,
                'title' => 'expanse_create',
            ],
            [
                'details' => 'تعديل المصروف',
                'status' => 1,
                'title' => 'expanse_edit',
            ],
            [
                'details' => 'حذف المصروف',
                'status' => 1,
                'title' => 'expanse_delete',
            ],

            [
                'title' => 'private_locker_create',
                'details' => 'انشاء خزنة شخصية',
                'status' => 1,
            ],
            [
                'title' => 'private_locker_edit',
                'details' => 'تعديل  الخزنة الشخصية',
                'status' => 1,
            ],
            [
                'title' => 'private_locker_delete',
                'details' => ' تعديل الخزنة الشخصية',
                'status' => 1,
            ],
            [
                'title' => 'private_locker_access',
                'details' => ' عرض الخزائن الشخصية',
                'status' => 1,
            ],

            [
                'title' => 'budget_name_create',
                'details' => 'انشاء اسم موازنة جديدة',
                'status' => 1,
            ],
            [
                'title' => 'budget_name_edit',
                'details' => 'تعديل اسم الموازنة',
                'status' => 1,
            ],
            [
                'title' => 'budget_name_delete',
                'details' => ' تعديل  اسم الموازنة',
                'status' => 1,
            ],
            [
                'title' => 'budget_name_access',
                'details' => ' عرض اسماء الموازنة',
                'status' => 1,
            ],

            [
                'details' => 'عرض الموازنة العامة',
                'status' => 1,
                'title' => 'budget_access',
            ],
            [
                'details' => 'إنشاء موازنة جديدة',
                'status' => 1,
                'title' => 'budget_create',
            ],
            [
                'details' => 'تعديل الموازنة',
                'status' => 1,
                'title' => 'budget_edit',
            ],
            [
                'details' => 'حذف الموازنة',
                'status' => 1,
                'title' => 'budget_delete',
            ],

        ];
        Permission::insert($permissions);
    }
}
