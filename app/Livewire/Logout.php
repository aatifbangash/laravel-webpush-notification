<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Logout extends Component
{

    public function logout()
    {
        session()->remove('data');
        session()->save();
        session()->flash('message', "User logout successfully");
        redirect('login');
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
