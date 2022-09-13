<template>
  <!--    NO SUBSCRIPTION OR NO TEAM SUBSCRIPTION-->
  <div
    class="flex w-full items-center justify-between space-y-1 border-b px-4 py-2"
    v-if="
      !currentUser.current_team.current_subscription ||
      !currentUser.current_team.current_subscription.seats
    ">
    Please upgrade to teams plan to use this feature.
  </div>
  <div class="mt-10 py-4" v-else>
    <div
      class="flex w-full items-center justify-between space-y-1 border-b px-4 py-2">
      <div class="">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Team</h3>
        <p class="max-w-2xl text-sm text-gray-500">
          Invite collaborators to join your team.
        </p>
        <p class="max-w-2xl text-sm text-gray-500">
          With your current team's plan, you can add
          {{ currentUser.current_team.current_subscription.seats }}
          member/members to you current active team.
          <span
            class="mx-auto w-32 items-center py-4"
            v-if="currentUser.isCurrentTeamOwner">
            <ButtonGroup
              @click="showBuySeats()"
              icon="PlusIcon"
              class="mx-auto w-48"
              text="Buy more seats" />
          </span>
        </p>
        <div
          class="space-x-2 px-4 py-2"
          v-if="isBuySeats && currentUser.isCurrentTeamOwner">
          <div class="mx-auto flex items-center py-2">
            <button
              type="button"
              @click="decrementSeats()"
              class="relative -ml-px inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
              <span class="sr-only">Decrease Seat Count</span>
              <MinusCircleIcon class="h-5 w-5" aria-hidden="true" />
            </button>
            <InputGroup
              :disabled="loading.addingTeam"
              type="number"
              placeholder="Number of seats"
              v-model="numberOfSeats"
              class="col-span-4 flex-grow rounded-none"></InputGroup>
            <button
              type="button"
              @click="incrementSeats()"
              class="relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
              <span class="sr-only">Increase Seat Count</span>
              <PlusCircleIcon class="h-5 w-5" aria-hidden="true" />
            </button>

            <button
              @click="buySeats()"
              :disabled="loading.buyingSeats"
              class="mx-2 ml-4 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
              {{ loading.buyingSeats ? 'Buying Seats' : 'Buy Seats' }}
            </button>
            <ButtonGroup
              @click="cancelBuySeats()"
              text="cancel"
              size="sm"
              design="danger">
              Cancel
            </ButtonGroup>
          </div>
        </div>
      </div>
      <div class="flex">
        <button
          v-if="!addTeam"
          @click="addTeam = true"
          type="button"
          class="rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
          Create Team
        </button>
      </div>
    </div>
    <div class="flex items-center justify-between space-y-1">
      <div v-if="addTeam">
        <InputGroup
          :disabled="loading.addingTeam"
          placeholder="Team Name"
          v-model="teamName"
          class="flex-grow"></InputGroup>
        <span class="ml-4 flex-shrink-0">
          <button
            :disabled="loading.addingTeam"
            @click="createTeam()"
            type="button"
            class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
            Update
          </button>
          <button
            :disabled="loading.addingTeam"
            @click="
              teamName = '';
              addTeam = false;
            "
            type="button"
            class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
            Cancel
          </button>
        </span>
      </div>
    </div>

    <div class="mt-6 w-full divide-y">
      <dl class="w-full justify-between">
        <Disclosure
          v-slot="{ open }"
          v-for="(team, index) in currentUser.teams">
          <DisclosureButton class="w-full items-center">
            <div
              class="flex w-full items-center justify-between px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
              <dt class="items-center text-sm font-medium text-gray-500">
                <ChevronRightIcon
                  :class="open ? 'rotate-90 transform' : ''"
                  class="mt-2 h-5 w-5 text-indigo-500" />
                <span class="-mt-2">Team Name</span>
              </dt>
              <dd
                class="mt-1 flex items-center text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <InputGroup
                  :disabled="loading.updating"
                  placeholder="Team Name"
                  v-model="team.name"
                  class="flex-grow"></InputGroup>
                <span class="justify-right ml-4 mt-2 flex-shrink-0">
                  <button
                    :disabled="loading.updating"
                    @click="updateTeam(team)"
                    type="button"
                    class="rounded-md bg-gray-100 px-2 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Update
                  </button>
                  <button
                    :disabled="loading.deleting"
                    @click="deleteTeam(team, index)"
                    type="button"
                    class="rounded-md px-2 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Delete
                  </button>
                </span>
              </dd>
            </div>
          </DisclosureButton>
          <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-out"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0">
            <DisclosurePanel>
              <ul role="list" class="border-b text-sm">
                <span class="py-4 px-2 text-xs font-bold text-neutral-400"
                  >Members</span
                >
                <li
                  v-if="team.users && team.users.length"
                  v-for="(user, uIndex) in team.users"
                  :key="user.id">
                  <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="flex min-w-0 flex-1 items-center">
                      <div class="flex-shrink-0">
                        <img
                          class="h-12 w-12 rounded-full"
                          :src="user.profile_pic_url"
                          :alt="user.full_name" />
                      </div>
                      <div
                        class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                          <p
                            class="truncate text-sm font-medium text-indigo-600">
                            {{ user.full_name }}
                          </p>
                          <p
                            class="mt-2 flex items-center text-sm text-gray-500">
                            <EnvelopeIcon
                              class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                              aria-hidden="true" />
                            <span class="truncate">{{ user.email }}</span>
                          </p>
                        </div>
                        <div class="hidden md:block">
                          <div>
                            <p class="text-sm text-gray-900">
                              Joined on
                              {{ ' ' }}
                              <time :datetime="user.pivot.created_at"
                                >{{ formatDate(user.pivot.created_at) }}
                              </time>
                            </p>
                            <p
                              class="mt-2 flex items-center text-sm text-gray-500">
                              <CheckCircleIcon
                                class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                aria-hidden="true" />
                              {{ user.teamrole }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <span class="ml-4 flex-shrink-0">
                        <button
                          v-if="currentUser.id != user.id"
                          @click="deleteMember(user.id, uIndex, team.id, index)"
                          type="button"
                          class="rounded-md text-xs font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                          Delete
                        </button>
                      </span>
                    </div>
                  </div>
                </li>
                <li v-else>No Users</li>
              </ul>
              <ul
                role="list"
                class="divide-y divide-gray-200 px-4 py-2 text-sm font-bold">
                Pending Invites
                <li
                  v-if="team.invites && team.invites.length"
                  v-for="user in team.invites"
                  :key="user.id">
                  <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="flex min-w-0 flex-1 items-center">
                      <div class="flex-shrink-0">
                        <img
                          class="h-12 w-12 rounded-full"
                          :src="user.profile_pic_url"
                          :alt="user.full_name" />
                      </div>
                      <div
                        class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                          <p
                            class="truncate text-sm font-medium text-indigo-600">
                            {{ user.email }}
                          </p>
                          <p
                            class="mt-2 flex items-center text-sm text-gray-500">
                            <EnvelopeIcon
                              class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                              aria-hidden="true" />
                            <span class="truncate">{{ user.email }}</span>
                          </p>
                        </div>
                        <div class="hidden md:block">
                          <div>
                            <p class="text-sm text-gray-900">
                              Sent on
                              {{ ' ' }}
                              <time :datetime="user.updated"
                                >{{ formatDate(user.updated) }}
                              </time>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <span class="ml-4 flex-shrink-0">
                        <button
                          :disabled="loading.inviting"
                          @click="resendInvite(user.id)"
                          type="button"
                          class="rounded-md bg-gray-100 text-xs font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                          Resend Invite
                        </button>
                      </span>
                    </div>
                  </div>
                </li>
                <li v-else class="text-sm font-bold text-neutral-400">
                  No Users
                </li>
              </ul>
              <div class="mt-12 py-8 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-2">
                <dt class="text-sm font-medium text-gray-500 sm:pt-5">
                  Invite addition team members
                </dt>
                <dd
                  class="mt-1 flex items-center text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                  <span class="flex-grow">
                    <InputGroup
                      placeholder="Example@jov.ie"
                      v-model="team.memberToInvite"></InputGroup>
                  </span>
                  <span class="s ml-4 flex flex-shrink-0 items-start space-x-4">
                    <button
                      :disabled="loading.inviting"
                      @click="inviteMember(team, index)"
                      type="button"
                      class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                      Send Invite
                    </button>
                  </span>
                </dd>
              </div>
            </DisclosurePanel>
          </transition>
        </Disclosure>
      </dl>
    </div>
  </div>
</template>
<script>
import {
  CheckCircleIcon,
  ChevronRightIcon,
  PlusCircleIcon,
  MinusCircleIcon,
  EnvelopeIcon,
} from '@heroicons/vue/24/solid';
import InputGroup from '../../components/InputGroup.vue';
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
import TeamService from '../../services/api/team.service';
import UserService from '../../services/api/user.service';
import ButtonGroup from '../../components/ButtonGroup.vue';

export default {
  name: 'AccountTeam',
  components: {
    InputGroup,
    CheckCircleIcon,
    ChevronRightIcon,
    EnvelopeIcon,
    PlusCircleIcon,
    MinusCircleIcon,
    ButtonGroup,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
  },
  data() {
    return {
      loading: {
        updating: false,
        inviting: false,
        deleting: false,
        addingTeam: false,
      },
      errors: {},
      addTeam: false,
      teamName: '',
      numberOfSeats: 1,
      isBuySeats: false,
    };
  },
  watch: {
    numberOfSeats(val) {
      val = val ? parseInt(val) : 0;
      console.log('val');
      console.log(val);
      if (val == '' || val <= 1) {
        this.numberOfSeats = 1;
      }
    },
  },
  mounted() {
    window.analytics.page('Manage Team');
  },
  methods: {
    cancelBuySeats() {
      this.isBuySeats = false;
      this.numberOfSeats = 1;
    },
    showBuySeats() {
      this.isBuySeats = true;
    },
    incrementSeats() {
      this.numberOfSeats++;
    },
    decrementSeats() {
      this.numberOfSeats--;
    },
    buySeats() {
      this.loading.buyingSeats = true;
      UserService.buySeats(this.numberOfSeats)
        .then((response) => {
          response = response.data;
          if (response.status) {
            alert(response.message);
            this.isBuySeats = false;
            this.currentUser.current_team.current_subscription =
              response.subscription;
          } else {
            alert(response.message);
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.buyingSeats = false;
        });
    },
    createTeam() {
      this.loading.addingTeam = true;
      TeamService.createTeam({ name: this.teamName })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.currentUser.teams.push(response.team);
            this.teamName = '';
            this.addTeam = false;
            alert('added');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.addingTeam = false;
        });
    },
    updateTeam(team) {
      this.loading.updating = true;
      TeamService.updateTeam({ name: team.name }, team.id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            alert('Updated');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.updating = false;
        });
    },
    inviteMember(team, index) {
      this.loading.inviting = true;
      TeamService.inviteMember({ email: team.memberToInvite }, team.id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.currentUser.teams[index].memberToInvite = '';
            this.currentUser.teams[index] = response.teams;
            alert(response.message);
          } else {
            alert(response.message);
            this.currentUser.teams[index].memberToInvite = '';
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.inviting = false;
        });
    },
    deleteTeam(team, index) {
      this.loading.deleting = true;
      TeamService.deleteTeam(team.id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            if (
              this.currentUser.current_team.id ==
              this.currentUser.teams[index].id
            ) {
              this.$store.commit('switchTeam', null);
            }
            this.currentUser.teams.splice(index, 1);
            alert('deleted');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.deleting = false;
        });
    },
    deleteMember(userId, uIndex, teamId, tIndex) {
      this.loading.deleting = true;
      TeamService.deleteMember(teamId, userId)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.currentUser.teams[tIndex].users.splice(uIndex, 1);
            alert('deleted');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.deleting = false;
        });
    },
    resendInvite(inviteId) {
      this.loading.inviting = true;
      TeamService.resendInvite(inviteId)
        .then((response) => {
          response = response.data;
          if (response.status) {
            alert('Sent');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.loading.inviting = false;
        });
    },
  },
};
</script>
