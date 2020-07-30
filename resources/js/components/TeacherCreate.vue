<template>
  <div>
    <div class="page-title">
      <h1>Añadir profesor</h1>
    </div>
    <div class="form">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control" type="text" name="name" v-model="teacher.name" />
      </div>
      <div class="form-group">
        <label>Apellido</label>
        <input class="form-control" type="text" name="surname" v-model="teacher.surname" />
      </div>
      <div class="form-group">
        <label>Email</label>
        <input class="form-control" type="text" name="email" v-model="teacher.email" />
      </div>
      <div class="form-group">
        <label>Sexo</label>
        <select v-model="teacher.gender" class="form-control">
          <option value="male">Hombre</option>
          <option value="female">Mujer</option>
          <option value="female">Otro</option>
        </select>
      </div>
      <div class="form-submit">
        <a class="btn btn-secondary mb-2" href="/teachers">&#8592; Volver</a>
        <button class="btn btn-primary mb-2" @click="createTeacher()">Crear</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      teacher: {},
    };
  },
  methods: {
    createTeacher() {
      axios.post("/api/teachers", this.teacher).then((response) => {
        window.location.replace("/teachers");
      });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
