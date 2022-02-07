<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto bg-white rounded-md shadow-lg shadow-indigo-700/20 max-w-5xl mt-12 items-center h-full justify-center ">
        <div class="text-center py-4 font-bold text-md">Select columns to import</div>
            <table class="w-full rounded-md-b"> 
                <tr class="bg-indigo-500 text-white">
                    <th class="font-medium">Columns from <span class="font-bold">imports.csv</span></th>
                    <th>Import to...</th>
                </tr>
                <tr v-for="column in columns" key="column.name" class="text-center rounded-md odd:bg-white even:bg-indigo-100">
                    <td class="pl-4 justify-center items-center">
                       
                        <SelectMenu class="inline w-72"></SelectMenu>
                    </td>  
                    <td class="text-sm last:rounded-md-br text-indigo-700 font-bold py-2 text-center mx-auto items-center">
                        {{column.name}}
                    </td> 
                </tr>                        
            </table>
            <ButtonGroup :text="Finish"></ButtonGroup>
        </div>
    </div>
    
</template>
<script>
import SelectMenu from "../SelectMenu.vue";
import ButtonGroup from "../ButtonGroup.vue";



export default {
    name: "ImportColumnMatching",
    components: {
        SelectMenu,
        ButtonGroup,
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
