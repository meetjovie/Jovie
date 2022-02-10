<template>
  <div>
     <ExternalHeader></ExternalHeader>
    <router-view />
   
    <ExternalFooter>
      
    </ExternalFooter>
  </div>
</template>

<script>
import {
    InboxIcon,
    PencilAltIcon,
    TrashIcon,
    UsersIcon,
} from '@heroicons/vue/outline'
import UserService from "../services/api/user.service";
import {useAuth0} from "../utils/useAuth0";
import ExternalFooter from "../components/External/ExternalFooter";
import ExternalHeader from "../components/External/ExternalHeader";

const {login, logout, initAuth} = useAuth0();

export default {
    name: "Default",
    components: {
        InboxIcon,
        PencilAltIcon,
        TrashIcon,
        UsersIcon,
        ExternalFooter,
        ExternalHeader,
    },
    setup() {
        initAuth();
    },
    data() {
        return {
            waitListEmail: '',
            error: null
        }
    },
    methods: {
        login() {
            login()
        },
        logout() {
            logout()
        },
        async requestDemo() {
            await UserService.addToWaitList({email: this.waitListEmail}).then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('setAddedToWaitList')
                    this.waitListEmail = ''
                    this.error = null
                    this.$router.push('demo')
                }
            }).catch(error => {
                error = error.response
                if (error.status == 422) {
                    this.error = error.data.errors.email[0]
                }
            })
        }
    }
}
</script>
<style>
/* your style */
</style>
