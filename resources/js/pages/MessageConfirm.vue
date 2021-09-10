<template>
  <div class="container d-flex align-items-center justify-content-center">
    <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
      <div class="thumbs_container d-flex align-items-center justify-content-center">
        <i class="fas fa-thumbs-up title-orange"></i>
      </div>

      <h1 class="my-5">Messaggio inviato correttamente!</h1>
      <p>Il musicista ha ricevuto il tuo messaggio e ti risponderà nel più breve tempo possibile</p>

      <a class="btn btn-orange text-white my-3" @click="$router.go(-1)">
        Indietro
      </a>      
    </div>
  </div>
</template>

<script>
export default {
    name: 'MessageConfirm'
}
</script>

<style lang="scss" scoped>
  .container {
    height: calc(100vh - 76px);

    .thumbs_container {
      border-radius:150px;
      height:150px; 
      width:150px;
      background-color: #c6d8d3;

      .fa-thumbs-up {
        font-size: 50px;
      }
    }
  }
  

</style>