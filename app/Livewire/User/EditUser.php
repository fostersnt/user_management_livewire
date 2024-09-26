<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $name;
    public $email;
    public $password;

    public function render($id)
    {
        $user = User::query()->find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        return view('livewire.user.edit-user', compact('user'));
    }
}
