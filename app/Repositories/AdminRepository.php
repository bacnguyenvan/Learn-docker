<?php

namespace App\Repositories;

use App\Contracts\AdminContract;
use App\Traits\ResponseAPI;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Services\AdminService;

class AdminRepository  implements AdminContract
{
    use ResponseAPI;

    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $admins = \App\Models\Admin::all();

            return $this->success('Get admin success', \App\Http\Resources\AdminResource::collection($admins), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $admin
     * @return void
     */
    public function show($admin)
    {
        try {
            return $this->success('Get admin success', \App\Http\Resources\AdminResource::make($admin), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store($request)
    {
        try {

            $inputs = [
                'email' => $request->email,
                'name' => $request->name,
                'level' => $request->level,
                'password' => bcrypt($request->password)
            ];
            
            $admin = \App\Models\Admin::create($inputs);

            return $this->success('Insert admin success', \App\Http\Resources\AdminResource::make($admin), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $admin
     * @return void
     */
    public function update($request, $admin)
    {
        try {
            $data = [
                'name' => $request->name,
                'level' => $request->level,
                'email' => $request->email
            ];

            if(isset($request->password)) $data['password'] = bcrypt($request->password);

            foreach ($data as $key => $value) {
                $admin[$key] = $value;
            }
            
            $admin->save();

            return $this->success('Update admin success', \App\Http\Resources\AdminResource::make($admin), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * destroy
     *
     * @param  mixed $admin
     * @return void
     */
    public function destroy($admin)
    {
        try {
            $admin->delete();

            return $this->success('Delete admin success', \App\Http\Resources\AdminResource::make($admin), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function login($request)
    {
        try {
            $admin = Admin::where('email', $request->email)->whereNull('deleted_at')->first();
       
            if (!$admin || !Hash::check($request->password, $admin->password, [])) {
                // throw new Exception('Wrong email or password');
                return $this->error('Login fails',[],401);
            }

            $data = $this->adminService->getAdminAccessToken($admin);

            return $this->success('Login success', $data, 200);
        } catch (Exception $error) {
            throw $error;
        }
    }

    public function refreshToken()
    {
        $token = request()->header('Authorization');
        try{
            $admin = Admin::getAdminByAccessToken($token);
            if(!empty($admin)){
                $data = $this->adminService->getAdminAccessToken($admin);
                return $this->success('Refresh token success', $data, 200);
            }else{
                return $this->error('Refresh token fails','Token not valid',401);
            }

        }catch(\Exception $err){
            throw $err;
        }
    }


    public function logout()
    {
        $token = request()->header('Authorization');

        try{
            $success = Admin::removeAccessToken($token);
            if($success){
                return $this->success('Logout success','',200);
            }
            else{
                return $this->error('Logout fails','Token not valid',401);
            }
        }catch(\Exception $err){
            throw $err;
        }
        
    }
}
