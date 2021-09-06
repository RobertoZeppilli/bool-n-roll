<template>
  <form>
    <!-- <input type="hidden" name="user_id" id="user_id" :value="doctorId" > -->

    <div class="form-group">
      <label for="mail">Inserisci la tua email*</label>
      <input
        type="email"
        class="form-control"
        placeholder="Inserisci qui la tua mail"
        required
        name="patient_mail"
        id="patient_mail"
      />
    </div>

    <div class="form-group">
      <label for="patient_name">Nome*</label>
      <input
        type="text"
        class="form-control"
        name="patient_name"
        id="patient_name"
        rows="5"
        placeholder="Il tuo nome"
        required
      />
    </div>
    <div class="form-group">
      <label for="text_message">Cognome</label>
      <input
        type="text"
        class="form-control"
        name="patient_surname"
        id="patient_surname"
        rows="5"
        placeholder="Il tuo cognome"
        required
      />
    </div>

    <div class="form-group">
      <label for="text_message">Message</label>
      <textarea
        class="form-control"
        name="text_message"
        id="text_message"
        rows="5"
        required
        placeholder="Cosa vorresti dire al dottore? Spiega brevemente la tua richiesta"
      ></textarea>
    </div>

    <!-- <vs-button type="submit" >invia il messaggio</vs-button> -->
    <button type="submit" class="btn btn-grad mt-3">
      <!-- {{ sending ? "Invio in corso..." : "Invia Messaggio" }} -->
      Invia
    </button>
  </form>
</template>

<script>
export default {

};
</script>

<style>
</style>