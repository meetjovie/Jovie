<template>
  <div class="mt-10 divide-y divide-gray-200">
    <div class="space-y-1">
      <h3 class="text-lg font-medium leading-6 text-gray-900">Team</h3>
      <p class="max-w-2xl text-sm text-gray-500">
        Invite collaborators to join your team.
      </p>
    </div>

    <div class="mt-6">
      <dl class="divide-y">
        <Disclosure>
          <DisclosureButton>
            <div
              class="items-center py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
              <dt class="text-sm font-medium text-gray-500">Team Name</dt>
              <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <InputGroup
                  placeholder="Team Name"
                  value="Team Jovie"
                  class="flex-grow"></InputGroup>
                <span class="ml-4 flex-shrink-0">
                  <button
                    type="button"
                    class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Update
                  </button>
                </span>
              </dd>
            </div>
          </DisclosureButton>
          <DisclosurePanel>
            <ul role="list" class="divide-y divide-gray-200">
              <li
                v-for="application in applications"
                :key="application.applicant.email">
                <a :href="application.href" class="block hover:bg-gray-50">
                  <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="flex min-w-0 flex-1 items-center">
                      <div class="flex-shrink-0">
                        <img
                          class="h-12 w-12 rounded-full"
                          :src="application.applicant.imageUrl"
                          alt="" />
                      </div>
                      <div
                        class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                          <p
                            class="truncate text-sm font-medium text-indigo-600">
                            {{ application.applicant.name }}
                          </p>
                          <p
                            class="mt-2 flex items-center text-sm text-gray-500">
                            <MailIcon
                              class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                              aria-hidden="true" />
                            <span class="truncate">{{
                              application.applicant.email
                            }}</span>
                          </p>
                        </div>
                        <div class="hidden md:block">
                          <div>
                            <p class="text-sm text-gray-900">
                              Joined on
                              {{ ' ' }}
                              <time :datetime="application.date">{{
                                application.dateFull
                              }}</time>
                            </p>
                            <p
                              class="mt-2 flex items-center text-sm text-gray-500">
                              <CheckCircleIcon
                                class="mr-1.5 h-5 w-5 flex-shrink-0"
                                :class="{
                                  'text-green-400':
                                    application.status === 'active',
                                  'text-red-400':
                                    application.status === 'removed',
                                  'text-gray-400':
                                    application.status === 'pending',
                                }"
                                aria-hidden="true" />
                              {{ application.teamrole }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <span class="ml-4 flex-shrink-0">
                        <button
                          type="button"
                          class="rounded-md bg-gray-100 text-xs font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                          Resend Invite
                        </button>
                      </span>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </DisclosurePanel>
        </Disclosure>
        <div class="mt-12 py-8 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-2">
          <dt class="text-sm font-medium text-gray-500 sm:pt-5">
            Invite addition team members
          </dt>
          <dd
            class="mt-1 flex items-center text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <span class="flex-grow"
              ><InputGroup placeholder="Example@jov.ie"></InputGroup
            ></span>
            <span class="s ml-4 flex flex-shrink-0 items-start space-x-4">
              <button
                type="button"
                class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                Send Invite
              </button>
            </span>
          </dd>
        </div>
      </dl>
    </div>
  </div>
</template>
<script>
import {
  CheckCircleIcon,
  ChevronRightIcon,
  MailIcon,
} from '@heroicons/vue/solid';
import InputGroup from '../../components/InputGroup.vue';
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';

const applications = [
  {
    applicant: {
      name: 'Ricardo Cooper',
      email: 'ricardo.cooper@example.com',
      imageUrl:
        'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    date: '2020-01-07',
    dateFull: 'Invitation sent...',
    teamrole: 'Invitation pending',
    href: '#',
    status: 'pending',
  },
  {
    applicant: {
      name: 'Kristen Ramos',
      email: 'kristen.ramos@example.com',
      imageUrl:
        'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    date: '2020-01-07',
    dateFull: 'January 7, 2020',
    teamrole: 'Team member',
    href: '#',
    status: 'active',
  },
  {
    applicant: {
      name: 'Ted Fox',
      email: 'ted.fox@example.com',
      imageUrl:
        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    date: '2020-01-07',
    dateFull: 'January 7, 2020',
    teamrole: 'Team owner',
    href: '#',
    status: 'active',
  },
];

export default {
  name: 'AccountTeam',
  components: {
    InputGroup,
    CheckCircleIcon,
    ChevronRightIcon,
    MailIcon,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
  },
  data() {
    return {
      applications,
    };
  },
};
</script>
