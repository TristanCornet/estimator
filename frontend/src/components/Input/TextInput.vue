<script>
import { defineComponent } from "vue";
import { mapStores } from "pinia";

import { useFormStore } from "@/stores";

export default defineComponent({
  name: "TextInput",
  props: {
    slug: {
      type: String,
      required: true
    },
    options: {
      type: Array,
      required: false,
      default: () => []
    }
  },
  data() {
    return {
      text: String()
    };
  },
  computed: {
    // Map the form store to the local `formStore` computed property.
    ...mapStores(useFormStore)
  },
  watch: {
    text(value) {
      // Update the form in the store when the text changes.
      this.formStore.form[this.slug] = value.trim();
    }
  }
});
</script>

<template>
  <input :id="slug" v-model="text" type="text" :name="slug" />
</template>

<style scoped></style>
