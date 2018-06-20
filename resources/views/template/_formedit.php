<!-- Artiste DropDown Form Input -->
<div class="form-group row">
    <label for="artiste" class="col-sm-4 col-form-label text-md-right"><strong>{{ __('Artiste') }}</strong></label>

    <div class="col-md-6">
        <input id="artiste" type="text" value="{{$oeuvre->nom}}" disabled="disabled" class="form-control{{ $errors->has('artiste') ? ' is-invalid' : '' }}" name="artiste" value="{{ old('artiste') }}" required autofocus >

        @if ($errors->has('artiste'))
            <span class="invalid-feedback">
                <strong><font>{{ $errors->first('artiste') }}</font></strong>
            </span>
        @endif
    </div>
</div>

<!-- Album Form Input -->
<div class="form-group row">
    <label for="album" class="col-sm-4 col-form-label text-md-right"><strong>{{ __('Album') }}</strong></label>

    <div class="col-md-6">
        <input id="album" type="text" value="{{$oeuvre->titre}}" class="form-control{{ $errors->has('album') ? ' is-invalid' : '' }}" name="album" value="{{ old('album') }}" required autofocus >

        @if ($errors->has('album'))
            <span class="invalid-feedback">
                <strong><font>{{ $errors->first('album') }}</font></strong>
            </span>
        @endif
    </div>
</div>

<!-- Type Jacquette DropDown Form Input -->
<div class="form-group row">
    <label for="jaquette" class="col-sm-4 col-form-label text-md-right"><strong>{{ __('Type jaquette') }}</strong></label>

    <div class="col-md-6">
        {{--Autofill dropdown edit form--}}
        <select id="jaquette" name="jaquette" class="form-control" required >

            @if($jaq->count())

                <option value="">-- Selectionner --</option>
                @foreach ($jaq as $jaquettes)
                    <option value="{{$jaquettes->id}}" {{ $jaquettes->id == $oeuvre->ids ? 'selected' : '' }}>{{$jaquettes->name}}</option>

                @endforeach
            @endif
        </select>

        @if ($errors->has('jaquette'))
            <span class="invalid-feedback">
                <strong><font>{{ $errors->first('jaquette') }}</font></strong>
            </span>
        @endif
    </div>
</div>

<!-- Distributeur Form Input -->
<div class="form-group row">
    <label for="distributeur" class="col-sm-4 col-form-label text-md-right"><strong>{{ __('Distributeur') }}</strong></label>

    <div class="col-md-6">
        <input id="distributeur" type="text" value="{{$oeuvre->distributeur}}" class="form-control{{ $errors->has('distributeur') ? ' is-invalid' : '' }}" name="distributeur" value="{{ old('distributeur') }}">

        @if ($errors->has('distributeur'))
            <span class="invalid-feedback">
                <strong><font>{{ $errors->first('distributeur') }}</font></strong>
            </span>
        @endif
    </div>
</div>


<!-- Quantite Form Input -->
<div class="form-group row">
    <label for="quantite" class="col-sm-4 col-form-label text-md-right"><strong>{{ __('Quantité') }}</strong></label>

    <div class="col-md-6">
        <input id="quantite" type="number" value="{{$oeuvre->qte}}" class="form-control{{ $errors->has('quantite') ? ' is-invalid' : '' }}" name="quantite" value="{{ old('quantite') }}" required>

        @if ($errors->has('quantite'))
            <span class="invalid-feedback">
                <strong><font>{{ $errors->first('quantite') }}</font></strong>
            </span>
        @endif
    </div>
</div>