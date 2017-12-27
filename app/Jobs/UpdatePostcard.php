<?php

namespace App\Jobs;

use App\Http\Requests\PostcardRequest;
use App\Models\Postcard;

class UpdatePostcard
{
    private $postcard;
    private $attributes;

    public function __construct(Postcard $postcard,
                                array $attributes = [])
    {
        $this->postcard = $postcard;
        $this->attributes = array_only($attributes, ['country','email',
            'address', 'real_name', 'postcode','message','image',]);
    }

    public static function fromRequest(Postcard $postcard, PostcardRequest $request): self
    {
        return new static($postcard,[
                'country' => $request->country(),
                'address' => $request->address(),
                'real_name' => $request->real_name(),
                'postcode' => $request->postcode(),
                'message' => $request->message(),
                'email' => $request->email(),
                'image' => $request->image(),
            ]
        );
    }

    public function handle(): Postcard
    {
        $this->postcard->update($this->attributes);
        return $this->postcard;
    }
}
