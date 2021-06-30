<?php

namespace App\Exports;

use App\Models\YoutubeApiRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Auth;

class DeletionReportExport implements FromCollection, WithHeadings
{
    protected $request;

    function __construct($request) {
            $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return YoutubeApiRequest::where('user_id', Auth::user()->id)
                ->select('yt_comment_id', 'yt_comment', 'yt_video_id', 'created_at')
                ->orderBy('id', 'DESC')
                ->get();
    }

    public function headings(): array
    {
        return [
            'COMMENT ID', 'COMMENT', 'VIDEO ID', 'CREATED AT'
        ];
    }
}
