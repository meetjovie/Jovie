<template>
    <div id="app" class="h-screen flex overflow-hidden bg-neutral-100">
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <div id="overlay" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">
            <!--
              Off-canvas menu overlay, show/hide based on off-canvas menu state.

              Entering: "transition-opacity ease-linear duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "transition-opacity ease-linear duration-300"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-neutral-600 bg-opacity-75" aria-hidden="true"></div>

            <!--
              Off-canvas menu, show/hide based on off-canvas menu state.

              Entering: "transition ease-in-out duration-300 transform"
                From: "-translate-x-full"
                To: "translate-x-0"
              Leaving: "transition ease-in-out duration-300 transform"
                From: "translate-x-0"
                To: "-translate-x-full"
            -->
            <div id="sidebar" class="relative flex-1 flex flex-col w-full pt-5 pb-4 bg-neutral-500/50 backdrop-blur-md">
                <!--
                  Close button, show/hide based on off-canvas menu state.

                  Entering: "ease-in-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in-out duration-300"
                    From: "opacity-100"
                    To: "opacity-0"
                -->


                <div class="flex h-screen justify-center items-center px-4">
                    <a href="{{ route('dashboard') }}">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="69px" height="20px">
                            <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                  d="M57.964,14.130 C58.057,14.960 58.283,15.578 58.639,15.984 C59.141,16.568 59.795,16.861 60.602,16.861 C61.111,16.861 61.596,16.734 62.054,16.480 C62.335,16.319 62.636,16.035 62.959,15.629 L68.068,16.099 C67.287,17.453 66.344,18.425 65.240,19.013 C64.135,19.602 62.551,19.896 60.487,19.896 C58.695,19.896 57.284,19.644 56.257,19.140 C55.229,18.637 54.377,17.836 53.702,16.740 C53.027,15.644 52.689,14.355 52.689,12.873 C52.689,10.765 53.366,9.059 54.721,7.755 C56.076,6.451 57.947,5.799 60.334,5.799 C62.271,5.799 63.800,6.091 64.921,6.675 C66.042,7.260 66.896,8.106 67.482,9.215 C68.068,10.325 68.362,11.768 68.362,13.546 L68.362,14.130 L57.964,14.130 ZM62.277,9.507 C61.840,9.076 61.264,8.860 60.551,8.860 C59.727,8.860 59.068,9.186 58.576,9.838 C58.261,10.244 58.062,10.849 57.977,11.654 L63.086,11.654 C62.984,10.655 62.715,9.939 62.277,9.507 ZM46.406,6.104 L51.592,6.104 L51.592,19.591 L46.406,19.591 L46.406,6.104 ZM46.406,0.973 L51.592,0.973 L51.592,4.491 L46.406,4.491 L46.406,0.973 ZM35.939,19.591 L30.311,6.104 L35.707,6.104 L38.332,14.651 L41.056,6.104 L46.289,6.104 L40.538,19.591 L35.939,19.591 ZM29.730,17.908 C28.349,19.233 26.440,19.896 24.002,19.896 C21.827,19.896 20.069,19.346 18.727,18.245 C17.079,16.882 16.255,15.095 16.255,12.886 C16.255,10.828 16.951,9.133 18.345,7.799 C19.738,6.466 21.619,5.799 23.989,5.799 C26.699,5.799 28.746,6.582 30.131,8.149 C31.244,9.410 31.800,10.964 31.800,12.809 C31.800,14.884 31.110,16.583 29.730,17.908 ZM25.863,10.212 C25.378,9.641 24.779,9.355 24.066,9.355 C23.310,9.355 22.685,9.645 22.193,10.225 C21.700,10.805 21.454,11.688 21.454,12.873 C21.454,14.075 21.698,14.964 22.186,15.540 C22.675,16.116 23.289,16.403 24.028,16.403 C24.775,16.403 25.389,16.120 25.869,15.553 C26.349,14.985 26.589,14.075 26.589,12.822 C26.589,11.654 26.347,10.784 25.863,10.212 ZM12.781,18.754 C11.639,19.524 10.176,19.908 8.392,19.908 C6.506,19.908 5.045,19.655 4.009,19.147 C2.972,18.639 2.171,17.896 1.607,16.918 C1.042,15.940 0.708,14.731 0.606,13.292 L6.124,12.543 C6.132,13.364 6.204,13.974 6.340,14.371 C6.476,14.769 6.705,15.091 7.028,15.337 C7.249,15.498 7.564,15.578 7.971,15.578 C8.617,15.578 9.090,15.339 9.392,14.861 C9.693,14.383 9.844,13.577 9.844,12.444 L9.844,0.973 L15.629,0.973 L15.629,11.088 C15.629,13.212 15.440,14.828 15.062,15.936 C14.684,17.045 13.924,17.984 12.781,18.754 Z"/>
                        </svg>
                        <h2 class="flex font-bold text-center text-white opacity-90 mt-4 align-center text-sm">Your screen is too small. Jovie is built for larger devices.</h2>
                    </a>
                </div>
            </div>
        </div>
        <!-- Narrow sidebar -->
        <div class="hidden w-24 mx-auto  h-screen pb-2 bg-indigo-700 border-r-1 justify-between flex-col overflow-hidden md:flex">
            <div class="w-full py-4 mx-auto flex px-2 flex-col justify-center text-center items-center">
                <a href="/">
                    <div class="flex-shrink-0 mt-2 justify-centertext-center mx-auto items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="69px" height="20px">
                            <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                  d="M57.964,14.130 C58.057,14.960 58.283,15.578 58.639,15.984 C59.141,16.568 59.795,16.861 60.602,16.861 C61.111,16.861 61.596,16.734 62.054,16.480 C62.335,16.319 62.636,16.035 62.959,15.629 L68.068,16.099 C67.287,17.453 66.344,18.425 65.240,19.013 C64.135,19.602 62.551,19.896 60.487,19.896 C58.695,19.896 57.284,19.644 56.257,19.140 C55.229,18.637 54.377,17.836 53.702,16.740 C53.027,15.644 52.689,14.355 52.689,12.873 C52.689,10.765 53.366,9.059 54.721,7.755 C56.076,6.451 57.947,5.799 60.334,5.799 C62.271,5.799 63.800,6.091 64.921,6.675 C66.042,7.260 66.896,8.106 67.482,9.215 C68.068,10.325 68.362,11.768 68.362,13.546 L68.362,14.130 L57.964,14.130 ZM62.277,9.507 C61.840,9.076 61.264,8.860 60.551,8.860 C59.727,8.860 59.068,9.186 58.576,9.838 C58.261,10.244 58.062,10.849 57.977,11.654 L63.086,11.654 C62.984,10.655 62.715,9.939 62.277,9.507 ZM46.406,6.104 L51.592,6.104 L51.592,19.591 L46.406,19.591 L46.406,6.104 ZM46.406,0.973 L51.592,0.973 L51.592,4.491 L46.406,4.491 L46.406,0.973 ZM35.939,19.591 L30.311,6.104 L35.707,6.104 L38.332,14.651 L41.056,6.104 L46.289,6.104 L40.538,19.591 L35.939,19.591 ZM29.730,17.908 C28.349,19.233 26.440,19.896 24.002,19.896 C21.827,19.896 20.069,19.346 18.727,18.245 C17.079,16.882 16.255,15.095 16.255,12.886 C16.255,10.828 16.951,9.133 18.345,7.799 C19.738,6.466 21.619,5.799 23.989,5.799 C26.699,5.799 28.746,6.582 30.131,8.149 C31.244,9.410 31.800,10.964 31.800,12.809 C31.800,14.884 31.110,16.583 29.730,17.908 ZM25.863,10.212 C25.378,9.641 24.779,9.355 24.066,9.355 C23.310,9.355 22.685,9.645 22.193,10.225 C21.700,10.805 21.454,11.688 21.454,12.873 C21.454,14.075 21.698,14.964 22.186,15.540 C22.675,16.116 23.289,16.403 24.028,16.403 C24.775,16.403 25.389,16.120 25.869,15.553 C26.349,14.985 26.589,14.075 26.589,12.822 C26.589,11.654 26.347,10.784 25.863,10.212 ZM12.781,18.754 C11.639,19.524 10.176,19.908 8.392,19.908 C6.506,19.908 5.045,19.655 4.009,19.147 C2.972,18.639 2.171,17.896 1.607,16.918 C1.042,15.940 0.708,14.731 0.606,13.292 L6.124,12.543 C6.132,13.364 6.204,13.974 6.340,14.371 C6.476,14.769 6.705,15.091 7.028,15.337 C7.249,15.498 7.564,15.578 7.971,15.578 C8.617,15.578 9.090,15.339 9.392,14.861 C9.693,14.383 9.844,13.577 9.844,12.444 L9.844,0.973 L15.629,0.973 L15.629,11.088 C15.629,13.212 15.440,14.828 15.062,15.936 C14.684,17.045 13.924,17.984 12.781,18.754 Z"/>
                        </svg>
                    </div>
                </a>
                <div class="flex-1 mt-4 w-full">
                    <!-- Current: "bg-indigo-800 text-white", Default: "text-indigo-100 hover:bg-indigo-800 hover:text-white" -->
                    <a href="/admin" class="text-neutral-50 hover:bg-indigo-700 active:bg-indigo-700 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!--
                          Heroicon name: outline/home

                          Current: "text-white", Default: "text-indigo-300 group-hover:text-white"
                        -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-neutral-300 group-hover:text-white h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="mt-2">Admin</span>
                    </a>
                    <a href="/dashboard" class="text-neutral-50 hover:bg-indigo-600 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!--
                          Heroicon name: outline/home

                          Current: "text-white", Default: "text-indigo-300 group-hover:text-white"
                        -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-neutral-300 group-hover:text-white h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="mt-2">Dashboard</span>
                    </a>

                    <a href="/discovery" class="text-white hover:bg-indigo-600 rounded-lg group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!-- Heroicon name: outline/view-grid -->
                        <svg class="text-neutral-300 group-hover:text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="mt-2">Search</span>
                    </a>

                    <a href="/outreach" class="text-neutral-100 hover:bg-neutral-800 hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!-- Heroicon name: outline/user-group -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="mt-2">Outreach</span>
                    </a>


                    <a href="/campaigns" class="text-neutral-50 hover:bg-indigo-600 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium" aria-current="page">
                        <!-- Heroicon name: outline/photograph -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-neutral-300 group-hover:text-white h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                        </svg>
                        <span class="mt-2">Campaigns</span>
                    </a>

                    <a href="/crm" class="text-neutral-50 hover:bg-indigo-600 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!-- Heroicon name: outline/user-group -->
                        <svg class="text-neutral-300 group-hover:text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="mt-2">CRM</span>
                    </a>

                    <a href="/analytics" class="text-neutral-50 hover:bg-indigo-600 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!-- Heroicon name: outline/collection -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-neutral-300 group-hover:text-white h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="mt-2">Analytics</span>
                    </a>
                    <a href="" class="text-neutral-50 hover:bg-indigo-600 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!-- Heroicon name: outline/cog -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-neutral-300 group-hover:text-white h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="mt-2">Import</span>
                    </a>
                    <a href="/profile" class="text-neutral-50 hover:bg-indigo-600 rounded-lg hover:text-white group w-full p-3 flex flex-col items-center text-xs font-medium">
                        <!-- Heroicon name: outline/cog -->
                        <svg class="text-neutral-300 group-hover:text-white h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="mt-2">Settings</span>
                    </a>

                </div>
            </div>
            <div class="flex  text-[8px] justify-between mx-auto  border-indigo-600 border-t mt-4 py-1 px-2">
                <div class="flex divide-x-1 gap-2 d justify-right">
                    <div class="text-neutral-400 hover:text-neutral-200"><a href="/privacy">Privacy</a></div>
                    <div class="text-neutral-400 hover:text-neutral-200"><a href="/terms">Terms</a></div>
                </div>
            </div>
        </div>
        <!-- end sidebar -->
        <!-- Static sidebar for desktop -->


        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="relative z-30 flex-shrink-0 flex h-10 bg-white border-1 border-b">
                <button id="showSidebar" class="px-4 border-r border-neutral-200 text-neutral-300 focus-active:outline-none focus-active:ring-2 focus-active:ring-inset focus-active:ring-indigo-500 md:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <!-- Heroicon name: outline/menu-alt-2 -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <div class="flex-1 px-2 flex justify-between">
                    <div class="flex-1 flex text-left">
                        <div class="ml-0 px-4 py-2 sm:px-6 md:px-8 text-left text-sm font-semibold text-indigo-600">
                            Crm
                        </div>

                        <!--< <form class="w-full flex md:ml-0" action="#" method="GET">
                         <label for="search-field" class="sr-only">Search</label>
                         <div class="relative w-full text-neutral-400 focus-active-within:text-neutral-600">
                             <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">

                                 <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                     <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                 </svg>
                             </div>
                             <input id="search-field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-neutral-900 placeholder-neutral-500 focus-active:outline-none focus-active:placeholder-neutral-400 focus-active:ring-0 focus-active:border-transparent sm:text-sm" placeholder="Search" type="search" name="search">
                         </div>
                     </form>-->
                    </div>

                    <div class="ml-4 flex items-center md:ml-6">
                        <a href="#"><button type="button" class="inline-flex mr-2 font-bold items-center px-4 py-1 border border-transparent text-xs font-medium rounded text-indigo-600 hover:text-indigo-700 hover:decoration-indigo-700 focus-active:outline-none focus-active:ring-2 focus-active:ring-offset-2 focus-active:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </button>
                        </a>
                        <!-- <button class="bg-white p-1 rounded-full text-neutral-400 hover:text-neutral-500 focus-active:outline-none focus-active:ring-2 focus-active:ring-offset-2 focus-active:ring-indigo-500">
                             <span class="sr-only">View notifications</span>

                             <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                             </svg>
                         </button>
                     -->

                        <!-- Profile dropdown -->
                        <div class="ml-3 relative border-l border-1 px-4">
                            <div>
                                <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus-active:outline-none focus-active:ring-2 focus-active:ring-offset-2 focus-active:ring-indigo-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=&color=7F9CF5&background=EBF4FF" />
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
                            <div active="bg-neutral-100" id="profileDropdown" class="origin-top-right d-none absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus-active:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <!-- Active: "bg-neutral-100", Not Active: "" -->
                                <a href="#" class="block px-4 py-2 text-sm font-bold text-neutral-700 border-b-2 border-opacity-30 text-center" role="menuitem" tabindex="-1" id="user-menu-item-0">Hi !</a>
                                <a href="/billing" class="hover:bg-neutral-100 block px-4 py-2 text-sm text-neutral-700" role="menuitem" tabindex="-1">Billing</a>
                                <a href="" class="hover:bg-neutral-100 block px-4 py-2 text-sm text-neutral-700" role="menuitem" tabindex="-1">Settings</a>

                                <form action="" method="get" class="hover:bg-neutral-100">
                                    <button type="submit" class="block px-4 py-2 text-sm text-neutral-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="flex-1 relative overflow-y-auto focus-active:outline-none" id="main">
                <!-- This example requires Tailwind CSS v2.0+ -->
<!--                <div class="relative bg-green-500" id="success_message">-->
<!--                    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">-->
<!--                        <div class="pr-16 sm:text-center sm:px-16">-->
<!--                            <p class="font-medium text-white">-->
<!--                                <span class="md:hidden">-->
<!--                                    {{ session('success') }}-->
<!--                                </span>-->
<!--                                <span class="hidden md:inline">-->
<!--                                    {{ session('success') }}-->
<!--                                </span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="relative bg-neutral-200" id="error_message">-->
<!--                    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">-->
<!--                        <div class="pr-16 sm:text-center sm:px-16">-->
<!--                            <p class="font-medium text-red-800">-->
<!--                                <span class="md:hidden">-->
<!--                                    {{ session('error') }}-->
<!--                                </span>-->
<!--                                <span class="hidden md:inline">-->
<!--                                    {{ session('error') }}-->
<!--                                </span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="h-full">

                    <div class="h-full">
                        <router-view></router-view>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>
