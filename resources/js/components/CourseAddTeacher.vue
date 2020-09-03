<template>
  <div>
    <div class="page-title">
      <h1>Asignar profesores al curso</h1>
    </div>
    <div>
      <div class="list">
        <div class="list-heading">
          <div class="list-row">
            <h3>Nombre</h3>
            <h3>Email</h3>
            <h3>Selcionado</h3>
            <h3>Acciones</h3>
          </div>
        </div>
        <div class="list-content">
          <div class="list-row" :key="i" v-for="(teacher, i) in teachers">
            <a :href="'/teacher/' + teacher.id" class="list-data">{{teacher.name}}</a>
            <p class="list-data">{{teacher.surname}}</p>
            <p class="list-data">{{teacher.email}}</p>
            <div class="list-actions">
              <button
                v-if="teacher.selected"
                class="btn primary-button btn-sm selected-button"
                @click="unselectTeacher(teacher, i)"
              >Selecionado</button>
              <button
                v-if="!teacher.selected"
                class="btn primary-button btn-sm"
                @click="selectTeacher(teacher, i)"
              >Selecionar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="form-submit">
        <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
        <a @click.prevent @click="assignTeachers()" href class="btn primary-button">Guardar</a>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["course"],
  data() {
    return {
      teachers: [],
      selectedTeachers: [],
    };
  },
  methods: {
    getTeachers() {
      axios.get("/api/teachers").then((response) => {
        response.data.forEach((teacher) => {
          teacher.selected = false;
          this.teachers.push(teacher);
        });
      });
    },
    selectTeacher(teacher, index) {
      this.teachers[index].selected = true;
      this.selectedTeachers.push(teacher);
    },
    unselectTeacher(teacher, teacherIndex) {
      this.teachers[teacherIndex].selected = false;
      const index = this.selectedTeachers.indexOf(teacherIndex);
      this.selectedTeachers.splice(index, 1);
    },
    assignTeachers() {
      let selectedTeachersIds = [];

      this.selectedTeachers.forEach((teacher) => {
        selectedTeachersIds.push(teacher.id);
      });

      console.log(selectedTeachersIds);

      axios
        .post("/api/courses/" + this.course.id + "/addTeacherToTheCourse", {
          teachers: selectedTeachersIds,
        })
        .then((response) => {
          window.location.replace("/course/" + this.course.id + "/teachers");
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

