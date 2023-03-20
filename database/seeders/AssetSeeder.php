<?php

namespace Database\Seeders;

use App\Models\AssetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assetTypes = [
            [
                'name' => 'الأصول الثابتة',
                'description' => 'هي ممتلكات طويلة الأجل وتحقق أرباح للمنشأة'
            ],
            [
                'name' => 'الأصول المتداولة',
                'description' => 'ممتلكات قصيرة الأجل ولا يتم امتلاكها أكثرمن عام'
            ]
        ];

        AssetType::create($assetTypes);
    }
}
