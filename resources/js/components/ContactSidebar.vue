<template>
  <div class="h-screen w-full bg-white dark:bg-jovieDark-900">
    <div
      class="flex h-full flex-col justify-between overflow-auto"
      v-if="user.loggedIn">
      <!--  <div
              v-if="!jovie"
              class="absolute top-2 right-2 w-full justify-end text-right text-xs font-bold text-slate-400 hover:text-slate-500 dark:text-jovieDark-600 dark:hover:text-slate-400">
              <a href="https://jov.ie" target="_blank">Jovie</a>
            </div> -->
      <div class="flex-none">
        <div class="absolute right-1 top-1">
          <XMarkIcon
            @click="closeContactSidebar()"
            class="h-4 w-4 cursor-pointer rounded-full text-slate-400 transition-all duration-150 hover:text-slate-600 active:bg-slate-200 active:text-slate-700 dark:text-jovieDark-600 dark:hover:text-slate-400 dark:active:bg-slate-800 dark:active:text-slate-300" />
        </div>

        <div class="grid grid-cols-3">
          <div class="px-1">
            <!--  <svg
                      v-if="creator.verified"
                      xmlns="http://www.w3.org/2000/svg"
                      class="relative top-8 left-20 h-4 w-4 text-slate-600"
                      viewBox="0 0 20 20"
                      fill="currentColor">
                      <path
                        fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg> -->
            <img
              v-if="imageLoaded && creator.profile_pic_url"
              id="profile-img-jovie"
              @error="switchToDefaultImage"
              class="h-18 w-18 object-fit mt-2 aspect-square rounded-full border-4 border-slate-200 object-center dark:border-jovieDark-border"
              :src="creator.profile_pic_url" />
          </div>
          <div class="col-span-2 mt-6 pl-1 pr-2">
            <input
              @blur="$emit('updateCrmMeta')"
              v-model="creator.meta.name"
              placeholder="Name"
              class="w-full rounded-md border border-slate-300 border-opacity-0 px-1 text-lg font-bold text-slate-700 transition line-clamp-1 placeholder:text-slate-300/0 hover:border-opacity-100 hover:bg-slate-100 hover:placeholder:text-slate-500 dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-300 dark:text-jovieDark-300 dark:hover:bg-jovieDark-800" />
            <!-- <div class="">
                      <input
                        @blur="saveToCrm()"
                        placeholder="Title"
                        class="w-auto rounded-md border border-slate-300 dark:border-jovieDark-border border-slate-700 border-opacity-0 px-1 text-xs font-bold text-slate-700 dark:text-jovieDark-300 transition line-clamp-1 placeholder:text-slate-300/0 hover:border-opacity-100 hover:bg-slate-100 hover:placeholder:text-slate-500" />

                      <input
                        @blur="saveToCrm()"
                        placeholder="Company"
                        class="w-full rounded-md border border-slate-300 dark:border-jovieDark-border border-slate-700 border-opacity-0 px-1 text-2xs font-semibold text-slate-400 transition line-clamp-1 placeholder:text-slate-300/0 hover:border-opacity-100 hover:bg-slate-100 hover:placeholder:text-slate-500" />
                    </div> -->
            <div v-if="creator.category" class="">
              <span
                class="inline-flex items-center rounded-md bg-indigo-100 px-2.5 py-0.5 text-2xs font-medium text-indigo-800 dark:bg-indigo-800 dark:text-indigo-200">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="-ml-0.5 mr-1.5 h-2 w-2 text-indigo-400"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                {{ creator.category }}
              </span>
            </div>

            <div
              @click="toggleExpandBio()"
              class="w-full cursor-pointer whitespace-pre-wrap text-2xs text-slate-700 transition-all dark:text-jovieDark-300"
              :class="{
                'h-12 line-clamp-5': expandBio,
                'h-8 line-clamp-2': !expandBio,
              }">
              {{ creator.biography }}
            </div>
          </div>
        </div>
        <div class="overflow-y-scoll grid grid-cols-6 py-2 px-4">
          <div>
            <SocialIcons
              v-if="creator.instagram_handler || creator.meta.instagram_handler"
              @click="editSocialNetworkURL('instagram', creator)"
              icon="instagram"
              :linkDisabled="
                !creator.instagram_handler || !creator.meta.instagram_handler
              "
              :link="
                creator.instagram_handler || creator.meta.instagram_handler
              "
              :followers="formatCount(creator.instagram_followers)"
              height="14"
              width="14"
              class="h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true"
              :countsVisible="false" />
            <div
              @click="editSocialNetworkURL('instagram', creator)"
              class="group cursor-pointer text-center"
              v-else>
              <SocialIcons
                icon="instagram"
                linkDisabled
                :class="{
                  'group-hover:hidden': !socialURLEditing,
                  'group-hover:block': socialURLEditing,
                }"
                :link="
                  creator.instagram_handler || creator.meta.instagram_handler
                "
                height="14"
                width="14"
                class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                aria-hidden="true"
                :countsVisible="false" />
              <PlusIcon
                :class="{
                  'group-hover:hidden': socialURLEditing,
                  'group-hover:block': !socialURLEditing,
                }"
                class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700 dark:text-jovieDark-300" />
            </div>
          </div>
          <div>
            <SocialIcons
              v-if="creator.twitter_handler || creator.meta.twitter_handler"
              @click="editSocialNetworkURL('twitter', creator)"
              icon="twitter"
              :linkDisabled="
                !creator.twitter_handler || !creator.meta.twitter_handler
              "
              :link="creator.twitter_handler || creator.meta.twitter_handler"
              :followers="formatCount(creator.twitter_followers)"
              height="14"
              width="14"
              class="h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true"
              :countsVisible="false" />
            <div
              @click="editSocialNetworkURL('twitter', creator)"
              class="group cursor-pointer text-center"
              v-else>
              <SocialIcons
                icon="twitter"
                linkDisabled
                :class="{
                  'group-hover:hidden': !socialURLEditing,
                  'group-hover:block': socialURLEditing,
                }"
                :link="creator.twitter_handler || creator.meta.twitter_handler"
                height="14"
                width="14"
                class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                aria-hidden="true"
                :countsVisible="false" />

              <PlusIcon
                :class="{
                  'group-hover:hidden': socialURLEditing,
                  'group-hover:block': !socialURLEditing,
                }"
                class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700" />
            </div>
          </div>
          <div>
            <SocialIcons
              v-if="creator.twitch_handler || creator.meta.twitch_handler"
              @click="editSocialNetworkURL('twitch', creator)"
              icon="twitch"
              :linkDisabled="
                !creator.twitch_handler || !creator.meta.twitch_handler
              "
              :link="creator.twitch_handler || creator.meta.twitch_handler"
              :followers="formatCount(creator.twitch_followers)"
              height="14"
              width="14"
              class="h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true"
              :countsVisible="false" />
            <div
              @click="editSocialNetworkURL('twitch', creator)"
              class="group cursor-pointer text-center"
              v-else>
              <SocialIcons
                icon="twitch"
                :linkDisabled="
                  !creator.twitch_handler || !creator.meta.twitch_handler
                "
                :class="{
                  'group-hover:hidden': !socialURLEditing,
                  'group-hover:block': socialURLEditing,
                }"
                :link="creator.twitch_handler || creator.meta.twitch_handler"
                height="14"
                width="14"
                class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                aria-hidden="true"
                :countsVisible="false" />
              <PlusIcon
                :class="{
                  'group-hover:hidden': socialURLEditing,
                  'group-hover:block': !socialURLEditing,
                }"
                class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700" />
            </div>
          </div>
          <div>
            <SocialIcons
              v-if="creator.tiktok_handler || creator.meta.tiktok_handler"
              @click="editSocialNetworkURL('tiktok', creator)"
              icon="tiktok"
              :linkDisabled="
                !creator.tiktok_handler || !creator.meta.tiktok_handler
              "
              :link="creator.tiktok_handler || creator.meta.tiktok_handler"
              :followers="formatCount(creator.tiktok_followers)"
              height="14"
              width="14"
              class="h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true"
              :countsVisible="false" />
            <div
              @click="editSocialNetworkURL('tiktok', creator)"
              class="group cursor-pointer text-center"
              v-else>
              <SocialIcons
                icon="tiktok"
                linkDisabled
                :class="{
                  'group-hover:hidden': !socialURLEditing,
                  'group-hover:block': socialURLEditing,
                }"
                :link="creator.tiktok_handler || creator.meta.tiktok_handler"
                height="14"
                width="14"
                class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                aria-hidden="true"
                :countsVisible="false" />
              <PlusIcon
                :class="{
                  'group-hover:hidden': socialURLEditing,
                  'group-hover:block': !socialURLEditing,
                }"
                class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700" />
            </div>
          </div>
          <div>
            <SocialIcons
              @click="editSocialNetworkURL('youtube', creator)"
              v-if="creator.youtube_handler || creator.meta.youtube_handler"
              icon="youtube"
              :linkDisabled="
                !creator.youtube_handler || !creator.meta.youtube_handler
              "
              :link="creator.youtube_handler || creator.meta.youtube_handler"
              :followers="formatCount(creator.youtube_followers)"
              height="14"
              width="14"
              class="h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true"
              :countsVisible="false" />
            <div
              @click="editSocialNetworkURL('youtube', creator)"
              class="group cursor-pointer text-center"
              v-else>
              <SocialIcons
                icon="youtube"
                linkDisabled
                :class="{
                  'group-hover:hidden': !socialURLEditing,
                  'group-hover:block': socialURLEditing,
                }"
                :link="creator.youtube_handler || creator.meta.youtube_handler"
                height="14"
                width="14"
                class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                aria-hidden="true"
                :countsVisible="false" />
              <PlusIcon
                :class="{
                  'group-hover:hidden': socialURLEditing,
                  'group-hover:block': !socialURLEditing,
                }"
                class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700" />
            </div>
          </div>
          <div>
            <SocialIcons
              @click="editSocialNetworkURL('linkedin', creator)"
              v-if="creator.linkedin_handler || creator.meta.linkedin_handler"
              icon="linkedin"
              :linkDisabled="
                !creator.linkedin_handler || !creator.meta.linkedin_handler
              "
              :link="creator.linkedin_handler || creator.meta.linkedin_handler"
              :followers="formatCount(creator.linkedin_followers)"
              height="14"
              width="14"
              class="h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true"
              :countsVisible="false" />
            <div
              @click="editSocialNetworkURL('linkedin', creator)"
              class="group cursor-pointer text-center"
              v-else>
              <SocialIcons
                icon="linkedin"
                linkDisabled
                :class="{
                  'group-hover:hidden': !socialURLEditing,
                  'group-hover:block': socialURLEditing,
                }"
                :link="
                  creator.linkedin_handler || creator.meta.linkedin_handler
                "
                height="14"
                width="14"
                class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                aria-hidden="true"
                :countsVisible="false" />
              <PlusIcon
                :class="{
                  'group-hover:hidden': socialURLEditing,
                  'group-hover:block': !socialURLEditing,
                }"
                class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700" />
            </div>
          </div>
        </div>
        <TransitionRoot
          :show="socialURLEditing"
          enter="transition ease-out duration-300"
          enter-from="opacity-0 -translate-y-1/2"
          enter-to="opacity-100 translate-y-0"
          leave="transition ease-in duration-300"
          leave-from="opacity-100 translate-y-0"
          leave-to="opacity-0 -translate-y-1/2">
          <div>
            <SocialInput
              :socialMediaProfileUrl="socialMediaProfileUrl"
              @finishImport="saveSocialNetworkURL"
              @saveSocialNetworkURL="saveSocialNetworkURL()"
              @cancelEdit="cancelEdit()"
              minimalDesign />
          </div>
        </TransitionRoot>

        <hr
          class="border border-slate-100 text-slate-300 dark:border-jovieDark-border dark:text-jovieDark-700" />

        <div class="px-4 py-2">
          <ButtonGroup
            v-if="!creator.id"
            :text="buttonText"
            :loading="saving"
            :success="creator.saved ?? false"
            @click="saveToCrm()"
            class="w-full rounded-md py-2 px-4 font-bold text-white hover:bg-indigo-600" />
          <div class="flex" v-else>
            <Menu>
              <Float portal :offset="2" placement="bottom-start">
                <MenuButton
                  class="inline-flex items-center rounded border border-slate-300 py-0.5 px-2 text-2xs font-light text-slate-700 hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30 dark:border-jovieDark-border dark:border-jovieDark-border dark:text-jovieDark-300 dark:hover:bg-jovieDark-800">
                  <ChatBubbleLeftIcon
                    class="h-3 w-3 text-slate-400 hover:text-slate-500 dark:text-jovieDark-600 dark:hover:text-slate-400"
                    aria-hidden="true" />
                  <span class="px-2 text-center line-clamp-1">Message</span>
                  <ChevronDownIcon
                    class="-mr-1 h-4 w-4 text-slate-400 hover:text-slate-500 dark:text-jovieDark-600 dark:hover:text-slate-400"
                    aria-hidden="true" />
                </MenuButton>
                <transition
                  enter-active-class="transition duration-100 ease-out"
                  enter-from-class="transform scale-95 opacity-0"
                  enter-to-class="transform scale-100 opacity-100"
                  leave-active-class="transition duration-75 ease-in"
                  leave-from-class="transform scale-100 opacity-100"
                  leave-to-class="transform scale-95 opacity-0">
                  <MenuItems
                    class="z-10 mt-2 w-48 origin-top-right rounded-md border border-slate-300 bg-white/60 py-1 px-1 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none dark:border-jovieDark-border dark:bg-jovieDark-900/60">
                    <div class="py-1">
                      <ContactContextMenuItem
                        :creator="creator"
                        :contactMethods="[
                          'email',
                          'sms',
                          'instagram',
                          'calendar',
                          'twitter',
                          'phone',
                          'whatsapp',
                        ]">
                      </ContactContextMenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Float>
            </Menu>
          </div>
        </div>
        <div class="px-2">
          <!--  <h2 class="text-xs font-semibold text-slate-600 dark:text-jovieDark-400">Lists</h2> -->
          <InputLists
            v-if="creator.id"
            @updateLists="updateCreatorLists"
            :creatorId="creator.id ?? 0"
            :lists="creator.lists"
            :currentList="creator.current_list" />
        </div>
      </div>
      <div class="grow overflow-y-scroll">
        <div class="mt-4 mb-2 flex w-full items-center justify-between px-2">
          <div class="items-center">
            <h2
              class="text-xs font-semibold text-slate-600 dark:text-jovieDark-400">
              Contact Details
            </h2>
          </div>
          <div>
            <CustomFieldsMenu @getFields="getFields" @getHeaders="$emit('getHeaders')" />
          </div>
        </div>
        <div
          class="h-full items-center px-2 text-center"
          v-if="jovie && !creator.id">
          <div
            class="mx-auto text-center text-slate-400 dark:text-jovieDark-600">
            No contact selected
          </div>
        </div>
        <div
          class="h-full items-center px-2 text-center"
          v-if="!jovie && !creator.id">
          <div
            class="mx-auto text-center text-slate-400 dark:text-jovieDark-600">
            Save this profile to edit contact details
          </div>
        </div>
        <div v-else class="relative h-full">
          <div
            class="flex h-full flex-col justify-between"
            :class="{
              ' blur-sm saturate-150 ': !creator.id,
            }">
            <div class="mt-2 h-full space-y-6 overflow-y-scroll px-2">
              <draggable
                v-if="fieldsLoaded"
                class="select-none space-y-4"
                group="lists"
                ghost-class="ghost-card"
                :creator="creator"
                @end="sortFields"
                :list="fields">
                <!-- v-if for element.model check for default field as they would already be modeled-->
                <div
                  class="space-y-6"
                  v-for="(element, index) in fields"
                  :id="element.id"
                  :data-custom="element.custom"
                  :key="element.id">
                  <template v-if="element.custom">
                    <CustomField
                      @blur="
                        $emit('updateCreator', {
                          id: creator.id,
                          index: creator.index,
                          key: `crm_record_by_user.${element.code}`,
                          value: creator.crm_record_by_user[element.code],
                        })
                      "
                      :name="element.name"
                      :description="element.description"
                      :type="element.type"
                      :options="element.custom_field_options"
                      v-model="creator.crm_record_by_user[element.code]" />
                  </template>
                  <template v-else>
                    <DataInputGroup
                      @copy="copyToClipboard(element.value)"
                      class="group/draggable"
                      @actionMethod="
                        actionMethod(element.method, element.params)
                      "
                      @actionMethod2="
                        actionMethod(element.method2, element.params2)
                      "
                      v-model="creator.meta[element.model]"
                      @blur="updateCrmMeta"
                      :id="element.name"
                      :icon="element.icon"
                      :socialicon="element.socialicon"
                      :label="element.name"
                      :disabled="!creator.id"
                      :action="element.actionIcon"
                      :action2="element.actionIcon2"
                      :isCopyable="element.isCopyable"
                      :placeholder="element.location" />
                  </template>
                </div>
              </draggable>
              <div class="select-none space-y-4" v-else>
                <div class="select-none space-y-4" v-for="n in 10" :key="n">
                  <div class="space-y-6">
                    <div
                      class="h-9 animate-pulse rounded-md bg-slate-50 text-center text-slate-400 dark:text-jovieDark-600" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            v-if="!creator.id"
            class="absolute top-24 z-30 mx-auto w-full text-center text-sm font-semibold text-slate-800 dark:text-jovieDark-200">
            Save this profile to edit contact details
          </div>
        </div>
      </div>

      <!--  <div class="grid mt-2 border-b pb-2 px-2 grid-cols-3">
              <div class="mx-auto">
                <div class="text-center text-md text-indigo-400 font-bold">34M</div>
                <div class="text-center text-[8px] text-indigo-600 font-bold">Followers</div>
              </div>
              <div class="mx-auto">
                <div class="text-center text-md text-indigo-400 font-bold">3.4%</div>
                <div class="text-center text-[8px] text-indigo-600 font-bold">Engagement</div>
              </div>
              <div class="mx-auto">
                <div class="text-center text-md text-indigo-400 font-bold">43</div>
                <div class="text-center text-[8px] text-indigo-600 font-bold">EF</div>
              </div>
            </div> -->
      <!-- <div class="grid grid-cols-3">
              <img
                class="object-fit object-cover rounded-md-l"
                src="data:image/jpeg;base64,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"
              />

              <img
                class="object-fit object-cover"
                src="data:image/jpeg;base64,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"
              />

              <img
                class="object-fit object-cover rounded-md-r"
                src="data:image/jpeg;base64,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"
              />
            </div> -->
      <div class="mt-2 bg-white py-2 px-2 dark:bg-jovieDark-900">
        <TextAreaInput
          ref="noteInput"
          v-model="creator.note"
          @blur="updateCreatorNote" />
      </div>
    </div>
    <div class="mx-auto h-full items-center py-2" v-else-if="sidebarLoading">
      <JovieSpinner />
    </div>
    <div v-else>
      <div class="flex">
        <!-- <div class="relative hidden h-screen flex-1 items-center bg-indigo-700 lg:flex">
                  <div class="m-auto flex h-full items-center">
                    <JovieLogo height="48px" color="#fff" />
                  </div>
                </div> -->
        <div
          class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
          <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
              <div class="block lg:hidden">
                <JovieLogo height="28px" />
              </div>
              <h2
                class="mt-6 text-3xl font-extrabold text-slate-900 text-slate-100">
                Sign in
              </h2>
              <p class="mt-2 text-sm text-slate-600">
                Or
                {{ ' ' }}
                <a
                  href="https://jov.ie/signup"
                  target="_blank"
                  class="font-medium text-indigo-600 hover:text-indigo-500">
                  Create an account
                </a>
              </p>

              <ul v-if="error" class="text-red-900">
                <li>{{ error }}</li>
              </ul>
            </div>

            <div class="mt-8">
              <div class="mt-6">
                <form action="#" method="POST" class="space-y-6">
                  <div>
                    <div class="relative mt-1">
                      <InputGroup
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        placeholder="Email"
                        label="Email"
                        required="" />
                      <!--  <p class="mt-2 text-sm text-red-900" v-if="this.errors.email">
                                              {{ this.errors.email[0] }}
                                            </p> -->
                    </div>
                  </div>

                  <div>
                    <div class="relative mt-1">
                      <InputGroup
                        id="password"
                        name="password"
                        label="Password"
                        placeholder="Password"
                        type="password"
                        v-on:keyup.enter="login()"
                        autocomplete="current-password"
                        required="" />
                      <!--  <p class="mt-2 text-sm text-red-900" v-if="this.errors.password">
                                              {{ this.errors.password[0] }}
                                            </p> -->
                    </div>
                  </div>

                  <div>
                    <button
                      :disabled="loggingIn"
                      @click="login()"
                      type="button"
                      class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                      Sign in
                    </button>
                  </div>

                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <input
                        id="remember-me"
                        name="remember-me"
                        type="checkbox"
                        class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:border-jovieDark-border" />
                      <label
                        for="remember-me"
                        class="ml-2 block text-sm text-slate-900 dark:text-jovieDark-100">
                        Remember me
                      </label>
                    </div>

                    <div class="text-sm">
                      <a
                        href="https://jov.ie/forgot-password"
                        target="_blank"
                        class="font-medium text-indigo-600 hover:text-indigo-500">
                        Forgot your password?
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <AuthFooter></AuthFooter>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CustomFieldsMenu from '../components/CustomFieldsMenu.vue';
import SocialInput from '../components/SocialInput.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import JovieLogo from '../components/JovieLogo.vue';
import AuthFooter from '../components/Auth/AuthFooter.vue';
import InputGroup from '../components/InputGroup.vue';
import DataInputGroup from '../components/DataInputGroup.vue';
import JovieSpinner from '../components/JovieSpinner.vue';
import TextAreaInput from '../components/TextAreaInput.vue';
import InputLists from '../components/InputLists.vue';
import { VueDraggableNext } from 'vue-draggable-next';
import ContactContextMenuItem from '../components/ContactContextMenuItem.vue';
import {
  XMarkIcon,
  ChatBubbleLeftIcon,
  PlusIcon,
} from '@heroicons/vue/24/solid';
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  TransitionRoot,
} from '@headlessui/vue';
import SocialIcons from './SocialIcons.vue';
import UserService from '../services/api/user.service';
import { Float } from '@headlessui-float/vue';
import router from '../router';
import store from '../store';
import FieldService from '../services/api/field.service';
import CustomField from './CustomField.vue';

export default {
  name: 'ContactSidebar',
  components: {
    CustomField,
    SocialInput,
    draggable: VueDraggableNext,
    ContactContextMenuItem,
    CustomFieldsMenu,
    ChatBubbleLeftIcon,
    PlusIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    TransitionRoot,
    JovieLogo,
    Float,
    AuthFooter,
    InputGroup,
    JovieSpinner,
    XMarkIcon,
    ButtonGroup,
    DataInputGroup,
    TextAreaInput,
    InputLists,
    SocialIcons,
  },
  watch: {
    creatorsData: function (val) {
      console.log('this.creator');
      this.setCreatorData();
      this.resetImage();
      console.log(val);
    },
  },
  async mounted() {
    // console.log('Sidebar loaded');
    this.$mousetrap.bind('n', () => {
      //prevent default

      this.focusNoteInput();
    });
    document.onreadystatechange = () => {
      if (document.readyState == 'complete') {
        console.log('Page completed with image and files!');
        // fetch to next page or some code
        // this.setCreatorData();
      }
    };
    this.setCreatorData();

    await this.getFields();
  },
  props: {
    creatorsData: {
      type: Object,
      default: {
        meta: {},
      },
    },
    jovie: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      fieldsLoaded: false,
      abortController: null,
      sidebarLoading: false,
      socialURLEditing: false,
      dragging: false,
      instagram_handler: '',
      loader: false,
      expandBio: false,
      savedToJovie: false,
      buttonText: 'Save to Jovie',
      closeSidebar: '',
      imageLoaded: true,
      activeSocialNetworkURLEdit: [],
      user: {
        loggedIn: true,
        name: '',
        email: '',
        password: '',
        passwordConfirm: '',
        errors: [],
      },
      creator: {
        meta: {},
      },
      beFields: [],
      fields: [],
    };
  },
  methods: {
      sortFields(e, listId = '') {
          this.$store.dispatch('sortFields', { self: this, newIndex: e.newIndex, oldIndex: e.oldIndex, custom: e.item.dataset.custom === 'true', listId: listId, itemId: e.item.id })
      },
      getFields() {
      FieldService.getFields(this.creator.id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.fields = response.data;
            // this.beFields.forEach((field, index) => {
            //   let newField = field;
            //   // ['model', 'value', 'params'].forEach((val) => {
            //   //   if (field[val]) {
            //   //     let model = this;
            //   //     field[val].split('.').forEach((att) => {
            //   //       model = model[att];
            //   //     });
            //   //     newField[val] = model;
            //   //   }
            //   // });
            //   // console.log('newFieldnewField');
            //   // console.log(newField);
            //   this.fields.push(newField);
            // });
          }
        })
        .catch((error) => {
          console.log(error);
          return;
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          // this.saving = false;
          this.fieldsLoaded = true;
        });
    },
    updateCreatorLists({ list, add = false }) {
      if (add) {
        if (!this.creator.lists.filter((l) => l.id == list.id).length) {
          this.creator.lists.push(list);
        }
      } else {
        this.creator.lists = this.creator.lists.filter((l) => l.id != list.id);
      }
    },
    focusNoteInput() {
      this.$refs.noteInput.$el.focus();
    },
    openURL(url) {
      window.open(url, '_blank');
    },
    updateCrmMeta() {
      this.$emit('updateCrmMeta');
    },
    fallback() {},
    actionMethod(method, data) {
      if (method) {
        this[method](data);
      }
    },
    sendEmail() {
      alert('email sent');
    },
    triggerAction(action, data) {
      this.action();
      //trigger a function using the action prop

      console.log('triggerAction');
    },
    log(event) {
      console.log(event);
    },
    saveSocialNetworkURL() {
      console.log('saveSocialURL');
      this.socialURLEditing = false;
      //notify the user
      this.$notify({
        group: 'user',
        type: 'success',
        title: 'Link Saved',
        text: 'The new social link has been saved',
      });
    },
    cancelEdit() {
      this.socialURLEditing = false;
      //notify the user
      this.$notify({
        group: 'user',
        type: 'error',
        title: 'Link Not Saved',
        text: 'The new social link has not been saved',
      });
    },
    emailCreator(email) {
      console.log('email');
      email = this.creator.meta.emails[0];
      //go to the url mailto:creator.emails[0]
      //if email is not null
      if (email.length > 0) {
        window.open('mailto:' + email);
        //else log no email found
      } else {
        console.log('No email found');
        this.$notify({
          title: 'No email found',
          message: 'This contact does not have an email address',
          type: 'warning',
          group: 'user',
        });
      }
    },
    openLink(url) {
      console.log('url');
      //go to the url

      //if url is not null
      if (url.length > 0) {
        //else log no url found
      } else {
        console.log('No url found');
        this.$notify({
          title: 'No url found',
          message: 'This contact does not have a url',
          type: 'warning',
          group: 'user',
        });
      }
    },
    callCreator(phone) {
      //go to the url tel:creator.meta.phone
      //if phone is not null
      phone = this.creator.meta.phone || this.creator.phone;
      console.log('Calling contact at:' + phone);
      if (phone) {
        window.open('tel:' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    instagramDMContact(username) {
      //go to the url https://ig.me/m/USERNAME
      //if username is not null
      //else notify the user
      username =
        this.creator.meta.instagram_handler || this.creator.instagram_handler;
      //if username is an instagram link, extract the username
      if (username.includes('instagram.com')) {
        username = username.split('instagram.com/')[1];
      }
      if (username) {
        window.open('https://ig.me/m/' + username);
      } else {
        console.log('No instagram username found');
        this.$notify({
          title: 'No instagram username found',
          message: 'This contact does not have an instagram username',
          type: 'warning',
          group: 'user',
        });
      }
    },
    whatsappCreator(phone) {
      //go to the url tel:creator.meta.phone
      //if phone is not null
      phone = this.creator.meta.phone || this.creator.phone;
      if (phone) {
        console.log('whatsapp');
        //open whatsapp://send?text=Hello World!&phone=+phone
        window.open('whatsapp://send?text=Hey!&phone=+' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    textCreator(phone) {
      //go to the url sms:creator.meta.phone
      //if phone is not null
      phone = this.creator.meta.phone || this.creator.phone;
      if (phone) {
        window.open('sms:' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    saveToCrm() {
      this.saving = true;
      UserService.saveToCrm(this.creator)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.creator.saved = true;
          } else {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.saving = false;
        });
    },
    resetImage() {
      this.imageLoaded = true;
    },
    updateCreatorNote() {
      UserService.updateCreatorNote(this.creator.id, this.creator.note)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          } else {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {});
    },
    editSocialNetworkURL(network, creator) {
      console.log(network);
      console.log(creator);
      this.setNetwork(network);
      this.socialURLEditing = true;
      //focus on  id="social_network_url"
      this.$refs.editInput.focus();
      console.log(this.socialURLEditing);
      /*  this.editingSocialNetworkURL = network;
            console.log('editSocialNetworkURL');


            this.activeSocialNetworkURLEdit = {
              network: network,
              creator: creator,
            };
            this.$emit('editSocialNetworkURL', network, creator); */
    },
    setNetwork(network) {
      console.log(network);
      if (network == 'instagram') {
        this.socialMediaProfileUrl = 'https://instagram.com/';
      } else if (network == 'twitter') {
        this.socialMediaProfileUrl = 'https://twitter.com/';
      } else if (network == 'linkedin') {
        this.socialMediaProfileUrl = 'https://linkedin.com/in/';
      } else if (network == 'youtube') {
        this.socialMediaProfileUrl = 'https://youtube.com/';
      } else if (network == 'tiktok') {
        this.socialMediaProfileUrl = 'https://tiktok.com/@';
      } else if (network == 'twitch') {
        this.socialMediaProfileUrl = 'https://twitch.tv/';
      } else {
        this.socialMediaProfileUrl = '';
      }
    },
    closeContactSidebar() {
      //turn off the sidebar
      this.$store.state.ContactSidebarOpen = false;
    },
    setCreatorData() {
      ///listen for an object from the content script
      try {
        if (this.creatorsData.id) {
          this.creator = this.creatorsData;
        } else {
          let queryParameters = store.state.extensionQuery;
          let image = queryParameters.split('image=')[1];
          const urlParameters = new URLSearchParams(queryParameters);
          let creator = urlParameters.get('creator');
          creator = JSON.parse(decodeURIComponent(creator));

          let cPromise = new Promise(async (resolve, reject) => {
            UserService.getCrmCreatorByHandler({
              network: creator.network,
              username: creator[`${creator.network}_handler`],
            }).then((response) => {
              response = response.data;
              if (response.status) {
                response.creator.network = creator.network;
                resolve(response.creator);
              } else {
                reject();
              }
            });
          });

          cPromise.then(
            (value) => {
              this.creator = value;
              console.log('creator from iframe DB');
              console.log(this.creator);
            },
            () => {
              let promise = new Promise(async (resolve, reject) => {
                if (image && creator.network == 'instagram') {
                  await this.$store
                    .dispatch('uploadTempFileFromUrl', image)
                    .then((response) => {
                      image = response.url;
                      creator.profile_pic_url = image;
                      resolve();
                    });
                } else {
                  creator.profile_pic_url = decodeURIComponent(image);
                  resolve();
                }
              });
              promise.then((response) => {
                if (creator.meta == undefined) {
                  creator.meta = {};
                }
                // for (const property in creator) {
                //   if (property == 'website') {
                //     creator[property] = decodeURIComponent(creator[property]);
                //   }
                // }

                this.creator = creator;
                console.log('creator from iframe');
                console.log(this.creator);
              });
            }
          );
        }
      } catch (e) {
        console.log('eeeeeeeeeeeeeeeeeeeeeeeeeee');
        console.log(e);
      }
    },
    toggleExpandBio() {
      this.expandBio = !this.expandBio;
    },
    imageLoadingError() {
      this.imageLoaded = false;
    },
    copyToClipboard(value) {
      const el = document.createElement('textarea');
      el.value = value;
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);

      this.$notify({
        group: 'user',
        type: 'success',
        duration: 15000,
        title: 'Successful',
        text: 'Copied to clipboard',
      });
    },
  },
};
</script>

<style scoped></style>
