<template>
 <div  class="w-full">
        <div class="flex justify-between border-b bg-white w-full">
            <div>
            <TabGroup as="div" class="mt-2">
                        <div class="border-b border-gray-200">
                <SubNav :tabs="tabs"></SubNav>
                <TabPanels>
      <TabPanel>Content 1</TabPanel>
      <TabPanel>Content 2</TabPanel>
    
    </TabPanels>
                </TabGroup>
                </div>
            </div>
            <div class="bg-white">

                <span class="relative z-0 py-2 mr-2 inline-flex rounded-md">
                    <button type="button"
                        class="relative inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-indigo-600 text-xs font-medium text-gray-200 hover:bg-indigo-700 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4 text-gray-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Step
                    </button>

                </span>
            </div>
        </div>

        <div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>

                                        <th scope="col"
                                            class="px-4 py-3 w-1/3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Sequence
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="sr-only">Stage</span>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 justify-between">

                                    <tr>

                                        <td class="px-4 py-1 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="">
                                                    <div class="text-sm font-medium text-neutral-900">
                                                        Email sequence name
                                                    </div>
                                                    <div class="text-xs font-medium text-neutral-400">
                                                        Contains 4 steps
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-1 whitespace-nowrap">


                                            <div class="mx-auto container py-1">
                                                <div role="list" aria-label="Our stats."
                                                    class="grid grid-cols-5 xl:grid-cols-10 gap-1">
                                                    <div role="listitem"
                                                        class="flex justify-center w-full lg:border-r border-gray-300 py-1">


                                                        <div class="text-neutral-400  ">
                                                            <h1
                                                                class="text-blue-500 font-bold text-center text-sm lg:text-sm ">
                                                                450</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Active</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full lg:border-r border-gray-300 py-1">

                                                        <div class="text-neutral-400  ">
                                                            <h1
                                                                class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">
                                                                101</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Paused</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full lg:border-r border-gray-300 py-1">


                                                        <div class="text-neutral-400  ">
                                                            <h1
                                                                class="text-pink-500 font-bold text-center text-sm lg:text-sm ">
                                                                35</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">Not
                                                                sent</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full py-1 lg:border-r">


                                                        <div class="text-neutral-400  ">
                                                            <h1
                                                                class="text-red-500 font-bold text-center text-sm lg:text-sm ">
                                                                530</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Bounced</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full py-1 xl:border-r">


                                                        <div class="text-neutral-400  ">
                                                            <h1
                                                                class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">
                                                                530</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Complete</h2>
                                                        </div>
                                                    </div>

                                                    <div role="listitem"
                                                        class="flex justify-center w-full lg:border-r border-gray-300 py-1">


                                                        <div class="text-neutral-400">
                                                            <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Scheduled</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full lg:border-r border-gray-300 py-1">

                                                        <div class="text-neutral-400  ">
                                                            <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Delivered</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full lg:border-r border-gray-300 py-1">


                                                        <div class="text-neutral-400  ">
                                                            <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Opened</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem"
                                                        class="flex justify-center w-full py-1 lg:border-r">


                                                        <div class="text-neutral-400  ">
                                                            <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Replied</h2>
                                                        </div>
                                                    </div>
                                                    <div role="listitem" class="flex justify-center w-full py-1">


                                                        <div class="text-neutral-400  ">
                                                            <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
                                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                                Interested</h2>
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
            <div class="bg-white mx-auto max-w-7xl mt-8 border-b rounded-xl shadow-lg border-gray-200">
                <div class="-ml-4 px-4 py-2 flex justify-between items-center flex-wrap sm:flex-nowrap">
                    <div class="flex">
                        <div class="flex items-center py-2">
                            <div class="flex">

                                <div class="text-xl px-8 border-r font-bold text-indigo-700">
                                1
                                </div>
                                <div class="text-sm px-4 font-medium text-neutral-900">
                                    <div>
                                        First email in sequence
                                    </div>
                                    <div class="text-xs text-neutral-500">
                                    Send in 30 minutes
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <span class="relative z-0 inline-flex shadow-sm rounded-md">
                            <button type="button" class="relative inline-flex items-center px-2 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="sr-only">Menu</span>
                            <!-- Heroicon name: solid/chevron-left -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                            </button>

                        </span>
                    </div>
                </div>
                <div class="border-y">
                    <div class="px-4 py-3 bg-white items-center hover:bg-neutral-100 grid grid-cols-12">
                        <div class="col-span-1 inline-flex">
                            <div class="font-bold text-neutral-400">
                                A
                            </div>
                        <div class="mx-4">
                            <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                            <button type="button" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" role="switch" aria-checked="false">
                                <span class="sr-only">Use setting</span>
                                <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                                <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200">
                                <!-- Enabled: "opacity-0 ease-out duration-100", Not Enabled: "opacity-100 ease-in duration-200" -->
                                <span class="opacity-100 ease-in duration-200 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                    <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <!-- Enabled: "opacity-100 ease-in duration-200", Not Enabled: "opacity-0 ease-out duration-100" -->
                                <span class="opacity-0 ease-out duration-100 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">
                                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                                    <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                    </svg>
                                </span>
                                </span>
                            </button>
                            </div>
                        </div>
                        <div class="col-span-5">
                            <span class="grid-cols-span-1 font-bold text-sm text-neutral-700">Email subject line</span><br><span class="font-medium text-xs line-clamp-1 text-neutral-600">Hey {firstname}!  We're selling cool stuff and need your help!</span>
                        </div>
                        <div class="hidden xl:flex col-span-5">
                            <div class="mx-auto container">
                                <div role="list" aria-label="Our stats."
                                    class="grid grid-cols-8 gap-1">
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-blue-500 font-bold text-center text-xs">
                                                900</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Scheduled</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">

                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-neutral-500 font-bold text-center text-xs lg:text-xs ">
                                                101</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Delivered</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-pink-500 font-bold text-center text-xs lg:text-xs ">
                                                35</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Bounced</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-pink-500 font-bold text-center text-xs lg:text-xs ">
                                                90</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Opened</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-orange-500 font-bold text-center text-xs lg:text-xs ">
                                                21</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">                                            Replied</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-purple-500 font-bold text-center text-xs lg:text-xs ">
                                                3</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Interested</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">

                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                <button type="button" class="relative inline-flex items-center px-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <span class="sr-only">Clone</span>
                                <!-- Heroicon name: solid/chevron-left -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <span class="sr-only">Archive</span>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    <span class="sr-only">Delete</span>
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="border-y">
                    <div class="px-4 py-3 bg-white items-center hover:bg-neutral-100 grid grid-cols-12">
                        <div class="col-span-1 inline-flex">
                            <div class="font-bold text-neutral-400">
                                B
                            </div>
                        <div class="mx-4">
                            <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                            <button type="button" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" role="switch" aria-checked="false">
                                <span class="sr-only">Use setting</span>
                                <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                                <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200">
                                <!-- Enabled: "opacity-0 ease-out duration-100", Not Enabled: "opacity-100 ease-in duration-200" -->
                                <span class="opacity-100 ease-in duration-200 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                    <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <!-- Enabled: "opacity-100 ease-in duration-200", Not Enabled: "opacity-0 ease-out duration-100" -->
                                <span class="opacity-0 ease-out duration-100 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">
                                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                                    <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                    </svg>
                                </span>
                                </span>
                            </button>
                            </div>
                        </div>
                        <div class="col-span-5">
                            <span class="grid-cols-span-1 font-bold text-sm text-neutral-700">Diffenret subjects have different results</span><br><span class="font-medium text-xs text-neutral-600 line-clamp-1">That's why {company} supports multi-variant testing. We're selling cool stuff and need your help!</span>
                        </div>
                        <div class="hidden xl:flex col-span-5">
                            <div class="mx-auto container">
                                <div role="list" aria-label="Our stats."
                                    class="grid grid-cols-8 gap-1">
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-blue-500 font-bold text-center text-xs">
                                                900</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Scheduled</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">

                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-neutral-500 font-bold text-center text-xs lg:text-xs ">
                                                101</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Delivered</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-pink-500 font-bold text-center text-xs lg:text-xs ">
                                                35</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Bounced</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-pink-500 font-bold text-center text-xs lg:text-xs ">
                                                90</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Opened</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-orange-500 font-bold text-center text-xs lg:text-xs ">
                                                21</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">                                            Replied</h2>
                                        </div>
                                    </div>
                                    <div role="listitem"
                                        class="flex justify-center w-full border-gray-300">


                                        <div class="text-neutral-400  ">
                                            <h1
                                                class="text-purple-500 font-bold text-center text-xs lg:text-xs ">
                                                3</h1>
                                            <h2 class="font-normal text-xs  text-center tracking-normal">
                                                Interested</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">

                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                <button type="button" class="relative inline-flex items-center px-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <span class="sr-only">Clone</span>
                                <!-- Heroicon name: solid/chevron-left -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <span class="sr-only">Archive</span>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                </button>
                                <button type="button" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    <span class="sr-only">Delete</span>
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="border-y rounded-b-xl text-center mx-auto">
                    <div class="px-4 py-4 cursor-pointer rounded-b-xl bg-white hover:bg-neutral-100 text-center items-center mx-auto text-neutral-500 font-bold inline-flex">
                        Add variant
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

            </div>
            <div class="mx-auto h-24 border-2 w-0 border-l border-solid border-indigo-500"></div>
            <div class="mx-auto  shadow-lg w-64 bg-white hover:bg-neutral-50 cursor-pointer rounded-lg py-2 px-8 text-center font-bold text-neutral-500 items-center">
                <div class="cursor-pointer rounded-b-xl text-center items-center mx-auto text-neutral-500 font-bold inline-flex">
                    Add Step
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>




</template>

<script>
import SubNav from '../components/SubNav.vue'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
export default {
    name: "Outreach",
    components: {
        SubNav,
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel
    },
    data() {
        return {
            tabs: [
                {
                    name: 'tab 1',
                    otherProperty: 'tab1'
                },
                {
                    name: 'tab 2',
                    otherProperty: 'tab2'
                }
            ]
        }
    }
}
</script>

