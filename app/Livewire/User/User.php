<?php

namespace App\Livewire\User;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Title;
use Livewire\Component;

class User extends Component
{
    public $score = 0;
    public $title;// = 'Add User';

    public function increment()
    {
        $this->score++;
    }

    public function create()
    {
        // return redirect()->to('/users/create');
        // return $this->redirect('/posts', navigate: true);
        return view('livewire.user.create');
    }

    #[Title('Add User')]
    public function render()
    {
        return view('livewire.user.index')->with(['users' => ModelsUser::query()->get()]);
    }

}
