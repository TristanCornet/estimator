<script>
import { defineComponent } from "vue";

import { TextInput, InputGroup, CheckboxInputGroup, SelectInput, CustomTaskInputGroup } from "@/components/Input";

export default defineComponent({
  name: "DynamicInput",
  components: {
    InputGroup,
    TextInput,
    CheckboxInputGroup,
    SelectInput,
    CustomTaskInputGroup
  },
  props: {
    type: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
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
  computed: {
    // Get the right component based on the type of the field.
    input() {
      return {
        Name: TextInput,
        Generic: CheckboxInputGroup,
        Specification: SelectInput,
        Additional: CustomTaskInputGroup
      }[this.type];
    }
  }
});
</script>

<template>
  <InputGroup :title="name">
    <!-- The component used is defined by the value of the input computed property.   -->
    <Component :is="input" :slug="slug" :options="options"></Component>
  </InputGroup>
</template>

<style scoped></style>
