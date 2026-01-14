<?php
// require 'kreit_firebase/vendor/autoload.php';

// require 'kreit_firebase/vendor/kreait/firebase-php/src/Firebase/Factory.php';
// require 'vendor/google/apiclient/src/Client.php';

// // use Kreait\Firebase\Exception\Messaging\NotFound;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\Messaging\CloudMessage;
// use Kreait\Firebase\Messaging\Notification;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;


require'./vendornew/autoload.php';

class Functions {

    public function __construct() {
        $this->obj = &get_instance();
        //date_default_timezone_set('Asia/Kolkata');
    }

    public function GenerateUniqueFilePrefix() {
        list($usec, $sec) = explode(" ", microtime());
        list($trash, $usec) = explode(".", $usec);
        return (date("YmdHis") . substr(($sec + $usec), -10) . '_');
    }

    function check_permission($code_name) {
                
        if($this->obj->session->userdata('id') == 1){
            return true;
        } else {
            $this->obj->db->select('*');
            $this->obj->db->where('id', $this->obj->session->userdata('id'));
            $admin_data = $this->obj->db->get('admin')->row_array();
            
            $this->obj->db->select('*');
            $this->obj->db->where('code_name', $code_name);
            $permission_data = $this->obj->db->get('permission')->row_array();

            if(!empty($permission_data)) {
                if(in_array($permission_data['permission_id'],json_decode($admin_data['permission'],true))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function getAllPages() {
        $this->obj->db->select('*');
        $this->obj->db->where('page_publish', '1');
        $this->obj->db->where('add_to_menu', '1');
        $this->obj->db->where('parent', '0');
        $this->obj->db->order_by('page_order', 'ASC');
        $query = $this->obj->db->get('page');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function getFooterPages() {
        $this->obj->db->select('*');
        $this->obj->db->where('page_publish', '1');
        $this->obj->db->where('add_to_footer', '1');        
        $this->obj->db->order_by('page_order', 'ASC');
        $query = $this->obj->db->get('page');        
        return $query->result();        
    }

    public function getPage($id) {
        $this->obj->db->select('*');
        $this->obj->db->where('page_slug', $id);

        $query = $this->obj->db->get('page');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getAllChild($page_id) {
        $this->obj->db->select('*');
        $this->obj->db->where('parent', $page_id);
        $this->obj->db->order_by('page_order', 'ASC');
        $qry = $this->obj->db->get('page');
        if ($qry->num_rows() > 0) {
            return $qry->result();
        }
    }

    public function getCurrentApp() {
        $this->obj->db->select('*');
        $this->obj->db->order_by('app_upload_id', 'DESC');
        $this->obj->db->limit('1');
        $query = $this->obj->db->get('app_upload');
        $app_upload = $query->row_array();

        $app_upload = array();
        if ($query->num_rows() > 0) {
            $app_upload = $query->row_array();
            return $app_upload['app_upload'];
        } else {
            return '';
        }
    }

    public function mysql_connection() {
        include 'database.php';

        $connection = new mysqli($hostname, $username, $password, $database);
        mysqli_set_charset($connection, "utf8");
        return $connection;
    }
    

    public function sendMessagetoAll($title, $message, $image_url = '') {
        try {
            // Path to your service account key JSON file
            $serviceAccountKeyPath = './fcm_auth.json';

            // Initialize Firebase with the service account key
            $factory = (new Factory)
                ->withServiceAccount($serviceAccountKeyPath);

            $messaging = $factory->createMessaging();

            // Create a notification message
            $notification = Notification::create($title, $message);

            // Create the CloudMessage
            $cloudMessage = CloudMessage::withTarget('topic', 'all')
                ->withNotification($notification);

            // Send the notification
            $messaging->send($cloudMessage);

            echo 'Notification sent successfully to all';
        } catch (MessagingException $e) {
            // Handle error
            echo 'Failed to send notification: ' . $e->getMessage();
        } catch (FirebaseException $e) {
            // Handle error
            echo 'Firebase error: ' . $e->getMessage();
        }
    }

    // Existing sendMessage function remains unchanged
    public function sendMessage($title, $message, $image_url = '') {
        if ($this->obj->system->one_signal_notification == '1' || $this->obj->system->one_signal_notification == 1) {
            
            $registration_ids = array();

            if ($this->obj->input->post('send_to') == 'single_member') {
                $registration_ids = $this->obj->input->post('member');
                $this->sendMessageFCM($title, $message, $image_url, $registration_ids);
            } elseif ($this->obj->input->post('send_to') == 'multi_member') {
                $this->obj->db->select('player_id');
                $this->obj->db->where('player_id !=', '');
                $this->obj->db->where('push_noti', '1');
                $this->obj->db->where('member_status', '1');
                $this->obj->db->where('member_id BETWEEN ' . $this->obj->db->escape($this->obj->input->post('multi_member_from')) . ' AND ' . $this->obj->db->escape($this->obj->input->post('multi_member_to')));
                
                // Get all the members who meet the criteria
                $members = $this->obj->db->get('member')->result_array();
                
                foreach ($members as $mem) {
                    $registration_ids = $mem['player_id'];
                    $this->sendMessageFCM($title, $message, $image_url, $registration_ids);
                }
            } elseif ($this->obj->input->post('send_to') == 'all') {
                $this->sendMessagetoAll($title, $message, $image_url);
            }
        }

    }
    
    public function sendMessageFCM($title, $message, $image_url = '', $registration_ids) {
        // ini_set('display_errors', 1);
        // error_reporting(E_ALL);
        if ($this->obj->system->one_signal_notification == '1' || $this->obj->system->one_signal_notification == 1) {
            
            $url = 'https://fcm.googleapis.com/v1/projects/gameaura-92518/messages:send';
            require_once './vendor/autoload.php';
            putenv('GOOGLE_APPLICATION_CREDENTIALS=./fcm_auth.json');
            $scope = 'https://www.googleapis.com/auth/firebase.messaging';
    
            $client = new Google\Client();
            $client->useApplicationDefaultCredentials();
            $client->setScopes($scope);
            
            $auth_key = $client->fetchAccessTokenWithAssertion();
            $accessToken = $auth_key['access_token'];
    
            
    
            $ch = curl_init();
    
            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json; charset=UTF-8',
            ];
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            
            $notificationPayload = [
                'title' => $title,
                'body' => $message,
                'image' => $image_url
            ];
    
            $androidOptions = [
                'priority' => 'high',
                'data' => [
                    'test1' => 'Test data 1',
                    'test2' => 'Test data 2',
                    'test3' => 'Test data 3'
                ]
            ];
            
            $messagePayload = [
                'message' => [
                    'token' => $registration_ids, // FCM device token
                    'notification' => $notificationPayload,
                    'android' => $androidOptions
                ]
            ];
            
            // echo json_encode($messagePayload);
            // // exit;
            
    //         $messagePayload = array(
    //     'message' => array(
    //         'token' => "cSjYAV-JTUWmDUGfdYMNfW:APA91bGr4xE452VV1Gmy1I_fzFk0E4D7fvTdLcv0qUqXVjBBY3lnma4L4Hf-FgvQSJ7D7CfU6vjN59npsJG_-CTpBkP2cglmYwqw8JD3ETcnCSR17TwKqcTOzveeSnhrWM_4xVk23zTz", // FCM device token
    //         'notification' => $notificationPayload,
    //         'android' => $androidOptions
    //     )
    // );
    
            // echo json_encode($messagePayload);
            // exit;
            
            
            // $jsonPayload = json_encode($messagePayload);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messagePayload));
            $response = curl_exec($ch);
            
            if ($response === FALSE) {
                echo "cURL Error: " . curl_error($ch);
            } else {
                $decodedResponse = json_decode($response, true);
                var_dump($decodedResponse);
            }
    
            curl_close($ch);
        }
        
        return true;
    }

//     public function sendMessage($title, $body, $image_url = '') {

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

//         // try {
//         if ($this->obj->system->one_signal_notification == '1' || $this->obj->system->one_signal_notification == 1) {
//             $jsonFilePath = 'credentials/firebase_config.json';
//             $firebase_database_url = $this->obj->system->firebase_realtime_db_url;
//             $factory = (new Factory)
//                 ->withServiceAccount($jsonFilePath)
//                 ->withDatabaseUri($firebase_database_url);
                
//             $registration_ids = array();
//             if($this->obj->input->post('send_to') == 'single_member') {
//                 $registration_ids[] = $this->obj->input->post('member');
//             } else {
//                 $this->obj->db->select('player_id');
//                 $this->obj->db->where('player_id !=','');
//                 $this->obj->db->where('push_noti','1');
//                 $this->obj->db->where('member_status','1');
                
//                 if($this->obj->input->post('send_to') == 'multi_member') {
//                     $this->obj->db->where('member_id BETWEEN "'. $this->obj->input->post('multi_member_from'). '" AND "'. $this->obj->input->post('multi_member_to'). '" ');
//                 }
                
//                 $members = $this->obj->db->get('member')->result_array();
                                     
//                 foreach($members as $mem){
//                     $registration_ids[] = $mem['player_id'];
//                 }
//             }

//             $registration_ids = array_unique($registration_ids);
//             $limitSize = 500;
//             $registrationBatches = array_chunk($registration_ids, $limitSize);
//             foreach ($registrationBatches as $l_id) {
                
//                 $notification = Notification::fromArray([
//                     'title' => $title,
//                     'body' => $body,
//                     'image' => $image_url,
//                 ]);
                
//                 $notification = Notification::create($title, $body,$image_url);
                
//                 $message = CloudMessage::fromArray([
//                     'notification' => $notification,
//                     'android' => [
//                         'priority' => 'high',
//                         'notification' => [
//                             'default_vibrate_timings' => true,
//                             'default_sound' => true,
//                             'notification_count' => 42,                            
//                             'notification_priority' => 'PRIORITY_HIGH' // PRIORITY_LOW , PRIORITY_DEFAULT , PRIORITY_HIGH , PRIORITY_MAX
//                         ],
//                     ],
//                 ]);
//                 $messaging = $factory->createMessaging();
//                 $sendReport = $messaging->sendMulticast($message, $l_id);
//             }
    		
//         }
// //         } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
// //     log_message('error', 'Messaging NotFound Exception: ' . $e->getMessage());
// // } catch (\Exception $e) {
// //     log_message('error', 'Unexpected Exception: ' . $e->getMessage());
// // }
//         return true;
//     }

    public function sendMessageMember($body, $registration_ids, $title, $match_type = '1') {
        if ($this->obj->system->one_signal_notification == '1' || $this->obj->system->one_signal_notification == 1) {
            
            $jsonFilePath = FCPATH . 'credentials/firebase_config.json';
            $firebase_database_url = $this->obj->system->firebase_realtime_db_url;
            $factory = (new Factory)
                ->withServiceAccount($jsonFilePath)
                ->withDatabaseUri($firebase_database_url);
            $notification = Notification::fromArray([
    			'title' => $title,
    			'body' => $body
    		]);
    		
    		$notification = Notification::create($title, $body);    
    		
    		$message = CloudMessage::fromArray([
    			'notification' => $notification,
                'android' => [
                    'priority' => 'high',
                    'notification' => [
                        'default_vibrate_timings' => true,
                        'default_sound' => true,
                        'notification_count' => 42,                            
                        'notification_priority' => 'PRIORITY_HIGH' // PRIORITY_LOW , PRIORITY_DEFAULT , PRIORITY_HIGH , PRIORITY_MAX
                    ],
                ],
    		]);
    		
    		$messaging = $factory->createMessaging();
            $sendReport = $messaging->sendMulticast($message, $registration_ids);
        }
        return true;
    }

    public function sendMessage_old($title, $message, $image_url = '') {
        if ($this->obj->system->one_signal_notification == '1' || $this->obj->system->one_signal_notification == 1) {
            
            $registration_ids = array();
            if($this->obj->input->post('send_to') == 'single_member') {
                $registration_ids[] = $this->obj->input->post('member');
            } else {
                $this->obj->db->select('player_id');
                $this->obj->db->where('player_id !=','');
                $this->obj->db->where('push_noti','1');
                $this->obj->db->where('member_status','1');
                
                if($this->obj->input->post('send_to') == 'multi_member') {
                    $this->obj->db->where('member_id BETWEEN "'. $this->obj->input->post('multi_member_from'). '" AND "'. $this->obj->input->post('multi_member_to'). '" ');
                }
                
                $members = $this->obj->db->get('member')->result_array();
                                     
                foreach($members as $mem){
                    $registration_ids[] = $mem['player_id'];
                }
            }
            
            $msg = array(
                'body'  => $message,
                'title' => $title,
                // 'icon'  => 'myicon',/*Default Icon*/        
                'icon'  => 'Default',                   
            );

            if($image_url != ''){
                $msg['image'] = $image_url;
            }
                
            $fields = array (
                'registration_ids' => $registration_ids,
                'notification' => $msg,        
            ); 
                             
                        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization:key=' . $this->obj->system->app_id));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $not_response = curl_exec($ch);
            
            curl_close($ch);
            
            $not_response = json_decode($not_response,true);                                            
        }

        return true;
    }

    public function sendMessageMember_old($message, $registration_ids, $title, $match_type = '1') {
        if ($this->obj->system->one_signal_notification == '1' || $this->obj->system->one_signal_notification == 1) {
            $msg = array(
                'body'  => $message,
                'title' => $title,
                // 'icon'  => 'myicon',/*Default Icon*/        
                'icon'  => 'Default',                   
            );           
                
            $fields = array (
                'registration_ids' => $registration_ids,
                'notification' => $msg,        
                );            
                        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization:key=' . $this->obj->system->app_id));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $not_response = curl_exec($ch);
            
            curl_close($ch);
            
            $not_response = json_decode($not_response,true); 
        }
        return true;
    }

    function getCurrency() {
        $this->obj->db->select('*');
        $this->obj->db->where('currency_status', '1');
        $query = $this->obj->db->get('currency');
        return $query->result();
    }

    function getCurrencySymbol($id) {
        $this->obj->db->select('currency_symbol');
        $this->obj->db->where('currency_id', $id);
        $query = $this->obj->db->get('currency');
        //echo $this->obj->db->last_query();exit;
        $row = "";
        if ($query->num_rows() > 0) {
            $row = $query->row()->currency_symbol;
        }
        return $row;
    }

    function getCurrencyDecimal($id) {
        $this->obj->db->select('currency_decimal_place');
        $this->obj->db->where('currency_id', $id);
        $query = $this->obj->db->get('currency');
        $row = "";
        if ($query->num_rows() > 0) {
            $row = $query->row()->currency_decimal_place;
        }
        return $row;
    }

    function getPoint() {
//        return '<i class="fa fa-product-hunt point"></i>';
        return '<img src="' . $this->obj->template_img . 'coin.png" style="vertical-align: sub;width:20px">';
    }

    public function getCountry() {
        $this->obj->db->select('*');
        $this->obj->db->where('country_status', '1');
        $this->obj->db->order_by('country_name', 'ASC');
        $query = $this->obj->db->get('country');
        $result = $query->result();
        return $result;
    }

    public function getCountryCodeToID($country_code) {
        $this->obj->db->select('country_id');
        $this->obj->db->where('p_code', $country_code);
        $query = $this->obj->db->get('country');
        return $query->row_array()['country_id'];
    }

    public function mask_email($email) {
        if ($email != '') {
            $mail_parts = explode("@", $email);
            $domain_parts = explode('.', $mail_parts[1]);

            $mail_parts[0] = $this->mask($mail_parts[0], 2, 1);
            $domain_parts[0] = $this->mask($domain_parts[0], 2, 1);
            $mail_parts[1] = implode('.', $domain_parts);
            return implode("@", $mail_parts);
        } else
            return "";
    }

    public function mask($str, $first, $last) {
        $len = strlen($str);
        $toShow = $first + $last;
        return substr($str, 0, $len <= $toShow ? 0 : $first) . str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)) . substr($str, $len - $last, $len <= $toShow ? 0 : $last);
    }

    public function stars($phone) {
        $times = strlen(trim(substr($phone, 5, 26)));
        $star = '';
        for ($i = 0; $i < $times; $i++) {
            $star .= '*';
        }
        return $star;
    }

    public function stars_smtp_pass($str) {
        $times = strlen($str);
        $star = '';
        for ($i = 0; $i < $times; $i++) {
            $star .= '*';
        }
        return $star;
    }

    public function getUsers() {
        $this->obj->db->select('member_id,user_name');
        $this->obj->db->where('member_status', '1');
        $query = $this->obj->db->get('member');
        return $query->result();
    }

    function getCurrencyCode($id) {
        $this->obj->db->select('currency_code');
        $this->obj->db->where('currency_id', $id);
        $query = $this->obj->db->get('currency');
        $row = "";
        if ($query->num_rows() > 0) {
            $row = $query->row()->currency_code;
        }
        return $row;
    }

}
