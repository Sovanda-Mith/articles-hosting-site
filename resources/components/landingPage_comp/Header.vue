<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
  import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
    DialogTrigger,
  } from 'reka-ui';
  import { ref, onMounted } from 'vue';
  import '../../css/app.css';
  import { useUserStore } from '@/stores/features/user';

  const userStore = useUserStore();

  const isMenuOpen = ref(false);
  const isAuthenticated = ref(false);
  const user = ref({ name: '', pfp: '' });
  const isLoading = ref(true);
  //checking if user is authenticated
  onMounted(async () => {
    await checkAuthentication();
  });

  const checkAuthentication = async () => {
    try {
      const jwtToken = localStorage.getItem('auth_token');

      if (!jwtToken) {
        isAuthenticated.value = false;
        isLoading.value = false;
        return;
      }

      //verify the JWT token
      const response = await fetch('/api/auth/verify', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${jwtToken}`,
        },
      });

      if (response.ok) {
        const data = await response.json();
        isAuthenticated.value = true;
        user.value = data.user; // Assuming the API returns user data
      } else {
        localStorage.removeItem('auth_token');
        isAuthenticated.value = false;
      }
    } catch (error) {
      console.error('Error checking authentication:', error);
      isAuthenticated.value = false;
      localStorage.removeItem('auth_token'); // Clear token on error
    } finally {
      isLoading.value = false; // Set loading to false after checking authentication
    }
  };

  const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
  };

  const logout = async () => {
    try {
      const response = await fetch('/api/auth/logout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });

      if (response.ok) {
        userStore.clearUserData();
        localStorage.removeItem('auth_token');
        // alert('Logged out successfully');
        isAuthenticated.value = false;
        user.value = { name: '', pfp: '' }; // Reset user data
      } else {
        console.error('Logout failed');
      }
    } catch (error) {
      console.error('Error during logout:', error);
    }
  };
</script>
<template>
  <div
    class="header w-screen h-auto flex justify-between items-center pl-[93px] pr-[93px] pt-[20px] pb-[20px] fixed top-0 left-0 bg-white shadow-xs z-50"
  >
    <router-link to="/">
      <div class="logo_container flex justify-center items-center sm:gap-3 md">
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
            <router-link to="/" class="navList body-big" active-class="active">Home</router-link>
          </li>
          <li>
            <router-link to="/aboutus" class="navList body-big" active-class="active"
              >About us</router-link
            >
          </li>
          <li>
            <router-link to="/contact" class="navList body-big" active-class="active"
              >Contact</router-link
            >
          </li>
        </ul>
      </nav>
      <div
        v-if="!isAuthenticated && !isLoading"
        class="w-[236px] h-[40px] gap-[40px] flex auth-buttons"
      >
        <router-link to="/login">
          <button class="login-btn button w-[98px] h-[40px] bg-[#ffffff] rounded-[8px]">
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
      <!-- profile picture of user -->
      <div v-if="isAuthenticated" class="flex items-center gap-2 auth-buttons">
        <Router-link
          to="/profile"
          class="flex items-center border-1 border-gray-300 rounded-lg py-1 px-2"
        >
          <img
            v-if="user.pfp"
            :src="user.pfp"
            alt="Profile Picture"
            class="w-[40px] h-[40px] rounded-full"
          />
          <span class="text-gray-800 font-bold">{{ user.name }}</span>
        </Router-link>
        <!-- <button class="BtnLogout" @click="logout">
          <div class="sign">
            <svg viewBox="0 0 512 512">
              <path
                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
              ></path>
            </svg>
          </div>

          <div class="text">Logout</div>
        </button> -->
        <DialogRoot>
          <DialogTrigger>
            <button class="BtnLogout">
              <div class="sign">
                <svg viewBox="0 0 512 512">
                  <path
                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                  ></path>
                </svg>
              </div>
              <div class="text">Logout</div>
            </button>
          </DialogTrigger>
          <DialogPortal>
            <DialogOverlay class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50" />
            <DialogContent
              class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 z-50 border border-gray-200"
            >
              <!-- Header with Icon -->
              <div class="flex flex-col items-center text-center mb-6">
                <div
                  class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4"
                >
                  <svg
                    class="w-8 h-8 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                  </svg>
                </div>
                <DialogTitle class="text-2xl font-bold text-gray-900 mb-2">
                  Confirm Logout
                </DialogTitle>
                <DialogDescription class="text-gray-600 text-base leading-relaxed">
                  Are you sure you want to log out of your account?
                </DialogDescription>
              </div>

              <!-- Action Buttons -->
              <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <DialogClose
                  class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                >
                  Cancel
                </DialogClose>
                <DialogClose
                  @click="logout"
                  class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                >
                  Logout
                </DialogClose>
              </div>

              <!-- Close Button -->
              <DialogClose
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300"
                aria-label="Close"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M18 6L6 18" />
                  <path d="M6 6l12 12" />
                </svg>
              </DialogClose>
            </DialogContent>
          </DialogPortal>
        </DialogRoot>
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
            <router-link to="/" class="mobile-navList body-big" active-class="active"
              >Home</router-link
            >
          </li>
          <li>
            <router-link to="/aboutus" class="mobile-navList body-big" active-class="active"
              >About us</router-link
            >
          </li>
          <li>
            <router-link to="/contact" class="mobile-navList body-big" active-class="active"
              >Contact</router-link
            >
          </li>
          <!-- Show Login/Sign Up buttons only when not authenticated -->
          <template v-if="!isAuthenticated && !isLoading">
            <li class="mt-2">
              <router-link to="login">
                <button class="login-btn button w-full h-[40px] bg-[#ffffff] rounded-[8px] mb-2">
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
          </template>
          <!-- Show user profile and logout when authenticated -->
          <template v-if="isAuthenticated">
            <li class="mt-2">
              <router-link
                to="/profile"
                class="flex items-center border-1 border-gray-300 rounded-lg py-2 px-3 mb-2"
              >
                <img
                  v-if="user.pfp"
                  :src="user.pfp"
                  alt="Profile Picture"
                  class="w-[30px] h-[30px] rounded-full mr-2"
                />
                <span class="text-gray-800 font-bold text-sm">{{ user.name }}</span>
              </router-link>
            </li>
            <li>
              <DialogRoot>
                <DialogTrigger>
                  <button class="BtnLogout w-full">
                    <div class="sign">
                      <svg viewBox="0 0 512 512">
                        <path
                          d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                        ></path>
                      </svg>
                    </div>
                    <div class="text">Logout</div>
                  </button>
                </DialogTrigger>
                <DialogPortal>
                  <DialogOverlay class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50" />
                  <DialogContent
                    class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 z-50 border border-gray-200"
                  >
                    <!-- Header with Icon -->
                    <div class="flex flex-col items-center text-center mb-6">
                      <div
                        class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4"
                      >
                        <svg
                          class="w-8 h-8 text-red-600"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                          />
                        </svg>
                      </div>
                      <DialogTitle class="text-2xl font-bold text-gray-900 mb-2">
                        Confirm Logout
                      </DialogTitle>
                      <DialogDescription class="text-gray-600 text-base leading-relaxed">
                        Are you sure you want to log out of your account?
                      </DialogDescription>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                      <DialogClose
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                      >
                        Cancel
                      </DialogClose>
                      <DialogClose
                        @click="logout"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                      >
                        Logout
                      </DialogClose>
                    </div>

                    <!-- Close Button -->
                    <DialogClose
                      class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300"
                      aria-label="Close"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                      </svg>
                    </DialogClose>
                  </DialogContent>
                </DialogPortal>
              </DialogRoot>
            </li>
          </template>
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
  .headerMenu {
    display: none;
  }

  .mobile-nav-menu {
    display: none;
  }

  /* From Uiverse.io by vinodjangid07 */
  .BtnLogout {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 45px;
    height: 45px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition-duration: 0.3s;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
    background-color: rgb(255, 65, 65);
  }

  /* plus sign */
  .sign {
    width: 100%;
    transition-duration: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .sign svg {
    width: 17px;
  }

  .sign svg path {
    fill: white;
  }
  /* text */
  .text {
    position: absolute;
    right: 0%;
    width: 0%;
    opacity: 0;
    color: white;
    font-size: 1.2em;
    font-weight: 600;
    transition-duration: 0.3s;
  }
  /* hover effect on button width */
  .BtnLogout:hover {
    width: 125px;
    border-radius: 40px;
    transition-duration: 0.3s;
  }

  .BtnLogout:hover .sign {
    width: 30%;
    transition-duration: 0.3s;
    padding-left: 20px;
  }
  /* hover effect button's text */
  .BtnLogout:hover .text {
    opacity: 1;
    width: 70%;
    transition-duration: 0.3s;
    padding-right: 10px;
  }
  /* button click effect*/
  .BtnLogout:active {
    transform: translate(2px, 2px);
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
      content: '';
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
    .BtnLogout:hover {
      width: 110px;
      border-radius: 40px;
      transition-duration: 0.3s;
    }
  }
</style>
