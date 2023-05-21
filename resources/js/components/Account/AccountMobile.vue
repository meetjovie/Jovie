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

    <div>
      <label for="phone-number" class="sr-only">Phone Number</label>
      <div class="relative mt-2 flex items-center">
        <div class="absolute inset-y-0 left-0 flex items-center">
          <label for="country" class="sr-only">Country</label>
          <select
            :disabled="updating"
            id="country"
            name="country"
            autocomplete="country"
            class="h-full rounded-md border-0 bg-transparent py-0 pl-3 pr-7 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
            <template v-for="item in countries">
              <option :value="item.value">{{ item.name }}</option>
            </template>
          </select>
        </div>
        <input
          :disabled="updating"
          type="text"
          name="search"
          id="search"
          class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
          <kbd
            v-if="!disableOtp"
            @click="getOtp"
            class="hover:bg-200 inline-flex cursor-pointer items-center rounded border border-gray-200 px-1 px-2 font-sans text-xs text-gray-400 hover:shadow active:shadow-none"
            >Get Code</kbd
          >
        </div>
      </div>
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
      countries: [
        { code: '+1', name: 'US' },
        { code: '+1', name: 'CA' },
        { code: '+91', name: 'IN' },
        { code: '+86', name: 'CN' },
        { code: '+55', name: 'BR' },
        { code: '+62', name: 'ID' },
        { code: '+92', name: 'PK' },
        { code: '+234', name: 'NG' },
        { code: '+880', name: 'BD' },
        { code: '+81', name: 'JP' },
        { code: '+84', name: 'VN' },
        { code: '+52', name: 'MX' },
        { code: '+63', name: 'PH' },
        { code: '+7', name: 'RU' },
        { code: '+49', name: 'DE' },
        { code: '+44', name: 'GB' },
        { code: '+90', name: 'TR' },
        { code: '+33', name: 'FR' },
        { code: '+98', name: 'IR' },
        { code: '+62', name: 'ID' },
        { code: '+39', name: 'IT' },
        { code: '+82', name: 'KR' },
        { code: '+27', name: 'ZA' },
        { code: '+34', name: 'ES' },
        { code: '+54', name: 'AR' },
        { code: '+93', name: 'Afghanistan' },
        { code: '+355', name: 'Albania' },
        { code: '+213', name: 'Algeria' },
        { code: '+684', name: 'American Samoa' },
        { code: '+376', name: 'Andorra' },
        { code: '+244', name: 'Angola' },
        { code: '+1-264', name: 'Anguilla' },
        { code: '+1-268', name: 'Antigua & Barbuda' },
        { code: '+374', name: 'Armenia' },
        { code: '+297', name: 'Aruba' },
        { code: '+61', name: 'Australia' },
        { code: '+43', name: 'Austria' },
        { code: '+994', name: 'Azerbaijan' },
        { code: '+973', name: 'Bahrain' },
        { code: '+880', name: 'Bangladesh' },
        { code: '+1-246', name: 'Barbados' },
        { code: '+375', name: 'Belarus' },
        { code: '+32', name: 'Belgium' },
        { code: '+501', name: 'Belize' },
        { code: '+229', name: 'Benin' },
        { code: '+1-441', name: 'Bermuda' },
        { code: '+975', name: 'Bhutan' },
        { code: '+591', name: 'Bolivia' },
        { code: '+387', name: 'Bosnia and Herzegovina' },
        { code: '+267', name: 'Botswana' },
        { code: '+55', name: 'Brazil' },
        { code: '+673', name: 'Brunei' },
        { code: '+359', name: 'Bulgaria' },
        { code: '+226', name: 'Burkina Faso' },
        { code: '+257', name: 'Burundi' },
        { code: '+855', name: 'Cambodia' },
        { code: '+237', name: 'Cameroon' },
        { code: '+238', name: 'Cape Verde' },
        { code: '+236', name: 'Central African Republic' },
        { code: '+235', name: 'Chad' },
        { code: '+506', name: 'Costa Rica' },
        { code: '+385', name: 'Croatia' },
        { code: '+357', name: 'Cyprus' },
        { code: '+420', name: 'Czech Republic' },
        { code: '+45', name: 'Denmark' },
        { code: '+253', name: 'Djibouti' },
        { code: '+1-767', name: 'Dominica' },
        { code: '+1-809, +1-829, +1-849', name: 'Dominican Republic' },
        { code: '+593', name: 'Ecuador' },
        { code: '+20', name: 'Egypt' },
        { code: '+503', name: 'El Salvador' },
        { code: '+240', name: 'Equatorial Guinea' },
        { code: '+372', name: 'Estonia' },
        { code: '+251', name: 'Ethiopia' },
        { code: '+500', name: 'Falkland Islands' },
        { code: '+298', name: 'Faroe Islands' },
        { code: '+679', name: 'Fiji' },
        { code: '+358', name: 'Finland' },
        { code: '+33', name: 'France' },
        { code: '+594', name: 'French Guiana' },
        { code: '+689', name: 'French Polynesia' },
        { code: '+241', name: 'Gabon' },
        { code: '+220', name: 'Gambia' },
        { code: '+995', name: 'Georgia' },
        { code: '+233', name: 'Ghana' },
        { code: '+350', name: 'Gibraltar' },
        { code: '+30', name: 'Greece' },
        { code: '+299', name: 'Greenland' },
        { code: '+1-473', name: 'Grenada' },
        { code: '+590', name: 'Guadeloupe & Martinique' },
        { code: '+1-671', name: 'Guam' },
        { code: '+502', name: 'Guatemala' },
        { code: '+44-1481', name: 'Guernsey' },
        { code: '+224', name: 'Guinea' },
        { code: '+245', name: 'Guinea-Bissau' },
        { code: '+592', name: 'Guyana' },
        { code: '+509', name: 'Haiti' },
        { code: '+504', name: 'Honduras' },
        { code: '+852', name: 'Hong Kong' },
        { code: '+36', name: 'Hungary' },
        { code: '+354', name: 'Iceland' },
        { code: '+62', name: 'Indonesia' },
        { code: '+98', name: 'Iran' },
        { code: '+964', name: 'Iraq' },
        { code: '+353', name: 'Ireland' },
        { code: '+44-1624', name: 'Isle of Man' },
        { code: '+972', name: 'Israel' },
        { code: '+39', name: 'Italy' },
        { code: '+1-876', name: 'Jamaica' },
        { code: '+81', name: 'Japan' },
        { code: '+44-1534', name: 'Jersey' },
        { code: '+962', name: 'Jordan' },
        { code: '+7', name: 'Kazakhstan' },
        { code: '+254', name: 'Kenya' },
        { code: '+965', name: 'Kuwait' },
        { code: '+996', name: 'Kyrgyzstan' },
        { code: '+856', name: "Laos (Lao People's Democratic Republic)" },
        { code: '+371', name: 'Latvia' },
        { code: '+961', name: 'Lebanon' },
        { code: '+266', name: 'Lesotho' },
        { code: '+231', name: 'Liberia' },
      ],
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
