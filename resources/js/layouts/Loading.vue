<template>
  <div
    class="flex h-screen w-full items-center bg-slate-100 dark:bg-black"
    id="app">
    <router-view />
    <aside class="h-screen w-60 bg-white dark:bg-slate-900"></aside>
    <div class="mx-auto flex h-screen items-center text-center dark:bg-black">
      <div></div>
      <div class="mx-auto flex w-full items-center text-center">
        <JovieSpinner class="mr-2" />

        <h1 v-if="!link" class="py-4 text-slate-700 dark:text-white">
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
      loadingText: 'Hi, I am loading...',
      link: false,
      messages: [
        { id: 1, text: 'Loading your dashboard...' },
        { id: 2, text: 'Loading your profile...' },
        { id: 3, text: 'Loading your settings...' },
        { id: 4, text: 'Loading your notifications...' },
        { id: 5, text: 'Loading dock appears to be backed up...' },
        { id: 6, text: 'Uhhh... I am stuck...' },
        { id: 7, text: 'LA traffic, am I right?' },
        { id: 8, text: 'Okay, do you have dial up or something...' },
        { id: 9, text: 'I am going to take a nap...' },
        { id: 10, text: 'Maybe hit refresh? ...or put on a movie...' },
        { id: 11, text: 'Time to complain on twitter...' },
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
      if (document.documentElement.classList.contains('dark')) {
        localStorage.theme = 'dark';
      } else {
        localStorage.theme = 'light';
      }
      //check for darkmode
    },
    setLoadingText() {
      //loop through the messagess
      let i = 0;
      setInterval(() => {
        if (i < this.messages.length) {
          this.loadingText = this.messages[i].text;
          i++;
        } else {
          i = 0;
        }
      }, 3000);
    },
  },
};
</script>
