<template>
    <div class="grid grid-cols-4 py-4 px-2 gap-y-2">
        <InputGroup class="col-span-4" icon="PhotographIcon" text="ContentSearch" placeholder="Search" label="Search" type="input" />
        <div>Network1</div>
        <div>Content Search</div>
        <div>Tags and Categories</div>
        <MultiButton />
        <InputGroup class="col-span-4" icon="LocationMarkerIcon" placeholder="Location" />
        
       <div class="col-span-4">
           <RangeFilter name="Follower"/>
           <RangeFilter name="Engagement"/>
        </div> 
    
       
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