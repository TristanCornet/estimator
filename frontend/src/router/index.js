import { createRouter, createWebHistory } from "vue-router";

import NotFound from "@/views/NotFound.vue";
import EstimateForm from "@/views/EstimateForm.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "EstimateForm",
      component: EstimateForm
    },
    {
      path: "/estimates",
      name: "EstimateList",
      component: () => import("@/views/EstimateList.vue")
    },
    {
      path: "/estimates/:id",
      name: "EstimateDetails",
      component: () => import("@/views/EstimateDetails.vue"),
      props: true
    },
    {
      path: "/:match(.*)",
      name: "NotFound",
      component: NotFound
    }
  ]
});

export default router;
