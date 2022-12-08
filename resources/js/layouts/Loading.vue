<template>
  <div
    class="flex h-screen w-full items-center bg-slate-100 dark:bg-black"
    id="app">
    <router-view />
    <aside class="w-60lg:block hidden h-screen"></aside>
    <div class="mx-auto flex h-screen items-center text-center dark:bg-black">
      <div></div>
      <div
        class="mx-auto flex w-full flex-col items-center text-center sm:flex-row">
        <JovieSpinner class="mr-2" />

        <h1
          v-if="!link"
          :class="[
            {
              ' decoartion-2 decoration-slate-400 decoration-solid dark:decoration-slate-700':
                link,
            },
          ]"
          class="py-4 text-slate-700 dark:text-white">
          {{ loadingText }}
        </h1>
        <h1 v-else class="py-4 text-slate-700 dark:text-white">
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
import JovieSpinner from './../components/JovieSpinner.vue';
export default {
  name: 'Loading',
  components: {
    JovieSpinner,
  },
  data() {
    return {
      loadingText: 'Jovie is loading...',

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
