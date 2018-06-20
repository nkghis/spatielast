@can('edit_titulaires')
    <a href="{{ route($entity.'.edit', [str_singular($entity) => $id])  }}" class="btn btn-info">
        <i class="material-icons">edit</i> {{--Editer--}}</a>
@endcan

@can('delete_titulaires')
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', ['titulaire' => $id]), 'style' => 'display: inline', 'onSubmit' => 'return Confirmation("êtes vous sure de supprimer?")']) !!}
    <button type="submit" class="btn-delete btn btn-danger">
        <i class="material-icons">delete_forever</i>{{--Supprimer--}}
    </button>
    {!! Form::close() !!}
@endcan