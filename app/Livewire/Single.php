<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Single extends Component
{

    public string $id;
    public ?array $post;

    public ?string $sessionName;

    public function mount($id, SessionManager $s)
    {
        $this->id = $id;

        $this->sessionName = $s->get('name');
    }

    public function view($id)
    {
        return Http::withOptions(['verify' => false])->get("https://jsonplaceholder.typicode.com/posts/{$id}")->json();
    }

    public function render(): View
    {
        $this->post = $this->view($this->id);
        return view('livewire.single');
    }
}
