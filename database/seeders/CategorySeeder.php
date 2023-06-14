<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create(
              [
                'nom' => 'Web Design',
                'slug' => Str::slug('Web Design')
              ],
        );
        Categorie::create(
            [
                'nom' => 'Web Dev',
                'slug' => Str::slug('Web Dev')
            ],
        );
        Categorie::create(
            [
                'nom' => 'Programming',
                'slug' => Str::slug('programming')
            ],
          );
        Categorie::create(
            [
                'nom' => 'Mobile Apps',
                'slug' => Str::slug('Mobile Apps')
            ],
          );
        Categorie::create(
            [
                'nom' => 'Frontend Dev',
                'slug' => Str::slug('Frontend Dev')
            ],
        );
    }
}
