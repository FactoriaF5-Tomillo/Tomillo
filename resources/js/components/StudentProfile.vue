<template>
  <div class="profile">
    <section class="profile-info">
      <div>
        <h1>{{student.name}} {{student.surname}}</h1>
        <div>
          <p>
            <strong>Email:</strong>
            {{student.email}}
          </p>
          <p>
            <strong>Fecha:</strong>
            20/5/1999
          </p>
          <p>
            <strong>Edad:</strong>
            21 años
          </p>
          <p>
            <strong>Nacionalidad:</strong>
            {{student.nationality}}
          </p>
          <p>
            <strong>Genro:</strong>
            {{student.gender}}
          </p>
        </div>
      </div>
    </section>
    <section class="profile-course">
      <div class="course-header">
        <h3>{{student.course.title}}</h3>
        <hr />
        <h4>FactoriaF5</h4>
      </div>
      <div class="course-content">
        <p>{{student.course.description}}</p>
        <hr />
        <div class="course-assistance">
          <h5>{{getDate()}}</h5>
          <button @click="checkin(student)" class="btn primary-button">Check In</button>
        </div>
      </div>
    </section>
    <div></div>
  </div>
</template>

<script>
export default {
  props: ["student"],
  data() {
    return {};
  },
  methods: {
    getDate() {
      var today = new Date();
      const dd = String(today.getDate()).padStart(2, "0");
      const mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
      const yyyy = today.getFullYear();

      return (today = dd + "/" + mm + "/" + yyyy);
    },
    goBack() {
      window.history.back();
    },
    checkin(student) {
      axios.post("/api/students/" + student.id + "/checkin", this.student);
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
