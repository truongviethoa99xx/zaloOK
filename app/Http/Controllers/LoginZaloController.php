<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zalo\Zalo;
use Zalo\ZaloEndpoint;
use Zalo\Builder\MessageBuilder;
use Zalo\ZaloHttpClient;
use Zalo\FileUpload\ZaloFile;

use Session;

class LoginZaloController extends Controller
{
    public function index(){
        $config = array(
            'app_id' => '2179263249591877268',
            'app_secret' => 'whiB4K485YMXP2Pt0F72',
            'callback_url' => 'https://990f-113-177-118-179.ngrok.io/chat'
        );
        $zalo = new Zalo($config);
        $helper = $zalo -> getRedirectLoginHelper();
        $callbackUrl = "https://990f-113-177-118-179.ngrok.io/chat";
        $loginUrl = $helper->getLoginUrl($callbackUrl);
        return redirect($loginUrl);
    }

    public function getToken() {
        $config = array(
            'app_id' => '2179263249591877268',
            'app_secret' => 'whiB4K485YMXP2Pt0F72',
            'callback_url' => 'https://990f-113-177-118-179.ngrok.io/chat'
        );
        $zalo = new Zalo($config);
        $helper = $zalo -> getRedirectLoginHelper();
        $callBackUrl = "https://990f-113-177-118-179.ngrok.io/chat";
        $oauthCode = isset($_GET['code']) ? $_GET['code'] : "THIS NOT CALLBACK PAGE !!!"; // get oauthoauth code from url params
        $accessToken = $helper->getAccessToken($callBackUrl); // get access token
        if ($accessToken != null) {
            $expires = $accessToken->getExpiresAt(); // get expires time
        }
        //dd($accessToken);
        Session::put('access_token', $accessToken->getValue()); // save access token to session
        $params = ['offset' => 0, 'limit' => 10, 'fields' => "id, name"];
        $response = $zalo->get(ZaloEndpoint::API_GRAPH_FRIENDS,$accessToken->getValue(), $params);
        $result = $response->getDecodedBody(); // result
        dd($result);
    }
// ///////////////////
    public function officalAccount() {
        $config = array(
            'app_id' => '2179263249591877268',
            'app_secret' => 'whiB4K485YMXP2Pt0F72',
            'callback_url' => 'https://990f-113-177-118-179.ngrok.io/test'
        );
        $zalo = new Zalo($config);
        $helper = $zalo -> getRedirectLoginHelper();
        $callbackPageUrl = "https://990f-113-177-118-179.ngrok.io/test";
        $linkOAGrantPermission2App = $helper->getLoginUrlByPage($callbackPageUrl);
        dd($linkOAGrantPermission2App);
    }
    
    public function test(){
        $config = array(
            'app_id' => '2179263249591877268',
            'app_secret' => 'whiB4K485YMXP2Pt0F72',
            'callback_url' => 'https://990f-113-177-118-179.ngrok.io/test'
        );
        $zalo = new Zalo($config);
        $accessToken = "fRW66msKqtQXim0K2v_MTwEz0ne4XhqfxU4VCn-IlLdpmZvi1es6HkZA84avZezYbQ8y3rx6l3wliH8STCEwADYSBJag-AGisuWL4ZF7ltljW6iG8U7R2jkcR0SfnhnisRatRmhrkspls0fc5wgyMUJD761FlOrkgVvPN4pV-tEWk795JkhiAPg6GJP7fEqqiCT27bcHoGIPrNmuKedvLuJQRbfUWDXZkQ1HLNdPn4s0gc9mUDdKHxwaM6XnyESBfiXa4tkvrJgXda0lVE3U9PN0R1X7lCOAYjDK9KAdn1EHXtDudnNdMmc3qt4";
//         $msgBuilder = new MessageBuilder('text');
//         $msgBuilder->withUserId('5709620065329958051');
//         $msgBuilder->withText('Message Text');
//         $msgText = $msgBuilder->build();
// // send request
//         $response = $zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, $accessToken, $msgText);
//         $result = $response->getDecodedBody(); // result
$data = ['data' => json_encode(array(
    'user_id' => 5709620065329958051,
    'offset' => 0,
    'count' => 10
))];
$response = $zalo->get(ZaloEndPoint::API_OA_GET_CONVERSATION, $accessToken, $data);
$result = $response->getDecodedBody();
        dd($result);
    }
}
