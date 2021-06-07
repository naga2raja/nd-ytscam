<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\VideoController;

class SentimentAnalysisController extends Controller
{
    public function index(Request $request) {
       return view('sentiment-analysis/analysis');
    }

    public function analysis(Request $request) {
        $request->validate([
            'comment' => 'required',
        ]);
        $videoController = new VideoController;
        $comment = trim($request->comment);
        $spamResults = $videoController->checkSpamByComment($comment);
        $spamFlag = $spamResults['is_spam'];
		$sentimentalStatus = $spamResults['status'];
        $isDefinedSpam = $spamResults['is_defined_spam'];
        
       return view('sentiment-analysis/analysis', compact(['comment', 'spamFlag', 'sentimentalStatus', 'isDefinedSpam']));
    }
}
