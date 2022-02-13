<template>
    <div>
        
        <main>  
            <HomeHeroSection></HomeHeroSection>
            <HomeLogoCloud></HomeLogoCloud>
            <HomeFeatureDiscovery id="discovery"></HomeFeatureDiscovery>
            <HomeFeatureCRM id="crm"></HomeFeatureCRM>
            <HomeFeatureSequences></HomeFeatureSequences>
            <HomeCTA></HomeCTA>
            <HomeTestimonials></HomeTestimonials>
            <HomeCTA2></HomeCTA2>
        </main>
    </div>
</template>

<style>

</style>
<script>
import {
    InboxIcon,
    PencilAltIcon,
    TrashIcon,
    UsersIcon,
    ChevronDownIcon,
    SearchIcon,
    UserGroupIcon,
    MailIcon
} from '@heroicons/vue/outline'
import UserService from "../services/api/user.service";
import {useAuth0} from "../utils/useAuth0";
import HomeLogoCloud from "../components/Home/HomeLogoCloud";
import HomeFeatureSequences from "../components/Home/HomeFeatureSequences";
import HomeFeatureDiscovery from "../components/Home/HomeFeatureDiscovery";
import HomeHeroSection from "../components/Home/HomeHeroSection";
import HomeCTA from "../components/Home/HomeCTA";
import HomeTestimonials from "../components/Home/HomeTestimonials";
import HomeCTA2 from "../components/Home/HomeCTA2";
import HomeFeatureCRM from "../components/Home/HomeFeatureCRM";
import { Popover, PopoverButton, PopoverPanel, PopoverOverlay } from '@headlessui/vue'


const {login, logout, initAuth} = useAuth0();

export default {
    name: "Home",
    components: {
        HomeLogoCloud,
        HomeFeatureSequences,
        HomeFeatureDiscovery,
        HomeHeroSection,
        HomeCTA,
        HomeTestimonials,
        HomeCTA2,
        HomeFeatureCRM,
        Popover,
        PopoverButton,
        PopoverPanel,
        PopoverOverlay,
        ChevronDownIcon,
        UserGroupIcon,
        SearchIcon,
        MailIcon
    },
    setup() {
        initAuth();
    },
    data() {
        return {
            features: [
                {
                    name: 'Discover creators by the products they use',
                    description: 'Jovie can see if a creator is wearing glass, holding an iPhone, or riding a skateboard. ',
                    icon: InboxIcon,
                },
                {
                    name: 'Identify Brands within content',
                    description: 'Search for Starbucks logos in Tiktok videos, or people wearing Prada on Instagram.',
                    icon: UsersIcon,
                },
                {
                    name: 'Brand Saftey',
                    description: 'Jovie can identify & restrict creators who post content that may not be suitable for your brand. ',
                    icon: TrashIcon,
                },
                {
                    name: 'Exclusion',
                    description: 'Jovie can check to make creators you partner with have never promoted a competing product.',
                    icon: PencilAltIcon,
                },
            ],
            
            waitListEmail: '',
            error: null
        }
    },
    methods: {
        login() {
            login()
        },
        logout() {
            logout()
        },
        async requestDemo() {
            await UserService.addToWaitList({email: this.waitListEmail}).then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('setAddedToWaitList')
                    this.waitListEmail = ''
                    this.error = null
                    this.$router.push('demo')
                }
            }).catch(error => {
                error = error.response
                if (error.status == 422) {
                    this.error = error.data.errors.email[0]
                }
            })
        }
    }
}
</script>
