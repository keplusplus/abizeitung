@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Spruch hinzufügen</div>

                <div class="card-body">
                  @if (isset($success))
                    <div class="alert alert-success">
                      Spruch wurde erfolgreich hinzugefügt!
                    </div>
                  @endif
                  <span style="font-style: italic;">Informationstext</span>
                  <form class="mt-3" method="post" action="{{ url('/quote') }}" name="quoteform">
                    @csrf
                    <!--<div class="form-group">
                        <div class="btn-group btn-group-toggle" id="quoteType" data-toggle="buttons">
                            <label class="btn btn-outline-primary active">
                                <button type="button" name="type" autocomplete="off" onclick="setMember()" checked> Schülerspruch</button>
                            </label>
                            <label class="btn btn-outline-primary">
                                <button type="button" name="type" autocomplete="off" onclick="setTeacher()"> Lehrerspruch</button>
                            </label>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <input id="targetHidden" type="hidden" name="quote_for_teacher" value="0">
                        <button id="typeMember" class="btn btn-primary" type="button" onclick="setMember()">Schülerspruch</button>
                        <button id="typeTeacher" class="btn btn-outline-primary" type="button" onclick="setTeacher()">Lehrerspruch</button>
                    </div>
                    <div id="quoteMemberDiv" class="form-group">
                        <label for="quoteMember">Schüler wählen</label>
                        <select class="form-control" id="quoteMember" name="member_id" required>
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
                    <div id="quoteTeacherDiv" class="form-group" style="display: none;">
                        <label for="quoteTeacher">Lehrer wählen</label>
                        <select class="form-control" id="quoteTeacher" name="teacher_id">
                            <option value="" disabled selected>Lehrer wählen</option>
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
                      <label for="quoteText">Spruch</label>
                      <textarea class="form-control" name="quote" id="quoteText" rows="4" cols="80" placeholder="Beschreibe kurz die Situation..." required></textarea>
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

@push('scripts')
<script type="text/javascript">
var for_teacher = 0;

function setTeacher() {
    if(for_teacher != 1) {
        for_teacher = 1;
        $("#typeMember").attr('class', 'btn btn-outline-primary');
        $("#typeTeacher").attr('class', 'btn btn-primary');
        $("#targetHidden").attr('value', '1');
        $("#quoteMember").prop('required', false);
        $("#quoteTeacher").prop('required', true);

        $("#quoteTeacherDiv").attr('style', '');
        $("#quoteMemberDiv").attr('style', 'display: none;');
    }
}

function setMember() {
    if(for_teacher != 0) {
        for_teacher = 0;
        $("#typeMember").attr('class', 'btn btn-primary');
        $("#typeTeacher").attr('class', 'btn btn-outline-primary');
        $("#targetHidden").attr('value', '0');
        $("#quoteMember").prop('required', false);
        $("#quoteTeacher").prop('required', true);

        $("#quoteMemberDiv").attr('style', '');
        $("#quoteTeacherDiv").attr('style', 'display: none;');
    }
}
</script>
@endpush
