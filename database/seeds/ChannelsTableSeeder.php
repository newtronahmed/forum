<?php

use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'laravel 8',
            'slug' => Str::slug('laravel 8'),
        ]);
        Channel::create([
            'name'=>'react js developers',
            'slug' => Str::slug('react js developers'),
            
        ]);
        Channel::create([
            'name'=> 'programmer jokes from reddit',
            'slug' => Str::slug('programmer jokes from reddit'),
        ]);
    }
}
