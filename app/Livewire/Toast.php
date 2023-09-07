<?php

namespace App\Livewire;

use Livewire\Component;

class Toast extends Component
{
    public string $title;
    public string|array $body;

    public function mount($title, $body)
    {
        $this->title = $title;
        $this->body = $body;

        if (is_array($this->body)) $this->body = implode('<br />', $this->body);

        $this->dispatch('toast', $this->title, $this->body);
    }

    public function render()
    {
        return view('livewire.toast');
    }
}
