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
        <table id="users_table">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Email</th>
                <th>Email</th>
            </thead>
            <tbody>
                <r>
                    <td>Foster Amponsah Asante</td>
                    <td>fostersnt@gmail.com</td>
                    <td>fostersnt@gmail.com</td>
                    <td>fostersnt@gmail.com</td>
                </r>
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
