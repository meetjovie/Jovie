<template>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-neutral-900">Profile Information</h3>

                        <p class="mt-1 text-sm text-neutral-600">
                            Update your account's profile information and email address.
                        </p>
                    </div>

                    <div class="px-4 sm:px-0">
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="updateProfile()" method="post" enctype="multipart/form-data">
                        <div x-data="{photoName: null, photoPreview: null}" class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <!-- Profile Photo File Input -->
                                    <div class="mt-1 flex items-center space-x-5">
                                      <span class="inline-block h-20 w-20 rounded-full object-cover overflow-hidden bg-neutral-100">
                                        <img id="profile_pic_url_img" ref="profile_pic_url_img" :src="$store.state.AuthState.user.profile_pic_url ?? $store.state.AuthState.user.default_image">
                                      </span>

                                        <label for="profile_pic_url"
                                               class="bg-white cursor-pointer py-2 px-3 border border-neutral-300 rounded-md shadow-sm text-sm leading-4 font-medium text-neutral-700 hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Change
                                        </label>
                                        <input :disabled="updating" type="file" ref="profile_pic_url" @change="fileChanged($event)" name="profile_pic_url" id="profile_pic_url" style="display: none">
                                        <p v-if="errors.profile_pic_url" class="text-sm text-red-600 mt-2">{{ errors.profile_pic_url[0] }}</p>
                                    </div>

                                    <button @click="removeProfilePhoto()" v-if="$store.state.AuthState.user.profile_pic_url" type="button" class="mt-2 mr-2 inline-flex items-center px-4 py-2 bg-white border border-neutral-300 rounded-md font-semibold text-xs text-neutral-700 uppercase tracking-widest shadow-sm hover:text-neutral-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-neutral-800 active:bg-neutral-50 disabled:opacity-25 transition">
                                        Remove Photo
                                    </button>
                                </div>

                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <InputGroup v-model="$store.state.AuthState.user.first_name"
                                                :error="errors?.first_name?.[0]"
                                                :disabled="updating"
                                                name="first_name"
                                                label="First Name"
                                                placeholder="First Name"
                                                type="text"/>
                                </div>

                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <InputGroup v-model="$store.state.AuthState.user.last_name"
                                                :error="errors?.last_name?.[0]"
                                                :disabled="updating"
                                                name="last_name"
                                                label="Last Name"
                                                placeholder="Last Name"
                                                type="text"/>
                                </div>

                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4">
                                    <InputGroup :value="$store.state.AuthState.user.email"
                                                :error="errors?.email?.[0]"
                                                :disabled="true"
                                                name="email"
                                                label="Email"
                                                placeholder="Email"
                                                type="text"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-neutral-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <button type="submit" :disabled="updating" class="inline-flex items-center px-4 py-2 bg-neutral-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-700 active:bg-neutral-900 focus:outline-none focus:border-neutral-900 focus:ring focus:ring-neutral-300 disabled:opacity-25 transition">
                                Save
                            </button>
                        </div>
                    </form>
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="bg-white mt-8 shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="sm:flex sm:items-start sm:justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-neutral-900">
                                        Manage subscription
                                    </h3>
                                    <div class="mt-2 max-w-xl text-sm text-neutral-500">
                                        <p>
                                            You can change your plan at any time. You're currently subscribed to:
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                    <a href="/billing">
                                        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                            Change plan
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-neutral-200"></div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import UserService from "../services/api/user.service";
import InputGroup from "../components/InputGroup";

export default {
    name: "Profile",
    components: {InputGroup},
    data() {
        return {
            errors: {},
            updating: false
        }
    },
    methods: {
        fileChanged(e) {
            const src = URL.createObjectURL(e.target.files[0])
            this.$refs.profile_pic_url_img.src = src
        },
        updateProfile() {
            let data = new FormData()
            data.append('first_name', this.$store.state.AuthState.user.first_name)
            data.append('last_name', this.$store.state.AuthState.user.last_name)
            if (this.$refs.profile_pic_url.files.length) {
                data.append('profile_pic_url', this.$refs.profile_pic_url.files[0])
            }
            this.updating = true
            UserService.updateProfile(data).then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('setAuthStateUser', response.user)
                    this.$refs.profile_pic_url.value = null
                    this.errors = {}
                }
            }).catch(error => {
                error = error.response
                if (error.status == 422) {
                    this.errors = error.data.errors
                }
            }).finally(response => {
                this.updating = false
            })
        },
        removeProfilePhoto() {
            this.updating = true
            UserService.removeProfilePhoto().then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('setAuthStateUser', response.user)
                }
            }).catch(error => {
                error = error.response
            }).finally(response => {
                this.updating = false
            })
        }
    }
}
</script>

<style scoped>

</style>
