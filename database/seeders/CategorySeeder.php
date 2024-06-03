<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['id' => 1, 'name' => 'Blog Posts', 'code' => 'blog', 'type' => 'original', 'description' => 'Content for the generating articles, blog post'],
            ['id' => 2, 'name' => 'Emails', 'code' => 'email', 'type' => 'original', 'description' => 'Creative templates for email creation'],
            ['id' => 3, 'name' => 'Other', 'code' => 'other', 'type' => 'original', 'description' => 'Rest of the user tools that you can use'],
            ['id' => 4, 'name' => 'Social Media', 'code' => 'social', 'type' => 'original', 'description' => 'Flash tools for social media content'],
            ['id' => 5, 'name' => 'Contents', 'code' => 'text', 'type' => 'original', 'description' => 'Tools for writing creatives for different moods and tasks'],
            ['id' => 6, 'name' => 'Video', 'code' => 'video', 'type' => 'original', 'description' => 'Video creation tools from idea to script for millions of views'],
            ['id' => 7, 'name' => 'Websites', 'code' => 'web', 'type' => 'original', 'description' => 'Useful contents for websites'],
            ['id' => 8, 'name' => 'Marketing', 'code' => 'marketing', 'type' => 'original', 'description' => 'Professional PR tools for brand and business'],
            ['id' => 9, 'name' => 'Ads', 'code' => 'ad', 'type' => 'original', 'description' => 'Create ads much faster and be more creative'],
            ['id' => 10, 'name' => 'SEO', 'code' => 'seo', 'type' => 'original', 'description' => 'Search engine optimization related tools'],
            ['id' => 11, 'name' => 'Frameworks', 'code' => 'framework', 'type' => 'original', 'description' => 'The best marketing copywriting tools'],
            ['id' => 12, 'name' => 'Ecommerce', 'code' => 'ecommerce', 'type' => 'original', 'description' => 'Powerful tools for e-commerce, listings of your products'],

        ];

        foreach ($ads as $ad) {
            Category::updateOrCreate(['id' => $ad['id']], $ad);
        }
    }
}
