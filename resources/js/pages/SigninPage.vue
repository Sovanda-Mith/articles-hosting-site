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
            class="w-full flex flex-col gap-10 mb-5"
          >
            <div class="relative bg-white rounded-lg w-full">
              <Input
                placeholder="Email address"
                v-model="email"
                v-bind="emailAttrs"
                class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                id="defaultInput"
                type="email"
              />
              <label
                class="subtitle absolute left-2 -top-6 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                for="defaultInput"
              >
                Email address
              </label>
              <div class="text-red-500">{{ errors.email }}</div>
            </div>

            <div class="relative bg-white rounded-lg w-full">
              <input
                placeholder="Username"
                v-model="username"
                v-bind="usernameAttrs"
                class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                id="defaultInput"
                type="text"
              />
              <label
                class="subtitle absolute left-2 -top-6 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                for="defaultInput"
              >
                Username
              </label>
              <div class="text-red-500">{{ errors.username }}</div>
            </div>

            <!-- password -->
            <div class="flex flex-col justify-center items-center">
              <div class="relative bg-white rounded-lg w-full">
                <input
                  placeholder="Password"
                  v-model="password"
                  v-bind="passwordAttrs"
                  class="peer w-full bg-transparent placeholder-transparent text-gray-800 text-sm border-1 border-gray-200 rounded-md px-3 py-2 transition box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;duration-300 ease focus:outline-none focus:border-none focus:shadow-[0_2.8px_2.2px_rgba(0,_0,_0,_0.034),_0_6.7px_5.3px_rgba(0,_0,_0,_0.048),_0_12.5px_10px_rgba(0,_0,_0,_0.06),_0_22.3px_17.9px_rgba(0,_0,_0,_0.072),_0_41.8px_33.4px_rgba(0,_0,_0,_0.086),_0_100px_80px_rgba(0,_0,_0,_0.12)] shadow-sm"
                  id="defaultInput"
                  type="password"
                />
                <label
                  class="subtitle absolute left-2 -top-6 text-gray-500 bg-transparent text-sm transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-gray-600 peer-placeholder-shown:text-base peer-focus:-top-6 peer-focus:text-gray-600 font-semibold peer-focus:text-sm px-1"
                  for="defaultInput"
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
              <div class="relative inline-flex items-center justify-center w-full gap-4 group">
                <div
                  class="absolute inset-0 duration-1000 opacity-60 transitiona-all bg-gradient-to-r from-indigo-500 via-pink-500 to-yellow-400 rounded-xl blur-lg filter group-hover:opacity-100 group-hover:duration-200"
                ></div>
                <button
                  class="group w-full relative inline-flex items-center justify-center rounded-2xl bg-gray-900 px-8 py-3 font-semibold text-white transition-all duration-200 hover:bg-gray-800 hover:shadow-lg hover:-translate-y-0.5 hover:shadow-gray-600/30"
                  title="payment"
                >
                  Get Started For Free<svg
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

              <span class="body-1 text-center text-[#666666]"
                >By creating an account, you agree to the Terms of use and Privacy Policy.
              </span>
            </div>
          </Form>
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

  // const form = reactive({
  //   email: '',
  //   username: '',
  //   password: '',
  // });

  const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
      email: yup.string().email('Invalid email format').required('Email is required'),
      username: yup
        .string()
        .min(3, 'Username must be at least 3 characters')
        .required('Username is required'),
      password: yup
        .string()
        .min(8, 'Password must be at least 8 characters')
        .max(20, 'Password must be less than 20 characters')
        .required('Password is required'),
    }),
  });

  const onSubmit = handleSubmit((values) => {
    alert(JSON.stringify(values, null, 2));
  });

  const [email, emailAttrs] = defineField('email');
  const [username, usernameAttrs] = defineField('username');
  const [password, passwordAttrs] = defineField('password');

  const signInwithGoogle = () => {
    // Use relative path instead of hardcoded URL for better flexibility across environments
    window.location.href = '/auth/google/redirect';
  };
</script>
