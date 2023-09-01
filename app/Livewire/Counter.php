<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public $token = null;

    public function increment()
    {
        $this->count++;
        $this->token = "test";
        $this->dispatch('post-created', ['data' => 1]);
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter')->layoutData(['showFooter' => 'Show']);
    }
}
