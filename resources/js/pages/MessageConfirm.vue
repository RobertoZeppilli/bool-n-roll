<template>
  <div>
      Messaggio inviato

      <a class="btn btn-primary text-white" @click="$router.go(-1)">
        Indietro
      </a>
  </div>
</template>

<script>
export default {
    name: 'MessageConfirm'
}
</script>

<style>

</style>