<?php

namespace App\Http\Requests;


use App\User;

class PostcardRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "country" => "required|max:64",
            "address" => "required|max:1024",
            "real_name" => "required|max:64",
            "email" => "required|email",
            "message" => "required|max:1024",
            "postcode" => "required|max:10",
            "image" => "string|max:255",
        ];
    }

    public function author(): User
    {
        return $this->user();
    }

    public function country(): string
    {
        return $this->get('country');
    }

    public function address(): string
    {
        return $this->get('address');
    }

    public function real_name(): string
    {
        return $this->get('real_name');
    }

    public function email(): string
    {
        return $this->get('email');
    }

    public function message(): string
    {
        return $this->get('message');
    }

    public function postcode(): string
    {
        return $this->get('postcode');
    }

    public function image(): string
    {
        return $this->get('image') ? $this->get('image') :"";
    }
}
