<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeApiRequest extends Model
{
    use HasFactory;

    protected $table = 'youtube_api_requests';

    public function getCreatedAtAttribute( $value ) {
       return date('d-m-Y h:i A', strtotime($value));
    }
}
