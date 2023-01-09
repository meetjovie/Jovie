<template>
  <div class="flex flex-col">
    <div id="otp" class="mt-5 flex flex-row justify-center px-2 text-center">
      <input
        v-for="(digit, index) in code"
        v-model="code[index]"
        @input="checkComplete($event)"
        @paste="checkComplete($event)"
        @beforeinput="checkClipboard($event)"
        :key="'digit' + (index + 1)"
        class="form-control m-2 h-10 w-10 rounded border border-slate-200 text-center font-bold dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-100 dark:text-jovieDark-200"
        type="text"
        placeholder="0"
        :id="'digit' + index"
        pattern="[0-9]"
        maxlength="1" />
      <div class="ml-2 h-10 w-10">
        <JovieSpinner v-if="loading" class="mt-5" />
      </div>
    </div>
    <div
      v-if="code.length === 0 && !loading"
      @click="clearInputs"
      class="mr-4 flex w-full cursor-pointer justify-end text-2xs font-medium text-slate-600 opacity-50 hover:opacity-100 dark:text-jovieDark-300">
      Clear
    </div>
  </div>
</template>

<script>
import JovieSpinner from '@/components/JovieSpinner';
export default {
  components: {
    JovieSpinner,
  },
  props: {
    otpCode: {
      type: String,
      required: true,
    },
    loading: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      code: ['', '', '', '', '', ''],
    };
  },
  methods: {
    focusNextInput(event) {
      const input = event.target;
      const nextInput = input.nextElementSibling;
      if (input.value && nextInput) {
        nextInput.focus();
      }
    },
    clearInputs() {
      this.code = ['', '', '', '', '', ''];
    },
    async checkComplete(event) {
        if (event.type === 'paste') {
            // Get the pasted OTP code from the clipboard
            let otpCode = await navigator.clipboard.readText();

            // Make sure the pasted OTP code is 6 digits and contains only digits
            otpCode = otpCode.slice(0, 6);
            otpCode = otpCode.replace(/\D/g, '');

            // Update the code array with the pasted OTP code if the pasted OTP code is valid
            if (otpCode.length === 6) {
                this.code = otpCode.split('');
            } else {
                // Reset the code array if the pasted OTP code is invalid
                this.code = ['', '', '', '', '', ''];
            }
        } else {
            this.focusNextInput(event);
        }

        if (this.code.every((digit) => digit !== '')) {
            this.$emit('update:modelValue', this.code.join(''))
            this.$emit('complete', this.code.join(''));
        }
    },
    async checkClipboard(event) {
        // Check if the clipboard contains a valid OTP code
        let otpCode = await navigator.clipboard.readText();
        otpCode = otpCode.slice(0, 6);
        otpCode = otpCode.replace(/\D/g, '');

        if (otpCode.length === 6) {
            // Paste the OTP code into the input element
            if (document.queryCommandSupported('insertText')) {
                // Insert the OTP code with the insertText command
                document.execCommand('insertText', false, otpCode);
            } else if (document.queryCommandSupported('paste')) {
                // Insert the OTP code with the paste command
                document.execCommand('paste', false, otpCode);
            }
        } else {
            // Prevent the default paste behavior
            event.preventDefault();
        }
    },
  },
};
</script>
