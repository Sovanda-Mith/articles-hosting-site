<template>
  <div class="w-full h-screen bg-[#EDECEC] flex justify-center items-center">
    <div
      class="flex flex-col justify-center items-center gap-4 bg-white border-1 border-gray-200 shadow-2xl rounded-3xl p-5"
    >
      <!-- logo -->
      <router-link to="/" class="w-fit h-fit">
        <div class="logo_container flex justify-start items-center sm:gap-3">
          <div class="logo w-[58px] h-[58px] rounded-[8px]">
            <img src="/landingPage_img/logo.webp" alt="" />
          </div>
        </div>
      </router-link>

      <!-- content -->
      <div class="w-[680px] h-fit flex flex-col justify-center items-center gap-10 p-10">
        <!-- title -->
        <div class="flex flex-col max-w-[460px] justify-center items-center gap-1">
          <h5>Create an account</h5>
          <p class="text-center text-[#666666]">
            Welcome back! Sign in to access your writing space, continue your projects, and share
            your creativity with the world.
          </p>
        </div>

        <!-- input -->
        <div>
          <Form
            @submit="onSubmit"
            :validation-schema="yup.Schema"
            class="w-full flex flex-col gap-8 mb-5"
          >
            <div class="relative bg-white rounded-lg w-full">
              <input
                placeholder="Email address"
                v-model="email"
                v-bind="emailAttrs"
                class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                id="emailInput"
                type="email"
              />
              <label
                class="subtitle absolute left-2 -top-6 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                for="emailInput"
              >
                Email
              </label>
              <div class="text-red-500">{{ errors.email }}</div>
            </div>

            <div class="relative bg-white rounded-lg w-full">
              <input
                placeholder="Name"
                v-model="name"
                v-bind="nameAttrs"
                class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                id="nameInput"
                type="text"
              />
              <label
                class="subtitle absolute left-2 -top-6 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                for="nameInput"
              >
                Name
              </label>
              <div class="text-red-500">{{ errors.name }}</div>
            </div>

            <!-- password -->
            <div class="flex flex-col justify-center items-center">
              <div class="relative bg-white rounded-lg w-full">
                <input
                  placeholder="Password"
                  v-model="password"
                  v-bind="passwordAttrs"
                  class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                  id="passwordInput"
                  type="password"
                />
                <label
                  class="subtitle absolute left-2 -top-6 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                  for="passwordInput"
                >
                  Password
                </label>
                <div class="text-red-500">{{ errors.password }}</div>
              </div>

              <div class="flex w-full justify-between items-center mt-2">
                <ul class="Overline text-[#666666] opacity-90 list-disc pl-6 space-y-2">
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

              <DialogRoot>
                <DialogTrigger

                >
                  <div class="relative inline-flex items-center justify-center w-full gap-4 group">
                    <div
                      class="absolute inset-0 duration-1000 opacity-60 transitiona-all bg-gradient-to-r from-indigo-500 via-pink-500 to-yellow-400 rounded-xl blur-lg filter group-hover:opacity-100 group-hover:duration-200"
                    ></div>
                    <!-- had to put type button to prevent submit form -->
                    <button
                      type="button"
                      :disabled="isLoading"
                      class="group w-full relative inline-flex items-center justify-center rounded-2xl bg-gray-900 px-8 py-3 font-semibold text-white transition-all duration-200 hover:bg-gray-800 hover:shadow-lg hover:-translate-y-0.5 hover:shadow-gray-600/30 disabled:opacity-50 disabled:cursor-not-allowed"
                      title="payment"
                    >
                      <span v-if="!isLoading">Get Started For Free</span>
                      <span v-else class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Creating Account...
                      </span>
                      <svg
                        v-if="!isLoading"
                        aria-hidden="true"
                        viewBox="0 0 10 10"
                        height="10"
                        width="10"
                        fill="none"
                        class="mt-0.5 ml-2 -mr-1 stroke-white stroke-2"
                      >
                        <path d="M0 5h7" class="transition opacity-0 group-hover:opacity-100"></path>
                        <path d="M1 1l4 4-4 4" class="transition group-hover:translate-x-[3px]"></path>
                      </svg>
                    </button>
                  </div>
                </DialogTrigger>
                <DialogPortal>
                  <DialogOverlay class="bg-black/60 data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
                  <DialogContent
                    class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
                  >
                    <DialogTitle class="text-mauve12 m-0 text-[17px] font-semibold">
                      Confirm your information
                    </DialogTitle>
                    <DialogDescription class="text-mauve11 mt-[10px] mb-5 text-sm leading-normal">
                      Make sure all the information is correct before saving your profile.
                    </DialogDescription>
                    <!-- entered form data -->
                    <div class="flex flex-col gap-5">
                      <div class="flex justify-between">
                        <span class="text-gray-700 font-semibold">Email:</span>
                        <span class="text-gray-600">{{ email }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-700 font-semibold">Name:</span>
                        <span class="text-gray-600">{{ name }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-700 font-semibold">Password:</span>
                        <span class="text-gray-600">{{ password.replace(/./g, '*') }}</span>
                      </div>
                      <!-- <span>{{ name }}</span> -->
                    </div>
                    <div class="mt-[25px] flex justify-end">
                      <DialogClose as-child>
                        <button
                          @click="onSubmit"
                          type="submit"
                          :disabled="isLoading"
                          class="bg-green4 text-green11 text-sm hover:bg-green5 focus:shadow-green7 inline-flex h-[35px] items-center justify-center rounded-lg px-[15px] font-semibold leading-none focus:shadow-[0_0_0_2px] focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                          <span v-if="!isLoading">Yes, create my profile</span>
                          <span v-else class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                          </span>
                        </button>
                      </DialogClose>
                    </div>
                    <DialogClose
                      class="text-grass11 hover:bg-green4 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none"
                      aria-label="Close"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
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

              <span class="body-1 text-center text-[#666666]"
                >By creating an account, you agree to the Terms of use and Privacy Policy.
              </span>
            </div>
          </Form>

          <!-- Error and Success Messages -->
          <div v-if="errorMessage" class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
            <div class="flex items-center">
              <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
              </svg>
              <span class="text-red-700 text-sm font-medium">{{ errorMessage }}</span>
            </div>
          </div>

          <div v-if="successMessage" class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
            <div class="flex items-center">
              <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              <span class="text-green-700 text-sm font-medium">{{ successMessage }}</span>
            </div>
          </div>

          <!-- OR seperator -->
          <div class="flex items-center my-1 md:my-2">
            <div class="flex-grow h-px bg-gray-300"></div>
            <span class="px-4 text-sm text-gray-500 font-medium">OR</span>
            <div class="flex-grow h-px bg-gray-300"></div>
          </div>
          <!-- google button -->
          <button
            @click="signInwithGoogle"
            class="flex items-center gap-2 justify-center w-full py-2 md:py-3 my-1 md:my-3 px-4 border border-gray-300 rounded-4xl hover:bg-gray-50 transition-colors"
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

          <!-- already have account -->
          <div class="flex gap-3 justify-center items-center">
            <div class="body-1 text-[#666666]">Already has an account??</div>
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
<style scoped></style>
<script lang="ts" setup>
  // import { reactive } from 'vue';

  import { useForm, Form } from 'vee-validate';
  import * as yup from 'yup';
  import { ref, watch } from 'vue';
  // import { Icon } from '@iconify/vue';
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
  import router from '@/routes';
  // import {Router} from '@/vue-router';

  // Reactive variables for error and success messages
  const errorMessage = ref('');
  const successMessage = ref('');
  const isLoading = ref(false);

  // const form = reactive({
  //   email: '',
  //   username: '',
  //   password: '',
  // });


  const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
      email: yup.string().email('Invalid email format').required('Email is required'),
      name: yup
        .string()
        .min(3, 'Name must be at least 3 characters')
        .required('Name is required'),
      password: yup
        .string()
        .min(8, 'Password must be at least 8 characters')
        .max(20, 'Password must be less than 20 characters')
        .required('Password is required')
        .matches(/[A-Z]/, 'Password must contain at least one uppercase letter')
        .matches(/[a-z]/, 'Password must contain at least one lowercase letter')
        .matches(/[0-9]/, 'Password must contain at least one digits')
        .matches(/[^A-Za-z0-9]/, 'Password must contain at least one special character')
    }),
  });


  const onSubmit = handleSubmit(async (values) => {
    // Clear previous messages
    errorMessage.value = '';
    successMessage.value = '';
    isLoading.value = true;

    try {
      const response = await fetch('/api/users', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'include',
        body: JSON.stringify({
          email: values.email,
          name: values.name,
          password: values.password,
        }),
      });

      const data = await response.json();

      if (!response.ok) {
        // Handle different types of errors
        if (response.status === 422) {
          // Validation errors
          if (data.errors) {
            const validationErrors = Object.values(data.errors).flat();
            errorMessage.value = validationErrors.join(', ');
          } else {
            errorMessage.value = data.message || 'Validation failed. Please check your input.';
          }
        } else if (response.status === 409) {
          // Conflict (e.g., email already exists)
          errorMessage.value = data.message || 'Email already exists. Please use a different email.';
        } else {
          // Other server errors
          errorMessage.value = data.message || 'An error occurred while creating your account. Please try again.';
        }
      } else {
        // Success
        // console.log('Success:', data);
        successMessage.value = 'Account created successfully! Welcome to Bloggist!';
        //log in the user
        try{
          const response = await fetch('/api/users/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'include',
            body: JSON.stringify({
              email: values.email,
              password: values.password,
            }),
          });

          const dataUser = await response.json();

          if(response.ok) {
            localStorage.setItem('auth_token', dataUser.token); // Store the JWT token
            //redirect logic here
            setTimeout(() => {
              router.push('/feed').then(() => {
                window.location.reload();
              });
            }, 1000);
          }
        } catch (error) {
          console.error('Login Error:', error);
          errorMessage.value = 'Login failed. Please try again.';
        }

      }
    } catch (error) {
      console.error('Error:', error);
      errorMessage.value = 'Network error. Please check your internet connection and try again.';
    } finally {
      isLoading.value = false;
    }
  });

  const [email, emailAttrs] = defineField('email');
  const [name, nameAttrs] = defineField('name');
  const [password, passwordAttrs] = defineField('password');

  // Clear messages when user starts typing
  const clearMessages = () => {
    if (errorMessage.value || successMessage.value) {
      errorMessage.value = '';
      successMessage.value = '';
    }
  };

  // Watch for form changes to clear messages
  watch([email, name, password], clearMessages);

  const signInwithGoogle = () => {
    // Use relative path instead of hardcoded URL for better flexibility across environments
    window.location.href = '/auth/google/redirect';
  };
</script>
