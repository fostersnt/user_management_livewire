<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;

    public function save()
    {
        Log::info("\nHELLO");

        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Log::info("\WORLD");
        $username = $this->name;
        try {
            User::query()->create($this->pull());

            // return redirect()->to('/users');
            return redirect()->route('users.index')->with('success', "Account for $username has been created successfully");
            // return view('livewire.user.index')->with('success', 'User has been created');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.user-create');
    }
}
