<template>
    <div class="grid grid-cols-4 py-4 px-2 gap-y-2">
        <InputGroup class="col-span-4" icon="PhotographIcon" text="ContentSearch" placeholder="Search" label="Search" />
        <div>Network1</div>
         <InputGroup class="col-span-4" icon="TagIcon" text="TagsSearch" placeholder="Tags" />
         <SelectMenu />
        <div>Content Search</div>
        <div>Tags and Categories</div>
        <MultiButton />
        <InputGroup class="col-span-4" icon="LocationMarkerIcon" placeholder="Location" />
        
       <div class="col-span-4">
            <div class="mt-4">
                <RangeFilter preset1="Micro" preset2="Macro" preset3="1M+" label="Followers" minicon="UserIcon" maxicon="UsersIcon" mintext="Min" maxtext="Max" name="Follower"/>
            </div>
            <div class="mt-4">
                <RangeFilter preset1="1%" preset2="2%" preset3="5%" label="Engagement Rate" minicon="ArrowSmDownIcon" maxicon="ArrowSmUpIcon" mintext="Min" maxtext="Max" name="Engagement"/>
            </div>
        </div> 
    <InputGroup class="col-span-4" icon="BriefcaseIcon" placeholder="Brand Mentions" />
       
        <div class="col-span-4 justify-right text-right">
            <ButtonGroup text="Search" class="w-full">Search</ButtonGroup>
            <span class="text-indigo-500 justify-right text-xs text-right cursor-pointer">Reset</span>
        </div>
    </div>
</template>
<script>
import InputGroup from '../InputGroup.vue'
import ButtonGroup from '../ButtonGroup.vue'
import MultiButton from '../MultiButton.vue'
import RangeFilter from '../RangeFilter.vue'


export default {
    components: {
        InputGroup,
        ButtonGroup,
        MultiButton,
        RangeFilter,

    },
    
}
</script>