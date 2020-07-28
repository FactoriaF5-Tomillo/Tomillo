<template>
  <div class="container">
      <div class="card-header">
          Actualizar Datos del Alumno
      </div>
      <div class="card-body">
          <form :action="'/api/students/' + student.id" method="POST">
              <div class="form-group">
                  <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" name="name" v-model="student.name" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" name="surname" v-model="student.surname" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Nacionalidad</label>
                      <input type="text" name="nationality" v-model="student.nationality" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" v-model="student.email" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Sexo</label>
                      <input type="text" name="gender" v-model="student.gender" class="form-control"  required>
                  </div>
                  <div class="form-group">
                      <label>Curso Actual</label>
                      <input type="text" name="currentcourse" v-model="student.currentcourse" class="form-control" required>
                  </div>
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
      </div>
  </div>
</template>

<script>
export default {
  props: ["student"],
  data() {
    return {

    };
  },
  mounted() {
    console.log("Component mounted.");
  },
    methods:{
      editStudentInfo(){
          axios.post("/api/students/" + student.id,
              {
                  name:this.name,
                  surname:this.surname,
                  nationality:this.nationality,
                  email:this.email,
                  gender:this.gender,
                  currentcourse:this.currentcourse
              })
      }
    }
};
</script>
