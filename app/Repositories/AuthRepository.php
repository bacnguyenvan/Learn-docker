<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Traits\ResponseAPI;
use App\Traits\UploadFileAPI;
use App\Contracts\AuthContract;
use Illuminate\Support\Facades\Hash;
use App\Services\MontbellAPI;
use App\Models\Member;
use App\Models\MemberDevice;
use App\Jobs\UpdateMemberInfo;

use function PHPUnit\Framework\throwException;

class AuthRepository implements AuthContract
{
    use ResponseAPI, UploadFileAPI;

    private $montbellAPI;

    public function __construct(MontbellAPI $montbellAPI)
    {
        $this->montbellAPI = $montbellAPI;
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            $response = $this->montbellAPI->logout(request()->header('authorization'));

            if ($response['result_code'] == MontbellAPI::LOGOUT_STATUS_OK) {
                return $this->success('Logout success', true, 200);
            } else throw new \App\Exceptions\StatusMontbellNotOKException;
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Member can be login with access token from Montbell
     * @param \App\Http\Requests\AuthPostLoginRequest
     * @return json
     */
    protected function memberLogin($request)
    {
        try {
            $response = $this->montbellAPI->login($request->username, $request->password, $request->device_version, $request->device_kishu_code, $request->device_type, $request->app_version);
            
            $member = Member::firstOrCreate([
                'montbell_login_user_id' => $request->username,
            ]);
            $member->login_token =  $response['login_token'];
            $member->save();

            $request->headers->set('authorization', $response['login_token']);
            //Job update member data
            dispatch(new UpdateMemberInfo($this->montbellAPI, $response['login_token'], $member));

            return $this->success('Login success', [
                'member_id' => $member['id'],
                'access_token' => $response['login_token'],
                'token_type' => 'Bearer'
            ], 200);
        } catch (Exception $error) {
            throw $error;
        }
    }

    /**
     * User can be login with access token from Sanctum
     * @param \App\Http\Requests\AuthPostLoginRequest
     * @return json
     */
    protected function userLogin($request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password, [])) {
                throw new Exception('Wrong email or password');
            }

            return $this->success('Login success', [
                'access_token' => $user->createToken('user')->plainTextToken,
                'token_type' => 'Bearer'
            ], 200);
        } catch (Exception $error) {
            throw $error;
        }
    }

    /**
     * Detect type param in request for detect Type Login - UserLogin or MemberLogin
     * @param \App\Http\Requests\AuthPostLoginRequest
     * @return json
     */
    public function login($request)
    {
        $loginType = strtolower($request->type);
        try {
            switch ($loginType) {
                case 'member':
                    return $this->memberLogin($request);
                    break;
                case 'user':
                    return $this->userLogin($request);
                    break;
                default:
                    throw new \App\Exceptions\MemberLoginWrongTypeException;
                    break;
            }
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
