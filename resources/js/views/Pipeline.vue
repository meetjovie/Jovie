<template>
  <div class="grid h-full grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <div
      class="col-span-1 h-full divide-y divide-gray-200 rounded-lg py-12 shadow">
      <h3 class="text-center text-xs font-bold">Cold</h3>
      <draggable
        class="list-group shadown-xl my-2 gap-6 space-y-6 px-4 py-4"
        :list="list1"
        group="people"
        @change="log"
        itemKey="name">
        <template #item="{ element, index }" c>
          <div class="rounded-lg bg-white shadow-lg">
            <div
              class="list-group-item flex w-full items-center justify-between space-x-6 p-6">
              <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                  <h3 class="truncate text-sm font-medium text-gray-900">
                    {{ element.name }}
                  </h3>
                  <span
                    class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                    {{ element.network }}</span
                  >
                </div>
                <p class="mt-1 truncate text-sm text-gray-500">
                  {{ element.bio }}
                </p>
              </div>
              <img
                :src="element.avatar"
                class="h-20 w-20 flex-shrink-0 rounded-full bg-gray-300"
                alt="" />
            </div>
            <div>
              <div class="-mt-px flex divide-x divide-gray-200">
                <div class="flex w-0 flex-1">
                  <a
                    class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                    <MailIcon
                      class="h-5 w-5 text-gray-400"
                      aria-hidden="true" />
                    <span class="ml-3">Email</span>
                  </a>
                </div>
                <div class="-ml-px flex w-0 flex-1">
                  <a
                    class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                    <PhoneIcon
                      class="h-5 w-5 text-gray-400"
                      aria-hidden="true" />
                    <span class="ml-3">Call</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </template>
      </draggable>
    </div>

    <div class="col-3">
      <h3 class="text-center text-xs font-bold">Contacted</h3>
      <draggable
        class="list-group rounded-lg bg-indigo-100 px-4 py-4"
        :list="list2"
        group="people"
        @change="log"
        itemKey="name">
        <template #item="{ element, index }">
          <div class="list-group-item">{{ element.name }} {{ index }}</div>
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
