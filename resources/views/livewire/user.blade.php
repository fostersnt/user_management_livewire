<div>
    <h1>{{ $score }}</h1>

    <div>
        <button wire:click='increment'>Add Mark</button>
    </div>

    <table id="users_table">
        <thead>
            <th>Name</th>
            <th>Email</th>
        </thead>
        <tbody>
            <r>
                <td>Foster Amponsah Asante</td>
                <td>fostersnt@gmail.com</td>
            </r>
        </tbody>
    </table>
</div>

@script
    <script>
        console.log('hhghghgh');
        $(document).ready(function() {
            $('#users_table').DataTable({
                dom: 'Bftip',
                buttons: [{
                    extend: 'excel',
                    title: 'Foster',
                    exportOptions: {
                        columns: [0] // Export only the first column (Name)
                    }
                }, ]
            })
        });
    </script>
@endscript
