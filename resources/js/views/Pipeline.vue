<template>
  <div
    v-if="
      (currentUser.current_team.current_subscription &&
        currentUser.current_team.current_subscription.name !== 'basic') ||
      currentUser.is_admin
    ">
    <div
      class="mx-auto grid h-full w-full auto-cols-max grid-flow-col justify-center py-4">
      <div
        v-for="(list, index) in lists"
        class="mx-auto h-full justify-center divide-y divide-slate-200">
        <div class="border border-b-0 border-slate-200 lg:border-0">
          <!-- Completed Step -->
          <a href="#" class="group">
            <span class="flex items-start px-2 py-2 text-sm font-medium">
              <span class="flex-shrink-0">
                <span
                  class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-indigo-600">
                  <span class="text-indigo-600">{{ list.count }}</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 line-clamp-1 flex min-w-0 flex-col">
                <span
                  class="line-clamp-1 truncate text-xs font-semibold uppercase tracking-wide"
                  >{{ list }}</span
                >
                <span class="text-2xs font-medium text-slate-500">
                  4.7M Reach | $5,000
                </span>
              </span>
            </span>
          </a>
        </div>
        <draggable
          class="list-group my-1 cursor-pointer justify-center gap-6 space-y-2 px-4 py-4"
          :list="contacts[index]"
          group="people"
          @change="log"
          itemKey="name">
          <template #item="{ element, index }">
            <div
              class="h-12 w-60 items-center overflow-hidden rounded-lg bg-white shadow-lg hover:bg-slate-50">
              <div
                class="list-group-item flex w-full items-center justify-between">
                <div class="flex-1 items-center overflow-hidden truncate">
                  <div class="flex items-center justify-between pr-4">
                    <div class="flex items-center">
                      <div
                        class="-ml-3 -mt-2 h-16 w-16 flex-shrink-0 items-center overflow-hidden">
                        <div
                          class="items-center rounded-full p-0.5"
                          :class="[
                            {
                              'bg-social-youtube/60':
                                element.network == 'youtube',
                            },
                            {
                              'bg-social-twitter/90':
                                element.network == 'twitter',
                            },
                            {
                              'bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90':
                                element.network == 'instagram',
                            },
                            {
                              'bg-social-snapchat':
                                element.network == 'snapchat',
                            },
                            {
                              'bg-gradient-to-l from-pink-700 to-sky-700':
                                element.network == 'tiktok',
                            },
                          ]">
                          <div class="rounded-full bg-white p-0">
                            <img
                              class="rounded-full object-cover object-center"
                              :src="element.avatar"
                              alt="" />
                          </div>
                        </div>
                      </div>
                      <div class="-mt-2 ml-2 block w-28 overflow-ellipsis">
                        <div
                          class="line-clamp-1 block text-ellipsis text-xs font-medium text-slate-900">
                          {{ element.full_name }}
                        </div>
                        <div
                          class="elipsis line-clamp-1 block text-2xs text-slate-500">
                          <span
                            class="inline-flex items-center rounded-sm bg-slate-100 px-1 py-0 text-[8px] font-medium text-slate-800">
                            {{ element.contacted }}
                          </span>
                          <span
                            class="inline-flex text-[8px] font-medium text-slate-900">
                            - {{ element.daysinstage }} days ago
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="-mt-2 w-12 flex-shrink-0 items-center border-l">
                      <div class="ml-1.5 grid grid-cols-2">
                        <div class="items-center justify-center opacity-50">
                          <div class="justify-center text-2xs">$</div>
                          <div class="mt-1 items-center justify-center">
                            <SocialIcons height="8px" :icon="element.network" />
                          </div>
                        </div>
                        <div class="-ml-1 items-center opacity-50">
                          <a
                            :href="element.networklink"
                            class="text-nuetral-800 flex items-center rounded-full text-center text-2xs font-bold">
                            {{ element.followers }}
                          </a>
                          <a
                            :href="element.networklink"
                            class="text-nuetral-800 flex items-center rounded-full text-center text-2xs font-bold">
                            {{ element.offer }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </draggable>
      </div>

      <rawDisplayer class="col-3" :value="list1" title="List 1" />

      <rawDisplayer class="col-3" :value="list2" title="List 2" />
    </div>
  </div>
  <div v-else>
    <NoAccess />
  </div>
</template>
<script>
import draggable from 'vuedraggable';
import ContactTags from '../components/Contact/ContactTags.vue';
import SocialIcons from '../components/SocialIcons.vue';
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/24/solid';
import NoAccess from '../components/NoAccess.vue';
import contactService from '../services/api/contact.service';
export default {
  name: 'two-lists',
  display: 'Two Lists',
  order: 1,
  components: {
    draggable,
    EnvelopeIcon,
    PhoneIcon,
    SocialIcons,
    NoAccess,
    ContactTags,
  },
  mounted() {
    //add segment analytics
    this.getStagedContacts();
    window.analytics.page(this.$route.path);
  },
  props: {
    // lists: {
    //   type: Array,
    //   required: true,
    // },
    // contacts: {
    //   type: Object,
    //   required: true,
    // },
    suggestion: {
      type: Array,
    },
  },
  data() {
    return {
      // lists: [
      //   {
      //     name: 'List 1',
      //     id: 1,
      //     count: 10,
      //     title: 'Prospects',
      //     subtitle: 'Creators added from discover',
      //   },
      //   {
      //     name: 'List 2',
      //     id: 2,
      //     count: 34,
      //     title: 'Contacted',
      //     subtitle: 'People who have been contacted',
      //   },
      //   {
      //     name: 'List 3',
      //     id: 3,
      //     count: 17,
      //     title: 'Negotiating',
      //     subtitle: 'People who are currently in the process of negotiating',
      //   },
      //   {
      //     name: 'List 4',
      //     id: 4,
      //     count: 5,
      //     title: 'Closed',
      //     subtitle: 'Creators who have onboarded',
      //   },
      // ],
      // list1: [
      //   {
      //     id: 1,
      //     favorite: true,
      //     network: 'instagram',
      //     networklink: 'http://instagram.com/timwhite',
      //     name: 'Martha Hoover goes deep on the reall meaning of life and the universe',
      //     bio: 'Born in LA, Living in space.',
      //     firstname: 'Marth',
      //     lastname: 'Hoover',
      //     email: 'mhoover@gmail.com',
      //     rating: '4.3',
      //     followers: '1.5M',
      //     daysinstage: '2',
      //     offer: '240K',
      //     stage: 'Lead',
      //     contacted: '1/12/2020',
      //     campaign: 'Zelf Beta',
      //     category: 'Model',
      //     avatar: 'https://i.pravatar.cc/150?img=1',
      //   },
      //   {
      //     id: 2,
      //     favorite: false,
      //     bio: 'Free spirit, paid body.',
      //     network: 'twitter',
      //     networklink: 'http://twitter.com/itstimwhite',
      //     name: 'Candice Mccoy',
      //     firstname: 'Candice',
      //     lastname: 'Mccoy',
      //     email: 'candicem@gmail.com',
      //     rating: '3',
      //     followers: '1.2M',
      //     offer: '12K',
      //     stage: 'Lead',
      //     daysinstage: '3',
      //     contacted: '4/9/2020',
      //     campaign: 'Zelf Beta',
      //     category: 'Actor',
      //     avatar: 'https://i.pravatar.cc/150?img=2',
      //   },
      //   {
      //     id: 3,
      //     favorite: false,
      //     daysinstage: '6',
      //     network: 'youtube',
      //     bio: 'Lost soul, found money.',
      //     networklink: 'http://youtube.com/timwhite',
      //     name: 'Taylor Smith',
      //     firstname: 'Taylor',
      //     lastname: 'Smith',
      //     email: '',
      //     rating: '2',
      //     followers: '1.2K',
      //     offer: '104K',
      //     stage: 'Lead',
      //     contacted: '1/4/2020',
      //     campaign: 'Zelf Beta',
      //     category: 'Athelete',
      //     avatar: 'https://i.pravatar.cc/150?img=3',
      //   },
      //   {
      //     id: 4,
      //     favorite: false,
      //     bio: 'Have you seen jackass?',
      //     network: 'instagram',
      //     networklink: 'http://instagram.com/timwhite',
      //     name: 'Jordan Smith',
      //     firstname: 'Taylor',
      //     lastname: 'Smith',
      //     daysinstage: '1',
      //     email: '',
      //     rating: '2',
      //     followers: '47.2K',
      //     offer: '900K',
      //     stage: 'Lead',
      //     contacted: '1/9/2020',
      //     category: 'Singer',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=11',
      //   },
      //   {
      //     id: 5,
      //     favorite: false,
      //     network: 'instagram',
      //     bio: 'Star Wars if it took place in a Florida.',
      //     networklink: 'http://instagram.com/timwhite',
      //     name: 'Keira Jones',
      //     daysinstage: '12',
      //     firstname: 'Keira',
      //     lastname: 'Jones',
      //     email: '',
      //     rating: '4.9',
      //     followers: '4.2M',
      //     category: 'Dancer',
      //     offer: '344K',
      //     stage: 'Negotiating',
      //     contacted: '3/2/2022',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=5',
      //   },
      //   {
      //     id: 6,
      //     favorite: false,
      //     network: 'snapchat',
      //     bio: 'I charge by the hour, I pay by the second.',
      //     networklink: 'http://snapchat.com/timwhite',
      //     name: 'Mila Vance',
      //     firstname: 'Mila',
      //     lastname: 'Vance',
      //     daysinstage: '5',
      //     category: 'Actor',
      //     email: '',
      //     rating: '2.9',
      //     followers: '1.2K',
      //     offer: '104K',
      //     stage: 'Complete',
      //     contacted: '1/11/2022',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=6',
      //   },
      //   {
      //     id: 7,
      //     favorite: false,
      //     network: 'tiktok',
      //     bio: 'Loved by many, known by few.',
      //     networklink: 'http://tiktok.com/@timwhite',
      //     name: 'Kylie Brent',
      //     firstname: 'Kylie',
      //     lastname: 'Brent',
      //     daysinstage: '1',
      //     email: '',
      //     category: 'Model',
      //     rating: '1.2',
      //     followers: '1.2B',
      //     offer: '10K',
      //     stage: 'Interested',
      //     contacted: '4/5/2021',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=7',
      //   },
      //   {
      //     id: 8,
      //     favorite: false,
      //     network: 'instagram',
      //     networklink: 'http://instagram.com/timwhite',
      //     name: 'Sophia Dustin',
      //     bio: "I'm a big fan of the Kardashians.",
      //     firstname: 'Sophia',
      //     lastname: 'Dustin',
      //     email: '',
      //     category: 'Model',
      //     daysinstage: '12',
      //     rating: '4.9',
      //     followers: '4.2M',
      //     offer: '344K',
      //     stage: 'Negotiating',
      //     contacted: '3/2/2022',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=8',
      //   },
      //   {
      //     id: 9,
      //     favorite: false,
      //     bio: 'I invented bacon salt.',
      //     network: 'snapchat',
      //     networklink: 'http://snapchat.com/timwhite',
      //     name: 'James Johnson',
      //     firstname: 'James',
      //     lastname: 'Johnson',
      //     daysinstage: '5',
      //     category: 'Actor',
      //     email: '',
      //     rating: '2.9',
      //     followers: '1.2K',
      //     offer: '104K',
      //     stage: 'Complete',
      //     contacted: '1/11/2022',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=9',
      //   },
      //   {
      //     id: 10,
      //     favorite: false,
      //     bio: 'Investor, investing in investable assets.',
      //     network: 'instagram',
      //     networklink: 'http://instagram.com/timwhite',
      //     name: 'Mike Croft',
      //     firstname: 'Mike',
      //     lastname: 'Croft',
      //     daysinstage: '1',
      //     category: 'Barista',
      //     email: '',
      //     rating: '1.2',
      //     followers: '1.2B',
      //     offer: '10K',
      //     stage: 'Interested',
      //     contacted: '4/5/2021',
      //     campaign: 'Zelf Beta',
      //     avatar: 'https://i.pravatar.cc/150?img=10',
      //   },
      // ],
      list2: [
        { name: 'Trinity', id: 5 },
        { name: 'Edgard', id: 6 },
        { name: 'Johnson', id: 7 },
      ],
      lists: [],
      contacts: [],
    };
  },
  methods: {
    add: function () {
      this.list.push({ name: 'Juan' });
    },
    replace: function () {
      this.list = [{ name: 'Edgard' }];
    },
    clone: function (el) {
      return {
        name: el.name + ' cloned',
      };
    },
    log: function (evt) {
      window.console.log(evt);
    },
    getStagedContacts() {
      contactService
        .getStagedContacts()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.lists = response.stages;
            this.contacts = response.contacts
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
