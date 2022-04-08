<?php

namespace App\Http\Requests\Admin\Announcement;

use App\Rules\BuildingFloorsRule;
use App\Rules\DealTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $data = $this->request->all();
        $announcement_data = $data['announcement'];
        $details = $data['details'];
        $rules = [
            'announcement.category_id' => 'required|exists:categories,id',
            'details.region_id' => 'required|exists:regions,id',
            'details.street_id' => 'required_if:details.region_id,11|exists:streets,id',
            'details.total_area' => 'required',
        ];

        if (!array_key_exists('is_negotiable',$announcement_data)){
            $rules['deal_type'] = [new DealTypeRule()];

            if ($data['deal_type']){
                foreach ($data['checked_deal_types'] as $checked_deal_type){
                    $rules["deal_types.{$checked_deal_type}.price"] = 'required';
                    $rules["deal_types.{$checked_deal_type}.currency"] = 'required';
                }
            }
        }

        if ($details['region_id'] != 11){
            if (!array_key_exists('village_id',$details)){
                $rules['details.city_id'] = 'required';
            }

            if (!array_key_exists('city_id',$details)){
                $rules['details.village_id'] = 'required';
            }
        }


        if (in_array($announcement_data['category_id'],[1,2,3])){
            $rules['details.building'] = 'required';
            $rules['details.building_type_id'] = 'required';
            $rules['details.apartment'] = 'required';
            $rules['details.bathrooms'] = 'required';
            $rules['details.ceil_height'] = 'required';
            $rules['details.repairing_type_id'] = 'required';

            if ($announcement_data['category_id'] != 3){
                $rules['details.rooms'] = 'required';
            }

            if ($announcement_data['category_id'] != 2){
                $rules['details.floors_count'] = 'required';
                $rules['details.building_floor_ids'] = [new BuildingFloorsRule()];
            }else{
                $rules['details.building_floor_ids[]'] = 'required';
            }

            if ($announcement_data['category_id'] == 2 || ($announcement_data['category_id'] == 3 && isset($announcement_data['separate_building']))){
                $rules['details.land_area'] = 'required';
            }
        }

        if (in_array($announcement_data['category_id'],[3,4])){
            $rules['announcement.sub_category_id'] = 'required|exists:categories,id';
        }

        if ($announcement_data['category_id'] == 4){
            $rules['details.forehead_length'] = 'required';
            $rules['details.depth'] = 'required';
            if (isset($details['demolition'])){
                $rules['details.building_address'] = 'required';
            }
        }

        return $rules;
    }
}
