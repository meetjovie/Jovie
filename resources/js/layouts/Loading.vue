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
            href="https://twitter.com/intent/tweet?text=Yo%20%40itstimwhite%20please%20help%21%20%40meetjovie%20is%20realllllllllllly%20slow%20today.%20not%20cool%20man%21%20&original_referer=https://clicktotweet.com&related=tweetdripapp"
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
      //set loadingText to Loading your dashboard...
      //after 2 seconds change it to Loading your profile...
      //after 4 seconds change it to Loading your settings...
      //after 6 seconds change it to Loading your notifications...
      //after 8 seconds change it to Loading dock appears to be backedup...
      //after 10 seconds change it to Loading dock appears to be backedup...
      this.loadingText = 'Loading your dashboard...';
      setTimeout(() => {
        this.loadingText = 'Loading your profile...';
      }, 2000);
      setTimeout(() => {
        this.loadingText = 'Loading your settings...';
      }, 4000);
      setTimeout(() => {
        this.loadingText = 'Loading your notifications...';
      }, 6000);
      setTimeout(() => {
        this.loadingText = 'Loading dock appears to be backed up...';
      }, 8000);
      setTimeout(() => {
        this.loadingText = 'Uhhh... I am stuck...';
      }, 10000);
      setTimeout(() => {
        this.loadingText = 'LA traffic, am I right?';
      }, 12000);
      setTimeout(() => {
        this.loadingText = 'Okay, do you have dial up or something...';
      }, 14000);
      setTimeout(() => {
        this.loadingText = 'I am going to take a nap...';
      }, 16000);
      setTimeout(() => {
        this.loadingText = 'Maybe hit refresh? ...or put on a movie...';
      }, 18000);
      setTimeout(() => {
        this.link = true;
        this.loadingText = 'Time to complain on twitter...';
      }, 20000);
    },
  },
};
</script>
