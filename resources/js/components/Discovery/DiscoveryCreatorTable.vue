<template>
    <table class="min-w-full overflow-y-scroll overscroll-contain divide-y divide-gray-200 ">
        <thead class="bg-gray-50/90 backdrop-blur-2xl backdrop-saturate-150 sticky top-0">
            <tr>
                <th
                    scope="col"
                    class="hidden lg:table-cell px-2 py-1 text-center items-center text-xs font-medium text-gray-500 tracking-wider"
                >
                    <div class="grid grid-cols-2 items-center">
                        <div class="items-center text-center h-5">
                            <input
                                id="comments"
                                aria-describedby="comments-description"
                                name="comments"
                                type="checkbox"
                                class="focus-visible:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                            />
                        </div>
                        <div
                            class="sr-only group text-center items-center text-gray-300 hover:text-red-500"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 group-hover:fill-red-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider"
                >
                    Creators
                </th>
                <th
                    scope="col"
                    class="table-cell px-2 py-3 text-center text-xs font-medium text-gray-500 tracking-wider"
                >
                    Content
                </th>
                <th
                    scope="col"
                    class="hidden lg:table-cell text-center text-xs font-medium text-gray-500 tracking-wider"
                >
                <div class="shrink grid xl:grid-cols-2 2xl:grid-cols-3 text-center">
                    <div class="inline-flex pl-1 py-3 justify-center items-center h-full hover:bg-indigo-50 cursor-pointer">
                        Followers
                         <ChevronDownIcon class="h-3 w-3 ml-1 mt-0.5 text-gray-500" />
                    </div>
                    <div class="py-3 h-full group items-center justify-center hover:bg-indigo-50 cursor-pointer hidden xl:inline-flex">
                        ER
                       <ChevronUpIcon class="hidden group-hover:block h-3 w-3 ml-1 text-gray-500" />
                    </div>
                    <div class="pr-1 py-3 group justify-center items-center h-full hover:bg-indigo-50 cursor-pointer hidden 2xl:inline-flex">
                         EF
                         <ChevronDownIcon class="hidden group-hover:block h-3 w-3 ml-1 mt-0.5 text-gray-500" />
                        </div>
                    </div>
                </th>
                <th
                    scope="col"
                    class="lg:table-cell sr-only px-2 py-3 text-center text-xs font-medium text-gray-500 tracking-wider"
                >
                   Manage
                </th>
                
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 h-full">
            <tr
                v-for="creator in creators"
                :key="creator"
                class="hover:bg-indigo-50 focus:ring-indigo-700 group border border-neutral-200 border-1 border-collapse overflow-y-visible"
            >
                <td
                    class="hidden lg:table-cell pl-2 pr-4 py-1 w-16 text-center text-gray-300 group-hover:text-neutral-500 text-xs font-bold whitespace-nowrap"
                >
                    <div class="grid grid-cols-2 items-center">
                        <div class="group mr-2">
                            <span class="group-hover:hidden">
                                {{ creator.id }}
                            </span>
                            <span class="hidden group-hover:block">
                                <input
                                    id="comments-description"
                                    aria-describedby="comments-description"
                                    name="comments"
                                    type="checkbox"
                                    class="focus-visible:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                />
                            </span>
                        </div>
                        <div>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 hover:text-red-500 hover:fill-red-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </td>
                <td class="flex-none px-4 justify-center py-1 border-l w-80 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-24 w-24 mr-2">
                            <img
                                class="object-center border-2 object-cover rounded-full"
                                :src="creator.avatar"
                                alt=""
                            />
                        </div>
                        <div class="w-72">
                            <div class="flex text-xs font-medium text-gray-900">
                                {{ creator.name }}
                                <div class="text-white">
                                    <svg
                                                
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 -mt-1" fill="indigo"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-2xs truncate -mt-1 wrap font-light text-gray-900">
                                {{ creator.bio }}
                            </div>
                            <div class="text-xs pt-.05 pb-1 font-medium text-gray-900">
                                 <CreatorTags color="None" text="Category" />
                                <CreatorTags color="purple" text="Fashion" />
                                <CreatorTags color="blue" text="Music" />
                                <CreatorTags color="pink" text="Other" />
                            </div>
                            <CreatorSocialLinks class="mt-1" />
                        </div>
                    </div>
                </td>
               
                <td class="flex-grow w-24 lg:w-48 xl:w-72 items-center whitespace-nowrap">
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                        <img class="h-24 w-24 first:rounded-l-md last:rounded-r-md aspect-square object-cover object-center" src="https://static.onecms.io/wp-content/uploads/sites/35/2015/05/03203022/20.jpg">
                        <img class="hidden lg:block w-24 h-24 first:rounded-l-md last:rounded-r-md aspect-square object-cover object-center" src="https://s.yimg.com/uu/api/res/1.2/3K4_072nW1zxZyXMMPRG9g--~B/aD02ODM7dz0xMDI0O2FwcGlkPXl0YWNoeW9u/https://media.zenfs.com/en/footwear_news_642/60da97df5a3b2369a9fca48275eb4119">
                        <img class="hidden xl:block w-24 h-24 first:rounded-l-md last:rounded-r-md aspect-square object-cover object-center" src="https://static.onecms.io/wp-content/uploads/sites/35/2015/05/03203022/20.jpg">
                    </div>
                </td>
                <td class="hidden lg:table-cell border-r border-collapse border-1 w-24 xl:w-48 2xl:w-72 whitespace-nowrap">
                    <div class="shrink grid xl:grid-cols-2 2xl:grid-cols-3 text-center">
                        
                            <div>
                                <div class="font-bold">234</div>
                                <div class="text-xs">Followers</div>
                            </div>
                           
                      
                        <div class="hidden xl:block">
                            <div class="font-bold">234</div>
                            <div class="text-xs">Engagement</div>
                             
                        </div>
                        <div class="hidden 2xl:block">
                            <div class="font-bold">234</div>
                            <div class="text-xs">EF%</div>
                        </div>
                    </div>

                   
                </td>
                <td
                    class="flex-grow px-6 py-1 W-28 whitespace-nowrap text-sm text-gray-500"
                >
                    <star-rating
                        class="w-20"
                        :star-size="12"
                        :increment="0.5"
                        v-model:rating="creator.rating"
                    ></star-rating>
                </td>
                <td
                    class="flex-grow py-1 whitespace-nowrap justify-right text-right text-xs font-medium"
                >
                    <div
                        class="grid grid-cols-2 justify-right items-center gap-4"
                    >
                        
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="rounded-full flex items-center text-gray-400 hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-indigo-500"
                                >
                                    <span class="sr-only">Open options</span>
                                    <DotsVerticalIcon
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </MenuButton>
                            </div>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                href="#"
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                >Archive</a
                                            >
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                href="#"
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                >Mute</a
                                            >
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                href="#"
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                >Remove</a
                                            >
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>

                        <!-- This example requires Tailwind CSS v2.0+ -->
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
} from "@headlessui/vue";
import StarRating from "vue-star-rating";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import {
    DotsVerticalIcon,
    ChevronDownIcon,
    ChevronUpIcon,
    CheckIcon,
    SearchCircleIcon,
} from "@heroicons/vue/solid";
import CreatorTags from "../Creator/CreatorTags";
import CreatorSocialLinks from "../Creator/CreatorSocialLinks";

const people = [
    { id: 1, name: "Wade Cooper" },
    { id: 2, name: "Arlene Mccoy" },
    { id: 3, name: "Devon Webb" },
    { id: 4, name: "Tom Cook" },
    { id: 5, name: "Tanya Fox" },
    { id: 6, name: "Hellen Schmidt" },
    { id: 7, name: "Caroline Schultz" },
    { id: 8, name: "Mason Heaney" },
    { id: 9, name: "Claudie Smitham" },
    { id: 10, name: "Emil Schaefer" },
];

export default {
    name: "CRM",
    components: {
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
        StarRating,
        Listbox,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        DotsVerticalIcon,
        ChevronDownIcon,
        CheckIcon,
        SearchCircleIcon,
        CreatorTags,
        CreatorSocialLinks,
        ChevronUpIcon,
    },
    data() {
        return {
            creators: [
                {
                    id: 1,
                    favorite: true,
                    network: "instagram",
                    name: "Martha Hoover",
                    bio: "hello from the otherside. I'm a great person",
                    firstname: "Marth",
                    lastname: "Hoover",
                    email: "mhoover@gmail.com",
                    rating: "4.3",
                    followers: "1.5M",
                    offer: "240K",
                    stage: "Onboarding",
                    contacted: "1/12/2020",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=1",
                },
                {
                    id: 2,
                    favorite: false,
                    network: "tiktok",
                    name: "Candice Mccoy",
                    bio: "Candice Mccoy is a professional photographer and videographer. She has worked for a variety of clients, including the US Department of Agriculture, the US Department of Homeland Security, and the US Department of Education. She has also worked for a variety of clients, including the US Department of Agriculture, the US Department of Homeland Security, and the US Department of Education.",
                    firstname: "Candice",
                    lastname: "Mccoy",
                    email: "candicem@gmail.com",
                    rating: "3",
                    followers: "1.2M",
                    offer: "12K",
                    stage: "Onboarding",
                    contacted: "1/1e/2020",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=2",
                },
                {
                    id: 3,
                    favorite: false,
                    network: "youtube",
                    name: "Taylor Smith",
                    bio: "Taylor Smith is a YouTube channel owner and founder of the YouTube channel Taylor Smith.",
                    firstname: "Taylor",
                    lastname: "Smith",
                    email: "",
                    rating: "2",
                    followers: "1.2K",
                    offer: "104K",
                    stage: "Onboarding",
                    contacted: "1/1e/2020",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=3",
                },
                {
                    id: 4,
                    favorite: true,
                    network: "instagram",
                    name: "Alessandra Clause",
                    bio: "get the best of both worlds",
                    firstname: "Alessandra",
                    lastname: "Clause",
                    email: "",
                    rating: "5",
                    followers: "1.2M",
                    offer: "104K",
                    stage: "Onboarding",
                    contacted: "9/1/2020",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=4",
                },
                {
                    id: 5,
                    favorite: false,
                    network: "instagram",
                    name: "Keira Jones",
                    bio: "Some time in the future when the world is a better place, I will be able to create a new reality.",
                    firstname: "Keira",
                    lastname: "Jones",
                    email: "",
                    rating: "4.9",
                    followers: "4.2M",
                    offer: "344K",
                    stage: "Negotiating",
                    contacted: "3/2/2022",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=5",
                },
                {
                    id: 6,
                    favorite: false,
                    network: "instagram",
                    name: "Mila Vance",
                    bio: "Let us be friends in the dark",
                    firstname: "Mila",
                    lastname: "Vance",
                    email: "",
                    rating: "2.9",
                    followers: "1.2K",
                    offer: "104K",
                    stage: "Complete",
                    contacted: "1/11/2022",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=6",
                },
                {
                    id: 7,
                    favorite: false,
                    network: "instagram",
                    name: "Kylie Brent",
                    firstname: "Kylie",
                    bio: "When you're not in the spotlight, you're in the spotlight",
                    lastname: "Brent",
                    email: "",
                    rating: "1.2",
                    followers: "1.2B",
                    offer: "10K",
                    stage: "Interested",
                    contacted: "4/5/2021",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=7",
                },
                {
                    id: 8,
                    favorite: false,
                    network: "instagram",
                    name: "Sophia Dustin",
                    bio: "let's talk about the future. Then we'll talk about the past. Finally, we'll talk about the present.",
                    firstname: "Sophia",
                    lastname: "Dustin",
                    email: "",
                    rating: "4.9",
                    followers: "4.2M",
                    offer: "344K",
                    stage: "Negotiating",
                    contacted: "3/2/2022",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=8",
                },
                {
                    id: 9,
                    favorite: false,
                    network: "instagram",
                    name: "James Johnson",
                    bio: "Everyones favorite is not me but me",
                    firstname: "James",
                    lastname: "Johnson",
                    email: "",
                    rating: "2.9",
                    followers: "1.2K",
                    offer: "104K",
                    stage: "Complete",
                    contacted: "1/11/2022",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=9",
                },
                {
                    id: 10,
                    favorite: false,
                    network: "instagram",
                    name: "Mike Croft",
                    bio: "Welcome to the real world she said to me",
                    firstname: "Mike",
                    lastname: "Croft",
                    email: "",
                    rating: "1.2",
                    followers: "1.2B",
                    offer: "10K",
                    stage: "Interested",
                    contacted: "4/5/2021",
                    campaign: "Zelf Beta",
                    avatar: "https://i.pravatar.cc/150?img=10",
                },
            ],
        };
    },
};
</script>
