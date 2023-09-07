<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UserManagement extends Component
{

    public array $users;

    public function mount()
    {
        if (!session()->has('data')) redirect('login');

        $url = config('app.controller_endpoint') . '/api/hbv2-user/v1/users';
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $response = Http::withHeaders($headers)->get($url);
        if ($response->successful()) {
            $responseData = $response->json();
            $this->users = $responseData['data'];
        } else $this->dispatch('toast', 'Error', 'Server error');
    }

    public function render()
    {
        return view('livewire.user-management');
    }
}
