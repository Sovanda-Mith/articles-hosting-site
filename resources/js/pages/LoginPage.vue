<template>
  <div class="w-full min-h-screen flex flex-col-reverse lg:flex-row">
    <!-- Left panel -->
    <div
      class="w-full lg:w-1/2 bg-[#222222] text-white p-6 md:p-12 flex flex-col justify-center items-center"
    >
      <!-- Logo and content -->
      <div class="flex flex-col gap-4 md:gap-6">
        <!-- Logo -->
        <router-link to="/" class="w-fit">
          <div class="logo_container flex justify-start items-center sm:gap-3 md">
            <div class="logo w-[38px] h-[38px] rounded-[8px]">
              <img :src="logoImage" alt="" />
            </div>
            <h5 class="logo_name text-white">Bloggist</h5>
          </div>
        </router-link>

        <!-- Heading and text -->
        <h3 class="md:text-3xl">Start writing with us</h3>
        <p class="text-gray-300 max-w-md text-sm md:text-base">
          Join our platform and bring your ideas to life! Sign in to access your personalized
          writing space, collaborate with others, and share your creativity. Whether you're crafting
          stories, articles, or insights, we provide the tools to help you write and publish
          effortlessly.
        </p>
      </div>

      <!-- Image placeholder - You'll replace this with your own image -->
      <div class="w-[380px] h-[380x] flex justify-center lg:justify-start">
        <img :src="loginImage" alt="" />
      </div>
    </div>

    <!-- Right panel -->
    <div class="w-full lg:w-1/2 bg-white p-6 md:p-12 flex flex-col justify-center">
      <div class="mx-auto w-full">
        <!-- Sign in heading -->
        <h4 class="mb-6 md:mb-8">Sign in</h4>
      </div>

      <!-- Social sign in buttons -->
      <div class="space-y-3 md:space-y-4 mb-4 md:mb-6">
        <button
          @click="signInwithGoogle"
          class="flex items-center gap-2 justify-center w-full py-2 md:py-3 px-4 border border-gray-300 rounded-4xl hover:bg-gray-50 transition-colors"
        >
          <svg
            width="25"
            height="25"
            viewBox="0 0 25 25"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M23.001 12.7332C23.001 11.8699 22.9296 11.2399 22.7748 10.5865H12.7153V14.4832H18.62C18.501 15.4515 17.8582 16.9099 16.4296 17.8898L16.4096 18.0203L19.5902 20.435L19.8106 20.4565C21.8343 18.6249 23.001 15.9298 23.001 12.7332Z"
              fill="#4285F4"
            />
            <path
              d="M12.714 23C15.6068 23 18.0353 22.0666 19.8092 20.4567L16.4282 17.8899C15.5235 18.5083 14.3092 18.9399 12.714 18.9399C9.88069 18.9399 7.47596 17.1083 6.61874 14.5766L6.49309 14.5871L3.18583 17.0954L3.14258 17.2132C4.90446 20.6433 8.5235 23 12.714 23Z"
              fill="#34A853"
            />
            <path
              d="M6.62046 14.5767C6.39428 13.9234 6.26337 13.2233 6.26337 12.5C6.26337 11.7767 6.39428 11.0767 6.60856 10.4234L6.60257 10.2842L3.25386 7.7356L3.14429 7.78667C2.41814 9.21002 2.00146 10.8084 2.00146 12.5C2.00146 14.1917 2.41814 15.79 3.14429 17.2133L6.62046 14.5767Z"
              fill="#FBBC05"
            />
            <path
              d="M12.7141 6.05997C14.7259 6.05997 16.083 6.91163 16.8569 7.62335L19.8807 4.73C18.0236 3.03834 15.6069 2 12.7141 2C8.52353 2 4.90447 4.35665 3.14258 7.78662L6.60686 10.4233C7.47598 7.89166 9.88073 6.05997 12.7141 6.05997Z"
              fill="#EB4335"
            />
          </svg>
          <span class="">CONTINUE WITH GOOGLE</span>
        </button>

        <!-- OR divider -->
        <div class="flex items-center my-4 md:my-6">
          <div class="flex-grow h-px bg-gray-300"></div>
          <span class="px-4 text-sm text-gray-500 font-medium">OR</span>
          <div class="flex-grow h-px bg-gray-300"></div>
        </div>
      </div>

      <!-- Login form -->
      <div class="flex flex-col gap-5">
        <div class="grid w-full items-center gap-1.5">
          <Label for="email" class="body-1 text-[#666666]">Email address</Label>
          <Input id="email" class="body-1" v-model="email" type="email" placeholder="" />
        </div>
        <div class="grid w-full items-center gap-1.5">
          <Label for="password" class="body-1 text-[#666666]">Password</Label>
          <Input id="password" class="body-1" v-model="password" type="password" placeholder="" />
        </div>
        <!-- forgot password slide left using shardcn sheet -->
        <Sheet>
          <div class="flex justify-end gap-4">
            <SheetTrigger as-child>
              <Button
                variant="outline"
                class="w-fit body-2 text-center hover:underline hover:text-blue-600"
              >
                Forget your password??
              </Button>
            </SheetTrigger>
          </div>

          <SheetContent :side="'left'" class="p-4">
            <SheetHeader>
              <SheetTitle><h4>Forget Password</h4></SheetTitle>
              <SheetDescription class="body-1">
                Enter your information and we will help with resetting your password.
              </SheetDescription>
            </SheetHeader>

            <div class="grid gap-4 py-4">
              <div class="grid items-center grid-cols-4 gap-4">
                <Label for="name" class="text-right">Username</Label>
                <Input id="name" v-model="usernameForget" class="col-span-3" />
              </div>
              <div class="grid items-center grid-cols-4 gap-4">
                <Label for="email" class="text-right">Email</Label>
                <Input id="email" v-model="emailForget" class="col-span-3" />
              </div>
            </div>

            <SheetFooter>
              <SheetClose as-child>
                <Button type="submit"> Send confirmation email </Button>
              </SheetClose>
            </SheetFooter>
          </SheetContent>
        </Sheet>

        <!-- Error and Success Messages -->
        <div v-if="errorMessage" class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span class="text-red-700 text-sm font-medium">{{ errorMessage }}</span>
          </div>
        </div>

        <div v-if="successMessage" class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span class="text-green-700 text-sm font-medium">{{ successMessage }}</span>
          </div>
        </div>

        <!-- log-in button -->
        <div class="loginbtn_container">
          <button type="button" @click="login" class="login_button type--C">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text">LOGIN</span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
          </button>
        </div>
      </div>

      <!-- Sign up link -->
      <router-link to="/signin" class="w-fit">
        <div class="mt-2 md:mt-4 body-1">
          <span class="text-xs md:text-sm text-gray-600">Don't have an account?</span>
          <a href="#" class="md:text-sm text-blue-600 hover:underline ml-1">Sign up</a>
        </div>
      </router-link>
    </div>
  </div>
</template>

<style scoped>
  @keyframes slideInFromLeft {
    0% {
      transform: translateX(-100%);
      opacity: 0;
    }
    100% {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes slideOutToLeft {
    0% {
      transform: translateX(0);
      opacity: 1;
    }
    100% {
      transform: translateX(-100%);
      opacity: 0;
    }
  }

  .slide-in-from-left {
    animation: slideInFromLeft 0.5s ease-out forwards;
  }

  .slide-out-to-left {
    animation: slideOutToLeft 0.5s ease-out forwards;
  }
  /* From Uiverse.io by himanshu9682 */
  .type--A {
    --line_color: #555555;
    --back_color: #ffecf6;
  }
  .type--B {
    --line_color: #1b1919;
    --back_color: #e9ecff;
  }
  .type--C {
    --line_color: #00135c;
    --back_color: #ff8833;
  }
  .login_button {
    position: relative;
    z-index: 0;
    width: 240px;
    height: 56px;
    text-decoration: none;

    font-family: 'Quicksand', sans-serif;
    font-size: 14px;
    line-height: 1.2;
    font-weight: 700;
    text-transform: uppercase;

    color: var(--line_color);
    letter-spacing: 2px;
    transition: all 0.3s ease;
  }
  .button__text {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
  }
  .login_button::before,
  .login_button::after,
  .button__text::before,
  .button__text::after {
    content: '';
    position: absolute;
    height: 3px;
    border-radius: 2px;
    background: var(--line_color);
    transition: all 0.5s ease;
  }
  .login_button::before {
    top: 0;
    left: 54px;
    width: calc(100% - 56px * 2 - 16px);
  }
  .login_button::after {
    top: 0;
    right: 54px;
    width: 8px;
  }
  .button__text::before {
    bottom: 0;
    right: 54px;
    width: calc(100% - 56px * 2 - 16px);
  }
  .button__text::after {
    bottom: 0;
    left: 54px;
    width: 8px;
  }
  .button__line {
    position: absolute;
    top: 0;
    width: 56px;
    height: 100%;
    overflow: hidden;
  }
  .button__line::before {
    content: '';
    position: absolute;
    top: 0;
    width: 150%;
    height: 100%;
    box-sizing: border-box;
    border-radius: 300px;
    border: solid 3px var(--line_color);
  }
  .button__line:nth-child(1),
  .button__line:nth-child(1)::before {
    left: 0;
  }
  .button__line:nth-child(2),
  .button__line:nth-child(2)::before {
    right: 0;
  }
  .login_button:hover {
    letter-spacing: 6px;
  }
  .login_button:hover::before,
  .login_button:hover .button__text::before {
    width: 8px;
  }
  .login_button:hover::after,
  .login_button:hover .button__text::after {
    width: calc(100% - 56px * 2 - 16px);
  }
  .button__drow1,
  .button__drow2 {
    position: absolute;
    z-index: -1;
    border-radius: 16px;
    transform-origin: 16px 16px;
  }
  .button__drow1 {
    top: -16px;
    left: 40px;
    width: 32px;
    height: 0;
    transform: rotate(30deg);
  }
  .button__drow2 {
    top: 44px;
    left: 77px;
    width: 32px;
    height: 0;
    transform: rotate(-127deg);
  }
  .button__drow1::before,
  .button__drow1::after,
  .button__drow2::before,
  .button__drow2::after {
    content: '';
    position: absolute;
  }
  .button__drow1::before {
    bottom: 0;
    left: 0;
    width: 0;
    height: 32px;
    border-radius: 16px;
    transform-origin: 16px 16px;
    transform: rotate(-60deg);
  }
  .button__drow1::after {
    top: -10px;
    left: 45px;
    width: 0;
    height: 32px;
    border-radius: 16px;
    transform-origin: 16px 16px;
    transform: rotate(69deg);
  }
  .button__drow2::before {
    bottom: 0;
    left: 0;
    width: 0;
    height: 32px;
    border-radius: 16px;
    transform-origin: 16px 16px;
    transform: rotate(-146deg);
  }
  .button__drow2::after {
    bottom: 26px;
    left: -40px;
    width: 0;
    height: 32px;
    border-radius: 16px;
    transform-origin: 16px 16px;
    transform: rotate(-262deg);
  }
  .button__drow1,
  .button__drow1::before,
  .button__drow1::after,
  .button__drow2,
  .button__drow2::before,
  .button__drow2::after {
    background: var(--back_color);
  }
  .login_button:hover .button__drow1 {
    animation: drow1 ease-in 0.06s;
    animation-fill-mode: forwards;
  }
  .login_button:hover .button__drow1::before {
    animation: drow2 linear 0.08s 0.06s;
    animation-fill-mode: forwards;
  }
  .login_button:hover .button__drow1::after {
    animation: drow3 linear 0.03s 0.14s;
    animation-fill-mode: forwards;
  }
  .login_button:hover .button__drow2 {
    animation: drow4 linear 0.06s 0.2s;
    animation-fill-mode: forwards;
  }
  .login_button:hover .button__drow2::before {
    animation: drow3 linear 0.03s 0.26s;
    animation-fill-mode: forwards;
  }
  .login_button:hover .button__drow2::after {
    animation: drow5 linear 0.06s 0.32s;
    animation-fill-mode: forwards;
  }
  @keyframes drow1 {
    0% {
      height: 0;
    }
    100% {
      height: 100px;
    }
  }
  @keyframes drow2 {
    0% {
      width: 0;
      opacity: 0;
    }
    10% {
      opacity: 0;
    }
    11% {
      opacity: 1;
    }
    100% {
      width: 120px;
    }
  }
  @keyframes drow3 {
    0% {
      width: 0;
    }
    100% {
      width: 80px;
    }
  }
  @keyframes drow4 {
    0% {
      height: 0;
    }
    100% {
      height: 120px;
    }
  }
  @keyframes drow5 {
    0% {
      width: 0;
    }
    100% {
      width: 124px;
    }
  }

  .loginbtn_container {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: start;
  }
  .login_button:not(:last-child) {
    margin-bottom: 64px;
  }

  /* Add this to your <style> section in LoginPage.vue */

  /* Animation for Sheet sliding from left */
</style>
<script setup lang="ts">
  import { Input } from '@/components/ui/input';
  import { Label } from '@/components/ui/label';
  import { Button } from '@/components/ui/button';
  import {
    Sheet,
    SheetClose,
    SheetContent,
    SheetDescription,
    SheetFooter,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
  } from '@/components/ui/sheet';
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  import { useUserStore } from '@/stores/features/user';

  // Import images properly for Vite
  import logoImage from '../assets/landingPage_img/logo.webp';
  import loginImage from '../assets/landingPage_img/login.png';

  const userStore = useUserStore();

  const router = useRouter();

  const email = ref('');
  const password = ref('');
  const usernameForget = ref('');
  const emailForget = ref('');

  const signInwithGoogle = () => {
    // Use relative path instead of hardcoded URL for better flexibility across environments
    window.location.href = '/auth/google/redirect';
  };

  const errorMessage = ref('');
  // const errorMessage = "Please enter a valid username or email address.";
  const successMessage = ref('');
  // const successMessage = "A confirmation email has been sent to your email address.";

  // const isOpen = ref(false);
  // const toggleSheet = () => {
  //   isOpen.value = !isOpen.value;
  // };

  const login = async () => {
    //clear message
    errorMessage.value = '';
    successMessage.value = '';
    //fetch all users from backend
    try {
      //get username and password from input fields
      const user = {
        // username: username.value,
        email: email.value,
        password: password.value,
      };

      //make a post request to the backend to login
      const response = await axios.post('/api/users/login', user);

      const data = response.data;

      userStore.setUserData({
        id: data.user.id,
        name: data.user.name,
        email: data.user.email,
        avatar: data.user.avatar,
        username: data.user.username,
        bio: data.user.bio,
        gender: data.user.gender,
        role: data.user.role,
        token: data.token,
      });

      if (response.status === 200) {
        successMessage.value = 'Login successful!';
        localStorage.setItem('auth_token', data.token); // Store JWT token in localStorage for checking authentication later
        localStorage.setItem('userId', JSON.stringify(data.user.id)); // Store user data
        // console.log("User data:", data.user);
        setTimeout(() => {
          router.push('/feed');
        }, 1500); // 1.5 second delay before redirecting
      } else {
        errorMessage.value = data.message || 'Failed to login. Please check your credentials.';
      }
    } catch (error) {
      console.error('Error:', error);
      errorMessage.value = 'An error occurred while logging in. Please try again.';
    }
  };
</script>
