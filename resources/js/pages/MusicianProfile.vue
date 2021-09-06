<template>
<div class="pattern">
  <div class="container">
      <div class="prova d-flex align-items-center justify-content-center">
        <img  :src="'/storage/' + musician.cover" alt="">
      </div>
      <div class="prova2">
        <h1>{{ musician.stagename }}</h1>
        <p>{{ musician.bio }}</p>
      </div>
      <button class="btn btn-primary" @click="show = !show">Invia un messaggio</button>  

      <MessageForm v-if="show" />
      <!-- <router-link :to="{ name:'musicians', params:{ id: musician.id }}">Indietro</router-link> -->
  </div>

</div>
</template>

<script>
import MessageForm from '../components/MessageForm';
export default {
    name: 'MusicianProfile',
    
    components: {
        MessageForm
    },

    data() {
        return {
            musician: {},
            show: false
        }
    },

    methods: {
        getMusician(id) {
            axios.get(`http://127.0.0.1:8000/api/musician/${id}`)
            .then( res => {
                this.musician = res.data;
                console.log( res.data )
            })
            .catch( err => {
                console.log( err )
            })
        }
    },

    created() {
        this.getMusician(this.$route.params.id)
    }
}
</script>

<style lang="scss" scoped>
.pattern {
   background-image: url('/images/pattern3.jpg');
   background-size: cover;
   background-position: center top;
   height: 200px;
}

img {
    border-radius: 10px;
    height: 200px;
    width: auto;
}

.container {
    position: relative;
}

.prova {
    position: absolute;
    top: 100px;
    left: 50%;
    transform: translateX(-50%);

}

.prova2 {
    padding-top: 300px;
}
</style>