@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Steckbrief ausfüllen</div>

                <div class="card-body">
                    <form class="form" action="{{ url('/charasteristics') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="name">Vor- und Nachnname</label>
                            <input class="form-control" id="name" type="text" value="{{ Auth::user()->member->firstname . ' ' . Auth::user()->member->lastname }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="bd">Geburtsdatum</label>
                            <input class="form-control" id="bd" type="date" name="birthdate" value="2002-01-01" >
                        </div>
                        @if ($errors->has('bd'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('bd') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Senden">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
