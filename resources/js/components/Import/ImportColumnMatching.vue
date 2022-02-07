<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto mt-8 py-24 items-center h-full justify-center grid gap-x-4 grid-flow-col auto-cols-max">
            <div v-for="column in columns" key="column.name">
                        <div class="rounded-md shadow-lg shadow-indigo-700/20">
                            <div class="bg-white rounded-t-md text-sm text-indigo-700 font-bold px-8 text-center mx-auto border-b border border-neutral-300 py-2">{{column.name}}</div> 
                            <div class="w-72 py-6 px-4"><SelectMenu></SelectMenu></div>   
                            <div class="cursor-pointer hover:bg-neutral-700 active:text-white active:bg-indigo-500 hover:text-white rounded-b-md px-8 py-2 font-bold text-neutral-400 text-center text-xs">Skip</div> 
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