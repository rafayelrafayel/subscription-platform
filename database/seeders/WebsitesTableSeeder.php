<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Website;
class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = [
            ['name' => 'Google', 'url' => 'https://www.google.com'],
            ['name' => 'Facebook', 'url' => 'https://www.facebook.com'],
            ['name' => 'Twitter', 'url' => 'https://www.twitter.com'],
        ];

        foreach ($websites as $website) {
            Website::create($website);
        }
    }
}
