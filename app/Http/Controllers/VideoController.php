<?php

namespace App\Http\Controllers;
use App\Models\YoutubeApiRequest;
use App\Models\UserSubscription;
use App\Models\UserSpamWord;
use App\Models\UserNoSpamWord;

use Illuminate\Http\Request;
use Auth;
use Session;
use Google_Client;
use Google_Service_YouTube;
use Config;
Use Sentiment\Analyzer;
session_start();

class VideoController extends Controller
{
    public function index()
    {    	
    	$channelsCount = 0;
    	$channelsList = [];
    	$channels = [];
		/*
		 * You can acquire an OAuth 2.0 client ID and client secret from the
		 * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
		 * For more information about using OAuth 2.0 to access Google APIs, please see:
		 * <https://developers.google.com/youtube/v3/guides/authentication>
		 * Please ensure that you have enabled the YouTube Data API for your project.
		 */
		$OAUTH2_CLIENT_ID = Config('services.google.client_id');
		$OAUTH2_CLIENT_SECRET = Config('services.google.client_secret');
		// dd($OAUTH2_CLIENT_SECRET);

		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAccessType('offline');
		// $client->setApprovalPrompt('force');


		/*
		 * This OAuth 2.0 access scope allows for full read/write access to the
		 * authenticated user's account and requires requests to use an SSL connection.
		 */
		$client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
		$httpProtocol = (@$_SERVER['HTTPS']) ? 'https://' : 'http://';
		// $redirect = filter_var($httpProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
		$redirect = $httpProtocol . $_SERVER['HTTP_HOST'] . '/index.php/video';
		$redirect = filter_var($redirect, FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);

		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);

		$htmlBody = '';

		// Check if an auth token exists for the required scopes
		$tokenSessionKey = 'token-' . $client->prepareScopes();
		if (isset($_GET['code'])) {
		  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		    die('The session state did not match.');
		  }

		  $client->authenticate($_GET['code']);
		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		  return redirect('video');
		  // header('Location: ' . $redirect);
		}

		if (isset($_SESSION[$tokenSessionKey])) {
		  $client->setAccessToken($_SESSION[$tokenSessionKey]);
		}
		 // if ($client->isAccessTokenExpired() && @$_SESSION[$tokenSessionKey] && @$_SESSION[$tokenSessionKey]['refresh_token']) {
		 // 	$refresh_token = $_SESSION[$tokenSessionKey]['refresh_token'];
     	 // 	$client->refreshToken($refresh_token);
		 // }

		$_SESSION[$tokenSessionKey] = $client->getAccessToken();
		
		// Check to ensure that the access token was successfully acquired.
		if ($client->getAccessToken()) {
		  try {
		  	$_SESSION[$tokenSessionKey] = $client->getAccessToken();
		    # All the available methods are used in sequence just for the sake of an example.
		    $queryParams = [
			    'mine' => true
			];

			if ($client->isAccessTokenExpired()){
				// return redirect('/dashboard');
				// dd('Your sessions is Expired! So delete the current token and redirect to login page.');
				$client->revokeToken(@$_SESSION[$tokenSessionKey]);
				//Destroy entire session    
				session_destroy();
				Auth::logout();
	  			return redirect('/login');
			}
			try {
			 	// Call the YouTube Data API's Channels. list method to retrieve video Channels.
				$channels = $youtube->channels->listChannels('id,snippet,statistics', $queryParams);
				$channelsCount = $channels['pageInfo']['totalResults'];
				$channelsList = $channels['items'];	
				// dd($channels);
			} catch(\Exception $e) {
				$error = $e->getMessage();
				return view('errors', compact('error'));
			}
		  } catch (Google_Service_Exception $e) {	
		    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
		        htmlspecialchars($e->getMessage()));
		  } catch (Google_Exception $e) {
		    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
		        htmlspecialchars($e->getMessage()));
		  }

		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		} else {
		  // If the user hasn't authorized the app, initiate the OAuth flow
		  $state = mt_rand();
		  $client->setState($state);
		  $_SESSION['state'] = $state;

		  $authUrl = $client->createAuthUrl();
		  return redirect($authUrl);
		  $htmlBody = <<<END
		    <h3>Authorization Required</h3>
		    <p>You need to <a href="$authUrl" style="text-decoration: underline;">authorize access</a> before proceeding.<p>
		END;
		}	
		$spamWords = UserSpamWord::where('user_id', Auth::user()->id)->selectRaw('GROUP_CONCAT(" ", spam_word, " ") as spam_words')->first();	
		return view('videos', compact('htmlBody', 'channels', 'channelsCount', 'channelsList', 'spamWords'));
    } 	

    public function videosList(Request $request, $channelId)
    {
    	$OAUTH2_CLIENT_ID = Config('services.google.client_id');
		$OAUTH2_CLIENT_SECRET = Config('services.google.client_secret');

		$videos = [];
		$videos['videos_count'] = 0;

		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAccessType('offline');

		/*
		 * This OAuth 2.0 access scope allows for full read/write access to the
		 * authenticated user's account and requires requests to use an SSL connection.
		 */
		$client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
		$httpProtocol = (@$_SERVER['HTTPS']) ? 'https://' : 'http://';
		$redirect = filter_var($httpProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
		    FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);

		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);

		// $htmlBody = '';

		// Check if an auth token exists for the required scopes
		$tokenSessionKey = 'token-' . $client->prepareScopes();
		if (isset($_GET['code'])) {
		  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		    die('The session state did not match.');
		  }

		  $client->authenticate($_GET['code']);
		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		  header('Location: ' . $redirect);
		}

		if (isset($_SESSION[$tokenSessionKey])) {
		  $client->setAccessToken($_SESSION[$tokenSessionKey]);
		}

		if ($client->getAccessToken()) {
		  // 
		    # All the available methods are used in sequence just for the sake of an example.
		    
			$queryParams = [
			    'channelId' => $channelId,
			    'channelType' => 'channelTypeUnspecified',
			    'forMine' => false,
			    'maxResults' => 12,
			    'order' => 'date',
			    'safeSearch' => 'none',
			    'type' => 'video',
			    'videoType' => 'any'
			];
			if($request->token) {
				$queryParams['pageToken'] = $request->token;
			}
			// dd($queryParams);

			$videos = $youtube->search->listSearch('snippet', $queryParams);	
			$videos['videos_count'] = $videos['pageInfo']['totalResults'];		
		}
		
    	return response()->json($videos);

    }

    public function allCommentsList(Request $request, $videoId)
    {    	
    	$OAUTH2_CLIENT_ID = Config('services.google.client_id');
		$OAUTH2_CLIENT_SECRET = Config('services.google.client_secret');

		$videoComments = [];
		
		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAccessType('offline');

		/*
		 * This OAuth 2.0 access scope allows for full read/write access to the
		 * authenticated user's account and requires requests to use an SSL connection.
		 */
		$client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
		$httpProtocol = (@$_SERVER['HTTPS']) ? 'https://' : 'http://';
		$redirect = filter_var($httpProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
		    FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);

		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);

		// $htmlBody = '';

		// Check if an auth token exists for the required scopes
		$tokenSessionKey = 'token-' . $client->prepareScopes();
		if (isset($_GET['code'])) {
		  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		    die('The session state did not match.');
		  }

		  $client->authenticate($_GET['code']);
		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		  header('Location: ' . $redirect);
		}

		if (isset($_SESSION[$tokenSessionKey])) {
		  $client->setAccessToken($_SESSION[$tokenSessionKey]);
		}

		if ($client->getAccessToken()) {
		  // 
		    # All the available methods are used in sequence just for the sake of an example.
		    
			$queryParams = [
			    'videoId' => $videoId,
    			'textFormat' => 'plainText',
    			'moderationStatus' => 'published',
    			'maxResults' => 100
			];
			if($request->token) {
				$queryParams['pageToken'] = $request->token;
			}
			// if($request->search) {
			// 	$queryParams['searchTerms'] = $request->search;
			// }
			try {
				// Call the YouTube Data API's commentThreads.list method to retrieve video comment threads.
	   			$videoComments = $youtube->commentThreads->listCommentThreads('snippet, replies', $queryParams);
	   		} catch(\Exception $e) {
	   			$errors = []; 
				$errors['status'] = 'error';
				$errors['message'] = $e->getMessage();
				return response()->json($errors);
			}
		}
		$output = [];
		$errors['status'] = 'success';
		$output['all_comments'] = $videoComments; 
		$output['spam_comments'] = $this->findSpamComments(@$videoComments['items']);
    	return response()->json($output);

    }

    public function deleteComments(Request $request)
    {
    	$commentIds = $request->comments_ids;
    	$replyComments = $request->reply_comments;
    	$parentComments = $request->parent_comments;

    	if(!$commentIds || ($commentIds && count($commentIds) == 0)) {
    		//Plz select comments to delete
    		return false;
    	} 

    	$deletedCount = $this->getApiRequestCount('delete'); 
    	$currentPlanDetails = $this->getCurrentSubscriptionPlan();
    	$deleteCommentsCount = $currentPlanDetails->delete_comments_count;
    	if($deletedCount && $deletedCount >= $deleteCommentsCount){
    		$output['status'] = 'Failed';
    		$output['message'] = 'Failed';
    		return response()->json($output);
    	}

    	$OAUTH2_CLIENT_ID = Config('services.google.client_id');
		$OAUTH2_CLIENT_SECRET = Config('services.google.client_secret');

		$videoComments = [];
		
		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAccessType('offline');

		/*
		 * This OAuth 2.0 access scope allows for full read/write access to the
		 * authenticated user's account and requires requests to use an SSL connection.
		 */
		$client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
		$httpProtocol = (@$_SERVER['HTTPS']) ? 'https://' : 'http://';
		$redirect = filter_var($httpProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
		    FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);

		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);

		// Check if an auth token exists for the required scopes
		$tokenSessionKey = 'token-' . $client->prepareScopes();
		if (isset($_GET['code'])) {
		  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		    die('The session state did not match.');
		  }

		  $client->authenticate($_GET['code']);
		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		  header('Location: ' . $redirect);
		}

		if (isset($_SESSION[$tokenSessionKey])) {
		  $client->setAccessToken($_SESSION[$tokenSessionKey]);
		}
		$htmlBody = '';
		if ($client->getAccessToken() && count($commentIds)) {
			try {

				//for parentComments
				if(count($parentComments)) {
					if($deletedCount && $deletedCount >= $deleteCommentsCount){
			    		$output['status'] = 'Failed';
			    		$output['message'] = 'Failed';
			    		return response()->json($output);
			    	}

					$deleteComentIds = implode(',', $parentComments);		  				
					$youtube->comments->setModerationStatus($deleteComentIds, 'rejected');

					$deletedCount++;

					$delete = new YoutubeApiRequest;
					$delete->user_id = Auth::user()->id;
					$delete->api_type = 'delete';
					$delete->unit_cost = '50';
					$delete->save();			
				}

				//for replies
				foreach ($replyComments as $comment) {		
					if($deletedCount && $deletedCount >= $deleteCommentsCount){
			    		$output['status'] = 'Failed';
			    		$output['message'] = 'Failed';
			    		return response()->json($output);
			    	}

					$res = $youtube->comments->delete($comment);

					$deletedCount++;

					$delete = new YoutubeApiRequest;
					$delete->user_id = Auth::user()->id;
					$delete->api_type = 'delete';
					$delete->unit_cost = '50';
					$delete->save();
				}
				$htmlBody = 'success';
			} catch (Google_Service_Exception $e) {	
		    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
		        htmlspecialchars($e->getMessage()));
		  } catch (Google_Exception $e) {
		    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
		        htmlspecialchars($e->getMessage()));
		  }

		}
		$output['status'] = 'Success';
		$output['message'] = $htmlBody;
		return response()->json($htmlBody);
    }

    public function searchComments(Request $request)
    {
    	$videoId = $request->video_id;
    	$searchComment = $request->search;

    	$OAUTH2_CLIENT_ID = Config('services.google.client_id');
		$OAUTH2_CLIENT_SECRET = Config('services.google.client_secret');

		$videoComments = [];
		
		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAccessType('offline');

		/*
		 * This OAuth 2.0 access scope allows for full read/write access to the
		 * authenticated user's account and requires requests to use an SSL connection.
		 */
		$client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
		$httpProtocol = (@$_SERVER['HTTPS']) ? 'https://' : 'http://';
		$redirect = filter_var($httpProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
		    FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);

		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);

		// $htmlBody = '';

		// Check if an auth token exists for the required scopes
		$tokenSessionKey = 'token-' . $client->prepareScopes();
		if (isset($_GET['code'])) {
		  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		    die('The session state did not match.');
		  }

		  $client->authenticate($_GET['code']);
		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		  header('Location: ' . $redirect);
		}

		if (isset($_SESSION[$tokenSessionKey])) {
		  $client->setAccessToken($_SESSION[$tokenSessionKey]);
		}

		if ($client->getAccessToken()) {
		  // 
		    # All the available methods are used in sequence just for the sake of an example.
		    
			$queryParams = [
			    'videoId' => $videoId,
    			'textFormat' => 'plainText',
    			'moderationStatus' => 'published',
    			'searchTerms' => $searchComment,
    			'maxResults' => 100
			];
			if($request->token) {
				$queryParams['pageToken'] = $request->token;
			}
			// Call the YouTube Data API's commentThreads.list method to retrieve video comment threads.
   			$videoComments = $youtube->commentThreads->listCommentThreads('snippet, replies', $queryParams);
		}
		$output = [];
		$output['all_comments'] = $videoComments; 
		$output['spam_comments'] = $this->findSpamComments(@$videoComments['items']);
    	return response()->json($output);
    }
    

    public function findSpamComments($comments)
    {
    	if(!$comments) {
    		return null;
    	}
    	$out = [];
    	$output = $comments;    
    	// $sentiment = new \PHPInsight\Sentiment();	
    	foreach ($output as $key => $value) {
    		$comment = $value['snippet']['topLevelComment']['snippet']['textDisplay'];
			$spamResults = $this->checkSpamByComment($comment);
    		// $sentimentalStatus = $this->detectSentiment($comment);

    		// $isSpam = $this->findSpamTextinSentence($comment); 
    		// $isDefinedSpam = $this->checkUserDefinedSpam($comment); 
    		// $isNoSpam = $this->checkUserDefinedNoSpam($comment); 

    		// // $out[] = $value['snippet']['topLevelComment']['snippet']['textDisplay'] . ' => '.$sentimentalStatus;

			// $spamFlag = true;

    		// if($isDefinedSpam) {

    		// } else {
	    	// 	if(($sentimentalStatus == 'pos' && !$isSpam) || $isNoSpam) {
			// 		$spamFlag = false;
	    	// 		unset($output[$key]);
	    	// 	}    			
    		// }
			$spamFlag = $spamResults['is_spam'];
			$sentimentalStatus = $spamResults['status'];
			if($spamFlag) {
				// $out[] = [ 
				// 	'id' => $value['id'], 
				// 	'topLevelComment' => $value['snippet']['topLevelComment'],
				// 	'snippet' => $value['snippet'],
				// 	'totalReplyCount' => $value['snippet']['totalReplyCount'],
				// 	'replies' => $value['replies'],
				// 	'sentiment_status' => $sentimentalStatus
				// ];
				$replySpams = [];
				if($value['replies'] && $value['replies']['comments']) {
					
					foreach($value['replies']['comments'] as $repKey => $repValue) {
						$replyComment = $repValue['snippet']['textDisplay'];
						$replySpamResults = $this->checkSpamByComment($replyComment);
						$repSpamFlag = $replySpamResults['is_spam'];
						$repSentimentalStatus = $replySpamResults['status'];
						if($repSpamFlag) {
							$repCommentValue['id'] = $repValue['id'];
							$repCommentValue['snippet'] = $repValue['snippet'];
							$repCommentValue['etag'] = $repValue['etag'];
							$repCommentValue['sentiment_status'] = $repSentimentalStatus;
							$replySpams[] = $repCommentValue;							
						}	
					}
				}
				$out[] = [ 
					'id' => $value['id'], 
					'topLevelComment' => $value['snippet']['topLevelComment'],
					'snippet' => $value['snippet'],
					'totalReplyCount' => $value['snippet']['totalReplyCount'],
					'replies' => ['comments' => $replySpams],
					'sentiment_status' => $sentimentalStatus
				];				

				$spamResults = $this->checkSpamByComment($comment);
			} else if(!$spamFlag && $value['replies'] && $value['replies']['comments'] ) {
				$replySpams = [];
				foreach($value['replies']['comments'] as $repKey => $repValue) {
					$replyComment = $repValue['snippet']['textDisplay'];
					$replySpamResults = $this->checkSpamByComment($replyComment);
					$repSpamFlag = $replySpamResults['is_spam'];
					$repSentimentalStatus = $replySpamResults['status'];
					if($repSpamFlag) {
						$repCommentValue['id'] = $repValue['id'];
						$repCommentValue['snippet'] = $repValue['snippet'];
						$repCommentValue['etag'] = $repValue['etag'];
						$repCommentValue['sentiment_status'] = $repSentimentalStatus;
						$replySpams[] = $repCommentValue;							
					}	
				}
				$out[] = [ 
					'id' => $value['id'], 
					'topLevelComment' => $value['snippet']['topLevelComment'],
					'snippet' => $value['snippet'],
					'totalReplyCount' => $value['snippet']['totalReplyCount'],
					'replies' => ['comments' => $replySpams],
					'sentiment_status' => $sentimentalStatus
				];

			}
    	}
		return $out;
    }

    public function logout()
    {
    	session_destroy();
		Auth::logout();
		$OAUTH2_CLIENT_ID = Config('services.google.client_id');
		$OAUTH2_CLIENT_SECRET = Config('services.google.client_secret');
		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAccessType('offline');
		$client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
		$httpProtocol = (@$_SERVER['HTTPS']) ? 'https://' : 'http://';
		$redirect = filter_var($httpProtocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
		    FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);

		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);
		$tokenSessionKey = 'token-' . $client->prepareScopes();
		if (isset($_GET['code'])) {
		  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		    //die('The session state did not match.');
		  }
		  $client->authenticate($_GET['code']);
		  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
		}

		if (isset($_SESSION[$tokenSessionKey])) {
		  $client->setAccessToken($_SESSION[$tokenSessionKey]);
		}
		$_SESSION[$tokenSessionKey] = $client->getAccessToken();
		$client->revokeToken(@$_SESSION[$tokenSessionKey]);
	  	return redirect('/');
    }

    public function getApiRequestCount($requestType)
    {
    	$count = 0;
    	$deletedCount = YoutubeApiRequest::where('user_id', Auth::user()->id)
    				->selectRaw('COUNT(*) as del_count')
    				->where('api_type', $requestType)
    				->first();
    	if($deletedCount && $deletedCount->del_count){
    		$count = $deletedCount->del_count;
    	}
    	return $count;
    }

    public function getCurrentSubscriptionPlan()
    {
    	$currentPlan = UserSubscription::join('subscription_plans', 'subscription_plans.id', '=', 'user_subscriptions.subscription_id')
    			->where('user_id', Auth::user()->id)
    			->where('status', 1)
    			->selectRaw('subscription_plans.name as plan, user_subscriptions.status, subscription_plans.id as plan_id, subscription_plans.delete_comments_count, subscription_plans.custom_spam_count  ')
    			->first();
    	return $currentPlan;
    }

    public function detectSentiment($string){

    	$analyzer = new Analyzer();
    	$scores  = $analyzer->getSentiment($string);
    	unset($scores['compound']);
    	$response = array_keys($scores, max($scores));
    	return $response[0];

    	$sentiment = new \PHPInsight\Sentiment();
		$scores = $sentiment->score($string);
		$response = $sentiment->categorise($string);
		if($response == 'pos' && $scores['neu'] == $scores['pos'] && $scores['pos'] == $scores['neg']) {
			$response = 'neu';
		}
		return $response;

      // $string = urlencode($string);
      // $api_key = "dc8b410977cd715bb7cff28c70bd7a";
      // $url = 'https://api.paysify.com/sentiment?api_key='.$api_key.'&string='.$string.'';
      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, $url);
      // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // $result = curl_exec($ch);
      // $response = json_decode($result,true);
      // curl_close($ch);
      // return $response;
    }

    public function findSpamTextinSentence($string) {
	    $spamTextArr = ['aaa', 'bbb', 'ccc', 'ddd', 'eee', 'fff', 'ggg', 'hhh', 'iii', 'jjj', 'kkk', 'lll', 'mmm', 'nnn', 'ooo', 'ppp', 'qqq', 'rrr', 'sss', 'ttt', 'uuu', 'vvv', 'www', 'xxx', 'yyy', 'zzz'];
	    $out = false;
	    foreach ($spamTextArr as $value) {
	      if (strpos($string, $value) !== false) { 
	        $out = true; // yes its spam
	        break;
	      }
	    }
	   	return $out;
  }

  public function checkUserDefinedSpam($string) {
  		$sentenceWords = explode(' ', $string);
  		$result = UserSpamWord::where('user_id', Auth::user()->id)
  				->whereIn('spam_word', $sentenceWords)
  				->first();
  		$out = false;
  		if($result) {
  			$out = true; // yes its spam
  		} else {
  			$spamTextArr = UserSpamWord::where('user_id', Auth::user()->id)->select('spam_word')->get()->toArray();
  			$key = array_search($string, $spamTextArr);

  			if (false !== $key)
			{
				$out = true;
			}
		   //  foreach ($spamTextArr as $value) {		    	
		   //    if (str_contains($string, $value)) { 
		   //      $out = true; // yes its spam
		   //      break;
		   //    }
		   //  }
  		}
  		return $out;
  }



  public function checkUserDefinedNoSpam($string) {
  		$sentenceWords = explode(' ', $string);
  		$result = UserNoSpamWord::where('user_id', Auth::user()->id)
  				->whereIn('word', $sentenceWords)
  				->first();
  		$out = false;
  		if($result) {
  			$out = true; // yes its spam
  		} else {
  			$spamTextArr = UserNoSpamWord::where('user_id', Auth::user()->id)->select('word')->get()->toArray();
  			$key = array_search($string, $spamTextArr);

  			if (false !== $key)
			{
				$out = true;
			}
  		}
  		return $out;
  }

  public function details(Request $request, $videoId)
  {
  	$spamWords = UserSpamWord::where('user_id', Auth::user()->id)->selectRaw('GROUP_CONCAT(" ", spam_word, " ") as spam_words')->first();
  	$noSpamWords = UserNoSpamWord::where('user_id', Auth::user()->id)->selectRaw('GROUP_CONCAT(" ", word, " ") as spam_words')->first();
  	return view('video-details', compact('videoId', 'spamWords', 'noSpamWords'));
  }

  public function checkSpamByComment($comment)
  {
	$sentimentalStatus = $this->detectSentiment($comment);

	$isSpam = $this->findSpamTextinSentence($comment); 
	$isDefinedSpam = $this->checkUserDefinedSpam($comment); 
	$isNoSpam = $this->checkUserDefinedNoSpam($comment); 
	$spamFlag = true;

	if($isDefinedSpam) {

	} else {
		if(($sentimentalStatus == 'pos' && !$isSpam) || $isNoSpam) {
			$spamFlag = false;
		}    			
	}
	return ['status' => $sentimentalStatus, 'is_spam' => $spamFlag];
  }

}
