<li class="nav-item d-flex align-items-center">
    {{-- <form action="{{route('logout')}}" method="POST">
        @csrf --}}
    <a wire:click='confirmLogout' class="nav-link text-body font-weight-bold px-0" type="submit">
        <i class="fa fa-user me-sm-1"></i>

        <span class="d-sm-inline d-none"><i class="fa fa-sign-out-alt"></i></span>

    </a>
    {{-- </form> --}}

    {{-- LOGOUT CONFIRMATION MODAL --}}
    <div class="modal" tabindex="-1" id="logout_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-center mt-3">
                    <i class="modal-title text-muted fa fa-sign-out-alt"></i>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='logout'>
                        <div class="d-flex justify-content-center">
                            <span>Do you want to sign out?</span>
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
</li>

@script
    <script>
        Livewire.on('logoutConfirmed', () => {
            $('#logout_modal').modal('show');
        });
    </script>
@endscript
