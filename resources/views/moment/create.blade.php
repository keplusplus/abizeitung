@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Wisst ihr noch als...?</div>

                <div class="card-body">
                  @if (isset($success))
                    <div class="alert alert-success">
                      "Wisst ihr noch als..."-Moment gespeichert!
                    </div>
                  @endif
                  <p>Hier kannst du die besten Momente der Rubrik "Wisst ihr noch als...?" einsenden. Diese werden hinterher anonym gesammelt in einer eigenen Rubrik abgedruckt.</p>
                  <hr>
                  <form class="mt-3" method="post" action="{{ url('/moment') }}" name="momentform">
                    @csrf
                    <div class="form-group">
                      <textarea class="form-control" name="text" id="momentText" value="{{ old('text') }}"  rows="2" cols="80" required maxlength="250" placeholder="Momentbeschreibung (maximal 250 Zeichen)"></textarea>
                      @if ($errors->has('text'))
                          <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('text') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Absenden</button>
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
