@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Schüler</th>
                          <th scope="col">Authentifizierungsschlüssel</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($members as $m)
                          <tr>
                            <td>{{ $m->firstname . ' ' . $m->lastname }}</td>
                            <td>{{ $m->user->name }}</td>
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
