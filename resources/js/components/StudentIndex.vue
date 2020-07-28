<template>
  <div>
    <div class="card-header d-flex justify-content-between">
      <h1>Alumnos</h1>
      <div>
        <a href="/student/create" class="btn btn-primary">Añadir Alumno</a>
      </div>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
          </tr>
        </thead>
        <tbody>
          <tr v-bind:key="i" v-for="(student, i) in students">
            <td>
              <a :href="'student/' + student.id">{{student.name}}</a>
            </td>
            <td>
              <a :href="'student/' + student.id + '/edit'" class="btn btn-success">Modificar</a>
            </td>
            <td>
              <button @click="deleteStudent(student)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
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
        this.students = response.data;
      });
    },
    deleteStudent(student) {
      axios.delete("/api/students/" + student.id).then((response) => {
        this.students = response.data;
      });
    },
  },
  mounted() {
    this.getStudents();
    console.log("Component mounted.");
  },
};
</script>
