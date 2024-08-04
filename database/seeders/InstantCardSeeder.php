<?php

namespace Fintech\Card\Seeders;

use Illuminate\Database\Seeder;
use Fintech\Card\Facades\Card;

class InstantCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->data();

        foreach (array_chunk($data, 200) as $block) {
            set_time_limit(2100);
            foreach ($block as $entry) {
                Card::instantCard()->create($entry);
            }
        }
    }

    private function data()
    {
        return array();
    }
}
