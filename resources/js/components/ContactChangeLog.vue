<template>
    <div class="pl-6">
        <div class="pt-6 pb-2">
            <h2 class="text-sm font-semibold">Change Log</h2>
        </div>
        <div>
            <ul role="list" class="divide-y divide-slate-200">
                <li v-for="change in contactChangeLog" :key="change.id" class="py-4">
                    <div class="flex space-x-3">
                        <ContactAvatar
                            :imageUrl="change.user.profile_pic_url"
                            size="xxsm"
                            :name="change.user.full_name"/>
                        <div class="flex-1 space-y-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium">
                                    {{ change.user.first_name }}
                                </h3>
                                <p class="text-sm text-slate-500">
                                    {{ formatDate(change.created_at) }}
                                </p>
                            </div>
                            <template v-for="text in change.modification_texts">
                                <div class="text-sm text-slate-500">
                                    <p v-html="text"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="border-t border-slate-200 py-4 text-sm">
                <a
                    href="#"
                    @click="getContactChangeLog((page+1))"
                    class="font-semibold text-indigo-600 hover:text-indigo-900"
                >View more... <span aria-hidden="true">&rarr;</span></a
                >
            </div>
        </div>
    </div>
</template>
<script>
import ContactAvatar from './Contact/ContactAvatar.vue';
import ContactService from "../services/api/contact.service";

export default {
    name: 'ContactChangeLog',
    components: {ContactAvatar},
    props: {
        contact_id: {
            required: true
        }
    },
    data() {
        return {
            contactChangeLog: [],
            loading: true,
            page: 1,
            last_page: null
        };
    },
    mounted() {
        this.getContactChangeLog()
    },
    methods: {
        getContactChangeLog(page = 1) {
            if (this.last_page && page > this.last_page) {
                return
            }
            this.page = page
            ContactService.getContactChangeLog(this.contact_id, page).then((response) => {
                response = response.data;
                if (response.status) {
                    this.contactChangeLog = this.contactChangeLog.concat(response.data.data)
                    this.last_page = response.data.last_page
                } else {
                    this.$notify({
                        group: 'user',
                        type: 'error',
                        duration: 15000,
                        title: 'Error',
                        text: response.message,
                    });
                }
            }).catch((error) => {
            }).finally((response) => {
                this.loading = false
            });
        }
    }
};
</script>
