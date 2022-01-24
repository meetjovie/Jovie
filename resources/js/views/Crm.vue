<template>
    <div id="crm" class="w-full min-w-full mx-auto">
        <div class="flex justify-between bg-white w-full">
            <div>
                <div class="sm:hidden relative w-full mx-auto rounded">
                    <div class="absolute inset-0 m-auto mr-4 z-0 w-6 h-6">
                        <img class="icon icon-tabler icon-tabler-selector" src=""
                             alt="selector"/>
                    </div>

                </div>
                <div class="xl:w-full xl:mx-0 h-12 hidden sm:block bg-white rounded">
                    <div class="flex border-b px-5">
                        <button
                            class=" hover:text-indigo-700 focus-visible:text-indigo-700 focus-visible:outline-none text-sm text-indigo-700 flex flex-col justify-between border-indigo-700 pt-3 rounded-t mr-8 font-normal cursor-pointer">
                            <span class="mb-3">Creators</span>
                            <div class="w-full h-1 bg-indigo-700 rounded-t-md"></div>
                        </button>
                        <button
                            class=" hover:text-indigo-700 focus-visible:text-indigo-700 focus-visible:outline-none mr-10 text-sm text-gray-600 flex flex-col justify-between border-indigo-700 pt-3 rounded-t mr-8 font-normal cursor-pointer">
                            <span class="mb-3">Archived</span>
                            <div class="w-full h-1 bg-indigo-700 rounded-t-md hidden"></div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 items-center text-xs text-neutral-500 font-bold">
                <div>
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div>

                        <div class="mt-1 relative">
                            <button type="button"
                                    class="relative w-60 bg-white/90 backdrop-blur-md border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                   <span class="block truncate">
                                   Select a list
                                   </span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                   <!-- Heroicon name: solid/selector -->
                                   <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                          <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd"/>
                                   </svg>
                                   </span>
                            </button>

                            <!--
                            Select popover, show/hide based on select state.

                            Entering: ""
                            From: ""
                            To: ""
                            Leaving: "transition ease-in duration-100"
                            From: "opacity-100"
                            To: "opacity-0"
                            -->
                            <ul class="absolute z-10 mt-1 w-full bg-white/90 backdrop-blur-md shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label">
                                <!--
                                Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                                Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                                -->
                                <li class="text-gray-900 cursor-default select-none relative py-2 pl-8 pr-4"
                                    id="listbox-option-0" role="option">
                                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                                    <span class="font-normal block truncate">
                                          Fashion youtubers
                                   </span>

                                    <!--
                                           Checkmark, only display for selected option.

                                           Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                                    -->
                                    <span class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                          <!-- Heroicon name: solid/check -->
                                          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                               fill="currentColor" aria-hidden="true">
                                          <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"/>
                                          </svg>
                                   </span>
                                </li>

                                <!-- More items... -->
                            </ul>
                        </div>
                    </div>

                </div>
                <div>


                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div>

                        <div class="mt-1 relative">
                            <button type="button"
                                    class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                          <span class="block truncate">
                                          Campaigns
                                          </span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                          <!-- Heroicon name: solid/selector -->
                                          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                               viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd"
                                                       d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                       clip-rule="evenodd"/>
                                          </svg>
                                          </span>
                            </button>

                            <!--
                            Select popover, show/hide based on select state.

                            Entering: ""
                            From: ""
                            To: ""
                            Leaving: "transition ease-in duration-100"
                            From: "opacity-100"
                            To: "opacity-0"
                            -->
                            <ul class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label">
                                <!--
                                Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                                Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
                                -->
                                <li class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9"
                                    role="option">
                                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                                    <span class="font-normal block truncate">
                                                 Zelf product launch
                                          </span>

                                    <!--
                                           Checkmark, only display for selected option.

                                           Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                                    -->
                                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                 <!-- Heroicon name: solid/check -->
                                                 <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                      viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd"
                                                       d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                       clip-rule="evenodd"/>
                                                 </svg>
                                          </span>
                                </li>

                                <!-- More items... -->
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-span-2">
                    <!--
This example requires Tailwind CSS v2.0+

This example requires some changes to your config:

```
// tailwind.config.js
module.exports = {
// ...
plugins: [
// ...
require('@tailwindcss/forms'),
],
}
```
-->
                    <div>

                        <div class="mt-1 relative flex items-center">
                            <input type="text" name="search" id="search" placeholder="Enter a search term..."
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                            <div class="absolute inset-y-0 right-0 flex py-1 pr-1.5">
                                <kbd
                                    class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400">
                                    ⌘K
                                </kbd>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="bg-white">

                <div>
                     <span class="relative z-0 py-1 mr-2 inline-flex rounded-md">
                            <button type="button"
                                    class="relative inline-flex items-center px-4 py-2 rounded-l-md active:bg-indigo-700 active:text-white border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Add Creator
                            </button>
                            <button type="button"
                                    class="-ml-px relative inline-flex items-center rounded-r-md px-4 py-2 active:bg-indigo-700 active:text-white border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Import List
                            </button>
                     </span>
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="flex flex-col w-full">
                <div class="mx-auto p-0 w-full">
                    <div class="align-middle inline-block w-full">
                        <div class="shadow overflow-hidden border-b border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-2 py-1 text-center items-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="grid grid-cols-2 items-center">
                                            <div class="items-center text-center h-5">
                                                <input id="comments" aria-describedby="comments-description"
                                                       name="comments" type="checkbox"
                                                       class="focus-visible:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div
                                                class="sr-only group text-center items-center text-gray-300 hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-6 w-6 group-hover:fill-red-500" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creator
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        First
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Last
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="flex  items-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="grid grid-cols-1 gap-y-0 mr-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-4 w-4 grid hover:text-neutral-700" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                      d="M5 15l7-7 7 7"/>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-4 w-4 grid hover:text-neutral-700" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                      d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </div>
                                        <div class="flex">Reach</div>
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Offer
                                    </th>

                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Campaign
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stage
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contacted
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rating
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-indigo-50 focus:ring-indigo-700 group border border-neutral-200 border-1 border-collapse">
                                    <td
                                        class="px-2 py-1 text-center text-gray-300 group-hover:text-neutral-500 text-xs font-bold whitespace-nowrap">
                                        <div class="grid grid-cols-2 items-center">
                                            <div class="group">
                                                        <span class="group-hover:hidden">
                                                               1
                                                        </span>
                                                <span class="hidden group-hover:block">
                                                               <input id="comments-description"
                                                                      aria-describedby="comments-description"
                                                                      name="comments" type="checkbox"
                                                                      class="focus-visible:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                        </span>
                                            </div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-6 w-6 hover:text-red-500 hover:fill-red-500" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1 border whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-5 w-10">
                                                <img class="h-5 w-5 rounded-full"
                                                     src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Fashion with Jane!
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 line-clamp-1">Jane</div>

                                    </td>
                                    <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 line-clamp-1">Cooper</div>

                                    </td>
                                    <td class="border border-collapse focus:border-indigo-500 border-1 whitespace-nowrap">
                                        <div class="text-sm text-gray-700 line-clamp-1">
                                            <input autocomplete="off" type="creator-email" name="creator-email"
                                                   id="creator-email"
                                                   class="bg-white/0 focus-visible:ring-indigo-500 px-2 py-1  focus:border-indigo-700 focus:border-2  focus-visible:border-indigo-500 block w-full sm:text-sm"
                                                   placeholder="you@example.com" value="creatorsemail@gmail.com"
                                                   aria-describedby="email-description">

                                        </div>

                                    </td>
                                    <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                                 <span
                                                     class="px-2 inline-flex text-xs leading-5 font-bold text-center rounded-full text-nuetral-800">
                                                        500K
                                                 </span>
                                    </td>
                                    <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                                 <span
                                                     class="px-2 inline-flex text-xs leading-5 font-bold text-center rounded-full text-nuetral-800">
                                                        $2,000
                                                 </span>
                                    </td>
                                    <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                                 <span
                                                     class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-nuetral-800">
                                                        Black Friday Sale
                                                 </span>
                                    </td>
                                    <td class="px-2 py-1 border items-center border-collapse border-1 whitespace-nowrap">
                                                 <span
                                                     class="px-2 inline-flex text-xs items-center leading-5 font-semibold rounded-md bg-blue-100 text-blue-800">

                                                        Onboarded
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-4 w-4 ml-2 hover:text-blue-700" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 9l-7 7-7-7"/>
                                                        </svg>
                                                 </span>
                                    </td>
                                    <td class="px-6 py-1 border items-center border-collapse border-1 whitespace-nowrap text-sm text-gray-500">
                                        2/5/23
                                    </td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-500">
                                        <div class="grid grid-cols-5">
                                            <div class="text-neutral-300 500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 hover:text-yellow-500  hover:fill-yellow-500"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </div>
                                            <div class="text-neutral-300 500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 hover:text-yellow-500  hover:fill-yellow-500"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </div>
                                            <div class="text-neutral-300 500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 hover:text-yellow-500  hover:fill-yellow-500"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </div>
                                            <div class="text-neutral-300 500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 hover:text-yellow-500  hover:fill-yellow-500"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </div>
                                            <div class="text-neutral-300 500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 hover:text-yellow-500  hover:fill-yellow-500"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-1 whitespace-nowrap justify-right text-right text-xs font-medium">
                                        <div class="grid grid-cols-2 items-center gap-4">
                                            <div>
                                                <a href="/creatoroverview"
                                                   class="text-indigo-600 hover:text-indigo-900">Manage</a>
                                            </div>

                                            <!-- This example requires Tailwind CSS v2.0+ -->
                                            <div class="relative items-center  inline-block text-left z-10">
                                                <div>
                                                    <button type="button"
                                                            class="items-center  rounded-full flexhover:text-indigo-500 text-gray-300 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-indigo-500"
                                                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                        <span class="sr-only">Open options</span>
                                                        <!-- Heroicon name: solid/dots-vertical -->
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 20 20"
                                                             fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!--
                                                Dropdown menu, show/hide based on menu state.

                                                Entering: "transition ease-out duration-100"
                                                From: "transform opacity-0 scale-95"
                                                To: "transform opacity-100 scale-100"
                                                Leaving: "transition ease-in duration-75"
                                                From: "transform opacity-100 scale-100"
                                                To: "transform opacity-0 scale-95"
                                                -->
                                                <div
                                                    class="origin-top-right absolute right-0 mt-2 w-56 z-20 rounded-md shadow-lg bg-white/90 backdrop-blur-md ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="menu-button"
                                                    tabindex="-1">
                                                    <div class="py-1 z-50" role="none">
                                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm"
                                                           role="menuitem"
                                                           tabindex="-1" id="menu-item-0">Archive</a>
                                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm"
                                                           role="menuitem"
                                                           tabindex="-1" id="menu-item-1">Mute</a>
                                                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm"
                                                           role="menuitem"
                                                           tabindex="-1" id="menu-item-2">License</a>
                                                        <form method="POST" action="#" role="none">
                                                            <button type="submit"
                                                                    class="text-gray-700 block w-full text-left px-4 py-2 text-sm"
                                                                    role="menuitem" tabindex="-1" id="menu-item-3">
                                                                Sign out
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
export default {
    name: "Crm"
}
</script>

<style scoped>

</style>
