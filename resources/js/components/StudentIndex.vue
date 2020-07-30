<template>
  <div>
    <div class="page-title">
      <h1>Alumnos</h1>
      <div>
        <a href="/student/create" class="btn btn-primary">Añadir Alumno</a>
      </div>
    </div>
    <div>
      <table class="table-list table">
        <thead class="table-head">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Curso</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody class="table-body">
          <tr v-bind:key="i" v-for="(student, i) in students">
                <td>
                  <a :href="'student/' + student.id">{{student.name}}</a>
                </td>
                <td>
                  <a :href="'student/' + student.id">{{student.surname}}</a>
                </td>
                <td>
                  {{student.course}}
                </td>
                <td>
                  <a :href="'student/' + student.id + '/edit'" class="action-icon">
                  <ion-icon name="create-outline"></ion-icon></a>
                </td>
                <td>
                  <a @click="deleteStudent(student)" class="action-icon">
                    <ion-icon name="trash-outline"></ion-icon>
                  </a>
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
        courses: []
    };
  },
  methods: {
    getStudents() {
      axios.get("/api/students").then((response) => {
        this.students = response.data;
      });
    },
    deleteStudent(student) {
      if (confirm("¿Estas seguro que quieres eliminar este alumno?")) {
        axios.delete("/api/students/"  + student.id).then((response) => {
          this.students = response.data;
        });
      }
    },
      getCourses() {
        axios.get("/api/courses").then((response) => {
            console.log("Hola");
            this.courses = response.data;
          });
      }
  },
  mounted() {
      this.getStudents();
      this.getCourses();
    console.log("Component mounted.");
  },

};
</script>
