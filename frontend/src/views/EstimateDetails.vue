<script>
import { mapActions } from "pinia";
import { defineComponent } from "vue";

import { stringify } from "@/utilities";

import MainTitle from "@/components/MainTitle.vue";
import EstimateTableLines from "@/components/EstimateTableLines.vue";

import { useEstimateStore } from "@/stores";

export default defineComponent({
  name: "EstimateDetails",
  components: {
    MainTitle,
    EstimateTableLines
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      estimate: {},
      rows: {
        Startup: "Démarrage",
        Generic: "Développements génériques",
        Additional: "Développements additionnels",
        Specification: "Spécificités"
      }
    };
  },
  actions: {
    // Map the estimates store to the local `estimateStore` actions property.
    ...mapActions(useEstimateStore, ["getEstimate"])
  },
  async created() {
    const estimateStore = useEstimateStore();
    Object.assign(this.estimate, await estimateStore.getEstimate(this.id));
  },
  methods: {
    stringify,
    getLines(type) {
      return this.estimate.lines ? this.estimate.lines.filter(line => line.type === type) : [];
    }
  }
});
</script>

<template>
  <MainTitle title="Résultat de l'estimation" />
  <template v-if="Object.keys(estimate).length">
    <p class="project-name">Estimations de temps pour le projet : {{ estimate.name }}</p>
    <table class="table-result">
      <thead>
        <tr>
          <th>Développements</th>
          <th>Temps</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="[type, header] in Object.entries(rows)" :key="type">
          <EstimateTableLines v-if="getLines(type).length" :header="header" :lines="getLines(type)" />
        </template>
      </tbody>
      <tfoot>
        <tr>
          <td>Total</td>
          <td>{{ stringify(estimate["total_time"]) }}</td>
        </tr>
      </tfoot>
    </table>
  </template>
  <p v-else class="loader">
    <i class="fa-solid fa-arrows-spin fa-spin"></i> Chargement du résultat de l'estimation en cours...
  </p>
</template>

<style scoped>
.loader {
  max-width: 900px;
  margin-inline: auto;
  padding: 2.5rem;
  color: white;
  border: 0.25rem solid white;
  border-radius: 0.25rem;
}
</style>
