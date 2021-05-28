<x-app-layout>    
    <x-slot name="header">
        <section class="content-header">
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
        </section>
    </x-slot>
    <style type="text/css">       
        /*.video_item.active{ background: #000; }*/
       /* .channel_item.active{ background: #000; }*/
.video_item, .channel_item {
    display: flex;
}
    </style>
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

        <div class="row">
            <div class="col-md-12">
                 @if($htmlBody == '' && $channelsCount > 0)

                 <!-- {{ $channels['pageInfo']['totalResults'] }} -->
                 <!-- <h3 class="font-extrabold pt-2">Channels</h3> -->

                <ul class="list-group" id="user_channels_list">
                    @foreach ($channelsList as $channel)
                    <li id="{{ $channel->id }}" onclick="getVideosList('{{ $channel->id }}')" class="list-group-item channel_item" style="cursor: pointer;">
                        <img src="{{ $channel->snippet->thumbnails->default->url }}" width="80" style="border-radius: 50%;" >
                        <p class="p-3"><b>{{ $channel->snippet->title }}</b></p>
                     <!-- {{ $channel->id }}  -->
                 </li>
                    @endforeach
                </ul>
                @else
                    @php  
                        echo $htmlBody;
                    @endphp
                @endif                    
            </div>

            <div id="channelVideosList" class="col-md-12" style="display: none;max-height: 372px; overflow: overlay;">
                <div >
                    
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

        <div id="search_comment_section" style="display: none;" class="rounded-t-xl overflow-hidden bg-gradient-to-r from-purple-50 to-purple-100 bg-white pt-8">
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

            function getVideosList(id, type=false, token=false) {    
                 $('.channel_item').removeClass("active");               
                 $('#'+id).addClass("active");   
                 $('.loading').show();       
                 $('#search_comment_section').hide();    

                 CurrentChannelId = id;   

                 var initSection = false;
                 if(!type) {
                    var initSection = true;
                    $('#channelVideosList').html('');
                 } 

                $.ajax({
                    method: 'POST',
                    url: '/channel/videos/' + id,
                    data: JSON.stringify({'channel_id': id,  'type': type, 'token' : token, '_token': '{{ csrf_token() }}' }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(result){
                        console.log(result);
                        var list = '';   
                        if(!type && !token){                                                          
                            list += '<h3 class="font-extrabold pt-2">Channel Videos </h3>';
                        }                     
                        list += '<ul class="list-group">';
                        videos = result.items;

                        var i;
                        for (i = 0; i < videos.length; ++i) {
                            var publishedAt = moment(videos[i]['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a');

                            list += '<li id="'+videos[i]["id"]["videoId"]+'" onclick="showAllComments(\''+videos[i]["id"]["videoId"]+'\')" class="flex gap-3 video_item list-group-item" style="cursor: pointer;">';
                            list += '<img src="'+ videos[i]['snippet']['thumbnails']['default']['url'] +'" width="120">';
                            list += '<p><b>'+ videos[i]['snippet']['title'] +'</b>';
                            list += ' - '+ publishedAt +'</p>';
                            list += '</li>';
                        }
                        if(videos.length == 0) {
                            list += '<li class="list-group-item">No Videos Found</li>';
                        }

                        list += '</ul>';
                        $('#channelVideosList a.next_navigation').hide();
                        $('a.prev_navigation').hide();

                        if(result.prevPageToken) {
                            list += '<a class="prev_navigation" onclick="getVideosList(\''+id+'\', \'prev\', \''+result.prevPageToken+'\')">Previous</a>';
                        }
                        if(result.nextPageToken) {                        
                            list += '<a class="next_navigation"  onclick="getVideosList(\''+id+'\', \'next\', \''+result.nextPageToken+'\')">Load More</a>';
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
                $("ul#user_channels_list li:first-child").click();
            })
        </script>
    @endpush
@endonce

</x-app-layout>


