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
            @role('Admin')
                <li>
                    <a href="javascript:void()" class="has-arrow ai-icon" aria-expanded="false">
                        <i><img src="{{ asset('icons/user-shield.svg') }}"></i>
                        <span class="nav-text">Pengguna</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('web.admin.index') }}">Admin</a></li>
                        <li><a href="{{ route('web.conselour.index') }}">Konselor</a></li>
                        <li><a href="{{ route('web.teacher.index') }}">Guru</a></li>
                        <li><a href="{{ route('web.student.index') }}">Siswa</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('web.study-group.index') }}" class="ai-icon" aria-expanded="false">
                        <i>
                            <img src="{{ asset('icons/classroom.svg') }}">
                        </i>
                        <span class="nav-text">Kelompok Belajar</span>
                    </a>
                </li>
            @endrole
            @role('Siswa')
                <li><a href="{{ route('web.course.index') }}" class="ai-icon" aria-expanded="false">
                        <i>
                            <img src="{{ asset('icons/classroom.svg') }}">
                        </i>
                        <span class="nav-text">Kumpulan Materi</span>
                    </a>
                </li>
            @endrole
            @hasanyrole(['Admin', 'Guru'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i><img src="{{ asset('icons/book.svg') }}"></i>
                        <span class="nav-text">Pembelajaran</span>
                    </a>
                    <ul aria-expanded="false">
                        @role('Admin')
                            <li><a href="{{ route('web.category.index') }}">Kategori Pelajaran</a></li>
                        @endrole
                        <li><a href="{{ route('web.course.index') }}">Kumpulan Materi</a></li>
                        <li><a href="{{ route('web.live-class.index') }}">Live Class</a></li>
                    </ul>
                </li>
            @endhasanyrole
            @hasanyrole(['Admin', 'Konselor'])
                <li><a href="{{ route('web.live-counseling.index') }}" class="ai-icon" aria-expanded="false">
                        <i>
                            <img src="{{ asset('icons/message.svg') }}">
                        </i>
                        <span class="nav-text">Konseling</span>
                    </a>
                </li>
            @endhasanyrole
            <li><a href="{{ route('web.discussion.index') }}" class="ai-icon" aria-expanded="false">
                    <i>
                        <img src="{{ asset('icons/group.svg') }}">
                    </i>
                    <span class="nav-text">Diskusi</span>
                </a>
            </li>
            @hasanyrole(['Admin', 'Siswa'])
                <li>
                    <a href="{{ route('web.help-center.index') }}">
                        <i><img src="{{ asset('icons/question.svg') }}"></i>
                        <span class="nav-text">Pusat Bantuan</span>
                    </a>
                </li>
            @endhasanyrole
        </ul>
    </div>
</div>
