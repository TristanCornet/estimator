<script>
import { defineComponent } from "vue";
import { mapActions, mapState } from "pinia";

import MainTitle from "@/components/MainTitle.vue";
import DynamicInput from "@/components/Input/DynamicInput.vue";

import { useFormStore } from "@/stores";

export default defineComponent({
  name: "EstimateForm",
  components: {
    MainTitle,
    DynamicInput
  },
  data() {
    return {
      errors: []
    };
  },
  computed: {
    // Map the fields state from the state to the local `fields` computed property.
    ...mapState(useFormStore, { fields: "fields" })
  },
  async created() {
    // Load the fields from the API when the component is created.
    await this.loadFields();
  },
  methods: {
    // Map the actions from the store to the local `loadFields` and `submit` methods.
    ...mapActions(useFormStore, ["loadFields", "submit"]),
    async add() {
      const estimate = await this.submit();
      if (estimate.errors) {
        this.errors = Object.values(estimate.errors).flat();
      } else {
        await this.$router.push({ name: "EstimateDetails", params: { id: estimate.id } });
      }
    }
  }
});
</script>

<template>
  <MainTitle title="Calculator" />
  <form v-if="fields.length" class="estimator-form" @submit.prevent="add">
    <div v-for="error in errors" :key="error" class="errors">
      {{ error }}
    </div>

    <DynamicInput
      v-for="field in fields"
      :key="field.id"
      :name="field.name"
      :slug="field.slug"
      :type="field.type"
      :options="field.values"
    />

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
  <p v-else class="loader"><i class="fa-solid fa-arrows-spin fa-spin"></i> Chargement du formulaire en cours...</p>
</template>

<style scoped>
.loader {
  max-width: 700px;
  margin-inline: auto;
  padding: 2.5rem;
  color: white;
  border: 0.25rem solid white;
  border-radius: 0.25rem;
}
</style>
