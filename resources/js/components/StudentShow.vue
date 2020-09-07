<template>
  <div>
    <div class="page-title">
      <h1>Datos Del Alumno</h1>
    </div>
    <div class="show-user">
      <div class="user-info">
        <h3>{{ student.name }} {{ student.surname }}</h3>
      </div>
      <p>
        <strong>Nacionalidad:</strong>
        {{ student.nationality }}
      </p>
      <p>
        <strong>Género:</strong>
        {{ student.gender }}
      </p>
      <p>
        <strong>Email:</strong>
        {{ student.email }}
      </p>
    </div>

    <div>
      <p>
        <strong>Días Asistidos:</strong>
        {{ student.assistedDays }}
      </p>
      <p>
        <strong>Días Ausentes:</strong>
        {{ student.absentDays }}
      </p>
      <p>
        <strong>Dias justificados:</strong>
        {{ student.justifiedDays }}
      </p>
    </div>
    <br />
    <div>
      <a @click.prevent @click="goBack()" href class="list-actions">&#8592; Volver</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["student"],
  data() {
    return {};
  },
  methods: {
    goBack() {
      window.history.back();
    },
    checkin(student) {
      axios.post("/api/students/" + student.id + "/checkin", this.student);
    },
    checkout(student) {
      axios.patch("/api/students/" + student.id + "/checkout", this.student);
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
