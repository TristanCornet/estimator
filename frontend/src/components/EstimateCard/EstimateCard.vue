<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "EstimateCard",
  props: {
    estimate: {
      type: Object,
      required: true
    }
  },
  computed: {
    // Convert the total time in minutes to a string like "1h30m"
    time() {
      const total = this.estimate["total_time"];
      const hours = Math.floor(total / 60);
      const minutes = total % 60;
      return `${hours}h${minutes ? `${minutes}m` : String()}`;
    }
  }
});
</script>

<template>
  <RouterLink :to="{ name: 'EstimateDetails', params: { id: estimate.id } }" class="estimate-card">
    <span class="project-name">{{ estimate.name }}</span>
    <span class="project-time">{{ time }}</span>
  </RouterLink>
</template>

<style scoped></style>
