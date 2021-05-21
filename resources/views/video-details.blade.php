<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active"><a>Video Details</a></li>
          </ol>
        </nav>
    </x-slot>

    <style type="text/css">
        .Spam_comments .flex.gap-3,  .All_comments .flex.gap-3 {
            display: inline-flex;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <a href="javascript:window.close()" class="btn btn-success pull-right"><i class="fa fa-arrow-left"> </i> Back</a>
        </div>
        <div class="col-md-6 offset-md-3 col-sm-12">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $videoId }}?controls=0&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>        
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($spamWords && $spamWords->spam_words)
                <div class="alert alert-warning" role="alert">
                        <strong>Custom Words:</strong> {{ $spamWords->spam_words }} 
                </div>
            @endIf
        </div>
    </div>

    <div class="row">
        <div id="channelCommentsList" class="col-md-6" style="display: none;"></div >
        <div id="videoSpamCommentsList" class="col-md-6" style="display: none;"></div>
    </div>

@once
    @push('scripts')
        <script>
            var CurrentCommentVideoId = '';
            var ALL_COMMENTS_ITEMS = '';

            $( document ).ready(function() {
                console.log( "ready!", "{{ $videoId }}" );
                var videoId = "{{ $videoId }}"; 
                showAllComments(videoId);

            });

            function showAllComments(videoId, type=false, token=false) { 
                 $('.video_item').removeClass("active");               
                 $('#'+videoId).addClass("active"); 
                 $('.loading').show();   
                 CurrentCommentVideoId = videoId;
                 var initSection = false;
                 if(!type) {
                    initSection = true;
                    $('#channelCommentsList').html('');
                    $('#videoSpamCommentsList').html('');
                 }         

                var searchText = ''; //document.getElementById("searchText").value;

                $.ajax({
                    method: 'POST',
                    url: '/video/comments/' + videoId,
                    data: JSON.stringify({'video_id': videoId,  'type': type, 'token' : token, 'search': searchText, "_token": "{{ csrf_token() }}" }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(response){
                        console.log(response);
                        if(response.status == 'error') {
                            var resMsg = response.message;
                            alert(resMsg);
                        } else {
                            var all_comments = getCommentsList(response.all_comments.items, 'All', videoId, response.all_comments.prevPageToken, response.all_comments.nextPageToken, initSection);

                            var obj = response.spam_comments;
                            var spam_comments = '';
                            if(response && response.spam_comments) {
                                var spam_comments_arr = Object.keys(obj).map(function (key) { return obj[key]; });
                                spam_comments = getCommentsList(spam_comments_arr, 'Spam', videoId, false, false, initSection);                            
                            } 
                            else {
                                // spam_comments = 'No spam comments found';
                                var spam_comments_arr = [];
                                spam_comments = getCommentsList(spam_comments_arr, 'Spam', videoId, false, false, initSection);
                            }
                            
                            $('#channelCommentsList').show();
                            $('#channelCommentsList').append(all_comments);
                            
                            $('#videoSpamCommentsList').show();
                            $('#videoSpamCommentsList').append(spam_comments);
                        }
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
                    list += '<div class="row pb-2">';

                    list += '<div class="col-md-6"><label class="inline-flex items-center"><input type="checkbox" id="'+title+'_checkAll" value="all" onclick="SelectAll(\''+title+'\')" style="margin-left: 25px;"><span class="ml-2">Check All</span></label> <button class="btn btn-danger" onclick="DeleteAll(\''+title+'\')"><i class="fa fa-trash"></i> </button></div>  ';

                    if(title == 'All') {
                        list += '<div class="col-md-6"><div class="row"><div class="col-md-8"><input type="text" name="searchCommentText" id="searchCommentText" placeholder="Search comments" style="color: #333;" class="form-control"></div><div class="col-md-4"> <button class="btn btn-primary" onclick="searchCommentsResults()">Search </button></div> </div></div>';
                    }
                    
                list += '<div style="clear:both;"></div></div>';               
                }    

                list += '<ul class="list-group">';
                videos = result; //.items;
                console.log('videos', videos[0]);

                var i;
                for (i = 0; i < videos.length; ++i) {
                    console.log('Parent comment id ', videos[i]['id']);
                    var publishedAt = moment(videos[i]['snippet']['topLevelComment']['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a');

                    list += '<li id="'+title+'_'+videos[i]['id']+'" class="'+title+'_comments list-group-item"> <div class="flex gap-3"><p><input type="checkbox" id="checkItem" class="parent_comment" value="'+ videos[i]['id'] +'"> </p>';
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

                if(videos.length == 0) {
                    list += '<li class="list-group-item">No Results Found</li>';
                }

                list += '</ul> <div style="clear:both;"></div>';
                if(title == 'Search') {
                    $('#searchChannelCommentsList a.next_navigation').hide();
                } else {
                    $('#channelCommentsList a.next_navigation').hide();
                }

                if(prevPageToken) {
                    // list += '<a onclick="showAllComments(\''+videoId+'\', \'prev\', \''+prevPageToken+'\')">Previous</a>';
                }
                if(nextPageToken && title == 'Search') {                        
                    list += '<a class="next_navigation btn btn-success" onclick="showAllSearchComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" style="margin-left: 40%;color: #fff;margin-top: 10px;">Load More <i class="fa fa-refresh"></i> </a>';
                } else {
                    if(nextPageToken) {                        
                        list += '<a class="next_navigation btn btn-success" onclick="showAllComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" style="margin-left: 40%;color: #fff;margin-top: 10px;">Load More <i class="fa fa-refresh"></i></a>';
                    }
                }
                console.log('nextPageToken', nextPageToken);
                        
                return list;
            }

            function searchCommentsResults() {
                console.log('ALL_COMMENTS_ITEMS', ALL_COMMENTS_ITEMS);
                var searchText = document.getElementById("searchCommentText").value;
                AllSearchText = searchText;
                $('.loading').show();
                $.ajax({
                    method: 'POST',
                    url: '/comments/search',
                    data: JSON.stringify({'video_id': CurrentCommentVideoId,  'type': 'all', 'token' : false, 'search': searchText, "_token": "{{ csrf_token() }}" }),
                    dataType: "json",
                    contentType: 'application/json',
                    success: function(response){
                        console.log('Search 22:: ', response);
                        var all_comments = getCommentsList(response.all_comments.items, 'All', CurrentCommentVideoId, response.all_comments.prevPageToken, response.all_comments.nextPageToken, true);                        
                        $('#channelCommentsList').show();
                        $('#channelCommentsList').html(all_comments);
                        $('.loading').hide();
                        document.getElementById("searchCommentText").value = AllSearchText;
                    },
                    error: function(xhr, status, error) {                      
                      alert('Your session has been Expired!');
                      //window.location = "/log_out";
                      $('.loading').hide();
                    }
                });
                console.log(AllSearchText, 'AllSearchText');
                document.getElementById("searchCommentText").value = AllSearchText;

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

                if(selectedComments.length == 0) {
                    alert('Please select a comment');
                    return false;
                }

                if (!confirm("Do you want to delete?")){
                      return false;
                }

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
                    data: JSON.stringify({'comments_ids': selectedComments, 'reply_comments': replyComments, 'parent_comments': parentComments, "_token": "{{ csrf_token() }}" }),
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

        </script>
    @endpush
@endonce  

</x-app-layout>
