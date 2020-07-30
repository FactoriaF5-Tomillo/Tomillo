<template>
  <div>
    <div class="card-header">Añadir Alumno</div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" v-model="student.name" name="name" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Apellido</label>
        <input type="text" v-model="student.surname" name="surname" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Nacionalidad</label>
        <input
          type="text"
          v-model="student.nationality"
          name="nationality"
          class="form-control"
          required
        />
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" v-model="student.email" name="email" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Sexo</label>
        <select v-model="student.gender" class="form-control">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label>Curso Actual</label>
        <input
          type="text"
          v-model="student.currentcourse"
          name="currentcourse"
          class="form-control"
          required
        />
      </div>
      <div class="card-footer">
        <button class="btn btn-primary" @click="createStudent(student)" value="Crear">Crear</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      student: {
        course_id: 1,
      },
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    createStudent(student) {
      axios
        .post("/api/students/", this.student)
        .then(window.location.replace("/students"));
    },
  },
};
</script>
