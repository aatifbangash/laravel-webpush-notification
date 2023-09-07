<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        if (!session()->has('data')) redirect('login');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
