@php
    use Carbon\Carbon;
@endphp
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        <img src="{{ asset('icons/calendar.svg') }}" style="margin-top: -5px">
                        {{ Carbon::now()->isoFormat('D / MM / Y') }}
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);" class="btn btn-default" data-bs-toggle="dropdown"><i
                                class="fas fa-user scale5"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end"
                            style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-15px, 79px); min-width: 12.5rem; padding: 15px 0">
                            @unlessrole('Admin')
                                <a href="{{ route('web.profile.index') }}" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                        width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ms-2">Profile Saya </span>
                                </a>
                            @endunlessrole
                            <form action="{{ route('web.logout') }}" method="post">
                                @csrf
                                <button id="btnLogout" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                        width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ms-2">Logout </span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
