<div>
    <h1>{{ $score }}</h1>

    <div class="d-flex">
        <button wire:click='increment' type="button" class="btn btn-primary">Add Mark</button>
        <nav>
            <a href='/users/create' wire:navigate class="btn btn-primary">Create New User</a>
        </nav>
    </div>

    <body>

    </body>

    <div class="table p-3">
        <div class="row">
            @if (Session::has('error'))
            <span class="text-danger">{{Session::get('error')}}</span>
        @endif
        @if (Session::has('success'))
            <span class="text-success">{{Session::get('success')}}</span>
        @endif
        </div>
        <table id="users_table">
            <thead>
                <th>Name</th>
                <th>Email</th>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
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
@endscript
