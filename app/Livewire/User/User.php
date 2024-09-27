<?php

namespace App\Livewire\User;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class User extends Component
{
    public $name;
    public $email;
    public $password;
    public $userIdToDelete;
    public $userIdToEdit;
    public ModelsUser $allUsers;

    public $users;

    public $alert_message = '';
    public $isAlert = false;
    public $isError = true;
    protected $listeners = ['show-alert' => 'displayAlert'];

    #[On('show-alert')]
    public function displayAlert($alertType, $actionType)
    {
        Log::info("\nALERT TYPE: " . json_encode($alertType));
        Log::info("\nACTION TYPE: " . json_encode($actionType));
        // session()->flash('message', $message);

        $lower_alert_type = strtolower($alertType);
        $lower_action_type = strtolower($actionType);

        //User update alerts
        if ($lower_alert_type == 'success' && $lower_action_type == 'update') {
            $this->isAlert = true;
            $this->alert_message = 'User updated successfully';
        } elseif ($lower_alert_type == 'failed' && $lower_action_type == 'update') {
            $this->isAlert = true;
            $this->alert_message = 'User updated failed';
        }
        //User creation alerts
        elseif ($lower_alert_type == 'success' && $lower_action_type == 'create') {
            $this->isAlert = true;
            $this->alert_message = 'User created successfully';
        } elseif ($lower_alert_type == 'failed' && $lower_action_type == 'create') {
            $this->isAlert = true;
            $this->alert_message = 'User creation failed';
        }
        //User deletion alerts
        elseif ($lower_alert_type == 'success' && $lower_action_type == 'delete') {
            $this->isAlert = true;
            $this->alert_message = 'User delete successfully';
        } elseif ($lower_alert_type == 'failed' && $lower_action_type == 'delete') {
            $this->isAlert = true;
            $this->alert_message = 'User deletion failed';
        } else {
            # code...
        }
    }

    public function mount()
    {
        $this->refreshUsers();
        // $this->users = ModelsUser::query()->where('email', '<>', auth()->user()->email)->orderBy('created_at', 'desc')->get();
    }

    public function refreshUsers()
    {
        $this->users = ModelsUser::query()->where('email', '<>', auth()->user()->email)->orderBy('created_at', 'desc')->get();
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
        $this->refreshUsers();

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

        if ($user) {
            $this->userIdToEdit = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }

        $this->dispatch('userEdit');
    }

    public function update()
    {
        $validator = $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = ModelsUser::query()->find($this->userIdToEdit);

        $user->update($validator);

        Log::info("\nUSER DATA: " . json_encode($user));

        $this->reset();
        $this->refreshUsers();

        $this->dispatch('userUpdated');

        return back()->with('success', 'User updated successfully');
    }

    public function confirmDelete($user_id)
    {
        $user = ModelsUser::query()->find($user_id);
        if ($user) {
            $this->userIdToDelete = $user->id;
        }
        $this->dispatch('userDeleteConfirmed');
    }

    public function delete()
    {
        try {

            $user = ModelsUser::query()->find($this->userIdToDelete);

            if ($user) {

                $user->delete();

                $this->reset();
                $this->refreshUsers();

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

    #[Title('Add User')]
    public function render()
    {
        // $users = ModelsUser::query()->where('email', '<>', auth()->user()->email)->orderBy('created_at', 'desc')->get();
        return view('livewire.user.index');
        // return view('livewire.user.index')->with(['users' => ModelsUser::query()->get()]);
    }
}
