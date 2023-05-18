@extends('template.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger solid">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger solid">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pusat Bantuan</h4>
                </div>
                <div class="card-body" id="dataTable">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        let params = {
            per_page: 10,
            page: 1,
            search: "",
            tipe: ""
        }

        $(function() {
            getHelpCenters();

            $("body").on("input", "#searching", function() {
                params.search = $(this).val()
                setTimeout(() => {
                    getHelpCenters()
                }, 1000);
            })

            $("body").on("change", "#typeSearch", function() {
                params.tipe = $(this).val()
                setTimeout(() => {
                    getHelpCenters()
                }, 1000);
            })

        })

        function getHelpCenters() {
            $.ajax({
                url: '{{ route('web.help-center.table') }}',
                type: "get",
                data: params,
                success: function(response) {
                    $("#dataTable").html(response)
                }
            })
        }

        function pageChange(e) {
            params.page = e
            getHelpCenters()
        }
    </script>
@endpush
