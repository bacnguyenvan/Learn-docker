<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseAPI;

class IconController extends Controller
{
    use ResponseAPI;
    public function index($type = 'landmark')
    {
        try {
            $icons = \DB::table('icons')->where('type',$type)->get();

            return $this->success('Get landmark icons success', $icons, 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
