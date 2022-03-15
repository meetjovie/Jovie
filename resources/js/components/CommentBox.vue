<template>
    <div class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <CreatorAvatar
                size="xsm"
                :imageUrl="user.profile_pic_url"
                :name="user.full_name"/>
        </div>
        <div class="min-w-0 flex-1">
            <form action="#" class="relative">
                <div
                    class="overflow-hidden rounded-lg border border-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                    <label for="comment" class="sr-only">Add your comment</label>
                    <textarea
                        rows="3"
                        name="comment"
                        v-model="comment"
                        id="comment"
                        class="block w-full resize-none border-0 py-3 focus:ring-0 sm:text-sm"
                        placeholder="Add your comment..."/>

                    <!-- Spacer element to match the height of the toolbar -->
                    <div class="py-2" aria-hidden="true">
                        <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                        <div class="py-px">
                            <div class="h-9"/>
                        </div>
                    </div>
                </div>

                <div
                    class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                    <div class="flex items-center space-x-5">
                        <div class="flex items-center">
                            <button
                                type="button"
                                class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                                <PaperClipIcon class="h-5 w-5" aria-hidden="true"/>
                                <span class="sr-only">Attach a file</span>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <Listbox as="div" v-model="selected">
                                <ListboxLabel class="sr-only"> Your mood</ListboxLabel>
                                <div class="relative">
                                    <ListboxButton
                                        class="relative -m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                    <span class="flex items-center justify-center">
                      <span v-if="selected.value === null">
                        <EmojiHappyIcon
                            class="h-5 w-5 flex-shrink-0"
                            aria-hidden="true"/>
                        <span class="sr-only"> Add your mood </span>
                      </span>
                      <span v-if="!(selected.value === null)">
                        <div
                            :class="[
                            selected.bgColor,
                            'flex h-8 w-8 items-center justify-center rounded-full',
                          ]">
                          <component
                              :is="selected.icon"
                              class="h-5 w-5 flex-shrink-0 text-white"
                              aria-hidden="true"/>
                        </div>
                        <span class="sr-only">{{ selected.name }}</span>
                      </span>
                    </span>
                                    </ListboxButton>

                                    <transition
                                        leave-active-class="transition ease-in duration-100"
                                        leave-from-class="opacity-100"
                                        leave-to-class="opacity-0">
                                        <ListboxOptions
                                            class="absolute z-10 mt-1 -ml-6 w-60 rounded-lg bg-white py-3 text-base shadow ring-1 ring-black ring-opacity-5 focus:outline-none sm:ml-auto sm:w-64 sm:text-sm">
                                            <ListboxOption
                                                as="template"
                                                v-for="mood in moods"
                                                :key="mood.value"
                                                :value="mood"
                                                v-slot="{ active }">
                                                <li
                                                    :class="[
                            active ? 'bg-gray-100' : 'bg-white',
                            'relative cursor-default select-none py-2 px-3',
                          ]">
                                                    <div class="flex items-center">
                                                        <div
                                                            :class="[
                                mood.bgColor,
                                'flex h-8 w-8 items-center justify-center rounded-full',
                              ]">
                                                            <component
                                                                :is="mood.icon"
                                                                :class="[
                                  mood.iconColor,
                                  'h-5 w-5 flex-shrink-0',
                                ]"
                                                                aria-hidden="true"/>
                                                        </div>
                                                        <span class="ml-3 block truncate font-medium">
                              {{ mood.name }}
                            </span>
                                                    </div>
                                                </li>
                                            </ListboxOption>
                                        </ListboxOptions>
                                    </transition>
                                </div>
                            </Listbox>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <button
                            @click="$emit('addComment', comment)"
                            :disabled="loading || !comment"
                            type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {ref} from 'vue';
import {
    EmojiHappyIcon,
    EmojiSadIcon,
    FireIcon,
    HeartIcon,
    PaperClipIcon,
    ThumbUpIcon,
    XIcon,
} from '@heroicons/vue/solid';
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from '@headlessui/vue';
import CreatorAvatar from "./Creator/CreatorAvatar";

const moods = [
    {
        name: 'Excited',
        value: 'excited',
        icon: FireIcon,
        iconColor: 'text-white',
        bgColor: 'bg-red-500',
    },
    {
        name: 'Loved',
        value: 'loved',
        icon: HeartIcon,
        iconColor: 'text-white',
        bgColor: 'bg-pink-400',
    },
    {
        name: 'Happy',
        value: 'happy',
        icon: EmojiHappyIcon,
        iconColor: 'text-white',
        bgColor: 'bg-green-400',
    },
    {
        name: 'Sad',
        value: 'sad',
        icon: EmojiSadIcon,
        iconColor: 'text-white',
        bgColor: 'bg-yellow-400',
    },
    {
        name: 'Thumbsy',
        value: 'thumbsy',
        icon: ThumbUpIcon,
        iconColor: 'text-white',
        bgColor: 'bg-blue-500',
    },
    {
        name: 'I feel nothing',
        value: null,
        icon: XIcon,
        iconColor: 'text-gray-400',
        bgColor: 'bg-transparent',
    },
];

export default {
    components: {
        Listbox,
        ListboxButton,
        ListboxLabel,
        ListboxOption,
        ListboxOptions,
        EmojiHappyIcon,
        PaperClipIcon,
        CreatorAvatar
    },
    props: ['loading'],
    setup() {
        const selected = ref(moods[5]);

        return {
            moods,
            selected,
        };
    },
    data() {
        return {
            comment: '',
            addingComment: false
        }
    },
    computed: {
        user() {
            return this.$store.state.AuthState.user
        }
    }
};
</script>
