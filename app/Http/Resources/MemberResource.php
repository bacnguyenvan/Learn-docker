<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'montbell_login_user_id' => $this->montbell_login_user_id,
            'member_mbc_no' => $this->member_mbc_no,
            'member_web_no' => $this->member_web_no,
            'member_name' => $this->member_name,
            'mbc_yukokigen_year_month' => $this->mbc_yukokigen_year_month,
            'mbc_update_flg' => $this->mbc_update_flg,
            'premium_card_name' => $this->premium_card_name,
            'card_name' => $this->card_name,
            'card_category_name' => $this->card_category_name,
            'card_img' => $this->card_img,
            'card_type_renewal_flg' => $this->card_type_renewal_flg,
            'card_type_reenter_flg' => $this->card_type_reenter_flg,
            'member_points' => $this->member_points,
            'support_card_img' => $this->support_card_img,
            'barcode_string' => $this->barcode_string,
            'barcode_retention_seconds' => $this->barcode_retention_seconds,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}


