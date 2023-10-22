<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link px-sm-4 active py-4" data-bs-toggle="tab" href="#general" role="tab">
            General <span class='d-none d-sm-inline'>Info</span>
        </a>
    </li>

    {{-- <li class="nav-item">
                    <a class="nav-link py-4 px-sm-4" href="#specs" data-bs-toggle="tab" role="tab">
                        <span class='d-none d-sm-inline'>Tech</span> Specs
                    </a>
                </li> --}}

    <li class="nav-item">
        <a class="nav-link px-sm-4 py-4" data-bs-toggle="tab" href="#reviews" role="tab">
            Reviews
            <span class="fs-sm opacity-60">
                ({{ $reviews ? $reviews->count() : 0 }})
            </span>
        </a>
    </li>
</ul>
