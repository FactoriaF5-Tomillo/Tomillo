<template>
  <div>
    <div class="page-title">
      <h1>Estadísticas del curso</h1>
    </div>
    <div>
      <p>
        <strong>Número total de alumnos:</strong>
        {{ course.totalStudents }}
      </p>
      <p>
        <strong>Número total de hombres:</strong>
        {{ course.totalMaleStudents }}
      </p>
      <p>
        <strong>Número total de mujeres:</strong>
        {{ course.totalFemaleStudents }}
      </p>
      <p>
        <strong>Otros géneros:</strong>
        {{ course.totalOtherStudents }}
      </p>
      <br />
      <p>
        <strong>Porcentaje de hombres:</strong>
        {{ course.malePercentage }}%
      </p>
      <p>
        <strong>Porcentaje de mujeres:</strong>
        {{ course.femalePercentage }}%
      </p>
      <p>
        <strong>Porcentaje de otros géneros:</strong>
        {{ course.otherPercentage }}%
      </p>
    </div>
    <br />
    <div>
      <table class="assistence-table">
        <thead>
          <tr class="heading">
            <th class="date" scope="col">#</th>
            <th class="date" scope="col" v-bind:key="i" v-for="(date, i) in course.dates">{{ date }}</th>
          </tr>
        </thead>
        <tbody class="students">
          <tr class="student" v-bind:key="i" v-for="(student, i) in course.students">
            <th scope="row">{{ student.name }}</th>
            <td v-bind:key="i" v-for="(date, i) in course.dates">
              <label v-bind:key="i" v-for="(day, i) in student.assistedDates">
                <span v-if="day == date" class="label label-true">Si</span>
              </label>
              <label v-bind:key="i" v-for="(day, i) in student.absentDates">
                <span v-if="day == date" class="label label-false">No</span>
              </label>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <br />
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
