<template>
  <div
    class="mx-auto grid h-full w-full auto-cols-max grid-flow-col justify-center py-4">
    <div
      v-for="(list, i) in lists"
      class="mx-auto h-full justify-center divide-y divide-gray-200">
      <div class="border border-b-0 border-gray-200 lg:border-0">
        <!-- Completed Step -->
        <a href="#" class="group">
          <span class="flex items-start px-2 py-2 text-sm font-medium">
            <span class="flex-shrink-0">
              <span
                class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-indigo-600">
                <span class="text-indigo-600">{{ list.count }}</span>
              </span>
            </span>
            <span class="mt-0.5 ml-4 flex min-w-0 flex-col line-clamp-1">
              <span
                class="truncate text-xs font-semibold uppercase tracking-wide line-clamp-1"
                >{{ list.title }}</span
              >
              <span class="text-2xs font-medium text-gray-500">
                4.7M Reach | $5,000
              </span>
            </span>
          </span>
        </a>
      </div>
      <draggable
        class="list-group my-1 cursor-pointer justify-center gap-6 space-y-2 px-4 py-4"
        :list="list1[i]"
        group="people"
        @change="(event) => handleStage(i, event)"
        itemKey="name">
        <template #item="{ element, index }">
          <div
            class="h-12 w-60 items-center overflow-hidden rounded-lg bg-white shadow-lg hover:bg-gray-50">
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
                            'bg-social-snapchat': element.network == 'snapchat',
                          },
                          {
                            'bg-gradient-to-l from-pink-700 to-sky-700':
                              element.network == 'tiktok',
                          },
                        ]">
                        <div class="rounded-full bg-white p-0">
                          <img
                            class="rounded-full object-cover object-center"
                            :src="element.profile_pic_url"
                            alt="" />
                        </div>
                      </div>
                    </div>
                    <div class="ml-2 -mt-2 block w-28 overflow-ellipsis">
                      <div
                        class="block text-ellipsis text-xs font-medium text-gray-900 line-clamp-1">
                        {{ element.full_name }}
                      </div>
                      <div
                        class="elipsis block text-2xs text-gray-500 line-clamp-1">
                        <span
                          class="inline-flex items-center rounded-sm bg-neutral-100 px-1 py-0 text-[8px] font-medium text-neutral-800">
                          {{ element.crm_record_by_user.last_contacted }}
                        </span>
                        <span
                          class="inline-flex text-[8px] font-medium text-gray-900">
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
                          {{
                            element.instagram_followers +
                            element.twitter_followers +
                            element.tiktok_followers
                          }}
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
</template>
<script>
import draggable from 'vuedraggable';
import CreatorTags from '../components/Creator/CreatorTags.vue';
import SocialIcons from '../components/SocialIcons.vue';
import { MailIcon, PhoneIcon } from '@heroicons/vue/solid';
import UserService from '../services/api/user.service';
import userService from '../services/api/user.service';
export default {
  name: 'two-lists',
  display: 'Two Lists',
  order: 1,
  components: {
    draggable,
    MailIcon,
    PhoneIcon,
    SocialIcons,
    CreatorTags,
  },
  data() {
    return {
      lists: [
        // {
        //   name: 'List 1',
        //   id: 0,
        //   count: 0,
        //   title: 'Onboarding',
        //   subtitle: 'Creators added from discover',
        // },
        // {
        //   name: 'List 2',
        //   id: 1,
        //   count: 0,
        //   title: 'Interested',
        //   subtitle: 'People who have been contacted',
        // },
        // {
        //   name: 'List 3',
        //   id: 2,
        //   count: 0,
        //   title: 'Negotiating',
        //   subtitle: 'People who are currently in the process of negotiating',
        // },
        // {
        //   name: 'List 4',
        //   id: 3,
        //   count: 0,
        //   title: 'Inprogress',
        //   subtitle: 'Creators who have onboarded',
        // },
        // {
        //   name: 'List 5',
        //   id: 4,
        //   count: 0,
        //   title: 'Complete',
        //   subtitle: 'Creators who have onboarded',
        // },
      ],
      list1: [
        // {
        //   id: 1,
        //   favorite: true,
        //   network: 'instagram',
        //   networklink: 'http://instagram.com/timwhite',
        //   name: 'Martha Hoover goes deep on the reall meaning of life and the universe',
        //   bio: 'Born in LA, Living in space.',
        //   firstname: 'Marth',
        //   lastname: 'Hoover',
        //   email: 'mhoover@gmail.com',
        //   rating: '4.3',
        //   followers: '1.5M',
        //   daysinstage: '2',
        //   offer: '240K',
        //   stage: 'Onboarding',
        //   contacted: '1/12/2020',
        //   campaign: 'Zelf Beta',
        //   category: 'Model',
        //   avatar: 'https://i.pravatar.cc/150?img=1',
        // }
      ],
      networks: [],
      list2: [
        { name: 'Trinity', id: 5 },
        { name: 'Edgard', id: 6 },
        { name: 'Johnson', id: 7 },
      ],
    };
  },
  mounted() {
    this.get();
  },
  methods: {
    get: function () {
      let data = {
        list: null,
        archived: 0,
        page: 1,
      };
      UserService.getCrmCreators(data).then((response) => {
        this.loading = false;
        response = response.data;
        if (response.status) {
          // console.log(response);
          let header = [];
          let items = [];
          for (let i = 0; i < response.stages.length; i++) {
            let list = {
              id: i,
              name: 'List' + (i + 1),
              title: response.stages[i],
              count: response.creators.data.filter((item) => item.stage == i)
                .length,
            };
            items.push(
              response.creators.data.filter((item) => item.stage == i)
            );
            header.push(list);
          }
          this.lists = header;
          this.list1 = items;
          this.networks = response.networks;
        }
      });
    },
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
    handleStage: function (index, evt) {
      if (evt.added) {
        userService
          .updateCreatorStage({
            crm_id: evt.added.element.crm_id,
            stage: index,
            newIndex: evt.added.newIndex,
          })
          .then((response) => {
            if (response.status) {
              this.get();
            }
          });
      } else if (evt.moved) {
        userService
          .updateCreatorIndex({
            crm_id: evt.moved.element.crm_id,
            stage: index,
            newIndex: evt.moved.newIndex,
          })
          .then((response) => {
            if (response.status) {
              this.get();
            }
          });
      }
    },
  },
};
</script>
