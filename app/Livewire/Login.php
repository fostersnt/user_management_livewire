<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $validator = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validator)) {
            // Auth::login(auth()->user());
            // dd('Login success');
            return redirect()->route('users.index');
        } else {
            dd('Login failed');
        }
    }

    #[Layout('components.layouts.login_layout')]
    public function render()
    {
            return view('livewire.login');
    }
}
