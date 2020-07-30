<template>
  <div>
    <div class="page-title">
      <h1>Info</h1>
    </div>
    <div class="info">
      <div class="info-header">
        <h3>{{course.title}}</h3>
      </div>
      <div class="info-body">
        <p>{{course.description}}</p>
      </div>
      <div class="info-footer">
        <p>Fecha de inicio: {{course.start_date}}</p>
        <p>Fecha de terminacion: {{course.end_date}}</p>
      </div>
    </div>
    <div class="actions">
      <h3>Acciones:</h3>
      <div class="action-buttons">
          <a class="btn btn-dark" :href="'/course/' + course.id + '/showAssignTeacher'">Asignar Profe</a>
          <a class="btn btn-dark" :href="'/course/' + course.id + '/chooseStudent'">Asignar Alumnos</a>

          <a class="btn btn-dark" :href="'/course/' + course.id + '/edit'">Editar</a>
          <a class="btn btn-dark" href @click="deleteCourse(course)">Eliminar</a>
      </div>
    </div>
    <a class="back-button btn btn-secondary" href="/courses">Volver</a>
  </div>
</template>

<script>
export default {
    props: ['course'],
  data() {
    return {
    };
  },

  methods: {
    deleteCourse(course) {
      if (confirm("¿Estas seguro que quieres eliminar este curso?")) {
        axios.delete("/api/courses/" + course.id).then((response) => {
          window.location.replace("/courses");
        });
      }
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
