<template>
  <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
    <div>
      <h3 class="text-lg font-medium leading-6 text-gray-900">
        Account security
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
        Manage your Jovie security preferences.
      </p>
    </div>
  </div>
  <div class="space-y-6 sm:space-y-5">
    <div
      class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <label
        for="old-password"
        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
        Old password
      </label>
      <div class="mt-1 sm:col-span-2 sm:mt-0">
        <input
          type="password"
          name="old-password"
          id="old-password"
          v-model="old_password"
          autocomplete="given-name"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm" />
      </div>
    </div>

    <div
      class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <label
        for="new-password"
        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
        New password
      </label>
      <div class="mt-1 sm:col-span-2 sm:mt-0">
        <input
          type="password"
          name="new-password"
          id="new-password"
          v-model="new_password"
          autocomplete="family-name"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm" />
      </div>
    </div>
    <div
      class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <label
        for="confirm-password"
        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
        Confirm new password
      </label>
      <div class="mt-1 sm:col-span-2 sm:mt-0">
        <input
          type="password"
          name="confirm-password"
          v-model="confirm_password"
          id="confirm-password"
          autocomplete="family-name"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm" />
      </div>
    </div>
    <div
      class="justify-right sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <ButtonGroup text="Update password"  @click="UpdatePassword()" />
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';
import UserService from "../../services/api/user.service";

export default {
  components: {
    ButtonGroup,
  },
    methods: {
        UpdatePassword() {
            let data            = new FormData();
            let oldpassword     = this.old_password;
            let newpassword     = this.new_password;
            let confirmpassword = this.confirm_password;
            if(oldpassword =="" || oldpassword ==null){
                alert("Please Enter the Old Password First");

                return;
            }

            if(newpassword =="" || newpassword ==null){
                alert("Please Enter the New Password");
                return;
            }

            if(confirmpassword =="" || confirmpassword ==null){
                alert("Please Enter the Confirm Password");
                return;
            }

            if(newpassword != confirmpassword){
                alert("New Password and Confirm Password Should be same.");
                return;
            }

            data.append('old_password', this.old_password);
            data.append('new_password', this.new_password);
            data.append('confirm_password', this.confirm_password);
            this.updating = true;
            UserService.updatePassword(data)
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        this.old_password     = "";
                        this.new_password     = "";
                        this.confirm_password = "";
                        // this.$store.commit('setAuthStateUser', response.user);
                        console.log(response.status);
                        alert("Password Changed Successfully!");
                        this.errors = {};


                    }
                })
                .catch((error) => {
                    error = error.response;
                    if (error.status == 422) {
                        this.errors = error.data.errors;
                        console.log(this.errors);
                        alert("Please Enter the Correct Password!");
                    }
                })
                .finally((response) => {
                    this.updating = false;
                });
        },
    },
};
</script>
