<?php

namespace App\Livewire\User;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

class User extends Component
{
    public $score = 0;
    public $title; // = 'Add User';

    public $name;
    public $email;
    public $userId;


    public function increment()
    {
        $this->score++;
    }

    public function edit($id)
    {
        // $validator = $this->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);

        $user = ModelsUser::query()->find($id);

        if ($user) {
            $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        }

        $this->dispatch('userEdit', $id);
    }

    public function update()
    {
        $validator = $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = ModelsUser::query()->find($this->userId);
        $user->update($validator);
        Log::info("\nUSER DATA: " . json_encode($user));

        $this->dispatch('userUpdated', $this->userId);
        return back()->with('success', 'User updated successfully');


    }

    public function delete($id)
    {
        try {
            Log::info("\nUSER ID: $id");
            $user = ModelsUser::query()->find($id);
            // $flag = 0;
            if ($user) {
                $user->delete();
                $this->dispatch('userDeleted');
                return back()->with('success', "$user->name deleted successfully");
            } else {
                return back()->with('error', 'User cannot be found');
            }
        } catch (\Throwable $th) {
            Log::info("\nUSER DELETION: " . $th->getMessage());
            return redirect()->to('/users')->with('error', 'Failed to delete user');
        }
    }

    #[Title('Add User')]
    public function render()
    {
        return view('livewire.user.index')->with(['users' => ModelsUser::query()->get()]);
    }
}
