<template>
  <div class="container d-flex align-items-center justify-content-center">
    <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
      <div class="check_container d-flex align-items-center justify-content-center">
        <i class="fas fa-check-circle title-orange"></i>
      </div>

      <h1 class="my-5">Recensione inviata correttamente!</h1>
      <p>Le recensioni sono molto importanti perchè ci permettono di fornire un servizio sempre migliore!</p>

      <a class="btn btn-orange text-white my-3" @click="$router.go(-1)">
        Indietro
      </a>      
    </div>
  </div>
</template>

<script>
export default {
    name: 'ReviewConfirm'
}
</script>

<style lang="scss" scoped>
  .container {
    height: calc(100vh - 76px);

    .check_container {
      border-radius:150px;
      height:150px; 
      width:150px;
      background-color: #c6d8d3;

      .fa-check-circle {
        font-size: 50px;
      }
    }
  }
</style>