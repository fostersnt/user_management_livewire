<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $showText = true;

     public function login()
    {
        // $validator = $this->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);



        // dd($this->data);
        $validator = Validator::make($this->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // sleep(2);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        try {
            if (Auth::attempt($credentials)) {
                return redirect()->route('users.index');
            } else {
                return back()->with('error', 'Your credentials do not match any record');
            }
        } catch (\Throwable $th) {
            Log::info("\nLOGIN ATTEMPT: " . $th->getMessage() . " LINE NUMBER: " . $th->getLine());
            return back()->with('error', 'Login failed');
        }
        // $this->isLoading = false;
    }

    #[Layout('components.layouts.login_layout')]
    public function render()
    {
            return view('livewire.login');
    }
}
