<template>
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
</template>

<script>
    export default {
        mounted() {
            console.log('Component form mounted.')
        }
    }
</script>
