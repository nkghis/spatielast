@extends('layouts.app')

@section('title', 'Artiste')


@section('bootstrap')

{{--Css for Autocompleted--}}
<!--{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />--}}
<link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet">-->


{{--Css for Datatables--}}
<!--
{{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">--}}
<link href="{{ asset('datatables/css/CssDatatables.css') }}" rel="stylesheet">
-->

@endsection

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('jquery')

{{--Autocompleted JavaScript--}}
<!--<script src="{{ asset('select2/js/select2.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}-->

{{--Autocompleted Script & DataTable Script--}}
<!--<script type="text/javascript">
    $(document).ready(function(){

        src = "{{ route('artistes.atcartiste') }}";
        {{--src1 = "{{ route('titulaires.atcannee') }}";--}}

        $("#artiste").select2({
            placeholder: 'Selectionner un artiste',
            ajax: {
                url: src,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.nom,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $('#index-artiste').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json'
            },
            order: [[ 0, "desc" ]],
            pageLength: 5
        });
    });
</script>-->

{{--Script to show modal if validation return error--}}
<!--<script type="text/javascript">
    @if (count($errors) > 0)
        $('#artisteModal').modal('show');
    @endif
</script>-->

   
@endsection