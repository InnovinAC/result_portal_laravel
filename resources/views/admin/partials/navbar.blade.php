@php $user = Auth::guard('web')->user(); @endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-navy">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">School Portal</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa navbar-toggler-icon"></span>
          </button>

        <div class="collapse text-white navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">
                        <span class="fa-thin fa-home"></span> Dashboard </a>
                </li>

                @if($user->role == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-thin fa-person-chalkboard"></i> Sessions </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('create-session') }}">
                                <i class="fa-thin fa-plus-circle"></i> Create Academic Session </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('sessions') }}">
                                <i class="fa-thin fa-screen-users"></i> Manage Sessions </a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="active nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-thin fa-books"></i> Subjects </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('create-subject') }}">
                                <i class="fa-thin fa-plus-circle"></i> Create Subject </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('subjects') }}">
                                <i class="fa-thin fa-books"></i> Manage Subjects </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('create-subject-combo') }}">
                                <i class="fa-thin fa-plus-circle"></i> Add Subject Combination </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('subject-combos') }}">
                                <i class="fa-thin fa-books"></i> Manage Subject Combinations </a></li>
                    </ul>
                </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-thin fa-user-graduate"></i> Students </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('create-student') }}">
                                <i class="fa-thin fa-user"></i> Add Students </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('students') }}">
                                <i class="fa-thin fa-users"></i> Manage Students </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-thin fa-masks-theater"></i> Results </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('create-result') }}">
                                <i class="fa-thin fa-plus-circle"></i> Add Results </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('results') }}">
                                <i class="fa-thin fa-masks-theater"></i> Manage Results </a></li>
                    </ul>
                </li>

                @if ($user->role == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-thin fa-wrench"></i> Tools </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                    </li>
                    <li><a class="dropdown-item" href="{{ route('change-settings') }}">
                            <i class="fa-thin fa-cog"></i> Change Settings </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('create-teacher') }}">
                            <i class="fa-thin fa-user-cog"></i> Create Teacher </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('teachers') }}">
                            <i class="fa-thin fa-users-cog"></i> Manage Teachers </a></li>

                    @if ($general->use_pins == 'yes')
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('create-pin') }}">
                                <i class="fa-thin fa-plus-circle"></i> Create Pin </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('pins') }}">
                                <i class="fa-thin fa-shield-check"></i> Manage Pins </a></li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('promote') }}">
                            <i class="fa-thin fa-share"></i> Mass Promote Students </a></li>

            </ul>
            </li>
            @endif



            </ul>

            <ul class="navbar-nav flex-row flex-wrap ms-md-auto">

                <li class="nav-item dropdown">
                    <a href="#"
                        class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ url('storage/uploads/admin/' . $user->image) }}" alt="hugenerd" width="30"
                            height="30" class="rounded-circle">
                        <span class=" mx-1">{{ $user->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow">

                        <li><a class="dropdown-item" href="{{ route('edit-profile') }}">
                                <i class="fa-thin fa-user"></i> Edit Profile </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class="dropdown-item" href="{{ route('change-password') }}">
                                <i class="fa-thin fa-lock"></i> Change Password </a></li>
                        <li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a id="logout" class="dropdown-item" href="{{ route('logout') }}"
                                onclick="return confirm('Are you sure you want to logout?')"><i
                                    class="fa-thin fa-sign-out"></i> Sign out</a></li>
                    </ul>
                </li>
        </div>
    </div>
</nav>
