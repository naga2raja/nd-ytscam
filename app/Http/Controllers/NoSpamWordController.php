<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSpamWord;
use App\Models\UserNoSpamWord;
use Auth;
use App\Http\Controllers\VideoController;

class NoSpamWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $spamWords = UserNoSpamWord::where('user_id', Auth::user()->id);

        $searchValue = '';
        if($request->search) {
            $searchValue = $request->search;
            $spamWords = $spamWords->where('word', 'LIKE', '%'.$searchValue.'%');

        }
        $spamWords = $spamWords->paginate(10);
        return view('no-spam/list', compact('spamWords', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spamWords = UserNoSpamWord::where('user_id', Auth::user()->id)->get()->toArray();
        $videoCtrl  = new VideoController;
        $plan = $videoCtrl->getCurrentSubscriptionPlan();
        $spamCount = $plan->custom_spam_count;
        $isPlanExpired = false;
        if(count($spamWords) >= $plan->custom_spam_count) {
            $isPlanExpired = true;
        }
        return view('no-spam/create', compact('spamWords', 'isPlanExpired'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'spam_text' => 'required',
        ]);
        $spamWordsExists = UserNoSpamWord::where('user_id', Auth::user()->id)
                        ->where('word', $request->spam_text)
                        ->first();
        if($spamWordsExists) {
            return back()->withErrors(['Word already exists'])->with('error', 'Word already exists');
        }

        $spamText = new UserNoSpamWord;
        $spamText->user_id = Auth::user()->id;
        $spamText->word = $request->spam_text;
        $spamText->status = 1;
        $spamText->save();
        return redirect('no-spam-words')->with('message','Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spamWord = UserNoSpamWord::where('user_id', Auth::user()->id)
                        ->where('id', $id)
                        ->first();
        return view('no-spam/edit', compact('spamWord'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'spam_text' => 'required',
        ]);
        $spamText = UserNoSpamWord::where('user_id', Auth::user()->id)
                        ->where('id', $id)
                        ->first();
        $spamText->user_id = Auth::user()->id;
        $spamText->word = $request->spam_text;
        $spamText->status = 1;
        $spamText->save();
        return redirect('no-spam-words')->with('message','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spamWord = UserNoSpamWord::where('user_id', Auth::user()->id)
                        ->where('id', $id)
                        ->first();
        $spamWord->delete();        
        return redirect('no-spam-words')->with('message','Deleted Successfully');
    }
}
