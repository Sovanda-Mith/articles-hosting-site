<template>
  <div v-if="isOpen">
    <confirmDialog  @action="show"> </confirmDialog>
  </div>
  
  <div class="min-h-screen bg-gray-50 p-8 text-sm text-gray-900">
    <!-- Personal Details -->
    <section class="mb-10">
      <div class="flex items-center justify-start mb-4 gap-5">
        <h2 class="text-lg font-semibold text-blue-600">Personal Details</h2>
        <button class="text-gray-500 hover:text-blue-500" @click="openEditDialog">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
          </svg>
        </button>
      </div>

      <div class="flex flex-col sm:flex-row gap-8">
        <img
          class="w-32 h-32 object-cover rounded"
          :src="user?.photo"
          alt="Profile Photo"
        />
        <div class="space-y-2">
          <p>
            <span class="text-gray-500">Name</span><br />
            <span class="font-semibold">{{ user?.name }}</span>
          </p>
          <p>
            <span class="text-gray-500">Gender</span><br />
            <span class="font-semibold">{{ user?.gender }}</span>
          </p>
          <p>
            <span class="text-gray-500">Date of Birth</span><br />
            <span class="font-semibold">{{ user?.dateOfBirth }}</span>
          </p>
          
        </div>
      </div>
    </section>

    <!-- Address and Contact -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <!-- Address -->
      <div>
        <div class="flex items-center justify-start gap-5 mb-4">
          <h2 class="text-lg font-semibold text-blue-500 ">Address</h2>
          <!-- <button class="text-gray-500 hover:text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
          </button> -->
        </div>

        <div class="space-y-2">
          <p>
            <span class="text-gray-500">Address Line</span><br />
            <span class="font-semibold">{{ user?.address.line }}</span>
          </p>
          <p>
            <span class="text-gray-500">City</span><br />
            <span class="font-semibold">{{ user?.address.city }}</span>
          </p>
          <p>
            <span class="text-gray-500">Country</span><br />
            <span class="font-semibold">{{ user?.address.country }}</span>
          </p>
        </div>
      </div>

      <!-- Contact -->
      <div>
        <div class="flex items-center justify-start gap-5 mb-4">
          <h2 class="text-lg font-semibold text-blue-400">Contact Details</h2>
          <!-- <button class="text-gray-500 hover:text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
          </button> -->
        </div>

        <div class="space-y-2">
          <p>
            <span class="text-gray-500">Phone Number</span><br />
            <span class="font-semibold">{{ user?.contact.phone }}</span>
          </p>
          <p>
            <span class="text-gray-500">Email</span><br />
            <span class="font-semibold">{{ user?.contact.email }}</span>
          </p>
          <p>
            <span class="text-gray-500">Occupation</span><br />
            <span class="font-semibold">{{ user?.contact.occupation }}</span>
          </p>
        </div>
      </div>
    </section>
  </div>

  <!-- update -->
  <EditAccountDialog
  :show="showEdit"
   mode="edit"
  :user="selectedUser"
  @close="showEdit = false"
  @save="updateUser"
  />
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import confirmDialog from '../__shared__/dialog/confirm-dialog.vue'
import EditAccountDialog from '../__shared__/dialog/EditAccountDialog.vue'
// const BaseURL = 'http://localhost:3000/'
interface Address {
  line: string
  city: string
  country: string
}

interface Contact {
  phone: string
  email: string
  occupation: string
}

interface User {
  photo: string 
  name: string
  gender: string
  dateOfBirth: string
  address: Address
  contact: Contact
}

interface UserForm {
  name: string
  email: string
  pf_image: string
  gender: string
  occupation: string
  phone_number: string | null
  address_line: string | null
  city: string | null
  country: string | null
  dob: string | null

}

const user = ref<User | null>(null)
const loading = ref(true)
const error = ref<string | null>(null)
const isOpen = ref(false);
const showEdit = ref(false)
const selectedUser = ref(null)

const toggleDialog = () => {
    isOpen.value = !isOpen.value;
  };

function openEditDialog() {
  selectedUser.value = user.value
  showEdit.value = true
}

async function fetchUser() {
  try {
    loading.value = true
    error.value = null
    const jwtToken = localStorage.getItem('auth_token');
      if (!jwtToken) return;

      const response = await axios.get('http://localhost:8000/api/admin/profile', {
        headers: {
          Authorization: `Bearer ${jwtToken}`
        }
      })
    const apiData = response.data
    // console.log(response);

    user.value = {
      photo: apiData.pf_image,
      name: apiData.name,
      gender: apiData.gender,
      dateOfBirth: apiData.dob,
      address: {
        line: apiData.address_line,
        city: apiData.city,
        country: apiData.country,
      },
      contact: {
        phone: apiData.phone_number,
        email: apiData.email,
        occupation: apiData.occupation,
      }
    }
  } catch (err: any) {
    error.value = err.message || 'Failed to fetch user data'
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchUser()
})


async function updateUser(user: UserForm) {
  
  const jwtToken = localStorage.getItem('auth_token');
  if (!jwtToken) return;

  try {
     const payload = {
      name: user.name,
      // username: user.username,
      email: user.email,
      occupation: user.occupation,
      // is_allowed: user.status,
      gender: user.gender,
      phone_number: user.phone_number,
      address_line: user.address_line,
      city: user.city,
      country: user.country,
      dob: user.dob,
      // bio: user.bio,
      avatar_base64: user.pf_image || null,
    };
    console.log(payload);
     const response = await axios.post(
      `http://localhost:8000/api/admin/profile`, payload,
    {
      headers: 
      {
        Authorization: `Bearer ${jwtToken}`
      }
    })
    console.log("updated user: ", response)
    showEdit.value = false;
    // Reload users after updating
    await fetchUser();
  } catch (error) {
    console.error('Failed to update user:', error);
  }
}

const show = () => {
  prompt("call from child")
}
</script>


