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
                    Die abgegebenen Stimmen werden vollständig anonym verarbeitet. Abgedruckt werden voraussichtlich jeweils die Top 3 einer Kategorie.
                  </p>
                  <form method="post" action="{{ url('/rankings') }}">
                    @csrf
                    <h4 class="h4">Schülerrankings</h4>
                    @foreach ($rankings_members as $r)
                      <div class="form-group">
                        <label for="r{{ $r->id }}">{{ $r->title }}</label>
                        <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" value="{{ old('r' . $r->id) }}" required>
                          @if ($r->is_female and !$r->pair)
                            <option value="" disabled selected>Schülerin wählen</option>
                          @elseif (!$r->is_female and !$r->pair)
                            <option value="" disabled selected>Schüler wählen</option>
                          @else
                            <option value="" disabled selected>SchülerIn wählen</option>
                          @endif
                          @foreach ($members as $m)
                            @if (!$r->pair)
                              @if ($r->is_female and $m->is_woman)
                                <option value="{{ $m->id }}">{{ $m->firstname . ' ' . $m->lastname }}</option>
                              @endif
                              @if (!$r->is_female and !$m->is_woman)
                                <option value="{{ $m->id }}">{{ $m->firstname . ' ' . $m->lastname }}</option>
                              @endif
                            @else
                              <option value="{{ $m->id }}">{{ $m->firstname . ' ' . $m->lastname }}</option>
                            @endif
                          @endforeach
                        </select>
                        @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                        @endif
                        @if($r->pair)
                          <select class="form-control mt-2" name="r{{ $r->id }}_2" value="{{ old('r' . $r->id . '_2') }}" required>
                            <option value="" disabled selected>SchülerIn wählen</option>
                            @foreach ($members as $m)
                                <option value="{{ $m->id }}">{{ $m->firstname . ' ' . $m->lastname }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id . '_2'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('r' . $r->id . '_2') }}</strong>
                                </span>
                          @endif
                        @endif
                      </div>
                    @endforeach

                    <hr>
                    <h4 class="h4">Lehrerrankings</h4>
                    @foreach ($rankings_teachers as $r)
                      <div class="form-group">
                        <label for="r{{ $r->id }}">{{ $r->title }}</label>
                        <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" value="{{ old('r' . $r->id) }}" required>
                          @if ($r->is_female and !$r->pair)
                            <option value="" disabled selected>Lehrerin wählen</option>
                          @elseif (!$r->is_female and !$r->pair)
                            <option value="" disabled selected>Lehrer wählen</option>
                          @else
                            <option value="" disabled selected>LehrerIn wählen</option>
                          @endif
                          @foreach ($teachers as $t)
                            @if (!$r->only_tutor)
                              @if(!$r->pair)
                                @if ($r->is_female and $t->is_woman)
                                  <option value="{{ $t->id }}">{{ "Frau " . $t->lastname }}</option>
                                @endif
                                @if (!$r->is_female and !$t->is_woman)
                                  <option value="{{ $t->id }}">{{ "Herr " . $t->lastname }}</option>
                                @endif
                              @else
                                @if ($t->is_woman)
                                  <option value="{{ $t->id }}">{{ "Frau " . $t->lastname }}</option>
                                @else
                                  <option value="{{ $t->id }}">{{ "Herr " . $t->lastname }}</option>
                                @endif
                              @endif
                            @else
                              @if ($t->id == 59)
                                <option value="{{ $t->id }}">{{ "Frau " . $t->lastname }}</option>
                              @endif
                              @if ($t->id == 62)
                                <option value="{{ $t->id }}">{{ "Herr " . $t->lastname }}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                        @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                        @endif
                        @if($r->pair)
                          <select class="form-control mt-2" name="r{{ $r->id }}_2" value="{{ old('r' . $r->id . '_2') }}" required>
                            <option value="" disabled selected>LehrerIn wählen</option>
                            @foreach ($teachers as $t)
                              @if ($t->is_woman)
                                <option value="{{ $t->id }}">{{ "Frau " . $t->lastname }}</option>
                              @else
                                <option value="{{ $t->id }}">{{ "Herr " . $t->lastname }}</option>
                              @endif
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id . '_2'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('r' . $r->id . '_2') }}</strong>
                                </span>
                          @endif
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
