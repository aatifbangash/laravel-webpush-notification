<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule('required|email')]
    public string $email;

    #[Rule('required|min:8|confirmed')]
    public string $password;

    #[Rule('required|min:8')]
    public string $password_confirmation;

    public function mount()
    {
        if (session()->get('data')) redirect('dashboard');
    }

    public function register()
    {
        $this->validate();

        $url = config('app.controller_endpoint') . '/api/hbv2-user/v1/users/register';
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
                session()->flash('message', $responseData['message']);
                redirect('login');
            }
        } else $this->dispatch('toast', 'Error', 'Server error');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
