
<template>
<div class="min-h-screen">

  <div class="min-h-full flex">
      <div class="hidden lg:block relative w-0 flex-1">
      <div class="absolute inset-0 min-h-screen w-full bg-indigo-700 justify-center items-center px-8 py-12">
          <div class="flex  justify-center items-center px-8 py-2 rounded-md shadown-sm">
              <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 sm:pt-20 sm:pb-24 lg:max-w-7xl lg:pt-24 lg:px-8">
      <h2 class="text-3xl font-extrabold text-white tracking-tight">Scale your <span class="underline decoration-pink-500">creator partnerships</span></h2>
      <p class="mt-4 max-w-3xl text-lg text-indigo-200">Jovie gives you the tools to build, manage, & grow creator communities at scale</p>
                
                <div>
                    <div class="items-center mt-8">
                        <div class="text-indigo-100 font-xs flex-inline px-6 xl:px-12 py-4"><CheckIcon class="inline h5 w-5 mr-4" />Discover creators with AI powered search tools</div>
                        <div class="text-indigo-100 font-xs flex-inline px-6 xl:px-12 py-4"><CheckIcon class="inline h5 w-5 mr-4" />Manage your relationships with a CRM built for the creator economy</div>
                        <div class="text-indigo-100 font-xs flex-inline px-6 xl:px-12 py-4"><CheckIcon class="inline h5 w-5 mr-4" />Automate & track your entire pipeline</div>
                    </div>
                </div>
                </div>
          </div>
      </div>
    </div>
    <div class="flex-1 flex min-h-screen flex-col justify-center items-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full sm:pb-40 max-w-sm lg:w-96">
        <div>
         <JovieLogo :height="40" />
          <div class="text-center mt-8">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Request pricing</h2>
        <p class="mt-4 text-sm leading-6 text-gray-500">There are many factors that influence pricing. We just need a few details about your use case and we can get you pricing details that fit your exact needs.</p>
      </div>
        </div>

        <div class="mt-8">
          

          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6">
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>
                <div class="mt-1">
                  <input id="email" name="email" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus-visible:outline-none focus-visible:ring-indigo-500 focus-visible:border-indigo-500 sm:text-sm" />
                </div>
              </div>

             

              

              <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500">Request pricing</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
</template>
<script>
import JovieLogo from '../components/JovieLogo.vue'
import { CheckIcon } from '@heroicons/vue/outline'

export default {
    components: {
        JovieLogo,
        CheckIcon
    },
    data() {
        return {
            waitListEmail: '',
            error: null
        }
    },
    methods: {
        async requestDemo() {
            await UserService.addToWaitList({email: this.waitListEmail}).then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('setAddedToWaitList')
                    this.waitListEmail = ''
                    this.error = null
                    this.$router.push('demo')
                }
            }).catch(error => {
                error = error.response
                if (error.status == 422) {
                    this.error = error.data.errors.email[0]
                }
            })
        }
    }
}
</script>

