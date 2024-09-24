<?php

namespace App\Livewire;

use Livewire\Component;

class User extends Component
{
    public $score = 0;
    public $title = 'Add User';

    public function increment()
    {
        $this->score++;
    }

    public function render()
    {
        return view('livewire.user')->with(['title'=>$this->title]);
    }
}
