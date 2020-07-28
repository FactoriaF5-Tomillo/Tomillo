<template>
  <div>
    <div class="card-header">
      <h1>Datos del curso</h1>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Titulo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Fecha de inicialización</th>
            <th scope="col">Fecha de finalización</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{course.title}}</td>
            <td>{{course.description}}</td>
            <td>{{course.start_date}}</td>
            <td>{{course.end_date}}</td>
          </tr>
        </tbody>
      </table>
      <a href="/courses" class="btn btn-secondary">Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course"],
  data() {
    return {};
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
