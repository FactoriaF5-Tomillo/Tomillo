<template>
  <div>
    <div class="page-title">
      <h1>Estadísticas del curso</h1>
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
    <div>
        <p>
            <strong>Número total de alumnos:</strong>
            {{course.totalStudents}}
        </p>
        <p>
            <strong>Número total de hombres:</strong>
            {{course.totalMaleStudents}}
        </p>
        <p>
            <strong>Número total de mujeres:</strong>
            {{course.totalFemaleStudents}}
        </p>
        <p>
            <strong>Otros géneros:</strong>
            {{course.totalOtherStudents}}
        </p>
        <br>
        <p>
            <strong>Porcentaje de hombres:</strong>
            {{course.malePercentage}}%
        </p>
        <p>
            <strong>Porcentaje de mujeres:</strong>
            {{course.femalePercentage}}%
        </p>
        <p>
            <strong>Porcentaje de otros géneros:</strong>
            {{course.otherPercentage}}%
        </p>
    </div>
    <br>
      <div>
          <table>
              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col" v-bind:key="i" v-for="(date, i) in course.dates">{{date}}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-bind:key="i" v-for="(student, i) in course.students">
                  <th scope="row">{{student.name}}</th>
                  <td v-bind:key="j" v-for="(date, j) in course.dates">
                      <label v-bind:key="i" v-for="(day, i) in student.assistedDates">
                          <span v-bind:key="j" v-if="date==day">Yes</span>
                          <span v-bind:key="j" v-if="day!=date">-</span>
                      </label>
                  </td>
              </tr>
              </tbody>
          </table>
      </div>
      <br>
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

    goBack() {
      window.history.back();
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
