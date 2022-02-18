<template>
  <div class="grid grid-cols-4 gap-y-2 py-4 px-2">
    <InputGroup
      class="col-span-4"
      icon="PhotographIcon"
      text="ContentSearch"
      placeholder="Search" />

    <InputGroup
      class="col-span-4"
      icon="TagIcon"
      text="TagsSearch"
      placeholder="Tags & Categories" />
    <SelectMenu />

    <MultiButton size="xs" />
    <InputGroup
      class="col-span-4"
      icon="LocationMarkerIcon"
      placeholder="Location" />
    <div class="col-span-4 grid grid-cols-3">
      <ButtonGroup size="xs" icon="LocationMarkerIcon" text="Male" />
      <ButtonGroup size="xs" icon="LocationMarkerIcon" text="Female" />
      <ButtonGroup size="xs" icon="LocationMarkerIcon" text="Other" />
    </div>

    <div class="col-span-4">
      <div class="mt-4">
        <RangeFilter
          preset1="Micro"
          preset2="Macro"
          preset3="1M+"
          label="Followers"
          minicon="UserIcon"
          maxicon="UsersIcon"
          mintext="Min"
          maxtext="Max"
          name="Follower" />
      </div>
      <div class="mt-4">
        <RangeFilter
          preset1="1%"
          preset2="2%"
          preset3="5%"
          label="Engagement Rate"
          minicon="ArrowSmDownIcon"
          maxicon="ArrowSmUpIcon"
          mintext="Min"
          maxtext="Max"
          name="Engagement" />
      </div>
    </div>
    <InputGroup
      class="col-span-4"
      icon="BriefcaseIcon"
      placeholder="Brand Mentions" />

    <div class="justify-right col-span-4 text-right">
      <ButtonGroup text="Search" class="w-full"></ButtonGroup>
      <span
        class="justify-right cursor-pointer text-right text-xs text-indigo-500"
        >Reset</span
      >
    </div>
  </div>
</template>
<script>
import InputGroup from '../InputGroup.vue';
import ButtonGroup from '../ButtonGroup.vue';
import MultiButton from '../MultiButton.vue';
import RangeFilter from '../RangeFilter.vue';

export default {
  components: {
    InputGroup,
    ButtonGroup,
    MultiButton,
    RangeFilter,
  },
};
</script>
