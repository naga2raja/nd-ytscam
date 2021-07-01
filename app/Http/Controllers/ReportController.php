<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YoutubeApiRequest;
use App\Exports\DeletionReportExport;
use Auth;
use Excel;
use App\Http\Controllers\VideoController;

class ReportController extends Controller
{
    public function index(Request $request) {
        $videoCtrl  = new VideoController;
        $plan = $videoCtrl->getCurrentSubscriptionPlan();
        if($plan->plan != 'Gold') {
            return redirect('dashboard');
        }

        $data = YoutubeApiRequest::where('user_id', Auth::user()->id)
                ->orderBy('id', 'DESC')
                ->paginate(10);

        return view('reports/list', compact('data'));
    }

    public function export(Request $request) {
        $videoCtrl  = new VideoController;
        $plan = $videoCtrl->getCurrentSubscriptionPlan();
        if($plan->plan != 'Gold') {
            return redirect('dashboard');
        }
        
        return Excel::download(new DeletionReportExport($request), 'DeletionReportExport.xlsx');
    }
}
