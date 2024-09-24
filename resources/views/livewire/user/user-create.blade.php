
<div class="container">
    <style>
        .error_border{
            border: 1px solid red !important;
        }
    </style>
    <h3>Create User</h3>
    <div class="row">
        @if (Session::has('error'))
            <span class="text-danger">{{Session::get('error')}}</span>
        @endif
        @if (Session::has('success'))
            <span class="text-success">{{Session::get('success')}}</span>
        @endif
    </div>
    <form wire:submit='save'>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="">Name</label>
                <input wire:model='name' class="form-control @error('name')
                    error_border
                @enderror" type="text">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="">Email</label>
                <input wire:model='email' class="form-control @error('email')
                    error_border
                @enderror" type="text">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="">Password</label>
                <input wire:model='password' class="form-control @error('password')
                    error_border
                @enderror" type="text">
            </div>
            <div class="col-md-6 mt-3">
                <button type="submit" class="btn btn-primary w-100">Save</button>
            </div>
        </div>
    </form>
</div>
