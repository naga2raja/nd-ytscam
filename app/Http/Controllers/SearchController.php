<?php

namespace App\Http\Controllers;

use App\Models\YoutubeApiRequest;
use App\Models\UserSubscription;
use App\Models\UserSpamWord;
use App\Models\UserNoSpamWord;

use Illuminate\Http\Request;
use Auth;
use Session;
use Google_Client;
use Google_Service_YouTube;
use Config;
Use Sentiment\Analyzer;
session_start();

class SearchController extends Controller
{
    public function searchVideos(Request $request) {
        $channelId = $request->channel_id;
        $searchText = $request->search;
        $googleApiKey = Config('services.google.api_key');
        $nextPageToken = $request->token;

        $apiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q='.$searchText.'&type=video&channelId='.$channelId.'&key='.$googleApiKey;
        if($nextPageToken) {
            $apiUrl = '&pageToken='.$nextPageToken;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;


    	return $response;

        dd($request->all());
    }
}
