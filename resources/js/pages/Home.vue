<template>
  <div class="overflow">
    <Jumbotron />
    <div class="pattern-home"></div>

    <div class="container">
      <!-- <div class="py-4 text-center" data-aos="zoom-in">
      </div> -->
      <carousel
        :perPage="1"
        :perPageCustom="[
          [768, 2],
          [996, 3],
        ]"
        :paginationActiveColor="activePaginateColor"
        :paginationColor="paginateColor"
        class="py-5"
        data-aos="fade-right"
      >
        <slide v-for="(musician, index) in musicians" :key="index">
          <div
            class="
              card
              rounded
              sponsored-card
              mx-2
              pt-4
              text-center
              d-flex
              flex-column
              align-items-center
              justify-content-center
            "
            style="min-height: 300px"
          >
            <vue-load-image>
              <img
                style="height: 200px; width: 200px; border-radius: 50%"
                slot="image"
                :src="'/storage/' + musician.cover"
                class="img-sponsor"
              />
              <img
                style="height: 100px"
                slot="preloader"
                src="https://cdn.discordapp.com/attachments/880006994608652299/886981737249402880/Pulse-1s-200px.svg"
              />
              <!-- <div slot="preloader" class="lds-facebook bg-dark" style="height: 200px; width: 200px;"><div></div><div></div><div></div></div> -->
              <div class="text-danger" slot="error">No cover found.</div>
            </vue-load-image>
            <div class="card-body">
              <h5 class="card-title">{{ musician.stagename }}</h5>
              <small
                class="badge-purple-sm"
                v-for="genre in musician.genres"
                :key="genre.id"
              >
                {{ genre.name }}
              </small>
            </div>

            

            <div class="py-2">
              <i
                class="fa-star"
                v-for="index in 5"
                :key="index"
                :class="
                  index <= getAverageVotes(musician.reviews) ? 'fas' : 'far'
                "
              ></i>
            </div>

            <router-link
              class="btn-orange btn-rounded text-white w-100"
              :to="{
                name: 'musician',
                params: { slug: musician.slug },
              }"
              >Vedi profilo</router-link
            >
          </div>
        </slide>
      </carousel>

      <div class="showreel showreel-1 py-5">
        <div
          class="showreel-img-1"
          data-aos="zoom-in"
          data-aos-duration="1000"
          data-aos-delay="1000"
        >
          <img style="width: 350px" src="/images/musiccassa.svg" alt="" />
        </div>

        <div
          data-aos="fade-left"
          data-aos-duration="1000"
          data-aos-delay="1000"
          class="showreel-text showreel-text-1 text-center py-3"
        >
          <h3 class="py-2">Contatta il tuo musicista preferito!</h3>
          <p class="py-2">
            <!-- Cerca tra i tuoi generi preferiti il musicista o il gruppo che fa per te! -->
            Cercare un musicista per il tuo evento non è mai stato così
            semplice. Puoi contattarlo direttamente sulla sua pagina profilo e
            lui ti risponderà nel più breve tempo possibile. Collegati da PC,
            Tablet o Smartphone e inizia subito la tua ricerca.
          </p>
        </div>
      </div>

      <div class="showreel showreel-2 py-5">
        <div
          class="showreel-img-2"
          data-aos="zoom-in"
          data-aos-duration="1000"
          data-aos-delay="1000"
        >
          <img style="width: 350px" src="/images/musichpone.svg" alt="" />
        </div>

        <div
          data-aos="fade-left"
          data-aos-duration="1000"
          data-aos-delay="1000"
          class="text-center py-3 showreel-text showreel-text-2"
        >
          <h3 class="py-2">
            Sei un musicista o vuoi sponsorizzare la tua Band?
          </h3>
          <p class="py-2">
            Con un unico strumento puoi gestire i tuoi messaggi, le recensioni,
            vedere le statistiche mensili e sponsorizzare il tuo profilo
          </p>
          <a
            style="width: max-content"
            class="btn btn-orange text-white"
            href="/register"
            >Registrati</a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Jumbotron from "../components/Jumbotron";

import dayjs from "dayjs";

import { Carousel, Slide } from "vue-carousel";

import VueLoadImage from "vue-load-image";



export default {
  name: "Home",

  data() {
    return {
      musicians: [],
      activePaginateColor: "#ec5e25",
      paginateColor: "rgba(236, 93, 37, 0.363)",
      today: dayjs().format("YYYY-MM-DD HH:mm:ss"),
      
    };
  },

  components: {
    Jumbotron,
    Carousel,
    Slide,
    VueLoadImage,
   
  },

  methods: {
    getSponsoredMusicians() {
      axios
        .get("http://127.0.0.1:8000/api/sponsored")
        .then((res) => {
          // console.log(res.data);
          this.musicians = res.data.sponsorship;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getAverageVotes(reviews) {
      const sum = reviews.reduce((acc, review) => (acc += review.vote), 0);
      return Math.ceil(sum / reviews.length);
    },
  },

  created() {
    this.getSponsoredMusicians();

    // console.log(this.getSponsor);
  },

  
};
</script>

<style>
</style>