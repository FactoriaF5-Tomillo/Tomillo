<template>
  <div>
    <div class="page-title">
      <h1>Información</h1>
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
      <h3>Páginas:</h3>
      <div class="action-buttons">
        <a class="btn primary-button" :href="'/course/' + course.id + '/students'">Alumnos</a>
        <a class="btn primary-button" :href="'/course/' + course.id + '/teachers'">Profesores</a>
        <a
          class="btn primary-button"
          :href="'/course/' + course.id + '/justifications'"
        >Justificaciones</a>
        <a class="btn primary-button" :href="'/course/' + course.id + '/course-statistics'">Estadísticas</a>
      </div>
    </div>
    <div class="actions">
      <h3>Acciones:</h3>
      <div class="action-buttons">
        <a
          class="btn primary-button"
          :href="'/course/' + course.id + '/assign-students'"
        >Asignar Alumnos</a>
        <a
          class="btn primary-button"
          :href="'/course/' + course.id + '/assign-teachers'"
        >Asignar Profesor</a>
        <a class="btn primary-button" :href="'/course/' + course.id + '/edit'">Editar</a>
        <a class="btn primary-button" href @click.prevent @click="deleteCourse(course)">Eliminar</a>
      </div>
    </div>
    <div>
      <a href="/courses" class="list-actions">&#8592; Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["course"],
  data() {
    return {};
  },

  methods: {
    deleteCourse(course) {
      if (confirm("¿Estas seguro que quieres eliminar este curso?")) {
        axios.delete("/api/courses/" + course.id).then((response) => {
          window.location.replace("/courses");
        });
      }
    },
    goBack() {
      window.history.back();
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
