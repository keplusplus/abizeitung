<template>
    <form class="mt-3" method="post" action="{{ url('/quote') }}">
      @csrf
      <div class="form-group">
          <div class="btn-group btn-group-toggle" id="quoteType" data-toggle="buttons">
              <label class="btn btn-outline-primary active">
                  <input type="radio" name="type" id="typeMember" autocomplete="off" checked> Schülerspruch
              </label>
              <label class="btn btn-outline-primary">
                  <input type="radio" name="type" id="typeTeacher" autocomplete="off"> Lehrerspruch
              </label>
          </div>
      </div>
      <div class="form-group">
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
      <div class="form-group d-none">
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
</template>

<script>
    export default {
        mounted() {
            console.log('Component form mounted.')
        }
    }
</script>
