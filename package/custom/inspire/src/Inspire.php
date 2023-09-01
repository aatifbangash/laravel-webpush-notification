<?php

namespace Custom\Inspire;

use Illuminate\Support\Facades\Http;

class Inspire
{
    public function show()
    {
        return Http::withOptions(['verify' => false])->get("https://jsonplaceholder.typicode.com/posts")->json();
    }
}
