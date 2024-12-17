import { defineStore } from "pinia";

import useAPI from "@/composables/useAPI";

const useFieldStore = defineStore("form", {
  state: () => ({
    fields: [],
    loaded: false,
    form: {}
  }),
  actions: {
    async loadFields() {
      const { data, ...api } = useAPI();
      // The fields are only loaded once.
      if (!this.loaded) {
        await api.get("/fields");
        // The fields are added to the fields array.
        this.fields.splice(0, this.fields.length, ...data.value);
        // The loaded property is set to true.
        this.loaded = true;
      }
      // Reset the form.
      this.reset();
    },
    reset() {
      this.fields.forEach(field => {
        // The selectors (which are "Specification" type) are initialized with the first value.
        const types = {
          Name: String(),
          Specification: field.values[0],
          Generic: [],
          Additional: []
        };

        this.form[field.slug] = types[field.type];
      });
    },
    async submit() {
      // Import the estimateStore dynamically to post the estimate when the form is submitted.
      return import("./estimateStore").then(async ({ default: useStore }) => {
        return await useStore().postEstimate(this.form);
      });
    }
  }
});

export default useFieldStore;
