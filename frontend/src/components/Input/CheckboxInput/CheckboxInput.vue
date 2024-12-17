<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "CheckboxInput",
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    }
  },
  emits: ["update:checked"],
  data() {
    return {
      checked: false
    };
  },
  watch: {
    checked(value) {
      this.$emit("update:checked", value);
    }
  }
});
</script>

<template>
  <div class="checkbox-group">
    <input :id="value" v-model="checked" type="checkbox" :name="name" :value="value" />
    <label :for="value">{{ label }}</label>
  </div>
</template>

<style scoped></style>
