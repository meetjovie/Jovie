<template>
  <div>
    <div v-for="contactMethod in contactMethods" :key="contactMethod">
      <DropdownMenuItem
        v-if="contactMethod == 'email'"
        name="Email"
        color="text-purple-600 dark:text-purple-400"
        @click="emailContact(contact.emails[0])"
        :disabled="contact.emails && !contact.emails.length"
        icon="EnvelopeIcon" />
      <DropdownMenuItem v-if="contactMethod == 'separator'" separator />
      <DropdownMenuItem
        v-if="contactMethod == 'phone'"
        name="Call"
        color="text-blue-600 dark:text-blue-400"
        @click="callContact(contact.phones[0])"
        :disabled="contact.phones && !contact.phones.length"
        icon="PhoneIcon" />
      <DropdownMenuItem
        v-if="contactMethod == 'sms'"
        name="Send SMS"
        color="text-blue-600 dark:text-blue-400"
        @click="textContact(contact.phones[0])"
        :disabled="contact.phones && !contact.phones.length"
        icon="ChatBubbleLeftEllipsisIcon" />
      <DropdownMenuItem
        v-if="contactMethod == 'calendar'"
        name="Create Calendar Event"
        color="text-indigo-600 dark:text-indigo-400"
        @click="createCalendarEvent(contact)"
        icon="CalendarDaysIcon" />
      <DropdownMenuItem
        v-if="contactMethod == 'twitter'"
        name="DM on Twitter"
        color="text-twitter-600 dark:text-twitter-400"
        @click="sendTwitterDM(contact)"
        :disabled="!contact.twitter && !contact.twitter"
        icon="ChatBubbleLeftEllipsisIcon" />

      <DropdownMenuItem
        v-if="contactMethod == 'instagram'"
        name="Instagram DM"
        color="text-instagram-600 dark:text-instagram-400"
        @click="instagramDMContact(contact.instagram || contact.instagram)"
        :disabled="!contact.instgaram && !contact.instagram"
        icon="ChatBubbleLeftEllipsisIcon" />
      <DropdownMenuItem
        v-if="contactMethod == 'whatsapp'"
        name="Whatsapp"
        color="text-social-whatsapp"
        @click="whatsappContact(contact.phones[0])"
        :disabled="contact.phones && !contact.phones.length"
        icon="ChatBubbleOvalLeftEllipsisIcon" />

      <DropdownMenuItem
        v-if="contactMethod == 'verify'"
        name="Verify Email"
        color="text-slate-400 hover:text-slate-900"
        @click="verifyEmail(contact.emails[0])"
        :disabled="!contact.emails.length"
        icon="CheckCircleIcon" />
    </div>
  </div>
</template>

<script>
import DropdownMenuItem from '../components/DropdownMenuItem.vue';
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
    DropdownMenuItem,
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
    contact: {
      type: Object,
      required: true,
    },
    contactMethods: {
      type: Array,
      required: false,
    },
  },

  methods: {
    createCalendarEvent(contact) {
      const defaultNote =
        this.currentUser.workspace_preferences.calender_event_note;

      window.open(
        `https://calendar.google.com/calendar/r/eventedit?text=${
          this.currentUser.first_name
        } ${this.currentUser.last_name} <> ${
          contact.full_name
        }&details=${defaultNote} Created by ${this.currentUser.first_name} ${
          this.currentUser.last_name
        } on ${new Date().toLocaleDateString()}&location=&trp=false&sprop=&sprop=name:&dates=20200501T000000Z/20200501T000000Z&add=${
          contact.emails[0] || ''
        }&notes='Created via Jovie: https://jov.ie`
      );
    },
    emailContact(email) {
      //go to the url mailto:contact.emails[0]
      //if email is not null
      if (email) {
        window.open('mailto:' + email);
        //else log no email found
      } else {
        console.log('No emails found');
        this.$notify({
          title: 'No email found',
          message: 'This contact does not have an email address',
          type: 'warning',
          group: 'user',
        });
      }
    },
    sendTwitterDM(contact) {
      // check if either of the twitter ID fields are present
      if (contact.twitter_meta.id || contact.twitter_meta.id) {
        // if either of the fields are present, open a new twitter DM
        // and pre-populate it with the message "Hey there!"
        window.open(
          `https://twitter.com/messages/compose?recipient_id=${
            contact.twitter_meta.id || contact.twitter_meta.id
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
    callContact(phone) {
      //go to the url tel:contact.phone
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
    whatsappContact(phone) {
      //go to the url tel:contact.phone
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
    textContact(phone) {
      //go to the url sms:contact.phone
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
