<template>
    <v-sheet width="300" class="mx-auto">
        <form @submit.prevent="createUserAndExpert">
            <!-- User fields -->
            <v-text-field
                v-model="userData.name"
                :rules="nameRules"
                label="Name"
                required
            ></v-text-field>

            <v-text-field
                v-model="userData.email"
                label="Email"
                required
                type="email"
            ></v-text-field>

            <v-text-field
                v-model="userData.password"
                label="Password"
                required
                type="password"
            ></v-text-field>

            <!-- Expert fields -->
            <v-text-field
                v-model="expertData.dept_id"
                label="Department ID"
                required
                type="number"
            ></v-text-field>

            <v-textarea
                v-model="expertData.bio"
                label="Bio"
                required
            ></v-textarea>

            <v-btn type="submit" color="primary">Create User and Expert</v-btn>
        </form>
    </v-sheet>
</template>

<script>
export default {
    data() {
        return {
            userData: {
                name: '',
                email: '',
                password: '',
            },
            expertData: {
                dept_id: '',
                bio: '',
            },
            nameRules: [
                (v) => !!v || 'Name is required',
                (v) => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
        };
    },
    methods: {
        createUserAndExpert() {
            axios
                .post('/api/users', {
                    name: this.userData.name,
                    email: this.userData.email,
                    password: this.userData.password,
                    dept_id: this.expertData.dept_id,
                    bio: this.expertData.bio,
                })
                .then((response) => {
                    // Handle success response
                    console.log(response.data);
                })
                .catch((error) => {
                    // Handle error response
                    console.error(error.response.data);
                });
        },
    },
};
</script>
