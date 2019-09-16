@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Für Rankings abstimmen</div>

                <div class="card-body">
                  <h3 class="h3">Rankings</h3>
                  <p>
                    !!!!!!! TODO anonym etc.
                  </p>
                  <form method="post" action="{{ url('/rankings') }}">
                    @csrf
                    <h4 class="h4">Schülerrankings</h4>
                    @foreach ($rankings_members as $r)
                      <div class="form-group">
                        <label for="r{{ $r->id }}">{{ $r->title }}</label>
                        <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" value="{{ old('r' . $r->id) }}" required>
                          <option value="" disabled selected>Schüler wählen</option>
                          @foreach ($members as $m)
                            <option value="{{ $m->id }}">{{ $m->firstname . ' ' . $m->lastname }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                        @endif
                      </div>
                    @endforeach

                    <hr>
                    <h4 class="h4">Lehrerrankings</h4>
                    @foreach ($rankings_teachers as $r)
                      <div class="form-group">
                        <label for="r{{ $r->id }}">{{ $r->title }}</label>
                        <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" value="{{ old('r' . $r->id) }}" required>
                          <option value="" disabled selected>Lehrer wählen</option>
                          @foreach ($teachers as $t)
                            @if (!$t->is_woman)
                              <option value="{{ $t->id }}">{{'Herr ' . $t->lastname }}</option>
                            @else
                              <option value="{{ $t->id }}">{{'Frau ' . $t->lastname }}</option>
                            @endif
                          @endforeach
                        </select>
                        @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                        @endif
                      </div>
                    @endforeach

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
