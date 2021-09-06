<template>
    <div>
        <h4 class="text-center">Role Details</h4>
        <div class="row">
            <div class="col-md-6">
                
                    <div class="form-group">
                        <label><b>Name</b></label> <br>
                        <span>{{ role.name }}</span>
                    </div>
                    <div class="form-group">
                        <label><b>Description</b></label> <br>
                        <span>{{ role.description }}</span>
                    </div>
                    <router-link :to="{name: 'roles'}" class="btn btn-success">Back
                        </router-link>
                
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
       
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>