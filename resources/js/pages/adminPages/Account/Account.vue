<template>
  <div class="min-h-screen bg-gray-50 p-8 text-sm text-gray-900">
    <!-- Personal Details -->
    <section class="mb-10">
      <div class="flex items-center justify-start mb-4 gap-5">
        <h2 class="text-lg font-semibold text-blue-600">Personal Details</h2>
        <button class="text-gray-500 hover:text-blue-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
          </svg>
        </button>
      </div>

      <div class="flex flex-col sm:flex-row gap-8">
        <img
          class="w-32 h-32 object-cover rounded"
          :src="user.photo"
          alt="Profile Photo"
        />
        <div class="space-y-2">
          <p>
            <span class="text-gray-500">Name</span><br />
            <span class="font-semibold">{{ user.name }}</span>
          </p>
          <p>
            <span class="text-gray-500">Gender</span><br />
            <span class="font-semibold">{{ user.gender }}</span>
          </p>
          <p>
            <span class="text-gray-500">Date of Birth</span><br />
            <span class="font-semibold">{{ user.dateOfBirth }}</span>
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
          <button class="text-gray-500 hover:text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
          </button>
        </div>

        <div class="space-y-2">
          <p>
            <span class="text-gray-500">Address Line</span><br />
            <span class="font-semibold">{{ user.address.line }}</span>
          </p>
          <p>
            <span class="text-gray-500">City</span><br />
            <span class="font-semibold">{{ user.address.city }}</span>
          </p>
          <p>
            <span class="text-gray-500">State</span><br />
            <span class="font-semibold">{{ user.address.state }}</span>
          </p>
          <p>
            <span class="text-gray-500">Country</span><br />
            <span class="font-semibold">{{ user.address.country }}</span>
          </p>
        </div>
      </div>

      <!-- Contact -->
      <div>
        <div class="flex items-center justify-start gap-5 mb-4">
          <h2 class="text-lg font-semibold text-blue-400">Contact Details</h2>
          <button class="text-gray-500 hover:text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
          </button>
        </div>

        <div class="space-y-2">
          <p>
            <span class="text-gray-500">Phone Number</span><br />
            <span class="font-semibold">{{ user.contact.phone }}</span>
          </p>
          <p>
            <span class="text-gray-500">Email</span><br />
            <span class="font-semibold">{{ user.contact.email }}</span>
          </p>
          <p>
            <span class="text-gray-500">Occupation</span><br />
            <span class="font-semibold">{{ user.contact.occupation }}</span>
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script lang="ts" setup>
interface Address {
  line: string
  city: string
  state: string
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

const user: User = {
  photo: 'data:image/jpeg;base64,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',
  name: 'Tomiwa Oyeledu Dolapo',
  gender: 'Female',
  dateOfBirth: 'August 27th, 1999',
  address: {
    line: 'No 35 Jimmy Ebi Street',
    city: 'Yenagoa',
    state: 'Bayelsa',
    country: 'Nigeria',
  },
  contact: {
    phone: '09034867656',
    email: 'tomilola@me.com',
    occupation: 'Web Developer',
  },
}
</script>

