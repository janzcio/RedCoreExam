<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">Coding Exam</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link to="/dashboard" class="nav-item nav-link" v-bind:class="{ active: currentRouteName === 'dashboard' }">Dashboard</router-link>
                    <router-link to="/users" class="nav-item nav-link" v-bind:class="{ active: currentRouteName === 'users' }">Users</router-link>
                    <router-link to="/roles" class="nav-item nav-link" v-bind:class="{ active: currentRouteName === 'roles' }">Roles</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout {{ '(' + user.full_name + ')' }}</a>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/login" class="nav-item nav-link active">login</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
            user: window.Laravel.user !== '' ? window.Laravel.user : ''
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>