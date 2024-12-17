<script>
import { defineComponent } from "vue";
import { mapStores } from "pinia";
import { v4 as UUID } from "uuid";

import CustomTaskInput from "./CustomTaskInput.vue";

import { useFormStore } from "@/stores";

export default defineComponent({
  name: "CustomTaskInputGroup",
  components: {
    CustomTaskInput
  },
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
      tasks: []
    };
  },
  computed: {
    // Map the form store to the local `formStore` computed property.
    ...mapStores(useFormStore)
  },
  methods: {
    create() {
      this.tasks.push({
        // Generate a random id, an empty label and a time of 0 minutes.
        id: UUID(),
        label: String(),
        time: Number()
      });
    },
    update(task, id) {
      // Trim the label and round the time in minutes.
      const label = task.label.trim();
      const time = Math.round(task.time * 60);
      // If the label and time are valid, update the task in the store.
      if (label && time) {
        // Find the task with the given id and update it.
        const $task = this.tasks.find(task => task.id === id);
        $task.label = label;
        $task.time = time;
        // Update the form in the store.
        this.formStore.form[this.slug] = this.tasks;
      }
    },
    remove(id) {
      // Remove the task with the given id from the tasks array.
      this.tasks.splice(
        this.tasks.findIndex(task => task.id === id),
        1
      );
      // Update the form in the store.
      this.formStore.form[this.slug] = this.tasks;
    }
  }
});
</script>

<template>
  <div id="specificTemplateList" class="specific-template-list">
    <CustomTaskInput
      v-for="task in tasks"
      :key="task.id"
      :label="task.label"
      :time="task.time"
      @update:task="$task => update($task, task.id)"
      @remove:task="() => remove(task.id)"
    />
  </div>

  <button class="button button-icon" type="button" @click="create">
    <i class="fa fa-plus"></i>
  </button>
</template>

<style scoped></style>
