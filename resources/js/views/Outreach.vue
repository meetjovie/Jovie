<template>
    <div  class="w-full">
        <div class="flex justify-between border-b bg-white w-full">
            <div cla>
                <TabGroup as="div" class="mt-2">
                        <div class="border-gray-200">
                        <SubNav :tabs="tabs"></SubNav>
                        </div>
                    <TabPanels class="w-full border-2">
                        <TabPanel>
                            <Sequences></Sequences>    
                        </TabPanel>
                        <TabPanel>Content 2</TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </div>
</template>

<script>
import SubNav from '../components/SubNav.vue'
import Sequences from '../views/Outreach/Sequences.vue'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
export default {
    name: "Outreach",
    components: {
        SubNav,
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
        Sequences,
    },
    data() {
        return {
            tabs: [
                {
                    name: 'Sequences',
                    otherProperty: 'tab1'
                },
                {
                    name: 'Emails',
                    otherProperty: 'tab2'
                },
                {
                    name: 'Templates',
                    otherProperty: 'tab3'
                },
                {
                    name: 'Mailboxes',
                    otherProperty: 'tab4'
                },
                {
                    name: 'Settings',
                    otherProperty: 'tab5'
                }
            ]
        }
    }
}
</script>

