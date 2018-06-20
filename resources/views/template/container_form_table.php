@extends('layouts.app')
@section('title', 'Artiste')


@section('bootstrap')
    {{--Css for Autocompleted--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />--}}
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet">

    {{--Css for Datatables--}}
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">--}}
    <link href="{{ asset('datatables/css/CssDatatables.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        

        <div class="card">{{--panel--}}

            <div class="card-header">{{--panel header--}}

                <div class="row">

                    <div class="col-md-8">{{--panel Header Title--}}
                        <h3>Creer un nouvel enregistrement.</h3>
                    </div>

                    <div class="col-md-4 page-action text-right">{{--panel header Button right--}}
                        @can('add_artistes')
                            <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#artisteModal"> <i class="material-icons">open_in_new</i> <b>Nouveau artiste</b></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body"> {{--panel Body--}}

                
                <div>{{--Creation du formulaire--}}

                    <div class="row">
                        <div class="col-md-2"></div>

                        
                        <div class="col-md-8">{{--formulaire--}}

                        {!! Form::open(['route' => ['oeuvres.store'] ]) !!}
                        @include('oeuvre._form')
                        <!-- Submit Form Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Creer') }}
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </div>
                        <div class="col-md-2"></div>
                    </div>

                </div>

                <br>

                
                <div>{{--tableau liste enregistrament--}}
                    <div class="table-responsive">
                        <table class="table table-sm" id="index-artiste">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">Album</th>
                                <th class="text-center">Type jaquette</th>
                                <th class="text-center">Distributeur</th>
                                <th class="text-center">Quantité</th>
                                @can('edit_oeuvres', 'delete_oeuvres')
                                    <th class="text-center">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $oeuvres)
                                <tr>
                                    <td class="text-center">{{ $oeuvres->id }}</td>
                                    <td class="text-center">{{ $oeuvres->nom }}</td>
                                    <td class="text-center">{{ $oeuvres->titre }}</td>
                                    <td class="text-center">{{ $oeuvres->name }}</td>
                                    <td class="text-center">{{ $oeuvres->distributeur }}</td>
                                    <td class="text-center">{{ $oeuvres->qte }}</td>

                                    @can('edit_oeuvres')
                                        <td class="text-center">
                                            @include('shared._actionsOeuvre', [
                                                'entity' => 'oeuvres',
                                                'id' => $oeuvres->id
                                            ])
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="artisteModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(['route' => ['artistes.enregistrer'] ]) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="artisteModalLabel">Nouveau Artiste</h4>
                </div>
                <div class="modal-body">
                    <!-- Nom Artiste Form Input -->
                    <div class="form-group row">
                        <label for="nom" class="col-sm-4 col-form-label text-md-right"><strong>{{ __('Nom Artiste') }}</strong></label>

                        <div class="col-md-6">
                            <input id="nom" type="text" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ old('nom') }}">

                            @if ($errors->has('nom'))
                                <span class="invalid-feedback">
                                    <strong><font>{{ $errors->first('nom') }}</font></strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

                    <!-- Submit Form Button -->
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection


@section('jquery')
    {{--Autocompleted JavaScript--}}
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>


    {{--Autocompleted Script--}}
    <script type="text/javascript">
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
    </script>

    {{--Script to show modal if validation return error--}}
    <script type="text/javascript">
        @if (count($errors) > 0)
        $('#artisteModal').modal('show');
        @endif
    </script>
@endsection