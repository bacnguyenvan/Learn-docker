<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Traits\ResponseAPI;

class MontbellAPI
{
    use ResponseAPI;

    private $headers = [];
    private $montbellConfig = [];

    const LOGOUT_STATUS_OK = 1;

    public function __construct()
    {
        $this->getMontbellConfig();
        $this->headers = [
            'appli_key' => $this->montbellConfig['appli_key']
        ];
    }

    /**
     * login
     *
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function login(string $username, string $password, string $deviceVersion = null, string $deviceModel = null, string $device_type = null, string $app_version = null)
    {
        try {
            $loginData = [
                'device_type' => $device_type ? $device_type : config('api.montbell.device_type'),
                'device_version' => $deviceVersion ? $deviceVersion :  config('api.montbell.device_kishu_code'),
                'device_kishu_code' => $deviceModel ? $deviceModel : config('api.montbell.device_kishu_code'),
                'app_version' => $app_version ? $app_version : config('api.montbell.app_version'),
                'app_id' => config('api.montbell.app_id'),
                'access_token' => $this->getAccessToken(),
                'login_user_id' => $username,
                'login_user_password' => $this->encryptBlowFishPassword($password, config('api.montbell.blowfish_key'), config('api.montbell.encrypt_code')),
            ];
         
            return $this->postAsForm('/login', $loginData);
        } catch (\Exception $err) {
            throw $err;
        }
    }


    /**
     * logout
     *
     * @param  mixed $loginToken
     * @return void
     */
    public function logout($loginToken, string $deviceVersion = null, string $deviceModel = null, string $device_type = null, string $app_version = null)
    {
        $logoutData = [
            'device_type' => $device_type ? $device_type : config('api.montbell.device_type'),
            'device_version' => $deviceVersion ? $deviceVersion :  config('api.montbell.device_kishu_code'),
            'device_kishu_code' => $deviceModel ? $deviceModel : config('api.montbell.device_kishu_code'),
            'app_version' => $app_version ? $app_version : config('api.montbell.app_version'),
            'app_id' => config('api.montbell.app_id'),
            'access_token' => $this->getAccessToken(),
            'login_token' => $loginToken,
        ];

        return $this->postAsForm('/logout', $logoutData);
    }

    /**
     * get Member's information
     *
     * @param  mixed $loginToken
     * @return void
     */
    public function infoMember($loginToken, string $deviceVersion = null, string $deviceModel = null, string $device_type = null, string $app_version = null)
    {
        $requestData = [
            'device_type' => $device_type ? $device_type : config('api.montbell.device_type'),
            'device_version' => $deviceVersion ? $deviceVersion :  config('api.montbell.device_kishu_code'),
            'device_kishu_code' => $deviceModel ? $deviceModel : config('api.montbell.device_kishu_code'),
            'app_version' => $app_version ? $app_version : config('api.montbell.app_version'),
            'app_version' => config('api.montbell.app_version'),
            'access_token' => $this->getAccessToken(),
            'login_token' => $loginToken
        ];
        //Call API to montbell to get user information
        return $this->postAsForm('/get_user_information', $requestData);
    }

    /**
     * isTokenValid
     *
     * @param  mixed $loginToken
     * @return void
     */
    public function isTokenValid($loginToken, string $deviceVersion = null, string $deviceModel = null, string $device_type = null, string $app_version = null)
    {
        try {
            $checkAuthData = [
                'device_type' => $device_type ? $device_type : config('api.montbell.device_type'),
                'device_version' => $deviceVersion ? $deviceVersion :  config('api.montbell.device_kishu_code'),
                'device_kishu_code' => $deviceModel ? $deviceModel : config('api.montbell.device_kishu_code'),
                'app_version' => $app_version ? $app_version : config('api.montbell.app_version'),
                'app_id' => config('api.montbell.app_id'),
                'access_token' => $this->getAccessToken(),
                'login_token' => $loginToken,
            ];
            $response = $this->get('/login_auth_check', $checkAuthData);
            return $response['result_code'] == 1 ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * encryptBlowFishPassword
     *
     * @param  mixed $password
     * @param  mixed $key
     * @param  mixed $code
     * @return void
     */
    private function encryptBlowFishPassword($password, $key, $code = 'BF-ECB')
    {
        return base64_encode(openssl_encrypt(
            $password,
            $code,
            $key,
            OPENSSL_RAW_DATA | OPENSSL_DONT_ZERO_PAD_KEY
        ));
    }

    /**
     * montbellResponseJson
     *
     * @param  mixed $response
     * @return void
     */
    private function montbellResponseJson(\Illuminate\Http\Client\Response $response)
    {
        $responseJson = $response->json();

        if (!isset($responseJson['result_code'])) {
            throw new \Exception('Unknow Error', 401);
        }

        if ($responseJson['result_code'] != 1) {
            throw new \Exception($responseJson['result_message'], $responseJson['result_code']);
        }

        return $responseJson;
    }

    /**
     * refreshAccessToken
     *
     * @return void
     */
    private function refreshAccessToken()
    {
        $accessToken = Cache::get('access_token');
        if ($accessToken == null) {
            $response = $this->getMontbellAccessToken();
            Cache::put('access_token', $response['access_token'], $this->montbellConfig['access_token_ttl']);
            $accessToken = Cache::get('access_token');
        }

        $this->montbellConfig['access_token'] = $accessToken;
    }

    /**
     * getMontbellConfig
     *
     * @param  mixed $updateAccessToken
     * @return void
     */
    private function getMontbellConfig($updateAccessToken = false)
    {
        if ($updateAccessToken) {
            $this->refreshAccessToken();
        }
        $this->montbellConfig = config('api.montbell');
    }

    private function get($url, $query)
    {
        $response = Http::withHeaders($this->headers)->get($this->montbellConfig['base_url'] . $url, $query);

        return $this->montbellResponseJson($response);
    }

    private function post($url, $data)
    {
        $response = Http::withHeaders($this->headers)->post($this->montbellConfig['base_url'] . $url, $data);

        return $this->montbellResponseJson($response);
    }

    private function postAsForm($url, $data)
    {
        try {
            $response = Http::withHeaders($this->headers)->asForm()->post($this->montbellConfig['base_url'] . $url, $data);
            return $this->montbellResponseJson($response);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    private function getAccessToken()
    {
        $this->refreshAccessToken();
        return $this->montbellConfig['access_token'];
    }

    private function getHeaders()
    {
        return $this->headers;
    }

    /**
     * getMontbellAccessToken
     *
     * @return void
     */
    private function getMontbellAccessToken(string $deviceVersion = null, string $deviceModel = null, string $device_type = null, string $app_version = null)
    {
        return Http::withHeaders($this->headers)->get($this->montbellConfig['base_url'] . '/get_access_token', [
            'device_type' => $device_type ? $device_type : config('api.montbell.device_type'),
            'device_version' => $deviceVersion ? $deviceVersion :  config('api.montbell.device_kishu_code'),
            'device_kishu_code' => $deviceModel ? $deviceModel : config('api.montbell.device_kishu_code'),
            'app_version' => $app_version ? $app_version : config('api.montbell.app_version'),
        ]);
    }


    public function getMemberInfo($loginToken)
    {
        try {
            $response = $this->infoMember($loginToken);
            unset($response['result_code']);
            unset($response['result_message']);
            return $response;
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
