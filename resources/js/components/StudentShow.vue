<template>
  <div>
    <div class="page-title">
      <h1>Datos Del Alumno</h1>
    </div>
    <div class="show-user">
      <div class="user-info">
        <h3>{{student.name}} {{student.surname}}</h3>
        <p>
          <strong>Nacionalidad:</strong>
          {{student.nationality}}
        </p>
        <p>
          <strong>Genro:</strong>
          {{student.gender}}
        </p>
      </div>
      <p>
        <strong>Email:</strong>
        {{student.email}}
      </p>
    </div>
    <div>
      <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["student"],
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
