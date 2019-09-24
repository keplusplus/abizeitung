@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Steckbrief ausfüllen</div>

                <div class="card-body">
                    <form class="form" action="{{ url('/characteristics') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="name">Vor- und Nachnname</label>
                            <input class="form-control" id="name" type="text" value="{{ Auth::user()->member->firstname . ' ' . Auth::user()->member->lastname }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="bd">Geburtsdatum</label>
                            <input class="form-control" id="bd" type="date" name="birthdate" value="2002-01-01">
                            @if ($errors->has('birthdate'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('birthdate') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-check form-group">
                          <input class="form-check-input" type="checkbox" name="data_accepted" id="cb_data_agreement" required>
                          <label class="form-check-label" for="cb_data_agreement">
                              Ich versichere, dass meine Angaben korrekt sind und bin damit einverstanden, dass diese in der Abizeitung 2020 vom Gymnasium St. Xaver abgedruckt werden dürfen.
                          </label>
                          @if ($errors->has('data_accepted'))
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $errors->first('data_accepted') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Senden">
                        </div>
                    </form>
                    <div class="text-right">
                      <a href="{{ url('/') }}">Zurück</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
