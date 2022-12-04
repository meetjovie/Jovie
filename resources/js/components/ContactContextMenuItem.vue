<template>
  <div>
    <div v-for="contactMethod in contactMethods" :key="contactMethod">
      <div v-if="contactMethod == 'email'">
        <MenuItem
          :disabled="!creator.emails[0] && !creator.meta.emails[0]"
          v-slot="{ active }"
          class="items-center">
          <button
            @click="emailCreator(creator.emails[0] || creator.meta.emails[0])"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <EnvelopeIcon class="mr-2 inline h-4 w-4 text-indigo-400" />
            Email
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'phone'">
        <MenuItem
          :disabled="!creator.meta.phone && !creator.phone"
          v-slot="{ active }"
          class="items-center">
          <button
            @click="callCreator(creator.meta.phone || creator.phone)"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <PhoneIcon class="mr-2 inline h-4 w-4 text-pink-400" />
            Call
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'sms'">
        <MenuItem
          :disabled="!creator.meta.phone && !creator.phone"
          v-slot="{ active }"
          class="items-center">
          <button
            @click="textCreator(creator.meta.phone || creator.phone)"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <ChatBubbleLeftEllipsisIcon
              class="darktext-blue-600 mr-2 inline h-4 w-4 text-blue-400" />
            Send SMS
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'calendar'">
        <MenuItem v-slot="{ active }" class="items-center">
          <button
            @click="createCalendarEvent(creator)"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <CalendarDaysIcon class="mr-2 inline h-4 w-4 text-indigo-400" />
            Create Calendar Event
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'twitter'">
        <MenuItem v-slot="{ active }" class="items-center">
          <button
            @click="sendTwitterDM(creator)"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <ChatBubbleLeftEllipsisIcon
              class="mr-2 inline h-4 w-4 text-social-twitter" />
            DM on Twitter
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'instagram'">
        <MenuItem
          :disabled="
            !creator.meta.instgaram_handler && !creator.instagram_handler
          "
          v-slot="{ active }"
          class="items-center">
          <button
            @click="
              instagramDMContact(
                creator.meta.instagram_handler || creator.instagram_handler
              )
            "
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <ChatBubbleOvalLeftEllipsisIcon
              class="mr-2 inline h-4 w-4 text-social-instagram" />
            Instagram DM
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'whatsapp'">
        <MenuItem
          :disabled="!creator.meta.phone && !creator.phone"
          v-slot="{ active }"
          class="items-center">
          <button
            @click="whatsappCreator(creator.meta.phone || creator.phone)"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <ChatBubbleOvalLeftEllipsisIcon
              class="mr-2 inline h-4 w-4 text-social-whatsapp" />
            Whatsapp
          </button>
        </MenuItem>
      </div>
      <div v-if="contactMethod == 'refresh'">
        <div v-if="currentUser.is_admin">
          <MenuItem
            v-slot="{ active }"
            class="items-center"
            @click="refresh(creator)"
            :disabled="adding">
            <a
              href="#"
              class="items-center text-slate-400 hover:text-slate-900"
              :class="[
                active
                  ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                  : 'text-slate-700 dark:text-slate-200',
                'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
              ]">
              <ArrowPathIcon class="mr-2 inline h-4 w-4" />
              Refresh</a
            >
          </MenuItem>
        </div>
      </div>
      <div v-if="contactMethod == 'verify'">
        <MenuItem
          :disabled="!creator.emails[0] && !creator.meta.emails[0]"
          v-slot="{ active }"
          class="items-center">
          <button
            @click="verifyEmail(creator.meta.emails[0] || creator.emails[0])"
            :class="[
              active
                ? 'bg-slate-100 text-slate-900 dark:bg-slate-700 dark:text-slate-100'
                : 'text-slate-700 dark:text-slate-200',
              'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
            ]">
            <CheckCircleIcon class="mr-2 inline h-4 w-4 text-slate-500" />
            Verify Email
          </button>
        </MenuItem>
      </div>
    </div>
  </div>
</template>

<script>
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  TransitionRoot,
} from '@headlessui/vue';
import {
  ChevronDownIcon,
  EnvelopeIcon,
  ChatBubbleLeftEllipsisIcon,
  EllipsisVerticalIcon,
  ChatBubbleOvalLeftEllipsisIcon,
  PhoneIcon,
  TrashIcon,
  ArchiveBoxIcon,
  ArrowPathIcon,
  CloudArrowDownIcon,
  CalendarDaysIcon,
  CheckCircleIcon,
} from '@heroicons/vue/24/solid';
import { Float } from '@headlessui-float/vue';

export default {
  name: 'ContactMenuItem',
  components: {
    Menu,
    MenuButton,
    MenuItems,
    CheckCircleIcon,
    MenuItem,
    TransitionRoot,
    ChevronDownIcon,
    EllipsisVerticalIcon,
    CloudArrowDownIcon,
    EnvelopeIcon,
    ChatBubbleLeftEllipsisIcon,
    ChatBubbleOvalLeftEllipsisIcon,
    PhoneIcon,
    TrashIcon,
    ArchiveBoxIcon,
    ArrowPathIcon,
    Float,
    CalendarDaysIcon,
  },
  props: {
    creator: {
      type: Object,
      required: true,
    },
    contactMethods: {
      type: Array,
      required: false,
    },
  },
  methods: {
    createCalendarEvent(creator) {
      window.open(
        `https://calendar.google.com/calendar/r/eventedit?text=${
          this.currentUser.first_name
        } ${this.currentUser.last_name} <> ${
          creator.meta.name
        }&details=Created by ${this.currentUser.first_name} ${
          this.currentUser.last_name
        } on ${new Date().toLocaleDateString()}&location=&trp=false&sprop=&sprop=name:&dates=20200501T000000Z/20200501T000000Z&add=${
          creator.meta.emails[0] || creator.emails[0] || ''
        }&notes='Created via Jovie: https://jov.ie`
      );
    },
    emailCreator(email) {
      //go to the url mailto:creator.emails[0]
      //if email is not null
      if (email) {
        window.open('mailto:' + email);
        //else log no email found
      } else {
        console.log('No email found');
        this.$notify({
          title: 'No email found',
          message: 'This contact does not have an email address',
          type: 'warning',
          group: 'user',
        });
      }
    },
    sendTwitterDM(creator) {
      // check if either of the twitter ID fields are present
      if (creator.meta.twitter_meta.id || creator.twitter_meta.id) {
        // if either of the fields are present, open a new twitter DM
        // and pre-populate it with the message "Hey there!"
        window.open(
          `https://twitter.com/messages/compose?recipient_id=${
            creator.meta.twitter_meta.id || creator.twitter_meta.id
          }&text=Hey%20there!`
        );
      } else {
        // if neither of the fields are present, return a message
        console.log('No twitter id found');
        this.$notify({
          title: 'No twitter id found',
          message: 'This contact does not have a twitter id',
          type: 'warning',
          group: 'user',
        });
        return;
      }
    },
    callCreator(phone) {
      //go to the url tel:creator.meta.phone
      //if phone is not null
      if (phone) {
        window.open('tel:' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    whatsappCreator(phone) {
      //go to the url tel:creator.meta.phone
      //if phone is not null
      if (phone) {
        console.log('whatsapp');
        //open whatsapp://send?text=Hello World!&phone=+phone
        window.open('whatsapp://send?text=Hey!&phone=+' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    instagramDMContact(username) {
      if (username.includes('instagram.com')) {
        username = username.split('instagram.com/')[1];
      }
      if (username) {
        window.open('https://ig.me/m/' + username);
      } else {
        console.log('No instagram username found');
        this.$notify({
          title: 'No instagram username found',
          message: 'This contact does not have an instagram username',
          type: 'warning',
          group: 'user',
        });
      }
    },
    textCreator(phone) {
      //go to the url sms:creator.meta.phone
      //if phone is not null
      if (phone) {
        window.open('sms:' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    // define the method
    verifyEmail(email) {
      // extract the domain of the email address
      const domain = email.split('@')[1];

      // use the fetch method to send a GET request to the Google DNS over HTTPS endpoint
      fetch(`https://dns.google.com/resolve?name=${domain}&type=MX`)
        .then((response) => response.json())
        .then((data) => {
          if (data.Answer) {
            // if the response contains an Answer field, the email address is valid
            console.log('Email appears valid');
            this.$notify({
              title: 'Email valid',
              message: 'This email address appears to be valid',
              type: 'success',
              group: 'user',
            });
            return true;
          } else {
            // if the response does not contain an Answer field, the email address is not valid
            console.log('Email appears invalid');
            this.$notify({
              title: 'Email invalid',
              message: 'This email address may not valid',
              type: 'warning',
              group: 'user',
            });
            return false;
          }
        });
    },
  },
};
</script>
