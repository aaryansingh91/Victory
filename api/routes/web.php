<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// ========================================================================
// PUBLIC ROUTES (WITHOUT SIGNATURE CHECK)
// Ye routes bina app signature ke bhi kaam karenge
// Sirf registration, login, aur initial setup ke liye
// ========================================================================
$router->group(['prefix' => '', 'middleware' => 'lang'], function () use ($router) {    
    // Basic info APIs - No signature required for first-time users
    $router->get('all_country', 'MemberController@getAllCountry');
    $router->get('all_language', 'MemberController@getAllLanguage');
    
    // // Authentication APIs - No signature for login/registration
    // $router->post('login', 'MemberController@authenticate');
    // $router->post('registrationAcc', 'MemberController@createMember');
    // $router->post('registerFB', 'MemberController@createMember_fb');
    // $router->post('registerGoogle', 'MemberController@createMember_google');
    // $router->post('checkMember', 'MemberController@checkMember');
    // $router->post('checkMobileNumber', 'MemberController@checkMobileNumber');
    // $router->post('sendOTP', 'MemberController@sendOTP');
    // $router->post('forgotpassword', 'MemberController@forgotpassword');
    
    // Payment callback APIs - External services call these
    $router->post('verifyChecksum', 'MemberController@verifyChecksum');
    $router->post('paytm_response', 'MemberController@paytmResponse');
    $router->post('paypal_response', 'MemberController@paypalResponse');
    $router->post('instamojo_response', 'MemberController@instamojoResponse');
    $router->post('razorpay_response', 'MemberController@razorpayResponse');
    $router->post('googlepay_response', 'MemberController@googlePayResponse');
    $router->post('upitranzact_response', 'MemberController@upitranzactResponse');
    $router->post('cashfree_response', 'MemberController@cashFreeResponse');
    $router->post('payu_response', 'MemberController@payuResponse'); 
    $router->post('payu_succ_fail', 'MemberController@payuSuccFail');
    $router->get('check-status', 'MemberController@checkstatus');
    
    
    $router->get('customer_support', 'MemberController@customerSupport');
        // Dashboard & Profile
    $router->get('dashboard[/{member_id}]', 'MemberController@getDashboardDetails');
    $router->get('my_profile[/{member_id}]', 'MemberController@myProfile');
    $router->get('my_refrrrals[/{member_id}]', 'MemberController@myRefrrrals');
    $router->get('my_statistics[/{member_id}]', 'MemberController@myStatistics');
    $router->post('update_myprofile', 'MemberController@updateMyprofile');
    $router->post('change_player_name', 'MemberController@changePlayerName');
    
    
    $router->get('about_us', 'MemberController@aboutUs');
    $router->get('terms_conditions', 'MemberController@termsConditions');
    $router->get('telegram_support', 'MemberController@getTelegramSupport');
});

// ========================================================================
// PROTECTED ROUTES (WITH APP SIGNATURE CHECK)
// Ye saare routes sirf verified app se hi accessible honge
// ========================================================================
$router->group(['prefix' => '', 'middleware' => ['app.signature', 'lang']], function () use ($router) {
    
    // Version check - IMPORTANT: Signature se pehle check hona chahiye
    $router->get('version[/{versionfor}]', 'MemberController@version');
    $router->get('one_signal_app', 'MemberController@oneSignalApp');
    
    // Mobile number update
    $router->post('update_mobile_no', 'MemberController@UpdateMobileNo');
    
    // Add money - Signature required
    $router->post('add_money', 'MemberController@addMoney');
    
    
    
    // Authentication APIs - No signature for login/registration
    $router->post('login', 'MemberController@authenticate');
    $router->post('registrationAcc', 'MemberController@createMember');
    $router->post('registerFB', 'MemberController@createMember_fb');
    $router->post('registerGoogle', 'MemberController@createMember_google');
    $router->post('checkMember', 'MemberController@checkMember');
    $router->post('checkMobileNumber', 'MemberController@checkMobileNumber');
    $router->post('sendOTP', 'MemberController@sendOTP');
    $router->post('forgotpassword', 'MemberController@forgotpassword');
});

// ========================================================================
// AUTHENTICATED + SIGNATURE PROTECTED ROUTES
// Ye routes dono chahiye: Login token + App signature
// ========================================================================
$router->group(['middleware' => ['app.signature', 'auth', 'lang']], function () use ($router) {
    
    // Demo
    $router->post('demo', 'MemberController@demo');
    
    // Announcements & General Info
    $router->get('announcement', 'MemberController@getAnnouncement');
    $router->get('slider', 'MemberController@getSlider');
    $router->get('banner', 'MemberController@getBanner');
    $router->get('youtube_link', 'MemberController@youTubeLink');
    
    // Games
    $router->get('all_game/{game_id}', 'MemberController@getAllGame');
    $router->get('home_game', 'MemberController@getHomeGame');
    $router->post('follow_unfollow_game', 'MemberController@followUnfollowGame');    
    $router->get('get_game_follow_status/{game_id}/{member_id}', 'MemberController@getGameFollowStatus');
    
    // Matches
    $router->get('pin_match/{member_id}/{match_id}', 'MemberController@pinMatch');
    $router->get('all_ongoing_match/{game_id}/{member_id}', 'MemberController@getAllOngoingMatch');
    $router->get('all_game_result/{game_id}/{member_id}', 'MemberController@getAllGameResult');
    $router->get('all_play_match/{game_id}/{member_id}', 'MemberController@getAllPlayMatch');
    $router->get('my_match/{member_id}', 'MemberController@getMyMatches');
    $router->get('match_participate[/{match_id}]', 'MemberController@matchParticipate');
    $router->get('single_game_result[/{match_id}]', 'MemberController@singleGameResult');
    $router->get('single_match/{match_id}/{member_id}', 'MemberController@singleMatch');
    $router->get('join_match_single[/{match_id}]', 'MemberController@joinMatchSingle');
    $router->post('join_match_process', 'MemberController@joinMatchProcess');
    

    
    // Leaderboard & Rankings
    $router->get('leader_board', 'MemberController@leadeBoard');
    $router->get('top_players', 'MemberController@topPlayers');
    $router->get('ludo_leader_board/{game_id}', 'MemberController@ludoLeaderBoard');
    
    // Lottery
    $router->get('lottery/{member_id}/{status}', 'MemberController@getAllLottery');
    $router->get('single_lottery/{lottery_id}/{member_id}/', 'MemberController@singleLottery');
    $router->post('lottery_join', 'MemberController@joinLottery');
    
    // Products
    $router->get('product', 'MemberController@getAllProduct');
    $router->get('single_product/{product_id}', 'MemberController@singleProduct');
    $router->post('product_order', 'MemberController@ProductOrder');
    $router->get('my_order/{member_id}', 'MemberController@MyOrder');
    
    // Payments & Transactions
    $router->get('payment', 'MemberController@getPayment');
    $router->get('transaction', 'MemberController@transaction');
    $router->get('withdraw_method', 'MemberController@withdrawMethod');
    $router->post('withdraw', 'MemberController@withdraw');
    $router->post('paystack_response', 'MemberController@paystackResponse');
    
    // Watch & Earn
    $router->get('watch_earn/{member_id}', 'MemberController@getWatchAndEarn');
    $router->get('watch_earn2/{member_id}', 'MemberController@getWatchAndEarn2');
    $router->get('watch_earn_detail/{member_id}', 'MemberController@getWatchAndEarnDetail');
    
    // Challenges
    $router->post('add_challenge', 'MemberController@addChallenge');
    $router->get('live_challenge_list/{game_id}', 'MemberController@liveChallengeList');
    $router->get('my_challenge_list/{game_id}', 'MemberController@myChallengeList');
    $router->get('challenge_result_list/{game_id}', 'MemberController@challengeResultList');
    $router->post('accept_challenge', 'MemberController@acceptChallenge');
    $router->post('update_challenge_room', 'MemberController@updataChallengeRoom');
    $router->post('cancel_challenge', 'MemberController@cancelChallenge');
    $router->post('challenge_result_upload', 'MemberController@challengeResultUpload');
    
    // Notifications & Social
    $router->get('notification_list/{game_id}', 'MemberController@notificationList');
    $router->get('budy_list/{game_id}', 'MemberController@budyList');
    $router->get('budy_play_request/{to_member_id}/{game_id}', 'MemberController@budyPlayRequest');
});