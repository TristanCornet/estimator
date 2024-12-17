<script>
import { defineComponent } from "vue";
import { mapStores } from "pinia";

import { useFormStore } from "@/stores";

export default defineComponent({
  name: "SelectInput",
  props: {
    slug: {
      type: String,
      required: true
    },
    options: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      value: useFormStore().form[this.slug].value
    };
  },
  computed: {
    // Map the form store to the local `formStore` computed property.
    ...mapStores(useFormStore)
  },
  watch: {
    value(value) {
      // Update the form in the store when selection changes.
      this.formStore.form[this.slug] = this.options.find(option => option.value === value);
    }
  }
});
</script>

<template>
  <select v-model="value" :name="slug">
    <option v-for="option in options" :key="option.value" :value="option.value">
      {{ option.label }}
    </option>
  </select>
</template>

<style scoped></style>
