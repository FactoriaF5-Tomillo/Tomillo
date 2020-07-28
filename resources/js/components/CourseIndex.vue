<template>
  <div>
    <div class="card-header d-flex justify-content-between">
      <h1>Cursos</h1>
      <div>
        <a href="/course/create" class="btn btn-primary">Añadir Curso</a>
      </div>
    </div>
    <div>
      <div class="course-card" v-bind:key="i" v-for="(course, i) in courses">
        <div class="course-header">
          <a :href="'course/' + course.id">{{course.title}}</a>
        </div>
        <div class="course-body">
          <p>{{course.description}}</p>
        </div>
        <div class="course-footer">
          <a :href="'course/' + course.id + '/edit'" class="btn btn-success">Modificar</a>
          <button @click="deleteCourse(course)" type="button" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
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
      if (confirm("¿Estas seguro que quieres eliminar este curso?")) {
        axios.delete("/api/courses/" + course.id).then((response) => {
          this.courses = response.data;
        });
      }
    },
  },
  mounted() {
    this.getCourses();
    console.log("Component mounted.");
  },
};
</script>
