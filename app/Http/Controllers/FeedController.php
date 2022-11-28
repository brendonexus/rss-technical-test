<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FeedController extends Controller
{

    public function getFeed(): bool
    {

        $this->deleteFeed();

        $feed = Http::get('https://feeds.simplecast.com/54nAGcIl')->body();

        $xml = simplexml_load_string($feed);

        $json = json_encode($xml);

        $records = json_decode($json, true);

        $i = 0;

        $feedItems = [];

        foreach($records['channel']['item'] AS $record){
            $feedItems[] = [
                'title' => $record['title'],
                'link' => $record['link'],
                'publish_date' => Carbon::make($record['pubDate'])
            ];
            $i++;
            if ($i >= 20){
                break;
            }
        }

        if ($this->saveFeed($feedItems)){

            $records = [];

            foreach(Feed::all() AS $record){
                $records[] = [
                    'title' => $record['title'],
                    'link' => $record['link'],
                    'publish_date' => $record['publish_date']
                ];
            }

            echo json_encode($records);

        }

        return false;

    }

    private function SaveFeed($feed): bool
    {

        if (!Feed::insert($feed)){
            return false;
        }

        return true;

    }

    private function DeleteFeed(): bool
    {

        if (Feed::truncate()){

            return true;

        }

        return false;

    }

}
