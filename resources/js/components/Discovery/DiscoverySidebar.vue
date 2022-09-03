<template></template>
<script>
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
} from '@headlessui/vue';
import CreatorAvatar from '../Creator/CreatorAvatar.vue';
import CreatorContentBar from '../Creator/CreatorContentBar.vue';
import CreatorSocialLinks from '../Creator/CreatorSocialLinks.vue';
import {
  XMarkIcon,
  HeartIcon,
  NoSymbolIcon,
  ChartBarIcon,
  ChevronRightIcon,
  EllipsisVerticalIcon,
  ChevronDownIcon,
  ArchiveBoxIcon,
  DocumentDuplicateIcon,
  PlusIcon,
  UserIcon,
  HandThumbUpIcon,
  PlayIcon,
  ChatBubbleBottomCenterIcon,
  MapPinIcon,
} from '@heroicons/vue/24/solid';
import CreatorTags from '../Creator/CreatorTags.vue';

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
    CreatorAvatar,
    CreatorSocialLinks,
    XMarkIcon,
    CreatorTags,
    HeartIcon,
    NoSymbolIcon,

    EllipsisVerticalIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,

    PlusIcon,
    UserIcon,
    HandThumbUpIcon,
    PlayIcon,
    ChatBubbleBottomCenterIcon,
    MapPinIcon,
    CreatorContentBar,
  },
  data() {
    return {
      open: true,
      sociallinks: [
        {
          name: 'Facebook',
          followers: '1.5K',
          engagement: '3%',
          url: 'https://unpkg.com/simple-icons@v6/icons/facebook.svg',
        },
        {
          name: 'Twitter',
          followers: '13.2M',
          engagement: '3.5%',
          url: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
        },
        {
          name: 'YouTube',
          followers: '1.5M',
          engagement: '4.5%',
          url: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
        },
        {
          name: 'Tiktok',
          followers: '1.5K',
          engagement: '3%',
          url: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
        },
      ],
    };
  },
};
</script>
