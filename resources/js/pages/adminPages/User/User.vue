<template>
  <div class="h-full flex flex-col justify-start overflow-y-auto">
     <!-- Toolbar -->
  <div class="flex justify-between items-center p-4 bg-white shadow rounded-t-lg">
    <div class="flex gap-2">
      <div class="px-4 py-2 gap-2 rounded hover:bg-gray-100 flex justify-center items-center shadow cursor-pointer">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5">
            <path d="M6.5 2.25a.75.75 0 0 0-1.5 0v3a.75.75 0 0 0 1.5 0V4.5h6.75a.75.75 0 0 0 0-1.5H6.5v-.75ZM11 6.5a.75.75 0 0 0-1.5 0v3a.75.75 0 0 0 1.5 0v-.75h2.25a.75.75 0 0 0 0-1.5H11V6.5ZM5.75 10a.75.75 0 0 1 .75.75v.75h6.75a.75.75 0 0 1 0 1.5H6.5v.75a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 1 .75-.75ZM2.75 7.25H8.5v1.5H2.75a.75.75 0 0 1 0-1.5ZM4 3H2.75a.75.75 0 0 0 0 1.5H4V3ZM2.75 11.5H4V13H2.75a.75.75 0 0 1 0-1.5Z" />
          </svg>
        </div>
        <div>
          Filters
        </div>
      
      </div>
      <div class="px-4 py-2 gap-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex shadow cursor-pointer">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 -mb-1">
            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
          </svg>
        </div> 
        <div>
          Add User
        </div>
      </div>
    </div>
    <div class="flex justify-center items-center  shadow px-2 rounded border-gray-200">
      <span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
          <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
        </svg>
      </span>
      <div>
      <input
            type="text"
            placeholder="Search"
            v-model="searchQuery"
            class="px-4 py-2 rounded w-64 focus:outline-none focus:ring-0 border-none"
          />
    </div>
    </div>
    
    
  </div>

  <!-- Table -->
  <div class="overflow-x-auto ">
    <table class="min-w-full bg-white divide-y divide-gray-200">
      <thead class=" text-left text-sm font-medium ">
        <tr>
          <th class="px-6 py-3 cursor-pointer" @click="sort('name')">
            <div class="flex">
              <div>Users</div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>          
          </th>
          <th class="px-6 py-3 cursor-pointer " @click="sort('gender')">
            <div class="flex">
              <div>Gender</div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>
          </th>
          <th class="px-6 py-3 cursor-pointer " @click="sort('occupation')">
            <div class="flex">
              <div>Occupation</div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>

          </th>
          <th class="px-6 py-3 cursor-pointer " @click="sort('status')">
            
            <div class="flex">
              <div>Status</div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>
            
          </th>
          <th class="px-6 py-3 cursor-pointer " @click="sort('creationDate')">
            <div class="flex mr-2">
              <div>Creation Date</div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>
            
          </th>
          <th class="px-6 py-3 ">
            <div class="flex">
              <div>Actions</div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v10.638l3.96-4.158a.75.75 0 1 1 1.08 1.04l-5.25 5.5a.75.75 0 0 1-1.08 0l-5.25-5.5a.75.75 0 1 1 1.08-1.04l3.96 4.158V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>
          
          </th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 text-sm">
        <tr v-for="user in paginatedUsers" :key="user.id" class="hover:bg-gray-50">
          <td class="px-6 py-4 flex items-center gap-3">
            <img :src="user.avatar" alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-blue-500" />
            <div>
              <div class="font-semibold">{{ user.name }}</div>
              <div class="text-gray-500 text-sm">{{ user.email }}</div>
            </div>
          </td>
          <td class="px-6 py-4">{{ user.gender }}</td>
          <td class="px-6 py-4">{{ user.occupation }}</td>
          <td class="px-6 py-4">
            <span
              :class="{
                'text-blue-600 font-medium': user.status === 'Allowed',
                'text-red-600 font-medium': user.status === 'Disallowed'
              }"
            >
              {{ user.status }}
            </span>
          </td>
          <td class="px-6 py-4">{{ formatDate(user.creationDate) }}</td>
          <td class="px-6 py-4 space-x-4">
            <button @click="editUser(user)" class="text-blue-600 hover:text-blue-800">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>
            </button>
            <button @click="deleteUser(user)" class="text-red-600 hover:text-red-800">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="flex justify-between items-center p-4 bg-white rounded-b-lg border-t">
    <button @click="prevPage" :disabled="page === 1"
      class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">
      Previous
    </button>
    <span class="text-sm text-gray-600">Page {{ page }} of {{ totalPages }}</span>
    <button @click="nextPage" :disabled="page === totalPages"
      class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">
      Next
    </button>
  </div>
  </div>

</template>
<script setup lang="ts">
import { ref, computed } from 'vue'

interface User {
  id: number
  name: string
  email: string
  avatar: string
  gender: string
  occupation: string
  status: string
  creationDate: string
}

const users = ref<User[]>([
  {
    id: 1,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 2,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 3,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 4,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 5,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 6,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 7,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 8,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 9,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  {
    id: 10,
    name: 'John Doe 🇮🇳',
    email: 'john.doe@gmail.com',
    avatar: 'https://i.pravatar.cc/150?img=1',
    gender: 'Male',
    occupation: 'Web Developer',
    status: 'Allowed',
    creationDate: '2025-03-12',
  },
  
])

const searchQuery = ref('')
const page = ref(1)
const pageSize = 10

const filteredUsers = computed(() =>
  users.value.filter(u =>
    u.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
)

const totalPages = computed(() =>
  Math.ceil(filteredUsers.value.length / pageSize)
)

const paginatedUsers = computed(() =>
  filteredUsers.value.slice((page.value - 1) * pageSize, page.value * pageSize)
)

function sort(key: keyof User) {
  users.value.sort((a, b) => (a[key] > b[key] ? 1 : -1))
}

function prevPage() {
  if (page.value > 1) page.value--
}

function nextPage() {
  if (page.value < totalPages.value) page.value++
}

function formatDate(date: string) {
  return new Date(date).toLocaleDateString('en-GB', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  })
}

function editUser(user: User) {
  alert(`Edit: ${user.name}`)
}

function deleteUser(user: User) {
  alert(`Delete: ${user.name}`)
}

</script>