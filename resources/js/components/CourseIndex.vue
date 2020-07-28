<template>
  <div class="container">
    <div class="card-header">
      <a href="/course/create" class="btn btn-primary">Añadir Curso</a>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Titulo</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="course in courses">
            <td>
              <a :href="'course/' + course.id">{{course.title}}</a>
            </td>
            <td>
              <a :href="'course/edit/' + course.id" class="btn btn-success">Modificar</a>
            </td>
            <td>
              <button @click="deleteCourse(course)">Eliminar</button>
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
      courses: [],
    };
  },
  methods: {
    getCourses() {
      axios.get("/api/courses").then((response) => {
        this.courses = response.data;
      });
    },
    deleteCourse(course) {
      axios.delete("/api/courses/" + course.id).then((response) => {
        this.courses = response.data;
      });
    },
  },
  mounted() {
    this.getCourses();
    console.log("Component mounted.");
  },
};
</script>
