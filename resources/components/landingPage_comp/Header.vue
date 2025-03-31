<script setup lang="ts">
import '../../css/app.css';
</script>
<template>
    <!-- Using Tailwind CSS for styling -->
    <div class="header w-screen h-auto bg-cyan-500 flex justify-between items-center pl-[93px] pr-[93px] pt-[20px] pb-[20px]">
        <div class="flex justify-center items-center gap-3">
            <div class="w-[38px] h-[38px] bg-white rounded-[8px]">
                <img src="resources/image/landingPage_img/logo.webp" alt="">
            </div>
            <h5>Bloggist</h5>
        </div>
        <div class="flex justify-center items-center gap-[40px]">
            <nav>
                <ul class="flex justify-center items-center gap-[40px]">
                    <li><a href="#" class="navList body-big">Home</a></li>
                    <li><a href="#" class="navList body-big">About us</a></li>
                    <li><a href="#" class="navList body-big">Contact</a></li>
                </ul>
            </nav>
            <div class="w-[236px] h-[40px] gap-[40px] flex">
                <button class="login-btn button w-[98px] h-[40px] bg-[#ffffff] rounded-[8px]">
                    Log In
                </button>
                <button class="signup-btn button w-[98px] h-[40px] text-[#ffffff] bg-[#222222] rounded-[8px]">
                    Sign Up
                </button>
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
        content: '';
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
</style>
<script lang="ts">
export default {
    name: "Header",


}
</script>
