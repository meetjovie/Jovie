<template>
   <div class="grid grid-cols-6 text-center items-center mt-1">
       <div v-for="sociallink in sociallinks" :key="sociallink" class="justify-center items-center mx-auto">
            <div class="justify-center mx-auto text-center">
                <img height="12" width="12" class="mx-auto" :src="sociallink.url" />
            </div>
            <div class="text-2xs text-center mx-auto">{{sociallink.followers}}</div>
        </div>
   </div>
</template>
<script>
export default {
    data() {
        return {
            sociallinks: [
                    {url: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
                    followers: '800K'},
                    {url: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
                    followers: '72K'},
                    {url: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
                    followers: '104K'},
                    {url: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
                    followers: '22M'},
                    {url: 'https://unpkg.com/simple-icons@v6/icons/snapchat.svg',
                    followers: '1.2M'},
                    {url: 'https://unpkg.com/simple-icons@v6/icons/onlyfans.svg',
                    followers: '10K'},
                ]
        }
    },
}
</script>
