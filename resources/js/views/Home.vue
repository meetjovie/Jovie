<template>
  <div>
    <main>
      <HomeHeroSection />

      <!-- <div class="bg-white">
        <div
          class="mx-auto flex max-w-7xl items-center px-4 py-6 sm:px-6 lg:px-8">
          <div
            class="items-center text-center text-xs font-bold tracking-wide text-slate-400">
            Trusted by teams at:
          </div>
          <div class="grid grid-cols-2 gap-8 md:grid-cols-6 lg:grid-cols-5">
            <div
              class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
              <img
                class="h-12"
                src="https://tailwindui.com/img/logos/tuple-logo-slate-400.svg"
                alt="Tuple" />
            </div>
            <div
              class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
              <img
                class="h-12"
                src="https://tailwindui.com/img/logos/mirage-logo-slate-400.svg"
                alt="Mirage" />
            </div>
            <div
              class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
              <img
                class="h-12"
                src="https://tailwindui.com/img/logos/statickit-logo-slate-400.svg"
                alt="StaticKit" />
            </div>
            <div
              class="col-span-1 flex justify-center md:col-span-3 lg:col-span-1">
              <img
                class="h-12"
                src="https://tailwindui.com/img/logos/transistor-logo-slate-400.svg"
                alt="Transistor" />
            </div>
            <div
              class="col-span-2 flex justify-center md:col-span-3 lg:col-span-1">
              <img
                class="h-12"
                src="https://tailwindui.com/img/logos/workcation-logo-slate-400.svg"
                alt="Workcation" />
            </div>
          </div>
        </div>
      </div> -->
      <section class="isolate items-center overflow-clip bg-indigo-100">
        <div class="absolute left-0 -z-10 opacity-30">
          <svg
            width="484"
            height="610"
            viewBox="0 0 484 610"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M-303.956 -305.546L-173.673 243.44L-237.221 -317.436L-166.95 242.59L-169.671 -322.505L-160.182 242.427L-102.048 -320.696L-153.444 242.952L-35.0908 -312.03L-146.809 244.158L30.466 -296.601L-140.35 246.033L93.9044 -274.579L-134.139 248.556L154.529 -246.205L-128.242 251.7L211.677 -211.79L-122.725 255.43L264.72 -171.711L-117.648 259.705L313.079 -126.406L-113.066 264.479L356.222 -76.3731L-109.031 269.698L393.678 -22.1594L-105.585 275.306L425.037 35.6408L-102.768 281.242L449.953 96.3943L-100.609 287.44L468.156 159.435L-99.1323 293.833L479.444 224.073L-98.3543 300.35L483.696 289.6L-98.2832 306.921L480.862 355.298L-98.9201 313.472L470.976 420.447L-100.258 319.932L454.146 484.332L-102.282 326.232L430.554 546.256L-104.97 332.3L400.461 605.538L-108.292 338.072L364.196 661.529L-112.213 343.483L322.156 713.617L-116.689 348.475L274.801 761.229L-121.671 352.993L222.651 803.845L-127.104 356.986L166.278 840.998L-132.93 360.413L106.297 872.281L-139.084 363.234L43.3678 897.35L-145.499 365.42L-21.8215 915.931L-152.104 366.946L-88.5564 927.821L-158.827 367.795L-156.106 932.89L-165.595 367.958L-223.729 931.081L-172.333 367.433L-290.686 922.415L-178.968 366.227L-356.243 906.986L-185.427 364.352L-419.682 884.965L-191.638 361.829L-480.306 856.59L-197.535 358.685L-537.454 822.175L-203.052 354.955L-590.497 782.096L-208.129 350.68L-638.856 736.791L-212.711 345.907L-681.999 686.758L-216.746 340.687L-719.455 632.545L-220.192 335.079L-750.814 574.744L-223.009 329.143L-775.73 513.991L-225.168 322.945L-793.933 450.95L-226.645 316.552L-805.222 386.312L-227.423 310.035L-809.473 320.785L-227.494 303.465L-806.64 255.087L-226.857 296.913L-796.753 189.939L-225.519 290.453L-779.923 126.053L-223.495 284.154L-756.331 64.1294L-220.808 278.085L-726.238 4.84733L-217.485 272.313L-689.973 -51.1441L-213.564 266.902L-647.933 -103.231L-209.089 261.91L-600.578 -150.844L-204.107 257.393L-548.429 -193.46L-198.673 253.399L-492.055 -230.613L-192.847 249.972L-432.074 -261.895L-186.693 247.151L-369.145 -286.965L-180.279 244.965L-303.956 -305.546Z"
              fill="#B4AFF8" />
          </svg>
        </div>

        <div class="z-20 mx-auto max-w-7xl items-center px-2 py-12">
          <div class="flex flex-col items-center justify-between sm:flex-row">
            <div class="">
              <p class="max-w-xl text-4xl font-semibold leading-10">
                <span class="text-purple-600">Instantly </span> import contacts
                from social media
              </p>
            </div>
            <div class="justify-end">
              <img
                class="h-[300px]"
                :src="
                  asset(
                    'img/External/Marketing/Jovie_Social_CRM_Import_Example.svg'
                  )
                "
                alt="Jovie Social CRM Import Example" />
            </div>
          </div>
          <div>
            <div class="mt-8 items-center border-t border-white">
              <div class="mx-auto flex flex-col py-12 text-center sm:flex-row">
                <h3 class="text-md font-bold text-slate-900 sm:text-xl">
                  Jovie replaces complicated tools & manual workflows
                </h3>
                <div class="mx-auto flex items-center space-x-8 opacity-30">
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>HubSpot</title>
                      <path
                        d="M18.164 7.93V5.084a2.198 2.198 0 001.267-1.978v-.067A2.2 2.2 0 0017.238.845h-.067a2.2 2.2 0 00-2.193 2.193v.067a2.196 2.196 0 001.252 1.973l.013.006v2.852a6.22 6.22 0 00-2.969 1.31l.012-.01-7.828-6.095A2.497 2.497 0 104.3 4.656l-.012.006 7.697 5.991a6.176 6.176 0 00-1.038 3.446c0 1.343.425 2.588 1.147 3.607l-.013-.02-2.342 2.343a1.968 1.968 0 00-.58-.095h-.002a2.033 2.033 0 102.033 2.033 1.978 1.978 0 00-.1-.595l.005.014 2.317-2.317a6.247 6.247 0 104.782-11.134l-.036-.005zm-.964 9.378a3.206 3.206 0 113.215-3.207v.002a3.206 3.206 0 01-3.207 3.207z" />
                    </svg>
                  </div>

                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>Notion</title>
                      <path
                        d="M4.459 4.208c.746.606 1.026.56 2.428.466l13.215-.793c.28 0 .047-.28-.046-.326L17.86 1.968c-.42-.326-.981-.7-2.055-.607L3.01 2.295c-.466.046-.56.28-.374.466zm.793 3.08v13.904c0 .747.373 1.027 1.214.98l14.523-.84c.841-.046.935-.56.935-1.167V6.354c0-.606-.233-.933-.748-.887l-15.177.887c-.56.047-.747.327-.747.933zm14.337.745c.093.42 0 .84-.42.888l-.7.14v10.264c-.608.327-1.168.514-1.635.514-.748 0-.935-.234-1.495-.933l-4.577-7.186v6.952L12.21 19s0 .84-1.168.84l-3.222.186c-.093-.186 0-.653.327-.746l.84-.233V9.854L7.822 9.76c-.094-.42.14-1.026.793-1.073l3.456-.233 4.764 7.279v-6.44l-1.215-.139c-.093-.514.28-.887.747-.933zM1.936 1.035l13.31-.98c1.634-.14 2.055-.047 3.082.7l4.249 2.986c.7.513.934.653.934 1.213v16.378c0 1.026-.373 1.634-1.68 1.726l-15.458.934c-.98.047-1.448-.093-1.962-.747l-3.129-4.06c-.56-.747-.793-1.306-.793-1.96V2.667c0-.839.374-1.54 1.447-1.632z" />
                    </svg>
                  </div>
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>Adobe Acrobat Reader</title>
                      <path
                        d="M23.63 15.3c-.71-.745-2.166-1.17-4.224-1.17-1.1 0-2.377.106-3.761.354a19.443 19.443 0 0 1-2.307-2.661c-.532-.71-.994-1.49-1.42-2.236.817-2.484 1.207-4.507 1.207-5.962 0-1.632-.603-3.336-2.342-3.336-.532 0-1.065.32-1.349.781-.78 1.384-.425 4.4.923 7.381a60.277 60.277 0 0 1-1.703 4.507c-.568 1.349-1.207 2.733-1.917 4.01C2.834 18.53.314 20.34.03 21.758c-.106.533.071 1.03.462 1.42.142.107.639.533 1.49.533 2.59 0 5.323-4.188 6.707-6.707 1.065-.355 2.13-.71 3.194-.994a34.963 34.963 0 0 1 3.407-.745c2.732 2.448 5.145 2.839 6.352 2.839 1.49 0 2.023-.604 2.2-1.1.32-.64.106-1.349-.213-1.704zm-1.42 1.03c-.107.532-.64.887-1.384.887-.213 0-.39-.036-.604-.071-1.348-.32-2.626-.994-3.903-2.059a17.717 17.717 0 0 1 2.98-.248c.746 0 1.385.035 1.81.142.497.106 1.278.426 1.1 1.348zm-7.524-1.668a38.01 38.01 0 0 0-2.945.674 39.68 39.68 0 0 0-2.52.745 40.05 40.05 0 0 0 1.207-2.555c.426-.994.78-2.023 1.136-2.981.354.603.745 1.207 1.135 1.739a50.127 50.127 0 0 0 1.987 2.378zM10.038 1.46a.768.768 0 0 1 .674-.425c.745 0 .887.851.887 1.526 0 1.135-.355 2.874-.958 4.861-1.03-2.768-1.1-5.074-.603-5.962zM6.134 17.997c-1.81 2.981-3.549 4.826-4.613 4.826a.872.872 0 0 1-.532-.177c-.213-.213-.32-.461-.249-.745.213-1.065 2.271-2.555 5.394-3.904Z" />
                    </svg>
                  </div>
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>Salesforce</title>
                      <path
                        d="M10.006 5.415a4.195 4.195 0 013.045-1.306c1.56 0 2.954.9 3.69 2.205.63-.3 1.35-.45 2.1-.45 2.85 0 5.159 2.34 5.159 5.22s-2.31 5.22-5.176 5.22c-.345 0-.69-.044-1.02-.104a3.75 3.75 0 01-3.3 1.95c-.6 0-1.155-.15-1.65-.375A4.314 4.314 0 018.88 20.4a4.302 4.302 0 01-4.05-2.82c-.27.062-.54.076-.825.076-2.204 0-4.005-1.8-4.005-4.05 0-1.5.811-2.805 2.01-3.51-.255-.57-.39-1.2-.39-1.846 0-2.58 2.1-4.65 4.65-4.65 1.53 0 2.85.705 3.72 1.8" />
                    </svg>
                  </div>
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>Microsoft Excel</title>
                      <path
                        d="M23 1.5q.41 0 .7.3.3.29.3.7v19q0 .41-.3.7-.29.3-.7.3H7q-.41 0-.7-.3-.3-.29-.3-.7V18H1q-.41 0-.7-.3-.3-.29-.3-.7V7q0-.41.3-.7Q.58 6 1 6h5V2.5q0-.41.3-.7.29-.3.7-.3zM6 13.28l1.42 2.66h2.14l-2.38-3.87 2.34-3.8H7.46l-1.3 2.4-.05.08-.04.09-.64-1.28-.66-1.29H2.59l2.27 3.82-2.48 3.85h2.16zM14.25 21v-3H7.5v3zm0-4.5v-3.75H12v3.75zm0-5.25V7.5H12v3.75zm0-5.25V3H7.5v3zm8.25 15v-3h-6.75v3zm0-4.5v-3.75h-6.75v3.75zm0-5.25V7.5h-6.75v3.75zm0-5.25V3h-6.75v3Z" />
                    </svg>
                  </div>
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>Google Sheets</title>
                      <path
                        d="M11.318 12.545H7.91v-1.909h3.41v1.91zM14.728 0v6h6l-6-6zm1.363 10.636h-3.41v1.91h3.41v-1.91zm0 3.273h-3.41v1.91h3.41v-1.91zM20.727 6.5v15.864c0 .904-.732 1.636-1.636 1.636H4.909a1.636 1.636 0 0 1-1.636-1.636V1.636C3.273.732 4.005 0 4.909 0h9.318v6.5h6.5zm-3.273 2.773H6.545v7.909h10.91v-7.91zm-6.136 4.636H7.91v1.91h3.41v-1.91z" />
                    </svg>
                  </div>
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>DocuSign</title>
                      <path
                        d="M9.517 3.31h4.966v6.621h3.31L12 16.552 6.207 9.931h3.31V3.31zM0 19.034h24v1.655H0v-1.655z" />
                    </svg>
                  </div>
                  <div class="mx-auto w-5">
                    <svg
                      role="img"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <title>Airtable</title>
                      <path
                        d="M11.992 1.966c-.434 0-.87.086-1.28.257L1.779 5.917c-.503.208-.49.908.012 1.116l8.982 3.558a3.266 3.266 0 0 0 2.454 0l8.982-3.558c.503-.196.503-.908.012-1.116l-8.957-3.694a3.255 3.255 0 0 0-1.272-.257zM23.4 8.056a.589.589 0 0 0-.222.045l-10.012 3.877a.612.612 0 0 0-.38.564v8.896a.6.6 0 0 0 .821.552L23.62 18.1a.583.583 0 0 0 .38-.551V8.653a.6.6 0 0 0-.6-.596zM.676 8.095a.644.644 0 0 0-.48.19C.086 8.396 0 8.53 0 8.69v8.355c0 .442.515.737.908.54l6.27-3.006.307-.147 2.969-1.436c.466-.22.43-.908-.061-1.092L.883 8.138a.57.57 0 0 0-.207-.044z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="isolate mx-auto">
        <div
          class="mx-auto h-60 overflow-hidden bg-indigo-400 px-4 dark:bg-indigo-600 sm:h-72 md:px-8">
          <div
            class="mx-auto -mt-24 h-[400px] w-[400px] rounded-full bg-gradient-to-b from-indigo-500 via-purple-500/0 to-purple-500/0 sm:h-[500px] sm:w-[500px] lg:h-[1000px] lg:w-[1000px]">
            <div class="mx-auto max-w-7xl items-center p-8 sm:p-10 lg:p-14">
              <p
                class="mb-12 mt-24 text-center text-xl font-bold text-white sm:text-2xl lg:text-3xl">
                One space for everyone you follow
              </p>
              <div
                class="mx-auto flex h-14 max-w-3xl flex-wrap items-center justify-between">
                <div v-for="icon in icons" :key="icon.id">
                  <div
                    class="relative block h-16 w-16 items-center overflow-hidden">
                    <div
                      class="relative z-20 mx-auto h-full items-center p-1"
                      :class="[
                        { 'text-social-instagram': icon.name == 'instagram' },
                        { 'text-social-twitter': icon.name == 'twitter' },

                        { 'text-social-facebook': icon.name == 'facebook' },
                        { 'text-social-linkedin': icon.name == 'linkedin' },
                        { 'text-social-youtube': icon.name == 'youtube' },
                        { 'text-social-tiktok': icon.name == 'tiktok' },
                        { 'text-social-twitch': icon.name == 'twitch' },
                      ]">
                      <SocialIcons
                        class="z-20 mx-auto mt-4"
                        :color="icon.name"
                        link="#"
                        :icon="icon.name"
                        height="24px" />
                    </div>
                    <svg
                      viewBox="0 0 64 64"
                      class="absolute top-0 h-full w-full text-white dark:text-jovieDark-700">
                      <circle
                        cx="32"
                        cy="32"
                        r="32"
                        fill="currentColor"></circle>
                    </svg>
                  </div>
                </div>
                <div class="hidden lg:flex">
                  <svg width="180" height="55" viewBox="0 0 180 55" fill="none">
                    <path
                      d="M177.664 43.916C179.077 42.5378 175.599 32.2257 175.309 31.8117M175.309 31.8117C175.061 31.4577 169.561 32.8439 165.328 35.8092M175.309 31.8117C168.61 53.0922 144.697 55.3061 128.339 51.4479C98.5444 44.4204 103.725 13.1508 67.3946 4.00585C35.4373 -1.47524 15.3433 3.95857 2 24.2465"
                      stroke="#FFD058"
                      stroke-width="4"
                      stroke-miterlimit="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>

                  <a
                    class="active:outline-3 -ml-1text-md hover:border-coral-500 hover:text-coral-500 group -mt-1 box-border inline-flex h-10 cursor-pointer items-center justify-center whitespace-nowrap rounded-full bg-white px-4 font-sans font-medium text-black outline-offset-2 transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-blue-700 active:bg-white active:bg-opacity-5 disabled:cursor-not-allowed disabled:border-slate-700 disabled:bg-transparent disabled:text-slate-700 dark:bg-jovieDark-700 md:h-12 md:text-lg"
                    href="https://jov.ie/signup"
                    ><JovieLogo height="20px" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="bg-indigo-50 dark:bg-jovieDark-900">
        <HomeFeatureCRM :features="features" class="" id="crm"></HomeFeatureCRM>
      </section>

      <!--  <HomeFeatureHero></HomeFeatureHero> -->
      <!--  <HomeFeatureSequences></HomeFeatureSequences> -->

      <!--  <HomeCTA></HomeCTA> -->
      <section class="mx-auto py-24">
        <div
          class="mx-auto flex max-w-5xl flex-col justify-between overflow-hidden rounded-3xl border-2 border-fuchsia-600 dark:bg-white md:h-80 md:flex-row">
          <div class="w-full px-8 py-8 md:w-1/3">
            <div
              class="text-xl font-bold text-slate-700 dark:text-jovieDark-300">
              <span class="text-pink-500">Add</span> the Jovie Chrome<br />
              Extension today.
            </div>
            <div class="text-sm font-semibold text-slate-500">
              Save, enrich, & organize contacts from any social media profile.
            </div>
            <router-link
              to="/chrome-extension"
              class="group mt-8 flex cursor-pointer rounded-md bg-gradient-to-r from-indigo-500 via-indigo-600 to-purple-500 text-center shadow-xl shadow-pink-500/20 hover:shadow-pink-500/30">
              <div class="flex w-full items-center justify-between px-4 py-4">
                <div
                  class="w-full transform text-left text-xs font-medium text-white transition-transform duration-300 ease-in-out group-hover:underline">
                  Download Chrome Extension
                </div>
                <svg
                  role="img"
                  class="h-5 w-5 transform transition-transform duration-300 ease-in-out group-hover:rotate-180"
                  fill="white"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <title>Google Chrome</title>
                  <path
                    d="M12 0C8.21 0 4.831 1.757 2.632 4.501l3.953 6.848A5.454 5.454 0 0 1 12 6.545h10.691A12 12 0 0 0 12 0zM1.931 5.47A11.943 11.943 0 0 0 0 12c0 6.012 4.42 10.991 10.189 11.864l3.953-6.847a5.45 5.45 0 0 1-6.865-2.29zm13.342 2.166a5.446 5.446 0 0 1 1.45 7.09l.002.001h-.002l-5.344 9.257c.206.01.413.016.621.016 6.627 0 12-5.373 12-12 0-1.54-.29-3.011-.818-4.364zM12 16.364a4.364 4.364 0 1 1 0-8.728 4.364 4.364 0 0 1 0 8.728Z" />
                </svg>
              </div>
            </router-link>
          </div>
          <div class="items-bottom justify-end rounded-3xl">
            <img
              class="right-0 rounded-3xl"
              :src="asset('img/External/Marketing/jovie_5-star_rating.webp')"
              alt="" />
          </div>
        </div>
      </section>
      <!--  <HomeTestimonials></HomeTestimonials> -->
      <HomeCTA4></HomeCTA4>
    </main>
  </div>
</template>

<style></style>
<script>
import {
  InboxIcon,
  PencilIcon,
  TrashIcon,
  UsersIcon,
} from '@heroicons/vue/24/outline';
import JovieReplaces from '../components/External/JovieReplaces.vue';
import UserService from '../services/api/user.service';
import HomeLogoCloud from '../components/Home/HomeLogoCloud.vue';
import HomeFeatureSequences from '../components/Home/HomeFeatureSequences.vue';
import HomeFeatureDiscovery from '../components/Home/HomeFeatureDiscovery.vue';
import HomeHeroSection from '../components/Home/HomeHeroSection.vue';

import HomeCTA4 from '../components/Home/HomeCTA4.vue';
import HomeFeatureCRM from '../components/Home/HomeFeatureCRM.vue';
import HomeCreatorSearch from '../components/Home/HomeCreatorSearch.vue';
import Enrichment from '../components/Enrichment.vue';
import SocialIcons from '../components/SocialIcons.vue';
import JovieLogo from '../components/JovieLogo.vue';

import CallToAction from '../components/CallToAction.vue';

export default {
  name: 'Home',
  components: {
    HomeLogoCloud,
    JovieLogo,
    HomeFeatureSequences,
    HomeCreatorSearch,
    HomeFeatureDiscovery,
    Enrichment,
    HomeHeroSection,
    HomeCTA: () => import('@/components/Home/HomeCTA.vue'),
    ButtonGroup: () => import('@/components/ButtonGroup.vue'),
    HomeTestimonials: () => import('@/components/Home/HomeTestimonials.vue'),
    CallToAction,
    HomeCTA4,
    HomeFeatureCRM,
    JovieReplaces: () => import('@/components/External/JovieReplaces.vue'),
    SocialIcons,
  },
  data() {
    return {
      waitListEmail: '',
      error: null,
      loading: false,
      icons: [
        {
          id: 1,
          name: 'twitter',
          fillColor: '#1DA1F2',
        },
        {
          id: 2,
          name: 'twitch',
          fillColor: '#9146FF',
        },
        {
          id: 3,
          name: 'youtube',
          fillColor: '#FF0000',
        },
        {
          id: 4,
          name: 'instagram',
          fillColor: '#E1306C',
        },
        {
          id: 5,
          name: 'tiktok',
          fillColor: '#000000',
        },
      ],
      features: [
        {
          id: 1,
          header: 'Save Contacts from any Social Media Profile',
          subheader:
            ' Never type contact info again.  Jovie let’s you import any Tiktok, Twitter, Instagram, or Twitch profile instantly.',
          cta: 'Download Chrome Extension',
          ctaLink:
            'https://chrome.google.com/webstore/detail/jovie-the-social-crm/daeopelnocmnhbkjbjmhckgjgheioafj',
          img: 'img/External/Marketing/Chrome/Jovie_Chrome_Extension_Screenshot.png',
        },
        {
          id: 2,
          header: 'Organize everyone in one place',
          subheader:
            'Jovie works like the tools you love, letting you create lists and drag-n-drop contacts right into them. Leave notes for yourself or comments to share with your team.',
          img: 'img/External/Marketing/Chrome/Jovie_Lists_Screenshot.png',
        },
        {
          id: 3,
          header: 'Enrich contacts automatically',
          subheader:
            'No more manual data entry. No more incomplete records. Save a contact on instagram? Don’t worry, we have their twitter profile too. Jovie automatically enriches contacts with all their social media profiles & more.',
          img: 'img/External/Marketing/Chrome/Jovie_Enrichment_Screenshot.png',
          cta: 'Try Jovie free',

          ctaLink: 'https://jov.ie/signup',
        },
      ],
    };
  },
  mounted() {
    window.analytics.page('Home');
  },
  methods: {
    login() {
      // login();
    },
    logout() {
      // logout();
    },
    async identifyUser() {
      //segment identify call
      window.analytics.identify({
        email: this.waitListEmail,
      });
      //segment track call
      window.analytics.track('Initated Sign Up');
    },
    async requestDemo() {
      this.loading = true;

      await UserService.addToWaitList({
        email: this.waitListEmail,
        page: 'Home',
      })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAddedToWaitList');
            this.waitListEmail = '';
            this.error = null;
            this.$router.push('signup');
          }
        })
        .catch((error) => {
          error = error.response;
          this.loading = false;
          if (error.status == 422) {
            this.error = error.data.errors.email[0];
          }
        });
    },
  },
};
</script>
