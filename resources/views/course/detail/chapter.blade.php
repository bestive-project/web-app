<div class="my-post-content pt-3">
    <div class="d-flex justify-content-between">
        <a href="{{ route('web.chapter.create', $course->uuid) }}" class="btn btn-secondary mb-3">Tambah BAB</a>
        <a href="{{ route('web.course.index') }}" class="btn btn-warning mb-3 text-white">Kembali</a>
    </div>
    <div id="dataTable" class="mt-3"></div>
</div>

@push('js')
    <script>
        let params = {
            per_page: 10,
            page: 1,
            search: ""
        }

        $(function() {
            getUsers();

            $("body").on("keyup", "#searching", function() {
                params.search = $(this).val()
                setTimeout(() => {
                    getUsers()
                }, 1000);
            })
        })

        function getUsers() {
            $.ajax({
                url: '{{ route('web.chapter.table', $course->uuid) }}',
                type: "get",
                data: params,
                success: function(response) {
                    $("#dataTable").html(response)
                }
            })
        }

        function pageChange(e) {
            params.page = e
            getUsers()
        }
    </script>
@endpush
