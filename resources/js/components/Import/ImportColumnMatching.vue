<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto rounded-md shadow-lg shadow-indigo-700/20 px-8 max-w-7xl mt-8 py-24 items-center h-full justify-center ">
            <div v-for="column in columns" key="column.name" class="grid grid-cols-2">   
                <div class="text-sm text-indigo-700 font-bold px-8 text-center mx-auto items-center">
                    {{column.name}}
                </div> 
                <div class="px-4">
                    <SelectMenu></SelectMenu>
                </div>                        
            </div>
        </div>
    </div>
</template>
<script>
import SelectMenu from "../SelectMenu.vue";



export default {
    name: "ImportColumnMatching",
    components: {
        SelectMenu
    },
    data() {
        return {
            columns: [
                    {
                        name: 'First Name',
                        type: 'text',
                        field: 'first_name',
                    },
                    {
                        name: 'Last Name',
                        type: 'text',
                        field: 'last_name',
                    },
                    {
                        name: 'Email',
                        type: 'email',
                        field: 'email',
                    },
                    {
                        name: 'Phone',
                        type: 'text',
                        field: 'phone',
                    }
                ],

        }
    },

}
</script>
