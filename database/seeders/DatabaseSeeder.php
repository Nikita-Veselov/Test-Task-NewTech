<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use App\Models\Blacklist;
use App\Models\Publisher;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Validation\Rules\Unique;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Site::factory()
                    ->state([
                        'site' => 'http://www.test.site',
                        'site_id' => 999
                    ])->create();


        Publisher::factory()
                    ->state([
                        'publisher' => 'Test Man-1',
                        'publisher_id' => 99
                    ])->create();

        Advertiser::factory()
                    ->state([
                        'advertiser' => 'Test Adv-1',
                        'adv_id' => 99
                    ])->create();


        Blacklist::factory()
                    ->state([
                        'publisher_id' => 99,
                        'site_id' => 999,
                        'adv_id' => 99
                    ])
                    ->create();


        Blacklist::factory()
                    ->has(Publisher::factory()
                        ->state(new Sequence(
                            fn ($sequence) => ['publisher_id' => Publisher::all()->unique()->random()],
                        ))
                    )
                    ->has(Site::factory()
                        ->state(new Sequence(
                            fn ($sequence) => ['site_id' => Site::all()->unique()->random()],
                        ))
                    )
                    ->has(Advertiser::factory()
                        ->state(new Sequence(
                            fn ($sequence) => ['adv_id' => Advertiser::all()->unique()->random()],
                        ))
                    )
                    ->count(3)
                    ->create();
    }
}
