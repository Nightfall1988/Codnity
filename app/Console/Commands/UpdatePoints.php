<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use App\Models\Article;

class UpdatePoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates points for each article';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://news.ycombinator.com/');
        $html = $response->body();

        $crawler = new Crawler($html);

        $articles = $crawler->filter('tr.athing');

        $articles->each(function (Crawler $article, $i) {
            $title = $article->filter('td.title > span.titleline > a')->text();
            $nextTr = $article->nextAll()->eq(0);
            $points = $nextTr->filter('span.score')->count() ? $nextTr->filter('span.score')->text() : 'N/A';
            $points = str_replace(' points', '', $points);
            $articleObj = Article::where('title', '=', $title)->first();

            if ($articleObj != null) {
                $oldPoints = $articleObj->points;
                if ($articleObj->status != 0) {
                    if ($points !== $oldPoints) {
                        $articleObj->points = str_replace(' points', '', $points);
                        $articleObj->save();
                        echo "Article titled: " . $title . " - $oldPoints points updated to $articleObj->points\n";
                    }
                }
            }
        });
    }
}
