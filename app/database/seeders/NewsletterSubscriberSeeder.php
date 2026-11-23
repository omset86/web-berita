<?php

namespace Database\Seeders;

use App\Models\NewsletterSubscriber;
use Illuminate\Database\Seeder;

class NewsletterSubscriberSeeder extends Seeder
{
    public function run(): void
    {
        $subscribers = [
            ['email' => 'reader1@gmail.com', 'name' => 'Andi Reader'],
            ['email' => 'reader2@yahoo.com', 'name' => 'Budi Subscriber'],
            ['email' => 'reader3@outlook.com', 'name' => 'Citra Mail'],
            ['email' => 'news.fan@gmail.com', 'name' => 'Doni Fan'],
            ['email' => 'info.jakarta@gmail.com', 'name' => 'Eka Jakarta'],
            ['email' => 'tech.enthusiast@gmail.com', 'name' => 'Fajar Tech'],
            ['email' => 'sports.lover@gmail.com', 'name' => 'Gita Sports'],
            ['email' => 'biz.watcher@gmail.com', 'name' => 'Hadi Business'],
        ];

        foreach ($subscribers as $s) {
            NewsletterSubscriber::create([
                'email' => $s['email'],
                'name' => $s['name'],
                'is_active' => true,
                'subscribed_at' => now()->subDays(rand(1, 60)),
            ]);
        }
    }
}