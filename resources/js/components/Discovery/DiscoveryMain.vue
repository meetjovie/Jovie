<template>
   <Stats class="mx-auto w-full sticky">
      <div class="grid grid-cols-4 border-b pb-2">
         <div class="mx-auto items-center">
            <div class="mt-1 text-2xl font-semibold text-indigo-500 text-center">1K</div>
            <div class="text-xs text-neutral-700 font-medium text-center">Est. Cost</div>
         </div>
         <div class="mx-auto items-center">
            <div class="mt-1 text-2xl font-semibold text-indigo-500 text-center">1.1B</div>
            <div class="text-xs text-neutral-700 font-medium text-center">Reach</div>
         </div>
         <div class="mx-auto items-center">
            <div class="mt-1 text-2xl font-semibold text-indigo-500 text-center">$0.45</div>
            <div class="text-xs text-neutral-700 font-medium text-center">CPE</div>
         </div>
         <div class="mx-auto items-center">
            <div class="mt-1 text-2xl font-semibold text-indigo-500 text-center">1M</div>
            <div class="text-xs text-neutral-700 font-medium text-center">Est. Impressions</div>
         </div>
   </div>
   </Stats>
   <CreatorTable>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(person, personIdx) in people" :key="person.email" :class="personIdx % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ person.name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ person.title }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ person.email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ person.role }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

   </CreatorTable>
</template>


<script>
const people = [
  { name: 'Jane Cooper', title: 'Regional Paradigm Technician', role: 'Admin', email: 'jane.cooper@example.com' },
  { name: 'Cody Fisher', title: 'Product Directives Officer', role: 'Owner', email: 'cody.fisher@example.com' },
  // More people...
]

export default {
  setup() {
    return {
      people,
    }
  },
}
</script>