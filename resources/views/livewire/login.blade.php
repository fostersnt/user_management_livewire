<div class="container">
    <div class="image-column">
        <img src="{{ asset('assets/img/logos/gwosevo-logo.png') }}" alt="Login Image" style="width: 80%; height: 60%;">
    </div>
    <div class="form-column">
        <h2>Login</h2>
        <form wire:submit='login'>
            <div class="mt-2 mb-2 d-flex justify-content-center">
                @if (Session::has('error'))
                    <span class="text-danger">{{ Session::get('error') }}</span>
                @endif
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $item)
                    <h1>{{ $item }}</h1>
                @endforeach
            @endif
            <div class="form-group">
                <label for="email">Email:</label>
                <input wire:model='email' class="form-control {{ (Session::has('errors') && Session::get('errors')->first('email') != '') ? 'error-border' : '' }}" type="text"
                    id="email" name="email">
                <span
                    class="text-danger">{{ Session::has('errors') ? Session::get('errors')->first('email') : '' }}</span>

            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input wire:model='password' class="form-control {{ (Session::has('errors') && Session::get('errors')->first('password') != '') ? 'error-border' : '' }}"
                    type="password" id="password" name="password">
                <span
                    class="text-danger">{{ Session::has('errors') ? Session::get('errors')->first('password') : '' }}</span>
            </div>
            <button class="btn btn-outline-primary w-100 mt-3" type="submit">
                <span wire:loading.remove>Login</span>
                <div class="" wire:loading>
                    {{-- <span class="mx-3">Loading...</span> --}}
                    <div class="spinner-grow" role="status"></div>
                </div>
            </button>
        </form>
    </div>
</div>
