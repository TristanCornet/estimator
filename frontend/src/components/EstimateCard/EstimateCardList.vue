<script>
import { defineComponent } from "vue";

import EstimateCard from "@/components/EstimateCard/EstimateCard.vue";

export default defineComponent({
  name: "EstimateCardList",
  components: {
    EstimateCard
  },
  props: {
    estimates: {
      type: Array,
      default: () => []
    }
  }
});
</script>

<template>
  <ul v-if="estimates.length" class="estimate-list">
    <li v-for="estimate in estimates" :key="estimate.id">
      <EstimateCard :estimate="estimate" />
    </li>
  </ul>
  <p v-else class="loader"><i class="fa-solid fa-arrows-spin fa-spin"></i> Chargement des dernières estimations...</p>
</template>

<style scoped>
.loader {
  max-width: 900px;
  margin-inline: auto;
  padding: 2.5rem;
  background: white;
  color: var(--color-primary);
  border-radius: 0.25rem;
}
</style>
