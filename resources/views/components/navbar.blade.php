
<nav id="mainNav" class="navbar">
    <div class="container">
        <a class="navbar-brand m-0 p-0" href="#">
            <img src="{{ asset('images/logo_2x.png') }}" alt="Your Booking Website">
        </a>

        <ul class="list-group list-group-horizontal">
            <li class="list-group-item border-0 bg-transparent p-0 m-0 align-self-center">
                <a href="#" class="btn p-0 m-0 text-left primary-color border-0"><b>Chiamaci</b><br>02 2089765</a>
            </li>
            <li class="list-group-item list-group-divider bg-white ms-3 me-3"></li>
            <li class="list-group-item bg-transparent border-0 p-0 m-0 align-self-center">
                <a href="{{ route('admin.dashboard.index') }}" class="btn p-0 m-0 text-left primary-color border-0">
                    <img src="{{ asset('images/user.png') }}" class="align-baseline" alt="Area Riservata"> Area riservata
                </a>
            </li>
        </ul>

    </div>
</nav>
