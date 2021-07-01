<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsFieldToYtApiRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('youtube_api_requests', function (Blueprint $table) {
            $table->string('yt_comment_id')->nullable()->after('unit_cost');
            $table->string('yt_comment')->nullable()->after('yt_comment_id');
            $table->string('yt_video_id')->nullable()->after('yt_comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('youtube_api_requests', function (Blueprint $table) {
            //
        });
    }
}
