@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Steckbrief ausfüllen</div>

                <div class="card-body">
                    @if ($errors->count() > 0)
                      <div class="alert alert-danger">
                        Eine oder mehrere Angaben sind fehlerhaft!
                      </div>
                    @endif
                    <p>Bitte fülle hier deinen persönlichen Steckbrief aus. Nimm dir dafür ein paar Minuten Zeit, denn speichern kannst du erst, wenn alles ausgefüllt ist. Sei gerne etwas Kreativ, dafür haben wir dir die Möglichkeit gegeben, auch bei Ja/Nein-Fragen mit Freitext zu antworten.</p>
                    <p>Wenn du Fragen hast, kannst du dich persönlich an uns wenden, entweder direkt per WhatsApp oder mit dem Nachrichten-Funktion im Hauptmenü. Wir werden uns dann zeitnah bei dir melden.</p>
                    <hr>
                    <form class="form" action="{{ url('/characteristics') }}" methoD="post">
                    @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" type="text" value="{{ Auth::user()->member->firstname . ' ' . Auth::user()->member->lastname }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="bd">Geburtsdatum</label>
                            <input class="form-control" id="bd" type="date" name="birthdate" value="2002-01-01" required>
                            @if ($errors->has('birthdate'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('birthdate') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="residence">Wohnort</label>
                            <input class="form-control" id="residence" name="residence" type="text" value="{{ old("residence") }}" required>
                            @if ($errors->has('residence'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('residence') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="adv_courses">Leistunskurse</label>
                            <input class="form-control" id="adv_courses" name="adv_courses" type="text" value="{{ old("adv_courses") }}" required>
                            @if ($errors->has('adv_courses'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('adv_courses') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="right_advs">Richtige Wahl?</label>
                            <input class="form-control" id="right_advs" name="right_advs" type="text" value="{{ old("right_advs") }}" required>
                            @if ($errors->has('right_advs'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('right_advs') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="best_topics">Lieblingsfächer</label>
                            <input class="form-control" id="best_topics" name="best_topics" type="text" value="{{ old("best_topics") }}" required>
                            @if ($errors->has('best_topics'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('best_topics') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="worst_topics">Hassfächer</label>
                            <input class="form-control" id="worst_topics" name="worst_topics" type="text" value="{{ old("worst_topics") }}" required>
                            @if ($errors->has('worst_topics'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('worst_topics') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="best_friends">Best friends (optional)</label>
                            <input class="form-control" id="best_friends" name="best_friends" type="text" value="{{ old("best_friends") }}">
                            @if ($errors->has('best_friends'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('best_friends') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="best_moment">Bester Moment der letzten drei Jahre (optional)</label>
                            <input class="form-control" id="best_moment" name="best_moment" type="text" value="{{ old("best_moment") }}">
                            @if ($errors->has('best_moment'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('best_moment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="worst_moment">Schlimmster Moment der letzten drei Jahre (optional)</label>
                            <input class="form-control" id="worst_moment" name="worst_moment" type="text" value="{{ old("worst_moment") }}">
                            @if ($errors->has('worst_moment'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('worst_moment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="best_teacher">Lieblingslehrer (optional)</label>
                            <select class="form-control" id="best_teacher" name="teacher_id" value="{{ old("teacher_id") }}">
                                <option value="" selected>Lehrer wählen</option>
                              @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    @if($teacher->is_woman)
                                        Frau {{ $teacher->lastname }}
                                    @else
                                        Herr {{ $teacher->lastname }}
                                    @endif
                                </option>
                              @endforeach
                            </select>
                            @if ($errors->has('teacher_id'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('teacher_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="way_of_learning">Lebens-/Lerneinstellung</label>
                            <input class="form-control" id="way_of_learning" name="way_of_learning" type="text" value="{{ old("way_of_learning") }}" required>
                            @if ($errors->has('way_of_learning'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('way_of_learning') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="thanks">Dankesworte</label>
                            <textarea class="form-control" id="thanks" name="thanks" rows="4" cols="80" required maxlength=1600>{{ old("thanks") }}</textarea>
                            @if ($errors->has('thanks'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('thanks') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="most_important">Ohne das wäre ich niemals so weit gekommen</label>
                            <input class="form-control" id="most_important" name="most_important" type="text" value="{{ old("most_important") }}" required>
                            @if ($errors->has('most_important'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('most_important') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="after_a_levels">So geht es nach dem Abi weiter</label>
                            <input class="form-control" id="after_a_levels" name="after_a_levels" type="text" value="{{ old("after_a_levels") }}" required>
                            @if ($errors->has('after_a_levels'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('after_a_levels') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="taken_from_school">Was ich aus der Schule mitnehme?</label>
                            <input class="form-control" id="taken_from_school" name="taken_from_school" type="text" value="{{ old("taken_from_school") }}" required>
                            @if ($errors->has('taken_from_school'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('taken_from_school') }}</strong>
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
