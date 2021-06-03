<x-app-layout>
    <x-slot name="header">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Video Details</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Video Details</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
    </x-slot>

    <style type="text/css">
        .Spam_comments .flex.gap-3,  .All_comments .flex.gap-3 {
            display: inline-flex;
        }        
        #commens_list_section label:not(.form-check-label):not(.custom-file-label) { font-weight: 400; }
        div#channelCommentsList, div#videoSpamCommentsList {
            max-height: 600px;
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .marquee_text_highlight {  font-weight: 600; color: red; }
    </style>

    <div class="row">
        <div class="col-md-12">
            <a href="javascript:window.close()" class="btn btn-success pull-right mt-3"><i class="fa fa-arrow-left"> </i> Back</a>
        </div>
    </div>
        <div style="clear:both;"></div>
        <br>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $videoId }}?controls=0&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>        
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                @if($spamWords && $spamWords->spam_words)
                <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title">Custom Words</h3>
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        {{ $spamWords->spam_words }} 
                    </div>
                    <!-- /.card-body -->
                  </div>
                @endIf
            </div>
            <div class="col-md-12">
                @if($noSpamWords && $noSpamWords->spam_words)
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Not Spam Words</h3>
        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            {{ $noSpamWords->spam_words }} 
                        </div>
                        <!-- /.card-body -->
                    </div>
                @endIf
            </div>
        </div>

        <div class="col-md-12"> <marquee class="marquee_text_highlight">Video owner's comments can't delete from here, since YouTube not providing delete access for owner's comments only.</marquee> </div>
    </div>

    

    <div class="row" id="commens_list_section">
        <div class="col-md-6">
                <div id="channelCommentsList" class="card card-primary card-outline" style="display: none;"></div >
        </div>
        <div class="col-md-6">
                <div id="videoSpamCommentsList" class="card card-danger card-outline" style="display: none;"></div>
        </div>
    </div    

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
                            alert(resMsg.error);
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

                    list += '<div class="col-md-6"><div class="icheck-primary  pull-left pr-2"><input type="checkbox" id="'+title+'_checkAll" value="all" onclick="SelectAll(\''+title+'\')" style="margin-left: 25px;"><label for="'+title+'_checkAll" class="ml-2">Check All</label></div> <button class="btn btn-danger" onclick="DeleteAll(\''+title+'\')"><i class="fa fa-trash"></i> </button></div>  ';

                    if(title == 'All') {
                        //list += '<div class="col-md-6"><div class="row"><div class="col-md-8"><input type="text" name="searchCommentText" id="searchCommentText" placeholder="Search comments" style="color: #333;" class="form-control"></div><div class="col-md-4"> <button class="btn btn-primary" onclick="searchCommentsResults()">Search </button></div> </div></div>';
                        list += '<div class="col-md-6"><div class="input-group input-group-sm pr-1"><input type="text"  name="searchCommentText" id="searchCommentText" class="form-control" placeholder="Search"> <div class="input-group-append" onclick="searchCommentsResults()"> <div class="btn btn-primary">  <i class="fas fa-search"></i> </div> </div> </div></div>';
                    } else {
                        list += '<div class="col-md-6"><button class="btn btn-danger pull-right mr-1" onclick="showAllComments(\''+videoId+'\')"><i class="fas fa-filter"></i> Find Spam</button></div>';
                    }
                    
                list += '<div style="clear:both;"></div></div>';       
                }    

                list += '<ul class="list-group" style="border-top: 0px;">';
                videos = result; //.items;
                console.log('videos', videos[0]);

                var i;
                for (i = 0; i < videos.length; ++i) {
                    console.log('Parent comment id ', videos[i]['id']);
                    var publishedAt = moment(videos[i]['snippet']['topLevelComment']['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a');

                    list += '<li id="'+title+'_'+videos[i]['id']+'" class="'+title+'_comments list-group-item"> <div class="icheck-primary"><input type="checkbox" id="'+title+'_cmt_'+videos[i]['id']+'" class="parent_comment" value="'+ videos[i]['id'] +'">';
                    list += '<label for="'+title+'_cmt_'+videos[i]['id']+'">'+ videos[i]['snippet']['topLevelComment']['snippet']['textDisplay'] +' - '+ videos[i]['snippet']['topLevelComment']['snippet']['authorDisplayName'];
                    if(videos[i]['sentiment_status'] && videos[i]['sentiment_status'] == 'neu') {
                         list += ' <span class="right badge badge-warning"> '+videos[i]['sentiment_status']+'</span> ';
                    }
                    if(videos[i]['sentiment_status'] && videos[i]['sentiment_status'] == 'neg') {
                        list += ' <span class="right badge badge-danger"> '+videos[i]['sentiment_status']+'</span> ';
                   }
                   if(videos[i]['sentiment_status'] && videos[i]['sentiment_status'] == 'pos') {
                        list += ' <span class="right badge badge-success"> '+videos[i]['sentiment_status']+'</span> ';
                    }

                    var totalReplyCount = videos[i]['snippet']['totalReplyCount'];
                    list += ' - '+ publishedAt +'</label>';
                    list += '</div>';
                    
                    if(videos[i]['replies'] && videos[i]['replies']['comments'] && videos[i]['replies']['comments'].length) {
                        var replies = videos[i]['replies']['comments'];
                        var j;
                        for (j = 0; j < replies.length; ++j) {
                            var replybadge = '';
                            if(replies[j]['sentiment_status'] && replies[j]['sentiment_status'] == 'neg') {
                                replybadge += ' <span class="right badge badge-danger"> '+ replies[j]['sentiment_status']+'</span> ';
                           }
                           if(replies[j]['sentiment_status'] && replies[j]['sentiment_status'] == 'neu') {
                                replybadge += ' <span class="right badge badge-warning"> '+ replies[j]['sentiment_status']+'</span> ';
                            }
                            console.log('TESt', replybadge, replies[j]);
                           
                            list += '<div class="gap-3 ml-6" style="padding-left: 25px;"><div class="icheck-primary pr-2"> <input type="checkbox" id="child_cmt_'+title+ replies[j]['id'] +'" class="reply_comment" value="'+ replies[j]['id'] +'"> <label for="child_cmt_'+title+ replies[j]['id'] +'">' + replies[j]['snippet']['textDisplay'] + ' - ' + replies[j]['snippet']['authorDisplayName'] + ' ' + replybadge + ' ' + moment(replies[j]['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a') + '</label></div></div>';
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
                    list += '<a class="next_navigation btn btn-success" onclick="showAllSearchComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" style="margin-top: 10px;">Load More <i class="fa fa-refresh"></i> </a>';
                } else {
                    if(nextPageToken) {                        
                        list += '<a class="next_navigation btn btn-success" onclick="showAllComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" style="margin-top: 10px;">Load More <i class="fa fa-refresh"></i></a>';
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
                    error: function(xhr, status, error) { 
                        console.log(error);                     
                    //   alert('Error: Your session has been Expired!');
                    //   window.location = "/log_out";
                       $('.loading').hide();
                       if(type== 'Search') {
                            searchComments();
                        } else {
                            showAllComments(CurrentCommentVideoId);
                        }
                    }
                });
            }
        </script>
    @endpush
@endonce  

</x-app-layout>
