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
                'details' => 'عرض المنتجات',
                'status' => 1,
                'title' => 'product_access',
            ],
            [
                'details' => 'إنشاء منتج جديد',
                'status' => 1,
                'title' => 'product_create',
            ],
            [
                'details' => 'تعديل المنتج',
                'status' => 1,
                'title' => 'product_edit',
            ],
            [
                'details' => 'حذف المنتج',
                'status' => 1,
                'title' => 'product_delete',
            ],
            [
                'details' => 'عرض المخازن',
                'status' => 1,
                'title' => 'store_access',
            ],
            [
                'details' => 'إنشاء مخزن جديد',
                'status' => 1,
                'title' => 'store_create',
            ],
            [
                'details' => 'تعديل المخزن',
                'status' => 1,
                'title' => 'store_edit',
            ],
            [
                'details' => 'حذف المخزن',
                'status' => 1,
                'title' => 'store_delete',
            ],

            [
                'details' => 'عرض أقسام المنتجات',
                'status' => 1,
                'title' => 'category_access',
            ],
            [
                'details' => 'إنشاء قسم منتج جديدة',
                'status' => 1,
                'title' => 'category_create',
            ],
            [
                'details' => 'تعديل قسم المنتج',
                'status' => 1,
                'title' => 'category_edit',
            ],
            [
                'details' => 'حذف قسم المنتج',
                'status' => 1,
                'title' => 'category_delete',
            ],
        ];
        Permission::insert($permissions);
    }
}
