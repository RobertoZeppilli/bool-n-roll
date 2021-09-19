<template>
  <div class="overflow">
    <Jumbotron />
    <div class="search" v-if="loaded">
      <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <h2 class="numbers-title mb-5">Scegli un genere!</h2>
          <!-- <p class="platinum">Verrai portato alla pagina musicisti</p> -->
        </div>
        <div class="row">
          <div
            v-for="(genre, index) in genres"
            :key="index"
            class="col-xs-12 col-md-4 col-lg-2 mb-3"
            data-aos="zoom-in"
          
          >
            <label
              class="genre-label w-100 text-center p-3"
              :for="genre.slug"
              >{{ genre.name }}</label
            >
            <input
              @change="searchMusicians(slug)"
              v-model="slug"
              type="radio"
              :value="genre.slug"
              :name="genre.name"
              :id="genre.slug"
            />
          </div>
        </div>
      </div>
    </div>
    <Loader v-else />
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
              mt-4
              pt-3
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

      <section
        class="counters"
        data-aos="zoom-in"
        data-aos-duration="1000"
        data-aos-delay="900"
      >
        <div class="d-flex align-items-center justify-content-center">
          <h2 class="mb-5 numbers-title">I nostri numeri</h2>
        </div>
        <div class="row text-center">
          <div class="col-xs-12 col-md-6 col-lg-3 mb-5">
            <i class="fab fa-youtube title-pink fa-4x"></i>
            <div class="counter title-pink" data-target="60000">0</div>
            <h3>Iscritti</h3>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-3 mb-5">
            <i class="fab fa-twitter title-orange fa-4x"></i>
            <div class="counter title-orange" data-target="15000">0</div>
            <h3>Followers</h3>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-3 mb-5">
            <i class="fab fa-facebook title-yellow fa-4x"></i>
            <div class="counter title-yellow" data-target="9000">0</div>
            <h3>Likes</h3>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-3 mb-5">
            <i class="fab fa-linkedin title-petrol fa-4x"></i>
            <div class="counter title-petrol" data-target="5000">0</div>
            <h3>Collegamenti</h3>
          </div>
        </div>
      </section>

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

import Loader from '../components/Loader';

export default {
  name: "Home",

  data() {
    return {
      musicians: [],
      filteredMusicians: [],
      genres: [],
      activePaginateColor: "#ec5e25",
      paginateColor: "rgba(236, 93, 37, 0.363)",
      today: dayjs().format("YYYY-MM-DD HH:mm:ss"),
      slug: "",
      loaded: false
    };
  },

  components: {
    Jumbotron,
    Carousel,
    Slide,
    VueLoadImage,
    Loader
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

    searchMusicians(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musicians/${slug}`)
        .then((res) => {
          res.data.forEach((el) => {
            this.filteredMusicians = el.musicians;
            this.$router.push({
              name: "musicians",
              params: { slug: this.slug },
            });
          });
          //   console.log(this.musicians);
        })
        .catch((err) => {
          console.log(err);
        });
    },

    clicked(slug) {
      console.log(slug);
    },

    getAverageVotes(reviews) {
      const sum = reviews.reduce((acc, review) => (acc += review.vote), 0);
      return Math.ceil(sum / reviews.length);
    },

    getGenres() {
      axios
        .get("http://127.0.0.1:8000/api/genres")
        .then((res) => {
          this.genres = res.data;
          // console.log( this.genres )
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    this.getSponsoredMusicians();
    this.getGenres();
    // console.log(this.getSponsor);
  },


  mounted() {
    setTimeout(function () {
      const counters = document.querySelectorAll(".counter");
      const speed = 200; // The lower the slower

      counters.forEach((counter) => {
        const updateCount = () => {
          const target = +counter.getAttribute("data-target");
          const count = +counter.innerText;

          // Lower inc to slow and higher to slow
          const inc = target / speed;

          // console.log(inc);
          // console.log(count);

          // Check if target is reached
          if (count < target) {
            // Add inc to count and output in counter
            counter.innerText = count + inc;
            // Call function every ms
            setTimeout(updateCount, 1);
          }
        };

        updateCount();
      });
    }, 1500);

    setTimeout(() => (this.loaded = true), 2000);
  },
};
</script>

<style lang="scss" scoped>
.counters {
  /* background: #0f479a; */
  color: #191919;
  // padding: 40px 20px;
  /* border-top: 3px lightskyblue solid; */
}

.counters .container {
  // display: grid;
  // grid-template-columns: repeat(4, 1fr);
  // grid-gap: 30px;
  text-align: center;
}

// .counters i {
//   color: #ec5e25;
//   // margin-bottom: 5px;
// }

.counters .counter {
  font-size: 45px;
  // margin: 10px 0;
}

@media (max-width: 700px) {
  // .counters .container {
  //   grid-template-columns: repeat(2, 1fr);
  // }

  // .counters .container > div:nth-of-type(1),
  // .counters .container > div:nth-of-type(2) {
  //   // border-bottom: 1px lightskyblue solid;
  //   padding-bottom: 20px;
  // }
}
</style>