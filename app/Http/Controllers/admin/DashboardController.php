<?php 
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Report;
use App\Models\User;
use App\Models\Banword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function statistic()
    {
        // Count users and articles
        $userCount = User::count();
        $articleCount = Article::count();
        $reportCount = Report::count(); 
        $bannedWords = Banword::count();

        // Weekly stats from Monday to Sunday
        $weeklyStats = collect(range(0, 6))->map(function ($dayOffset) {
            $date = Carbon::now()->startOfWeek()->addDays($dayOffset);

            if ($date->isToday() || $date->isPast()) {
                return Article::whereDate('created_at', $date->toDateString())->count();
            } else {
                return 0; // Future days in the week
            }
        });

        // Top users
        $topUsers = User::withCount('articles')
            ->orderByDesc('articles_count') //Laravel automatically appends a virtual column called articles_count to each User object.
            ->take(10)
            ->get(['name']) // or 'username'
            ->map(function ($user): array {
                return [
                    'name' => $user->name,
                    'articles' => $user->articles_count,
                ];
        });
        return response()->json([
            'user_count' => $userCount,
            'article_count' => $articleCount,
            'report_count' => $reportCount,
            'banned_word_count' => $bannedWords,
            'weekly_articles' => $weeklyStats,
            'top_users' => $topUsers,
        ]);
    }
}