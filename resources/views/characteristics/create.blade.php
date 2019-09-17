@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kommentar hinterlassen</div>

                <div class="card-body">
                  @if (isset($success))
                    <div class="alert alert-success">
                      Kommentar wurde erfolgreich hinzugefügt!
                    </div>
                  @endif
                  Der Kommentar wird anonym im Steckbrief der gewählten Schülerin / des gewählten Schülers zu sehen sein. Es genügt auch ein einziges Wort, dass die Person beschreibt. Am Ende wird aus allen Einsendungen für jeden Steckbrief eine Liste angefertigt.
                  <form class="mt-3" method="post" action="{{ url('/comment') }}">
                    @csrf
                    <div class="form-group">
                      <label for="memberInput">Schüler</label>
                      <select class="form-control" id="memberInput" name="member_id" required>
                        <option value="" disabled selected>Schüler wählen</option>
                        @foreach ($members as $member)
                          <option value="{{ $member->id }}">
                            {{ $member->firstname . ' ' . $member->lastname }}
                          </option>
                        @endforeach
                      </select>
                      @if ($errors->has('member_id'))
                          <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('member_id') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="commentText">Kommentar</label>
                      <input type="text" class="form-control" id="commentText" name="comment" maxlength="80" placeholder="Maximal 80 Zeichen" required>
                      @if ($errors->has('comment'))
                          <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('comment') }}</strong>
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
