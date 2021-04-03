<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Carbon\Carbon;

abstract class NotificationRequestAbstract extends APIRequest
{
    protected $helper;

    public function __construct()
    {
        $this->helper = app(Helper::class);
    }

    protected function isEmptyMemberExtract()
    {
        if (isset($this['all_devices']) && $this['all_devices']) {
            return false;
        }

        $fields = ['member_id', 'prefecture_id'];
        foreach ($fields as $f) {
            if (!$this->helper->isEmptyInput($this[$f])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->isEmptyMemberExtract()) {
                $validator->errors()->add('member_id', 'Member extract conditions must not be empty.');
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'body' => 'required',
            'delivery_time' => 'required|date',
            'member_id' => 'array',
            'member_id.*' => 'nullable|integer',
            'prefecture_id' => 'array',
            'prefecture_id.*' => 'nullable|integer',
            'all_devices' => 'boolean',
        ];
    }

    public function prep()
    {
        $re = $this->all();
        $re['member_id'] = $re['member_id'] ?? [];
        $re['prefecture_id'] = $re['prefecture_id'] ?? [];
        $re['all_devices'] = $re['all_devices'] ?? 0;

        if (isset($re['delivery_time'])) {
            $fmt = config('date.full');
            $re['delivery_time'] = Carbon::createFromFormat($fmt, $re['delivery_time'])
                ->setSecond(0)
                ->format($fmt);
        }

        return $re;
    }
}
