<template>
    <div>
        <h4 class="text-center">All Role</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="role in roles" :key="role.id">
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.description }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'role-edit', params: { id: role.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <router-link :to="{name: 'role-show', params: { id: role.id }}" class="btn btn-success">Show
                        </router-link>
                        <button class="btn btn-danger" @click="deleteRole(role.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/roles/create')">Add role</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            roles: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/roles')
                .then(response => {
                    console.log(response.data, "response.data");
                    this.roles = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteRole(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/roles/delete/${id}`)
                    .then(response => {
                        let i = this.roles.map(item => item.id).indexOf(id); // find index of your object
                        this.roles.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>