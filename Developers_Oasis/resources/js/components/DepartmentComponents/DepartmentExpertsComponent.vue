<template>
    <div v-if="experts && experts.length > 0">
        <h4 class="font-weight-bold mt-3">Experts</h4>
        <div class="card-container">
            <v-card v-for="expert in experts" :key="expert.id" class="card-item" max-width="344">
                <v-img class="align-end text-white" height="200" :src="'public/images/' +expert.user.image" cover/>
                <v-card-title>
                    <strong>Name: </strong>{{ expert.user.name }}
                </v-card-title>

                <v-card-subtitle>
                    <strong>Email: </strong>{{ expert.user.email }}
                </v-card-subtitle>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'" @click="show = !show"></v-btn>
                </v-card-actions>

                <v-expand-transition>
                    <div v-show="show">
                        <h2>Details</h2>
                        <div>
                            <p><strong>Department ID:</strong> {{ expert.dept_id }}</p>
                            <p><strong>Bio:</strong> {{ expert.bio }}</p>
                            <p><strong>User ID:</strong> {{ expert.user_id }}</p>
                            <p><strong>Created At:</strong> {{ expert.created_at }}</p>
                            <p><strong>Updated At:</strong> {{ expert.updated_at }}</p>
                        </div>
                    </div>
                </v-expand-transition>
            </v-card>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            experts: [],
            departments: [],
            show: false,
        };
    },
    mounted() {
        try {
            const departmentId = this.$route.params.id;
            this.exploreDepartment(departmentId);
        } catch (error) {
            console.error(error);
        }
    },
    methods: {
        exploreDepartment(id) {
            // Make an API request to explore the department and its experts
            axios
                .get(`/api/departments/${id}/explore`)
                .then(response => {
                    const department = response.data.department;
                    const expert = response.data.experts;
                    // Handle the department and experts data
                    this.experts = expert;
                    this.departments = department;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>

<style scoped>
.card-container {
    display: flex;
    flex-wrap: wrap;
}

.card-item {
    flex: 1 1 300px;
    margin: 8px;
}
</style>
