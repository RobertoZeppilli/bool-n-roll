<template>
  <div>
    <router-view></router-view>
    
  </div>
</template>

<script>
export default {
  name: "ExampleComponent",

  methods: {},

  created() {
    $(document).ready(function(){
            $(this).scrollTop(0);
    });
  }
};
</script>
