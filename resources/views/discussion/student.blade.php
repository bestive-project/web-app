@if ($user->student && $user->student->studyGroup && $user->student->studyGroup->discussion)
    <div class="row align-items-center" style="padding-top: 8rem">
        <div class="col-lg-4 offset-2">
            <a href="{{ $user->student->studyGroup->discussion->wa_link }}" target="_blank" rel="noopener noreferrer"
                class="text-white">
                <div class="card bg-success text-white">
                    <div class="card-body text-center"><i class="fab fa-whatsapp" style="font-size: 50px"></i></div>
                    <div class="card-footer text-center">
                        Klik Disini
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{ $user->student->studyGroup->discussion->discord_link }}" target="_blank"
                rel="noopener noreferrer" class="text-white">
                <div class="card bg-secondary text-white">
                    <div class="card-body text-center"><i class="fab fa-discord"
                            style="font-size: 50px; margin-left: 0"></i>
                    </div>
                    <div class="card-footer text-center">
                        Klik Disini
                    </div>
                </div>
            </a>
        </div>
    </div>
@else
    <div class="alert alert-danger text-white solid">
        Anda belum masuk kelompok belajar. Segera hubungi admin Bestive!
    </div>
@endif
