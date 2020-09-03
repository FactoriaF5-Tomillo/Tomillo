<template>
    <div>
        <div class="page-title">
            <h1>Añadir profesor</h1>
        </div>
        <div class="form">
            <div class="form-group">
                <label>Nombre</label>
                <input
                    class="form-control"
                    type="text"
                    name="name"
                    v-model="teacher.name"
                />
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input
                    class="form-control"
                    type="text"
                    name="surname"
                    v-model="teacher.surname"
                />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input
                    class="form-control"
                    type="text"
                    name="email"
                    v-model="teacher.email"
                />
            </div>
            <div class="form-submit">
                <a @click.prevent @click="goBack()" href class="list-actions"
                    >&#8592; Volver</a
                >
                <button type="submit" class="btn primary-button" @click="createTeacher()">
                    Crear
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            teacher: {}
        };
    },
    methods: {
        createTeacher() {
            axios.post("/teachers", this.teacher).then(response => {
                window.location.replace("/teachers");
            });
        },
        goBack() {
            window.history.back();
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
