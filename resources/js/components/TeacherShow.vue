<template>
  <div class="container">
    <div class="container">
      <div class="card-header">
        <h1>Datos Del Profesor</h1>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Nacionalidad</th>
              <th scope="col">Email</th>
              <th scope="col">Sexo</th>
              <th scope="col">Curso Actual</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{teacher.name}}</td>
              <td>{{teacher.surname}}</td>
              <td>{{teacher.email}}</td>
              <td>{{teacher.gender}}</td>
            </tr>
          </tbody>
        </table>
        <a href="/teachers" class="btn btn-secondary">Volver</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["teacher"],
  data() {
    return {};
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
