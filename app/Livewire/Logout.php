<?php

namespace App\Livewire;

use Livewire\Component;

class Logout extends Component
{
    public bool $isLogout;

    public function confirmLogout()
    {
        $this->isLogout = true;
        $this->dispatch('logoutConfirmed');
    }

    public function logout()
    {
        if ($this->isLogout) {
            auth()->logout();
        // $this->dispatch('logoutConfirmed');
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
