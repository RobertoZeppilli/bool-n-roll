<template>
  <div class="jumbotron bg-jumbotron">
    <div class="container">
      <div class="row">
        <div
          class="
            col-xs-6 col-md-6 col-lg-6
            d-flex
            flex-column
            align-items-center
            justify-content-center
          "
        >
          <div class="text-center">
            <h1 class="headline">Playing the mood</h1>
          </div>

          <div class="my-2 text-center">
            <p class="platinum">
              Cerca un musicista scegliendo il genere che preferisci!
            </p>
          </div>

          <div class="form-group">
            <select
              @change="searchMusicians(slug)"
              v-model="slug"
              class="form-control mb-2 decorated"
              autocomplete="on"
            >
              <option value="" selected="selected" disabled>
                Scegli un genere
              </option>
              <option
                :value="genre.slug"
                v-for="genre in genres"
                :key="genre.id"
              >
                {{ genre.name }}
              </option>
            </select>
          </div>
          <!-- <div class="sel sel--black-panther">
            <select name="select-profession" id="select-profession">
              <option value="" disabled>Profession</option>
              <option value="hacker">Hacker</option>
              <option value="gamer">Gamer</option>
              <option value="developer">Developer</option>
              <option value="programmer">Programmer</option>
              <option value="designer">Designer</option>
              <option
                :value="genre.slug"
                v-for="genre in genres"
                :key="genre.id"
              >
                {{ genre.name }}
              </option>
            </select>
          </div>

          <hr class="rule" /> -->
        </div>

        <div class="col-xs-6 col-md-6 col-lg-6">
          <img class="img-fluid" src="images/jumboimg.png" alt="Jumbtron" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import FilteredMusicians from './FilteredMusicians';

export default {
  name: "Jumbotron",

  data() {
    return {
      genres: [],
      musicians: [],
      slug: "",
    };
  },

  methods: {
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

    searchMusicians(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musicians/${slug}`)
        .then((res) => {
          res.data.forEach((el) => {
            this.musicians = el.musicians;
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
  },

  created() {
    this.getGenres();
    // this.filter(this.$routes.params.id)
  },

  mounted() {
    /* ===== Logic for creating fake Select Boxes ===== */
    $(".sel").each(function () {
      $(this).children("select").css("display", "none");

      var $current = $(this);

      $(this)
        .find("option")
        .each(function (i) {
          if (i == 0) {
            $current.prepend(
              $("<div>", {
                class: $current.attr("class").replace(/sel/g, "sel__box"),
              })
            );

            var placeholder = $(this).text();
            $current.prepend(
              $("<span>", {
                class: $current
                  .attr("class")
                  .replace(/sel/g, "sel__placeholder"),
                text: placeholder,
                "data-placeholder": placeholder,
              })
            );

            return;
          }

          $current.children("div").append(
            $("<span>", {
              class: $current
                .attr("class")
                .replace(/sel/g, "sel__box__options"),
              text: $(this).text(),
            })
          );
        });
    });

    // Toggling the `.active` state on the `.sel`.
    $(".sel").click(function () {
      $(this).toggleClass("active");
    });

    // Toggling the `.selected` state on the options.
    $(".sel__box__options").click(function () {
      var txt = $(this).text();
      var index = $(this).index();

      $(this).siblings(".sel__box__options").removeClass("selected");
      $(this).addClass("selected");

      var $currentSel = $(this).closest(".sel");
      $currentSel.children(".sel__placeholder").text(txt);
      $currentSel.children("select").prop("selectedIndex", index + 1);
    });
  },
};
</script>

