<template>
  <div>
    <h2>Lascia una recensione</h2>
    <form method="POST" @submit.prevent="sendMessage(musicianId)">
      <!-- <input type="hidden" name="user_id" id="user_id" :value="doctorId" > -->

      <div class="form-group">
        <label for="email">Email</label>
        <input
          v-model="review.email"
          type="email"
          class="form-control"
          placeholder="Inserisci qui la tua mail..."
          required
          name="email"
          id="email"
        />
      </div>

      <div class="form-group">
        <label for="name">Nome*</label>
        <input
          v-model="review.name"
          type="text"
          class="form-control"
          name="name"
          id="name"
          rows="5"
          placeholder="Il tuo nome..."
          required
        />
      </div>
      <!-- <div class="form-group">
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
      </div> -->

      <div class="form-group">
        <label for="review">Recensione</label>
        <textarea
          v-model="review.review"
          class="form-control"
          name="review"
          id="review"
          rows="5"
          required
          placeholder="Scrivi una recensione..."
        ></textarea>
      </div>

      <div class="form-group">
        <label for="vote">Voto</label>
        <select v-model="review.vote" name="vote" id="vote">
          <option value="1">★</option>
          <option value="2">★★</option>
          <option value="3">★★★</option>
          <option value="4">★★★★</option>
          <option value="5">★★★★★</option>
        </select>
      </div>

      <!-- <vs-button type="submit" >invia il messaggio</vs-button> -->
      <button type="submit" class="btn btn-orange">
        {{ sending ? "Invio in corso..." : "Invia Messaggio" }}
        <!-- Invia -->
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: "ReviewForm",

  data() {
    return {
      review: {
        musician_id: "",
        email: "",
        name: "",
        review: "",
        vote: "",
      },
      sending: false,
    };
  },

  props: ["musicianId"],

  methods: {
    sendMessage(id) {
      this.sending = true;

      this.review.musician_id = id;
      // this.message.id = this.musicianId;
      axios
        .post("http://127.0.0.1:8000/api/review", this.review)
        .then((res) => {
          // console.log(this.message)
          // this.message.id = this.musicianId;
          console.log(res);
          this.sending = false;

          this.$router.push({ name: "review-confirm" });
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