<?php

namespace App\Livewire\User;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $userIdToDelete;
    public $userIdToEdit;
    public ModelsUser $allUsers;
    public $isLoading = false;

    public $currentUser;

    public function mount()
    {
        // $this->refreshUsers();
        // $this->users = ModelsUser::query()->where('email', '<>', auth()->user()->email)->orderBy('created_at', 'desc')->get();
    }

    public function refreshUsers()
    {
        // $this->users = ModelsUser::query()->where('email', '<>', auth()->user()->email)->orderBy('created_at', 'desc')->get();
    }

    public function create()
    {
        $validator = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = ModelsUser::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset();
        // $this->refreshUsers();

        $this->dispatch('userCreated');

        return back()->with('success', 'User created successfully');
    }

    public function edit($user_id)
    {
        // $validator = $this->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);

        $user = ModelsUser::query()->find($user_id);

        $this->currentUser = $user;

        if ($user) {
            $this->userIdToEdit = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }

        $this->dispatch('userEdit');
    }

    public function update()
    {

        $validator = Validator::make($this->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $user = ModelsUser::query()->find($this->userIdToEdit);

        $this->currentUser = $user;

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->reset();

        $this->dispatch('userUpdated');

        return back()->with('success', 'User updated successfully');
    }

    public function confirmDelete($user_id)
    {
        $user = ModelsUser::query()->find($user_id);

        $this->currentUser = $user;

        $this->dispatch('userDeleteConfirmed');
    }

    public function delete()
    {
        try {

            if ($this->currentUser) {

                $this->currentUser->delete();

                $this->reset();
                // $this->refreshUsers();

                $this->dispatch('userDeleted');

                return back()->with('success', "user deleted successfully");
            } else {
                $this->reset();
                $this->dispatch('userDeleteFailed');

                return back()->with('error', 'User cannot be found');
            }
        } catch (\Throwable $th) {
            Log::info("\nUSER DELETION: " . $th->getMessage());
            return redirect()->to('/users')->with('error', 'Failed to delete user');
        }
    }

    #[Title('Users')]
    public function render()
    {
        $users = ModelsUser::query()->where('email', '<>', auth()->user()->email)->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.user.index', compact('users'));
        // return view('livewire.user.index')->with(['users' => ModelsUser::query()->get()]);
    }
}
