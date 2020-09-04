<template>
  <div>
    <div class="page-title">
      <h1>Profesores</h1>
      <div>
        <a href="/teacher/create" class="btn primary-button">Añadir profesor</a>
      </div>
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
            <a :href="'/teacher/' + teacher.id + '/edit'">Editar</a>
            <a @click.prevent @click="deleteTeacher(teacher)" href class="list-actions">Eliminar</a>
          </div>
        </div>
      </div>
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
      if (confirm("¿Estas seguro que quieres eliminar al profesor ?")) {
        axios.delete("/teachers/" + teacher.id).then((response) => {
          this.teachers = response.data;
        });
      }
    },
  },
  mounted() {
    this.getTeachers();
    console.log("Component mounted.");
  },
};
</script>
