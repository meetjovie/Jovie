<template>
  <div id="crm" class="w-full">
    <div class="flex w-full justify-between bg-white">
      <div>
        <div class="relative mx-auto w-full rounded sm:hidden"></div>
        <div
          class="hidden h-12 rounded bg-white sm:block xl:mx-0 xl:w-full"></div>
      </div>
      <div class="bg-white">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <span class="relative z-0 mr-2 inline-flex rounded-md py-2">
          <button
            type="button"
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-indigo-600 px-2 py-2 text-xs font-medium text-gray-200 hover:bg-indigo-700 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="-ml-1 mr-2 h-4 w-4 text-gray-200"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 4v16m8-8H4" />
            </svg>
            New Sequence
          </button>
        </span>
      </div>
    </div>

    <div>
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="px-2 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      <span class="sr-only">Select</span>
                    </th>
                    <th
                      scope="col"
                      class="px-2 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      <span class="sr-only">Enabled</span>
                    </th>
                    <th
                      scope="col"
                      class="px-2 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      Sequence
                    </th>
                    <th
                      scope="col"
                      class="px-2 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                      <span class="sr-only">Stage</span>
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                      <span class="sr-only">Actions</span>
                    </th>
                    <th scope="col" class="relative px-2 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody
                  v-for="sequence in sequences"
                  :key="sequence"
                  class="divide-y divide-gray-200 bg-white">
                  <tr>
                    <td class="w-10 whitespace-nowrap px-2 py-1">
                      <div class="flex items-center">
                        <input
                          id="offers"
                          aria-describedby="offers-description"
                          name="offers"
                          type="checkbox"
                          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
                      </div>
                    </td>
                    <td class="w-10 whitespace-nowrap px-2 py-1">
                      <div
                        class="flex items-center text-sm font-bold text-neutral-400">
                        <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                        <ToggleGroup v-model="sequence.enabled"></ToggleGroup>
                      </div>
                    </td>
                    <td class="whitespace w-80 px-2 py-1">
                      <div class="items-center">
                        <div class="">
                          <div
                            class="truncate text-sm font-medium text-neutral-900">
                            <a
                              class="w-80 line-clamp-1"
                              href="/outreach/sequence"
                              >{{ sequence.name }}</a
                            >
                          </div>
                          <div
                            class="truncate text-xs font-medium text-neutral-400">
                            Contains {{ sequence.steps }} steps
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="min-w-40 flex-grow whitespace-nowrap px-2 py-1">
                      <div class="container mx-auto py-1">
                        <div
                          role="list"
                          aria-label="Our stats."
                          class="md:grid-cols2 grid gap-1 lg:grid-cols-3 xl:grid-cols-10 2xl:grid-cols-10">
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-gray-300 py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold text-blue-500 lg:text-sm">
                                {{ sequence.countactive }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Active
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-gray-300 py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold text-neutral-500 lg:text-sm">
                                {{ sequence.countpaused }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Paused
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-gray-300 py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold text-pink-500 lg:text-sm">
                                {{ sequence.countnotsent }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Not sent
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold text-red-500 lg:text-sm">
                                {{ sequence.countbounced }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Bounced
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold text-indigo-500 lg:text-sm">
                                {{ sequence.countcompleted }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Complete
                              </h2>
                            </div>
                          </div>

                          <div
                            role="listitem"
                            class="flex w-full justify-center border-gray-300 py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                {{ sequence.countscheduled }}focus-visible:
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Scheduled
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-gray-300 py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                {{ sequence.countdelivered }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Delivered
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-gray-300 py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                {{ sequence.countopened }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Opened
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center py-1 lg:border-r">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                {{ sequence.countreplied }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Replied
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center py-1">
                            <div class="text-neutral-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                {{ sequence.countinterested }}
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Interested
                              </h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td
                      class="whitespace-nowrap px-2 py-1 text-right text-sm font-medium">
                      <!-- This example requires Tailwind CSS v2.0+ -->
                      <span
                        class="relative z-0 inline-flex rounded-md shadow-sm">
                        <button
                          type="button"
                          class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                          <span class="sr-only">Clone</span>
                          <!-- Heroicon name: solid/chevron-left -->
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                          </svg>
                        </button>
                        <button
                          type="button"
                          class="relative -ml-px inline-flex items-center border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                          <span class="sr-only">Archive</span>
                          <!-- Heroicon name: solid/chevron-right -->
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                          </svg>
                        </button>
                        <button
                          type="button"
                          class="relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                          <span class="sr-only">Delete</span>
                          <!-- Heroicon name: solid/chevron-right -->
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                        </button>
                      </span>
                    </td>
                    <td
                      class="whitespace-nowrap px-2 py-1 text-right text-sm font-medium">
                      <a
                        href="/creatoroverview"
                        class="text-indigo-600 hover:text-indigo-900"
                        >Manage</a
                      >
                    </td>
                  </tr>

                  <!-- More people... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ToggleGroup from '../../components/ToggleGroup.vue';

export default {
  components: {
    ToggleGroup,
  },
  data() {
    return {
      sequences: [
        {
          id: 1,
          name: 'Hey, this is my first sequence',
          steps: '3',
          enabled: true,
          countactive: '234',
          countopened: '5',
          countreplied: '530',
          countinterested: '530',
          countpaused: '0',
          countnotsent: '0',
          countbounced: '3',
          countscheduled: '0',
          countdelivered: '0',
          countcompleted: '0',
        },
        {
          id: 2,
          name: 'Sequence 2',
          steps: '7',
          enabled: false,
          countactive: '634',
          countopened: '7',
          countreplied: '230',
          countinterested: '330',
          countpaused: '4',
          countnotsent: '3',
          countbounced: '7',
          countscheduled: '7',
          countdelivered: '9',
          countcompleted: '11',
        },
        {
          id: 3,
          name: 'This one has a really long name. It goes on forever and ever. Life is now or never. Forver is gonna bug you donw... ',
          steps: '7',
          enabled: false,
          countactive: '634',
          countopened: '7',
          countreplied: '34',
          countinterested: '320',
          countpaused: '4',
          countnotsent: '3',
          countbounced: '7',
          countscheduled: '2',
          countdelivered: '9',
          countcompleted: '11',
        },
        {
          id: 4,
          name: 'Oops I forgot to add a name to this one',
          steps: '7',
          enabled: true,
          countactive: '634',
          countopened: '7',
          countreplied: '20',
          countinterested: '330',
          countpaused: '4',
          countnotsent: '3',
          countbounced: '3',
          countscheduled: '7',
          countdelivered: '9',
          countcompleted: '11',
        },
      ],
    };
  },
};
</script>
