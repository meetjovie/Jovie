<template>
   <div class="min-h-screen max-h-screen items-top sm:items-center overflow-hidden flex justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mt-8 pt-8 sm:mt-0 items-center space-y-8">
        <div>
            <img class="block-inline mt-0 w-48 sm:w-64 2xl:w-80 2xL:w-auto mx-auto object-cover object-center rounded-full"
                 src="https://dg92ahvx2f33l.cloudfront.net/3577fc0d-a391-4b13-ba3e-c641f673574d/images/20210805-a75842e239d7.png" alt="">
            <div class="flex mx-auto mt-6 2xl:mt-12">
                <h2 class="flex mx-auto text-3xl font-extrabold text-gray-900">
                    {{name}}Tim White

                    <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-600 -mr-5 h-5 w-5" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                </h2>
            </div>
            <p class="mt-2 text-center text-sm text-gray-600">
                Founder
                <a href="http:/jov.ie" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Jovie
                </a>
            </p>
        </div>

        <div class="mt-2 2xl:mt-8">


            <fieldset class="mt-0 2xl:mt-2">
                <legend class="sr-only">
                    Choose a size
                </legend>
                <div class="grid items-center grid-cols-3 gap-3 sm:grid-cols-6">



                    <div class="border rounded-md py-3 px-3 opacity-50 hover:opacity-100  hover:bg-gray-100 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                        <a href="https://youtube.com/timwhite">
                            <svg class="w-5 h-5 " role="img" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><title>YouTube</title>
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="border rounded-md py-3 px-3 opacity-50 hover:opacity-100  hover:bg-gray-100 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                        <a href="https://tiktok.com/itstimwhite">
                            <svg class="w-5 h-5 " role="img" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><title>TikTok</title>
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="border rounded-md py-3 opacity-50 hover:opacity-100  px-3 hover:bg-gray-100 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                        <a href="https://twitter.com/itstimwhite">
                            <svg class="w-5 h-5 " role="img" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><title>Twitter</title>
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="border rounded-md py-3 px-3 opacity-50 hover:opacity-100 hover:bg-gray-100 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                        <a href="https://instagram.com/timwhite">
                            <svg class="w-5 h-5 " role="img" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><title>Instagram</title>
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="border rounded-md opacity-50 hover:opacity-100  py-3 px-3 hover:bg-gray-100 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                        <a href="https://open.spotify.com/artist/4Uwpa6zW3zzCSQvooQNksm">
                            <svg class="w-5 h-5 " role="img" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><title>Spotify</title>
                                <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="border opacity-50 hover:opacity-100 rounded-md py-3 px-3 hover:text-gray-100 hover:bg-gray-100 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                        <a href="https://music.apple.com/us/artist/tim-white/859547284">
                            <svg class="w-5 h-5 " role="img" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><title>Apple</title>
                                <path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.559-1.701"/>
                            </svg>
                        </a>

                    </div>
                    <!--
                      In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                      Active: "ring-2 ring-offset-2 ring-indigo-500"
                      Checked: "bg-indigo-600 border-transparent text-white hover:bg-indigo-700", Not Checked: "bg-white border-gray-200 text-gray-900 hover:bg-gray-50"
                    -->


                    <!--
                      In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                      Active: "ring-2 ring-offset-2 ring-indigo-500"
                      Checked: "bg-indigo-600 border-transparent text-white hover:bg-indigo-700", Not Checked: "bg-white border-gray-200 text-gray-900 hover:bg-gray-50"
                    -->


                    <!--
                      In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                      Active: "ring-2 ring-offset-2 ring-indigo-500"
                      Checked: "bg-indigo-600 border-transparent text-white hover:bg-indigo-700", Not Checked: "bg-white border-gray-200 text-gray-900 hover:bg-gray-50"
                    -->

                </div>
            </fieldset>
        </div>

      
            


            <div>
                <div class="mt-3 relative rounded-md">
                    <div class="absolute -mb-4 inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <div class="flex items-center text-center">

                        <input type="text" name="email" id="email"
                               class="mt-4 focus:ring-indigo-500 py-3 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                               placeholder="you@example.com">

                </div>
                </div>
            </div>


            <a href="https://my.community.com/timwhite">
                <button type="submit"
                        class="mt-2 w-full mb-0 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Subscribe
                </button>
            </a>
        
            <div class="border-gray-400 opacity-20 border-t-2">

            </div>
            <a class="text-center mt-1 group  py-4 text-sm text-gray-500 " href="https://jov.ie/creators">
                <div class="flex items-center mt-4 mx-auto text-center justify-center">
                  <JovieLogo iconColor="black" height="20px" class="opacity-20 group-hover:opacity-100" />
                </div>
                <div class="cursor-pointer w-full pb-4 group-hover:opacity-50 opacity-20 bottom-0 items-center font-semibold text-gray-900 ">
                    Get your profile
                </div>

            </a>
    </div>
</div>

</template>
<script>
import JovieLogo from '../components/JovieLogo'
export default {
    name: "CreatorProfile",
    components: {JovieLogo},
    data() {
        return {
            profile: {
                name: 'Tim White',
                avatar: 'http://placehold.it/200x200',
                link1: 'https://instagram.com/timwhite',
                link2: 'https://twitter.com/itstimwhite',
                link3: 'https://tiktok.com/@itstimwhite',
                link4: 'https://youtube.com/timwhite',
            },
        }
    },
}
</script>