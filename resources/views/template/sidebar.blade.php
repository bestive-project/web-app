<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ route('web.dashboard.index') }}" class="ai-icon" aria-expanded="false">
                    <i>
                        <img src="{{ asset('icons/home.svg') }}">
                    </i>
                    <span class="nav-text">Beranda</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i><img src="{{ asset('icons/book.svg') }}"></i>
                    <span class="nav-text">Pembelajaran</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="menu-1">Menu 1</a></li>
                    <li><a href="menu-1">Menu 2</a></li>
                </ul>
            </li>
            <li><a href="menu-1" class="ai-icon" aria-expanded="false">
                    <i>
                        <img src="{{ asset('icons/message.svg') }}">
                    </i>
                    <span class="nav-text">Konseling</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i><img src="{{ asset('icons/group.svg') }}"></i>
                    <span class="nav-text">Diskusi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="menu-1">Menu 1</a></li>
                    <li><a href="menu-1">Menu 2</a></li>
                </ul>
            </li>
            <li style="right: 0; bottom: 0; left: 0; position: absolute">
                <a href="menu-1">
                    <i><img src="{{ asset('icons/question.svg') }}"></i>
                    <span class="nav-text">Pusat Bantuan</span>
                </a>
            </li>
        </ul>
    </div>
</div>
