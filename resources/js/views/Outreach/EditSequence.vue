<template name="default">
  <div id="crm" class="w-full">
    <div class="flex w-full justify-between bg-white">
      <div class="bg-white">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <span class="relative z-0 mr-2 inline-flex rounded-md py-2">
          <button
            type="button"
            class="relative inline-flex items-center rounded-md border border-slate-300 bg-indigo-600 px-4 py-2 text-xs font-medium text-slate-200 hover:bg-indigo-700 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="-ml-1 mr-2 h-4 w-4 text-slate-200"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 4v16m8-8H4" />
            </svg>
            New Step
          </button>
        </span>
      </div>
    </div>

    <div v-show="navBarTab == 0">
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-slate-200 shadow">
              <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                  <tr>
                    <th
                      scope="col"
                      class="w-1/3 px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                      Sequence
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                      <span class="sr-only">Stage</span>
                    </th>
                  </tr>
                </thead>
                <tbody
                  class="justify-between divide-y divide-slate-200 bg-white">
                  <tr>
                    <td class="whitespace-nowrap px-4 py-1">
                      <div class="flex items-center">
                        <div class="">
                          <div class="text-sm font-medium text-slate-900">
                            Email sequence name
                          </div>
                          <div class="text-xs font-medium text-slate-400">
                            Contains 4 steps
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-4 py-1">
                      <div class="container mx-auto py-1">
                        <div
                          role="list"
                          aria-label="Our stats."
                          class="md:grid-cols2 grid gap-1 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10">
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-slate-300 py-1 lg:border-r">
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold text-blue-500 lg:text-sm">
                                450
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Active
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-slate-300 py-1 lg:border-r">
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold text-slate-500 lg:text-sm">
                                101
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Paused
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-slate-300 py-1 lg:border-r">
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold text-pink-500 lg:text-sm">
                                35
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
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold text-red-500 lg:text-sm">
                                530
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
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold text-indigo-500 lg:text-sm">
                                530
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Complete
                              </h2>
                            </div>
                          </div>

                          <div
                            role="listitem"
                            class="flex w-full justify-center border-slate-300 py-1 lg:border-r">
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                40
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Scheduled
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-slate-300 py-1 lg:border-r">
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                32
                              </h1>
                              <h2
                                class="text-center text-xs font-normal tracking-normal">
                                Delivered
                              </h2>
                            </div>
                          </div>
                          <div
                            role="listitem"
                            class="flex w-full justify-center border-slate-300 py-1 lg:border-r">
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                3
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
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                5
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
                            <div class="text-slate-400">
                              <h1
                                class="text-center text-sm font-bold lg:text-sm">
                                530
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
                  </tr>

                  <!-- More people... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div
        class="mx-auto mt-8 max-w-7xl rounded-xl border-b border-slate-200 bg-white shadow-lg">
        <div
          class="-ml-4 flex flex-wrap items-center justify-between px-4 py-2 sm:flex-nowrap">
          <div class="flex">
            <div class="flex items-center py-2">
              <div class="flex">
                <div class="border-r px-8 text-xl font-bold text-indigo-700">
                  1
                </div>
                <div class="px-4 text-sm font-medium text-slate-900">
                  <div>First email in sequence</div>
                  <div class="text-xs text-slate-500">Send in 30 minutes</div>
                </div>
              </div>
            </div>
          </div>
          <div class="ml-4 flex-shrink-0">
            <span class="relative z-0 inline-flex rounded-md shadow-sm">
              <button
                type="button"
                class="relative inline-flex items-center rounded-md border border-slate-300 bg-white px-2 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                <span class="sr-only">Menu</span>
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
                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg>
              </button>
            </span>
          </div>
        </div>
        <div class="border-y">
          <div
            class="grid grid-cols-12 items-center bg-white px-4 py-3 hover:bg-slate-100">
            <div class="col-span-1 inline-flex">
              <div class="font-bold text-slate-400">A</div>
              <div class="mx-4">
                <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-slate-200" -->
                <ToggleGroup></ToggleGroup>
              </div>
            </div>
            <div class="col-span-5">
              <span class="grid-cols-span-1 text-sm font-bold text-slate-700"
                >Email subject line</span
              ><br /><span
                class="text-xs font-medium text-slate-600 line-clamp-1"
                >Hey {firstname}! We're selling cool stuff and need your
                help!</span
              >
            </div>
            <div class="col-span-5 hidden xl:flex">
              <div class="container mx-auto">
                <div
                  role="list"
                  aria-label="Our stats."
                  class="grid grid-cols-8 gap-1">
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1 class="text-center text-xs font-bold text-blue-500">
                        900
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Scheduled
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-slate-500 lg:text-xs">
                        101
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Delivered
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-pink-500 lg:text-xs">
                        35
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Bounced
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-pink-500 lg:text-xs">
                        90
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Opened
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-orange-500 lg:text-xs">
                        21
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Replied
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-purple-500 lg:text-xs">
                        3
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Interested
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-1">
              <span class="relative z-0 inline-flex rounded-md shadow-sm">
                <button
                  type="button"
                  class="relative inline-flex items-center rounded-l-md border border-slate-300 bg-white px-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
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
                  class="relative -ml-px inline-flex items-center border border-slate-300 bg-white px-2 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
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
                  class="relative -ml-px inline-flex items-center rounded-r-md border border-slate-300 bg-white px-2 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
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
            </div>
          </div>
        </div>
        <div class="border-y">
          <div
            class="grid grid-cols-12 items-center bg-white px-4 py-3 hover:bg-slate-100">
            <div class="col-span-1 inline-flex">
              <div class="font-bold text-slate-400">B</div>
              <div class="mx-4">
                <!-- This example requires Tailwind CSS v2.0+ -->

                <ToggleGroup></ToggleGroup>
              </div>
            </div>
            <div class="col-span-5">
              <span class="grid-cols-span-1 text-sm font-bold text-slate-700"
                >Diffenret subjects have different results</span
              ><br /><span
                class="text-xs font-medium text-slate-600 line-clamp-1"
                >That's why {company} supports multi-variant testing. We're
                selling cool stuff and need your help!</span
              >
            </div>
            <div class="col-span-5 hidden xl:flex">
              <div class="container mx-auto">
                <div
                  role="list"
                  aria-label="Our stats."
                  class="grid grid-cols-8 gap-1">
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1 class="text-center text-xs font-bold text-blue-500">
                        900
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Scheduled
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-slate-500 lg:text-xs">
                        101
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Delivered
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-pink-500 lg:text-xs">
                        35
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Bounced
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-pink-500 lg:text-xs">
                        90
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Opened
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-orange-500 lg:text-xs">
                        21
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Replied
                      </h2>
                    </div>
                  </div>
                  <div
                    role="listitem"
                    class="flex w-full justify-center border-slate-300">
                    <div class="text-slate-400">
                      <h1
                        class="text-center text-xs font-bold text-purple-500 lg:text-xs">
                        3
                      </h1>
                      <h2
                        class="text-center text-xs font-normal tracking-normal">
                        Interested
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-1">
              <span class="relative z-0 inline-flex rounded-md shadow-sm">
                <button
                  type="button"
                  class="relative inline-flex items-center rounded-l-md border border-slate-300 bg-white px-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
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
                  class="relative -ml-px inline-flex items-center border border-slate-300 bg-white px-2 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
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
                  class="relative -ml-px inline-flex items-center rounded-r-md border border-slate-300 bg-white px-2 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
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
            </div>
          </div>
        </div>
        <div class="mx-auto rounded-b-xl border-y text-center">
          <div
            class="group mx-auto inline-flex w-full cursor-pointer items-center justify-center rounded-b-xl bg-white px-4 py-4 text-center font-bold text-slate-500 hover:bg-indigo-600 hover:text-white">
            Add variant
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="ml-2 h-5 w-5 group-hover:text-white"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>
      <div
        class="mx-auto h-24 w-0 border-2 border-l border-solid border-indigo-500/50"></div>
      <div
        class="group mx-auto w-64 cursor-pointer items-center rounded-lg bg-white py-2 px-8 text-center font-bold text-slate-500 shadow-lg hover:bg-indigo-600">
        <div
          class="mx-auto inline-flex cursor-pointer items-center rounded-b-xl text-center font-bold text-slate-500 group-hover:text-white">
          Add Step
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="ml-2 h-4 w-4 group-hover:text-white"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
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
};
</script>
