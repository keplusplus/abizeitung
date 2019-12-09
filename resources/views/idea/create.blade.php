@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nachricht an Gremium senden</div>

                <div class="card-body">
                  @if (isset($success))
                    <div class="alert alert-success">
                      Nachricht erfolgreich gesendet! Wir melden uns...
                    </div>
                  @endif
                  <p>Wenn du eine Idee hast, die du uns unbedingt mitteilen möchtest, eigenen Inhalt beisteuern willst oder einfach eine Frage hast, kannst du dich hier einfach an uns wenden. Bitte hinterlasse auch eine E-Mail-Adresse oder deine Telefonnummer, jemand aus dem Gremium wird dich dann kontakieren. Alternativ kannst du jeden von uns auch einfach über WhatsApp ö. ä. anschreiben.</p>
                  <hr>
                  <form class="mt-3" method="post" action="{{ url('/idea') }}" name="ideaform">
                    @csrf
                    <input id="targetHidden" type="hidden" name="member_id" value="{{ Auth::user()->member->id }}">

                    <div class="form-group">
                      <label for="messageText">Nachricht</label>
                      <textarea class="form-control" name="message" id="messageText" value="{{ old('message') }}"  rows="6" cols="80" required></textarea>
                      @if ($errors->has('message'))
                          <span class="invalid-feedback d-block" role="alert">
                              <strong>{{ $errors->first('message') }}</strong>
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
