<template>
    <div>
        <h4 class="text-center">Edit Role</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateRole">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="role.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="role.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update role</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            role: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/roles/edit/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data, "response.data");
                    this.role = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateRole() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/roles/update/${this.$route.params.id}`, this.role)
                    .then(response => {
                        this.$router.push({name: 'roles'});
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