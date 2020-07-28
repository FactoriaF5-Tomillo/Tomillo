<template>
  <div>
    <div class="card-header">Actualizar Datos del Alumno</div>
    <div class="card-body">
      <form @submit.prevent>
        <div class="form-group">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" v-model="student.name" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Apellido</label>
            <input
              type="text"
              name="surname"
              v-model="student.surname"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label>Nacionalidad</label>
            <input
              type="text"
              name="nationality"
              v-model="student.nationality"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" v-model="student.email" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Sexo</label>
            <input type="text" name="gender" v-model="student.gender" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Curso Actual</label>
            <input
              type="text"
              name="currentcourse"
              v-model="student.currentcourse"
              class="form-control"
              required
            />
          </div>
        </div>
        <div class="card-footer">
          <button
            class="btn btn-primary"
            @click="updateStudentInfo(student)"
            value="Actualizar"
          >Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: ["student"],
  data() {
    return {};
  },
  mounted() {

    console.log("Component mounted.");

  },
    methods:{

        updateStudentInfo(student){
            axios.patch("/api/students/"+ student.id, this.student).then(
                window.location.replace('/students'))
        }
    }

};
</script>
