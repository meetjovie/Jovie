<template>
  <div class="mx-auto justify-center w-full grid h-full grid-cols-4">
    <div
      v-for="list in lists"
      class="h-full justify-center mx-auto divide-y divide-gray-200">
      <div
        class="overflow-hidden border border-b-0 border-gray-200 lg:border-0">
        <!-- Completed Step -->
        <a href="#" class="group">
          <span class="flex items-start px-2 py-2 text-sm font-medium">
            <span class="flex-shrink-0">
              <span
                class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-indigo-600">
                <span class="text-indigo-600">{{ list.id }}</span>
              </span>
            </span>
            <span class="mt-0.5 ml-4 flex min-w-0 flex-col line-clamp-1">
              <span
                class="truncate text-xs font-semibold uppercase tracking-wide line-clamp-1"
                >{{ list.title }}</span
              >
              <span class="text-2xs font-medium text-gray-500">{{
                list.subtitle
              }}</span>
            </span>
          </span>
        </a>
      </div>
      <draggable
        class="list-group my-1 justify-center gap-6 space-y-6 px-4 py-4"
        :list="list1"
        group="people"
        @change="log"
        itemKey="name">
        <template #item="{ element, index }" >
          <div class="w-60 rounded-lg bg-white shadow-lg">
            <div
              class="list-group-item flex w-full items-center justify-between space-x-6 px-2 py-1">
              <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                  <div class="flex items-center">
                                <div class="mr-2 h-8 w-8 flex-shrink-0">
                                  <div class="p-0.5 rounded-full" :class="{
                                      'bg-social-youtube/60':
                                        element.network == 'youtube'}, {'bg-social-twitter/90' : element.network == 'twitter'}, {'bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90' : element.network == 'instagram'}, {'bg-social-snapchat' : element.network == 'snapchat'}, {'bg-gradient-to-l from-pink-700 to-sky-700' : element.network =='tiktok'}"
                                    >
                                <div class="bg-white p-0 rounded-full">
                                  <img
                                    class="rounded-full object-cover object-center"
                                    
                                    :src="element.avatar"
                                    alt="" />
                                    </div>
                                    </div>
                                </div>
                                <div class="">
                                  <div
                                    class="text-xs font-medium text-gray-900">
                                    {{ element.name }}
                                     <p class="truncate text-2xs text-gray-500">
                                    {{ element.bio }}
                                    </p>
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
</template>
<script>
import draggable from 'vuedraggable';
import { MailIcon, PhoneIcon } from '@heroicons/vue/solid';
export default {
  name: 'two-lists',
  display: 'Two Lists',
  order: 1,
  components: {
    draggable,
    MailIcon,
    PhoneIcon,
  },
  data() {
    return {
      lists: [
        {
          name: 'List 1',
          id: 1,
          title: 'Propects',
          subtitle: 'Creators added from discover',
        },
        {
          name: 'List 2',
          id: 2,
          title: 'Contacted',
          subtitle: 'People who have been contacted',
        },
        {
          name: 'List 3',
          id: 3,
          title: 'Negotiating',
          subtitle: 'People who are currently in the process of negotiating',
        },
        {
          name: 'List 4',
          id: 4,
          title: 'Closed',
          subtitle: 'Creators who have onboarded',
        },
      ],
      list1: [
        {
          id: 1,
          favorite: true,
          network: 'instagram',
          networklink: 'http://instagram.com/timwhite',
          name: 'Martha Hoover',
          firstname: 'Marth',
          lastname: 'Hoover',
          email: 'mhoover@gmail.com',
          rating: '4.3',
          followers: '1.5M',
          offer: '240K',
          stage: 'Onboarding',
          contacted: '1/12/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=1',
        },
        {
          id: 2,
          favorite: false,
          network: 'twitter',
          networklink: 'http://twitter.com/itstimwhite',
          name: 'Candice Mccoy',
          firstname: 'Candice',
          lastname: 'Mccoy',
          email: 'candicem@gmail.com',
          rating: '3',
          followers: '1.2M',
          offer: '12K',
          stage: 'Onboarding',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=2',
        },
        {
          id: 3,
          favorite: false,
          network: 'youtube',
          networklink: 'http://youtube.com/timwhite',
          name: 'Taylor Smith',
          firstname: 'Taylor',
          lastname: 'Smith',
          email: '',
          rating: '2',
          followers: '1.2K',
          offer: '104K',
          stage: 'Onboarding',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=3',
        },
        {
          id: 4,
          favorite: false,
          network: 'instagram',
          networklink: 'http://instagram.com/timwhite',
          name: 'Taylor Smith',
          firstname: 'Taylor',
          lastname: 'Smith',
          email: '',
          rating: '2',
          followers: '47.2K',
          offer: '900K',
          stage: 'Onboarding',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=3',
        },
        {
          id: 5,
          favorite: false,
          network: 'instagram',
          networklink: 'http://instagram.com/timwhite',
          name: 'Keira Jones',
          firstname: 'Keira',
          lastname: 'Jones',
          email: '',
          rating: '4.9',
          followers: '4.2M',
          offer: '344K',
          stage: 'Negotiating',
          contacted: '3/2/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=5',
        },
        {
          id: 6,
          favorite: false,
          network: 'snapchat',
          networklink: 'http://snapchat.com/timwhite',
          name: 'Mila Vance',
          firstname: 'Mila',
          lastname: 'Vance',
          email: '',
          rating: '2.9',
          followers: '1.2K',
          offer: '104K',
          stage: 'Complete',
          contacted: '1/11/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=6',
        },
        {
          id: 7,
          favorite: false,
          network: 'tiktok',
          networklink: 'http://tiktok.com/@timwhite',
          name: 'Kylie Brent',
          firstname: 'Kylie',
          lastname: 'Brent',
          email: '',
          rating: '1.2',
          followers: '1.2B',
          offer: '10K',
          stage: 'Interested',
          contacted: '4/5/2021',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=7',
        },
        {
          id: 8,
          favorite: false,
          network: 'instagram',
          networklink: 'http://instagram.com/timwhite',
          name: 'Sophia Dustin',
          firstname: 'Sophia',
          lastname: 'Dustin',
          email: '',
          rating: '4.9',
          followers: '4.2M',
          offer: '344K',
          stage: 'Negotiating',
          contacted: '3/2/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=8',
        },
        {
          id: 9,
          favorite: false,
          network: 'snapchat',
          networklink: 'http://snapchat.com/timwhite',
          name: 'James Johnson',
          firstname: 'James',
          lastname: 'Johnson',
          email: '',
          rating: '2.9',
          followers: '1.2K',
          offer: '104K',
          stage: 'Complete',
          contacted: '1/11/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=9',
        },
        {
          id: 10,
          favorite: false,
          network: 'instagram',
          networklink: 'http://instagram.com/timwhite',
          name: 'Mike Croft',
          firstname: 'Mike',
          lastname: 'Croft',
          email: '',
          rating: '1.2',
          followers: '1.2B',
          offer: '10K',
          stage: 'Interested',
          contacted: '4/5/2021',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=10',
        },
      ],
      list2: [
        { name: 'Trinity', id: 5 },
        { name: 'Edgard', id: 6 },
        { name: 'Johnson', id: 7 },
      ],
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
  },
};
</script>
