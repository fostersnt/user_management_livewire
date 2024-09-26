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
                                    <a href="{{route('users.edit', $user->id)}}" wire:navigate class="btn btn-info">Edit</a>
                                </div>
                            </td>
                        </tr>
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
            })
        });
    </script>
    <script>
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
    </script>
@endscript
