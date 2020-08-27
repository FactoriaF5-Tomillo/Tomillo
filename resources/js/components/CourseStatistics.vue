<template>
  <div>
    <div class="page-title">
      <h1>Estadísticas del curso</h1>
    </div>
    <div>
      <a href="/courses" class="list-actions">&#8592; Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course"],
  data() {
    return {};
  },

  methods: {
    goBack() {
      window.history.back();
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
