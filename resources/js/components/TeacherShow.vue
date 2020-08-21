<template>
  <div>
    <div class="page-title">
      <h1>Datos Del Profesor</h1>
    </div>
    <div class="show-user">
      <div class="user-info">
            <h3>{{teacher.name}} {{teacher.surname}}</h3>
            <p>
              <strong>Genro:</strong>
              {{teacher.gender}}
            </p>
            <p>
              <strong>Email:</strong>
              {{teacher.email}}
            </p><br><br>
          <div class="course-list">
              <div class="course-card" v-bind:key="i" v-for="(course, i) in teacher_courses">
                  <div class="course-header">
                      <a :href="'course/' + course.id">{{course.title}}</a>
                  </div>
                  <div class="course-body">
                      <p>{{course.description}}</p>
                  </div>
              </div>
          </div>
      </div>

    </div>
    <div>
      <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["teacher"],
  data() {
    return {
        teacher_courses: []
    };
  },
  methods: {
      getTeacherCourses() {
          axios.get("/teacherCurrentCourses").then((response) => {
              this.teacher_courses = response.data;
          });
      },
    goBack() {
      window.history.back();
    },
  },
  mounted() {
      this.getTeacherCourses();
    console.log("Component mounted.");
  },
};
</script>
