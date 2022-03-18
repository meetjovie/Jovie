<template>
    <div class="mt-10 divide-y divide-gray-200">
        <div class="space-y-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Team</h3>
            <p class="max-w-2xl text-sm text-gray-500">
                Invite collaborators to join your team.
            </p>
        </div>
        <div class="space-y-1">
            <button
                v-if="!addTeam"
                @click="addTeam = true"
                type="button"
                class="rounded-md bg-red-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                Add New Team
            </button>
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
                        @click="teamName = ''; addTeam = false"
                        type="button"
                        class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                Cancel
              </button>
            </span>
            </div>
        </div>

        <div class="mt-6">
            <dl class="divide-y">
                <Disclosure v-for="(team, index) in currentUser.teams">
                    <DisclosureButton>
                        <div
                            class="items-center py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                            <dt class="text-sm font-medium text-gray-500">Team Name</dt>
                            <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <InputGroup
                                    :disabled="loading.updating"
                                    placeholder="Team Name"
                                    v-model="team.name"
                                    class="flex-grow"></InputGroup>
                                <span class="ml-4 flex-shrink-0">
                                  <button
                                      :disabled="loading.updating"
                                      @click="updateTeam(team)"
                                      type="button"
                                      class="rounded-md bg-gray-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                                    Update
                                  </button>
                                    <button
                                        :disabled="loading.deleting"
                                        @click="deleteTeam(team, index)"
                                        type="button"
                                        class="rounded-md bg-red-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                                    Delete
                                  </button>
                                </span>
                            </dd>
                        </div>
                    </DisclosureButton>
                    <DisclosurePanel>
                        <ul role="list" class="divide-y divide-gray-200">
                            Joined Members
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
                                                :alt="user.full_name"/>
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
                                                    <MailIcon
                                                        class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                        aria-hidden="true"/>
                                                    <span class="truncate">{{
                                                            user.email
                                                        }}</span>
                                                </p>
                                            </div>
                                            <div class="hidden md:block">
                                                <div>
                                                    <p class="text-sm text-gray-900">
                                                        Joined on
                                                        {{ ' ' }}
                                                        <time :datetime="user.pivot.created_at">{{
                                                                formatDate(user.pivot.created_at)
                                                            }}
                                                        </time>
                                                    </p>
                                                    <p
                                                        class="mt-2 flex items-center text-sm text-gray-500">
                                                        <CheckCircleIcon
                                                            class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                                            aria-hidden="true"/>
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
                                            class="rounded-md bg-red-100 text-xs font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                                          Delete
                                        </button>
                                      </span>
                                    </div>
                                </div>
                            </li>
                            <li v-else>
                                No Users
                            </li>
                        </ul>
                        <ul role="list" class="divide-y divide-gray-200">
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
                                                :alt="user.full_name"/>
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
                                                    <MailIcon
                                                        class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                        aria-hidden="true"/>
                                                    <span class="truncate">{{
                                                            user.email
                                                        }}</span>
                                                </p>
                                            </div>
                                            <div class="hidden md:block">
                                                <div>
                                                    <p class="text-sm text-gray-900">
                                                        Sent on
                                                        {{ ' ' }}
                                                        <time :datetime="user.updated">{{
                                                                formatDate(user.updated)
                                                            }}
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
                            <li v-else>
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
                                    <InputGroup placeholder="Example@jov.ie" v-model="team.memberToInvite"></InputGroup>
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
                </Disclosure>
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
import {Disclosure, DisclosureButton, DisclosurePanel} from '@headlessui/vue';
import TeamService from "../../services/api/team.service";

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
    computed: {
        currentUser() {
            return this.$store.state.AuthState.user
        }
    },
    data() {
        return {
            loading: {
                updating: false,
                inviting: false,
                deleting: false,
                addingTeam: false
            },
            errors: {},
            addTeam: false,
            teamName: ''
        };
    },
    methods: {
        createTeam() {
            this.loading.addingTeam = true
            TeamService.createTeam({name: this.teamName}).then(response => {
                response = response.data
                if (response.status) {
                    this.currentUser.teams.push(response.team)
                    this.teamName = ''
                    this.addTeam = false
                    alert('added')
                }
            }).catch((error) => {
                error = error.response;
                if (error.status == 422) {
                    this.errors = error.data.errors;
                }
            }).finally(() => {
                this.loading.addingTeam = false;
            });
        },
        updateTeam(team) {
            this.loading.updating = true
            TeamService.updateTeam({name: team.name}, team.id).then(response => {
                response = response.data
                if (response.status) {
                    alert('Updated')
                }
            }).catch((error) => {
                error = error.response;
                if (error.status == 422) {
                    this.errors = error.data.errors;
                }
            }).finally(() => {
                this.loading.updating = false;
            });
        },
        inviteMember(team, index) {
            this.loading.inviting = true
            TeamService.inviteMember({email: team.memberToInvite}, team.id).then(response => {
                response = response.data
                if (response.status) {
                    this.currentUser.teams[index].memberToInvite = ''
                    this.currentUser.teams[index] = response.teams
                    alert('invited')
                }
            }).catch((error) => {
                error = error.response;
                if (error.status == 422) {
                    this.errors = error.data.errors;
                }
            }).finally(() => {
                this.loading.inviting = false;
            });
        },
        deleteTeam(team, index) {
            this.loading.deleting = true
            TeamService.deleteTeam(team.id).then(response => {
                response = response.data
                if (response.status) {
                    if (this.currentUser.current_team.id == this.currentUser.teams[index].id) {
                        this.$store.commit('switchTeam', null)
                    }
                    this.currentUser.teams.splice(index, 1)
                    alert('deleted')
                }
            }).catch((error) => {
                error = error.response;
                if (error.status == 422) {
                    this.errors = error.data.errors;
                }
            }).finally(() => {
                this.loading.deleting = false;
            });
        },
        deleteMember(userId, uIndex, teamId, tIndex) {
            this.loading.deleting = true
            TeamService.deleteMember(teamId, userId).then(response => {
                response = response.data
                if (response.status) {
                    this.currentUser.teams[tIndex].users.splice(uIndex, 1)
                    alert('deleted')
                }
            }).catch((error) => {
                error = error.response;
                if (error.status == 422) {
                    this.errors = error.data.errors;
                }
            }).finally(() => {
                this.loading.deleting = false;
            });
        },
        resendInvite(inviteId) {
            this.loading.inviting = true;
            TeamService.resendInvite(inviteId).then(response => {
                response = response.data
                if (response.status) {
                    alert('Sent')
                }
            }).catch((error) => {
                error = error.response;
                if (error.status == 422) {
                    this.errors = error.data.errors;
                }
            }).finally(() => {
                this.loading.inviting = false;
            });
        }
    }
};
</script>
