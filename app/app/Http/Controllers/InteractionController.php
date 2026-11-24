<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\SubscribeNewsletterRequest;
use App\Models\Comment;
use App\Models\NewsletterSubscriber;
use App\Models\Poll;
use App\Models\PollVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    public function storeComment(StoreCommentRequest $request)
    {
        Comment::create([
            'news_id' => $request->news_id,
            'user_id' => Auth::id(), // null untuk guest, aman karena kolom nullable
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'content' => $request->content,
            'status' => 'pending', // butuh moderasi admin
        ]);

        return back()->with('success', 'Komentar berhasil dikirim dan menunggu moderasi.');
    }

    public function votePoll(Request $request)
    {
        $request->validate([
            'poll_id' => ['required', 'exists:polls,id'],
            'option_id' => ['required', 'exists:poll_options,id'],
        ]);

        $poll = Poll::find($request->poll_id);

        // Cek apakah user sudah vote (berdasarkan IP untuk guest)
        $ip = $request->ip();
        $alreadyVoted = PollVote::where('poll_id', $poll->id)
            ->where('ip_address', $ip)
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'Anda sudah memberikan suara untuk polling ini.');
        }

        PollVote::create([
            'poll_id' => $poll->id,
            'poll_option_id' => $request->option_id,
            'user_id' => Auth::id(),
            'ip_address' => $ip,
            'user_agent' => $request->userAgent(),
        ]);

        // Update counter
        $poll->options()->where('id', $request->option_id)->increment('vote_count');
        $poll->increment('total_votes');

        return back()->with('success', 'Terima kasih, suara Anda telah tercatat.');
    }

    public function subscribeNewsletter(SubscribeNewsletterRequest $request)
    {
        NewsletterSubscriber::create([
            'email' => $request->email,
            'name' => $request->name,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return back()->with('success', 'Terima kasih telah berlangganan newsletter kami!');
    }
}