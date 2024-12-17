<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "MainTitle",
  props: {
    title: {
      type: String,
      required: true
    }
  }
});
</script>

<template>
  <h1 class="main-title">{{ title }}</h1>
</template>

<style scoped></style>
