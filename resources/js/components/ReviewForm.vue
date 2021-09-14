<template>
  <div class="animate__animated animate__zoomIn">
    <h2>Lascia una recensione</h2>
    <form method="POST" @submit.prevent="sendMessage(musicianId)">
      <!-- <input type="hidden" name="user_id" id="user_id" :value="doctorId" > -->

      <div class="form-group">
        <label for="email">Email*</label>
        <input
          v-model="review.email"
          type="email"
          class="form-control"
          placeholder="Inserisci qui la tua mail..."
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
          v-model="review.name"
          type="text"
          class="form-control"
          name="name"
          id="name"
          rows="5"
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
        <label for="text_message">Cognome</label>
        <input
          type="text"
          class="form-control"
          name="surname"
          id="surname"
          rows="5"
          placeholder="Il tuo cognome"
        />
      </div>

      <div class="form-group">
        <label for="review">Recensione*</label>
        <textarea
          v-model="review.review"
          class="form-control"
          name="review"
          id="review"
          rows="5"
          placeholder="Scrivi una recensione..."
        ></textarea>
        <div v-if="errors">
          <small
            class="text-danger"
            v-for="(error, index) in errors.review"
            :key="`err-rev-${index}`"
            >{{ error }}</small
          >
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <div>
          <label for="vote">Voto*</label>
          <select
            v-model="review.vote"
            name="vote"
            id="vote"
            class="decorated form-control"
          >
            <option value="" disabled>Scegli un voto</option>
            <option class="title-yellow" value="1">★</option>
            <option class="title-yellow" value="2">★★</option>
            <option class="title-yellow" value="3">★★★</option>
            <option class="title-yellow" value="4">★★★★</option>
            <option class="title-yellow" value="5">★★★★★</option>
          </select>
          <div v-if="errors">
            <small
              class="text-danger"
              v-for="(error, index) in errors.vote"
              :key="`err-vote-${index}`"
              >{{ error }}</small
            >
          </div>
        </div>
        <div>
          <div class="py-1">
            <small>I campi con (*) sono obbligatori</small>
          </div>
          <button type="submit" class="btn btn-petrol text-white">
            {{ sending ? "Invio in corso..." : "Invia Recensione" }}
          </button>
        </div>
      </div>

      <!-- <div class="my-3">
        <small>I campi con (*) sono obbligatori</small>
      </div> -->
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
      errors: null,
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
          this.sending = false;

          if (res.data.errors) {
            this.errors = res.data.errors;
            // this.success = true;
            this.sending = false;
            // this.$route.push({ name: 'home' })
          } else {
            // this.sending = false;
            this.errors = {};
            this.review = {};
            this.$router.push({ name: "review-confirm" });
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