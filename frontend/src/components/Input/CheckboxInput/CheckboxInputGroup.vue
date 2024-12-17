<script>
import { defineComponent } from "vue";
import { mapStores } from "pinia";

import CheckboxInput from "./CheckboxInput.vue";

import { useFormStore } from "@/stores";

export default defineComponent({
  name: "CheckboxInputGroup",
  components: {
    CheckboxInput
  },
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
      selected: []
    };
  },
  computed: {
    // Map the form store to the local `formStore` computed property.
    ...mapStores(useFormStore)
  },
  methods: {
    update(option, checked) {
      this.selected = checked ? [...this.selected, option] : this.selected.filter(value => value.id !== option.id);
      this.formStore.form[this.slug] = this.selected;
    }
  }
});
</script>

<template>
  <!-- Loop through the options. The current option is used in the update function. -->
  <CheckboxInput
    v-for="option in options"
    :key="option.id"
    :value="option.value"
    :label="option.label"
    :name="slug"
    @update:checked="checked => update(option, checked)"
  />
</template>

<style scoped></style>
