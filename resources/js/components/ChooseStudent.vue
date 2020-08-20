<template>
  <div>
    <div class="page-title">
      <h1>Asignar alumnos al curso</h1>
    </div>
    <div class="list">
      <div class="list-heading">
        <div class="list-row">
          <h5>Nombre</h5>
          <h5>Apellido</h5>
        </div>
      </div>
      <div class="list-content">
        <div class="list-row" v-bind:key="i" v-for="(student, i) in students">
          <a :href="'/student/' + student.id" class="list-data">{{student.name}}</a>
          <p class="list-data">{{student.surname}}</p>
          <div class="list-actions">
            <button
              v-if="student.selected"
              class="btn btn-primary btn-sm selected-button"
              @click="unselectStudent(student, i)"
            >Selecionado</button>
            <button
              v-if="!student.selected"
              class="btn btn-primary btn-sm"
              @click="selectStudent(student, i)"
            >Selecionar</button>
          </div>
        </div>
      </div>
    </div>
    <div>
      <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
      <a @click.prevent @click="assignStudents()" href class="list-actions">Guardar</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course"],
  data() {
    return {
      students: [],
      selectedStudents: [],
    };
  },
  methods: {
    getAvailableStudents() {
      axios.get("/api/available-students").then((response) => {
        response.data.forEach((student) => {
          student.selected = false;
          this.students.push(student);
        });
      });
    },
    selectStudent(student, index) {
      this.students[index].selected = true;
      this.selectedStudents.push(student);
    },
    unselectStudent(student, studentIndex) {
      this.students[studentIndex].selected = false;
      const index = this.selectedStudents.indexOf(studentIndex);
      this.selectedStudents.splice(index, 1);
    },
    addStudentToTheCourse(student) {
      axios
        .post("/api/courses/" + this.course.id + "/addStudentToTheCourse", {
          student_id: student.id,
        })
        .then((response) => {});
    },
    assignStudents() {
      let selectedStudentsIds = [];

      this.selectedStudents.forEach((student) => {
        selectedStudentsIds.push(student.id);
      });

      console.log(selectedStudentsIds);

      axios
        .post("/api/courses/" + this.course.id + "/addStudentToTheCourse", {
          students: selectedStudentsIds,
          course_id: this.course.id,
        })
        .then((response) => {
          window.location.replace("/course/" + this.course.id + "/students");
        });
    },
    goBack() {
      window.history.back();
    },
  },
  mounted() {
    this.getAvailableStudents();
    console.log("Component mounted.");
  },
};
</script>
