<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "BaseLayout"
});
</script>

<template>
  <header class="main-header">
    <span class="site-name">Estimator</span>
    <nav class="main-nav">
      <ul>
        <li>
          <RouterLink :to="{ name: 'EstimateForm' }"> Calculator </RouterLink>
        </li>
        <li>
          <RouterLink :to="{ name: 'EstimateList' }"> Dernières estimations </RouterLink>
        </li>
      </ul>
    </nav>
  </header>
  <main class="main-content">
    <slot></slot>
  </main>
  <footer></footer>
</template>

<style scoped></style>
