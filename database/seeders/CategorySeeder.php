<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // categories : Hardware,laminate, veneer, louvers & decorative sheets, modular kitchen, sofa curtain
        Category::firstOrCreate(['name' => 'Hardware', 'slug' => 'hardware']);
        Category::firstOrCreate(['name' => 'Laminate', 'slug' => 'laminate']);
        Category::firstOrCreate(['name' => 'Veneer', 'slug' => 'veneer']);
        Category::firstOrCreate(['name' => 'Louvers & Decorative Sheets', 'slug' => 'louvers-decorative-sheets']);
        Category::firstOrCreate(['name' => 'Modular Kitchen', 'slug' => 'modular-kitchen']);
        Category::firstOrCreate(['name' => 'Sofa Curtain', 'slug' => 'sofa-curtain']);
    }
}
