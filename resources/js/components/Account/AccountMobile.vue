<template>
  <div class="col-span-6 space-y-4">
    <div class="col-span-6 flex items-center justify-between gap-2">
      <InputGroup
        :error="errors?.number?.[0]"
        :disabled="updating"
        name="number"
        type="country_code"
        label="+1"
        class="w-28"
        placeholder="+1" />
      <InputGroup
        v-model="number"
        :error="errors?.number?.[0]"
        :disabled="updating"
        name="number"
        type="mobile"
        label="Mobile Number"
        class="w-full"
        placeholder="Enter mobile number" />

      <ButtonGroup
        @click="getOtp"
        v-if="!disableOtp"
        text="Get OTP"></ButtonGroup>
    </div>

    <div class="flex">
      <OTPInput
        v-if="showOtpInput"
        :loading="updating"
        @complete="verify()"
        v-model="code" />
    </div>
  </div>
</template>

<script>
import InputGroup from '../../components/InputGroup.vue';
import ButtonGroup from '../ButtonGroup.vue';
import OTPInput from '../OTPInput.vue';
import TwillioService from '../../services/api/twillio.service';

export default {
  name: 'AccountMobile',
  props: {
    phone: {
      required: false,
    },
  },
  components: { OTPInput, ButtonGroup, InputGroup },
  data() {
    return {
      errors: {},
      updating: false,
      disableOtp: false,
      number: null,
      oldNumber: null,
      code: null,
      showOtpInput: false,
      service: {},
    };
  },
  watch: {
    number(val) {
      if (this.oldNumber !== val) {
        this.$emit('disableContinue');
        this.disableOtp = false;
      } else {
        this.disableOtp = true;
        this.$emit('verified', this.number);
      }
    },
    phone: {
      handler: function (val) {
        this.number = this.oldNumber = val;
      },
      immediate: true,
    },
  },
  methods: {
    getOtp() {
      this.showOtpInput = this.updating = true;
      let data = {};
      data.number = this.number;
      TwillioService.getOtp(data)
        .then((response) => {
          this.service = response.data;
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        })
        .finally(() => {
          this.updating = false;
        });
    },
    verify() {
      this.updating = true;
      let data = {};
      data.service = this.service;
      data.code = this.code;
      data.number = this.number;
      TwillioService.verifyOtp(data)
        .then((response) => {
          if (response.data.status === 'approved') {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: 'Mobile number verified Successfully',
            });
            this.showOtpInput = false;
            this.disableOtp = true;
            this.oldNumber = this.number;
            this.$store.state.AuthState.user.phone = this.number;
            this.$emit('verified', this.number);
          }
        })
        .catch((error) => {
          let message = 'Invalid Code';
          if (error.response.status === 422) {
            message = error.response.data.message;
          }
          this.$notify({
            group: 'user',
            type: 'error',
            duration: 15000,
            title: 'Error',
            text: message,
          });
        })
        .finally(() => {
          this.updating = false;
        });
    },
  },
};
</script>

<style scoped></style>
