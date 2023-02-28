<template>
  <div
    class="flex h-screen w-full items-center bg-slate-100 dark:bg-jovieDark-900"
    id="app">
    <router-view />
    <!-- <aside class="hidden h-screen w-60 lg:block"></aside> -->
    <div class="mx-auto flex h-screen items-center text-center">
      <div class="mx-auto flex w-full flex-col items-center text-center">
        <div
          class="mx-auto origin-center scale-95 transform flex-col py-6 transition-all duration-300 ease-in-out">
          <TransitionRoot appear :show="isShowing">
            <TransitionChild
              as="template"
              enter="transform transition duration-1000"
              enter-from="opacity-0 scale-150"
              enter-to="opacity-100 scale-100"
              leave="transform duration-200 transition ease-in-out"
              leave-from="opacity-100 rotate-0 scale-100 "
              leave-to="opacity-0
              scale-95 "
              hide="opacity-0">
              <JovieLogo
                :color="darkMode ? '#ffffff' : '#000000'"
                height="48px" />
            </TransitionChild>
            <TransitionChild
              as="div"
              enter="transform transition  delay-300 duration-1000"
              enter-from="opacity-0 scale-0"
              enter-to="opacity-100 scale-100"
              leave="transform duration-700 transition ease-in-out"
              leave-from="opacity-100 rotate-0 scale-100 "
              leave-to="opacity-0 scale-0 "
              hide="opacity-0">
              <div
                class="animation-pulse via-idnigo-700 mt-1 h-0.5 w-full rounded-md bg-gradient-to-r from-transparent to-transparent dark:via-white"></div>
            </TransitionChild>
          </TransitionRoot>
        </div>

        <h1
          v-if="!link"
          :class="[
            {
              ' decoartion-2 decoration-slate-400 decoration-solid dark:decoration-jovieDark-border':
                link,
            },
          ]"
          class="mt-4 py-2 text-xs font-semibold text-slate-700 dark:text-slate-200">
          {{ loadingText }}
        </h1>
        <h1
          v-else
          class="fon-semibold py-2 text-xs text-slate-700 dark:text-slate-200">
          <a
            href="https://twitter.com/intent/tweet?text=Yo%20%40itstimwhite%20please%20help%21%20%40meetjovie%20is%20realllllllllllly%20slow%20today.%20not%20cool%20man%21%20&original_referer=https://jov.ie"
            target="_blank"
            rel="noopener noreferrer">
            {{ loadingText }}
          </a>
        </h1>
      </div>
    </div>
  </div>
</template>

<script>
import JovieLogo from './../components/JovieLogo.vue';
import { TransitionRoot, TransitionChild } from '@headlessui/vue';
export default {
  name: 'Loading',
  components: {
    JovieLogo,
    TransitionRoot,
    TransitionChild,
  },
  data() {
    return {
      loadingText: 'Initializing...',
      darkMode: false,
      isShowing: true,

      link: false,
      messages: [
        { id: 1, text: 'Loading your dashboard...' },
        { id: 2, text: 'Loading your profile...' },
        { id: 3, text: 'Loading your settings...' },
        { id: 4, text: 'Loading your notifications...' },
        { id: 5, text: 'Loading dock appears to be backed up...' },
        { id: 6, text: 'This is taking longer than expected...' },
        { id: 7, text: 'LA traffic, am I right?' },
        { id: 8, text: 'Okay, do you have dial up or something...' },
        { id: 9, text: 'I am going to take a nap...' },
        { id: 10, text: 'Maybe hit refresh? ...or put on a movie...' },
      ],
    };
  },
  mounted() {
    console.log('mounted');
    //check for darkmode
    this.setTheme();

    //check for darkmode
    this.setLoadingText();
  },

  methods: {
    setTheme() {
      if (
        localStorage.theme === 'dark' ||
        (!('theme' in localStorage) &&
          window.matchMedia('(prefers-color-scheme: dark)').matches)
      ) {
        document.documentElement.classList.add('dark');
        this.darkMode = true;
      } else {
        document.documentElement.classList.remove('dark');
      }
    },
    checkForExtension() {
      if (document.body.dataset.jovieExtensionInstalled === 'true') {
        this.$store.commit('chromeExtensionInstalled', true);
      }
    },
    setLoadingText() {
      //loop through the messagess
      //stop at the last message
      let i = 0;
      let interval = setInterval(() => {
        if (i < this.messages.length) {
          this.loadingText = this.messages[i].text;
          i++;
        } else {
          this.link = true;
          this.loadingText = 'Time to complain on twitter...';
          clearInterval(interval);
        }
      }, 8000);
    },
  },
};
</script>
