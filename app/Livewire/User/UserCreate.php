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
            // 'email' => 'required',
            'password' => 'required',
        ]);

        // Log::info("\WORLD");

        try {
            User::query()->create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            return redirect()->to('/users');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.user-create');
    }
}
