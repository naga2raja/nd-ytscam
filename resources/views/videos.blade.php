<x-app-layout>    
    <x-slot name="header">
        {{-- <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Dashboard</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active"><a href="#">Home</a></li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section> --}}
    </x-slot>
   
<section class="vds-main">
    <div class="vidz-row">
        <div class="container">
            
            <div class="vidz_sec">
                <div class="row mb-4">
                <div class="col-md-6">
                @foreach ($channelsList as $channel)                          
                    <h3><img src="{{ $channel->snippet->thumbnails->default->url }}" width="80" style="display:none;border-radius: 50%;" >  {{ $channel->snippet->title }} Videos</h3>
                @endforeach
                </div>
                <div class="col-md-6">
                    <div class="search_form">
                        <form>
                          <input type="text" name="search_video_title" id="search_video_title" placeholder="Search Videos">
                          <button type="button" onclick="getVideosList(false, false, false, true)">
                            <i class="icon-search"></i>
                          </button>
                        </form>
                      </div>
                </div>
                <br>
                </div>

            
            <div style="clear: both"></div>
                <div class="vidz_list">
                    <div class="row" id="channelVideosList">

                    </div>
                    
                    </div>
                </div><!--vidz_list end-->
            </div><!--vidz_videos end-->
        </div>
    </div><!--vidz-row end-->

    <div class="col-md-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    
                </div>
            </div> -->
        </div>        

        <div class="row" style="display: none;">
                         
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    @if($htmlBody == '' && $channelsCount > 0)

                    <!-- {{ $channels['pageInfo']['totalResults'] }} -->
                    <!-- <h3 class="font-extrabold pt-2">Channels</h3> -->

                    <div id="user_channels_list">
                        @foreach ($channelsList as $channel)
                        
                        <div id="{{ $channel->id }}" class="card-header current_channel_row">                            
                            <h3 class="card-title" style="font-size: 1.5rem;"><img src="{{ $channel->snippet->thumbnails->default->url }}" width="80" style="border-radius: 50%;" >  {{ $channel->snippet->title }} </h3>                               
                            <!-- {{ $channel->id }}  -->
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Search Section content -->
                    <section class="content">
                        <div class="container-fluid pt-3">                            
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" id="search_video_title" name="search_video_title">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-lg btn-default" onclick="getVideosList(false, false, false, true)">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <div id="channelVideosList_old" class="card-body" style="display: none;max-height: 570px; overflow: overlay;">
                                   
                    </div>

                    @else
                        @php  
                            echo $htmlBody;
                        @endphp
                    @endif
                </div>                    
            </div>

            
            
          </div>

          @if($spamWords && $spamWords->spam_words)
            <div class="rounded-t-xl overflow-hidden bg-gradient-to-r from-purple-50 to-purple-100 bg-white pt-8" style="display: none;" id="spam_words_section"> 
                <div class="bg-pink-500 rounded-md items-center justify-center text-white text-1xl p-3 mt-0">
                    <strong>Defined Spam Words:</strong> {{ $spamWords->spam_words }}
                </div>
            </div>
          @endIf

        <div class="rounded-t-xl overflow-hidden bg-gradient-to-r from-purple-50 to-purple-100 bg-white pt-8">
            <div class="grid grid-cols-2 grid-rows-1 grid-flow-col gap-4">
                <div id="channelCommentsList" class="bg-purple-500 rounded-md items-center justify-center text-white text-1xl p-3 mt-0" style="display: none;"></div >
                <div id="videoSpamCommentsList" class="bg-purple-500 rounded-md items-center justify-center text-white text-1xl p-3" style="display: none;"></div>
            </div>
        </div>

        <div id="search_comment_section_old" style="display: none;" class="rounded-t-xl overflow-hidden bg-gradient-to-r from-purple-50 to-purple-100 bg-white pt-8">
            <div class="grid grid-cols-2 grid-rows-1 grid-flow-col gap-4">
                <div>
                    <input type="text" name="search" id="searchText" placeholder="Search comments">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="searchComments()">Search Comments</button>
                </div>
                <div id="searchChannelCommentsList" class="bg-purple-500 rounded-md items-center justify-center text-white text-1xl p-3 mt-0" style="display: none;"></div >
            </div>
        </div>



    </div>

    @once
    @push('scripts')
        <script>
            var CurrentCommentVideoId = '';
            var CurrentChannelId = '';
            var ALL_COMMENTS_ITEMS = '';
            var AllSearchText = '';
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            function getVideosList(id, type=false, token=false, searchTxt=false) {    
                 //$('.channel_item').removeClass("active");               
                 //$('#'+id).addClass("active");   
                 var id =  $(".current_channel_row").attr('id') ;
                 $('.loading').show();       
                 $('#search_comment_section').hide();   
                 var searchTitleText = '';
                 if(searchTxt)  {
                    searchTitleText = document.getElementById("search_video_title").value;
                    if(!searchTitleText || searchTitleText == '') {
                        $('.loading').hide(); 
                        $('#search_video_title').css({'border': '1px solid red'});
                        $('#search_video_title').focus();
                        return false;
                    }
                    $('#search_video_title').css('border', 'none');
                 }

                 CurrentChannelId = id;   

                 var initSection = false;
                 if(!type) {
                    var initSection = true;
                    $('#channelVideosList').html('');
                 } 

                $.ajax({
                    method: 'POST',
                    url: '/channel/videos/' + id,
                    data: JSON.stringify({'channel_id': id,  'type': type, 'token' : token, 'search': searchTitleText, '_token': '{{ csrf_token() }}' }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(result){
                        console.log(result);
                        var list = '';   
                        if(!type && !token){                                                          
                            // list += '<h4 class="font-extrabold pt-2">Channel Videos </h4>';
                        }                     
                        // list += '<div class="row">';
                        videos = result.items;

                        var i;
                        for (i = 0; i < videos.length; ++i) {
                            console.log('snippet', videos[i]['snippet']);
                            if(videos[i]['snippet']) {
                                var publishedAt = moment(videos[i]['snippet']['publishedAt']).fromNow(); //format('MMMM Do YYYY, h:mm a');

                                list += '<div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth" id="'+videos[i]["id"]["videoId"]+'" onclick="showAllComments(\''+videos[i]["id"]["videoId"]+'\')" style="cursor: pointer;"><div class="videoo">';
                                list += '<div class="vid_thumbainl"><a><img src="'+ videos[i]['snippet']['thumbnails']['medium']['url'] +'">';
                                list += '<!--<span class="vid-time">10:21</span>--> <span class="watch_later"><i class="icon-watch_later_fill"></i></span></a></div>';

                                list += '<div class="video_info"><h3><a>'+ videos[i]['snippet']['title'] +'</a></h3> <small class="posted_dt">'+ publishedAt +'</small></div>';
                                
                                list += '</div></div>';                               
                            }
                        }
                        if(videos.length == 0) {
                            list += '<div class="col-12 col-md-12"> <div class="alert alert-warning">No Videos found</div> </div>';
                        }

                        // list += '</div>';
                        $('#channelVideosList a.next_navigation, #channelVideosList .next_navigation').hide();
                        $('a.prev_navigation').hide();

                        if(result.prevPageToken) {
                            list += '<a class="prev_navigation" onclick="getVideosList(\''+id+'\', \'prev\', \''+result.prevPageToken+'\', '+ searchTxt+'\)">Previous</a>';
                        }
                        if(result.nextPageToken) {                        
                            // list += '<center><a class="next_navigation btn btn-danger"  onclick="getVideosList(\''+id+'\', \'next\', \''+result.nextPageToken+'\' ,'+ searchTxt+'\)">Load More</a></center>';

                            list += '<section style="padding-top: 30px;width:100%;" onclick="getVideosList(\''+id+'\', \'next\', \''+result.nextPageToken+'\' ,'+ searchTxt+'\)" class="next_navigation more_items_sec text-center"><div class="container"><svg style="cursor:pointer" width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M18.1618 24.0001H0.838235C0.374412 24.0001 0 23.6261 0 23.1628V5.86052C0 5.39727 0.374412 5.02332 0.838235 5.02332H18.1618C18.6256 5.02332 19 5.39727 19 5.86052V23.1628C19 23.6261 18.6256 24.0001 18.1618 24.0001ZM1.67647 22.3256H17.3235V6.69773H1.67647V22.3256Z" fill="#9494A0"/> <g opacity="0.25"> <path opacity="0.25" d="M13.1324 4.18605C12.6685 4.18605 12.2941 3.81209 12.2941 3.34884V1.67442H6.70589V3.34884C6.70589 3.81209 6.33148 4.18605 5.86765 4.18605C5.40383 4.18605 5.02942 3.81209 5.02942 3.34884V0.83721C5.02942 0.373954 5.40383 0 5.86765 0H13.1324C13.5962 0 13.9706 0.373954 13.9706 0.83721V3.34884C13.9706 3.81209 13.5962 4.18605 13.1324 4.18605Z" fill="#9494A0"/></g><path d="M9.50001 19.3479C9.28487 19.3479 9.06972 19.267 8.90766 19.1024L5.92634 16.1275C5.59942 15.801 5.59942 15.2707 5.92634 14.9442C6.25325 14.6177 6.78413 14.6177 7.11104 14.9442L9.50001 17.3275L11.8862 14.9442C12.2131 14.6177 12.744 14.6177 13.0709 14.9442C13.3978 15.2707 13.3978 15.801 13.0709 16.1275L10.0924 19.1024C9.93031 19.267 9.71516 19.3479 9.50001 19.3479Z" fill="#9494A0"/><path d="M9.49999 18.4186C9.03617 18.4186 8.66176 18.0447 8.66176 17.5814V10.3256C8.66176 9.86236 9.03617 9.4884 9.49999 9.4884C9.96382 9.4884 10.3382 9.86236 10.3382 10.3256V17.5814C10.3382 18.0447 9.96382 18.4186 9.49999 18.4186Z" fill="#9494A0"/><g opacity="0.5"><path opacity="0.5" d="M15.6471 6.69764C15.1832 6.69764 14.8088 6.32369 14.8088 5.86043V4.18601H4.19118V5.86043C4.19118 6.32369 3.81677 6.69764 3.35294 6.69764C2.88912 6.69764 2.51471 6.32369 2.51471 5.86043V3.34881C2.51471 2.88555 2.88912 2.5116 3.35294 2.5116H15.6471C16.1109 2.5116 16.4853 2.88555 16.4853 3.34881V5.86043C16.4853 6.32369 16.1109 6.69764 15.6471 6.69764Z" fill="#9494A0"/></g></svg></div></section>';
                        }

                        $('#channelVideosList').show();
                        $('#channelVideosList').append(list);
                        // $('#spam_words_section').show();
                        $('.loading').hide();
                    },
                    error: function(xhr, status, error) {                      
                      alert('Your session has been Expired!');
                      //window.location = "/log_out";
                      $('.loading').hide();
                    }
                });
            }

            function showAllComments(videoId, type=false, token=false) { 
                 $('.video_item').removeClass("active");               
                 $('#'+videoId).addClass("active");  
                // redirect to separate page
                var detail_page = "/video-details/"+videoId;
                window.open(detail_page , "_blank");
                exit;


                 $('.loading').show();   
                 CurrentCommentVideoId = videoId;
                 var initSection = false;
                 if(!type) {
                    initSection = true;
                    $('#channelCommentsList').html('');
                    $('#videoSpamCommentsList').html('');
                 }         

                var searchText = document.getElementById("searchText").value;

                $.ajax({
                    method: 'POST',
                    url: '/video/comments/' + videoId,
                    data: JSON.stringify({'video_id': videoId,  'type': type, 'token' : token, 'search': searchText }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(response){
                        console.log(response);

                        var all_comments = getCommentsList(response.all_comments.items, 'All', videoId, response.all_comments.prevPageToken, response.all_comments.nextPageToken, initSection);

                        var obj = response.spam_comments;
                        var spam_comments_arr = Object.keys(obj).map(function (key) { return obj[key]; });
                        var spam_comments = getCommentsList(spam_comments_arr, 'Spam', videoId, false, false, initSection);
                        
                        $('#channelCommentsList').show();
                        $('#channelCommentsList').append(all_comments);
                        
                        $('#videoSpamCommentsList').show();
                        $('#videoSpamCommentsList').append(spam_comments);
                        $('.loading').hide();
                        // $('#search_comment_section').show(); 
                    },
                    error: function(xhr, status, error) {                      
                      alert('Your session has been Expired!');
                     // window.location = "/log_out";
                      $('.loading').hide();
                    }
                });
            }

            function getCommentsList(result, title, videoId, prevPageToken=false, nextPageToken=false, initSection=true) {
                var list = '';     
                if(initSection) {
                    list += '<h3 class="font-extrabold text-2xl p-2">'+title+' Comments</h3>';
                    if(title == 'All') {
                        list += '<div style="width: 100%;float: right;text-align: right;"><input type="text" name="searchCommentText" id="searchCommentText" placeholder="Search comments" style="color: #333;"> <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="searchCommentsResults()">Search </button> </div>';
                    }
                    list += '<div class="inline-flex clear gap-2"><label class="inline-flex items-center"><input type="checkbox" id="'+title+'_checkAll" value="all" onclick="SelectAll(\''+title+'\')"><span class="ml-2">Check All</span></label> <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="DeleteAll(\''+title+'\')">Delete Selected </button></div>  ';
                }                   

                list += '<ul>';
                videos = result; //.items;
                console.log('videos', videos[0]);

                var i;
                for (i = 0; i < videos.length; ++i) {
                    console.log('Parent comment id ', videos[i]['id']);
                    var publishedAt = moment(videos[i]['snippet']['topLevelComment']['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a');

                    list += '<li id="'+title+'_'+videos[i]['id']+'" class="'+title+'_comments"> <div class="flex gap-3"><p><input type="checkbox" id="checkItem" class="parent_comment" value="'+ videos[i]['id'] +'"> </p>';
                    list += '<p><b>'+ videos[i]['snippet']['topLevelComment']['snippet']['textDisplay'] +' - '+ videos[i]['snippet']['topLevelComment']['snippet']['authorDisplayName'] +'</b>';
                    // if(videos[i]['paysify_status']) {
                    //     list += ' - << '+videos[i]['paysify_status']+'>> ';
                    // }

                    var totalReplyCount = videos[i]['snippet']['totalReplyCount'];
                    list += ' - '+ publishedAt +'</p>';
                    list += '</div>';
                    
                    if(videos[i]['replies'] && videos[i]['replies']['comments'] && videos[i]['replies']['comments'].length) {
                        var replies = videos[i]['replies']['comments'];
                        var j;
                        for (j = 0; j < replies.length; ++j) {
                            list += '<div class="flex gap-3 ml-6"><p> <input type="checkbox" id="checkItem" class="reply_comment" value="'+ replies[j]['id'] +'"> Reply ' + j + ': ' + replies[j]['snippet']['textDisplay'] + '</p></div>';
                        }
                    }

                    list += '</li>';
                }

                list += '</ul>';
                if(title == 'Search') {
                    $('#searchChannelCommentsList a.next_navigation').hide();
                } else {
                    $('#channelCommentsList a.next_navigation').hide();
                }

                if(prevPageToken) {
                    // list += '<a onclick="showAllComments(\''+videoId+'\', \'prev\', \''+prevPageToken+'\')">Previous</a>';
                }
                if(nextPageToken && title == 'Search') {                        
                    list += '<a class="next_navigation" onclick="showAllSearchComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')">Load More</a>';
                } else {
                    if(nextPageToken) {                        
                        list += '<a class="next_navigation" onclick="showAllComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')">Load More</a>';
                    }
                }
                console.log('nextPageToken', nextPageToken);
                        
                return list;
            }


            function SelectAll(type) {
                var isCheckedAll = $('#'+type+'_checkAll').val();
                var comment_section = 'channelCommentsList';
                if(type == 'Spam') {
                    comment_section = 'videoSpamCommentsList';
                }
                if ($('#'+type+'_checkAll').is(':checked')) {
                    $('#'+comment_section+' input[type="checkbox"]').prop("checked", true);
                } else {
                    $('#'+comment_section+' input[type="checkbox"]').prop("checked", false);
                }                
            }

            function DeleteAll(type) {
                if (!confirm("Do you want to delete?")){
                      return false;
                }

                var comment_section = 'channelCommentsList';
                if(type == 'Spam') {
                    comment_section = 'videoSpamCommentsList';
                } else if(type== 'Search') {
                    comment_section = 'searchChannelCommentsList';
                }

                var selectedComments = [];
                $('#'+comment_section+' input[type="checkbox"]:checked').each(function(){
                    selectedComments.push($(this).val());
                });

                var parentComments = [];
                var replyComments = [];
                $('#'+comment_section+' .parent_comment:checked').each(function(){
                    parentComments.push($(this).val());
                });
                $('#'+comment_section+' .reply_comment:checked').each(function(){
                    replyComments.push($(this).val());
                });

                $('.loading').show();
                console.log('Delete:', selectedComments);
                $.ajax({
                    method: 'POST',
                    url: '/comments/delete',
                    data: JSON.stringify({'comments_ids': selectedComments, 'reply_comments': replyComments, 'parent_comments': parentComments }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(result) {
                        console.log('Deleted', result);
                        $('.loading').hide();
                        if(result.status == 'Failed') {
                            alert('Failed to Delete Comments! Please upgrade your plan');
                        } else {
                            alert('Deleted successfully!');
                            if(type== 'Search') {
                                searchComments();
                            } else {
                                showAllComments(CurrentCommentVideoId);
                            }
                        }
                    },
                    // error: function(xhr, status, error) {                      
                    //   alert('Error: Your session has been Expired!');
                    //   window.location = "/log_out";
                    //   $('.loading').hide();
                    // }
                });
            }

            function searchComments() {
                if(CurrentCommentVideoId) {                    
                    var searchText = document.getElementById("searchText").value;
                    $('.loading').show();
                    // $('#searchChannelCommentsList').html('');
                    $.ajax({
                        method: 'POST',
                        url: '/comments/search',
                        data: JSON.stringify({'video_id': CurrentCommentVideoId, 'search': searchText }),
                        dataType: "json",
                        contentType: 'application/json',
                        success: function(response) {
                            console.log('Search:: ', response);
                            var all_comments = getCommentsList(response.all_comments.items, 'Search', CurrentCommentVideoId, response.all_comments.prevPageToken, response.all_comments.nextPageToken, true);

                        // var obj = response.spam_comments;
                        // var spam_comments_arr = Object.keys(obj).map(function (key) { return obj[key]; });
                        // var spam_comments = getCommentsList(spam_comments_arr, 'Spam', CurrentCommentVideoId, false, false, initSection);
                        
                        $('#searchChannelCommentsList').show();
                        $('#searchChannelCommentsList').html(all_comments);

                            $('.loading').hide();
                            
                        }

                    });
                } else {
                    alert('Please select any video');
                }

            }

            function showAllSearchComments(videoId, type, token) {
                $('.video_item').removeClass("active");               
                 $('#'+videoId).addClass("active");  
                 $('.loading').show();   
                 CurrentCommentVideoId = videoId;
                 var initSection = false; 
                 var initSection = false;
                 if(!type) {
                    initSection = true;
                 }                      

                var searchText = document.getElementById("searchText").value;

                $.ajax({
                    method: 'POST',
                    url: '/comments/search',
                    data: JSON.stringify({'video_id': videoId,  'type': type, 'token' : token, 'search': searchText }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(response){
                        console.log('Search 2:: ', response);
                        var all_comments = getCommentsList(response.all_comments.items, 'Search', CurrentCommentVideoId, response.all_comments.prevPageToken, response.all_comments.nextPageToken, initSection);
                        
                        $('#searchChannelCommentsList').show();
                        $('#searchChannelCommentsList').append(all_comments);
                        $('.loading').hide();
                    },
                    error: function(xhr, status, error) {                      
                      alert('Your session has been Expired!');
                      window.location = "/log_out";
                      $('.loading').hide();
                    }
                });
            }

            function searchCommentsResults() {
                console.log('ALL_COMMENTS_ITEMS', ALL_COMMENTS_ITEMS);
                var searchText = document.getElementById("searchCommentText").value;
                AllSearchText = searchText;
                $('.loading').show();
                $.ajax({
                    method: 'POST',
                    url: '/comments/search',
                    data: JSON.stringify({'video_id': CurrentCommentVideoId,  'type': 'all', 'token' : false, 'search': searchText }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(response){
                        var all_comments = getCommentsList(response.all_comments.items, 'All', CurrentCommentVideoId, response.all_comments.prevPageToken, response.all_comments.nextPageToken, true);                        
                        $('#channelCommentsList').show();
                        $('#channelCommentsList').html(all_comments);
                        $('.loading').hide();
                        document.getElementById("searchCommentText").value = AllSearchText;
                    },
                    error: function(xhr, status, error) {                      
                      alert('Your session has been Expired!');
                      window.location = "/log_out";
                      $('.loading').hide();
                    }
                });
                console.log(AllSearchText, 'AllSearchText');
                document.getElementById("searchCommentText").value = AllSearchText;

            }

            $(document).ready(function(){
                var channel_id =  $(".current_channel_row").attr('id') ;
                getVideosList(channel_id);
               // $("#user_channels_list > .channel-item").click();
            })

            function searchChannelVideos(id=false, type=false, token=false) {
                var initSection = false;
                 if(!type) {
                    var initSection = true;
                    $('#channelVideosList').html('');
                 } 

                var searchText = document.getElementById("search_video_title").value;
                var channel_id =  $(".current_channel_row").attr('id') ;
                var id = channel_id;

                $.ajax({
                    method: 'POST',
                    url: '/videos/search',
                    data: JSON.stringify({'channel_id' : channel_id, 'search': searchText, 'token': token, '_token': '{{ csrf_token() }}' }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(result){
                        console.log('Search Videos:: ', result); 
                        var list = '';   
                        if(!type && !token){                                                          
                            // list += '<h4 class="font-extrabold pt-2">Channel Videos </h4>';
                        } 

                        list += '<div class="row">';
                        videos = result.items;

                        var i;
                        for (i = 0; i < videos.length; ++i) {
                            var publishedAt = moment(videos[i]['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a');

                            list += '<div class="video_item col-lg-3 col-md-6 col-sm-6 col-6 full_wdth" id="'+videos[i]["id"]["videoId"]+'" onclick="showAllComments(\''+videos[i]["id"]["videoId"]+'\')" style="cursor: pointer;"><div class="videoo">';
                            list += '<div class="vid_thumbainl"><a><img src="'+ videos[i]['snippet']['thumbnails']['medium']['url'] +'">';
                            list += '<span class="vid-time">10:21</span><span class="watch_later"><i class="icon-watch_later_fill"></i></span></a></div>';

                            list += '<div class="video_info"><h3><a>'+ videos[i]['snippet']['title'] +'</a></h3> . <small class="posted_dt">'+ publishedAt +'</span>';
                            
                            list += '</div>';
                        }
                        if(videos.length == 0) {
                            list += '<li class="col-md-12"> <div class="alert alert-warning">No Videos found</div> </li>';
                        }

                        list += '</div>';
                        $('#channelVideosList a.next_navigation').hide();
                        $('a.prev_navigation').hide();

                        if(result.prevPageToken) {
                            list += '<a class="prev_navigation" onclick="searchChannelVideos(\''+id+'\', \'prev\', \''+result.prevPageToken+'\')">Previous</a>';
                        }
                        if(result.nextPageToken) {                        
                            list += '<center><a class="next_navigation btn btn-danger"  onclick="searchChannelVideos(\''+id+'\', \'next\', \''+result.nextPageToken+'\')">Load More</a></center>';
                        }

                        $('#channelVideosList').show();
                        $('#channelVideosList').append(list);

                        $('.loading').hide();
                    },
                    error: function(xhr, status, error) {                      
                      console.log(error, 'Your session has been Expired!');
                      $('.loading').hide();
                    }
                });
            }
        </script>
    @endpush
@endonce

</x-app-layout>


