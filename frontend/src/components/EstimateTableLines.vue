<script>
import { defineComponent } from "vue";

import { stringify } from "@/utilities";

export default defineComponent({
  name: "EstimateTableLines",
  props: {
    lines: {
      type: Array,
      required: true
    },
    header: {
      type: String,
      required: true
    }
  },
  methods: { stringify }
});
</script>

<template>
  <tr class="project-infos">
    <td colspan="2">{{ header }}</td>
  </tr>
  <tr v-for="line in lines" :key="line.id">
    <td>{{ line.label }}</td>
    <td>{{ stringify(line.time) }}</td>
  </tr>
</template>

<style scoped></style>
