<template>
    <div>
        <div class="page-title">
            <h1>Aprobar justificante</h1>
        </div>
        <div class="form">
            <div class="form-group">
                <p>
                    <strong>Nombre del archivo:</strong>
                    {{ justification.file }}
                </p>
            </div>
            <div class="form-group">
                <strong>Titulo:</strong>
                {{ justification.title }}
            </div>
            <div class="form-group">
                <strong>Descripcion:</strong>
                {{ justification.description }}
            </div>
            <div class="form-submit">
                <a @click.prevent @click="goBack()" href class="list-actions"
                    >&#8592; Volver</a
                >
                <a
                    @click.prevent
                    @click="approve()"
                    href
                    class="btn primary-button"
                    >Acceptar</a
                >
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
        approve() {
            axios
                .get("/api/justification/" + this.justification.id + "/approve")
                .then(this.goBack());
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
