<template>
  <div>
    <div class="page-title">
      <h1>Aprobar justificante</h1>
    </div>
    <div class="form">
      <div class="form-group">
        <p>
          <strong>Nombre del archivo:</strong>
          {{justification.file}}
        </p>
      </div>
      <div class="form-group">
          <strong>Descripcion:</strong>
          {{justification.description}}
      </div>
      <div class="form-group">
        <label>Accion</label>
        <select v-model="justification.approval" class="form-control">
          <option value="0">Aceptar</option>
          <option value="1">Denegar</option>
        </select>
      </div>
      <div class="form-submit">
        <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
        <button class="btn primary-button mb-2" @click="editJustification()">Guardar</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["justification"],
  data() {
    return {};
  },
  methods: {
    editJustification() {
      axios
        .put("/justifications/" + this.justification.id, this.justification)
        .then((response) => {
          window.history.back();
        });
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
