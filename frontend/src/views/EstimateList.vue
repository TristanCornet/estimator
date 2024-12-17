<script>
import { defineComponent } from "vue";
import { mapState, mapActions } from "pinia";

import MainTitle from "@/components/MainTitle.vue";
import EstimateCardList from "@/components/EstimateCard/EstimateCardList.vue";

import { useEstimateStore } from "@/stores";

export default defineComponent({
  name: "EstimateList",
  components: {
    MainTitle,
    EstimateCardList
  },
  computed: {
    // Map the estimates state to the local `estimates` computed property.
    ...mapState(useEstimateStore, { estimates: "estimates" })
  },
  async created() {
    // Load the estimates from the API when the component is created.
    await this.loadEstimates();
  },
  methods: {
    // Map the action from the store to the local `loadEstimates` method.
    ...mapActions(useEstimateStore, ["loadEstimates"])
  }
});
</script>

<template>
  <MainTitle title="Dernières estimations" />
  <EstimateCardList :estimates="estimates" />
</template>

<style scoped></style>
