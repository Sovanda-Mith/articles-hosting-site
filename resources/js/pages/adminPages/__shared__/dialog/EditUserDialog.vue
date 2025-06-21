<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm backdrop-brightness-75 bg-black/30"
  >
    <div
      class="relative w-full max-w-xl max-h-[90vh] mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in"
    >
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ props.mode === 'edit' ? 'Edit User' : 'Create User' }}</h2>

      <!-- Scrollable form container -->
      <div class="overflow-y-auto max-h-[70vh] pr-1">
        <form id="edit-user-form" @submit.prevent="submitForm" class="space-y-4">

          <div class="w-full flex justify-center items-center">
            <!-- <label class="block mb-1 text-sm font-medium text-gray-700">Profile Image</label> -->

            <!-- Image preview -->
            <div class="mb-2">
              <img
                :src="form.pf_image"
                alt="Profile Preview"
                class="w-32 h-32 object-cover rounded-full cursor-pointer border"
                @click="triggerFileInput"
                onerror="this.onerror=null; this.src='http://localhost:3000/resources/assets/images/teamAvatar.png'"
                />
            </div>

            <!-- Hidden file input -->
            <input
              type="file"
              ref="fileInput"
              accept="image/*"
              class="hidden"
              @change="handleImageUpload"
            />

          </div>
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Name</label>
            <input
              v-model="form.name"
              type="text"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
            <input
              v-model="form.username"
              type="text"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input
              v-model="form.email"
              type="email"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Occupation</label>
            <input
              v-model="form.occupation"
              type="text"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Gender</label>
            <select
              v-model="form.gender"
              class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
              <option disabled value="">-- Select Gender --</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>

          <div >
            <label class="block mb-1 text-sm font-medium text-gray-700">Status</label>
            <select
              v-model="form.status"
              class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
              <option disabled value="">-- Select Status --</option>
              <option value="allowed">Allow</option>
              <option value="blocked">Block</option>
            </select>
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Phone Number</label>
            <input
              v-model="form.phone_number"
              type="tel"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Address</label>
            <input
              v-model="form.address_line"
              type="text"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">City</label>
            <input
              v-model="form.city"
              type="text"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Country</label>
            <input
              v-model="form.country"
              type="text"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Date of Birth</label>
            <input
              v-model="form.dob"
              type="date"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Bio</label>
            <textarea
              v-model="form.bio"
              rows="3"
              class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            ></textarea>
          </div>

          
        </form>
      </div>

      <!-- Buttons outside scroll area -->
      <div class="flex justify-end gap-3 pt-4">
        <button
          type="button"
          @click="close"
          class="px-4 py-2 rounded-md text-sm bg-gray-100 hover:bg-gray-200 text-gray-700"
        >
          Cancel
        </button>
        <button
          type="submit"
          form="edit-user-form"
          class="px-4 py-2 rounded-md text-sm bg-blue-600 hover:bg-blue-700 text-white"
        >
          Save
        </button>
      </div>

      <button
        @click="close"
        class="absolute top-3 right-3 text-gray-400 hover:text-gray-800 text-xl"
        aria-label="Close"
      >
        &times;
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive, watch, defineEmits, defineProps } from 'vue'
import { ref } from 'vue'

const emit = defineEmits(['close', 'save'])
const imageChanged = ref(false)
// const props = defineProps<{
//   show: boolean
//   user: {
//     id: number
//     name: string
//     username: string
//     email: string
//     occupation: string | null
//     gender: string
//     status: string
//     phone_number: string | null
//     address_line: string | null
//     city: string | null
//     country: string | null
//     dob: string | null
//     bio: string | null
//     pf_image: string | null
//   }
// }>()
const props = defineProps<{
  show: boolean
  user?: {
    id: number
    name: string
    username: string
    email: string
    occupation: string | null
    gender: string
    status: string
    phone_number: string | null
    address_line: string | null
    city: string | null
    country: string | null
    dob: string | null
    bio: string | null
    pf_image: string | null
  }
  mode: 'create' | 'edit'
}>()

const fileInput = ref<HTMLInputElement | null>(null)

function triggerFileInput() {
  fileInput.value?.click()
}

function handleImageUpload(event: Event) {
  const target = event.target as HTMLInputElement
  const file = target.files?.[0]
  if (!file) return

  const reader = new FileReader()
  reader.onload = () => {
    form.pf_image = reader.result as string // base64 string
    imageChanged.value = true
  }
  reader.readAsDataURL(file)
}

async function convertImageUrlToBase64(imageUrl: string): Promise<string> {
  const response = await fetch(imageUrl)
  const blob = await response.blob()

  return new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.onloadend = () => resolve(reader.result as string)
    reader.onerror = reject
    reader.readAsDataURL(blob)
  })
}

const form = reactive({
  name: '',
  username: '',
  email: '',
  occupation: '',
  gender: '',
  status: '',
  phone_number: '',
  address_line: '',
  city: '',
  country: '',
  dob: '',
  bio: '',
  pf_image: '',
})

// watch(
//   () => props.user,
//   (u) => {
//     if (u) {
//       form.name = u.name || ''
//       form.username = u.username || ''
//       form.email = u.email || ''
//       form.occupation = u.occupation || ''
//       form.gender = u.gender || ''
//       form.status = u.status || ''
//       form.phone_number = u.phone_number || ''
//       form.address_line = u.address_line || ''
//       form.city = u.city || ''
//       form.country = u.country || ''
//       form.dob = u.dob ? u.dob.slice(0, 10) : ''
//       form.bio = u.bio || ''
//       // form.pf_image = u.pf_image || ''
//        if (u.pf_image) {
//         ;(async () => {
//           form.pf_image = await convertImageUrlToBase64(u.pf_image!)
//         })()
//       } else {
//         form.pf_image = ''
//       }
//     }
//   },
//   { immediate: true }
// )
watch(
  () => props.user,
  (u) => {
    if (props.mode === 'edit' && u) {
      form.name = u.name || ''
      form.username = u.username || ''
      form.email = u.email || ''
      form.occupation = u.occupation || ''
      form.gender = u.gender || ''
      form.status = u.status || ''
      form.phone_number = u.phone_number || ''
      form.address_line = u.address_line || ''
      form.city = u.city || ''
      form.country = u.country || ''
      form.dob = u.dob ? u.dob.slice(0, 10) : ''
      form.bio = u.bio || ''

      if (u.pf_image) {
        ;(async () => {
          form.pf_image = await convertImageUrlToBase64(u.pf_image!)
        })()
      } else {
        form.pf_image = ''
      }
    } else if (props.mode === 'create') {
      // Reset form for new user
      Object.assign(form, {
        name: '',
        username: '',
        email: '',
        occupation: '',
        gender: '',
        status: '',
        phone_number: '',
        address_line: '',
        city: '',
        country: '',
        dob: '',
        bio: '',
        pf_image: '',
      })
    }
  },
  { immediate: true }
)

function close() {
  emit('close')
}

// function submitForm() {
//   emit('save', {
//     id: props.user.id,
//     ...form,
//   })
//   close()
// }
async function submitForm() {

  if (!imageChanged.value && !form.pf_image) {
    const fallbackUrl =
      'http://localhost:3000/resources/assets/images/teamAvatar.png'
    form.pf_image = await convertImageUrlToBase64(fallbackUrl)
  }
  const payload = {
    ...form,
    ...(props.mode === 'edit' && props.user ? { id: props.user.id } : {}),
  }

  emit('save', payload)
  close()
}
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.animate-fade-in {
  animation: fade-in 0.2s ease-out forwards;
}
</style>
