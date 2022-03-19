<template>
  <div class="grid grid-cols-4 gap-y-2 py-4 px-2">
    <InputGroup
      rounded="all"
      class="col-span-4"
      size="sm"
      icon="SearchIcon"
      text="ContentSearch"
      placeholder="Search" />
    <div class="col-span-4">
      <InputGroup
        icon="TagIcon"
        size="sm"
        text="TagsSearch"
        rounded="top"
        placeholder="Tags & Categories" />

      <InputGroup
        size="sm"
        class="-mt-1"
        icon="LocationMarkerIcon"
        rounded="bottom"
        placeholder="Location" />
    </div>
    <div class="col-span-4 grid grid-cols-3">
      <ButtonGroup
        size="xs"
        rounded="left"
        style="secondary"
        class="rounded-tl-md"
        icon="LocationMarkerIcon"
        text="Male" />
      <ButtonGroup
        size="xs"
        rounded="none"
        style="secondary"
        icon="LocationMarkerIcon"
        text="Female" />
      <ButtonGroup
        size="xs"
        rounded="right"
        style="secondary"
        icon="LocationMarkerIcon"
        text="Other" />
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

    <star-rating
      class="col-span-4"
      star-size="12"
      increment="0.5"></star-rating>

    <InputGroup
      class="col-span-4"
      shadow="false"
      icon="BriefcaseIcon"
      size="sm"
      placeholder="Brand Mentions" />
    <div class="col-span-4"><LocationSelector class="z-30" show="true" /></div>

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
import LocationSelector from '../LocationSelector.vue';

export default {
  components: {
    InputGroup,
    ButtonGroup,
    MultiButton,
    RangeFilter,
    LocationSelector,
  },
};
</script>
