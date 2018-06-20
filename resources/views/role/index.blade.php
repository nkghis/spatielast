@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(['method' => 'post']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="roleModalLabel">Nouveau Rôle</h4>
                </div>
                <div class="modal-body">
                    <!-- name Form Input -->
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        {!! Form::label('name', 'Nom Rôle') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Fournisseur']) !!}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
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
    <div class="container">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Listes des rôles</h3>
                    </div>

                    <div class="col-md-4 page-action text-right">
                        @can('add_roles')
                            <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i class="material-icons">open_in_new</i> <b>Nouveau</b></a>
                        @endcan
                    </div>
                 </div>
            </div>
            <div class="card-body">
                @forelse ($roles as $role)
                    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update',  $role->id ], 'class' => 'm-b']) !!}

                    @if($role->name === 'Admin')
                        @include('shared._permissions', [
                                      'title' => $role->name .' Permissions',
                                      'options' => ['disabled'] ])
                    @else
                        @include('shared._permissions', [
                                      'title' => $role->name .' Permissions',
                                      'model' => $role ])
                        @can('edit_roles')
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        @endcan
                    @endif

                    {!! Form::close() !!}

                @empty
                    <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                @endforelse
            </div>

        </div>

    </div>


@endsection