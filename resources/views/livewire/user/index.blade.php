<div>
    <div class="p-3">
        <div class="row p-3">
            <div class="m-4 d-flex justify-content-end">
                <button class="btn btn-outline-info" id="add_user"><i class="fa fa-plus text-info"></i> Add User</a>
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
        <table id="users_table" class="table table-responsive table-bordered table-striped">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr key='{{ $user->id }}'>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td class="">
                                <div class="d-flex justify-content-around">
                                    <a type="button" class="" id=""
                                        wire:click='confirmDelete({{ $user->id }})'><i
                                            class="fa fa-trash text-danger"></i></a>
                                    <a wire:click.prevent='edit({{ $user->id }})' type="button"
                                        class="user_edit"><i class="fa fa-pencil text-info"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- USER CREATION MODAL --}}
    <div class="modal" tabindex="-1" id="add_user_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-center mt-3">
                    <i class="modal-title text-muted fa fa-plus"></i>
                    {{-- <button type="button" class="btn-close text-light" data-bs-dismiss="modal"
                        aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='create'>
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input class="form-control @error('name') error-border @enderror" wire:model='name'
                                type="text" name="" id="">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input class="form-control @error('email') error-border @enderror" wire:model='email'
                                type="text" name="" id="">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input class="form-control @error('password') error-border @enderror" wire:model='password'
                                type="text" name="" id="">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary mx-2">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- EDIT MODAL --}}
    <div class="modal" tabindex="-1" id="user_edit_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-center mt-3">
                    <i class="modal-title text-muted fa fa-pencil"></i>
                </div>
                <div class="modal-body">
                    @if (Session::has('error'))
                        <span class="text-danger">{{Session::get('error')}}</span>
                    @endif
                    <form wire:submit.prevent='update()'>
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input class="form-control {{Session::has('errors') && Session::get('errors')->first('name') != '' ? 'error-border' : ''}}" wire:model='name'
                                type="text" name="" id="">
                            <span class="text-danger">{{Session::has('errors') ? Session::get('errors')->first('name') : ''}}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input class="form-control {{Session::has('errors') && Session::get('errors')->first('email') != '' ? 'error-border' : ''}}" wire:model='email'
                                type="text" name="" id="">
                                <span class="text-danger">{{Session::has('errors') ? Session::get('errors')->first('email') : ''}}</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary mx-2">
                                <span wire:loading.remove>Update</span>
                                    <div wire:loading class="spinner-grow" role="status"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- USER DELETION MODAL --}}
    <div class="modal" tabindex="-1" id="delete_user_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-center mt-3">
                    <i class="modal-title text-muted fa fa-trash"></i>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='delete()'>
                        <div class="d-flex justify-content-center">
                            <span>Do you want to delete {{$currentUser->name ?? '' }}</span>
                        </div>
                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" class="btn btn-secondary mx-2"
                                data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary mx-2">YES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{ $users->links('pagination.users-pagination') }}
</div>


@script
    <script>
        $(document).ready(function() {
            // $('#users_table').DataTable({
            //     dom: 'Bftip',
            //     buttons: [{
            //         extend: 'excel',
            //         title: 'Users_Excel_data',
            //         exportOptions: {
            //             columns: [0]
            //         }
            //     }, ]
            // });

            // Listen for Livewire event after deletion
            // Livewire.on('userDeleted', () => {
            //     // usersTable.ajax.reload();
            //     console.log('STEP ONE');
            //     // usersTable.destroy();
            //     $('#users_table').DataTable().ajax.reload(); // Uncomment if needed
            //     console.log('STEP TWO');
            // });

            $('#add_user').click(function() {
                $('#add_user_modal').modal('show');
            })

            Livewire.on('userCreated', () => {
                $('#add_user_modal').modal('hide');
            });

            Livewire.on('userEdit', (user_id) => {
                $('#user_edit_modal').modal('show');
            });

            Livewire.on('userUpdated', (user_id) => {
                $('#user_edit_modal').modal('hide');
                Toastify({
                    text: "User updated successfully",
                    className: "info",
                    // newWindow: true,
                    selector: 'alert_message',
                    duration: 3000,
                    close: true,
                    avatar: "{{ asset('assets/img/icons/update-icon.jpeg') }}",
                    gravity: "bottom", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        border: '1px solid black',
                        // borderTopLeftRadius: '50px',
                        // borderBottomRightRadius: '50px',
                        color: 'green',
                        // background: "linear-gradient(to right, #00b09b, #96c93d)",
                        padding: '10px',
                    }
                }).showToast();
            });

            Livewire.on('userDeleteConfirmed', () => {
                $('#delete_user_modal').modal('show');
            });

            Livewire.on('userDeleted', (user_id) => {
                $('#delete_user_modal').modal('hide');
                console.log(`MODAL ID userDeleted: ${user_id}`);
            });
        });
    </script>
@endscript
