<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "CustomTaskInput",
  props: {
    label: {
      type: String,
      required: true
    },
    time: {
      type: Number,
      required: true
    }
  },
  emits: ["update:task", "remove:task"],
  data() {
    return {
      task: {
        label: this.label,
        time: this.time
      }
    };
  },
  watch: {
    task(value) {
      // Emit the event with the updated task.
      this.$emit("update:task", value);
    }
  },
  methods: {
    remove() {
      // Emit the remove event.
      this.$emit("remove:task");
    }
  }
});
</script>

<template>
  <div class="specific-template">
    <label class="specific-template-time">
      <span class="specific-template-input-prefix">Nom</span>
      <input v-model="task.label" type="text" name="specific-template" />
    </label>
    <label>
      <input v-model="task.time" type="number" name="specific-template-time" min="0" />
      <span class="specific-template-input-unit">h</span>
    </label>
    <button class="button button-icon" @click="remove">
      <i class="fa fa-minus"></i>
    </button>
  </div>
</template>

<style scoped></style>
