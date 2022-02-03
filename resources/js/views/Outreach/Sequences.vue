<template>
    

<div id="crm" class="w-full"> 
    <div class="flex justify-between bg-white w-full">
        <div>
            <div class="sm:hidden relative w-full mx-auto rounded">
                
                
            </div>
            <div class="xl:w-full xl:mx-0 h-12 hidden sm:block bg-white rounded">
                
            </div>
        </div>
        <div class="bg-white">
           <!-- This example requires Tailwind CSS v2.0+ -->
            <span class="relative z-0 py-2 mr-2 inline-flex rounded-md">
                <button type="button" class="relative inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-indigo-600 text-xs font-medium text-gray-200 hover:bg-indigo-700 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                    New Sequence
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
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <span class="sr-only">Select</span>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <span class="sr-only">Activate</span>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                   Sequence
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <span class="sr-only">Stage</span>
                                </th>
                                <th scope="col" class="relative px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                                <th scope="col" class="relative px-4 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody v-for="sequence in sequences" :key="sequence" class="bg-white divide-y divide-gray-200">
                            
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
                                        <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                                        <Toggle></Toggle>
  
                                    </div>
                                </td>
                                <td class="px-4 py-1 w-20 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="truncate">
                                            <div class="text-sm max-w-sm  truncate font-medium text-neutral-900">
                                                <a class="line-clamp-1" href="/outreach/sequence">{{ sequence.name }}</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains {{ sequence.steps }} steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">{{ sequence.countactive }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">{{ sequence.countpaused }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">{{ sequence.countnotsent }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">{{ sequence.countbounced }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">{{ sequence.countcompleted }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">{{ sequence.countscheduled }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">{{ sequence.countdelivered }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">{{ sequence.countopened }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">{{ sequence.countreplied }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">{{ sequence.countinterested }}</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Interested</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                  
                                 
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-right text-sm font-medium">
                                                                        <!-- This example requires Tailwind CSS v2.0+ -->
                                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                        <button type="button" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
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
  
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap text-right text-sm font-medium">
                                    <a  href="/creatoroverview" class="text-indigo-600 hover:text-indigo-900">Manage</a>
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
import Toggle from '../../components/Toggle.vue'
    

export default {
    components: {
        Toggle,
    },
    data() {
        return {
            sequences: [
                {
                    id: 1,
                    name: 'Hey, this is my first sequence',
                    steps: '3',
                    active: true,
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
                    active: false,
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
                    active: false,
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
                    active: true,
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
        }
    },
}



</script>
