<template>
    <div>
        <h4 class="text-center">Add Role</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addRole">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="role.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="role.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Add role</button>
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
    computed: {
        isValid(){
            if (this.role.password === this.role.confirm_password) {
                return true
            }
            return false
        }
    },  
    methods: {
        addRole() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/roles/add', this.role)
                    .then(response => {
                        this.$router.push({name: 'roles'})
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