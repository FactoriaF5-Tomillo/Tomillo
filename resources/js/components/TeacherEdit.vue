<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h1>Añadir profesor</h1>
      </div>
      <div class="card-body">
        <label>Nombre</label>
        <input class="form-control" type="text" name="name" v-model="teacher.name" />
        <label>Apellido</label>
        <input class="form-control" type="text" name="surname" v-model="teacher.surname" />
        <label>Email</label>
        <input class="form-control" type="text" name="email" v-model="teacher.email" />
        <label>Sexo</label>
        <input class="form-control" type="text" name="gender" v-model="teacher.gender" />
      </div>
      <div class="card-footer d-flex justify-content-between">
        <a class="btn btn-secondary mb-2" href="/teachers">&#8592; Volver</a>
        <button class="btn btn-primary mb-2" @click="editTeacher()">Editar</button>
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
  methods: {
    editTeacher() {
      axios
        .patch("/api/teachers/" + this.teacher.id, this.teacher)
        .then((response) => {
          window.location.replace("/teachers");
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
