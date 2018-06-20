@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="modal-title"><span class="badge badge-secondary">{{ $result->total() }}</span> {{ str_plural('Utilisateur', $result->count()) }} </h3>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4 page-action text-right">
                        @can('add_users')
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="material-icons">open_in_new</i> <b>Nouveau</b></a>
                        @endcan
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="result-set">
                    <table class="table table-bordered table-striped table-hover" id="data-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date Création</th>
                            @can('edit_users', 'delete_users')
                                <th class="text-center">Actions</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->roles->implode('name', ', ') }}</td>
                                <td>{{ $item->created_at->toFormattedDateString() }}</td>

                                @can('edit_users')
                                    <td class="text-center">
                                        @include('shared._actions', [
                                            'entity' => 'users',
                                            'id' => $item->id
                                        ])
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        {{ $result->links() }}
                    </div>
                </div>
            </div>
        </div>



    </div>


@endsection