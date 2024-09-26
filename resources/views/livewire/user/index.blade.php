<div>
    <div class="p-3">
        <div class="row p-3">
            <div class="col-md-4 m-4">
                <a href="/users/create" class="btn btn-outline-primary" wire:navigate>Add User</a>
            </div>
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    <span class="">{{ Session::get('error') }}</span>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <span class="">{{ Session::get('success') }}</span>
                </div>
            @endif
        </div>
        <table id="users_table" class="table table-responsive">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr key='{{ $user->id }}'>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="">
                                <div class="d-flex justify-content-around">
                                    <button wire:click='delete({{ $user->id }})'
                                        wire:confirm='Do you want to delete this user?' type="button"
                                        class="btn btn-danger">Delete</button>
                                    <button wire:click.prevent='edit({{ $user->id }})'
                                        class="btn btn-info">Edit</button>
                                </div>
                            </td>
                        </tr>
                        {{-- EDIT MODAL --}}
                        <div class="modal" tabindex="-1" id="user_edit_modal_{{ $user->id }}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="modal-title text-muted">fa fa-pencil</h5>
                                        {{-- <button type="button" class="btn-close text-light" data-bs-dismiss="modal"
                                            aria-label="Close"></button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <form wire:submit.prevent='update'>
                                            <div class="form-group mb-3">
                                                <label for="">Name</label>
                                                <input class="form-control @error('name') error-border @enderror" wire:model='name' type="text" name="" id="">
                                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input class="form-control @error('email') error-border @enderror" wire:model='email' type="text" name="" id="">
                                                @error('email') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary mx-2"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary mx-2">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


@script
    <script>
        $(document).ready(function() {
            $('#users_table').DataTable({
                dom: 'Bftip',
                buttons: [{
                    extend: 'excel',
                    title: 'Users_Excel_data',
                    exportOptions: {
                        columns: [0]
                    }
                }, ]
            });

            // Listen for Livewire event after deletion
            Livewire.on('userDeleted', () => {
                //  alert('HELLO WORLD')
                // Reload DataTable
                // usersTable.ajax.reload(); // Use this if you're using AJAX
                // Or, reinitialize DataTable if you're not using AJAX
                console.log('STEP ONE');
                // usersTable.destroy();
                $('#users_table').DataTable().ajax.reload(); // Uncomment if needed
                console.log('STEP TWO');
            });

            Livewire.on('userEdit', (user_id) => {
                console.log(`USER ID:${user_id}`);

                $(`#user_edit_modal_${user_id}`).modal('show');
            });
            Livewire.on('userUpdated', (user_id) => {
                console.log(`USER ID:${user_id}`);

                $(`#user_edit_modal_${user_id}`).modal('hide');
            });
        });
    </script>
@endscript
