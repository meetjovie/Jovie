<template>
  <div class="relative items-center">
    <div
      v-if="dataType == 'currency' && modelValue && modelValue.length > 0"
      class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
      <span class="text-md font-bold">$</span>
    </div>
    <input
      ref="input"
      :class="{
        'pl-4': dataType == 'currency',
        'pr-3': dataType == 'email',
      }"
      class="block w-full bg-transparent px-2 py-1 placeholder-slate-300 focus-visible:border-none focus-visible:outline-none focus-visible:ring-0 dark:placeholder-slate-500 sm:text-xs"
      :value="modelValue"
      :id="fieldId"
      autocomplete="off"
      :placeholder="placeholder"
      :pattern="dataType == 'currency' ? '\\d*' : null"
      :aria-describedby="fieldId"
      @keydown.esc.prevent="handleEscKey"
      @input="handleInput"
      @change="onBlur" />
    <div
      tabindex="-1"
      v-if="dataType == 'email' && modelValue && modelValue.length > 0"
      class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 focus-visible:outline-none focus-visible:ring-0">
      <EmailValidationIcon
        tabindex="-1"
        :validatingEmail="validatingEmail"
        :passesValidation="passesValidation"
        :errorMessage="errorMessage" />
    </div>
  </div>
</template>

<script>
import EmailValidationIcon from './EmailValidationIcon.vue';
import {CurrencyDollarIcon} from '@heroicons/vue/24/outline';

export default {
  components: {
    EmailValidationIcon,
    CurrencyDollarIcon,
  },
  data() {
    return {
      passesValidation: null,
      errorMessage: '',
      validatingEmail: false,
      showValidationModal: false,
      passedValidationMethods: [],
    };
  },
  props: ['modelValue', 'placeholder', 'fieldId', 'dataType', 'value'],
  emits: ['update:modelValue', 'blur'],
  methods: {
    handleInput(event) {
      if (this.dataType === 'currency') {
        // Remove any non-numeric characters and enforce the regex pattern
        event.target.value = event.target.value.replace(/[^\d.]/g, '');
      }
    },
    handleEscKey(event) {
      if (event.key === 'Escape') {
        this.$refs.input.value = this.modelValue;
        this.$refs.input.blur(); // Blur the input field to remove focus
      }
    },
    onBlur(e) {
      this.$emit('update:modelValue', e.target.value);
      this.$emit('blur');
    },
    debouncedEmailCheck(email) {
      // Define the debounce function
      const debounce = (func, delay) => {
        let timeout;
        return (...args) => {
          clearTimeout(timeout);
          timeout = setTimeout(() => func(...args), delay);
        };
      };

      // Debounce the validateEmail function
      debounce(() => this.validateEmail(email), 700)();
    },
    async validateEmail(email) {
      this.passesValidationMethods = [];
      this.errorMessage = '';
      this.validatingEmail = true;

      console.log('Starting email validation...');

      // Validate email using a regular expression
      const emailRegex =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      const isValidEmail = emailRegex.test(email);

      console.log(
        `Email is ${
          isValidEmail ? 'valid' : 'invalid'
        } according to regex test.`
      );

      if (isValidEmail) {
        this.passesValidationMethods.push('regex');
      } else {
        this.validatingEmail = false;
        this.errorMessage = 'Email failed regex test';
      }

      // Extract the domain of the email address
      const domain = email.split('@')[1];

      try {
        // Use the fetch method to send a GET request to the Google DNS over HTTPS endpoint
        const response = await fetch(
          `https://dns.google.com/resolve?name=${domain}&type=MX`
        );
        const data = await response.json();

        console.log(
          `Email domain ${
            data.Answer ? 'exists' : 'does not exist'
          } according to DNS test.`
        );

        if (data.Answer) {
          this.passesValidationMethods.push('dns');
        } else {
          this.validatingEmail = false;
          this.errorMessage = 'Email failed DNS test';
        }

        if (isValidEmail && data.Answer) {
          this.validatingEmail = false;
          this.passesValidationMethods.push('full');
        }
      } catch (error) {
        this.validatingEmail = false;
        this.errorMessage = error.message;
        console.error(error);
      }
    },
  },
};
</script>
