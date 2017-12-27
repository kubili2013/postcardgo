<?php

namespace App\Jobs;

use App\Http\Requests\PostcardRequest;
use App\Models\Postcard;

class CreatePostcard
{
    private $country;
    private $address;
    private $real_name;
    private $type;
    private $postcode;
    private $message;
    private $status;
    private $ip;
    private $image;
    private $user_id;
    private $email;

    public function __construct(string $country,
                                string $address,
                                string $real_name,
                                string $type,
                                string $postcode,
                                string $message,
                                string $status,
                                string $ip,
                                string $image,
                                string $user_id,
                                string $email)
    {
        $this->country = $country;
        $this->address = $address;
        $this->real_name = $real_name;
        $this->type = $type;
        $this->postcode = $postcode;
        $this->message = $message;
        $this->status = $status;
        $this->ip = $ip;
        $this->image = $image;
        $this->user_id = $user_id;
        $this->email = $email;
    }

    public static function fromRequest(PostcardRequest $request): self
    {
        return new static(
            $request->country(),
            $request->address(),
            $request->real_name(),
            "1",
            $request->postcode(),
            $request->message(),
            "created",
            $request->ip(),
            "",
            $request->author()->id,
            $request->email()
        );
    }

    public function handle(): Postcard
    {
        $postcard = new Postcard(
            [
                "country" =>$this->country,
                "address" =>$this->address,
                "real_name" =>$this->real_name,
                "postcode" =>$this->postcode,
                "message" =>$this->message,
                "status" =>$this->status,
                "ip" =>$this->ip,
                "image" =>$this->image,
                "user_id" =>$this->user_id,
                "email"=>$this->email,
                "type"=>$this->type,

            ]
        );
        $postcard->save();
        return $postcard;
    }
}
