@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin-Panel</div>

                <div class="card-body">
                  @if (isset($generate))
                    <form method="get" action="admin/generate">
                      @csrf
                      <input type="submit" class="btn btn-primary" value="Accounts generieren">
                    </form>
                  @else
                    <button type="button" class="btn btn-secondary" disabled>Accounts bereits generiert</button>
                    <hr>
                    <h2 class="h4">Rankings</h2>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Typ</th>
                          <th scope="col">Bezeichnung</th>
                          <th scope="col">Bezeichnung (alternativ)</th>
                          <th scope="col">Aktionen</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rankings as $r)
                          @if(isset($edit_ranking) and $edit_ranking == $r->id)
                            <tr>
                              <td></td>
                              <td>{{ $r->title }}</td>
                              <td>{{ $r->title_woman }}</td>
                              <td>
                                <button class="btn btn-success">Speichern</button>
                              </td>
                            </tr>
                          @else
                            <tr>
                              @if(!$r->for_teachers)
                                @if(!$r->pair)
                                  @if(!$r->both_genders)
                                    <td>S E</td>
                                  @else
                                    <td>S Z</td>
                                  @endif
                                @else
                                  <td>S P</td>
                                @endif
                              @else
                                @if(!$r->pair)
                                  @if(!$r->both_genders)
                                    <td>L E</td>
                                  @else
                                    <td>L Z</td>
                                  @endif
                                @else
                                  <td>L P</td>
                                @endif
                              @endif
                              <td>{{ $r->title }}</td>
                              <td>{{ $r->title_woman }}</td>
                              <td>
                                <button class="btn btn-primary disabled" disabled>Ändern</button>
                                <button class="btn btn-primary disabled" disabled>Löschen</button>
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                    <small>S = Schüler; L = Lehrer; Z = Zusammen; E = Einzeln; P = Paar.</small>
                    <hr>
                    <h2 class="h4">Accountübersicht</h2>
                    <p><span class="font-weight-bold">{{ $count_has_voted }}</span> Schüler {{ ($count_has_voted != 1 ? "haben" : "hat") }} abgestimmt. <span class="font-weight-bold">{{ $count_has_filled }}</span> Schüler {{ ($count_has_filled != 1 ? "haben" : "hat") }} den Steckbrief ausgefüllt. (Gesamt: {{  $members->count() }})</p>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Schüler</th>
                          <th scope="col">Authentifizierungsschlüssel</th>
                          <th scope="col">Rankings</th>
                          <th scope="col">Steckbrief</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($members as $m)
                          <tr>
                            <td>{{ $m->firstname . ' ' . $m->lastname }}</td>
                            <td>{{ $m->user->name }}</td>
                            <td><span class="{{ ($m->user->has_voted ? 'text-success font-weight-bold' : 'font-italic text-muted') }}">{{ ($m->user->has_voted ? 'abgestimmt' : 'ausstehend') }}</span></td>
                            <td><span class="{{ ($m->user->has_filled ? 'text-success font-weight-bold' : 'font-italic text-muted') }}">{{ ($m->user->has_filled ? 'ausgefüllt' : 'ausstehend') }}</span></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
