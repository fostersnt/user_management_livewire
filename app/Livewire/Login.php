<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        try {
            if (Auth::attempt($validator)) {
                // Auth::login(auth()->user());
                // dd('Login success');
                return redirect()->route('users.index');
            } else {
                return back()->with('error', 'Your credentials do not match any record');
            }
        } catch (\Throwable $th) {
            Log::info("\nLOGIN ATTEMPT: " . $th->getMessage() . " LINE NUMBER: " . $th->getLine());
            return back()->with('error', 'Login failed');
        }
    }

    #[Layout('components.layouts.login_layout')]
    public function render()
    {
            return view('livewire.login');
    }
}
