<!-- TODO: add icons and fix the behaviour -->
<div class="d-flex position-fixed flex-nowrap h-100">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
        <a href="/home"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-4">Hummingbird</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/home" class="nav-link active" aria-current="page">
                    <i class="bi bi-house"></i> Home
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-body-emphasis">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <hr>
            <div class="dropdown">
                <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                        class="rounded-circle me-2">
                    <strong>{{ auth()->user()->username }}</strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Sign Out</button>
                        </form>
                    </li>
                </ul>
            </div>
    </div>
</div>

<script src="js/sidebars.js"></script>
