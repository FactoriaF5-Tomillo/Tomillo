<template>
  <div>
    <div class="page-title">
      <h1>Datos Del Profesor</h1>
    </div>
    <div class="show-user">
      <div class="user-info">
        <h3>{{teacher.name}} {{teacher.surname}}</h3>
        <p>
          <strong>Genro:</strong>
          {{teacher.gender}}
        </p>
      </div>
      <p>
        <strong>Email:</strong>
        {{teacher.email}}
      </p>
    </div>
    <div>
      <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["teacher"],
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
