<template>
  <div>
    <div class="page-title">
      <h1>Alumnos de {{course.title}}</h1>
      <div>
        <a
          :href="'/course/' + course.id + '/assign-teachers'"
          class="btn primary-button"
        >Assignar profesores</a>
      </div>
    </div>
    <div class="list">
      <div class="list-heading">
        <div class="list-row">
          <h3>Nombre</h3>
          <h3>Apellido</h3>
          <h3>Email</h3>
        </div>
      </div>
      <div class="list-content">
        <div class="list-row" v-bind:key="i" v-for="(teacher, i) in course.teachers">
          <a :href="'/teacher/' + teacher.id" class="list-data">{{teacher.name}}</a>
          <p class="list-data">{{teacher.surname}}</p>
          <p>{{teacher.email}}</p>
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
    return {};
  },
  methods: {
    goBack() {
      window.history.back();
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
