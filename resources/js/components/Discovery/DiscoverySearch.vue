<template>
    <div class="grid grid-cols-4 py-4 px-2 gap-y-2">
        <InputGroup class="col-span-4" :icon="PhotographIcon" :name="ContentSearch" :placeholder="Search" :label="Search" :type="input" />
        <div>Network1</div>
        <div>Content Search</div>
        <div>Tags and Categories</div>
        <div>Location</div>
        <div>Gender</div>
        <ButtonGroup :icon="SearchIcon"/>
        <MultiButton :name="Email"/>
        <div>Verified, private, favorite, muted</div>
        <div>Email</div>
        <div>Engagment Filter</div>
        <div>Follower Count<br>with EF toggle</div>
        <div>Brand Mentions</div>
        <div class="col-span-4 justify-right text-right">
            <ButtonGroup :icon="SearchIcon" :name="search" class="w-full">Search</ButtonGroup>
            <span class="text-indigo-500 justify-right text-xs text-right cursor-pointer">Reset</span>
        </div>
    </div>
</template>
<script>
import InputGroup from '../InputGroup.vue'
import ButtonGroup from '../ButtonGroup.vue'
import MultiButton from '../MultiButton.vue'


export default {
    components: {
        InputGroup,
        ButtonGroup,
        MultiButton,
       



    },
}
</script>