<template>
    <div class="w-full h-screen bg-[#EDECEC] flex justify-center items-center">
        <div class="flex flex-col justify-center items-center gap-4 bg-white border-1 border-gray-200 shadow-2xl rounded-3xl p-5">
            <!-- logo -->
            <router-link to="/" class="w-fit h-fit ">
                <div class="logo_container flex justify-start items-center sm:gap-3">
                    <div class="logo w-[58px] h-[58px] rounded-[8px]">
                        <img src="/landingPage_img/logo.webp" alt="">
                    </div>
                </div>
            </router-link>


            <!-- content -->
            <div class="w-[680px] h-fit flex flex-col justify-center items-center gap-10 p-10">
                <!-- title -->
                <div class="flex flex-col max-w-[460px] justify-center items-center gap-1">
                    <h5>Create an account</h5>
                    <p class="text-center text-[#666666]">Welcome back! Sign in to access your writing space, continue your projects, and share your creativity with the world.</p>
                </div>

                <!-- input -->
                <div class="w-full flex flex-col gap-10">
                    <div class="relative bg-white rounded-lg w-full">
                        <input
                            placeholder="Email address"
                            class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                            id="defaultInput"
                            type="text"
                        />
                        <label
                            class="subtitle absolute left-2 top-0 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                            for="defaultInput"
                        >
                            Email address
                        </label>
                    </div>

                    <div class="relative bg-white rounded-lg w-full">
                        <input
                            placeholder="Username"
                            class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm  border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                            id="defaultInput"
                            type="text"
                        />
                        <label
                            class="subtitle absolute left-2 top-0 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                            for="defaultInput"
                        >
                            Username
                        </label>
                    </div>

                    <!-- password -->
                    <div class="flex flex-col justify-center items-center">
                        <div class="relative bg-white rounded-lg w-full">
                            <input
                                placeholder="Password"
                                class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm  border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                                id="defaultInput"
                                type="password"
                            />
                            <label
                                class="subtitle absolute left-2 top-0 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                                for="defaultInput"
                            >
                            Password
                            </label>
                        </div>

                        <div class="flex w-full justify-between items-center mt-2">

                            <ul class="Overline text-[#666666] opacity-90 list-disc pl-6 space-y-2 ">
                                <li>Use 8 or more characters</li>
                                <li>Use a number (e.g. 1234)</li>
                            </ul>

                            <ul class="Overline text-[#666666] opacity-90 list-disc pr-6 space-y-2">
                                <li>Use upper and lower case letters (e.g. Aa)</li>
                                <li>Use a symbol (e.g. !@#$)</li>
                            </ul>

                        </div>
                    </div>

                    <!-- get start button -->
                    <div class="flex flex-col gap-2">
                        <router-link to="/">
                            <div class="relative inline-flex items-center justify-center w-full gap-4 group">
                                <div
                                    class="absolute inset-0 duration-1000 opacity-60 transitiona-all bg-gradient-to-r from-indigo-500 via-pink-500 to-yellow-400 rounded-xl blur-lg filter group-hover:opacity-100 group-hover:duration-200"
                                ></div>
                                <a
                                    role="button"
                                    class="group w-full relative inline-flex items-center justify-center text-base rounded-2xl bg-gray-900 px-8 py-3 font-semibold text-white transition-all duration-200 hover:bg-gray-800 hover:shadow-lg hover:-translate-y-0.5 hover:shadow-gray-600/30"
                                    title="payment"
                                    href="#"
                                    >Get Started For Free<svg
                                    aria-hidden="true"
                                    viewBox="0 0 10 10"
                                    height="10"
                                    width="10"
                                    fill="none"
                                    class="mt-0.5 ml-2 -mr-1 stroke-white stroke-2"
                                    >
                                    <path
                                        d="M0 5h7"
                                        class="transition opacity-0 group-hover:opacity-100"
                                    ></path>
                                    <path
                                        d="M1 1l4 4-4 4"
                                        class="transition group-hover:translate-x-[3px]"
                                    ></path>
                                    </svg>
                                </a>
                            </div>
                        </router-link>

                        <span class="body-1 text-center text-[#666666]">By creating an account, you agree to the Terms of use and Privacy Policy. </span>
                    </div>
                    <!-- already have account -->
                    <div class="flex gap-3 justify-center items-center">
                        <div class="body-1 text-[#666666]">
                            Already has an account??
                        </div>
                        <router-link to="/login">
                            <button
                            class="relative bg-[#222222] text-white font-medium text-[17px] px-4 py-[0.35em] pl-5 h-[1.8em] rounded-[0.9em] flex items-center overflow-hidden cursor-pointer shadow-[inset_0_0_1.6em_-0.6em_#714da6] group"
                            >
                                <span class="mr-10">Log In</span>
                                <div
                                    class="absolute right-[0.3em] bg-white h-[1.2em] w-[2.2em] rounded-[0.7em] flex items-center justify-center transition-all duration-300 group-hover:w-[calc(100%-0.6em)] shadow-[0.1em_0.1em_0.6em_0.2em_#7b52b9] active:scale-95"
                                >
                                    <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    height="24"
                                    class="w-[1.1em] transition-transform duration-300 text-[#222222] group-hover:translate-x-[0.1em]"
                                    >
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        fill="currentColor"
                                        d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    ></path>
                                    </svg>
                                </div>
                            </button>

                        </router-link>

                    </div>


                </div>
            </div>

        </div>
    </div>
</template>
<style scoped>
</style>
<script lang="ts">
export default{
    name: "SigninPage"
}
</script>
