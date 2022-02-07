<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto bg-white rounded-md shadow-lg shadow-indigo-700/20 max-w-7xl mt-12 py-8 items-center h-full justify-center ">
        <div class="text-center py-4 font-bold text-md">Select columns to import</div>
            <table class="w-full"> 
                <tr class="bg-indigo-500 text-white">
                    <th class="sr-only">Number</th>
                    <th>Property</th>
                    <th>Column</th>
                </tr>
                <tr v-for="column in columns" key="column.name" class="text-center odd:bg-white even:bg-indigo-100">
                    <td class="text-sm w-6 text-neutral-400 font-bold pl-2 text-left mx-auto items-center">
                        1
                    </td> 
                    <td class="text-sm text-indigo-700 font-bold py-2 text-left mx-auto items-center">
                        {{column.name}}
                    </td> 
                    <td class="pl-4 items-center">
                        <SelectMenu></SelectMenu>
                    </td>  
                </tr>                        
            </table>
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
