<template>
  <div>
    <div class="page-title">
      <h1>Alumnos</h1>
      <div>
        <a href="/student/create" class="btn btn-primary">Añadir Alumno</a>
      </div>
    </div>
    <div class="list">
      <div class="list-heading">
        <div class="list-row">
          <h3>Nombre</h3>
          <h3>Apellido</h3>
          <h3>Curso</h3>
          <h3>Acciones</h3>
        </div>
      </div>
      <div class="list-content">
        <div class="list-row" v-bind:key="i" v-for="(student, i) in students">
          <a :href="'/student/' + student.id" class="list-data">{{student.name}}</a>
          <p class="list-data">{{student.surname}}</p>
          <p class="list-data" v-if="student.course">{{student.course.title}}</p>
          <div class="list-actions">
            <a :href="'/student/' + student.id + '/edit'">Editar</a>
            <a @click="deleteStudent(student)" class="list-actions">Eliminar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      students: [],
    };
  },
  methods: {
    getStudents() {
      axios.get("/api/students").then((response) => {
        console.log(response);
        this.students = response.data;
      });
    },
    deleteStudent(student) {
      if (confirm("¿Estas seguro que quieres eliminar este alumno?")) {
        axios.delete("/api/students/" + student.id).then((response) => {
          this.getStudents();
        });
      }
    },
  },
  mounted() {
    this.getStudents();
    console.log("Component mounted.");
  },
};
</script>
