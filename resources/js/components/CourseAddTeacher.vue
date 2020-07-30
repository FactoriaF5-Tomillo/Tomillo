<template>
  <div>
    <div class="page-title">
      <h1>Profesores</h1>
      <div>
        <a href="/teacher/create" class="btn btn-primary">Crear Profesor</a>
      </div>
    </div>
    <div>
      <table class="table-list table">
        <thead class="table-head">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Asignar</th>
          </tr>
        </thead>
        <tbody class="table-body">
          <tr v-bind:key="i" v-for="(teacher, i) in teachers">
            <td>
              <a :href="'teacher/' + teacher.id">{{teacher.name}}</a>
            </td>
            <td>
              <a :href="'teacher/' + teacher.id">{{teacher.surname}}</a>
            </td>
            <td>
                <button  @click="assignTeacher(teacher)" >Asignar </button>
            </td>
          </tr>
        </tbody>
      </table>
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
        axios.post("/api/courses/"+ this.course.id + "/addTeacherToTheCourse", {
          teacher_id: teacher.id,
          course_id: this.course.id
        })
    }
  },
  mounted() {
    this.getTeachers();
    console.log("Component mounted.");
  },
};
</script>

