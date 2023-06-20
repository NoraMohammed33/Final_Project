<template>
    <div class="department-list">
        <h2>Departments List</h2>
        <div class="department-card-container">
            <v-card v-for="department in departments" :key="department.id" class="department-card">
                <v-card-title>{{ department.name }}</v-card-title>

                <v-card-text>
                    <div>{{ department.description }}</div>
                </v-card-text>

                <v-card-actions>
                    <v-btn color="orange" @click="editDepartment(department)">
                        Edit
                    </v-btn>

                    <v-btn color="red" @click="deleteDepartment(department)">
                        Delete
                    </v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            departments: [],
        };
    },
    mounted() {
        this.fetchDepartments();
    },
    methods: {
        fetchDepartments() {
            axios
                .get("/api/departments")
                .then((response) => {
                    this.departments = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        editDepartment(department) {
            // Implement the logic to edit the department
            // For example, navigate to a department edit page
            this.$router.push(`/departments/${department.id}/edit`);
        },
        deleteDepartment(department) {
            // Implement the logic to delete the department
            // For example, send a DELETE request to the server
            axios
                .delete(`/api/departments/${department.id}`)
                .then((response) => {
                    // Handle the success response
                    console.log("Department deleted");
                    // Refresh the departments list
                    this.fetchDepartments();
                })
                .catch((error) => {
                    // Handle the error response
                    console.log(error);
                });
        },
    },
};
</script>

<style>
.department-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
}

.department-card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 0 -10px;
}

.department-card {
    width: calc(33.33% - 20px);
    margin: 10px;
}
</style>
