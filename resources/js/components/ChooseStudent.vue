<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h1>Asignar alumnos al curso: {{course.title}}</h1>
      </div>
      <div class="card-body">
        <div class="row">
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
                            <button class="btn btn-primary mb-2" @click="addStudentToTheCourse(student)">Asignar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-between">
        <a class="btn btn-secondary mb-2" href="/courses">&#8592; Volver</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course"],
  data() {
    return {
        students:[],
    };
  },
  methods: {
      getStudents() {
          axios.get("/api/students").then((response) => {
              console.log(response);
              this.students = response.data;
          });
      },
      addStudentToTheCourse(student)
      {
          axios.post("/api/courses/"+ this.course.id + "/addStudentToTheCourse", {
              student_id: student.id,
              course_id: this.course.id
          }).then((response) => {
              ;
          });
      },
  },
  mounted() {
      this.getStudents();
    console.log("Component mounted.");
  },
};
</script>
