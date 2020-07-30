<template>
  <div>
    <div class="page-title">
      <h1>Asignar profesores al curso</h1>
    </div>
    <div class="list">
      <div class="list-heading">
        <div class="list-row">
          <h3>Nombre</h3>
          <h3>Apellido</h3>
          <h3>Email</h3>
          <h3>Acciones</h3>
        </div>
      </div>
      <div class="list-content">
        <div class="list-row" v-bind:key="i" v-for="(teacher, i) in teachers">
          <a :href="'/teacher/' + teacher.id" class="list-data">{{teacher.name}}</a>
          <p class="list-data">{{teacher.surname}}</p>
          <p class="list-data">{{teacher.email}}</p>
          <div class="list-actions">
            <a @click.prevent href @click="assignTeacher(teacher)">Asignar</a>
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
  props: ["course"],
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
    assignTeacher(teacher) {
      axios.post("/api/courses/" + this.course.id + "/addTeacherToTheCourse", {
        teacher_id: teacher.id,
        course_id: this.course.id,
      });
    },
    goBack() {
      window.history.back();
    },
  },
  mounted() {
    this.getTeachers();
    console.log("Component mounted.");
  },
};
</script>

