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
                      <input type="text" name="name" v-model="name" class="form-control" :value="student.name" required>
                  </div>
                  <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" name="surname" v-model="surname" class="form-control" :value="student.surname" required>
                  </div>
                  <div class="form-group">
                      <label>Nacionalidad</label>
                      <input type="text" name="nationality" v-model="nationality" class="form-control" :value="student.nationality" required>
                  </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" v-model="email" class="form-control" :value="student.email" required>
                  </div>
                  <div class="form-group">
                      <label>Sexo</label>
                      <input type="text" name="gender" v-model="gender" class="form-control" :value="student.gender" required>
                  </div>
                  <div class="form-group">
                      <label>Curso Actual</label>
                      <input type="text" name="currentcourse" v-model="currentcourse" class="form-control" :value="student.currentcourse" required>
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
        name: '',
        surname: '',
        nationality: '',
        email: '',
        gender: '',
        currentcourse:''
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
