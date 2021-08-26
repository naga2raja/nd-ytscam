<x-app-layout>
    <x-slot name="header">
        {{-- <section class="content-header">
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
          </section> --}}
    </x-slot>

    <section class="mn-sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<div class="mn-vid-sc single_video">
						<div class="vid-1">
							<div class="vid-pr">
								<iframe width="100%" height="580" src="https://www.youtube.com/embed/{{ $videoId }}?controls=0&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div><!--vid-pr end-->
							{{-- <div class="vid-info">
								<h3>Kingdom Come: Deliverance Funny Moments and Fails Compilation</h3>
								<div class="info-pr">
									<span>60,723,169 views</span>
									<ul class="pr_links">
										<li>
											<button data-toggle="tooltip" data-placement="top" title="I like this">
												<i class="icon-thumbs_up_fill"></i>
											</button>
											<span>388K</span>
										</li>
										<li>
											<button data-toggle="tooltip" data-placement="top" title="I dislike this">
												<i class="icon-thumbs_down_fill"></i>
											</button>
											<span>28K</span>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div><!--info-pr end-->
							</div><!--vid-info end--> --}}
						</div><!--vid-1 end-->
						
						<div class="cmt-bx">
							{{-- <ul class="cmt-pr">
								<li><span>18,386</span> Comments</li>
								<li>
									<span><i class="icon-sort_by"></i><a href="#" title="">Sort By</a></span>
								</li>
							</ul> --}}
							<div class="clearfix"></div>
							<div class="clearfix"></div>
							{{-- <div class="vcp_inf pc">
								<div class="vc_hd">
									<img src="images/resources/th1.png" alt="">
								</div>
								<form>
									<input type="text" placeholder="Add a public comment">
									<button type="submit">Comment</button>
								</form>
								<div class="clearfix"></div>
								<div class="rt-cmt">
									<a href="#" title="">
										<i class="icon-cancel"></i>
									</a>
									<div class="clearfix"></div>
								</div><!--vcp_inf end-->
							</div><!--cmt-bx end--> --}}

                            <div class="history-lst tbY">
                                <div class="container">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="home_tab" data-toggle="tab" href="#home_vidz" role="tab" aria-controls="home_tab" aria-selected="true">All Comments</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="videos_taab" data-toggle="tab" href="#vvideo_tabz" role="tab" aria-controls="videos_taab" aria-selected="false">Spam Comments </a>
                                      </li>
                                    </ul><!--nav-tabs end-->
                                    <div class="clearfix"></div>
                                </div>
                            </div><!--history-lst end-->

                            <div class="tab-content p-0" id="myTabContent">
                                <div class="tab-pane fade show active" id="home_vidz" role="tabpanel" aria-labelledby="home_tab">
                                    <div class="home_tb_details">
                                        <div id="channelCommentsList"></div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="vvideo_tabz" role="tabpanel" aria-labelledby="videos_taab">
                                    <div class="spam_tb_details">
                                        <div id="videoSpamCommentsList"></div>
                                    </div>
                                </div>

                            </div>
                            
							
						</div>
					</div><!--mn-vid-sc end--->
				</div><!---col-lg-9 end-->
				<div class="col-lg-3">
					<div class="sidebar">
						<div class="vidz-prt">
							<h2 class="sm-vidz">
                                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Video owner's comments can't delete from here, since YouTube not providing delete access for owner's comments. We can delete viewer's comments.">
                                    <i class="fa fa-info"></i>
                                </button>
                            </h2>
							{{-- <h3 class="aut-vid">
								<span>Autoplay </span>
								<label class="switch">
									<input type="checkbox">
								  	<b class="slider round"></b>
								</label> 
							</h3> --}}
							<div class="clearfix"></div>
						</div><!--vidz-prt end-->
                        @if($spamWords && $spamWords->spam_words)
                        <div class="link-pr ">
                            <h2 class="ab-fd">Custom Words </h2>
                            <div class="row">
                            <ul class="col-md-6">                                                            
                                <li><a title="">{{$spamWords->spam_words}}</a></li>
                            </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @endif 

						<div class="videoo-list-ab">
                            @if($noSpamWords && $noSpamWords->spam_words)
                            <div class="link-pr ">
                                <h2 class="ab-fd">Not Spam Words </h2>
                                <div class="row">
                                <ul class="col-md-6">                                                            
                                    <li><a title="">{{$noSpamWords->spam_words}}</a></li>
                                </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            @endif							
						</div><!--videoo-list-ab end-->
					</div><!--side-bar end-->
				</div>
			</div>
		</div>
	</section><!--mn-sec end-->

    {{-- <style type="text/css">
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
    </style> --}}


    <div class="col-md-12" style="display: none;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        </div>        

        <div class="row">                         
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    

                    <div id="user_channels_list">
                        <div class="card-header current_channel_row">
                            <div class="col-md-12">
                                <a href="javascript:window.close()" class="btn btn-success pull-right mt-3"><i class="fa fa-arrow-left"> </i> Back</a>
                            </div>
                            <div style="clear:both;"></div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $videoId }}?controls=0&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>        
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        
                                        <!--
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Neutral comments" style="border: 0px;">
                                            <span class="right badge badge-warning">neu</span>
                                        </button>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Negative comments" style="border: 0px;">
                                            <span class="right badge badge-danger">neg</span>
                                        </button>                
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Positive comments" style="border: 0px;">
                                            <span class="right badge badge-success">pos</span>
                                        </button> 
                                    -->
                                    </div>
                                    <div class="col-md-12 pt-2">
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

                                {{-- <div class="col-md-12"> <marquee class="marquee_text_highlight"></marquee> </div> --}}
                            </div>

                            

                            <div class="row" id="commens_list_section">
                                <div class="col-md-6">
                                        <div id="channelCommentsList_old" class="card card-primary card-outline" style="display: none;"></div >
                                </div>
                                <div class="col-md-6">
                                        <div id="videoSpamCommentsList_old" class="card card-danger card-outline" style="display: none;"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                                        
                </div>                    
            </div>
          </div>
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
                            location.href = '{{ route("login") }}';
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
                    //list += '<h3 class="font-extrabold text-2xl p-2">'+title+' Comments</h3>';
                    list += '<div class="row pb-2">';

                    list += '<div class="col-md-4" style="margin-top:30px;"><div class="chekbox-lg float-left"><label><input type="checkbox" id="'+title+'_checkAll" value="all" onclick="SelectAll(\''+title+'\')"> <b class="checkmark"></b><span>Check All</span></label></div> <span class="active-mb mr" onclick="DeleteAll(\''+title+'\')" style="cursor:pointer; margin-left:25px">  Delete </span> </div>  ';

                    if(title == 'All') {
                        //list += '<div class="col-md-6"><div class="row"><div class="col-md-8"><input type="text" name="searchCommentText" id="searchCommentText" placeholder="Search comments" style="color: #333;" class="form-control"></div><div class="col-md-4"> <button class="btn btn-primary" onclick="searchCommentsResults()">Search </button></div> </div></div>';
                        //list += '<div class="col-md-6"><div class="input-group input-group-sm pr-1"><input type="text"  name="searchCommentText" id="searchCommentText" class="form-control" placeholder="Search"> <div class="input-group-append" onclick="searchCommentsResults()"> <div class="btn btn-primary">  <i class="fas fa-search"></i> </div> </div> </div></div>';
                        list += '<div class="col-md-8"><div class="vcp_inf pc"> <form><input type="text" name="searchCommentText" id="searchCommentText" placeholder="Search a public comment"><button type="button" onclick="searchCommentsResults()">Comment</button></form><div class="clearfix"></div><div class="rt-cmt"><a href="#" onclick="clearSearchBox()" title=""><i class="icon-cancel"></i></a><div class="clearfix"></div></div></div></div>';
                    } else {
                        list += '<div class="col-md-8"><br> <button class="btn btn-danger float-right mr-1" onclick="showAllComments(\''+videoId+'\')"><i class="fas fa-filter"></i> Find Spam</button></div>';
                    }
                    
                list += '<div style="clear:both;"></div></div>';       
                }    

                list += '<ul class="cmn-lst" style="border-top: 0px;">';
                videos = result; //.items;
                console.log('videos', videos[0]);

                var i;
                for (i = 0; i < videos.length; ++i) {
                    console.log('Parent comment id ', videos[i]['id']);
                    var publishedAt = moment(videos[i]['snippet']['topLevelComment']['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a');

                    list += '<li id="'+title+'_'+videos[i]['id']+'" class="'+title+'_comments"><div class="vcp_inf">';
                    list += '<div class="chekbox-lg"><label><input type="checkbox" id="'+title+'_cmt_'+videos[i]['id']+'" value="'+ videos[i]['id'] +'ndyt____ndyt'+videos[i]['snippet']['topLevelComment']['snippet']['textDisplay']+'" class="parent_comment" ><b class="checkmark"> </b>';    
                    list += '<div class="vc_hd"> <img src="'+ '{{ themeUrl("v2/images/resources/th2.png") }}' +'" alt=""> </div>';
                    
                    list += '<div class="coments"><h2>'+videos[i]['snippet']['topLevelComment']['snippet']['authorDisplayName']+' <small class="posted_dt"> . '+ moment(videos[i]['snippet']['topLevelComment']['snippet']['publishedAt']).fromNow()
+'</small></h2>';
                    list += '<p>'+ videos[i]['snippet']['topLevelComment']['snippet']['textDisplay']+'</p>';
                    list += '</label></div>';
                    // list +=' <div class="icheck-primary"><input type="checkbox" id="'+title+'_cmt_'+videos[i]['id']+'" class="parent_comment" value="'+ videos[i]['id'] +'ndyt____ndyt'+videos[i]['snippet']['topLevelComment']['snippet']['textDisplay']+'">';
                    

                    // list += '<label for="'+title+'_cmt_'+videos[i]['id']+'">'+ videos[i]['snippet']['topLevelComment']['snippet']['textDisplay'] +' - '+ videos[i]['snippet']['topLevelComment']['snippet']['authorDisplayName'];
                    /*
                    if(videos[i]['sentiment_status'] && videos[i]['sentiment_status'] == 'neu') {
                         list += ' <span class="right badge badge-warning"> '+videos[i]['sentiment_status']+'</span> ';
                    }
                    if(videos[i]['sentiment_status'] && videos[i]['sentiment_status'] == 'neg') {
                        list += ' <span class="right badge badge-danger"> '+videos[i]['sentiment_status']+'</span> ';
                   }
                   if(videos[i]['sentiment_status'] && videos[i]['sentiment_status'] == 'pos') {
                        list += ' <span class="right badge badge-success"> '+videos[i]['sentiment_status']+'</span> ';
                    }
                    */

                    var totalReplyCount = videos[i]['snippet']['totalReplyCount'];
                    // list += ' - '+ publishedAt +'</label>';
                    list += '</div>';
                    
                    if(videos[i]['replies'] && videos[i]['replies']['comments'] && videos[i]['replies']['comments'].length) {
                        var replies = videos[i]['replies']['comments'];
                        var j;
                        for (j = 0; j < replies.length; ++j) {
                            var replybadge = '';
                            /*
                            if(replies[j]['sentiment_status'] && replies[j]['sentiment_status'] == 'neg') {
                                replybadge += ' <span class="right badge badge-danger"> '+ replies[j]['sentiment_status']+'</span> ';
                           }
                           if(replies[j]['sentiment_status'] && replies[j]['sentiment_status'] == 'neu') {
                                replybadge += ' <span class="right badge badge-warning"> '+ replies[j]['sentiment_status']+'</span> ';
                            }
                            */
                           list += '<div class="vcp_inf" style="padding-left: 25px;"> <div class="chekbox-lg"><label> <input type="checkbox" id="child_cmt_'+title+ replies[j]['id'] +'" class="reply_comment" value="'+ replies[j]['id'] +'ndyt____ndyt'+ replies[j]['snippet']['textDisplay'] +'">  <b class="checkmark"> </b> <div class="vc_hd">  <img src="'+ '{{ themeUrl("v2/images/resources/th2.png") }}' +'" alt=""></div>  <div class="coments"> <h2>'+replies[j]['snippet']['authorDisplayName'] +' <small class="posted_dt"> . '+moment(replies[j]['snippet']['publishedAt']).fromNow()+'</small></h2> <p>' + replies[j]['snippet']['textDisplay'] + ' </p> </div><!--coments end--> </label> </div></div>';
                            console.log('TESt', replybadge, replies[j]);
                           
                            //list += '<div class="gap-3 ml-6" style="padding-left: 25px;"><div class="icheck-primary pr-2"> <input type="checkbox" id="child_cmt_'+title+ replies[j]['id'] +'" class="reply_comment" value="'+ replies[j]['id'] +'ndyt____ndyt'+ replies[j]['snippet']['textDisplay'] +'"> <label for="child_cmt_'+title+ replies[j]['id'] +'">' + replies[j]['snippet']['textDisplay'] + ' - ' + replies[j]['snippet']['authorDisplayName'] + ' ' + replybadge + ' ' + moment(replies[j]['snippet']['publishedAt']).format('MMMM Do YYYY, h:mm a') + '</label></div></div>';
                        }
                    }

                    list += '</div></div></li>';
                }

                if(videos.length == 0) {
                    list += '<li class="list-group-item">No Results Found</li>';
                }

                list += '</ul> <div style="clear:both;"></div>';
                
                if(title == 'Search') {
                    $('#searchChannelCommentsList .next_navigation').hide();
                } else {
                    $('#channelCommentsList .next_navigation').hide();
                }

                if(prevPageToken) {
                    // list += '<a onclick="showAllComments(\''+videoId+'\', \'prev\', \''+prevPageToken+'\')">Previous</a>';
                }
                if(nextPageToken && title == 'Search') {                        
                    //list += '<a class="next_navigation btn btn-success" onclick="showAllSearchComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" style="margin-top: 10px;">Load More <i class="fa fa-refresh"></i> </a>';
                    list += '<section style="padding-top: 30px;width:100%;" onclick="showAllSearchComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" class="next_navigation more_items_sec text-center"><div class="container"><svg style="cursor:pointer" width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M18.1618 24.0001H0.838235C0.374412 24.0001 0 23.6261 0 23.1628V5.86052C0 5.39727 0.374412 5.02332 0.838235 5.02332H18.1618C18.6256 5.02332 19 5.39727 19 5.86052V23.1628C19 23.6261 18.6256 24.0001 18.1618 24.0001ZM1.67647 22.3256H17.3235V6.69773H1.67647V22.3256Z" fill="#9494A0"/> <g opacity="0.25"> <path opacity="0.25" d="M13.1324 4.18605C12.6685 4.18605 12.2941 3.81209 12.2941 3.34884V1.67442H6.70589V3.34884C6.70589 3.81209 6.33148 4.18605 5.86765 4.18605C5.40383 4.18605 5.02942 3.81209 5.02942 3.34884V0.83721C5.02942 0.373954 5.40383 0 5.86765 0H13.1324C13.5962 0 13.9706 0.373954 13.9706 0.83721V3.34884C13.9706 3.81209 13.5962 4.18605 13.1324 4.18605Z" fill="#9494A0"/></g><path d="M9.50001 19.3479C9.28487 19.3479 9.06972 19.267 8.90766 19.1024L5.92634 16.1275C5.59942 15.801 5.59942 15.2707 5.92634 14.9442C6.25325 14.6177 6.78413 14.6177 7.11104 14.9442L9.50001 17.3275L11.8862 14.9442C12.2131 14.6177 12.744 14.6177 13.0709 14.9442C13.3978 15.2707 13.3978 15.801 13.0709 16.1275L10.0924 19.1024C9.93031 19.267 9.71516 19.3479 9.50001 19.3479Z" fill="#9494A0"/><path d="M9.49999 18.4186C9.03617 18.4186 8.66176 18.0447 8.66176 17.5814V10.3256C8.66176 9.86236 9.03617 9.4884 9.49999 9.4884C9.96382 9.4884 10.3382 9.86236 10.3382 10.3256V17.5814C10.3382 18.0447 9.96382 18.4186 9.49999 18.4186Z" fill="#9494A0"/><g opacity="0.5"><path opacity="0.5" d="M15.6471 6.69764C15.1832 6.69764 14.8088 6.32369 14.8088 5.86043V4.18601H4.19118V5.86043C4.19118 6.32369 3.81677 6.69764 3.35294 6.69764C2.88912 6.69764 2.51471 6.32369 2.51471 5.86043V3.34881C2.51471 2.88555 2.88912 2.5116 3.35294 2.5116H15.6471C16.1109 2.5116 16.4853 2.88555 16.4853 3.34881V5.86043C16.4853 6.32369 16.1109 6.69764 15.6471 6.69764Z" fill="#9494A0"/></g></svg></div></section>';
                } else {
                    if(nextPageToken) {                        
                        // list += '<a class="next_navigation btn btn-success" onclick="showAllComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" style="margin-top: 10px;">Load More <i class="fa fa-refresh"></i></a>';
                        list += '<section style="padding-top: 30px;width:100%;" onclick="showAllComments(\''+videoId+'\', \'next\', \''+nextPageToken+'\')" class="next_navigation more_items_sec text-center"><div class="container"><svg style="cursor:pointer" width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M18.1618 24.0001H0.838235C0.374412 24.0001 0 23.6261 0 23.1628V5.86052C0 5.39727 0.374412 5.02332 0.838235 5.02332H18.1618C18.6256 5.02332 19 5.39727 19 5.86052V23.1628C19 23.6261 18.6256 24.0001 18.1618 24.0001ZM1.67647 22.3256H17.3235V6.69773H1.67647V22.3256Z" fill="#9494A0"/> <g opacity="0.25"> <path opacity="0.25" d="M13.1324 4.18605C12.6685 4.18605 12.2941 3.81209 12.2941 3.34884V1.67442H6.70589V3.34884C6.70589 3.81209 6.33148 4.18605 5.86765 4.18605C5.40383 4.18605 5.02942 3.81209 5.02942 3.34884V0.83721C5.02942 0.373954 5.40383 0 5.86765 0H13.1324C13.5962 0 13.9706 0.373954 13.9706 0.83721V3.34884C13.9706 3.81209 13.5962 4.18605 13.1324 4.18605Z" fill="#9494A0"/></g><path d="M9.50001 19.3479C9.28487 19.3479 9.06972 19.267 8.90766 19.1024L5.92634 16.1275C5.59942 15.801 5.59942 15.2707 5.92634 14.9442C6.25325 14.6177 6.78413 14.6177 7.11104 14.9442L9.50001 17.3275L11.8862 14.9442C12.2131 14.6177 12.744 14.6177 13.0709 14.9442C13.3978 15.2707 13.3978 15.801 13.0709 16.1275L10.0924 19.1024C9.93031 19.267 9.71516 19.3479 9.50001 19.3479Z" fill="#9494A0"/><path d="M9.49999 18.4186C9.03617 18.4186 8.66176 18.0447 8.66176 17.5814V10.3256C8.66176 9.86236 9.03617 9.4884 9.49999 9.4884C9.96382 9.4884 10.3382 9.86236 10.3382 10.3256V17.5814C10.3382 18.0447 9.96382 18.4186 9.49999 18.4186Z" fill="#9494A0"/><g opacity="0.5"><path opacity="0.5" d="M15.6471 6.69764C15.1832 6.69764 14.8088 6.32369 14.8088 5.86043V4.18601H4.19118V5.86043C4.19118 6.32369 3.81677 6.69764 3.35294 6.69764C2.88912 6.69764 2.51471 6.32369 2.51471 5.86043V3.34881C2.51471 2.88555 2.88912 2.5116 3.35294 2.5116H15.6471C16.1109 2.5116 16.4853 2.88555 16.4853 3.34881V5.86043C16.4853 6.32369 16.1109 6.69764 15.6471 6.69764Z" fill="#9494A0"/></g></svg></div></section>';

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
                    var selected_comments_del = $(this).val();
                    selectedComments.push(selected_comments_del.split('ndyt____ndyt'));
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
                    var comment_del = $(this).val();
                    parentComments.push(comment_del.split('ndyt____ndyt'));
                });
                $('#'+comment_section+' .reply_comment:checked').each(function(){
                    var reply_comment_del = $(this).val();
                    replyComments.push(reply_comment_del.split('ndyt____ndyt'));
                });

                $('.loading').show();
                console.log('Delete:', selectedComments);
                $.ajax({
                    method: 'POST',
                    url: '/comments/delete',
                    data: JSON.stringify({'comments_ids': selectedComments, 'reply_comments': replyComments, 'parent_comments': parentComments, 'video_id': CurrentCommentVideoId, "_token": "{{ csrf_token() }}" }),
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

            function clearSearchBox() {
                $('#searchCommentText').val('');
            }            
            
        </script>
    @endpush
@endonce  

</x-app-layout>
