<li class="nav-item d-flex align-items-center">
    {{-- <form action="{{route('logout')}}" method="POST">
        @csrf --}}
        <a wire:click='logout' class="nav-link text-body font-weight-bold px-0" type="submit">
            <i class="fa fa-user me-sm-1"></i>

            <span class="d-sm-inline d-none">Sign Out</span>

        </a>
    {{-- </form> --}}
</li>
