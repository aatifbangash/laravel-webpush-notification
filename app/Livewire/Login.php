<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{

    #[Rule('required|email')]
    public string $email;

    #[Rule('required|min:8')]
    public string $password;

    public function mount()
    {
        if (session()->get('data')) redirect('dashboard');
    }

    public function login()
    {
        $this->validate();

        $url = config('app.controller_endpoint') . '/api/hbv2-user/v1/users/login';
        $data = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $response = Http::withHeaders($headers)->post($url, $data);

        if ($response->successful()) {
            $responseData = $response->json();
            if ($responseData['status'] == 'error') $this->dispatch('toast', 'Error', $responseData['message']);

            if ($responseData['status'] == 'success') {
                session()->put('data', $responseData['data']);
                session()->flash('message', $responseData['message']);
                redirect('dashboard');
            }
        } else $this->dispatch('toast', 'Error', 'Server error');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
