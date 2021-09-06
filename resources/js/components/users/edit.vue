<template>
    <div>
        <h4 class="text-center">Edit User</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateUser">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" v-model="user.full_name">
                        <div class="text-sm mt-2 text-danger" v-if="errors.full_name" v-for="item in errors.full_name">
                            <div>{{item}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="user.email">
                        <div class="text-sm mt-2 text-danger" v-if="errors.email" v-for="item in errors.email">
                            <div>{{item}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" v-model="user.password">
                        <div class="text-sm mt-2 text-danger" v-if="errors.password" v-for="item in errors.password">
                            <div>{{item}}</div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" v-model="user.password_confirmation">
                    </div>
                    <div class="form-group">
                        <label>Assign Role</label>
                        <select class="form-control form-select form-select-sm" aria-label=".form-select-sm example" v-model="user.role">
                          <option selected>Open this select menu</option>
                          <option v-for="role in listRoles" v-if="roles" :value="role.id">{{role.name}}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
            errors: [],
            roles: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/users/edit/${this.$route.params.id}`)
                .then(response => {
                    this.user = response.data;
                    this.user.password = ""
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    mounted(){
        this.getRoles()
    },
    computed: {
        isValid(){
            if (this.user.password === this.user.confirm_password) {
                return true
            }
            return false
        },
        listRoles(){
            if (this.roles) {
                return this.roles
            }
            return [];
        }
    },
    methods: {
        updateUser() {
            let vm = this;
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/users/update/${this.$route.params.id}`, this.user)
                    .then(response => {
                        this.$router.push({name: 'users'});
                    })
                    .catch(function (error) {
                        vm.generateError(error.response.data);
                    });
            })
        },
        getRoles(){
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/roles')
                    .then(response => {
                        this.roles = response.data;
                        console.log(response.data, "response.data");
                    })
                    .catch(function (error) {
                        vm.generateError(error.response.data);
                    });
            })
        },
        generateError(data){
            var errs = data.errors;
            this.errors = [];
            this.errors = errs;
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