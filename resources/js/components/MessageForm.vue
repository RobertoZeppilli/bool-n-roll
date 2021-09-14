<template>
  <div class="animate__animated animate__zoomIn">
    <h2>Manda un messaggio</h2>
    <form method="POST" @submit.prevent="sendMessage(musicianId)">
      <div class="form-group">
        <label for="email">Email*</label>
        <input
          type="email"
          class="form-control"
          placeholder="Inserisci qui la tua mail..."
          v-model="message.email"
          name="email"
          id="email"
        />
        <div v-if="errors">
          <small
            class="text-danger"
            v-for="(error, index) in errors.email"
            :key="`err-email-${index}`"
            >{{ error }}</small
          >
        </div>
      </div>

      <div class="form-group">
        <label for="name">Nome*</label>
        <input
          type="text"
          class="form-control"
          name="name"
          id="name"
          rows="5"
          v-model="message.name"
          placeholder="Il tuo nome..."
        />
        <div v-if="errors">
          <small
            class="text-danger"
            v-for="(error, index) in errors.name"
            :key="`err-name-${index}`"
            >{{ error }}</small
          >
        </div>
      </div>
      <div class="form-group">
        <label for="surname">Cognome</label>
        <input
          type="text"
          class="form-control"
          name="surname"
          id="surname"
          rows="5"
          v-model="message.surname"
          placeholder="Il tuo cognome..."
        />
        <div v-if="errors">
          <small
            class="text-danger"
            v-for="(error, index) in errors.surname"
            :key="`err-sur-${index}`"
            >{{ error }}</small
          >
        </div>
      </div>

      <div class="form-group">
        <label for="message">Messaggio*</label>
        <textarea
          class="form-control"
          name="message"
          id="message"
          rows="5"
          v-model="message.message"
          placeholder="Scrivi il tuo messaggio..."
        ></textarea>

        <div v-if="errors">
          <small
            class="text-danger"
            v-for="(error, index) in errors.message"
            :key="`err-msg-${index}`"
            >{{ error }}</small
          >
        </div>
      </div>
      <div class="py-1">
        <small>I campi con (*) sono obbligatori</small>
      </div>

      <!-- <vs-button type="submit" >invia il messaggio</vs-button> -->
      <button type="submit" class="btn btn-petrol text-white">
        {{ sending ? "Invio in corso..." : "Invia Messaggio" }}
        <!-- Invia -->
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: "MessageForm",

  data() {
    return {
      message: {
        musician_id: "",
        name: "",
        surname: "",
        email: "",
        message: "",
      },
      errors: null,
      sending: false,
    };
  },

  props: ["musicianId"],

  methods: {
    sendMessage(id) {
      this.sending = true;

      this.message.musician_id = id;
      // this.message.id = this.musicianId;
      axios
        .post("http://127.0.0.1:8000/api/message", this.message)
        .then((res) => {

          this.sending = false
          // console.log(this.message)
          // this.message.id = this.musicianId;
          // console.log(res.data.errors)
          console.log(res.data);
          if (res.data.errors) {
            this.errors = res.data.errors;
            // this.success = true
            this.sending = false
            // this.$route.push({ name: 'home' })
          } else {
            this.errors = {};
            // this.sending = false;
            // this.success = true
            this.message = {};
            this.$router.push({ name: "message-confirm" });
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
</style>