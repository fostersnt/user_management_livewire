<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserCharts extends Component
{
    public $total_users = 0;

    public function boot()
    {
        $this->total_users = User::query()->count();
    }
    public function render()
    {
        return view('livewire.user.user-charts');
    }
}
