<template>
  <div>
    <Jumbotron />
    <div class="container">
      <div class="py-4 text-center">
        <h2>I nostri musicisti in evidenza</h2>
      </div>
      <carousel 
        :perPage="1"
        :perPageCustom="[[768, 3]]"
        :paginationActiveColor="activePaginateColor"
        :paginationColor="paginateColor"
      >
        <slide v-for="(musician, index) in musicians" :key="index">
          <div
            class="
              card
              rounded
              mx-2
              py-4
              text-center
              d-flex
              flex-column
              align-items-center
              justify-content-center
            "
            style="min-height: 300px"
          >
            <img
              class="card-img-top"
              style="height: 200px; width: 200px; border-radius: 50%"
              :src="'/storage/' + musician.cover"
              alt="Card image cap"
            />
            <div class="card-body">
              <h5 class="card-title">{{ musician.stagename }}</h5>
            </div>
            <router-link
              class="btn btn-orange text-white"
              :to="{
                name: 'musician',
                params: { slug: musician.slug },
              }"
              >Vedi profilo</router-link
            >
          </div>
        </slide>
      </carousel>
      <!-- </div> -->
    </div>
  </div>
</template>

<script>
import Jumbotron from "../components/Jumbotron";

import dayjs from "dayjs";

// import { slider, slideritem } from "vue-concise-slider";

import { Carousel, Slide } from "vue-carousel";

// import Vue from 'vue';
// import VueCarousel from 'vue-carousel';

export default {
  name: "Home",

  data() {
    return {
      // sponsors: [],
      musicians: [],
      activePaginateColor: "#ec5e25",
      paginateColor: "rgba(236, 93, 37, 0.363)",
      today: dayjs().format("YYYY-MM-DD HH:mm:ss"),
    };
  },

  components: {
    Jumbotron,
    // slider,
    // slideritem,
    Carousel,
    Slide,
  },

  // computed: {
  //   getSponsor() {
  //     let array = []

  //     this.sponsors.forEach( el => {
  //       array = el.musicians
  //     })

  //     return array
  //   }
  // },

  methods: {
    getSponsoredMusicians() {
      axios
        .get("http://127.0.0.1:8000/api/sponsored")
        .then((res) => {
          // this.sponsors = res.data;
          console.log(res.data.sponsorship);
          this.musicians = res.data.sponsorship;

          // this.sponsors.forEach((el) => {
          //   if (el.musicians.length > 0) {
          //     this.musicians = el.musicians;
          //     console.log(this.musicians);
          //   }
          // });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    this.getSponsoredMusicians();
    console.log(this.getSponsor);
  },
};
</script>

<style>
</style>