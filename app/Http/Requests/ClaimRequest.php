<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaimRequest extends FormRequest
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
        return [
            "customer_name" => "required|min:2",
            "email" => "required|email|unique:users,email,".$this->user()?->id,
            "registered_by" => "required|min:2",
            "sales_channel" => "required|string",
            "customer_nr" => "required|numeric",
            "customer_country" => "required|string",
            "item_nr" => "required|numeric",
            "quantity" => "required|numeric",
            "serial_nr" => "required|string",
            "image" => "required",
            "image.*" => "image|mimes:jpeg,png,jpg,gif,svg|max:1024",
            "purchased_date" => "required|date",
            "customer_invoice_number" => "required|numeric",
            "failure_type" => "required|string",
            "problem_description" => "required|min:3",
            "customer_order_number" => "required|numeric",
            "customer_order_date" => "required|date",
        ];
    }

    public function messages()
    {
        return [
            "customer_nr.required" => "Please enter your customer number" ,
            "item_nr.required" => "Please enter your item number" ,
            "serial_nr.required" => "Please enter serial number" ,
            "customer_nr.numeric" => "Please enter only numeric customer number" ,
            "image.image" => "Please upload all valid image" ,
            "image.mimes" => "Only jpeg,png,jpg,gif,svg are acceptable" ,
            "image.max" => "Image must be smaller than 1MB" ,
        ];
    }
}