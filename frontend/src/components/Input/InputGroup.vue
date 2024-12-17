<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "InputGroup",
  props: {
    title: {
      type: String,
      required: true
    },
    options: {
      type: Array,
      required: false,
      default: () => []
    }
  }
});
</script>

<template>
  <div class="input-group">
    <span class="main-label">{{ title }}</span>
    <slot></slot>
  </div>
</template>

<style scoped></style>
