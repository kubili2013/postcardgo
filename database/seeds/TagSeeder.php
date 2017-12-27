<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $this->createTag('FAQ', 'faq');
        $this->createTag('Postcard', 'postcard');
        $this->createTag('Demand', 'demand');
        // give each other
        $this->createTag('GEO ', 'geo');
    }

    private function createTag($name, $slug)
    {
        factory(Tag::class)->create(compact('name', 'slug'));
    }
}
