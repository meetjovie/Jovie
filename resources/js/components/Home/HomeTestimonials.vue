<template>
  <section
    tabindex="-1"
    class="relative mx-auto my-20 max-w-7xl px-4 focus:outline-none sm:px-3 md:px-5">
    <h2 class="sr-only">Testimonials</h2>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
      <figure
        class="dark:highlight-white/5 relative flex flex-col-reverse rounded-lg bg-neutral-50 p-6 dark:bg-neutral-800"
        v-for="card in cards"
        :key="card.id">
        <blockquote class="mt-6 text-neutral-700 dark:text-neutral-300">
          <p>{{ card.quote }}</p>
        </blockquote>
        <figcaption class="flex items-center space-x-4">
          <img
            :src="asset('img/External/Pepijn_vann_Kesteren.webp')"
            alt=""
            class="h-14 w-14 flex-none rounded-full object-cover"
            loading="lazy"
            decoding="async" />
          <div class="flex-auto">
            <div
              class="text-base font-semibold text-neutral-900 dark:text-neutral-300">
              <a href="#" tabindex="0"
                ><span class="absolute inset-0"></span>{{ card.name }}</a
              >
            </div>
            <div class="mt-0.5">{{ card.title }}, {{ card.company }}</div>
          </div>
        </figcaption>
      </figure>
    </div>
  </section>
</template>
<script>
//add props for cards
export default {
  props: {
    cards: {
      type: Object,
      required: true,
      //set the default props
      default: () => [
        {
          id: 1,
          name: 'Pepijn Vann Kesteren',
          title: 'CEO',
          company: 'Zelf',
          image: 'img/External/Pepijn_vann_Kesteren.webp',
          quote:
            'Jovie did for us in 2 weeks what we had been trying to do for 3 months… Never had we seen such fast adoption by creators.',
        },
        {
          id: 2,
          name: 'Daniel Kang',
          title: 'Founder & CEO',
          company: 'Flowbo',
          image: 'img/External/Larry_Page.webp',

          quote: 'Jovie is slick & the onboarding',
        },
        {
          id: 3,
          name: 'Elon Musk',
          title: 'Founder & CEO',
          company: 'Tesla',
          image: 'img/External/Elon_Musk.webp',
          quote: 'Jove is out of this world.',
        },
        {
          id: 4,
          name: 'Jeff Bezos',
          title: 'Founder & CEO',
          company: 'Amazon',
          image: 'img/External/Jeff_Bezos.webp',
          quote: 'CRMs suck. But with Jovie, I can finally get some work done.',
        },
        {
          id: 5,
          name: 'Mark Zuckerberg',
          title: 'Founder & CEO',
          company: 'Facebook',
          image: 'img/External/Mark_Zuckerberg.webp',
          quote: 'No understands how to build CRMs for Genz. Jovie does.',
        },
        {
          id: 6,
          name: 'Elliot Alderson',
          title: 'System Administrator',
          company: 'E Corp',
          image: 'img/External/Elliot_Alderson.webp',
          quote: ' Jovie makes it easy to keep track of everyone I hack.',
        },
      ],
    },
  },
};
</script>
