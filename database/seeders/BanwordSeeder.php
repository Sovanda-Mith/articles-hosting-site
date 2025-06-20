<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanwordSeeder extends Seeder
{
    public function run(): void
    {
        $words = [
            'damn', 'hell', 'shit', 'fuck', 'bastard', 'bitch', 'asshole', 'dick', 'crap', 'slut',
            'piss', 'whore', 'cunt', 'fag', 'retard', 'nigger', 'chink', 'spic', 'kike', 'gook',
            'towelhead', 'terrorist', 'nazi', 'porn', 'xxx', 'blowjob', 'vagina', 'penis', 'dildo',
            'sex', 'erotic', 'rape', 'incest', 'kill', 'die', 'murder', 'bomb', 'shoot', 'stab',
            'free money', 'click here', 'win now', 'viagra', 'crypto investment', 'work from home', 'cashapp giveaway'
        ];

        foreach ($words as $word) {
            DB::table('banwords')->insert([
                'name' => $word,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
