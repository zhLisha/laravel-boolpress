<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Comico',
            'Romantico',
            'Novel',
            'Narrativa',
            'Azione',
            'Avventura',
            'Fantasy',
            'Slice of Life',
            'Horror',
            'Thriller'
        ];

        foreach($categories as $category) {
            $new_category = new Category();
            $new_category->title = $category;
            $new_category->slug = Str::slug($new_category->title, '-');
            $new_category->save();
        }
    }
}
