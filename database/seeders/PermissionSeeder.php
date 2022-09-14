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
                'details' => 'عرض الفروع',
                'title' => 'account_access',
            ],
            [
                'details' => 'إنشاء فرع جديد',
                'title' => 'account_create',
            ],
            [
                'details' => 'تعديل الفرع',
                'title' => 'account_edit',
            ],
            [
                'details' => 'حذف الفرع',
                'title' => 'account_delete',
            ],
            [
                'details' => 'عرض المستخدمين',
                'title' => 'user_access',
            ],
            [
                'details' => 'إنشاء مستخدم جديد',
                'title' => 'user_create',
            ],
            [
                'details' => 'تعديل المستخدم',
                'title' => 'user_edit',
            ],
            [
                'details' => 'حذف المستخدم',
                'title' => 'user_delete',
            ],

            [
                'details' => 'عرض الصلاحيات',
                'title' => 'role_access',
            ],
            [
                'details' => 'إنشاء صلاحية جديدة',
                'title' => 'role_create',
            ],
            [
                'details' => 'تعديل الصلاحية',
                'title' => 'role_edit',
            ],
            [
                'details' => 'حذف الصلاحية',
                'title' => 'role_delete',
            ],
        ];
        Permission::insert($permissions);
    }
}
