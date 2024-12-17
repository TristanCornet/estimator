import { defineStore } from "pinia";

import useAPI from "@/composables/useAPI";

const useEstimateStore = defineStore("estimate", {
  state: () => ({
    estimates: [],
    loaded: false
  }),
  actions: {
    async loadEstimates() {
      const { data, ...api } = useAPI();
      // The estimates are only loaded once.
      if (!this.loaded.value) {
        try {
          await api.get("/estimates");
          // The estimates are added to the estimates array.
          this.estimates.splice(0, this.estimates.length, ...data.value);
          // The loaded property is set to true.
          this.loaded = true;
        } catch (error) {
          console.error(error);
        }
      }
    },
    async getEstimate(id) {
      // The id parameter could be a string, so it needs to be converted to a number.
      const $id = Number(id);
      // The estimate is searched for in the estimates array.
      let estimate = this.estimates.find(({ id }) => id === $id);
      // If the estimate is not found, it is loaded from the API.
      if (!estimate) {
        const { data, ...api } = useAPI();
        try {
          await api.get(`/estimates/${id}`);
          estimate = data.value;
        } catch (error) {
          console.error(error);
        }
      }
      return estimate;
    },
    async postEstimate(payload) {
      const { data, ...api } = useAPI();
      try {
        await api.post("/estimates", payload);
        this.estimates.push(data.value);
        return data.value;
      } catch (error) {
        console.error(error.response.data.errors);
        return error.response.data;
      }
    }
  }
});

export default useEstimateStore;
