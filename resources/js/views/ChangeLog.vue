<template>
  <div>
    <Head>
      <title>Jovie Social CRM | Changelog</title>
      <meta
        name="description"
        content="Jovie is always improving. Our changelog contains a record of some of the latest features & improvements the Jovie CRM & Chrome extension." />
    </Head>

    <div class="relative mb-24 overflow-hidden bg-white py-8">
      <div
        class="hidden lg:absolute lg:inset-y-0 lg:block lg:h-full lg:w-full lg:[overflow-anchor:none]">
        <div
          class="relative mx-auto h-full max-w-prose text-lg"
          aria-hidden="true">
          <svg
            class="absolute top-12 left-full translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="74b3fd99-0a6f-4271-bef2-e80eeafdf357"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-slate-200"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
          </svg>
          <svg
            class="absolute top-1/2 right-full -translate-y-1/2 -translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="f210dbf6-a58d-4871-961e-36d5016a0f49"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-slate-200"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
          </svg>
          <svg
            class="absolute bottom-12 left-full translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="d3eb07ae-5182-43e6-857d-35c643af9034"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-slate-200"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
          </svg>
        </div>
      </div>
      <div class="min-h-800 relative px-4 sm:px-6 lg:px-8">
        <div
          class="sticky top-0 mx-auto max-w-prose border-b border-slate-200 text-lg">
          <div class="py-6">
            <h1>
              <span class="block text-lg font-semibold text-indigo-600"
                >What's New:</span
              >
              <span
                class="mt-4 block text-3xl font-bold leading-8 tracking-tight text-slate-900 sm:text-4xl"
                >Jovie Changelog</span
              >
            </h1>
            <p class="mt-8 text-xl leading-8 text-slate-700">
              New updates and improvements to Jovie.
            </p>

            <div class="mt-4 flex space-x-8">
              <a href="https://twitter.com/meetjovie" class="">
                <p
                  class="cursor-pointer text-xs leading-8 text-slate-500 hover:text-indigo-500">
                  Follow us on Twitter.
                </p>
              </a>
              <router-link to="/slack-community" class="">
                <p
                  class="cursor-pointer text-xs leading-8 text-slate-500 hover:text-indigo-500">
                  Join our Slack Community for support and feedback.
                </p>
              </router-link>
            </div>
          </div>
        </div>
        <ul role="list" class="mx-auto max-w-prose divide-y divide-slate-200">
          <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">v0.0.7</p>

              <p>2022.12.04</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                Calendar events, Twitter DMs, Email Validation, and More
              </h2>
              <p class="prose">
                This release includes a number of new features and improvements.
                We've also made it easier for users to request & vote on new
                features. You can see our product roadmap and contribute to it
                <a href="https://roadmap.jov.ie">here</a>.
              </p>

              <h4 class="prose mt-4 font-bold">Features</h4>
              <ul class="prose list-outside list-disc">
                <li class="prose">
                  Added the ability to initate a DM on Twitter with a contact.
                </li>
                <li class="prose">
                  Added the ability to validate email addresses (addressign a
                  user feature request).
                </li>
                <li class="prose">
                  Added the ability to create a new calendar event.
                </li>
              </ul>

              <h4 class="prose mt-4 font-bold">Fixes & Improvements</h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">
                  Fixed an issue rendering styles incorrectly on the sidebar
                  when a user is in dark mode.
                </li>
                <li class="prose">Made the upgrade flow clearer.</li>
                <li class="prose">
                  Upgraded depenendcies to address security vulnerabilities.
                </li>
              </ul>
            </div>
          </li>
          <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">v0.0.6</p>

              <p>2022.12.01</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                Fixes on fixes
              </h2>
              <p class="prose">
                We're working hard to crush bugs & this update covers a lot.
              </p>

              <h4 class="prose mt-4 font-bold">Fixes & Improvements</h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">
                  Fixed a critical issue preventing users from upgrading their
                  accounts in some cases.
                </li>
                <li class="prose">
                  Fixed an issue with images from TikTok not loading in some
                  cases.
                </li>
                <li class="prose">
                  Fixed an issue with images that had been previously imported
                  from Instagram not loading in some cases.
                </li>
                <li class="prose">
                  Fixed an issue with the "Add to Jovie" button not working in
                  some cases.
                </li>
                <li class="prose">
                  Fixed an issue preventing the add to list modal from opening
                  in some cases.
                </li>
                <li class="prose">
                  Improved the performance of the "Add to Jovie" button.
                </li>
                <li class="prose">Improved upgrade screen</li>
                <li class="prose">
                  Fixed an issue with images not saving on the edit profile
                  screen.
                </li>
                <li class="prose">Improved various aspects of the UI.</li>
              </ul>
            </div>
          </li>
          <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">v0.0.5</p>

              <p>2022.11.28</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                Faster loading times, Dark Mode, and more.
              </h2>
              <p class="prose">
                This release focuses on loading the chrome extension faster.
                We've also updated the dashboard with our initial dark mode
                theme, added some important context to various screens including
                loading screens, & improved the functionality of the contact
                sidebar.
              </p>

              <h4
                class="prose mt-4 text-xl font-bold tracking-tight text-slate-800">
                New Features
              </h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">
                  Dark mode. Currently this is enabled by default for all users
                  who have dark mode set at the operating system level. We'll be
                  adding a toggle in the future.
                </li>
                <li class="prose">Improved load times.</li>
                <li class="prose">
                  Improved performance of list managment from the chrome
                  extension. Lists should now update instantly when adding from
                  a third party site.
                </li>
              </ul>

              <h4 class="prose mt-4 font-bold">Fixes & Improvements</h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">
                  We've added sample contacts to new accounts to make it easier
                  to get started.
                </li>
                <li class="prose">General code refactors</li>
                <li class="prose">
                  Fixed a bug that prevented certain users from saving notes
                  when using the Chrome Extension
                </li>
                <li class="prose">
                  Fixes an issue with images from Twitter not displaying
                  correctly in some cases.
                </li>
                <li class="prose">
                  Fixes an issue with images not displaying in the CRM in some
                  cases.
                </li>
                <li class="prose">
                  Fixes an issue with pagination not working properly on the CRM
                  in some cases.
                </li>
                <li class="prose">Improved loading screens on first visit</li>
                <li class="prose">
                  Fixed a bug in a new unreleased API endpoint
                </li>
                <li class="prose">
                  Add instructions for contacts not saved already
                </li>

                <li class="prose">Fixed various bugs & improved performance</li>
              </ul>
            </div>
          </li>
          <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">v0.0.4</p>
              <p>2022.11.25</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                Chrome Extension, List Managment, & Bug Fixes
              </h2>
              <p class="prose">
                This release adds search to dropdown menus, making it much
                easier to add a contact to a list when you have a large number
                of lists. We've alo brough all the functionality of the contact
                sidebar to the chrome extension so you can add social media
                profiles to lists, modify their contact information, or leave a
                note, without leaving their social profile.
              </p>

              <h4
                class="prose mt-4 text-xl font-bold tracking-tight text-slate-800">
                New Features
              </h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">
                  Added the ability to add contacts to lists from a social media
                  page.
                </li>
                <li class="prose">
                  Added the ability to search for lists in the dropdown menu.
                </li>
                <li class="prose">
                  Added the ability to add a note to a contact from a social
                  media page.
                </li>
                <li class="prose">
                  Added the ability to modify a contact's information from a
                  social media page.
                </li>
              </ul>

              <h4 class="prose mt-4 font-bold">Fixes & Improvements</h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">Removed redudant navigation elements</li>

                <li class="prose">Conformed settings page to new design</li>
                <li class="prose">Added search to dropdown menus</li>
                <li class="prose">Added breadcrumbs to sidebar</li>
                <li class="prose">
                  Chrome extension now has all the functionality of the CRM
                  sidebar
                </li>
                <li class="prose">Fixed various bugs & improved performance</li>
              </ul>
            </div>
          </li>
          <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">v0.0.3</p>
              <p>2022.11.19</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                Improved UI & Performance
              </h2>
              <p class="prose">
                This release focuses on improving the UI and performance of the
                CRM. We've made it easier to navigate between contacts &
                addressed various issues related to import speed and
                performance.
              </p>

              <h4
                class="prose mt-4 text-xl font-bold tracking-tight text-slate-800">
                New Features
              </h4>

              <ul class="prose list-outside list-disc">
                <li class="prose">
                  Added the ability to search & update stages on contacts via
                  keyboard navigation
                </li>
                <li class="prose">
                  Added the ability to search for additonal columns to show/hide
                  in the contacts table
                </li>
                <li class="prose">
                  When adding a user from Twitter, if they have an additional
                  social profile in their bio, Jovie now imports it
                  automatically
                </li>
              </ul>

              <h4 class="prose mt-4 font-bold">Fixes & Improvements</h4>

              <ul class="list-desc prose list-outside">
                <li class="prose">- Improved navigation experience</li>

                <li class="prose">
                  - Made it easier to add additional social links to a contact
                </li>
                <li class="prose">
                  - Fixed an issue where images from Twitter appeared smaller
                  than images from other sources
                </li>
                <li class="prose">
                  - Fixed an issue where importing a contact from the dashboard
                  & again from the chrome extensino created a duplicate contact
                </li>
                <li class="prose">
                  - Fixed an issue that caused the Chrome Extension to crash
                  when navigating between profiles
                </li>
                <li class="prose">
                  - Fixed an issue that caused Instagram imports to fail on some
                  new accounts
                </li>
              </ul>
            </div>
          </li>
          <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">v0.0.2</p>
              <p>2022.11.18</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                Chrome Extension & Twitter Support
              </h2>
              <p class="prose">
                This release launches the
                <a href="/chrome-extension">Jovie Chrome Extension</a> . You can
                now import contacts from any social media page on Twitter,
                TikTok, Instagram, Twitch, & LinkedIn.
              </p>
              <a href="/chrome-extension">
                <img
                  :src="
                    asset(
                      'img/External/Marketing/Chrome/Jovie_Social_CRM_Chrome_Extension.webp'
                    )
                  "
                  alt="Jovie Chrome Extension"
                  class="mt-4 rounded-lg py-4 shadow-lg" />
              </a>
              <h4 class="prose mt-4 font-bold">Other Features</h4>
              <ul class="prose">
                <li class="prose">
                  Support for importing Twitter profiles from within Jovie
                </li>
                <li class="prose">
                  Added support for bulk imports of Twitter profiles from CSV
                  files
                </li>
                <li class="prose">
                  Added Instagram DMs to the action menu on the sidebar &
                  contacts table
                </li>
              </ul>

              <h4 class="prose mt-4 font-bold">Fixes & Improvements</h4>

              <ul class="prose">
                <li class="prose">- Improved onboarding experience</li>
                <li class="prose">
                  - Improved analytics for identifying import issues
                </li>
                <li class="prose">- Improved fonts across the dashboard</li>
                <li class="prose">
                  - Fixed issues with copy & paste not triggering in some
                  instances
                </li>
                <li class="prose">
                  - Improved functionality of column sorting
                </li>
                <li class="prose">
                  - Improved readability of lists and menu items
                </li>
                <li class="prose">- Improved page load times</li>
                <li class="prose">- Added sitemap</li>
                <li class="prose">- Improved overall performance of imports</li>
                <li class="prose">- Improved overall design</li>
              </ul>
            </div>
          </li>
          <li
            v-for="log in logs"
            :key="log.version"
            class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-slate-600">
                {{ log.version }}
              </p>
              <p>{{ log.date }}</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                {{ log.summary }}
              </h2>
              <p class="text-base font-medium text-slate-500">
                {{ log.description }}
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <HomeCTA2 />
    <HomeCTA4 />
  </div>
</template>
<script>
import { Head } from '@vueuse/head';
import HomeCTA2 from './../components/Home/HomeCTA2.vue';
import HomeCTA4 from './../components/Home/HomeCTA4.vue';

export default {
  name: 'ChangeLog',
  data() {
    return {
      logs: [
        {
          version: '0.0.1',
          date: '2022-11-07',
          summary: 'Initial release of Jovie.',
          description: 'Today we rolled out the first release of Jovie.',
          //add html to description
        },
      ],
    };
  },
  components: {
    Head,
    HomeCTA2,
    HomeCTA4,
  },
};
</script>
