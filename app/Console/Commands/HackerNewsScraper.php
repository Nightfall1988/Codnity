<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use DateTimeImmutable;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;


class HackerNewsScraper extends Command
{
    protected $signature = 'scraper:hackers-news';

    protected $description = 'Scrape data from Hacker News using Symfony BrowserKit';

    public function handle()
    {
        $response = Http::get('https://news.ycombinator.com/');
        $html = $response->body();

        $crawler = new Crawler($html);

        $articles = $crawler->filter('tr.athing');

        $articles->each(function (Crawler $article, $i) {
            $rank = $article->filter('td.title > span.rank')->text();
            $title = $article->filter('td.title > span.titleline > a')->text();
            $link = $article->filter('td.title > span.titleline > a')->attr('href');

            $nextTr = $article->nextAll()->eq(0);
            $points = $nextTr->filter('span.score')->count() ? $nextTr->filter('span.score')->text() : 'N/A';
            $author = $nextTr->filter('a.hnuser')->count() ? $nextTr->filter('a.hnuser')->text() : 'N/A';
            $created_at = $nextTr->filter('span.age')->attr('title');

            $date = new DateTimeImmutable($created_at);
            $created_at = $date->format('Y-m-d H:i:s');

            $articleObj = new Article();
            $articleObj->rank = $rank;
            $articleObj->title = $title;
            $articleObj->link = $link;
            $articleObj->points = str_replace(' points', '', $points);
            $articleObj->author = $author;
            $articleObj->status = 1;
            $articleObj->date_created = $created_at;
            $articleObj->save();
        });

    }
}
