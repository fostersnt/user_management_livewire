
    <div class="container">
        <div class="image-column">
            <img src="{{asset('assets/img/logos/gwosevo-logo.png')}}" alt="Login Image" style="width: 80%; height: 60%;">
        </div>
        <div class="form-column">
            <h2>Login</h2>
            <form wire:submit='login'>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input wire:model='email' class="form-control @error('email') error-border @enderror" type="email" id="email" name="email">
                    @error('email') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input wire:model='password' class="form-control @error('password') error-border @enderror" type="password" id="password" name="password">
                    @error('password') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <button class="btn btn-outline-primary w-100 mt-3" type="submit">Login</button>
            </form>
        </div>
    </div>

