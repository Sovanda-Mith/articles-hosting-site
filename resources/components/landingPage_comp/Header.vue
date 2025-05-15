<script setup lang="ts">
import { ref } from "vue";
import "../../css/app.css";
import { createRouter, createWebHistory } from "vue-router";
import Home from "../../js/pages/LandingPage.vue";
import AboutUs from "../../js/pages/AboutusPage.vue";

const isMenuOpen = ref(false);
const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const routes = [
    { path: "/", component: Home },
    { path: "/aboutus", component: AboutUs },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
</script>
<template>
    <!-- Using Tailwind CSS for styling -->
    <div
        class="header w-screen h-auto flex justify-between items-center pl-[93px] pr-[93px] pt-[20px] pb-[20px] fixed top-0 left-0 bg-white shadow-xs z-50"
    >
        <router-link to="/">
            <div
                class="logo_container flex justify-center items-center sm:gap-3 md"
            >
                <div class="logo w-[38px] h-[38px] rounded-[8px]">
                    <img src="/landingPage_img/logo.webp" alt="" />
                </div>
                <h5 class="logo_name">Bloggist</h5>
            </div>
        </router-link>

        <div class="flex justify-center items-center gap-[40px] relative">
            <nav class="desktop-nav">
                <ul class="flex justify-center items-center gap-[40px]">
                    <li>
                        <router-link
                            to="/"
                            class="navList body-big"
                            active-class="active"
                            >Home</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            to="/aboutus"
                            class="navList body-big"
                            active-class="active"
                            >About us</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            to="/contact"
                            class="navList body-big"
                            active-class="active"
                            >Contact</router-link
                        >
                    </li>
                </ul>
            </nav>
            <div class="w-[236px] h-[40px] gap-[40px] flex auth-buttons">
                <router-link to="/login">
                    <button
                        class="login-btn button w-[98px] h-[40px] bg-[#ffffff] rounded-[8px]"
                    >
                        Log In
                    </button>
                </router-link>

                <router-link to="/signin">
                    <button
                        class="signup-btn button w-[98px] h-[40px] text-[#ffffff] bg-[#222222] rounded-[8px]"
                    >
                        Sign Up
                    </button>
                </router-link>
            </div>
            <button @click="toggleMenu" class="headerMenu">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-gray-800"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        v-if="!isMenuOpen"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                        v-else
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

            <!-- Mobile Navigation Menu that appears when toggleMenu is activated -->
            <div v-if="isMenuOpen" class="mobile-nav-menu">
                <ul class="flex flex-col gap-2 py-2">
                    <li>
                        <router-link
                            to="/"
                            class="mobile-navList body-big"
                            active-class="active"
                            >Home</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            to="/aboutus"
                            class="mobile-navList body-big"
                            active-class="active"
                            >About us</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            to="/contact"
                            class="mobile-navList body-big"
                            active-class="active"
                            >Contact</router-link
                        >
                    </li>
                    <li class="mt-2">
                        <router-link to="login">
                            <button
                                class="login-btn button w-full h-[40px] bg-[#ffffff] rounded-[8px] mb-2"
                            >
                                Log In
                            </button>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="signin">
                            <button
                                class="signup-btn button w-full h-[40px] text-[#ffffff] bg-[#222222] rounded-[8px]"
                            >
                                Sign Up
                            </button>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<style scoped>
.navList {
    color: #666666;
    position: relative;
    text-decoration: none;
}
.navList:hover {
    color: #111111;
}
.navList:after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -4px;
    left: 0;
    background-color: #111111;
    transition: width 0.3s ease;
}
.navList:hover:after {
    width: 100%;
}

/* Modern button styles */
button {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
    font-weight: 600;
    border: none;
}

.login-btn {
    border: 1px solid #e0e0e0;
}

.login-btn:hover {
    background-color: #f5f5f5;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.signup-btn:hover {
    background-color: #000000;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

button:active {
    transform: translateY(1px);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}
.headerMenu {
    display: none;
}

.mobile-nav-menu {
    display: none;
}

@media (max-width: 768px) {
    .headerMenu {
        display: block;
        z-index: 20;
    }
    .desktop-nav,
    .auth-buttons {
        display: none;
    }
    .mobile-nav-menu {
        display: block;
        position: absolute;
        top: 100%;
        right: 0;
        width: 120px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 0.3rem;
        margin-top: 0.3rem;
        z-index: 10;
    }
    .mobile-navList {
        display: block;
        padding: 0.2rem 0.5rem;
        color: #666666;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
        font-size: 14px;
        /* background: #000; */
    }

    .mobile-navList:hover {
        color: #111111;
        background-color: #f5f5f5;
        border-radius: 4px;
    }
    .mobile-navList:after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -4px;
        left: 0;
        background-color: #111111;
        transition: width 0.3s ease;
    }
    .mobile-navList:hover:after {
        width: 100%;
    }
    .logo_name {
        font-size: smaller;
    }
    .logo {
        width: 20px;
        height: 20px;
    }
    .header {
        padding-top: 10px;
        padding-bottom: 10px;
    }
}
</style>
<script lang="ts">
export default {
    name: "Header",
};
</script>
