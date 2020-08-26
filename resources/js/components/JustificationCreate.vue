<template>
  <div>
    <div class="page-title">
      <h1>Añadir justificante</h1>
    </div>
    <div class="form">
      <div class="form-group">
        <form id="frm" url="justifications" files="true" enctype="multipart/form-data">
          <label for="File">
            <b>Archivo:</b>
          </label>
          <input type="file" name="file" required />
          <div class="form-group">
            <label>Descripcion</label>
            <input
              class="form-control"
              type="text"
              name="description"
              v-model="justification.description"
            />
          </div>
          <input type="submit" value="Enviar" />
        </form>
      </div>
      <div class="form-submit">
        <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
        <button class="btn btn-primary" @click="createJustification()">Crear</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      justification: {},
    };
  },
  methods: {
    createJustification() {
      axios.post("/api/justification", this.justification).then((response) => {
        //window.location.replace("/justification");
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
