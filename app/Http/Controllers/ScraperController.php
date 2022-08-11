<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{
    private array $results;

    public function scrape()
    {
        $this->results = [];
        $client = new Client();
        $url = 'https://news.ycombinator.com/';
        $crawler = $client->request('GET', $url);
        
        $table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                $td->filter('a')->filter('.titlelink')->each(function ($a, $i) {
                    $this->results[] = $a->text();
                });
            });
        });

        var_dump($this->results);
        return view('scraper');
    }
}
