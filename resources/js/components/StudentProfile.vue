<template>
    <div class="profile">
        <section class="profile-info">
            <div>
                <h1>{{ student.name }} {{ student.surname }}</h1>
                <div>
                    <p>
                        <strong>Email:</strong>
                        {{ student.email }}
                    </p>
                    <p>
                        <strong>Fecha:</strong>
                        {{ student.date_of_birth }}
                    </p>
                    <p>
                        <strong>Edad:</strong>
                        {{ student.age }} años
                    </p>
                    <p>
                        <strong>Nacionalidad:</strong>
                        {{ student.nationality }}
                    </p>
                    <p>
                        <strong>Genro:</strong>
                        {{ student.gender }}
                    </p>
                </div>
            </div>
        </section>
        <section class="profile-course" v-if="student.course">
            <div class="course-header">
                <h3>{{ student.course.title }}</h3>
                <hr />
                <h4>FactoriaF5</h4>
            </div>
            <div class="course-content">
                <p>{{ student.course.description }}</p>
                <hr />
                <div class="course-assistance">
                    <h5>{{ getDate() }}</h5>
                    <div>
                        <button
                            v-if="student.canCheckIn"
                            class="btn primary-button"
                            @click="checkin(student)"
                        >
                            Check In
                        </button>
                        <button
                            v-if="!student.canCheckIn"
                            class="btn primary-button"
                            @click="checkout(student)"
                        >
                            Check Out
                        </button>
                    </div>
                </div>
            </div>
        </section>
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
            axios.post(
                "/api/students/" + student.id + "/checkin",
                this.student
            );
        },
        checkout(student) {
            axios.patch(
                "/api/students/" + student.id + "/checkout",
                this.student
            );
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
