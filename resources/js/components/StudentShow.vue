<template>
  <div>
    <div class="card-header">
      <h1>Datos Del Alumno</h1>
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
            <td>{{student.name}}</td>
            <td>{{student.surname}}</td>
            <td>{{student.nationality}}</td>
            <td>{{student.email}}</td>
            <td>{{student.gender}}</td>
            <td>{{student.currentcourse}}</td>
          </tr>
        </tbody>
      </table>
      <a href="/students" class="btn btn-secondary">Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["student"],
  data() {
    return {};
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
