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