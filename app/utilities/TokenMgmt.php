<?php
namespace App\utilities;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Response;

class TokenMgmt
{
    public static function getUserObject(Request $request)
    {
        $headerParser = new \Tymon\JWTAuth\Http\Parser\AuthHeaders;
        $headerParser->setHeaderName('Authorization'); // though HTTP headers are case-insensitive so case shouldn't matter
        JWTAuth::parser()->setChain([$headerParser]);
        /////GET SPECIALIST TOKEN
        $token = JWTAuth::getToken();
        self::validateJWT($token);
        $user = JWTAuth::parseToken($request->header('Authorization'))->authenticate();
        return $user;
    }

    public static function validateJWT($token)
    {
        try {
            // attempt to verify the credentials and create a token for the user
            JWTAuth::getPayload($token)->toArray();
            return null;
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            Response::make(['token_expired','code' => 401], 401)->send();
            exit();

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

             Response::make(['token_invalid','code' => 401], 401)->send();
             exit();

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            Response::make(['token_absent' => $e->getMessage(),'code' => 401], 401)->send();
            exit();
        }
    }
}
