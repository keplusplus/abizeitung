@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Für Rankings abstimmen</div>

                <div class="card-body">
                  @if ($errors->count() > 0)
                    <div class="alert alert-danger">
                      Eine oder mehrere Angaben sind fehlerhaft!
                    </div>
                  @endif
                  <p>
                      Auf dieser Seite findest du die Lehrer-/ und Schülerrankings, für die du hier deine Stimme abgeben kannst. Da du nicht zwischendrin speichern kannst, nimm dir ein bisschen Zeit. Bei Fragen kontaktiere uns einfach.
                  </p>
                  <p>
                      Die abgegebenen Stimmen werden natürlich vollständig anonym verarbeitet. Abgedruckt werden voraussichtlich jeweils die Top 3 einer Kategorie.
                  </p>
                  <hr>
                  <form method="post" action="{{ url('/rankings') }}">
                    @csrf
                    <h4 class="h4">Schülerrankings</h4>
                    @foreach ($rankings_members as $r)
                      <div class="form-group">
                        @if (!$r->pair)
                          @if ($r->both_genders)
                            <label for="r{{ $r->id }}">{{$r->title}}</label>
                            <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                              @if (old('r' . $r->id) == null)
                                <option value="" disabled selected>Schülerin oder Schüler wählen</option>
                              @endif
                              @foreach ($members as $m)
                                <option value="{{ $m->id }}" {{ (old('r' . $r->id) == $m->id ? "selected":"") }}>{{ $m->firstname . ' ' . $m->lastname }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                            @endif
                          @elseif (!$r->both_genders)
                            @if (isset($r->title_woman))
                              <label for="r{{ $r->id . '_2' }}">{{ $r->title_woman }}</label>
                            @else
                              <label for="r{{ $r->id }}">{{$r->title}}</label>
                            @endif
                            <select class="form-control mb-2" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                              @if (old('r' . $r->id) == null)
                                <option value="" disabled selected>Schülerin wählen</option>
                              @endif
                              @foreach ($members_female as $m)
                                <option value="{{ $m->id }}" {{ (old('r' . $r->id) == $m->id ? "selected":"") }}>{{ $m->firstname . ' ' . $m->lastname }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                            @endif
                            @if (isset($r->title_woman))
                              <label for="r{{ $r->id }}">{{$r->title}}</label>
                            @endif
                            <select class="form-control" name="r{{ $r->id . '_2' }}" id="r{{ $r->id . '_2' }}" required>
                              @if (old('r' . $r->id . '_2') == null)
                                <option value="" disabled selected>Schüler wählen</option>
                              @endif
                              @foreach ($members_male as $m)
                                <option value="{{ $m->id }}" {{ (old('r' . $r->id . '_2') == $m->id ? "selected":"") }}>{{ $m->firstname . ' ' . $m->lastname }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('r' . $r->id . '_2'))
                              <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('r' . $r->id . '_2') }}</strong>
                              </span>
                            @endif
                          @endif
                        @elseif ($r->pair)
                          <label for="r{{ $r->id }}">{{$r->title}}</label>
                          <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                            @if (old('r' . $r->id) == null)
                              <option value="" disabled selected>Schülerin oder Schüler wählen</option>
                            @endif
                            @foreach ($members as $m)
                              <option value="{{ $m->id }}" {{ (old('r' . $r->id) == $m->id ? "selected":"") }}>{{ $m->firstname . ' ' . $m->lastname }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id))
                            <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('r' . $r->id) }}</strong>
                            </span>
                          @endif
                          <select class="form-control mt-2" name="r{{ $r->id . '_2' }}" id="r{{ $r->id . '_2' }}" required>
                            @if (old('r' . $r->id . '_2') == null)
                              <option value="" disabled selected>Schülerin oder Schüler wählen</option>
                            @endif
                            @foreach ($members as $m)
                              <option value="{{ $m->id }}" {{ (old('r' . $r->id . '_2') == $m->id ? "selected":"") }}>{{ $m->firstname . ' ' . $m->lastname }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id) . '_2')
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
                        @if(!$r->pair and !$r->only_tutor)
                          @if ($r->both_genders)
                            <label for="r{{ $r->id }}">{{$r->title}}</label>
                            <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                              @if (old('r' . $r->id) == null)
                                <option value="" disabled selected>Lehrerin oder Lehrer wählen</option>
                              @endif
                              @foreach ($teachers as $t)
                                @if (!$t->is_woman)
                                  <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Herr ' . $t->lastname }}</option>
                                @else
                                  <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Frau ' . $t->lastname }}</option>
                                @endif
                              @endforeach
                            </select>
                            @if ($errors->has('r' . $r->id))
                              <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('r' . $r->id) }}</strong>
                              </span>
                            @endif
                          @elseif (!$r->both_genders)
                            @if (isset($r->title_woman))
                              <label for="r{{ $r->id . '_2' }}">{{ $r->title_woman }}</label>
                            @else
                              <label for="r{{ $r->id }}">{{$r->title}}</label>
                            @endif
                            <select class="form-control mb-2" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                              @if (old('r' . $r->id) == null)
                                <option value="" disabled selected>Lehrerin wählen</option>
                              @endif
                              @foreach ($teachers_female as $t)
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Frau ' . $t->lastname }}</option>
                              @endforeach
                            </select>
                            @if (isset($r->title_woman))
                              <label for="r{{ $r->id }}">{{$r->title}}</label>
                            @endif
                            <select class="form-control" name="r{{ $r->id . '_2' }}" id="r{{ $r->id . '_2' }}" required>
                              @if (old('r' . $r->id) == null)
                                <option value="" disabled selected>Lehrer wählen</option>
                              @endif
                              @foreach ($teachers_male as $t)
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id . '_2') == $t->id ? "selected":"") }}>{{ 'Herr ' . $t->lastname }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('r' . $r->id . '_2'))
                              <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('r' . $r->id . '_2') }}</strong>
                              </span>
                            @endif
                          @endif
                        @elseif($r->pair)
                          <label for="r{{ $r->id }}">{{$r->title}}</label>
                          <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                            @if (old('r' . $r->id) == null)
                              <option value="" disabled selected>Lehrerin oder Lehrer wählen</option>
                            @endif
                            @foreach ($teachers as $t)
                              @if (!$t->is_woman)
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Herr ' . $t->lastname }}</option>
                              @else
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Frau ' . $t->lastname }}</option>
                              @endif
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id))
                            <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('r' . $r->id) }}</strong>
                            </span>
                          @endif
                          <select class="form-control mt-2" name="r{{ $r->id . '_2' }}" id="r{{ $r->id . '_2' }}" required>
                            @if (old('r' . $r->id) == null)
                              <option value="" disabled selected>Lehrerin oder Lehrer wählen</option>
                            @endif
                            @foreach ($teachers as $t)
                              @if (!$t->is_woman)
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id . '_2') == $t->id ? "selected":"") }}>{{ 'Herr ' . $t->lastname }}</option>
                              @else
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id . '_2') == $t->id ? "selected":"") }}>{{ 'Frau ' . $t->lastname }}</option>
                              @endif
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id) . '_2')
                            <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('r' . $r->id . '_2') }}</strong>
                            </span>
                          @endif
                        @elseif($r->only_tutor)
                          <label for="r{{ $r->id }}">{{$r->title}}</label>
                          <select class="form-control" name="r{{ $r->id }}" id="r{{ $r->id }}" required>
                            @if (old('r' . $r->id) == null)
                              <option value="" disabled selected>Lehrerin oder Lehrer wählen</option>
                            @endif
                            @foreach ($tutors as $t)
                              @if (!$t->is_woman)
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Herr ' . $t->lastname }}</option>
                              @else
                                <option value="{{ $t->id }}" {{ (old('r' . $r->id) == $t->id ? "selected":"") }}>{{ 'Frau ' . $t->lastname }}</option>
                              @endif
                            @endforeach
                          </select>
                          @if ($errors->has('r' . $r->id))
                            <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('r' . $r->id) }}</strong>
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
