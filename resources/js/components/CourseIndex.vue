<template>
  <div>
    <div class="page-title">
      <h1>Cursos</h1>
      <div>
        <a href="/course/create" class="btn primary-button">Añadir Curso</a>
      </div>
    </div>
    <div class="course-list">
      <div class="course-card" v-bind:key="i" v-for="(course, i) in courses">
        <div class="course-header">
          <a :href="'course/' + course.id">{{course.title}}</a>
        </div>
        <div class="course-body">
          <p>{{course.description}}</p>
        </div>
        <div class="course-footer">
          <a
            :href="'course/' + course.id + '/edit'"
            class="action-icon"
            v-if="user.type == 'Admin'"
          >
            <ion-icon name="create-outline"></ion-icon>
          </a>
          <button @click="deleteCourse(course)" class="action-icon" v-if="user.type == 'Admin'">
            <ion-icon name="trash-outline"></ion-icon>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
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
    getLoggedUser() {
      axios.get("/loggeduser").then((response) => {
        this.user = response.data;
      });
    },
  },
  mounted() {
    this.getCourses();
    this.getLoggedUser();
    console.log("Component mounted.");
  },
};
</script>
