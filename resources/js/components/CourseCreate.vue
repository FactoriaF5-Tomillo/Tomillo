<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>Crear curso</h1>
      </div>
      <div class="card-body">
        <label>Titutlo</label>
        <input class="form-control" type="text" name="title" />
        <label>Descripcion</label>
        <input class="form-control" type="text" name="description" />
        <div class="row">
          <div class="col">
            <label>Fecha primero dia</label>
            <input class="form-control" type="date" name="start-date" />
          </div>
          <div class="col">
            <label>Fecha ultimo dia</label>
            <input class="form-control" type="date" name="end-date" />
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-between">
        <a class="btn btn-secondary mb-2" href="/cursos">&#8592; Volver</a>
        <button class="btn btn-primary mb-2">Crear</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course"],
  data() {
    return {
      course: {},
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
