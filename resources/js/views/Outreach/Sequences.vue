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
                            <tbody class="bg-white divide-y divide-gray-200">
                            
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence"><a href="/outreach/sequence">Email sequence name</a></a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input id="offers" aria-describedby="offers-description" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-bold text-neutral-400">
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
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-neutral-900">
                                                <a href="/outreach/sequence">Email sequence name</a>
                                            </div>
                                            <div class="text-xs font-medium text-neutral-400">
                                                Contains 4 steps
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    
                                      
                                    <div class="mx-auto container py-1">
                                        <div role="list" aria-label="Our stats." class="grid md:grid-cols2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-10 gap-1">
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-blue-500 font-bold text-center text-sm lg:text-sm ">450</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Active</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-neutral-500 font-bold text-center text-sm lg:text-sm ">101</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Paused</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-pink-500 font-bold text-center text-sm lg:text-sm ">35</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Not sent</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-red-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Bounced</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="text-indigo-500 font-bold text-center text-sm lg:text-sm ">530</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Complete</h2>
                                                </div>
                                            </div>
                                       
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                            
                                            
                                                <div class="text-neutral-400">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">40</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Scheduled</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">32</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Delivered</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full lg:border-r border-gray-300 py-1">
                                                
                                                
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">3</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Opened</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1 lg:border-r">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">5</h1>
                                                    <h2 class="font-normal text-xs  text-center tracking-normal">Replied</h2>
                                                </div>
                                            </div>
                                            <div role="listitem" class="flex justify-center w-full py-1">
                                                
                                            
                                                <div class="text-neutral-400  ">
                                                    <h1 class="font-bold text-center text-sm lg:text-sm ">530</h1>
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
