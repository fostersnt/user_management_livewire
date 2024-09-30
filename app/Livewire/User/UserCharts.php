<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class UserCharts extends Component
{
    public $total_users = 0;

    public function boot()
    {
        $this->total_users = User::query()->count();
    }

    #[Title('Users Chart')]
    public function render()
    {
        return view('livewire.user.user-charts');
    }
}
