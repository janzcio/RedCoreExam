<template>
    <div>
        <h4 class="text-center">User Details</h4>
        <div class="row">
            <div class="col-md-6">
                
                    <div class="form-group">
                        <label><b>Name</b></label> <br>
                        <span>{{ user.full_name }}</span>
                    </div>
                    <div class="form-group">
                        <label><b>Author</b></label> <br>
                        <span>{{ user.email }}</span>
                    </div>
                    <router-link :to="{name: 'users'}" class="btn btn-success">Back
                        </router-link>
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/users/edit/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data, "response.data");
                    this.user = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
       
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>