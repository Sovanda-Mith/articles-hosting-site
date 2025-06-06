 <template>
    <Header></Header>
        <div class="flex flex-row justify-center items-start ml-72 mr-40 mt-20 mb-32 sm:ml-32  ">

            <div class="flex flex-col lg:pr-8 xl:pr-32 ">

                <div class="sticky top-1/12 bg-white">
                    <div class=" flex items-center justify-between  px-4">
                        <div class=" flex flex-1 justify-center">
                            <div class="py-5 space-x-4 text-xl ">
                                <router-link to="/feed/foryou" active-class="active-tab">For You</router-link>
                                <router-link to="/feed/following" active-class="active-tab">Following</router-link>
                            </div>
                        </div>

                        <button class="border p-2 w-10 rounded-sm ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>

                    </div>
                </div>
                <div>
                    <router-view></router-view>
                </div>
            </div>

            <div class="hidden md:flex md:flex-col md:w-[40%] sticky top-1/12 min-w-[400px] xl:min-w-[400px] lg:min-w-[300px]">
                <div class="py-5 space-x-4 border-b-1 border-gray-300 ">
                    <div class="py-2 text-xl font-semibold border-black">Trending</div>
                </div>

                <div> 
                    <trending_preview
                        profile_img = "/feedpage_img/profile1.jpg"
                        publisherName="Sky_blue"
                        title="Nature Doesn't Rush, So Why Are You?"
                        pub_date="Mar 10"
                    />
                    <trending_preview
                        profile_img = "/feedpage_img/profile1.jpg"
                        publisherName="Sky_blue"
                        title="Nature Doesn't Rush, So Why Are You?"
                        pub_date="Mar 10"
                    />
                    <trending_preview
                        profile_img = "/feedpage_img/profile1.jpg"
                        publisherName="Sky_blue"
                        title="Nature Doesn't Rush, So Why Are You?"
                        pub_date="Mar 10"
                    />
                    <trending_preview
                        profile_img = "/feedpage_img/profile1.jpg"
                        publisherName="Sky_blue"
                        title="Nature Doesn't Rush, So Why Are You?"
                        pub_date="Mar 10"
                    />
                    <trending_preview
                        profile_img = "/feedpage_img/profile1.jpg"
                        publisherName="Sky_blue"
                        title="Nature Doesn't Rush, So Why Are You?"
                        pub_date="Mar 10"
                    />
                    <router-link to="/feed/trending" active-class="active-tab" class="text-sm text-gray-500 hover:underline  ">See the full list</router-link>
                </div>
            </div>
        </div>
</template>  

<script lang="ts">
import Header from '../../components/landingPage_comp/Header.vue'; 
import preview from "../../../resources/components/feedpage_comp/preview.vue";
import trending_preview from "../../../resources/components/feedpage_comp/trending_preview.vue";

  export default {
    components: {
        Header,
        preview,
        trending_preview,
    }
}
</script>

<style scoped>
.active-tab {          
  font-weight: bold;
  border-bottom: 2px solid black; 
}
</style> 
