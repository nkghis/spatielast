@extends('layouts.app')

@section('title', 'Creation')

@section('content')

    <div class="container">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Ajouter un utilisateur</h3>
                    </div>

                    <div class="col-md-4 page-action text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"><i class="material-icons">backspace</i> Retour</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    {!! Form::open(['route' => ['users.store'] ]) !!}
                    @include('user._form')
                    <!-- Submit Form Button -->
                        {!! Form::submit('Creer', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection