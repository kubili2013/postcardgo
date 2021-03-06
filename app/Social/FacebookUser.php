<?php

namespace App\Social;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class FacebookUser implements Arrayable
{
    /**
     * @var array
     */
    private $attributes;

    public function __construct(array $attributes,$avatar)
    {
        $this->attributes = $attributes;
        $this->attributes = array_merge($this->attributes,["avatar" => $avatar]);
    }

    public function isTooYoung(): bool
    {
        return $this->createdAt() > $this->twoWeeksAgo();
    }

    public function createdAt(): Carbon
    {
        return new Carbon($this->get('created_at'));
    }

    private function twoWeeksAgo(): Carbon
    {
        return Carbon::now()->subDays(14);
    }

    private function get($name)
    {
        return array_get($this->attributes, $name);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->get('id'),
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'username' => $this->get('nickname'),
            'avatar' => $this->get('avatar'),
        ];
    }
}
