<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PollSeeder extends Seeder
{
    public function run(): void
    {
        $poll = Poll::create([
            'question' => 'Siapa kandidat terbaik menurut Anda?',
            'description' => 'Polling menjelang Pemilu 2026. Satu suara per pengguna.',
            'is_active' => true,
            'allow_multiple' => false,
            'starts_at' => now()->subDays(7),
            'ends_at' => now()->addDays(30),
        ]);

        $options = [
            ['label' => 'Kandidat A', 'vote_count' => 1240],
            ['label' => 'Kandidat B', 'vote_count' => 980],
            ['label' => 'Kandidat C', 'vote_count' => 650],
        ];

        $optionModels = [];
        foreach ($options as $i => $opt) {
            $optionModels[] = PollOption::create([
                'poll_id' => $poll->id,
                'label' => $opt['label'],
                'vote_count' => $opt['vote_count'],
                'sort_order' => $i,
            ]);
        }

        // Generate dummy votes
        $users = User::all();
        foreach ($users as $user) {
            $option = $optionModels[array_rand($optionModels)];
            PollVote::create([
                'poll_id' => $poll->id,
                'poll_option_id' => $option->id,
                'user_id' => $user->id,
                'ip_address' => '127.0.0.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (Seeder)',
            ]);
        }

        $poll->update(['total_votes' => PollVote::where('poll_id', $poll->id)->count()]);
    }
}