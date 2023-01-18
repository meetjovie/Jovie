<template>
    <Combobox v-model="selectedItem" v-slot="{ open }">
        <ComboboxInput
            class=""
            @change="query = $event.target.value"
            :displayValue="(item) => item.name"/>

        <div v-show="open">
            <!--
                Using the `static` prop, the `ComboboxOptions` are always
                rendered and the `open` state is ignored.
              -->
            <ComboboxOptions static>
                <ComboboxOption
                    v-for="item in filteredItems"
                    :key="item.id"
                    :value="item">
                    {{ item.name }}
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>

<script>
import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
} from '@headlessui/vue';
export default {
    components: {
        Combobox,
        ComboboxOption,
        ComboboxInput,
    },
    props: {
        items: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            selectedItem: '',
            query: '',
        }
    },
    computed: {
        filteredItems() {
            return this.query === ''
                ? this.items
                : this.items.filter((item) => {
                    return item.name.toLowerCase().includes(this.query.toLowerCase());
                })
        }
    },
    mounted() {
        this.selectedItem = this.items[0]
    }
}
</script>
