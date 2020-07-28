<template>
  <div>
    <div class="card-header d-flex justify-content-between">
      <h1>Profesores</h1>
      <div>
        <a href="/teacher/create" class="btn btn-primary">Añadir profesor</a>
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
          <tr v-bind:key="i" v-for="(teacher, i) in teachers">
            <td>
              <a :href="'teacher/' + teacher.id">{{teacher.name}}</a>
            </td>
            <td>
              <a :href="'teacher/' + teacher.id + '/edit'" class="btn btn-success">Modificar</a>
            </td>
            <td>
              <button @click="deleteTeacher(teacher)">Eliminar</button>
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
      teachers: [],
    };
  },
  methods: {
    getTeachers() {
      axios.get("/api/teachers").then((response) => {
        this.teachers = response.data;
      });
    },
    deleteTeacher(teacher) {
      axios.delete("/api/teachers/" + teacher.id).then((response) => {
        this.teachers = response.data;
      });
    },
  },
  mounted() {
    this.getTeachers();
    console.log("Component mounted.");
  },
};
</script>
