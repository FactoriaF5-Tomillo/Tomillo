<template>
    <div>
        <div class="page-title">
            <h1>Justifications</h1>
        </div>
        <div class="list">
            <div class="list-heading">
                <div class="list-row">
                    <h3>Alumno</h3>
                    <h3>Titulo</h3>
                    <h3>Status</h3>
                    <h3>Fechas</h3>
                </div>
            </div>
            <div class="list-content">
                <div
                    class="list-row"
                    v-bind:key="i"
                    v-for="(justification, i) in justifications"
                >
                    <a :href="'/student/'" class="list-data">{{
                        justification.user.name
                    }}</a>
                    <p class="list-data">{{ justification.title }}</p>
                    <span
                        v-if="!justification.approved"
                        class="label label-false"
                        >No Acceptada</span
                    >
                    <span v-if="justification.approved" class="label label-true"
                        >Acceptada</span
                    >
                    <p class="list-data">
                        {{ justification.start_date }} /
                        {{ justification.end_date }}
                    </p>
                </div>
            </div>
        </div>
        <div>
            <a @click.prevent @click="goBack()" href class="list-actions"
                >&#8592; Volver</a
            >
        </div>
    </div>
</template>

<script>
export default {
    props: ["justifications"],
    data() {
        return {};
    },
    methods: {
        goBack() {
            window.history.back();
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
