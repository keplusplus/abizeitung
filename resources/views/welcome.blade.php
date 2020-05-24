@extends('layouts.app')

@section('content')
@if(isset(auth()->user()->is_admin) && auth()->user()->is_admin)
  <meta http-equiv="refresh" content="3; URL=./admin/">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card"><div class="card-header">Weiterleitung</div><div class="card-body">Leite zum Admin-Panel weiter...</div></div>
          </div>
      </div>
  </div>
@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if(isset($construction))
                <div class="card-header">Wartungsarbeiten</div>

                <div class="card-body">
                  <div class="alert alert-warning outline-warning border border-warning">
                  Hier entsteht eine Seite für den Abiturjahrgang 2020.
                  </div>
                </div>
              @else
                <div class="card-header">Hauptmenü</div>

                <div class="card-body">
                  @guest
                    @if (isset($error))
                      @if ($error == 1)
                        <div class="alert alert-danger">
                        Kein Authentifizierungsschlüssel angegeben!
                        </div>
                      @elseif ($error == 2)
                        <div class="alert alert-danger">
                        Authentifizierungsschlüssel hat die falsche Länge!
                        </div>
                      @elseif ($error == 3)
                        <div class="alert alert-danger">
                        Authentifizierungsschlüssel inkorrekt!
                        </div>
                      @else
                        <div class="alert alert-danger">
                        Unbekannter Fehler!
                        </div>
                      @endif
                    @endif
                  @endguest
                  @auth
                    <!-- AUSWAHLMOEGLICHKEITEN -->
                    <p><strong>Eingeloggt als {{ Auth::user()->member->firstname . ' ' . Auth::user()->member->lastname }}.</strong></p>
                    <p>
                      Dies ist Dein persönlicher Bereich, um sowohl inhaltlich, als auch mit weiteren Ideen und Anregungen zu unserer Abizeitung beizutragen.<br>
                      Die meisten Angaben sollten selbsterklärend sein. Einmalig musst Du Deinen Steckbrief ausfüllen und die Stimmen für die Rankings abgeben. Alles andere kannst du immer wieder verwenden, beispielweise kannst du alle Deine gesammelten Sprüche von Schülern und Lehrern einsenden.<br>
                      Wenn Du noch Fragen an uns hast, kannst Du Dich jederzeit über den letzen Punkt (Nachricht an Gremium) oder direkt per WhatsApp an uns wenden.
                    </p>
                    <p>
                      Wir danken Dir schonmal für die Eintragungen und hoffen mit diesen eine schöne Abizeitung anfertigen zu können, die uns zukünftig immer wieder an unsere gemeinsame Zeit erinnern wird.<br>
                      <strong>Das Gremium "Abizeitung"</strong>
                    </p><br>
                    <p>
                      @if(isset(Auth::user()->member->photo_date))
                        Dein Termin für das Steckbrief-Foto: {{ date('d.m.Y', strtotime(Auth::user()->member->photo_date)) }}<br>
                        Bitte komm am genannten Tag <strong>mit dem Abipulli</strong> in der ersten großen Pause (10:10 Uhr) ins Foyer.
                      @else
                        Du hast noch keinen Termin für das Steckbrief-Foto. Schau später an dieser Stelle noch einmal nach, der erste Termin ist der 3. Februar 2020.
                      @endif
                    </p>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col d-flex">
                        <h4 class="h4 my-auto">Rankings (einmalig abstimmen)</h4>
                      </div>
                      <div class="col-auto">
                        @if(!isset($has_voted) || $has_voted == 0)
                          <a href="{{ url('/rankings') }}" class="btn btn-warning">Abstimmen</a>
                        @else
                          <button type="button" class="btn btn-disabled btn-success" disabled>Bereits abgestimmt</a>
                        @endif
                      </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col d-flex">
                        <h4 class="h4 my-auto">Eigener Steckbrief (einmalig ausfüllen)</h4>
                      </div>
                      <div class="col-auto">
                        @if(!isset($has_filled) || $has_filled == 0)
                          <a href="{{ url('/characteristics') }}" class="btn btn-warning">Ausfüllen</a>
                        @else
                          <button type="button" class="btn btn-disabled btn-success" disabled>Bereits ausgefüllt</a>
                        @endif
                      </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col d-flex">
                        <h4 class="h4 my-auto">Kommentar auf anderen Steckbriefen</h4>
                      </div>
                      <div class="col-auto">
                        <a href="{{ url('/comment') }}" class="btn btn-primary">Erstellen</a>
                      </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col d-flex">
                        <h4 class="h4 my-auto">Zitate Lehrer / Schüler</h4>
                      </div>
                      <div class="col-auto">
                        <a href="{{ url('/quote') }}" class="btn btn-primary">Einsenden</a>
                      </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col d-flex">
                        <h4 class="h4 my-auto">"Wisst ihr noch als..."-Momente</h4>
                      </div>
                      <div class="col-auto">
                        <a href="{{ url('/moment') }}" class="btn btn-primary">Einsenden</a>
                      </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                      <div class="col d-flex">
                        <h4 class="h4 my-auto">Nachricht an Gremium (für Ideen, Wünsche, Anregungen)</h4>
                      </div>
                      <div class="col-auto">
                        <a href="{{ url('/idea') }}" class="btn btn-primary">Verfassen</a>
                      </div>
                    </div>

                  @endauth
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection
